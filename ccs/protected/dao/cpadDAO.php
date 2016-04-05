<?php
/**
 * @desc 产品品牌表操作类
 * @author DengShaocong
 * @date 2015-11-2 
 */
class cpadDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-11-2
	 * @param string $className
	 * @return cpadDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'cpad';
		$this->primaryKey = 'cpad01';
	}

	/**
	 * @desc 根据条件获取产品品牌列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @param string $cpmc 产品名称
	 * @return array $result 产品品牌信息
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function getCpppByCond($page,$psize,$cpmc){	
		$select = "{$this->tableName}.cpad01,{$this->tableName}.cpad03,{$this->tableName}.cpad04,{$this->tableName}.cpad05";
		$where['express'] = "{$this->tableName}.cpad01 > 0";
		$where['value'] = array();
		if(!empty($cpmc)){
			$where['express'].=" AND {$this->tableName}.cpad03 like :cpad03";
			$where['value'][':cpad03'] = '%'.$cpmc.'%';
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("cpad01 DESC , cpad07 ASC")
						->limit($psize, $psize * ($page - 1));

		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	
		return $result;
	}
	/**
	 * @desc 根据条件获取产品品牌列表信息
	 * @return array $result 产品品牌信息
	 * @author DengShaocong
	 * @date 2015-11-30
	 */
	public function getCppp(){
		$select = "{$this->tableName}.cpad01,{$this->tableName}.cpad03,{$this->tableName}.cpad04,{$this->tableName}.cpad05";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("cpad01".' DESC');

		$result['info'] = $this->dbCommand->queryAll();
		return $result;
	}
}
?>