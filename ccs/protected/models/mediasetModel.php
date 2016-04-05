<?php
/**
 * @desc 公告表相关操作类
 * @author Dengshaocong
 * @date 2015-11-16
 */
class mediasetModel extends BaseModel{
	/**
	 * @desc 覆盖父类方法返回annsetModel对象
	 * @return mediasetModel
	 * @author Dengshaocong
	 * @date 2015-11-16
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc  根据条件获取媒体资料
	 * @param array $condInfo 条件
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-11
	 */
	public function getMediaByCond($condInfo){
		$result = array();
		$media = mediasetDAO::getInstance()->getMediaByCond($condInfo);
		//判断是否查询到有数据
		if(!empty($media) && is_array($media)){
			$result['result'] = 'success';
			$result['list'] = $media['info'];
		}else{
			$result['result'] = 'error';
		}
		return $result;
	}

	/**
	 * @desc  新增媒体资料
	 * @param array $mediaInfo 媒体信息
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-11
	 */
	public function addMedia($mediaInfo){
		if(empty($mediaInfo)){
			return array('res'=>'error','mes'=>'信息不全，出错');
		}
		$mediaList = mediasetDAO::getInstance()->getMaxMediaNumber();
		$mediaNo = '';
		if(!empty($mediaList)){
			$date=substr($mediaList['mediaid'],2,4);
			if($date==date('ym')){
			  	$id = substr($mediaList['mediaid'],-4,4);
			   	$id += 1;
			   	$mediaId = sprintf("%04d",$id);
			   	$mediaNo = 'MT'.date('ym').$mediaId;
			}else{
				$id = 1;
			  	$mediaId = sprintf("%04d",$id);
			  	$mediaNo = 'MT'.date('ym').$mediaId;
			}
		}else{
			$id = '1';
			$mediaId = sprintf("%04d",$id);
			$mediaNo = 'MT'.date('ym').$mediaId;
		}
		$mediaInfo['mediaid'] = $mediaNo;	
		$result = mediasetDAO::getInstance()->insert($mediaInfo,true);
		if(empty($result)){
			return array('res'=>'false','m es'=>'添加失败');
		}
		return $result;
	}

	/**
	 * @desc  修改媒体资料
	 * @param string $id 媒体资料ID
	 * @param array $mediaInfo 媒体信息
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-11
	 */
	public function updateMedia($id,$mediaInfo){
		if(empty($id) || empty($mediaInfo)){
			return array('res'=>'error','mes'=>'信息不全，出错');
		}
		$result = mediasetDAO::getInstance()->updateByPk($id,$mediaInfo);
		if(empty($result)){
			return array('res'=>'false','mes'=>'修改失败');
		}
		return $result;
	}

	/**
	 * @desc  修改媒体资料
	 * @param string $id 媒体资料ID
	 * @param array $mediaInfo 媒体信息
	 * @return array $result 结果信息
	 * @author DengShaocong
	 * @date 2015-12-11
	 */
	public function deleteMedia($id){
		if(empty($id)){
			return array('res'=>'error','mes'=>'信息不全，出错');
		}
		$result = mediasetDAO::getInstance()->deleteByPk($id);
		if(empty($result)){
			return array('res'=>'false','mes'=>'删除失败');
		}
		return $result;
	}

	/**
	 * @desc 获取广告效果分析报表
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getGgxgfxbbByCond($cond){
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
		$result['advertFee'] = 0;//总广告费用
		$result['peopleNum'] = 0;//总客户数
		$result['peopleCost'] = 0;//单客成本
		$result['xdCount'] = 0;//总下单数
		$result['xdMoney'] = 0;//总下单金额
		$result['sdCount'] = 0;//总审单数
		$result['sdMoney'] = 0;//总审单金额
		$result['fhCount'] = 0;//总发货数
		$result['fhMoney'] = 0;//总发货金额
		$result['qsCount'] = 0;//总签收数
		$result['qsMoney'] = 0;//总签收金额
		$result['jsCount'] = 0;//总拒收数
		$result['jsMoney'] = 0;//总拒收金额
		$result['totalXDRatio'] = '0.00%';//总下单率
		$result['totalSDRatio'] = '0.00%';//总审单率
		$result['totalPayRatio'] = '0.00%';//总投产比
		$result['totalAVGPrice'] = 0;//总平均价
		$result['totalAVGCost'] = 0;//总平均成本

		$mediaList = mediasetDAO::getInstance()->getMediaByDept($cond['dept']);
		$count = count($mediaList);
		for ($i=0; $i < $count; $i++) { 
			$cond['mediatext'] = $mediaList[$i]['mediatext'];
			$demoList = $this->getGgxgfxbbDetails($cond);
			$result['list'][$i] = $demoList;
			//各项相加
			$result['advertFee'] += $demoList['fee']['fee'];
			$result['peopleNum'] += $demoList['people']['num'];
			$result['xdCount'] += $demoList['xdlist']['num'];
			$result['xdMoney'] += $demoList['xdlist']['money'];
			$result['sdCount'] += $demoList['sdlist']['num'];
			$result['sdMoney'] += $demoList['sdlist']['money'];
			$result['fhCount'] += $demoList['fhlist']['num'];
			$result['fhMoney'] += $demoList['fhlist']['money'];
			$result['qsCount'] += $demoList['qslist']['num'];
			$result['qsMoney'] += $demoList['qslist']['money'];
			$result['jsCount'] += $demoList['jslist']['num'];
			$result['jsMoney'] += $demoList['jslist']['money'];
		}
		if($result['peopleNum'] > 0){
			$result['peopleCost'] = sprintf('%.2f',$result['advertFee']/$result['peopleNum']);
		}
		if($result['xdCount'] > 0){
			$result['totalXDRatio'] = sprintf('%.2f',$result['xdCount']/$result['peopleNum']*100).'%';
		}
		if($result['sdCount'] > 0){
			$result['totalPayRatio'] = sprintf('%.2f',$result['sdMoney']/$result['advertFee']*100).'%';
			$result['totalAVGCost'] = sprintf('%.2f',$result['advertFee']/$result['sdCount']);
			$result['totalAVGPrice'] = sprintf('%.2f',$result['sdMoney']/$result['sdCount']);
			$result['totalSDRatio'] = sprintf('%.2f',$result['sdCount']/$result['xdCount']*100).'%';//审单率
		}
		return $result;
	}


	/**
	 * @desc 获取广告效果分析报表——信息
	 * @param array $cond 查询条件
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getGgxgfxbbDetails($cond){
		$result['mediatext'] = $cond['mediatext'];
		$result['peopleCost'] = 0;//单客成本
		$result['AVGPrice'] = 0;//订单均价
		$result['AVGCost'] = 0;//订单成本
		$result['xdRatio'] = '0.00%';//下单率
		$result['sdRatio'] = '0.00%';//审单率
		$result['payRatio'] = '0.00%';//投产比
		$result['fee'] = advertsetDAO::getInstance()->getGgxgfxbbFee($cond);//费用
		$result['people'] = mediasetDAO::getInstance()->getGgxgfxbbPeople($cond);//人数
		$result['xdlist'] = mediasetDAO::getInstance()->getGgxgfxbbByCond($cond,"'已确认','待发货','已发货','拒收','交易成功'");//下单
		$result['sdlist'] = mediasetDAO::getInstance()->getGgxgfxbbByCond($cond,"'待发货','已发货','拒收','交易成功'");//审单
		$result['fhlist'] = mediasetDAO::getInstance()->getGgxgfxbbByCond($cond,"'已发货','拒收','交易成功'");//发货
		$result['qslist'] = mediasetDAO::getInstance()->getGgxgfxbbByCond($cond,"'交易成功'");//签收
		$result['jslist'] = mediasetDAO::getInstance()->getGgxgfxbbByCond($cond,"'拒收'");//拒收
		if($result['people']['num'] > 0){
			$result['peopleCost'] = sprintf('%.2f',$result['fee']['fee']/$result['people']['num']);
		}
		if($result['xdlist']['num'] > 0){
			$result['xdRatio'] = sprintf('%.2f',$result['xdlist']['num']/$result['people']['num']*100).'%';
		}
		if($result['sdlist']['num'] > 0){
			$result['AVGCost'] = sprintf('%.2f',$result['fee']['fee']/$result['sdlist']['num']);
			$result['AVGPrice'] = sprintf('%.2f',$result['sdlist']['money']/$result['sdlist']['num']);
			$result['sdRatio'] = sprintf('%.2f',$result['sdlist']['num']/$result['xdlist']['num']*100).'%';
			$result['payRatio'] = sprintf('%.2f',$result['sdlist']['money']/$result['fee']['fee']*100).'%';
		}
		return $result;
	}


	/**
	 * @desc 获取所有媒体
	 * @author DengShaocong
	 * @date 2016-03-08
	 */
	public function getAllMedia(){
		$result = array();
		$mediaList = mediasetDAO::getInstance()->getAllMedia();
		if(!empty($mediaList)){
			$result['result'] = 'success';
			$result['list'] = $mediaList;
		}else{
			$result['result'] = 'error';
			$result['list'] = null;
		}
		return $result;
	}
}
?>