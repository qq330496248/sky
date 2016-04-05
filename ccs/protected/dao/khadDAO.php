<?php
/**
 * @desc 客户投诉表操作类
 * @author huyan
 * @date 2015-12-04 
 */
class khadDAO extends BaseDAO{	
	/**
	 * @desc 对象实例重用
	 * @author huyan
	 * @date 2015-12-04
	 * @param string $className
	 * @return khadDAO
	 */
	public static function getInstance($className = __CLASS__){
		return parent::createInstance($className);
	}
	
	/**
	 * @desc 初始化
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function __construct(){
		$this->dbConnection = Yii::app()->db;
		$this->dbCommand = $this->dbConnection->createCommand();
		$this->tableName = 'khad';
		/*$this->tableOrder = 'khac';
		$this->tableOrderDetail = 'khah';*/
		$this->primaryKey = 'khad04';
		//$this->createtime = 'khac10';
	}

	/**
	 * @desc 获取投诉类型（大分类编号）
	 * @return array $result 投诉类型信息
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function TypeCompOptions(){
		$where['express'] = "{$this->tableName}.khad03 = :orderno";
		$where['value']['orderno'] = '';
		$select = "{$this->tableName}.khad02,{$this->tableName}.khad01,{$this->tableName}.khad05,";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khad05 ");
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	/**
	 * @desc 获取投诉类型编号信息
	 * @return array $result 客户编号信息
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function getMaxCustomerNumber(){	
		$select = "{$this->tableName}.khad01,{$this->tableName}.khad05";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.khad01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取大分类区间值
	 * @return array $result 客户编号信息
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function getBigSection(){
		$where['express'] = "{$this->tableName}.khad03 = :orderno";
		$where['value']['orderno'] = '';
		$select = "{$this->tableName}.khad05";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khad01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}

	/**
	 * @desc 获取上一级大分类的区间
	 * @return array $result 客户编号信息
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function gettUpperLevelSection($tssjfl){	
		$where['express'] = "{$this->tableName}.khad02 = :tssjfl";
		$where['value']['tssjfl'] = $tssjfl;
		$select = "{$this->tableName}.khad05,{$this->tableName}.khad01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khad01 ".' DESC')
						->limit(1,0);
		$result = $this->dbCommand->queryRow();
		return $result;
	}


	/**
	 * @desc 查询大分类id
	 * @return array $result 大分类id列表信息
	 * @author huyan
	 * @date 2015-12-04
	 */
	public function getUpperLevel($tssjfl){
		
		$where['express'] = "{$this->tableName}.khad02 = :tssjfl";
		$where['value']['tssjfl'] = $tssjfl;

		$select = "{$this->tableName}.khad01,{$this->tableName}.khad02,{$this->tableName}.khad03,{$this->tableName}.khad05";
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
	}

	/**
	 * @desc 获取小分类区间最大值
	 * @return array $result 大分类id列表信息
	 * @author huyan
	 * @date 2015-12-07
	 */
	public function getSmallTypUpperLevel($tslxbh){
		$where['express'] = "{$this->tableName}.khad03 = :tslxbh";
		$where['value']['tslxbh'] = $tslxbh;
		$select = "{$this->tableName}.khad05,{$this->tableName}.khad03,{$this->tableName}.khad01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khad01 ".' DESC')
						->limit(1,0);	
		$result = $this->dbCommand->queryRow();
		return $result;
	}
	/**
	 * @desc //判断这个分类是大分类还是小分类
	 * @return array $result 大分类id列表信息
	 * @author huyan
	 * @date 2015-12-08
	 */
	public function getdafenlClasscation($orderno){
		$where['express'] = "{$this->tableName}.khad03 = :ordernull AND {$this->tableName}.khad01 = :orderno";
		$where['value']['ordernull'] = '';
		$where['value']['orderno'] = $orderno;


		$select = "{$this->tableName}.khad03";//,{$this->tableName}.khad01
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result['info'] = $this->dbCommand->queryAll();
		/*print_r($khzl2Client);die;*/	
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}

	/**
	 * @desc 查询这个大分类下面有没有小分类
	 * @return array $result 大分类id列表信息
	 * @author huyan
	 * @date 2015-12-08
	 */
	public function getSmallClasscation($orderno,$oderlist){
		$where['express'] = "{$this->tableName}.khad03 = :oderlist";//{$this->tableName}.khad05 = :orderno AND 
		//$where['value']['orderno'] = $orderno;
		$where['value']['oderlist'] = $oderlist;
		$select = "{$this->tableName}.khad05,{$this->tableName}.khad03,{$this->tableName}.khad01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value'])
						->order("{$this->tableName}.khad05 ".' DESC')
						->limit(1,0);	
		$result = $this->dbCommand->queryRow();
		return $result;
	}


	/**
	 * @desc 查询所有小分类
	 * @return array $result 大分类id列表信息
	 * @author huyan
	 * @date 2015-12-08
	 */
	public function getAllBubordinateClass($orderno){
		$where['express'] = "{$this->tableName}.khad03 = :orderno";
		$where['value']['orderno'] = $orderno;
		$select = "{$this->tableName}.khad03,{$this->tableName}.khad01";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->where($where['express'],$where['value']);
		$result['info'] = $this->dbCommand->queryAll();
		/*print_r($khzl2Client);die;*/	
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->where($where['express'],$where['value'])
										   ->queryScalar();
		return $result;
	}
	/**
	 * @desc 获取投诉类型列表信息
	 * @param int $page 页码
	 * @param int $psize 每页显示的记录条数
	 * @return array $result 客户投诉列表信息
	 * @author huyan
	 * @date 2015-12-08
	 */
	public function getComplaintTypeList($page,$psize){
		$select = "{$this->tableName}.khad01,{$this->tableName}.khad02,{$this->tableName}.khad05,{$this->tableName}.khad03";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						->order("{$this->tableName}.khad05 ")
						->limit($psize, $psize * ($page - 1));
		$result['info'] = $this->dbCommand->queryAll();
		$result['count'] = $this->dbCommand->reset()->select('COUNT(1)')
										   ->from($this->tableName)
										   ->queryScalar();			   
		return $result;

	}

	/**
	 * @desc 获取所有投诉类型名称
	 * @return array $result 
	 * @author huyan
	 * @date 2015-12-08
	 */
	public function getTypecompOptions(){

		/*$where['express'] = "{$this->tableName}.khad03 = :orderno";
		$where['value']['orderno'] = '';*/
		$select = "{$this->tableName}.khad02";
		$this->dbCommand->reset();
		$this->dbCommand->select($select)
						->from($this->tableName)
						//->where($where['express'],$where['value'])
						->order("{$this->tableName}.khad05 ");
		$result = $this->dbCommand->queryAll();
		return $result;
	}

	
}