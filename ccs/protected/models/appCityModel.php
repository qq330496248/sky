<?php
/**
 * @desc 城市表相关操作类
 * @author WuJunhua
 * @date 2015-10-22
 */
class appCityModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回appCityModel对象
	 * @return appCityModel
	 * @author WuJunhua
	 * @date 2015-10-22
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc 获取省份下面的城市信息
	 * @param string $provinceId 省份ID
	 * @return array $result 城市的结果信息
	 * @author WuJunhua
	 * @date 2015-10-26
	 */
	public function getCity($provinceId){
		$result = array();  //城市的结果信息
		$cityList = appCityDAO::getInstance()->findAllByAttributes(array('pid' => $provinceId));
		if(empty($cityList)){
			return false;
		}
		foreach($cityList as $val){
			$result[$val['cid']] = $val['cname'];	//数组重构
		}
		return $result;
	}

	/**
	 * @desc 获取条件下的区号
	 * @param array $condInfo 查询条件
	 * @param int $page 页数
	 * @param int $psize 每页显示数
	 * @return array $result 城市的结果信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function getAllCode($page,$psize,$condInfo){
		$result = array();
		$codeList = appCityDAO::getInstance()->getAllCode($page,$psize,$condInfo);
		if(!empty($codeList) && is_array($codeList)){
			$result['res'] = 'success';
			$result['list'] = $codeList['info'];
			$result['count'] = $codeList['count'];
		}else{
			$result['res'] = 'error';
			$result['list'] = array();
			$result['count'] = 0;
		}
		return $result;
	}

	/**
	 * @desc 获取单个城市信息（用于区号）
	 * @param string $id ID
	 * @return array $result 城市的结果信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function getSingleCity($id){
		if(empty($id)){
			return null;
		}
		$result = appCityDAO::getInstance()->findAllByAttributes(array('cid'=>$id));
		return $result;
	}

	/**
	 * @desc 更新城市区号
	 * @param string $id ID
	 * @return array $result 城市的结果信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function updateAreaCode($id,$cityInfo){
		if(empty($id) || empty($cityInfo)){
			return array('res'=>'error','mes'=>'修改出错');
		}
		$result = appCityDAO::getInstance()->updateByPk($id,$cityInfo);
		if(empty($result)){
			return array('res'=>'false','mes'=>'修改失败');
		}
		return array('res'=>'success','mes'=>'修改成功');
	}

	/**
	 * @desc 添加城市信息
	 * @param string $id ID
	 * @return array $result 城市的结果信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function addCity($cityInfo){
		if(empty($cityInfo)){
			return array('res'=>'error','mes'=>'添加出错');
		}
		$list = appCityDAO::getInstance()->getMaxNumber($cityInfo['pid']);
		if(!empty($list)){
			$cityInfo['cid'] = $list['cid']+100;
		}else{
			$cityInfo['cid'] = $cityInfo['pid']+100;
		}
		$result = appCityDAO::getInstance()->insert($cityInfo,true);
		if(empty($result)){
			return array('res'=>'false','mes'=>'添加失败');
		}
		return array('res'=>'success','mes'=>'添加成功');
	}


	/**
	 * @desc 删除城市信息
	 * @param string $id ID
	 * @return array $result 城市的结果信息
	 * @author DengShaocong
	 * @date 2016-01-14
	 */
	public function deleteCity($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'删除出错');
		}
		$result = appCityDAO::getInstance()->deleteByPk($id);
		if(empty($result)){
			return array('res'=>'false','mes'=>'删除失败');
		}
		return array('res'=>'success','mes'=>'删除成功');
	}


	/**
	 * @desc 获取地域统计报表——获取所有地区
	 * @param $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-04
	 */
	public function getDytjbbCityByCond($cond){
		//判断传进来的查询时间
		switch ($cond['day']) {
			case 'today':
				$cond['beginDate'] = date('Y-m-d');
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'yesterday':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -1 day '));
				break;

			case 'seven':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -7 day '));
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'thirty':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = date("Y-m-d" ,strtotime(date('Y-m-d').' -30 day '));
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'month':
				$dateList1 = explode('-', date('Y-m-d'));
				$cond['beginDate'] = $dateList1[0].'-'.$dateList1[1].'-01' ;
				$cond['endDate'] = date('Y-m-d');
				break;

			case 'lastDay':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -1 day '));
				break;

			case 'nextDay':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +1 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +1 day '));
				break;

			case 'lastSeven':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -7 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -7 day '));
				break;

			case 'nextSeven':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +7 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +7 day '));
				break;

			case 'lastThirty':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' -30 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' -30 day '));
				break;

			case 'nextThirty':
				$cond['beginDate'] = date("Y-m-d" ,strtotime($cond['beginDate'].' +30 day '));
				$cond['endDate'] = date("Y-m-d" ,strtotime($cond['endDate'].' +30 day '));
				break;

			case 'lastMonth':
				$cond['beginDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['beginDate'])).' -1 month '));
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['endDate'])).' -1 day '));
				break;

			case 'nextMonth':
				$cond['beginDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['beginDate'])).' +1 month '));
				$cond['endDate'] = date('Y-m-d' ,strtotime(date('Y-m-01' ,strtotime($cond['endDate'])).' +2 month -1 day '));
				break;

			default:

				break;
		}

		$result['result'] = 'success';
		$result['list'] = array();
		$result['beginDate'] = $cond['beginDate'];//开始时间，传回页面显示
		$result['endDate'] = $cond['endDate'];//结束时间，传回页面显示
		$result['peopleNum'] = 0;//总客户数
		$result['xdCount'] = 0;//总下单数
		$result['xdMoney'] = 0;//总下单金额
		$result['qrCount'] = 0;//总确认数
		$result['qrMoney'] = 0;//总确认金额
		$result['fhCount'] = 0;//总发货数
		$result['fhMoney'] = 0;//总发货金额
		$result['qsCount'] = 0;//总签收数
		$result['qsMoney'] = 0;//总签收金额
		$result['jsCount'] = 0;//总签收数
		$result['jsMoney'] = 0;//总签收金额

		$cityList = appCityDAO::getInstance()->findAllByAttributes(array('pid'=>$cond['pro']));
		$resultCount = 0;
		for($i = 0; $i < count($cityList); $i ++){
			$cond['pro'] = $cityList[$i]['cname'];
			$demoList = $this->getDytjbbCityDetails($cond);//临时array
			if(!empty($demoList)){
				$result['list'][$resultCount] = $demoList;
				$result['list'][$resultCount]['xdRatio'] = '0%';
				$result['list'][$resultCount]['qrRatio'] = '0%';
				if($demoList['xdOrders'] > 0 && $demoList['qrOrders'] > 0){
					$result['list'][$resultCount]['qrRatio'] = sprintf('%.2f',$demoList['qrOrders']/$demoList['xdOrders']*100).'%';
				}
				$result['peopleNum'] += $demoList['peopleNum'];//总客户数
				$result['xdCount'] += $demoList['xdOrders'];//总下单数
				$result['xdMoney'] += $demoList['xdMoney'];//总下单金额
				$result['qrCount'] += $demoList['qrOrders'];//总确认数
				$result['qrMoney'] += $demoList['qrMoney'];//总确认金额
				$result['fhCount'] += $demoList['fhOrders'];//总发货数
				$result['fhMoney'] += $demoList['fhMoney'];//总发货金额
				$result['qsCount'] += $demoList['qsOrders'];//总签收数
				$result['qsMoney'] += $demoList['qsMoney'];//总签收金额
				$result['jsCount'] += $demoList['jsOrders'];//总签收数
				$result['jsMoney'] += $demoList['jsMoney'];//总签收金额

				$resultCount ++;
			}
		}
		//如果总单数不为0，计算比例
		if($result['xdCount'] > 0){
			for($i = 0; $i < count($result['list']); $i ++){
				//计算比例
				$result['list'][$i]['xdRatio'] = sprintf('%.2f',$result['list'][$i]['xdOrders']/$result['xdCount']*100).'%';
			}
		}
		return $result;
	}

	/**
	 * @desc 获取地域统计报表——获取报表信息
	 * @param $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-04
	 */
	public function getDytjbbCityDetails($cond){
		$result['pro'] = $cond['pro'];
		$result['peopleNum'] = khaaDAO::getInstance()->getDytjbbByCondRS($cond)['num'];
		$xdList = xsaaDAO::getInstance()->getDytjbbByCond($cond,"'未确认','已确认','已发货','拒收','交易成功'");//下单
		$qrList = xsaaDAO::getInstance()->getDytjbbByCond($cond,"'已确认','已发货','拒收','交易成功'");//确认
		$fhList = xsaaDAO::getInstance()->getDytjbbByCond($cond,"'已发货','拒收','交易成功'");//发货
		$jsList = xsaaDAO::getInstance()->getDytjbbByCond($cond,"'拒收'");//拒收
		$qsList = xsaaDAO::getInstance()->getDytjbbByCond($cond,"'交易成功'");//签收

		$result['xdOrders'] = $xdList['orders'];
		$result['xdMoney'] = $xdList['money'];
		$result['qrOrders'] = $qrList['orders'];
		$result['qrMoney'] = $qrList['money'];
		$result['fhOrders'] = $fhList['orders'];
		$result['fhMoney'] = $fhList['money'];
		$result['jsOrders'] = $jsList['orders'];
		$result['jsMoney'] = $jsList['money'];
		$result['qsOrders'] = $qsList['orders'];
		$result['qsMoney'] = $qsList['money'];

		if($result['peopleNum'] == 0 && $result['xdOrders'] == 0){
			return null;
		}
		return $result;
	}
	
}

