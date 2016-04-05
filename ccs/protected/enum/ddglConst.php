<?php
/**
 * @desc 订单管理板块常量页面控制枚举类
 * @author WuJunhua
 * @date 2015-10-26
 */
class ddglConst{
	//订单类型
	const NORMAL   = 1; //正常单
	const EXCHANGE = 2; //换货单
	const RETRY    = 3; //重发单
	const UNUSUAL  = 4; //异常单
	const URGENT   = 5; //急发单
	const OTHERS   = 6; //异常单

	//支付方式
	const ALIPAY           = 1; //支付宝
	const TENPAY           = 2; //财付通
	const CASH_PAYMENT     = 3; //现金支付
	const CASH_ON_DELIVERY = 4; //货到付款
	const BANK_TRANSFER    = 5; //银行转账
	const FREE_PAID        = 6; //免费已付


	//快递公司
	const EMS      = 1; //豪-EMS
	const SF       = 2; //豪-顺丰
	const YUANTONG = 3; //豪-圆通

	//发票类型
	const NOT_INVOICES      = 0; //无发票
	const ADDED_INVOICES    = 1; //增值发票
	const ORDINARY_INVOICES = 2; //普通发票

	//订单状态
	const ALL             = 1; //全部
	const TRADING_SUCCESS = 2; //交易成功
	const UNCONFIRMED     = 3; //未确认
	const WAIT_PAYMENT    = 4; //等待支付
	const CONFIRMED       = 5; //已确认
	const PAID            = 6; //已支付
	const SHIPPING        = 7; //待发货
	const SHIPPED         = 8; //已发货
	const REJECTED        = 9; //拒收
	const OBSOLETED       = 10; //已作废
	const RETURRNGOODS    = 11; //已退货

	//审核状态
	const Have_CONFIRMED = 1; //已确认
	const GUEST_REVIEWED = 2; //已客审
	const CHOI_TRIALED   = 3; //已财审


	//是否记账
	const NOT_FULL_ACCOUNTING     = 1; //全未记账
	const FULL_ALREADY_ACCOUNTING = 2; //全已记账
	const NOT_ACCOUNTING1         = 3; //未记账1
	const NOT_ACCOUNTING2         = 4; //已记账2
	const ALREADY_ACCOUNTING1     = 5; //已记账1
	const ALREADY_ACCOUNTING2     = 6; //已记账2

	//订单跟进(动作说明)
	const ADD_ORDER                  = 1; //下单
	const SAVE_ORDER                 = 2; //保存订单：已收金额123
	const SET_CONFIRMED              = 3; //设为:已确认
	const CONFIRM_TO_CHECK           = 4; //确认到审单
	const CHECK_PASSED               = 5; //审单通过
	const SET_INVALID                = 6; //设为:已作废
	const UNCONFIRMED_WITHDRAWAL     = 7; //撤回未确认
	const RECEIPT_WITHDRAWAL         = 8; //撤销收货
	const CHANGE_CONTACT_INFORMATION = 9; //修改联系信息
	const CONFIRM_RECEIVING          = 10; //确认收货
	const CONFIRM_SHIPPED            = 11; //发货
	const REJECTED_RECEIVING         = 12; //拒收。原因：(物流原因、客户原因等;在拒收原因表里面拿)
	const SHIPPED_TO_REVOKE          = 13; //撤销到已发货
	const LOGISTICS_REVOCATION       = 14; //物流撤销(拼上:仓库原因等)
	const REVOCATION_RETURN          = 15; //撤销拒收
	const REVOCATION                 = 16; //撤销收货
	const PART_RETURN_GOODS          = 17; //部分退货。退货商品：
	const PART_EXCHANGES_GOODS       = 18; //部分换货。换货商品：
	const DISTRIBUTION_PERFORMANCE   = 19; //分配业绩：
	const FINANCE_CHECK_PASS         = 20; //财务审核通过
	const CHANGE_ORDER_TYPE          = 21; //更改订单类型为

	//物流撤销原因
	const CLIENT_REASON       = 1; //客户原因
	const SINGLE_TRIAL_REASON = 2; //审单原因
	const WAREHOUSE_REASON    = 3; //仓库原因
	const SOLD_OUT_REASON     = 4; //无货
	const SALES_REASON        = 5; //销售原因

	//商品退货入库状态
	const RETURNS_NOT_WAREHOUSING = 1; //退货未入仓
	const RETURNS_WAREHOUSED      = 2; //退货已入仓
	const TERMINATION             = 3; //终止

	//是否退换货(商品)
	const NORMAL_ORDER      = 1; //否
	const GOODS_NOT_RETURN  = 2; //未
	const ALREADY_RETURNS   = 3; //已
	const TERMINATE         = 4; //终

	//是否入库
	const  ISPUTSTORAGE      = 1; //是
	const  NOTPUTSTORAGE  = 2; //否
	

	//退换货标识(订单)
	const RETURN_GOODS    = 1; //退
	const EXCHANGES_GOODS = 2; //换

	//是否已确认到审单
	const HAVE_CONFIRMED_CHECKED = 1; //是
	const NOT_CONFIRMED_CHECKED  = 2; //否

	//款号已退货已换货
	const KHRETURNEDGOODS  = 1; //退货
	const KHHAVEAREPLACEMENT = 2; //换货
	const KHRECEIVING = 3; //换货

	//退换订单
	const BACKORDER = 1; //退
	const CHANGEORDER = 2; //换

	//出库入库
	const THELIBRARY = 1; //出库
	const STORAGRLIBRARY = 2; //入库

	/**
	 * @desc 出库入库选项名
	 * @author huyan
	 * @date 2016-02-18
	 */
	public static $Thelibrary = array(
		self::THELIBRARY    => '出库',
		self::STORAGRLIBRARY => '入库',
		
	);

	/**
	 * @desc 订单类型选项名
	 * @author huyan
	 * @date 2015-12-23
	 */
	public static $GirardNumber = array(
		self::KHRETURNEDGOODS    => '已退货',
		self::KHHAVEAREPLACEMENT => '已换货',
		self::KHRECEIVING        => '已收货',
		
	);

	/**
	 * @desc 是否入库选项名
	 * @author huyan
	 * @date 2015-12-25
	 */
	public static $PutStorage = array(
		self::ISPUTSTORAGE    => '是',
		self::NOTPUTSTORAGE   => '否',
	);

	
	/**
	 * @desc 退换订单选项名
	 * @author huyan
	 * @date 2015-12-25
	 */
	public static $Returnorder = array(
		self::BACKORDER    => '退',
		self::CHANGEORDER   => '换',
	);

	/**
	 * @desc 订单类型选项名
	 * @author WuJunhua
	 * @date 2015-10-27
	 */
	public static $OrderType = array(
		self::NORMAL   => '正常单',
		self::EXCHANGE => '换货单',
		self::RETRY    => '重发单',
		self::UNUSUAL  => '异常单',
		self::URGENT   => '急发单',
		self::OTHERS   => '异常单',
	);

	/**
	* @desc 支付方式选项名
	* @author WuJunhua
	* @date 2015-10-27
	*/
	public static $PayWay = array(
		self::ALIPAY           => '支付宝',
		self::TENPAY           => '财付通',
		self::CASH_PAYMENT     => '现金支付',
		self::CASH_ON_DELIVERY => '货到付款',
		self::BANK_TRANSFER    => '银行转账',
		self::FREE_PAID        => '免费已付',
	);

	/**
	* @desc 快递公司选项名
	* @author WuJunhua
	* @date 2015-10-27
	*/
	public static $CourierCompany = array(
		self::EMS      => '豪-EMS',
		self::SF       => '豪-顺丰',
		self::YUANTONG => '豪-圆通',
	);

	/**
	* @desc 发票类型选项名
	* @author WuJunhua
	* @date 2015-10-27
	*/
	public static $InvoiceType = array(
		self::NOT_INVOICES      => '无发票',
		self::ADDED_INVOICES    => '增值发票',
		self::ORDINARY_INVOICES => '普通发票',
	);

	/**
	* @desc 订单状态选项名
	* @author WuJunhua
	* @date 2015-10-27
	*/
	public static $OrderStatus = array(
		self::ALL             => '全部',
		self::TRADING_SUCCESS => '交易成功',
		self::UNCONFIRMED     => '未确认',
		self::WAIT_PAYMENT    => '等待支付',
		self::CONFIRMED       => '已确认',
		self::PAID            => '已支付',
		self::SHIPPING        => '待发货',
		self::SHIPPED         => '已发货',
		self::REJECTED        => '拒收',
		self::OBSOLETED       => '已作废',
		self::RETURRNGOODS    => '已退货',
	);

    /**
	* @desc 审核状态选项名
	* @author WuJunhua
	* @date 2015-10-27
	*/
	public static $ApprovalStatus = array(
		self::Have_CONFIRMED => '已确认',
		self::GUEST_REVIEWED => '已客审',
		self::CHOI_TRIALED   => '已财审',		
	);

    /**
	* @desc 是否记账选项名
	* @author WuJunhua
	* @date 2015-10-27
	*/
	public static $AreAccounting = array(
		self::NOT_FULL_ACCOUNTING     => '全未记账',
		self::FULL_ALREADY_ACCOUNTING => '全已记账',
		self::NOT_ACCOUNTING1         => '未记账1',
		self::NOT_ACCOUNTING2         => '已记账2',
		self::ALREADY_ACCOUNTING1     => '已记账1',
		self::ALREADY_ACCOUNTING2     => '已记账2',
	);


	/**
	* @desc 订单跟进(动作说明)
	* @author WuJunhua
	* @date 2015-11-04
	*/
	public static $OrderDynamic = array(
		self::ADD_ORDER                  => '下单',
		self::SAVE_ORDER                 => '保存订单：已收金额',
		self::SET_CONFIRMED              => '设为:已确认',
		self::CONFIRM_TO_CHECK           => '确认到审单',
		self::CHECK_PASSED               => '审单通过',
		self::SET_INVALID                => '设为:已作废',
		self::UNCONFIRMED_WITHDRAWAL     => '撤回未确认',
		self::RECEIPT_WITHDRAWAL         => '撤销收货',
		self::CHANGE_CONTACT_INFORMATION => '修改联系信息',
		self::CONFIRM_RECEIVING          => '确认收货',
		self::CONFIRM_SHIPPED            => '发货',
		self::REJECTED_RECEIVING         => '拒收。原因：',
		self::SHIPPED_TO_REVOKE          => '撤销到已发货',
		self::LOGISTICS_REVOCATION       => '物流撤销',
		self::REVOCATION_RETURN          => '撤销拒收',
		self::REVOCATION                 => '撤销收货',
		self::PART_RETURN_GOODS          => '部分退货。退货商品：',
		self::PART_EXCHANGES_GOODS       => '部分换货。换货商品：',
		self::DISTRIBUTION_PERFORMANCE   => '分配业绩：',
		self::FINANCE_CHECK_PASS         => '财务审核通过',
		self::CHANGE_ORDER_TYPE          => '更改订单类型为',
	);

	/**
	* @desc 物流撤销原因
	* @author WuJunhua
	* @date 2015-11-19
	*/
	public static $LogisticsCancelReasons = array(
		self::CLIENT_REASON           => '：客户原因',
		self::SINGLE_TRIAL_REASON     => '：审单原因',
		self::WAREHOUSE_REASON        => '：仓库原因',
		self::SOLD_OUT_REASON         => '：无货',
		self::SALES_REASON            => '：销售原因',
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
	* @desc 是否退换货(商品)
	* @author WuJunhua
	* @date 2015-12-04
	*/
	public static $WhetherReturns = array(
		self::NORMAL_ORDER     => '否',
		self::GOODS_NOT_RETURN => '未',
		self::ALREADY_RETURNS  => '已',
		self::TERMINATE        => '终',
	);

	/**
	* @desc 退换货标识(订单)
	* @author WuJunhua
	* @date 2015-12-04
	*/
	public static $GoodsReturnsLogo = array(
		self::RETURN_GOODS    => '退',
		self::EXCHANGES_GOODS => '换',
	);
	
	/**
	* @desc 是否已确认到审单
	* @author WuJunhua
	* @date 2015-12-08
	*/
	public static $WhetherConfirmedChecked = array(
		self::HAVE_CONFIRMED_CHECKED => '是',
		self::NOT_CONFIRMED_CHECKED  => '否',
	);
}