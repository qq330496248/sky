<?php
/**
 * @desc 采购管理板块常量页面控制枚举类
 * @author WuJunhua
 * @date 2016-03-15
 */
class cgglConst{

	//采购单状态
	const HAVE_BEEN_WAREHOUSING 	= 1; //部分已入库
	const HAVE_BEEN_SAVING	    	= 2; //已提交保存
	const ALL_HAVE_BEEN_WAREHOUSING	= 3; //已全部入库

	//采购单类型
	const PURCHASE_ORDER_STORAGE = 1; //采购单入库
	const DIRECT_STORAGE	     = 2; //直接入库

	//是否打款
	const HAVE_PLAY_MONEY 	  = 1; //已打款
	const HAVE_NOT_PLAY_MONEY = 2; //未打款

	//是否审核
	const AUDITED 	  = 1; //已审核
	const NOT_AUDITED = 2; //未审核

	/**
	* @desc 采购单状态
	* @author WuJunhua
	* @date 2016-03-14
	*/
	public static $PurchaseOrderStatus = array(
		self::HAVE_BEEN_WAREHOUSING 	 => '部分已入库',
		self::HAVE_BEEN_SAVING 			 => '已提交保存',
		self::ALL_HAVE_BEEN_WAREHOUSING  => '已全部入库',
	);

	/**
	* @desc 采购单类型
	* @author WuJunhua
	* @date 2016-03-15
	*/
	public static $PurchaseOrderType = array(
		self::PURCHASE_ORDER_STORAGE => '采购单入库',
		self::DIRECT_STORAGE 		 => '直接入库',
	);

	/**
	* @desc 是否打款
	* @author WuJunhua
	* @date 2016-03-15
	*/
	public static $WhetherPlayMoney = array(
		self::HAVE_PLAY_MONEY 	  => '已打款',
		self::HAVE_NOT_PLAY_MONEY => '未打款',
	);

	/**
	* @desc 是否审核
	* @author WuJunhua
	* @date 2016-03-15
	*/
	public static $WhetherToAudit = array(
		self::AUDITED 	  => '已审核',
		self::NOT_AUDITED => '未审核',
	);

}