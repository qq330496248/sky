<?php
/**
 * @desc 数据库访问类父类
 * @author WuJunhua
 * @date 2015年10月10日
 */
abstract class BaseDAO{
	/**
	 * @var CDbConnection
	 */
	protected $dbConnection;
	/**
	 * @var CDbCommand
	 */
	protected $dbCommand;
	/**
	 * @var string
	 */
	protected $tableName;
	/**
	 * @var string
	 */
	protected $primaryKey;
	/**
	 * @var string
	 */
	protected $created;
	/**
	 * @var string
	 */
	protected $updated;
	/**
	 * @var string
	 */
	protected static $paramAlias = ':p';
	/**
	 * @var array
	 */
	protected $fields = array();
	/**
	 * @var array
	 */
	private static $_instances = array();

	/**
	 * @desc 创建实例
	 * @param string $className
	 * @return BaseDAO
	 * @author WuJunhua
	 * @date 2015-10-10
	*/
	protected static function createInstance($className)
	{
		if(isset(self::$_instances[$className])){
			return self::$_instances[$className];
		}
		$instance = self::$_instances[$className] = new $className();
		return $instance;
	}

	/**
	* @desc 判断表名、主键、传入参数是否为空
	* @param mixed 可变长参数列表
	* @return boolean [true: 有参数为空；false: 没有空字段]
	*/
	public function isParamsEmpty(){
		if(empty($this->tableName) || empty($this->primaryKey)){
			return true;
		}
		$paramArray = func_get_args();
		if(!empty($paramArray)){
			foreach ($paramArray as $param) {
				if(empty($param)){
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * @desc 测试表记录是否已存在
	 * @param array $conditions 格式array('fieldName'=>'value')键名为字段名，值为要匹配的值
	 * @param boolean $returnPk 是否回填查询到的记录的PrimaryKey
	 * @return boolean 存在则返回true，否则返回false
	 * @author WuJunhua
	 * @date 2015-10-11
	 */
	public function isExists(&$conditions, $returnPk = false){
		if($this->isParamsEmpty($conditions)){
			return false;
		}
		$record = $this->findByAttributes($conditions, $this->primaryKey);
		if(empty($record)){
			return false;
		}
		if($returnPk){
			// 记录存在，将record的主建返回给参数
			$conditions[$this->primaryKey] = $record[$this->primaryKey];
		}
		return true;
	}

	/**
	 * @desc 根据主键查找记录
	 * @param int $pk 主键值
	 * @param array $selections 查找需要返回的字段名
	 * @return mixed 查找到的第一条记录 或 fasle
	 * @author WuJunhua
	 * @date 2015-10-13
	 */
	public function findByPk($pk, $selections = array()){
		if($this->isParamsEmpty($pk)){
			return false;
		}
		$selects = '*';
		if($selections){
			$selects = implode(',', $selections);
		}
		try {
			$result = $this->dbCommand->reset()->select($selects)
									  ->from($this->tableName)
									  ->where($this->primaryKey.' = :primaryKey', array(':primaryKey' => $pk))
									  ->queryRow();
			return $result;
		} catch (Exception $ex){
			return false;
		}
	}

	/**
	 * @desc 根据条件查找一条记录
	 * @param mixed $criteria 待匹配记录的(field-value)键值对数组 或者 为CDbCriteria类实例
	 * @param mixed $selections 查找需要返回的字段名string eg."a,b,c"或array eg.array('a','b','c')
	 * @param mixed $order the columns (and the directions) to be ordered by,
	 * either a string (e.g. "id ASC, name DESC") or an array (e.g. array('id ASC', 'name DESC'))
	 * @return 查找到的第一条记录 或 false
	 * @author WuJunhua
	 * @date 2015-10-13
	 */
	public function findByAttributes($criteria, $selections = array(), $order = array()){
		if($this->isParamsEmpty($criteria)){
			return false;
		}
		$conditionArray = $this->toConditionExpress($criteria);
		if($selections){
			$conditionArray['select'] = is_array($selections) ? implode(',', $selections) : $selections;
		}
		$conditionArray['select'] = Utility::getArrayValue($conditionArray, 'select', '*');
		$conditionArray['order'] = $order ? $order : Utility::getArrayValue($conditionArray, 'order', '');
		try{
			$result = $this->dbCommand->reset()->select($conditionArray['select'])
									  ->from($this->tableName)
									  ->where($conditionArray['condition'], $conditionArray['params'])
									  ->order($conditionArray['order'])
									  ->queryRow();
			return $result;
		} catch (Exception $ex){
			return false;
		}
	}

	/**
	 * @desc 根据条件查找所有记录
	 * @param mixed $criteria 待匹配记录的(field-value)键值对数组 或者 为CDbCriteria类实例
	 * @param array $selections 查找需要返回的字段名
	 * @param mixed $order the columns (and the directions) to be ordered by,
	 * either a string (e.g. "id ASC, name DESC") or an array (e.g. array('id ASC', 'name DESC'))
	 * @param integer $limit the limit
	 * @param integer $offset the offset
	 * @return 查找到的所有条记录 或 false
	 * @author WuJunhua
	 * @date 2015-10-13
	 */
	public function findAllByAttributes($criteria, $selections = array(), $order = array(), $limit = null, $offset = null){
		if($this->isParamsEmpty($criteria)){
			return false;
		}
		$conditionArray = $this->toConditionExpress($criteria);
		if(!empty($selections)){
			$conditionArray['select'] = $selections;
		}
		if(!empty($order)){
			$conditionArray['order'] = $order;
		}
		if(!empty($limit)){
			 $conditionArray['limit'] = $limit;
		}
		if(!empty($offset)){
			$conditionArray['offset'] = $offset;
		}
		$this->dbCommand = $this->buildFindCommand($conditionArray);
		try{
			$result = $this->dbCommand->queryAll();
			return $result;
		} catch (Exception $ex){
			return false;
		}
	}

	/**
	 * @desc 根据主键Id删除记录
	 * @param mixed $pk 主键id或者id数组
	 * @return integer number of rows affected by the execution OR false
	 * @author WuJunhua
	 * @date 2015-10-13
	 */
	public function deleteByPk($pk){
		if($this->isParamsEmpty($pk)){
			return false;
		}
		$this->dbCommand->reset();
		try{
			if(is_array($pk)){
				$setValues = array();
				$idsExpress = '';
				for ($i = count($pk) - 1; $i >= 0; $i--) {
					$idsExpress .= ($idsExpress ? ',' : '').self::$paramAlias.$i;
					$setValues[self::$paramAlias.$i] = $pk[$i];
				}
				$sql = "delete from " . $this->tableName . " where " .$this->primaryKey. " in(".$idsExpress.")";
				$this->dbCommand->setText($sql);
				$affectRows = $this->dbCommand->bindValues($setValues)->execute();	
			} else{
				$affectRows = $this->dbCommand->delete($this->tableName,
				$this->primaryKey.' = :primartKey', array(':primartKey' => $pk));

			}
			return $affectRows;
		} catch (Exception $ex){
			return false;
		}
	}

	/**
	 * @desc 根据条件删除记录
	 * @param mixed $criteria 待匹配记录的(field-value)键值对数组 或者 为CDbCriteria类实例
	 * @return integer number of rows affected by the execution OR false
	 * @author WuJunhua
	 * @date 2015-10-15
	 */
	public function delete($criteria){
		if($this->isParamsEmpty($criteria)){
			return false;
		}
		$conditionArray = $this->toConditionExpress($criteria);
		try {
			$affectRows = $this->dbCommand->reset()->delete($this->tableName, 
			$conditionArray['condition'], $conditionArray['params']);
			return $affectRows;
		} catch (Exception $ex){
			return false;
		}
	}

	/**
	 * @desc 根据主键Id更新记录
	 * @param mixed $pk 记录主键id或id数组
	 * @param array $params 字段数组，键名为字段名，值为字段值
	 * @return integer number of rows affected by the execution OR false
	 * @author WuJunhua
	 * @date 2015-10-13
	 */
	public function updateByPk($pk, $params){
		if($this->isParamsEmpty($pk, $params) || !is_array($params)){
			return false;
		}
		if($this->updated){
			// 如果该表有定义更新时间戳字段，则追加更新时间戳
			$params[$this->updated] = time();
		}
		$this->dbCommand->reset();
		try{
			if(is_array($pk)){
				$setValues = array();
				$idsExpress = '';
				$j = count($pk);
				for ($i = $j - 1; $i >= 0; $i--) {
					$idsExpress .= ($idsExpress ? ',' : '').self::$paramAlias.$i;
					$setValues[self::$paramAlias.$i] = $pk[$i];
				}
				$setExpress = '';
				foreach ($params as $columnName => $value) {
					$setExpress .= ($setExpress ? ',' : '').$columnName.'='.self::$paramAlias.$j;
					$setValues[self::$paramAlias.$j] = $value;
					$j++;
				} 
				$sql = "update ".$this->tableName." set {$setExpress} where ".$this->primaryKey." in(".$idsExpress.")"; 
				$affectRows = $this->dbCommand->setText($sql)->bindValues($setValues)->execute();
			} else{
			
				$affectRows = $this->dbCommand->update($this->tableName, $params,
					$this->primaryKey.' = :primartKey', array(':primartKey' => $pk)); 
			}
			return $affectRows;
		} catch (Exception $ex){
			return false;
		}
	}

	/**
	 * @desc 根据条件更新记录
	 * @param mixed $criteria 待匹配记录的(field-value)键值对数组 或者 为CDbCriteria类实例
	 * @param array $params 要更新的的键值对数组，键名为字段名，值为字段值
	 * @return integer number of rows affected by the execution OR false
	 * @author WuJunhua
	 * @date 2015-10-20
	 */
	public function update($criteria, $params){
		if($this->isParamsEmpty($criteria, $params) || !is_array($params)){
			return false;
		}
		if($this->updated){
			// 如果该表有定义更新时间戳字段，则追加更新时间戳
			$params[$this->updated] = time();
		}
		$this->dbCommand->reset();
		try{
			$setValue = "";
			$conditionArray = "";
			foreach ($params as $key => $value) {
				$setValue .= ($setValue ? "," : "").$key."={$value}";
			}
			$conditionArray = $this->toConditionExpress($criteria);
			$affectRows = $this->dbCommand->update($this->tableName, $params,
				$conditionArray['condition'], $conditionArray['params']);
			return $affectRows;
		} catch (Exception $ex){
			return false;
		}
	}
	/**
	 * @desc 插入一条记录
	 * @param array $params 字段数组，键名为字段名，值为字段值
	 * @return mixed 插入数据的ID或false
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function insert($params, $returnRow = false){
		if($this->isParamsEmpty($params) || !is_array($params)){
			return false;
		}
		$paramsCreated = Utility::getArrayValue($params, $this->created);
		if($this->created && empty($paramsCreated)){
			// 如果该表有定义创建时间戳字段，则追加创建时间戳
			$params[$this->created] = time();
		}
		$paramsUpdated = Utility::getArrayValue($params, $this->updated);
		if($this->updated && empty($paramsUpdated)){
			// 如果该表有定义更新时间戳字段，则追加更新时间戳
			$params[$this->updated] = time();
		}
		$this->dbCommand->reset();
		try{
			$affectRows = $this->dbCommand->insert($this->tableName, $params);
			if($returnRow){
				// 返回执行成功行数
				return $affectRows;
			}
			if($affectRows){
				$id = $this->dbConnection->getLastInsertID($this->primaryKey);
				return $id;
			}
			return false;
		} catch (Exception $ex){
			if(Utility::getArrayValue($ex->errorInfo, 0) === '23000' && Utility::getArrayValue($ex->errorInfo, 1) === 1062){
				// Primary Key Duplicate, Update Record
				$pk = Utility::getArrayValue($params, $this->primaryKey);
				unset($params[$this->primaryKey]);
				return $this->updateByPk($pk, $params);
			}
			return false;
		}
	}

	/**
	 * @desc 插入多条记录(注意：某条记录待插入字段如果没有值，将默认为String '')
	 * @param array $paramsArray 包含多个字段数组的数组，字段数组键名为字段名，值为字段值
	 * @return integer number of rows affected by the execution OR false
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public function insertMulti($paramsArray){
		if($this->isParamsEmpty($paramsArray)){
			return false;
		}

		// Get all columns that need to insert
		$columns = array();
		foreach($paramsArray as $rowData){
			foreach($rowData as $columnName => $columnValue){
				if(!in_array($columnName, $columns, true))
					if($columnName !== null){
						$columns[]=$columnName;
					}
			}
		}

		$paramCount = 0;
		$paramValues = array();
		$rowInsertValuesArray = array();
		// 遍历待插入数据数组，构建插入数据sql
		foreach($paramsArray as $rowData){
			$rowValues = array();
			foreach ($columns as $columnName) {
				if(isset($rowData[$columnName])){
					$rowValues[$columnName] = self::$paramAlias.$paramCount;
					$paramValues[self::$paramAlias.$paramCount] = $rowData[$columnName];
				} else {
					$rowValues[$columnName] = '\'\'';
				}
				$paramCount++;
			}
			$rowInsertValuesArray[] = '('.implode(',', $rowValues).')';
		}

		$columnInsertNames = '('.implode(',', $columns).')';
		$rowInsertValues = implode(',', $rowInsertValuesArray);
		$sql = "INSERT INTO `{$this->tableName}` {$columnInsertNames} VALUES {$rowInsertValues};";
		try{
			$affectRows = $this->dbCommand->reset()->setText($sql)->bindValues($paramValues)->execute();
			return $affectRows;
		} catch (Exception $ex){
			return false;
		}
	}

	/**
	 * @desc 保存一条记录，记录存在则更新，不存在则插入(不建议使用，效率低，但如果需要如此严格的逻辑的时候可以使用)
	 * @param array $params 待更新的(field-value)键值对
	 * @param array $conditions 格式array('fieldName'=>'value')键名为字段名，值为要匹配的值
	 * @return integer number of rows affected by the execution OR false
	 * @author WuJunhua
	 * @date 2015-10-15
	 */
	public function save($params, $conditions = array()){
		$isNotSame = true;
		if(empty($conditions)){
			$conditions = $params;
			$isNotSame = false;
		}
		try {
			$isExists = $this->isExists($conditions);
			$affectRows = 1;
			if($isExists && $isNotSame){
				$affectRows = $this->update($conditions, $params);
				if($affectRows === 0){
					$affectRows = $this->isExists($conditions) ? 1 : 0;
				}
			} else {
				$affectRows = $this->insert($params, true);
			}
			return $affectRows;
		} catch (Exception $ex){
			return false;
		}
	}

	/**
	 * @desc 返回最近插入的一条数据的ID
	 * @return integer 最近插入的一条数据的ID
	 * @author WuJunhua
	 * @date 2015-11-11
	 */
	public function getLastInsertID(){
		try{
			$lastInsertId = $this->dbConnection->getLastInsertID($this->primaryKey);
			return $lastInsertId;
		} catch (Exception $ex){
			return 0;
		}
	}

	/**
	 * @desc 统计满足条件的记录条数
	 * @param mixed $criteria 待匹配记录的(field-value)键值对数组 或者 为CDbCriteria类实例
	 * @return 满足条件的记录条数
	 * @author WuJunhua
	 * @date 2015-10-19
	 */
	public function count($criteria){
		if($this->isParamsEmpty($criteria)){
			return false;
		}
		$conditionArray = $this->toConditionExpress($criteria);
		// Reset the select to count express
		$conditionArray['select'] = "COUNT({$this->primaryKey})";
		$this->dbCommand = $this->buildFindCommand($conditionArray);
		try{
			$rows = $this->dbCommand->queryScalar();
			return intval($rows);
		} catch (Exception $ex){
			return false;
		}
	}

	/**
	 * @desc 返回表的全部字段名的数组
	 * @return array 字段名数组
	 * @author WuJunhua
	 * @date 2015-10-20
	 */
	public function getAllFields(){
		return $this->fields;
	}

	/**
	 * @desc 返回表名
	 * @return string 表名
	 * @author WuJunhua
	 * @date 2015-11-01
	 */
	public function getTableName(){
		if(empty($this->tableName)){
			return '';
		}
		return $this->tableName;
	}

	/**
	 * @desc 返回表主键
	 * @return string 表主键
	 * @author WuJunhua
	 * @date 2015-11-03
	 */
	public function getPk(){
		if(empty($this->primaryKey)){
			return '';
		}
		return $this->primaryKey;
	}

	/**
	 * @desc 翻译条件给Where语句匹配用（暂时只支持'and'连接条件）
	 * @param mixed $criteria 要匹配记录的条件和值，键名为字段名，值为字段值 或者为CDbCriteria类实例
	 * @return mixed
	 * @author WuJunhua
	 * @date 2015-11-03
	 */
	protected function toConditionExpress($criteria){
		$where = '';
		$params = array();
		if(is_array($criteria)){
			$i = 0;
			// 键值对数组条件
			foreach ($criteria as $key => $value) {
				// 此处正则匹配有待改进以更全面的支持(暂只支持'>','<','=','>=','<=','<>','!=')
				preg_match('/[^\w\s]+\Z/', $key, $matches);
				$operator = $matches ? $matches[0] : '=';
				$field = str_replace($operator, '', $key);
				$fieldAlias = self::$paramAlias.$i;	// 用统一规则参数名, 提高函数效率
				$where .= ($where ? ' and ' : '').$field.' '.$operator.' '.$fieldAlias;
				$params[$fieldAlias] = $value;
				$i++;
			}
		}
		if($criteria instanceof CDbCriteria){
			// CDbCriteria条件实例
			return $criteria->toArray();
		}
		return array('condition' => $where, 'params' => $params);
	}

	/**
	 * @desc 创建查询command
	 * @param array $conditionArray 查询条件数组
	 * @return string
	 * @author WuJunhua
	 * @date 2015-11-06
	 */
	private function buildFindCommand($conditionArray){
		if($this->isParamsEmpty($conditionArray) || !is_array($conditionArray)){
			return $this->dbCommand;
		}

		$commandBuilder = $this->dbConnection->getCommandBuilder();
		$alias = Utility::getArrayValue($conditionArray, 'alias');
		$distinct = Utility::getArrayValue($conditionArray, 'distinct', false);
		$select = Utility::getArrayValue($conditionArray, 'select', '*');
		$join = Utility::getArrayValue($conditionArray, 'join');
		$order = Utility::getArrayValue($conditionArray, 'order');
		if(is_array($select)){
			$select = implode(",", $select);
		}
		if(is_array($join)){
			$join = implode("\n", $join);
		}
		if(is_array($order)){
			$order = implode(",", $order);
		}

		$sql = ($distinct ? "SELECT DISTINCT" : "SELECT")." {$select} FROM {$this->tableName} $alias";
		$sql = $commandBuilder->applyJoin($sql, $join);
		$sql = $commandBuilder->applyCondition($sql, Utility::getArrayValue($conditionArray, 'condition'));
		$sql = $commandBuilder->applyGroup($sql, Utility::getArrayValue($conditionArray, 'group'));
		$sql = $commandBuilder->applyHaving($sql, Utility::getArrayValue($conditionArray, 'having'));
		$sql = $commandBuilder->applyOrder($sql, $order);
		$sql = $commandBuilder->applyLimit($sql,
			Utility::getArrayValue($conditionArray, 'limit', -1),
			Utility::getArrayValue($conditionArray, 'offset', -1));

		$this->dbCommand->reset()->setText($sql)->bindValues($conditionArray['params']);
		return $this->dbCommand;
	}
}