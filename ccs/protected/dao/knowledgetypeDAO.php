<?php
/**
 * @desc 知识分类表操作类
 * @author Dengshaocong
 * @date 2016-01-07 
 */
class knowledgetypeDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author Dengshaocong
	 * @date 2016-01-07
	 * @param string $className
	 * @return knowledgetypeDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author Dengshaocong
	 * @date 2016-01-07
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'knowledgetype';
		$this->primaryKey = 'id';
	}

	/**
	 * @desc 获取某一知识分类的下一级分类的数量
	 * @param int $level 当前等级（0为一级分类）
	 * @param int $highertype 上一级分类的编号（0为一级分类）
	 * @return array $result 知识分类列表信息
	 * @author DengShaocong
	 * @date 2016-01-07
	 */
	public function getCurrentLevelNum($level,$highertype){
		$select = "count(*) as count";
		$where['experss'] = "{$this->tableName}.level = ".$level." and {$this->tableName}.higherlevel = ".$highertype;
		$where['value'] = array(); 
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['experss'],$where['value']);
		$result = $this->dbCommand->queryAll();
									   
		return $result[0];
	}

	/**
	 * @desc 获取一个知识分类的信息
	 * @param int $level 当前等级（0为一级分类）
	 * @param int $highertype 上一级分类的编号（0为一级分类）
	 * @param int $limit 从第几个开始取（以0位开头）
	 * @return array $result 我的客户列表信息
	 * @author DengShaocong
	 * @date 2016-01-07
	 */
	public function getSingleType($level,$highertype,$limit){	
		$select = "{$this->tableName}.id,{$this->tableName}.typename,{$this->tableName}.operylist,{$this->tableName}.viewrylist,{$this->tableName}.typetext,{$this->tableName}.higherlevel,{$this->tableName}.level";
		$where['experss'] = "{$this->tableName}.level = ".$level." and {$this->tableName}.higherlevel = ".$highertype;
		$where['value'] = array(); 
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.id".' ASC')
						->where($where['experss'],$where['value'])
						->limit(1,$limit);
		$result = $this->dbCommand->queryAll();	
		if($result){
			return $result[0];
		}							   
		return null;
	}

	/**
	 * @desc 获取一个知识分类的信息
	 * @param int $parent 上级分类
	 * @return array $result 我的客户列表信息
	 * @author DengShaocong
	 * @date 2016-01-11
	 */
	public function getSon($parent){
		$select = "{$this->tableName}.id,{$this->tableName}.typename,{$this->tableName}.higherlevel";
		$where['experss'] = '';
		$where['value'] = array(); 
		if(!empty($parent)){
			$where['experss'] = "{$this->tableName}.higherlevel = ".$parent;
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.id".' ASC')
						->where($where['experss'],$where['value'])
						->limit(1,0);
		$result = $this->dbCommand->queryAll();	
		if($result){
			return $result[0];
		}							   
		return null;
	}
}
?>