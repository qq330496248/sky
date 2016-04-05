<?php
/**
 * @desc 10.230通话记录表相关操作类
 * @author WuJunhua
 * @date 2016-02-18
 */
class cdrModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回thaaModel对象
	 * @return thaaModel
	 * @author cdrModel
	 * @date 2016-02-18
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

}