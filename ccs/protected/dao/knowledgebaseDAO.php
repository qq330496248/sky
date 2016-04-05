<?php
/**
 * @desc 知识分类表操作类
 * @author Dengshaocong
 * @date 2016-01-08 
 */
class knowledgebaseDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author Dengshaocong
	 * @date 2016-01-08 
	 * @param string $className
	 * @return knowledgebaseDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author Dengshaocong
	 * @date 2016-01-08 
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'knowledgebase';
		$this->primaryKey = 'id';
	}

	/**
	 * @desc  获取最后一个主键
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function getMaxZskNumber(){
		$select = "{$this->tableName}.id";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.id ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc  获取知识库
	 * @param array $condInfo 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function getZsk($condInfo){
		$select = "{$this->tableName}.id,{$this->tableName}.type,{$this->tableName}.title,{$this->tableName}.private,{$this->tableName}.tag,
					{$this->tableName}.source,{$this->tableName}.iftop,{$this->tableName}.text,{$this->tableName}.attachment,{$this->tableName}.zsktime,
					{$this->tableName}.setter,{$this->tableName}.viewtime";
		$where['express'] = "{$this->tableName}.id != ''";
		$where['value'] = array();
		if(!empty($condInfo)){
			if(!empty($condInfo['title'])){
				$where['express'] .= " AND {$this->tableName}.title like :title";
				$where['value'][':title'] = '%'.$condInfo['title'].'%';
			}
			if(!empty($condInfo['begindate'])){
				$where['express'] .= " AND {$this->tableName}.zsktime >= :begindate";
				$where['value'][':begindate'] = $condInfo['begindate'];
			}
			if(!empty($condInfo['enddate'])){
				$where['express'] .= " AND {$this->tableName}.zsktime <= :enddate";
				$where['value'][':enddate'] = $condInfo['enddate'];
			}
			if(!empty($condInfo['type'])){
				$where['express'] .= " AND {$this->tableName}.type in (".$condInfo['type'].")";
			}
			if(!empty($condInfo['private'])){
				$where['express'] .= " AND {$this->tableName}.private <= :private";
				$where['value'][':private'] = $condInfo['private'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.id DESC ");
		$result = $this->dbCommand->queryAll();						   
		return $result;
	}
}
?>