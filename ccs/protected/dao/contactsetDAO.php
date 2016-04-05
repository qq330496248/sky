<?php
/**
 * @desc 联系人表操作类
 * @author Dengshaocong
 * @date 2016-01-11
 */
class contactsetDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author Dengshaocong
	 * @date 2016-01-11
	 * @param string $className
	 * @return contactsetDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author Dengshaocong
	 * @date 2016-01-11
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'contactset';
		$this->primaryKey = 'id';
	}

	/**
	 * @desc 获取所有联系人
	 * @param array $condInfo  查询条件
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function getUser($condInfo){
		$select = "{$this->tableName}.id,{$this->tableName}.personname,{$this->tableName}.sex,{$this->tableName}.phone,{$this->tableName}.fenji,
					{$this->tableName}.telephone,{$this->tableName}.otherphone,{$this->tableName}.faxnumber,{$this->tableName}.email,
					{$this->tableName}.address,{$this->tableName}.bz,{$this->tableName}.department,{$this->tableName}.role";
		$where['express'] = "{$this->tableName}.id > 0";
		$where['value'] = array();
		if(!empty($condInfo)){
			if(!empty($condInfo['department'])){
				$where['express'] .= " AND {$this->tableName}.department = :department";
				$where['value'][':department'] = $condInfo['department'];
			}
			if(!empty($condInfo['name'])){
				$where['express'] .= " AND {$this->tableName}.advertdate >= :name";
				$where['value'][':name'] = '%'.$condInfo['name'].'%';
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.id DESC ");
		$result['info'] = $this->dbCommand->queryAll();						   
		return $result;
	}

	/**
	 * @desc 获取电话信息（用于电话转移）
	 * @param int $page 页数
	 * @param int $psize 每页显示的数量
	 * @param string $fenji 分机号
	 * @author DengShaocong
	 * @date 2016-01-15
	 */
	public function getTransfer($page,$psize,$fenji){
		$select = "{$this->tableName}.id,{$this->tableName}.personname,{$this->tableName}.sex,{$this->tableName}.phone,{$this->tableName}.fenji,
					{$this->tableName}.telephone,{$this->tableName}.otherphone,{$this->tableName}.faxnumber,{$this->tableName}.email,
					{$this->tableName}.address,{$this->tableName}.bz,{$this->tableName}.department,{$this->tableName}.username,{$this->tableName}.role";
		$where['express'] = "{$this->tableName}.ifsystem = '是'";
		$where['value'] = array();
		if(!empty($fenji)){
			$where['express'].=" AND {$this->tableName}.fenji like :fenji ";
			$where['value'][':fenji'] = '%'.$fenji.'%';
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->limit($psize, $psize * ($page - 1))
						->order("id".' DESC');

		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}
}
?>