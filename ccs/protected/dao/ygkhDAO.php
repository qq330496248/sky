<?php
/**
 * @desc 员工考核表操作类
 * @author DengShaocong
 * @date 2015-10-28
 */
class ygkhDAO extends BaseDAO{
	/**
	 * @desc 对象实例重用
	 * @author DengShaocong
	 * @date 2015-10-28
	 * @param string $className
	 * @return ygkhDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	/**
	 * @desc 初始化
	 * @author DengShaocong
	 * @date 2015-10-28
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'khxm';
		$this->primaryKey = 'id';
	}
	/**
	 * @desc 获取考核项目列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 我的客户列表信息
	 * @author DengShaocong
	 * @date 2015-10-29
	 */
	public function getAllXm($page,$psize){	
		
		$select = "{$this->tableName}.id,{$this->tableName}.khxm,{$this->tableName}.type,{$this->tableName}.score";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						//->limit($psize, $psize * ($page - 1))
						->order("id".' DESC');
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->queryScalar();	
									   
		return $result;
	}
}
?>