<?php
/**
 * @desc 客户地址表操作类
 * @author WuJunhua
 * @date 2015-11-02 
 */
class khabDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author WuJunhua
	 * @date 2015-11-02
	 * @param string $className
	 * @return khabDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author WuJunhua
	 * @date 2015-11-03
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'khab';
		$this->primaryKey = 'khab01';
	}

		/**
	 * @desc 提交合并客户资料（地址查询）
	 * @param int $searchType 查询类型
	 * @param int $keyword 每页显示的记录条数
	 * @return array $result 我的客户列表信息
	 * @author huyan
	 * @date 2016-01-04
	 */
	/*public function getAddress($clientNo,$searchType,$keyword,$khzl1Client,$khzl2Client,$retaintype){
		if($searchType == 1){
			if ($retaintype==1) {
				$where['express'] = "{$this->tableName}.khab01 = :ordernum";
			    $where['value']['ordernum'] = $khzl2Client;
			}
			if ($retaintype==2) {
				$where['express'] = "{$this->tableName}.khab01 = :ordernum";
			    $where['value']['ordernum'] = $khzl1Client;
			}
		}
		if($searchType == 2){
			if ($retaintype==1) {
				$where['express'] = "{$this->tableName}.khab01 = :phone";
			    $where['value']['phone'] = $khzl2Client;
			}	
			if ($retaintype==2) {
				$where['express'] = "{$this->tableName}.khab01 = :phone";
			    $where['value']['phone'] = $khzl1Client;
			}	
		}
		if($searchType == 3){
			if ($retaintype==1) {
				$where['express'] = "{$this->tableName}.khab01 = :khname";
			    $where['value']['khname'] = $khzl2Client;
			}	
			if ($retaintype==2) {
				$where['express'] = "{$this->tableName}.khab01 = :khname";
			    $where['value']['khname'] = $khzl1Client;
			}
		}
		$select = "{$this->tableName}.khab01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}*/
}