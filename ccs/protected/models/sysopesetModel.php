<?php
/**
 * @desc ������¼����ز�����
 * @author DengShaocong
 * @date 2015-12-2
 */
class sysopesetModel extends BaseModel{
	/**
	 * @desc ���Ǹ��෽������sysopesetModel����
	 * @return sysopesetModel
	 * @author DengShaocong
	 * @date 2015-12-2
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * @desc ���һ��������¼
	 * @param array $opeInfo ������¼����
	 * @return array $result �����Ϣ
	 * @author DengShaocong
	 * @date 2015-12-2
	 */
	public function addOpeSet($opeInfo){
		if(empty($opeInfo)){
			return array('res'=>'error','mes'=>'δ֪����');
		}
		$result = sysopesetDAO::getInstance()->insert($opeInfo,true);
		if(empty($result)){
			return array('res'=>'false','mes'=>'�����������ʧ��');
		}
		return array('res'=>'success','mes'=>'��ӳɹ�');
	}

	/**
	 * @desc ����������ȡ������¼
	 * @param array $setCond ����
	 * @param int $page ҳ��
	 * @param int $psize ÿҳ��ʾ�ļ�¼����
	 * @author Dengshaocong
	 * @date  2015-12-02
	 */
	public function getCzjl($setCond,$page,$psize){
		$result = array();  //��ȡ�б����ݵĽ��
		$setList = sysopesetDAO::getInstance()->getCzjl($setCond,$page,$psize);

		//�ж��Ƿ��ѯ��������
		if(!empty($setList['info']) && is_array($setList['info'])){
			$result['result'] = 'success';
			$result['list'] = $setList['info'];
			$result['count'] = $setList['count'];
		}else{
			$result['result'] = 'error';
			$result['count'] = 0;
		}
		return $result;
	}
}
?>