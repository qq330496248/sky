<?php
/**
 * @desc table model base class
 * @author Weixun Luo 
 * @date 2014-10-10
 */
abstract class BaseModel
{
	private static $_models = array();  // class name => model

	/**
	 * @desc Returns the static model of the specified table model class.
	 * @author Weixun Luo
	 * @param string $className table model class name.
	 * @return static table model instance.
	 * @date 2014-10-10
	 */
	public static function model($className = __CLASS__)
	{	
		if(isset(self::$_models[$className])){
			return self::$_models[$className];
		} else{
			$model = self::$_models[$className] = new $className(null);
			return $model;
		}
	}
}