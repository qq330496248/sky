<?php
/**
 * @desc 物流管理常量页面控制枚举类
 * @author huyan
 * @date 2015-10-27
 */
class wlglConst{
	//快递公司常量
	const EMS=0;            //邮政
	const Rhyme=1;          //韵达
	const STOExpress=2;     //申通
	const SFExpress;        //顺丰
	const ZTOExpress;       //中通
	const BestExpress;      //百世汇通
	const DebonLogistics;   //德邦物流
	const StateExpress;     //国通

	//出货单状态常量
	const NotPrintInvoices=0;   //未打印
	const PrintInvoices=1;      //已打印

	//快递单状态常量
	const NoPrintDelivery=0;   //未打印
	const PrintDelivery=1;     //已打印

	//库存数常量
	const Unlimited=0;      //不限
	const MoreThan=1;       //大于
	const BeEqual=2;        //等于
	const LessThan=3;       //小于
     

     //出库入库
	const Unlimited=0;      //不限
	const MoreThan=1;       //大于
	const BeEqual=2;        //等于
	const LessThan=3;       //小于


	/** 
	 * @desc 快递公司选项名
	 * @author huyan
	 * @date 2015-10-27
	 */
	public static $ExpressCompany = array(
		self::EMS              => '邮政',
		self::Rhyme            => '韵达'	,
		self::STOExpress       => '申通一部',	
		self::SFExpress        => '顺丰',	
		self::ZTOExpress       => '中通',	
		self::BestExpress      => '百世汇',
		self::DebonLogistics   => '德邦物',
		self::StateExpress     => '国通',
	);

	/**
	 * @desc 出货单状态选项名
	 * @author huyan
	 * @date 2015-10-27
	 */
	public static $DeliveryStatus=array(
		self::NotPrintInvoices    =>'未打印',
		self::PrintInvoices       =>'已打印',
		);

	/**
	 * @desc 快递单状态选项名
	 * @author huyan
	 * @date 2015-10-27
	 */
	public static $ExpressState=array(
		self::NoPrintDelivery    =>'未打印',
		self::PrintDelivery      =>'已打印',
		);

	/**
	 * @desc 库存数选项名
	 * @author huyan
	 * @date 2015-10-27
	 */
	public static $InventoryQuantity=array(
		self::Unlimited    =>'不限',
		self::MoreThan     =>'大于',
		self::BeEqual      =>'等于',
		self::LessThan     =>'小于',
		);


}