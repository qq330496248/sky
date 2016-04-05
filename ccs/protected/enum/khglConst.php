<?php
/**
 * @desc 客户管理常量页面控制枚举类
 * @author huyan
 * @date 2015-10-26
 */
class khglConst{
	//工号所属组常量
	const AllGroups = 0;       //所有组       
	const SalesDepartment = 1; //销售部
	const SalesReturn1 = 2;    //销售回访一
	const SecondGroup1 = 3;    //二线一组
	const SecondGroup2 = 4;    //二线二组
	const SecondGroup3 = 5;    //二线三组
	const SecondGroup4 = 6;    //二线四组
	const PublicGroup = 7;     //公共组

	//手机类型常量
	const FirstChoice = 0;      //首选
	const Disable = 1;          //停用
	const OneSelf = 2;          //本人
	const Husband = 3;          //老公
	const Wife = 4;             //老婆
	const Family = 5;           // 家人
	const Friend = 6;           //朋友
	const Others = 7;           //其他

	//客户等级常量
	const ALevel  = 0;                 //A
	const BLevel = 1;                  //B
	const CLevel= 2 ;                  //C
	const InvalidData = 3;             //无效资料
	const NoAnswer = 4;                //无人接听
	const OutStock = 5;                //缺货
    const EmptyNumber = 6;             // 空号
	const Deal = 7;                    //成交
	const Test = 8;                    //测试
	const CodeMissing = 9;             //区号缺0
	const MajorClient = 10;            //主要客户
	const HasSet = 11;                 //已定
	const NewCustomer = 12;            //新发书客户
	const TwoSingle = 13;              //电视二卖成单
	const RadioDeal = 14;              //电台成交数据
	const NotPropolis = 15;            //蜂胶未成交
	const Osteopathy = 16;             //骨病成交
	const Propolis = 17;               //蜂胶成交
	const NotOsteopathy = 18;          // 骨病未成交
	const PropolisPurchase = 19;       //蜂胶复购
	const NotReduce = 20;              //减肥未成交
	const AgriculturalTea = 21;        //农机茶未成交
	const NoAnswerPhone = 22;          // 无人接听/挂电话
	const NotRecognize = 23;           //不承认/空号/停机

	//客户意向常量
	const BoneDisease = 0;     //骨病
	const ElderlyHealth = 1;   //老人保健
	const Reduce = 2;          //减肥
	const Oatmeal = 3;         //麦片
	const Cosmetology = 4;     //美容
	const Oat=5;               //燕麦

   	//客户进线方式常量
	const ShortSessage = 0;       //短信
	const Telephones = 1;         // 电话
	const Business = 2;           //商务通
	const ChatSoftware = 3;       // QQMSN
	const Wang = 4;               //旺旺
	const Active = 5;             //主动
	const Other = 6;              //其他

	//客户来源常量

	const MongoliaTV = 0;      //内蒙古卫视
	const RadioTV = 1;         //电台
	const CorpsTV = 2;         //兵团卫视

	//客户学历常量
	const PrimarySchool = 0;             //小学
	const JuniorMiddle = 1;              //初中
	const SeniorHigh = 2;                //高中
	const JuniorCollege = 3;             //大专
	const SecondarySpecialized = 4;      //中专
	const Undergraduate = 5;             //本科
	const Master = 6;                    //硕士
	const LearnedScholar = 7;            //博士以上

	//客户职业常量
	const Students = 0;                 //学生
	const ComputerIT = 1;               //计算机/互联网/IT
	const Communication = 2;            //通讯/电子/仪表仪器
	const Sale = 3;                     //销售/市场
	const BusinessPR = 4;               //公关/商务
	const PurchaseTrade = 5;            //采购/贸易
	const PersonnelMatters = 6;         //行政/人事/文员
	const SeniorManage = 7;             //高级管理
	const PrivateOwner = 8;             //私营企业
	const CivilServants = 9;            //公务员/国家干部
	const Insurance = 10;               //金融/保险/地产
	const EducationTrain = 11;          //教育/培训
	const Soldier = 12;                 //军人/警察
	const ServiceTrade = 13;            //服务行业
	const AgricultureForestr = 14;      //农林牧业
	const MedicalCare = 15;             //医疗美容
	const FreeOccupation = 16;          //自由职业
	const OtherOccupations = 17;        //其他

	//客户收入常量
	const sanwan = 0;          //3万以下    
  	const sandaoliu = 1;       //3-6万        
	const liudaoshi = 2;       //6-10万       
	const ershi = 3;           //10-20万    
	const wushi = 4;           //20-50万   
	const wushiAbove = 5;      //50万以上    

	//短信状态
	const SendOut = 0;        //发送    
  	const Receive = 1;       //接收

  	//性别  
  	const Male = 0;        //男    
  	const Female = 1;       //女

	/**
	 * @desc 工号所在组选项名
	 * @author huyan
	 * @date 2015-10-26
	 */
	public static $GroupsType = array(
		self::AllGroups       => '所有组',
		self::SalesDepartment => '销售部',	
		self::SalesReturn1    => '销售回访一部',	
		self::SecondGroup1    => '二线一组',	
		self::SecondGroup2    => '二线二组',	
		self::SecondGroup3    => '二线三组',
		self::SecondGroup4    => '二线四组',
		self::PublicGroup     => '公共组',
	);


	/**
	* @desc 手机类型选项名
	* @author huyan
	* @date 2015-10-26
	*/
	public static $PhoneType=array(
		self::FirstChoice  =>'首选',
		self::Disable      =>'停用',
		self::OneSelf      =>'本人',
		self::Husband      =>'老公',
		self::Wife         =>'老婆',
		self::Family       =>'家人',
		self::Friend       =>'朋友',
		self::Others       =>'其他',
	);


	/**
	* @desc 客户等级选项名
	* @author huyan
	* @date 2015-10-26
	*/
	public static $CustomerLevel=array(
		self::ALevel             =>'A',
		self::BLevel             =>'B',
		self::CLevel             =>'C',
		self::InvalidData        =>'无效资料',
		self::NoAnswer           =>'无人接听',
		self::OutStock           =>'缺货',
		self::EmptyNumber        =>'空号',
		self::Deal               =>'成交',
		self::Test               =>'测试',
		self::CodeMissing        =>'区号缺0',
		self::MajorClient        =>'主要客户',
		self::HasSet             =>'已定',
		self::NewCustomer        =>'新发书客户',
		self::TwoSingle          =>'电视二卖成单',
		self::RadioDeal          =>'电台成交数据',
		self::NotPropolis        =>'蜂胶未成交',
		self::Osteopathy         =>'骨病成交',
		self::Propolis           =>'蜂胶成交',
		self::NotOsteopathy      =>'骨病未成交',
		self::PropolisPurchase   =>'蜂胶复购',
		self::NotReduce          =>'减肥未成交',
		self::AgriculturalTea    =>'农机茶未成交',
		self::NoAnswerPhone      =>'无人接听/挂电话',
		self::NotRecognize       =>'不承认/空号/停机',
		);

	

	/**
	* @desc 客户意向选项名
	* @author huyan
	* @date 2015-10-26
	*/

	public static $CustomerIntention=array(
		self::BoneDisease    =>'骨病',
		self::ElderlyHealth  =>'老人保健',
		self::Reduce         =>'减肥',
		self::Oatmeal        =>'麦片',
		self::Cosmetology    =>'美容',
		self::Oat            =>'燕麦',

		);


	/**
	* @desc 进线方式选项名
	* @author huyan
	* @date 2015-10-26
	*/

	public static $IntoLine= array(
		self::ShortSessage   =>'短信',
		self::Telephones     =>'电话',
		self::Business       =>'商务通',
		self::ChatSoftware   =>'QQMSN',
		self::Wang           =>'旺旺',
		self::Active         =>'主动',
		self::Other          =>'其他',

		);

    /**
	* @desc 客户来源选项名
	* @author huyan
	* @date 2015-10-26
	*/
	public static $ClientSource=array(
		self::MongoliaTV   =>'内蒙古卫视',
		self::RadioTV      =>'电台',
		self::CorpsTV      =>'兵团卫视',
		
	);


	/**
	* @desc 学历选项名
	* @author huyan
	* @date 2015-10-26
	*/
	public static $Education=array(
		self::PrimarySchool          =>'小学',
		self::JuniorMiddle           =>'初中',
		self::SeniorHigh             =>'高中',
		self::JuniorCollege          =>'大专',
		self::SecondarySpecialized   =>'中专',
		self::Undergraduate          =>'本科',
		self::Master                 =>'硕士',
		self::LearnedScholar         =>'博士以上',

		);


	/**
	* @desc 职业选项名
	* @author huyan
	* @date 2015-10-26
	*/
	public static $Occupation=array(


		self::Students           =>'学生',
		self::ComputerIT         =>'计算机/互联网/IT',
		self::Communication      =>'通讯/电子/仪表仪器',
		self::Sale               =>'销售/市场',
		self::BusinessPR         =>'公关/商务',
		self::PurchaseTrade      =>'采购/贸易',
		self::PersonnelMatters   =>'行政/人事/文员',
		self::SeniorManage       =>'高级管理',
		self::PrivateOwner       =>'私营企业',
		self::CivilServants      =>'公务员/国家干部',
		self::Insurance          =>'金融/保险/地产',
		self::EducationTrain     =>'教育/培训',
		self::Soldier            =>'军人/警察',
		self::ServiceTrade       =>'服务行业',
		self::AgricultureForestr =>'农林牧业',
		self::MedicalCare        =>'医疗美容',
		self::FreeOccupation     =>'自由职业',
		self::OtherOccupations   =>'其他',


		);


	/**
	* @desc 收入选项名
	* @author huyan
	* @date 2015-10-26
	*/

	public static $Income=array(
		self::sanwan       =>'3万以下',
		self::sandaoliu    =>'3-6万',
		self::liudaoshi    =>'6-10万',
		self::ershi        =>'10-20万',
		self::wushi        =>'20-50万',
		self::wushiAbove   =>'50万以上',

		);

	/**
	* @desc 短信状态
	* @author huyan
	* @date 2015-11-23
	*/
	public static $ShortMessage=array(
  	    self::SendOut       =>'接收',
  	    self::Receive       =>'发送',

		);

   /**
	* @desc 性别
	* @author huyan
	* @date 2015-12-01
	*/
	public static $CustomerGender=array(
  	    self::Male       =>'男',
  	    self::Female     =>'女',

		);
}