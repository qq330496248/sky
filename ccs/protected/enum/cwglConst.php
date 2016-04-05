<?php
/**
 * @desc 财务管理板块常量页面控制枚举类
 * @author WuJunhua
 * @date 2015-12-10
 */
class cwglConst{
	
	//财务操作类型
	const REMEMBER1   			 = 1; //记1
	const REMEMBER2   			 = 2; //记2
	const REVOCATION1 			 = 3; //撤1
	const REVOCATION2 			 = 4; //撤2
	const REFUND      			 = 5; //退款
	const SHIPMENT    			 = 6; //运费
	const RECEIVED_CLIENT_AMOUNT = 7; //收客户金额

	//财务员操作时的订单分类
	const ORDER_SHIPMENT = 1; //出货订单
	const ORDER_RETURNS  = 2; //退换货订单

	/**
	* @desc 财务操作类型
	* @author WuJunhua
	* @date 2015-12-10
	*/
	public static $FinancialOperationType = array(
		self::REMEMBER1   			 => '记1',
		self::REMEMBER2   			 => '记2',
		self::REVOCATION1 			 => '撤1',
		self::REVOCATION2 			 => '撤2',
		self::REFUND      			 => '退款',
		self::SHIPMENT    			 => '运费',
		self::RECEIVED_CLIENT_AMOUNT => '收客户金额',
	);

	/**
	* @desc 财务员操作时的订单分类
	* @author WuJunhua
	* @date 2015-12-10
	*/
	public static $FinancialOrderCategory = array(
		self::ORDER_SHIPMENT => '出货订单',
		self::ORDER_RETURNS  => '退换货订单',
	);

}