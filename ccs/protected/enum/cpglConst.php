<?php
/**
 * @desc 产品管理板块常量页面控制枚举类
 * @author WuJunhua
 * @date 2015-11-25
 */
class cpglConst{
	
	//库存异动类型
	const DIRECT_STORAGE       = 1; //直接入库
	const PO_WAREHOUSING       = 2; //采购单入库
	const LIBRARY              = 3; //出库
	const RETURN_WAREHOUSING   = 4; //退货入仓
	const OVERAGE              = 5; //盘盈
	const SHORTAGE 			   = 6; //盘亏
	const DIRECT_STORAGE_NUM   = 7; //生成直接入库单号
	const PURCHASE_STORAGE_NUM = 8; //提交保存
	const END_WAREHOUSING      = 9; //终止退货入仓
	const RETURN_SUPPLIERS     = 10; //退货供应商
	const WAREHOUSE_SCRAPPED   = 11; //仓库报废

	//商品退货入库状态
	const RETURNS_NOT_WAREHOUSING = 1; //退货未入仓
	const RETURNS_WAREHOUSED      = 2; //退货已入仓
	const TERMINATION             = 3; //终止

	//盘点状态
	const GENERATE_INVENTORY_ORDER = 1; //生成盘点单号
	const EXPORT_INVENTORY_ORDER   = 2; //导出盘点单号
	const INPUT_INVENTORY_NUMBER   = 3; //录入盘点数量
	const GENERATE_INVENTORY_FORM  = 4; //生成盘点报表
	const INVENTORY_OVER           = 5; //盘点完结
	const INVENTORY_INVALID        = 6; //盘点作废
	

	/**
	* @desc 库存异动类型
	* @author WuJunhua
	* @date 2015-11-25
	*/
	public static $StockTransactionType = array(
		self::DIRECT_STORAGE       => '直接入库',
		self::PO_WAREHOUSING       => '采购单入库',
		self::LIBRARY              => '出库',
		self::RETURN_WAREHOUSING   => '退货入仓',
		self::OVERAGE    		   => '盘盈',
		self::SHORTAGE 			   => '盘亏',
		self::DIRECT_STORAGE_NUM   => '生成直接入库单号',
		self::PURCHASE_STORAGE_NUM => '提交保存',
		self::END_WAREHOUSING      => '终止退货入仓',
		self::RETURN_SUPPLIERS     => '退货供应商',
		self::WAREHOUSE_SCRAPPED   => '仓库报废',
	);

	/**
	* @desc 商品退货入仓状态
	* @author WuJunhua
	* @date 2015-11-24
	*/
	public static $ReturnWarehousingStatus = array(
		self::RETURNS_NOT_WAREHOUSING => '退货未入仓',
		self::RETURNS_WAREHOUSED      => '退货已入仓',
		self::TERMINATION             => '终止',
	);

	/**
	* @desc 盘点状态
	* @author WuJunhua
	* @date 2015-12-01
	*/
	public static $InventoryStatus = array(
		self::GENERATE_INVENTORY_ORDER => '生成盘点单号',
		self::EXPORT_INVENTORY_ORDER   => '导出盘点单号',
		self::INPUT_INVENTORY_NUMBER   => '录入盘点数量',
		self::GENERATE_INVENTORY_FORM  => '生成盘点报表',
		self::INVENTORY_OVER           => '盘点完结',
		self::INVENTORY_INVALID        => '盘点作废',
	);

}