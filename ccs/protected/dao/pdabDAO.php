<?php
/**
 * @desc 盘点明细表操作类
 * @author WuJunhua
 * @date 2015-12-01
 */
class pdabDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-12-01
	 * @param string $className
	 * @return pdabDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-12-01
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'pdab';
		$this->primaryKey = true;
	}

	/**
	 * @desc 获取款号进销存报表明细（盘点）
	 * @param array $cond 查询条件
	 * @return array $result 搜索结果
	 * @author DengShaocong
	 * @date 2016-03-23
	 */
	public function getKhjxcByCondPD($cond){
		$select = "sum({$this->tableName}.pdab05) num,sum({$this->tableName}.pdab05) money";
		$where['express'] = "{$this->tableName}.pdab03 = ". $cond['cpkh'] ." ";
		$where['value'] = array();
		if(!empty($cond)){
			/*if(!empty($cond['beginDate'])){
				$where['express'] .= " and pdaa.pdaa03 >= :beginDate ";
				$where['value'][':beginDate'] = $cond['beginDate'];
			}
			if(!empty($cond['endDate'])){
				$where['express'] .= " and pdaa.pdaa03 <= :endDate ";
				$where['value'][':endDate'] = $cond['endDate'];
			}*/
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('pdaa',"{$this->tableName}.pdab01 = pdaa01")
						->where($where['express'],array());
		$result = $this->dbCommand->queryAll();
		if(empty($result[0]['num']) && empty($result[0]['money'])){
			return array(
				'num'=>0,
				'money'=>0
				);
		}
		return $result[0];
	}
}
