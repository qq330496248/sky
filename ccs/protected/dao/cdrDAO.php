<?php
/**
 * @desc 10.230通话记录表操作类
 * @author WuJunhua
 * @date 2016-02-18
 */
class cdrDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2016-02-18 
	 * @param string $className
	 * @return cdrDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}

	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2016-02-18
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->dbCdr;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'cdr';
		$this->primaryKey = 'id';
		$this->createtime = 'calldate';
	}

	/**
	 * @desc 根据本地最新的呼叫时间获取10.230的所有通话记录信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 10.230的通话记录
	 * @author WuJunhua
	 * @date 2016-02-18
	 */
	public function getCallingRecordsByRemote($newestCallTime){	
		$select = "{$this->tableName}.calldate,src,dst,duration,billsec,channel,dstchannel,disposition,uniqueid,userfield";
		$where['express'] = "$this->createtime > :calldate";
	    $where['value']['calldate'] = $newestCallTime;
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("$this->createtime ".' ASC');
		$result = $this->dbCommand->queryAll();
		return $result;
	}

}
