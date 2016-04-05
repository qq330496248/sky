<?php
/**
 * @desc 公告表操作类
 * @author Dengshaocong
 * @date 2015-11-16 
 */
class annsetDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author Dengshaocong
	 * @date 2015-11-16 
	 * @param string $className
	 * @return annsetDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author Dengshaocong
	 * @date 2015-11-16 
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'annset';
		$this->primaryKey = 'id';
	}
	/**
	 * @desc 根据ID等条件获取公告
	 * @param array $annCond
	 * @author Dengshaocong
	 * @date 2015-11-23 
	 */
	public function getAnn($annCond){
		$select = "{$this->tableName}.id,{$this->tableName}.title,{$this->tableName}.anntype,{$this->tableName}.content,{$this->tableName}.iftop,
					{$this->tableName}.anndate,rylist.personname";
		$where['express'] = "{$this->tableName}.id > 0 ";
		$where['value'] = array();
		if(!empty($annCond)){
			if(!empty($annCond['ryid'])){
				$where['express'] .= " AND {$this->tableName}.ryid = :ryid ";
				$where['value'][':ryid'] = $annCond['ryid'];
			}
			if(!empty($annCond['anntype'])){
				$where['express'].=" AND {$this->tableName}.anntype = :anntype ";
				$where['value'][':anntype'] = $annCond['anntype'];
			}
			if(!empty($annCond['begindate'])){
				$where['express'].=" AND {$this->tableName}.anndate >= :begindate ";
				$where['value'][':begindate'] = $annCond['begindate'];
			}
			if(!empty($annCond['enddate'])){
				$where['express'].=" AND {$this->tableName}.anndate <= :enddate ";
				$where['value'][':enddate'] = $annCond['enddate'];
			}
		}
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->leftjoin('rylist',"{$this->tableName}.ryid=rylist.id")
						->where($where['express'],$where['value'])
						->order("iftop DESC,anndate DESC");
		$result['info'] = $this->dbCommand->queryAll();
		/*$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();	*/
									   
		return $result;
	}

}