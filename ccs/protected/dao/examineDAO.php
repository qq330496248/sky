<?php
/**
 * @desc 考核记录表操作类
 * @author DengShaocong
 * @date 2015-11-9
 */
class examineDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-11-10
	 * @param string $className
	 * @return khjlDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	/**
	 * @desc 初始化
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'examine';
		$this->primaryKey = 'id';
	}
	/**
	 * @desc 根据条件获取考核记录信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param array $khjlInfo 查询条件
	 * @return array $result 考核记录信息
	 * @author DengShaocong
	 * @date 2015-11-10
	 */
	public function getKhjlByCond($page,$psize,$khjlInfo){	
		$select = "{$this->tableName}.id,{$this->tableName}.xmid,{$this->tableName}.ryid,{$this->tableName}.khdate,{$this->tableName}.remark,
					{$this->tableName}.setter,{$this->tableName}.lrdate,
					rylist.username,rylist.personname,khxm.khxm,khxm.type,khxm.score";
		$where['express'] = "{$this->tableName}.id > 0";
		$where['value'] = array();
		if(!empty($khjlInfo)){
			if(!empty($khjlInfo['type'])){
				$where['express'].=" AND khxm.type = :type";
				$where['value'][':type'] = $khjlInfo['type'];
			}
			if(!empty($khjlInfo['xmid'])){
				$where['express'].=" AND {$this->tableName}.xmid = :xmid ";
				$where['value'][':xmid'] = $khjlInfo['xmid'];
			}
			if(!empty($khjlInfo['username'])){
				$where['express'].=" AND rylist.username like :username ";
				$where['value'][':username'] = '%'.$khjlInfo['username'].'%';
			}
			if(!empty($khjlInfo['begindate'])){
				$where['express'].=" AND {$this->tableName}.khdate >= :begindate";
				$where['value'][':begindate'] = $khjlInfo['begindate'];
			}
			if(!empty($khjlInfo['enddate'])){
				$where['express'].=" AND {$this->tableName}.khdate <= :enddate ";
				$where['value'][':enddate'] = $khjlInfo['enddate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('khxm',"{$this->tableName}.xmid=khxm.id")
						->leftjoin('rylist',"{$this->tableName}.ryid=rylist.id")
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("id".' DESC');

		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->leftjoin('khxm',"{$this->tableName}.xmid=khxm.id")
										   ->leftjoin('rylist',"{$this->tableName}.ryid=rylist.id")
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}
}	
?>