<?php
/**
 * @desc 快递公司表相关操作类
 * @author DengShaocong
 * @date 2015-11-9
 */
class sykdgssetModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回sykdgssetModel对象
	 * @return sykdgssetModel
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 * @desc 获取快递公司信息
	 * @return array $result 列表信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function getAllKdgs(){
		$result = array();  //获取列表数据的结果
		$groupList = sykdgssetDAO::getInstance()->getAllKdgs();

		//判断是否查询到有数据
		if(!empty($groupList['info']) && is_array($groupList['info'])){
			$result['result'] = 'success';
			$result['list'] = $groupList['info'];
			$result['count'] = $groupList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}
	/**
	 * @desc 添加快递公司
	 * @param array $bmfzInfo 快递公司资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function addKdgs($kdgsInfo){
		if(empty($kdgsInfo)){
			return array('res'=>'false','msg'=>'相关信息不完整，添加失败');
		}
		$result = sykdgssetDAO::getInstance()->insert($kdgsInfo);
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，添加失败');
		}
		return array('res'=>'success','msg'=>'添加成功');
	}
	/**
	 * @desc 更改快递公司
	 * @param array $id ID
	 * @param array $bmfzInfo 快递公司资料
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function updateKdgs($id,$kdgsInfo){
		if(empty($id) || empty($kdgsInfo)){
			return array('res'=>'error','msg'=>'修改错误');
		}
		$result = sykdgssetDAO::getInstance()->updateByPk($id,$kdgsInfo);

		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'修改成功');
	}
	/**
	 * @desc 根据主键删除一个快递公司
	 * @param int $id ID
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-11-9
	 */
	public function deleteKdgs($id){
		if(empty($id)){
			return array('res'=>'error','msg'=>'删除错误');
		}
		$result = sykdgssetDAO::getInstance()->deleteByPk($id);
		
		if(empty($result) || $result == false){
			return array('res'=>'false','msg'=>'操作出错，删除失败');
		}
		return array('res'=>'success','msg'=>'删除成功');
	}

	/**
	 * @desc  获取快递拒收统计——获取快递公司信息
	 * @param array $cond 查询条件
	 * @param int $sign 导出excel标识
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getKdjstjByCond($cond,$sign){
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
		$result['beginDate'] = $cond['beginDate'];//开始时间，传回页面显示
		$result['endDate'] = $cond['endDate'];//结束时间，传回页面显示
		$result['fhCount'] = 0;//总发货数
		$result['fhMoney'] = 0;//总发货金额
		$result['jsCount'] = 0;//总拒收数
		$result['jsMoney'] = 0;//总拒收金额
		$result['qsCount'] = 0;//总签收数
		$result['qsMoney'] = 0;//总签收金额
		$result['totalJsRatio'] = '0%';//拒收比例
		$result['totalQsRatio'] = '0%';//签收比例
		$result['list'] = array();
		$kdgsList = $this->getAllKdgs()['list'];
		if(empty($kdgsList)){
			return array('res'=>'error');
		}
		for($i = 0; $i < count($kdgsList); $i ++){
			$cond['kdgs'] = $kdgsList[$i]['kdgstext'];
			$demoList =  $this->getKdjstjDetails($cond);//临时array
			$result['list'][$i] = $demoList;
			//各项相加
			$result['fhCount'] += $demoList['fhOrders'];
			$result['fhMoney'] += $demoList['fhMoney'];
			$result['jsCount'] += $demoList['jsOrders'];
			$result['jsMoney'] += $demoList['jsMoney'];
			$result['qsCount'] += $demoList['qsOrders'];
			$result['qsMoney'] += $demoList['qsMoney'];
			//计算比例
			$result['list'][$i]['jsRatio'] = '0%';
			$result['list'][$i]['qsRatio'] = '0%';
			if($demoList['fhOrders'] > 0){
				if($demoList['jsOrders'] > 0){
					$result['list'][$i]['jsRatio'] = sprintf('%.2f',$demoList['jsOrders']/$demoList['fhOrders'] * 100).'%';
				}
				if($demoList['qsOrders'] > 0){
					$result['list'][$i]['qsRatio'] = sprintf('%.2f',$demoList['qsOrders']/$demoList['fhOrders'] * 100).'%';
				}
			}
		}
		//计算总数的比例
		if($result['fhCount'] > 0){
			if($result['jsCount'] > 0){
				$result['totalJsRatio'] = sprintf('%.2f',$result['jsCount']/$result['fhCount'] * 100).'%';
			}
			if($result['qsCount'] > 0){
				$result['totalQsRatio'] = sprintf('%.2f',$result['qsCount']/$result['fhCount'] * 100).'%';
			}
		}

		if($sign == 1){
			//导出客户订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[28]); //导出快递拒收统计报表excel的标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}
				$reportList = []; //报表显示信息
				foreach ($result['list'] as $key => $value) {
					$reportList[$key]['kdgs'] = $value['kdgs'];
					$reportList[$key]['fhOrders'] = $value['fhOrders'];
					$reportList[$key]['fhMoney'] = $value['fhMoney'];
					$reportList[$key]['jsOrders'] = $value['jsOrders'];
					$reportList[$key]['jsMoney'] = $value['jsMoney'];
					$reportList[$key]['jsRatio'] = $value['jsRatio'];
					$reportList[$key]['qsOrders'] = $value['qsOrders'];
					$reportList[$key]['qsMoney'] = $value['qsMoney'];
					$reportList[$key]['qsRatio'] = $value['qsRatio'];
				}		
			}
			
			if(!empty($reportList) && is_array($reportList)){
				$data = $reportList;
				$fileName = 'jx';  
				$tableName = '快递拒收统计报表';
				$downUrl = CExcelHelper::getInstance()->createExcelTable($titleArray, $data, $fileName, $tableName,true);

				if($downUrl){
					$result['result'] = 'exportExcel';
					$result['url'] = $downUrl;
				}else{
					$result['result'] = 'error';
					$result['msg'] = '导出失败';
				}	
			}else{
				$result['result'] = 'error';
				$result['msg'] = '没有数据可以导出';
			}
			return $result;
		}

		return $result;
	}

	/**
	 * @desc  获取快递拒收统计——获取统计信息
	 * @param array $cond 查询条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2016-02-24
	 */
	public function getKdjstjDetails($cond){
		$result['kdgs'] = $cond['kdgs'];
		$fhList = xsaaDAO::getInstance()->getKdjstjByCond($cond,"'已发货','拒收','交易成功'");//发货数
		$jsList = xsaaDAO::getInstance()->getKdjstjByCond($cond,"'拒收'");//拒收数
		$qsList = xsaaDAO::getInstance()->getKdjstjByCond($cond,"'交易成功'");//签收数

		$result['fhOrders'] = $fhList['orders'];
		$result['fhMoney'] = $fhList['money'];
		$result['jsOrders'] = $jsList['orders'];
		$result['jsMoney'] = $jsList['money'];
		$result['qsOrders'] = $qsList['orders'];
		$result['qsMoney'] = $qsList['money'];

		return $result;
	}
}
?>