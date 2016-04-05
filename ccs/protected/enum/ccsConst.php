<?php
/**
 * @desc ccs系统常量
 * @author WuJunhua
 * @date 2015-10-21
 */
class ccsConst{

	// 默认显示分页数
	const DEFAULT_PAGE_SIZE = 10;
	const BIGGER_PAGE_SIZE = 20; //较大的分页数


	//导出excel的指定列表
	const CLIENT_DATA_LIST          = 1;  //我的(下属)客户资料列表
	const CLIENT_FOLLOW_LIST        = 2;  //客户跟进记录列表
	const CLIENT_COMPLAINTS_LIST    = 3;  //客户投诉列表
	const CLIENT_ORDERS_LIST        = 4;  //客户订单、订单审核、财务审核列表
	const LOGISTICS_DELIVERY_LIST   = 5;  //物流发货(待发货)列表
	const INVENTORY_DETAIL_LIST     = 6;  //库存明细列表
	const RETURN_ORDER_RECORD_LIST  = 7;  //退货订单记录列表
	const RETURN_STYLE_SUMMARY_LIST = 8;  //退货款号汇总列表
	const RETURN_STYLE_DETAILS_LIST = 9;  //退货款号明细列表
	const STORAGE_RECORDS_LIST      = 10; //库存异动明细列表
	const INVENTORY_DETAILS_LIST    = 11; //盘点明细列表
	const INVENTORY_RECORD_LIST     = 12; //库存盘点记录列表
	const SHIPMENT_ORDER_LIST       = 13; //出货订单列表
	const SHIPMENTS_SUMMARY_LIST    = 14; //款号出货汇总列表
	const SHIPMENTS_DETAILS_LIST    = 15; //款号出货明细列表
	const EXCHANGE_SUMMARY_LIST     = 16; //退换货订单汇总列表
	const EXCHANGE_DETAILS_LIST     = 17; //退换货订单明细列表
	const PRODUCTS_LIST		        = 18; //产品列表
	const JOB_NUMBER_LIST		    = 19; //工号列表
	const RETURN_SUPPLIERS_LIST		= 20; //退货供应商记录列表
	const STAFF_RESULT_COUNT_REPORT = 21; //员工业绩统计报表
	const GROUP_RESULT_COUNT_REPORT = 22; //分组业绩统计报表(销售)
	const DAILY_OUTWAREHOUSE_REPORT = 23; //每日出库报表
	const JBCLIENTNUMS_COUNT_REPORT = 24; //工号客户数统计报表
	const ORDER_TRACK_COUNT_REPORT  = 25; //订单追踪统计报表
	const AREA_COUNT_REPORT  		= 26; //地域统计报表
	const COMPLAINTS_COUNT_REPORT   = 27; //投诉统计报表
	const EX_REJECTION_COUNT_REPORT = 28; //快递拒收统计报表
	const PRODUCT_SALE_COUNT_REPORT = 29; //产品销售统计报表
	const REASONRETURN_COUNT_REPORT = 30; //退货原因统计报表
	const RETURN_PRO_COUNT_REPORT   = 31; //退货产品统计报表
	const PRO_CATEGORY_COUNT_REPORT = 32; //产品类别统计报表

	/**
	 * @desc 导出excel的指定列表
	 * @author WuJunhua
	 * @date 2016-02-01
	 */
	public static $EXCELLIST = array(
		self::CLIENT_DATA_LIST          => 'khzl',
		self::CLIENT_FOLLOW_LIST        => 'khgj',
		self::CLIENT_COMPLAINTS_LIST    => 'khts',
		self::CLIENT_ORDERS_LIST        => 'khdd',
		self::LOGISTICS_DELIVERY_LIST   => 'wlfh',
		self::INVENTORY_DETAIL_LIST     => 'kcmx',
		self::RETURN_ORDER_RECORD_LIST  => 'thddjl',
		self::RETURN_STYLE_SUMMARY_LIST => 'thkhhz',
		self::RETURN_STYLE_DETAILS_LIST => 'thkhmx',
		self::STORAGE_RECORDS_LIST      => 'kcydmx',
		self::INVENTORY_DETAILS_LIST    => 'pdmx',
		self::INVENTORY_RECORD_LIST     => 'kcpdjl',
		self::SHIPMENT_ORDER_LIST       => 'chdd',
		self::SHIPMENTS_SUMMARY_LIST    => 'khchhz',
		self::SHIPMENTS_DETAILS_LIST    => 'khchmx',
		self::EXCHANGE_SUMMARY_LIST     => 'thhddhz',
		self::EXCHANGE_DETAILS_LIST     => 'thhddmx',
		self::PRODUCTS_LIST		        => 'cplb',
		self::JOB_NUMBER_LIST		    => 'ghlb',
		self::RETURN_SUPPLIERS_LIST		=> 'thgysjl',
		self::STAFF_RESULT_COUNT_REPORT => 'ygyjtjbb',
		self::GROUP_RESULT_COUNT_REPORT => 'fzxstjbb',
		self::DAILY_OUTWAREHOUSE_REPORT => 'mrckbb',
		self::JBCLIENTNUMS_COUNT_REPORT => 'ghkhstjbb',
		self::ORDER_TRACK_COUNT_REPORT  => 'ddzztj',
		self::AREA_COUNT_REPORT		    => 'dytjbb',
		self::COMPLAINTS_COUNT_REPORT   => 'tstjbb',
		self::EX_REJECTION_COUNT_REPORT => 'kdjsbb',
		self::PRODUCT_SALE_COUNT_REPORT => 'cpxstj',
		self::REASONRETURN_COUNT_REPORT => 'thyytj',
		self::RETURN_PRO_COUNT_REPORT   => 'thcptj',
		self::PRO_CATEGORY_COUNT_REPORT => 'cplbtjbb',
		
	);

}