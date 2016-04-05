<?php
/**
 * @desc 订单拒收原因表相关操作类
 * @author WuJunhua
 * @date 2015-11-20
 */
class xsaeModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回xsaaModel对象
	 * @return xsaeModel
	 * @author WuJunhua
	 * @date 2015-11-20
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	
	/**
	 * @desc 获取所有拒收原因分类
	 * @return array $result 所有拒收原因分类
	 * @author WuJunhua
	 * @date 2015-11-20
	 */
	public function getAllRejectReasons(){
		$result = xsaeDAO::getInstance()->getAllRejectReasons();
		if(empty($result)){
			return array('res'=>'error','msg'=>'获取拒收原因分类失败');
		}
		return $result;
	}
	

	/**
	 * @desc 获取退货原因统计
	 * @param array $cond 查询条件
	 * @param int $sign 导出excel标识
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
	public function getThyytjByCond($cond,$sign){
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
		$result['thNum'] = 0;//总退货数
		$result['thMoney'] = 0;//总退货金额

		$xsaaList = xsaaDAO::getInstance()->getAllOrdersAndMoney($cond);
		$result['fhOrders'] = $xsaaList['orders'];//总发货数
		$result['fhMoney'] = $xsaaList['money'];//总发货金额

		$result['totalRatio'] = '0%';//总退货率

		$reasonList = xsaeDAO::getInstance()->getAllReasonsHasReject();
		$count = count($reasonList);
		/*$higherType = $reasonList[0]['xsae02'];
		//筛选大类，（【物流原因：快递人员服务差】，【物流原因：派送范围超区】 => 【物流原因：快递人员服务差】，【：派送范围超区】）
		for ($i = 1; $i < $count; $i++) { 
			if($reasonList[$i]['xsae02'] == $higherType){
				$reasonList[$i]['xsae02'] = '';
			}else{
				$higherType = $reasonList[$i]['xsae02'];
			}
		}*/
		$listNum = 0;
		for ($i=0; $i < $count; $i++) { 
			//发货数量赋值
			$cond['fhOrders'] = $result['fhOrders'];
			$cond['fhMoney'] = $result['fhMoney'];
			$cond['type'] = $reasonList[$i]['xsae02'];
			$cond['reason'] = $reasonList[$i]['xsaf02'];
			$demoList = $this->getThyytjDetails($cond);
			if($demoList['thOrders'] > 0){
				$result['list'][$listNum] = $demoList;
				$result['list'][$listNum]['thRatio'] = '0%';

				$demoList['fhOrders'] = $xsaaList['orders'];
				$demoList['fhMoney'] = $xsaaList['money'];

				$result['thNum'] += $demoList['thOrders'];
				$result['thMoney'] += $demoList['thMoney'];

				$listNum ++;
			}
		}
		//如果时间段内发货不为零，且有退货数量，则计算总退货比例
		if($result['fhOrders'] > 0 && $result['thNum'] > 0){
			$listCount = count($result['list']);
			for($i = 0; $i < $listCount; $i ++){
				$result['list'][$i]['thRatio'] = sprintf('%.2f',$result['list'][$i]['thOrders']/$result['fhOrders']*100).'%';
			}
			$result['totalRatio'] = sprintf('%.2f',$result['thNum']/$result['fhOrders']*100).'%';
		}
		
		if($sign == 1){
			//导出客户订单excel
			$titleArray = [];  //excel标题数组
			$selectColumnArr = [];  //查询的字段的数组
			$selectColumnStr = '';  //查询的字段的字符串
			$titleArr = syssetDAO::getInstance()->getTitleInfo(ccsConst::$EXCELLIST[30]); //导出退货原因统计报表excel的标题
			if(!empty($titleArr) && is_array($titleArr)){
				foreach($titleArr as $val){
					$titleArray[] = $val['valuetype3'];	//数组重构
				}
				$reportList = []; //报表显示信息
				foreach ($result['list'] as $key => $value) {
					$reportList[$key]['type'] = $value['type'];
					$reportList[$key]['reason'] = $value['reason'];
					$reportList[$key]['fhOrders'] = $value['fhOrders'];
					$reportList[$key]['fhMoney'] = $value['fhMoney'];
					$reportList[$key]['thOrders'] = $value['thOrders'];
					$reportList[$key]['thMoney'] = $value['thMoney'];
					$reportList[$key]['thRatio'] = $value['thRatio'];
				}		
			}
			
			if(!empty($reportList) && is_array($reportList)){
				$data = $reportList;
				$fileName = 'jx';  
				$tableName = '退货原因统计报表';
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
	 * @desc 获取退货原因统计
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-01
	 */
	public function getThyytjDetails($cond){
		$result['fhOrders'] = $cond['fhOrders']; 
		$result['fhMoney'] = $cond['fhMoney'];
		$result['type'] = $cond['type'];
		$result['reason'] = $cond['reason'];
		$thList = xsaaDAO::getInstance()->getThyytjDetails($cond);

		$result['thOrders'] = $thList['orders'];
		$result['thMoney'] = $thList['money'];

		return $result;
	}

	/**
	 * @desc 新增退货原因
	 * @param array $info 内容
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function addThyy($info){
		if(empty($info)){
			return array('mes'=>'error','msg'=>'添加出错');
		}
		$result = xsaeDAO::getInstance()->insert($info);
		if(empty($result)){
			return array('mes'=>'false','msg'=>'添加失败');
		}
		return array('mes'=>'false','msg'=>'添加成功','http'=>'index.php?r=xtsz/GetThyyHtml');
	}

	/**
	 * @desc 获取单个退货原因（大类）信息
	 * @param array $info 内容
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function getSingleReason($id){
		if(empty($id)){
			return array('mes'=>'error','msg'=>'出错！');
		}
		$result = xsaeDAO::getInstance()->findByAttributes(array('xsae01'=>$id));
		return $result;
	}

	/**
	 * @desc 删除退货原因（大类）
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function deleteThyy($id){
		if(empty($id)){
			return array('mes'=>'error','msg'=>'删除出错');
		}
		$result = xsaeDAO::getInstance()->deleteByPk($id);
		if(empty($result)){
			return array('mes'=>'false','msg'=>'删除失败');
		}
		return array('mes'=>'success','msg'=>'删除成功');
	}

	/**
	 * @desc 更新退货原因（大类）
	 * @param string $id ID
	 * @param array $info 内容
	 * @author DengShaocong
	 * @date 2016-03-16
	 */
	public function updateThzyy($id,$info){
		if(empty($id) || empty($info)){
			return array('mes'=>'error','msg'=>'修改出错');
		}
		$result = xsaeDAO::getInstance()->updateByPk($id,$info);
		if(empty($result)){
			return array('mes'=>'false','msg'=>'修改失败');
		}
		return array('mes'=>'false','msg'=>'修改成功','http'=>'index.php?r=xtsz/GetThyyHtml');
	}
}

