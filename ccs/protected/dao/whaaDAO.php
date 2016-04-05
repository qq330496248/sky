<?php
/**
 * @desc 问卷表操作类
 * @author WuJunhua
 * @date 2016-01-07
 */
class whaaDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2016-01-07
	 * @param string $className
	 * @return whaaDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2016-01-07
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'whaa';
		$this->primaryKey = 'whaa01';
		$this->createtime = 'whaa04';
	}

	/**
	 * @desc 获取问卷列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 问卷订单列表信息
	 * @author WuJunhua
	 * @date 2016-01-09
	 */
	public function getQuestionnaireList($page,$psize){	
		$select = "{$this->tableName}.whaa01,{$this->tableName}.whaa02,{$this->tableName}.whaa04,{$this->tableName}.whaa06,{$this->tableName}.whaa07,{$this->tableName}.whaa05";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->limit($psize, $psize * ($page - 1))
						->order("{$this->createtime} "." DESC");
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->queryScalar();	
		return $result;
	}

	/**
	 * @desc 获取问卷详情信息
	 * @param int $bookId 问卷序号
	 * @return array $result 问卷详情信息
	 * @author WuJunhua
	 * @date 2015-11-03
	 */
	public function getBookDetails($bookId){	
		$select = "{$this->tableName}.whaa01,{$this->tableName}.whaa02,{$this->tableName}.whaa03";
		$where['express'] = "{$this->tableName}.whaa01 = :bookId";
		$where['value']['bookId'] = $bookId;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result = $this->dbCommand->queryRow();
		return $result;
	}	
	
}
