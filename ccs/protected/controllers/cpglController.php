<?php
/**
 * @desc 产品管理控制器操作类
 * @author DengShaocong
 * @date 2015-10-27
 */	
class cpglController extends Controller{
	 public function actionUpload()
    {var_dump($_FILES);
        $path = Yii::app()->params['upload'];
      
        if (! empty($_FILES)) {
            // 得到上传的临时文件流
            $tempFile = $_FILES['Filedata']['tmp_name'];
            // 允许的文件后缀
            $fileTypes = array(
                'jpg',
                'gif',
                'png',
                'tif'
            );
            
            $fileName = iconv("UTF-8", "GB2312", $_FILES["Filedata"]["name"]);
            $filetype = pathinfo($fileName, PATHINFO_EXTENSION);
            $newPath = $path . gmdate('Y') . '/';
            file_exists($newPath) ? null : mkdir($newPath);
            $newPath .= gmdate('m') . '/';
            file_exists($newPath) ? null : mkdir($newPath);
            $newPath .= gmdate('d') . gmdate('h') . gmdate('i') . gmdate('s') . rand(10000, 99999) . "." . $filetype;
            $fileUrl = $newPath;
            // 最后保存服务器地址
            if (! is_dir($path))
                mkdir($path);
            if (move_uploaded_file($tempFile, $fileUrl)) {
                $this->renderJson($fileUrl, false);
            } else {
                echo "false";
            }
        }
    }
	/**
	 * @desc 添加新产品模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetTjxcpHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$dept = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$dept);
		$this->display('cpgl/tjxcp.html');
	}
	/**
	 * @desc 产品列表模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetCplbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
		$this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('cpgl/cplb.html');
	}
	/**
	 * @desc 产品分类模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetCpflHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('cpgl/cpfl.html');
	}
	/**
	 * @desc 产品品牌模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetCpppHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('cpgl/cppp.html');
	}
	/**
	 * @desc 产品属性模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetCpsxHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('cpgl/cpsx.html');
	}
	/**
	 * @desc 批量修改模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetPlxgHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('cpgl/plxg.html');
	}
	/**
	 * @desc 添加产品属性分类模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetTjcpsxflHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('cpgl/tjcpsxfl.html');
	}
	/**
	 * @desc 添加产品品牌分类模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetTjcpppHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('cpgl/tjcppp.html');
	}
	/**
	 * @desc 添加产品分类模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetTjcpflHtml(){
		$sessionInfo = $this->getSessionInfo();
		$parent = CInputFilter::getString("parent");
		$this->assign('parent',$parent);
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('cpgl/tjcpfl.html');
	}
	/**
	 * @desc 产品属性详情模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetCpsxxqHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$id = CInputFilter::getString('id');
		$cpsx = cpagModel::model()->getSingleCpsx($id);
		$this->assign('parentName',$cpsx['cpag02']);
		$this->assign('id',$id);
		$this->display('cpgl/cpsxxq.html');
	}
	/**
	 * @desc 添加产品属性详情模板显示
	 * @author DengShaocong
	 * @date 2015-10-27
	 */
	public function actionGetTjcpsxxqHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$parent = CInputFilter::getString("id");
		$this->assign('id',$parent);
		$this->display('cpgl/tjcpsxxq.html');
	}
	/**
	 * @desc 产品子分类详情模板显示
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionGetCpzflHtml(){
		$parent = CInputFilter::getString('id');
		$parentfl = cpabModel::model()->getSingleCpfl($parent);
		$this->assign('parent',$parent);
		$this->assign('parentname',$parentfl['cpab02']);
		$this->display('cpgl/cpzfl.html');
	}
	/**
	 * @desc 产品批量上传模板显示
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionGetPlscHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('cpgl/plsc.html');
	}
	
	/**
	 * function      上传文件处理函数
	 * date          2015-11-23
	 * author        WuJunhua
	 * param    string     $name      表单的上传文件框的name名称
	 * param    array      $type      限制上传文件的类型
	 * param    int        $size      限制上传文件的大小[君子协定] 单位: 字节[例：2M为2*1024*1024]
	 * return   array                 上传成功返回2个成员，失败返回一个成员
	 **/
    public function uploads($name,$type,$size){
        $file = $_FILES[$name];
        # 1. 判断当前文件是否是post过来的文件  is_uploaded_file();
        if(!is_uploaded_file($file['tmp_name'])){
           return array('上传文件错误!');
        }
        # 2. 上传文件的错误状态判断 只有 error为0 的时候我们才会做文件上传处理
        if($file['error'] == 1 ){
            return array('上传文件太大!');
        }else if($file['error'] == 2 ){
            return array('上传文件太大!');
        }else if($file['error'] == 3 ){
            return array('上传文件不完整!');
        }else if($file['error'] == 4 ){
            return array('没有找到上传文件');
        }else if($file['error'] >4 ){
            return array('上传文件发生了未知错误,请联系网站工作人员!');
        }

        $pre = pathinfo($file['name'],PATHINFO_EXTENSION);
        # 上传文件的类型判断
        if(!in_array( $pre,$type) ){
            return array('上传文件的类型不正确!');
        }
        $path = Yii::app()->params['upload'];    //上传文件的路径


        $tempFile = $file['tmp_name'];
       
        $fileName = iconv("UTF-8", "GB2312", $file["name"]);
        $filetype = pathinfo($fileName, PATHINFO_EXTENSION);

        # 对上传文件大小进行判断
        if ($file['size'] > $size ){
            return array('上传文件太大!');
        }

   		//上传文件新的路径
        $newPath = $path . gmdate('Y') . '/';
        file_exists($newPath) ? null : mkdir($newPath);
        $newPath .= gmdate('m') . '/';
        file_exists($newPath) ? null : mkdir($newPath);
        # 为了防止上传文件的重命名，建议使用 微秒时间戳加上 随机数
        $newPath .= gmdate('d') . gmdate('h') . gmdate('i') . gmdate('s') . rand(10000, 99999) . "." . $filetype;
        $fileUrl = $newPath;

        # 移动上传文件到我们的目录里面去
        # move_uploaded_file();
        $res = move_uploaded_file($file['tmp_name'],$fileUrl);
        if($res){
        	echo 'success';
           return array('上传文件成功',$fileUrl);  //$newname.'.'.$pre
        }else{
        	echo 'fail';
           return array('上传文件失败');
        }
    }

    /**
	 * @desc 添加产品品牌
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionAddCppp(){
		$cpppInfo = array();
		$cpppInfo['cpad03'] = CInputFilter::getString("ppmc");
		$cpppInfo['cpad04'] = CInputFilter::getString("pysx");
		$cpppInfo['cpad05'] = CInputFilter::getString("flms");
		$cpppInfo['cpad07'] = CInputFilter::getInt("px");
		$cpppInfo['cpad08'] = CInputFilter::getString("isPub");
		$addResult = cpadModel::model()->addCppp($cpppInfo);
		$this->renderJson($addResult);
	}

	/**
	 * @desc 根据条件产品品牌
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionGetCpppByCond(){
		$result = array();  //列表信息结果
		$cpmc = CInputFilter::getString('cpmc');
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数

		$result = cpadModel::model()->GetCpppByCond($page,$psize,$cpmc);	

		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';	
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}
	/**
	 * @desc 根据主键删除一个产品品牌
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionDeleteCppp(){
		$id = CInputFilter::getString("id");
		//操作记录
		$cppp = cpadModel::model()->getSingleCppp($id);
		$opeInfo['type'] = '删除产品';
		$opeInfo['thingid'] = $id;
		$opeInfo['difference'] = $cppp['cpad03'];
		$opeInfo['ry'] = Yii::app()->session['account'].':'.Yii::app()->session['name'];
		$opeInfo['opetime'] = date('Y-m-d H:i:s');

		$result = cpadModel::model()->deleteCppp($id);
		if($result['res'] == 'success'){
			sysopesetModel::model()->addOpeSet($opeInfo);
		}
		$this->actionGetCpppByCond();
	}
	/**
	 * @desc 根据主键获取一个产品品牌信息（修改页面）
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionGetUpdateCppp(){
		$id = CInputFilter::getString("id");
		$cppp = cpadModel::model()->getSingleCppp($id);
		$this->assign('id',$cppp['cpad01']);
		$this->assign('ppmc',$cppp['cpad03']);
		$this->assign('pysx',$cppp['cpad04']);
		$this->assign('ppms',$cppp['cpad05']);
		$this->assign('px',$cppp['cpad07']);
		$this->assign('pub',$cppp['cpad08']);

		$this->display('cpgl/xgcppp.html');
	}
	/**
	 * @desc 根据主键修改一个产品品牌
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionUpdateCppp(){
		$id = CInputFilter::getString("id");
		$cpppInfo = array();
		$cpppInfo['cpad03'] = CInputFilter::getString("ppmc");
		$cpppInfo['cpad04'] = CInputFilter::getString("pysx");
		$cpppInfo['cpad05'] = CInputFilter::getString("flms");
		$cpppInfo['cpad07'] = CInputFilter::getString("px");
		$cpppInfo['cpad08'] = CInputFilter::getString("isPub");
		$cpppInfo['cpad09'] = date('Y-m-d H:i:s');

		$result = cpadModel::model()->updateCppp($id,$cpppInfo);

		$this->renderJson($result);
	}
	/**
	 * @desc 添加产品分类
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionAddCpfl(){
		$cpflInfo = array();
		//$cpppInfo['cpad07'] = CInputFilter::getString("sjfl");
		$cpflInfo['cpab02'] = CInputFilter::getString("flmc");
		$cpflInfo['cpab03'] = CInputFilter::getString("pysx");
		$cpflInfo['cpab04'] = CInputFilter::getString("flms");
		$cpflInfo['cpab05'] = CInputFilter::getString('isPub');
		$cpflInfo['cpab06'] = CInputFilter::getString("parent");

		$addResult = cpabModel::model()->addCpfl($cpflInfo);
		if(!empty($cpflInfo['cpab06'])){
			$addResult['type'] = 'zfl';
			$addResult['address'] = 'index.php?r=cpgl/GetCpzflHtml';
		}else{
			$addResult['type'] = 'fl';
			$addResult['address'] = 'index.php?r=cpgl/GetCpflHtml';
		}
		$this->renderJson($addResult);
	}
	/**
	 * @desc 获取产品分类
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionGetCpfl(){
		$result = array();  //列表信息结果
		$cpfl = CInputFilter::getString('cpfl');
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$result = cpabModel::model()->GetCpfl($cpfl,$page,$psize);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}
	/**
	 * @desc 根据条件获取产品分类
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionGetCpflByCond(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串

		$flmc = CInputFilter::getString('cpmc');
		$result = cpabModel::model()->GetCpflByCond($flmc);

		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}
	/**
	 * @desc 根据主键删除一个产品分类
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionDeleteCpfl(){
		$id = CInputFilter::getString("id");

		//操作记录
		$cpfl = cpabModel::model()->getSingleCpfl($id);
		$opeInfo['type'] = '删除产品';
		$opeInfo['thingid'] = $id;
		$opeInfo['difference'] = $cpfl['cpab02'];
		$opeInfo['ry'] = Yii::app()->session['account'].':'.Yii::app()->session['name'];
		$opeInfo['opetime'] = date('Y-m-d H:i:s');

		$result = cpabModel::model()->deleteCpfl($id);
		if($result['res'] == 'success'){
			sysopesetModel::model()->addOpeSet($opeInfo);
		}

		$this->renderJson($result);
	}
	/**
	 * @desc 根据主键获取一个产品分类信息（修改页面）
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionGetUpdateCpfl(){
		$id = CInputFilter::getString("id");
		$cpfl = cpabModel::model()->getSingleCpfl($id);
		$this->assign('id',$cpfl['cpab01']);
		$this->assign('flmc',$cpfl['cpab02']);
		$this->assign('pysx',$cpfl['cpab03']);
		$this->assign('flms',$cpfl['cpab04']);
		$this->assign('parent',$cpfl['cpab06']);

		$this->display('cpgl/xgcpfl.html');
	}
	/**
	 * @desc 根据主键修改一个产品品牌
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionUpdateCpfl(){
		$id = CInputFilter::getString("id");
		$cpflInfo = array();
		$cpflInfo['cpab02'] = CInputFilter::getString("flmc");
		$cpflInfo['cpab03'] = CInputFilter::getString("pysx");
		$cpflInfo['cpab04'] = CInputFilter::getString("flms");
		$cpflInfo['cpab05'] = CInputFilter::getString('isPub');
		$cpflInfo['cpab06'] = CInputFilter::getString('parent');
		$cpflInfo['cpab07'] = date('Y-m-d H:i:s');

		$result = cpabModel::model()->updateCpfl($id,$cpflInfo);

		$this->renderJson($result);
	}
	
	/**
	 * @desc 根据条件获取产品分类
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionGetCpzfl(){
		$parent = CInputFilter::getString('parent');
		$cpzfl = cpabModel::model()->getCpzfl($parent);
		$this->renderJson($cpzfl);
	}
	/**
	 * @desc 添加产品
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionAddCp(){
		$cpInfo = array();
		$cpInfo['cpaa02'] = CInputFilter::getString("cpmc");
		$cpInfo['cpaa03'] = CInputFilter::getString("cpfl");
		$cpInfo['cpaa04'] = CInputFilter::getString("cpzfl");			
		$cpInfo['cpaa05'] = CInputFilter::getString("sjpp");
		$cpInfo['cpaa06'] = CInputFilter::getString("xsj");
		$cpInfo['cpaa08'] = CInputFilter::getString("ifon");
		$cpInfo['cpaa12'] = CInputFilter::getString("spms");
		$cpInfo['cpaa16'] = CInputFilter::getString('cjhh');
		$cpInfo['cpaa18'] = CInputFilter::getString("gys");
		$cpInfo['cpaa10'] = CInputFilter::getString("gg");
		$cpInfo['cpaa07'] = date('Y-m-d H:i:s');
		$cpInfo['cpaa19'] = date('Y-m-d H:i:s');
		$cpInfo['cpaa09'] = CInputFilter::getString("cx") != '' ? CInputFilter::getString("cx") : '否';
		$cpInfo['cpaa20'] = CInputFilter::getString('yjsl') != '' ? CInputFilter::getString('yjsl') : 20;
		if($_FILES){
		    #处理多个文件上传就是在循环中对文件分别进行处理
		    $type=array('gif','jpg','png','jpeg');
		    $size=10*1024*1024;

		    foreach($_FILES as $key=>$value){
			    $img=$this->uploads($key,$type,$size);
			    if(!isset($img[1])){  //$img[1]是上传图片的名字
			        //show_msg('图片上传失败');
			    }else{
			    	$cpInfo['cpaa13'] = $img[1];
			    	//$data[$key]='/uploads/product/'.$img[1];
			    }
		    }
		}
		$addResult = cpaaModel::model()->addCp($cpInfo);
		/*
		产品中，产品属性的字符串拼接
		$cpsx是页面传过来的产品子属性的ID字符串
		$cpsxxq是根据$cpsx获取的数组，以及页面传过来的选中的属性内容，拼接出来的字符串数组，格式：
		str_(id) => (id)_value1|value2|value3....
		*/
		$cpsx = CInputFilter::getArray("id","string");
		if($cpsx != ''){
			for($a = 0; $a<count($cpsx); $a ++){
				$cpsxxq = array();
				@$name = "str_".$cpsx[$a];
				$cpsxArr = CInputFilter::getArray($name,"string");
				if(!empty($cpsxArr)){
					$cpsxxq["cpsxxq"] = $cpsx[$a]."_".implode("|",CInputFilter::getArray($name,"string"));
					$cpsxxq['sxid'] = $cpsx[$a];
					cpsxxqModel::model()->addCpsxxq($cpInfo['cpaa02'],$cpsxxq);
				}
			}
		}
		//部门标示
		$bmbsAll = CInputFilter::getString('bmbsAll');
		$bmbs = array();
		if($bmbsAll == ''){
			$bmbs = CInputFilter::getArray("bmbs","string");
		}
		cpahModel::model()->addBmbs($cpInfo['cpaa02'],$bmbsAll,$bmbs);
		if($addResult['res'] == 'success'){
			echo '<script>alert("添加成功！");window.location.href="index.php?r=cpgl/GetCplbHtml";</script>';
		}
		//$this->actionGetCplbHtml();
	}

	/**
	 * @desc 根据条件获取产品
	 * @author DengShaocong
	 * @date 2015-11-2
	 */
	public function actionGetCpByCond(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串

		$cond = array();
		//$cpInfo['cpaa01'] = CInputFilter::getString('id');
		$cond['cpaa02'] = CInputFilter::getString('cpmc');
		$cond['cpaa03'] = CInputFilter::getString('cpfl');
		$cond['cpaa06'] = CInputFilter::getString('cppp');
		$cond['cpaa16'] = CInputFilter::getString('cjhh');
		$cond['cpaa08'] = CInputFilter::getString("ifon");
		$cond['cpaa14'] = CInputFilter::getString("bmbs");
		$cond['begindate'] = CInputFilter::getString('begindate');
		$cond['enddate'] = CInputFilter::getString('enddate');
		$cond['enddate'] = !empty($cond['enddate']) ? $cond['enddate'].DEFAULT_END_TIME : '';
		$cond['cpaa09'] = CInputFilter::getString("cx");

		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = cpaaModel::model()->getCpByCond($page,$psize,$cond,$sign);

		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}

	/**
	 * @desc 获取产品（批量修改）
	 * @author DengShaocong
	 * @date 2015-12-1
	 */
	public function actionGetCp(){
		$result = array();  //列表信息结果

		$cond = array();
		$cond['cpaa01'] = CInputFilter::getString('cpid');
		$cond['cpaa02'] = CInputFilter::getString('cpmc');
		$cond['cpaa03'] = CInputFilter::getString('cpfl');
		$cond['cpaa04'] = CInputFilter::getString('cpzfl');
		$cond['cpaa05'] = CInputFilter::getString('cppp');

		$result = cpaaModel::model()->getCp($cond);
		$this->renderJson($result);
	}


	/**
	 * @desc 获取产品（根据产品分类）
	 * @author DengShaocong
	 * @date 2015-12-4
	 */
	public function actionGetCpByFl(){
		$result = array();  //列表信息结果
		$cpfl = CInputFilter::getString('id');
		$result = cpaaModel::model()->getCpByFl($cpfl);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取产品（根据产品品牌）
	 * @author DengShaocong
	 * @date 2015-12-4
	 */
	public function actionGetCpByPp(){
		$result = array();  //列表信息结果
		$cppp = CInputFilter::getString('id');
		$result = cpaaModel::model()->getCpByPp($cppp);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取产品（根据产品品牌）
	 * @author DengShaocong
	 * @date 2015-12-4
	 */
	public function actionGetCpBySx(){
		$result = array();  //列表信息结果
		$cpsx = CInputFilter::getString('id');
		$result = cpaaModel::model()->getCpBySx($cppp);
		$this->renderJson($result);
	}

	/**
	 * @desc 根据主键删除一个产品
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionDeleteCp(){
		$id = CInputFilter::getString("id");

		$opeInfo['type'] = '删除产品';
		$opeInfo['thingid'] = $id;
		$opeInfo['difference'] = cpaaModel::model()->getNameById($id);
		$opeInfo['ry'] = Yii::app()->session['account'].':'.Yii::app()->session['name'];
		$opeInfo['opetime'] = date('Y-m-d H:i:s');

		$opeResult = sysopesetModel::model()->addOpeSet($opeInfo);
		if($opeResult['res'] == 'success'){
			$result = cpaaModel::model()->deleteCp($id);
			cpahModel::model()->deleteBmbs($id);
			$this->renderJson($result);
		}else{

		}
	}
	/**
	 * @desc 根据主键获取一个产品信息（修改页面）
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionGetUpdateCp(){
		$id = CInputFilter::getString("id");
		$cp = cpaaModel::model()->getSingleCp($id);
		$sx = cpaaModel::model()->getCpsxParent($id);

		$this->assign('sx',$sx['info'][0]['cpag03']);		
		$this->assign('id',$cp['cpaa01']);
		$this->assign('cpmc',$cp['cpaa02']);
		$this->assign('cpfl',$cp['cpaa03']);
		$this->assign('cpzfl',$cp['cpaa04']);
		$this->assign('cppp',$cp['cpaa05']);
		$this->assign('xsj',$cp['cpaa06']);
		$this->assign('spms',$cp['cpaa12']);
		$this->assign('pic',$cp['cpaa13']);
		$this->assign('ifon',$cp['cpaa08']);
		$this->assign('gys',$cp['cpaa18']);
		$this->assign('gg',$cp['cpaa10']);
		$this->assign('bmbs',$cp['cpaa14']);
		$this->assign('cjhh',$cp['cpaa16']);
		$this->assign('cx',$cp['cpaa09']);
		$this->assign('yjsl',$cp['cpaa20']);

		$bmbs = cpahModel::model()->getBmbs($id);
		$this->assign('bmbs',$bmbs);
		$dept = deptsetModel::model()->getSaleDept();
		$this->assign('dept',$dept);

		$this->display('cpgl/xgcp.html');
	}
	/**
	 * @desc 根据主键修改一个产品
	 * @author DengShaocong
	 * @date 2015-11-3
	 */
	public function actionUpdateCp(){
		$id = CInputFilter::getString('cpid');
		$cpInfo = array();
		$cpInfo['cpaa02'] = CInputFilter::getString("cpmc");
		$cpInfo['cpaa03'] = CInputFilter::getString("cpfl");
		$cpInfo['cpaa04'] = CInputFilter::getString('cpzfl');		
		$cpInfo['cpaa05'] = CInputFilter::getString("cppp");
		$cpInfo['cpaa06'] = CInputFilter::getString("xsj");
		$cpInfo['cpaa10'] = CInputFilter::getString('gg');
		$cpInfo['cpaa08'] = CInputFilter::getString('ifon');
		$cpInfo['cpaa12'] = CInputFilter::getString("spms");
		$cpInfo['cpaa16'] = CInputFilter::getString('cjhh');
		$cpInfo['cpaa18'] = CInputFilter::getString("gys");
		$cpInfo['cpaa09'] = CInputFilter::getString("cx") != '' ? CInputFilter::getString("cx") : '否';
		$cpInfo['cpaa13'] = CInputFilter::getString('pic');
		$cpInfo['cpaa19'] = date('Y-m-d H:i:s');
		$cpInfo['cpaa20'] = !empty(CInputFilter::getString('yjsl')) ? CInputFilter::getString('yjsl') : 20;

		if($_FILES){
		    #处理多个文件上传就是在循环中对文件分别进行处理
		    $type=array('gif','jpg','png','jpeg');
		    $size=10*1024*1024;

		    foreach($_FILES as $key=>$value){
			    $img=$this->uploads($key,$type,$size);
			    if(!isset($img[1])){  //$img[1]是上传图片的名字
			        //show_msg('图片上传失败');
			    }else{
			    	$cpInfo['cpaa13'] = $img[1];
			    	//$data[$key]='/uploads/product/'.$img[1];
			    }
		    }
		}
		//先更新产品信息，再更新产品属性信息
		$updateResult = cpaaModel::model()->updateCp($id,$cpInfo);

		$cpsx = CInputFilter::getArray("id","string");
		if($cpsx != ''){
			for($a = 0; $a<count($cpsx); $a ++){
				$cpsxxq = array();
				$name = "str_".$cpsx[$a];
				$cpsxArr = CInputFilter::getArray($name,"string");
				if(!empty($cpsxArr)){
					$cpsxxq["cpsxxq"] = $cpsx[$a]."_".implode("|",CInputFilter::getArray($name,"string"));
					$cpsxxq['sxid'] = $cpsx[$a];
					$result = cpsxxqModel::model()->addCpsxxq($cpInfo['cpaa02'],$cpsxxq);
				}
			}
		}
		//部门标示
		$bmbsAll = CInputFilter::getString('bmbsAll');
		$bmbs = array();
		if($bmbsAll == ''){
			$bmbs = CInputFilter::getArray("bmbs","string");
		}
		cpahModel::model()->updateBmbs($id,$bmbsAll,$bmbs);
		if($updateResult['res'] == 'success'){
			echo '<script>alert("修改成功！");window.location.href="index.php?r=cpgl/GetCplbHtml";</script>';
		}
		//$this->actionGetCplbHtml();
	}
	/**
	 * @desc 添加产品属性
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function actionAddCpsx(){
		/*$cpsxInfo = array();
		$cpsxInfo['cpsx'] = CInputFilter::getString("cpsx");

		$addResult = cpagModel::model()->addCpsx($cpsxInfo);
		$this->actionGetCpsxHtml();*/

		$cpsxInfo = array();
		$cpsxInfo['cpag03'] = CInputFilter::getString("pid");
		if(CInputFilter::getString("pid") == ""){
			$cpsxInfo['cpag03'] = 0;
		}
		$cpsxInfo['cpag02'] = CInputFilter::getString("cpsx");
		$cpsxInfo['cpag04'] = CInputFilter::getString("str");

		$addResult = cpagModel::model()->addCpsx($cpsxInfo);
		if($cpsxInfo['cpag03'] != 0){
			$addResult['address'] = 'index.php?r=cpgl/GetCpsxxqHtml&id='.$cpsxInfo['cpag03'];
		}else{
			$addResult['address'] = 'index.php?r=cpgl/GetCpsxHtml';
		}
		$this->renderJson($addResult);
	}
	/**
	 * @desc 获取产品属性
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function actionGetCpsxByCond(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$cpsx = CInputFilter::getString('cpsx');
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数

		$result = cpagModel::model()->GetCpsxByCond($cpsx,$page,$psize);

		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;

		$this->renderJson($result);
	}

	/**
	 * @desc 根据主键获取一个产品属性（修改页面）
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function actionGetUpdateCpsx(){
		$id = CInputFilter::getString("id");
		$cpsx = cpagModel::model()->getSingleCpsx($id);
		$this->assign('id',$cpsx['cpag01']);
		$this->assign('cpsx',$cpsx['cpag02']);
		$this->assign('str',$cpsx['cpag04']);
		$this->assign('parent',$cpsx['cpag03']);
		//判断是不是子属性
		if($cpsx['cpag03'] == 0){
			$this->display('cpgl/xgcpsxfl.html');
		}else{
			$this->display('cpgl/xgcpsxxq.html');
		}
	}
	/**
	 * @desc 根据主键修改一个产品属性
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function actionUpdateCpsx(){
		$id = CInputFilter::getString('id');
		$cpsxInfo = array();
		$cpsxInfo['cpag02'] = CInputFilter::getString("cpsx");
		$cpsxInfo['cpag04'] = CInputFilter::getString("str");
		$cpsxInfo['cpag05'] = date('Y-m-d H:i:s');
		$updateResult = cpagModel::model()->updateCpsx($id,$cpsxInfo);
		$this->renderJson($updateResult);

	}
	/**
	 * @desc 根据主键删除一个产品属性
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function actionDeleteCpsx(){
		$id = CInputFilter::getString("id");
		$result = cpagModel::model()->deleteCpsx($id);

		$this->actionGetCpsxByCond();
	}

	/**
	 * @desc 获取产品属性详情（产品子属性）
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function actionGetCpsxxqByCond(){
		$result = array();  //列表信息结果

		$parent = CInputFilter::getString('parent');
		$parent == 0 ? $parent ="" :$parent = $parent;
		$result = cpagModel::model()->GetCpsxxqByCond($parent);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取产品与产品属性的关联表详情
	 * @author DengShaocong
	 * @date 2015-11-5
	 */
	public function actionGetCpsxxqFromCp(){
		$cpid = CInputFilter::getString("cpid");
		
		$result = cpsxxqModel::model()->GetCpsxxqFromCp($cpid);

		$this->renderJson($result);
	}

	/**
	 * @desc 根据主键修改一个产品属性详情
	 * @author DengShaocong
	 * @date 2015-11-4
	 */
	public function actionUpdateCpsxxq(){
		$id = CInputFilter::getString('id');
		$cpsxInfo = array();
		$cpsxInfo['cpag02'] = CInputFilter::getString("cpsx");
		$cpsxInfo['cpag04'] = CInputFilter::getString("str");
		$cpsxInfo['cpag03'] = CInputFilter::getString("pid");
		$cpsxInfo['cpag05'] = date('Y-m-d H:i:s');
		$updateResult = cpagModel::model()->updateCpsx($id,$cpsxInfo);
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 下单时根据商品编号获取商品信息
	 * @author WuJunhua
	 * @date 2015-11-12
	 */
	public function actionGetGoodList(){
		$goodId = CInputFilter::getInt('goodid');
		$result = cpaaModel::model()->getGoodList($goodId);
		$this->renderJson($result);
	}

	/**
	 * @desc 采购单入库的提交保存
	 * @author WuJunhua
	 * @date 2015-12-15
	 */
	/*public function actionGeneratePurchaseNumber(){
		$productInfo = [];
		$productInfo['cpaf07'] = date('Y-m-d H:i:s'); //异动日期(入库日期)
		$productInfo['cpaf16'] = Yii::app()->session['account']; //操作工号
		$purchaseNo = CInputFilter::getString('purchaseno');
		//单个或多个产品信息
		$goodItems = CInputFilter::getArray('goodItems','string');
		if(empty($goodItems)){
			$this->renderJson(array('res'=>'error','msg'=>'至少有一行产品行'));
		}
		$result = cpaeModel::model()->generatePurchaseNumber($productInfo,$goodItems,$purchaseNo);
		$this->renderJson($result);
	}*/

	/**
	 * @desc 产品入库(直接入库)
	 * @author WuJunhua
	 * @date 2015-11-12
	 * @modify 2016-03-16 WuJunhua 把"提交保存"和"直接入库"两个动作合并到一起
	 */
	public function actionProductDirectStorage(){
		$productInfo = [];
		$purchaseArr = []; //采购单信息
		$productInfo['cpaf07'] = date('Y-m-d H:i:s'); //异动日期(入库日期)
		$productInfo['cpaf09'] = cpglConst::$StockTransactionType[1]; //异动类型[直接入库/采购单入库/出库]
		$productInfo['cpaf16'] = Yii::app()->session['account']; //操作工号
		$purchaseArr['cgaa08'] = $productInfo['cpaf12'] = CInputFilter::getString('fare');//运费
		$purchaseArr['cgaa10'] = $productInfo['cpaf10'] = CInputFilter::getString('remark');//备注(异动原因)
		$supplierStr = CInputFilter::getString('supplier'); //供应商
		$supplierArr = explode(':', $supplierStr);
		if(count($supplierArr) == 2){
			$purchaseArr['cgaa14'] = $productInfo['cpaf13'] = $supplierArr[0]; //供应商编号
			$purchaseArr['cgaa09'] = $productInfo['cpaf14'] = $supplierArr[1];
		}

		//单个或多个产品信息
		$goodItems = CInputFilter::getArray('goodItems','string');
		$styleNum = CInputFilter::getArray('styleNum','string');
		if(empty($goodItems) || empty($styleNum)){
			$this->renderJson(array('res'=>'error','msg'=>'至少有一行产品行'));
		}
		$result = cpaeModel::model()->productDirectStorage($productInfo,$goodItems,$purchaseArr,$styleNum);
		$this->renderJson($result);
		
	}

	/**
	 * @desc 产品入库(采购单入库)
	 * @author WuJunhua
	 * @date 2015-12-16
	 */
	public function actionPurchaseOrderStorage(){
		$productInfo = [];
		$purchaseInfo = []; //采购单信息
		$purchaseNo = CInputFilter::getString('purchaseno');
		$productInfo['cpaf12'] = CInputFilter::getString('fare');//运费
		$productInfo['cpaf10'] = CInputFilter::getString('remark');//备注(异动原因)
		$purchaseInfo['cgaa09'] = $productInfo['cpaf14'] = CInputFilter::getString('supplier'); //供应商名称
		$purchaseInfo['cgaa14'] = $productInfo['cpaf13'] = CInputFilter::getString('supplierId'); //供应商编号
		$productInfo['cpaf07'] = date('Y-m-d H:i:s'); //异动日期(入库日期)
		$productInfo['cpaf09'] = cpglConst::$StockTransactionType[2]; //异动类型[直接入库/采购单入库/出库]
		$productInfo['cpaf16'] = Yii::app()->session['account']; //操作工号
		//单个或多个产品信息
		$goodItems = CInputFilter::getArray('goodItems','string');
		if(empty($goodItems)){
			$this->renderJson(array('res'=>'error','msg'=>'至少有一行产品行'));
		}
		$result = cpaeModel::model()->purchaseOrderStorage($purchaseNo,$productInfo,$goodItems,$purchaseInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 系统设置->数据清理->删除出入库记录
	 * @author huyan
	 * @date 2016-02-18
	 */
	public function actionDelStorageRecords(){
		$jlsjq= CInputFilter::getString('jlsjq');
		$jlsjz= CInputFilter::getString('jlsjz');
		$CurrentTime= date('Y-m-d H:i'); 
		$dqsj=(strtotime($CurrentTime));
		$gjsj=(strtotime($jlsjq));
		$diff = (int)(($dqsj-$gjsj)/(24*3600));
		if (!empty($jlsjq)&&empty($jlsjz)) {
			if ($diff<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的出入库记录'));
		    }
		}
		$rksjz=(strtotime($jlsjz));
		$diff1 = (int)(($dqsj-$rksjz)/(24*3600));
		if (empty($jlsjq)&&!empty($jlsjz)) {
			if ($diff1<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的出入库记录'));
		    }
		}
		if (!empty($jlsjq)&&!empty($jlsjz)) {
            if ($diff1<60) {
			    $this->renderJson(array('res'=>'error','msg'=>'不能删除60天内的出入库记录'));
		    }
		}
		$jlsjz = !empty($jlsjz) ? $jlsjz.DEFAULT_END_TIME : '';
		$crklx = CInputFilter::getString('crklx');
		$result = cpafModel::model()->DelStorageRecords($jlsjq,$jlsjz,$crklx);
		$this->renderJson($result);
	}

	/**
	 * @desc 下单时获取10条最新的商品信息
	 * @author huyan
	 * @date 2016-01-19
	 */
	public function actionGetAllGoodList(){
		$goodName = CInputFilter::getString('goodName');
		$result = cpaaModel::model()->getAllGoodList($goodName);
		if(empty($result)){
			$this->renderJson(array('res'=>'error','msg'=>'操作有误，获取商品信息失败'));
		}
		$this->renderJson($result);
	}

	/**
	 * @desc 全部产品信息
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2016-03-22
	 */
	public function actionGettsAllGood(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$cpkh = CInputFilter::getString('cpkh');
		$cpmc = CInputFilter::getString('cpmc');
		$result = cpaaModel::model()->GettsAllGood($page,$psize,$cpkh,$cpmc);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}





	/**
	 * @desc 下单时获取商品出库
	 * @author WuJunhua
	 * @date 2015-11-13
	 */
	public function actionGetGood(){
		$goodItems = CInputFilter::getArray('goodItems');
		$result = cpaaModel::model()->GetGood($goodItems);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取产品库存明细列表信息
	 * @return json $reslut 列表信息
	 * @author WuJunhua
	 * @date 2015-11-13
	 * @modify WuJunhua 2016-03-16 完善查询条件
	 */
	public function actionGetProductStockDetails(){
		$result = array();  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::BIGGER_PAGE_SIZE);  //获取每页显示的条数
		$CondList = [];
		//$CondList['cpfl1']= CInputFilter::getString('cpfl1');
		$CondList['cpmc'] = CInputFilter::getString('cpmc');
		$CondList['cpkh'] = CInputFilter::getString('cpkh');
		$CondList['cpjj'] = CInputFilter::getString('cpjj');
		$CondList['price'] = CInputFilter::getFloat('price');
		$CondList['cpsxj'] = CInputFilter::getString('cpsxj');
		$CondList['location'] = CInputFilter::getString('location');
		$CondList['stock']= CInputFilter::getInt('stock');

		$sign = CInputFilter::getInt('sign');  //导出excel标识
		$result = cpaaModel::model()->getProductStockDetails($page,$psize,$CondList,$sign);
		$pageHtml = Utility::getPage($result['count'],$psize);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 跳转批量修改页面
	 * @author Dengshaocong
	 * @date 2015-12-1
	 */
	public function actionGetPlxgMess(){
		$allCp = CInputFilter::getString('allCp');
		$allSx = CInputFilter::getString('allSx');
		$cpfl = CInputFilter::getString('cpfl');
		$method = CInputFilter::getString('method');
		$this->assign('cpfl',$cpfl);
		$this->assign('allCp',$allCp);
		$this->assign('allSx',$allSx);

		if($method == 'single'){
			$this->display('cpgl/plxg_single.html');
		}else{
			$this->display('cpgl/plxg_unity.html');
		}
	}

	/**
	 * @desc 根据ID获取产品信息，用于批量修改
	 * @author Dengshaocong
	 * @date 2015-12-1
	 */
	public function actionGetCpById(){
		$allCp = CInputFilter::getString('allCp');
		$result = cpaaModel::model()->getCpById($allCp);
		
		$this->renderJson($result);
	}

	/**
	 * @desc 批量修改（逐个）
	 * @author Dengshaocong
	 * @date 2015-12-2
	 */
	public function actionPlxgSingle(){
		$allCp = explode(" ", CInputFilter::getString('allCp'));
		$cpInfo = array();
		//产品分类
		$cpfl = "";
		//规格
		$gg = "";
		//产品品牌
		$cppp = "";
		//销售价
		$xsj = "";
		//描述
		$ms = "";
		//是否上架
		$ifon = "";
		//厂家货号
		$cjhh = "";
		//供应商
		$gys = "";
		for($i = 0; $i < count($allCp); $i ++){
			//产品分类
			$cpfl = CInputFilter::getString("cpfl_".$allCp[$i]);
			//规格
			$gg = CInputFilter::getString("gg_".$allCp[$i]);
			//产品品牌
			$cppp = CInputFilter::getString("cppp_".$allCp[$i]);
			//销售价
			$xsj = CInputFilter::getString("xsj_".$allCp[$i]);
			//描述
			$ms = CInputFilter::getString("ms_".$allCp[$i]);
			//是否上架
			$ifon = CInputFilter::getString("ifon_".$allCp[$i]);
			//厂家货号
			$cjhh = CInputFilter::getString("cjhh_".$allCp[$i]);
			//供应商
			$gys = CInputFilter::getString("gys_".$allCp[$i]);
			if(!empty($cpfl)){
				$cpInfo['cpaa03'] = $cpfl;
			}
			if(!empty($gg)){
				$cpInfo['cpaa10'] = $gg;
			}
			if(!empty($cppp)){
				$cpInfo['cpaa05'] = $cppp;
			}
			if(!empty($xsj)){
				$cpInfo['cpaa06'] = $xsj;
			}
			if(!empty($ms)){
				$cpInfo['cpaa12'] = $ms;
			}
			if(!empty($ifon)){
				$cpInfo['cpaa08'] = $ifon;
			}
			if(!empty($cjhh)){
				$cpInfo['cpaa16'] = $cjhh;
			}
			if(!empty($gys)){
				$cpInfo['cpaa18'] = $gys;
			}
			$result = cpaaModel::model()->PlUpdateCp($allCp[$i],$cpInfo);
		}
		$this->actionGetPlxgHtml();
	}

	/**
	 * @desc 批量修改（统一）
	 * @author Dengshaocong
	 * @date 2015-12-2
	 */
	public function actionPlxgUnity(){
		$allCp = explode(" ", CInputFilter::getString('allCp'));
		$cpInfo = array();
		//产品分类
		$cpfl = CInputFilter::getString("cpfl");
		//规格
		$gg = CInputFilter::getString("gg");
		//产品品牌
		$cppp = CInputFilter::getString("cppp");
		//销售价
		$xsj = CInputFilter::getString("xsj");
		//描述
		$ms = CInputFilter::getString("ms");
		//是否上架
		$ifon = CInputFilter::getString("ifon");
		//厂家货号
		$cjhh = CInputFilter::getString("cjhh");
		//供应商
		$gys = CInputFilter::getString("gys");
		if(!empty($cpfl)){
			$cpInfo['cpaa03'] = $cpfl;
		}
		if(!empty($gg)){
			$cpInfo['cpaa10'] = $gg;
		}
		if(!empty($cppp)){
			$cpInfo['cpaa05'] = $cppp;
		}
		if(!empty($xsj)){
			$cpInfo['cpaa06'] = $xsj;
		}
		if(!empty($ms)){
			$cpInfo['cpaa12'] = $ms;
		}
		if(!empty($ifon)){
			$cpInfo['cpaa08'] = $ifon;
		}
		if(!empty($cjhh)){
			$cpInfo['cpaa16'] = $cjhh;
		}
		if(!empty($gys)){
			$cpInfo['cpaa18'] = $gys;
		}
		for($i = 0; $i < count($allCp); $i ++){
			$result = cpaaModel::model()->PlUpdateCp($allCp[$i],$cpInfo);
		}
		$this->actionGetPlxgHtml();
	}

	/**
	 * @desc 检测获取已审核的采购单(退货总数 != 采购量)
	 * @author WuJunhua
	 * @date 2015-12-14
	 */
	public function actionGetAuditedPostedOrder(){
		$orderInfo = [];
		$orderInfo['purchaseNo'] = CInputFilter::getString('purchaseNo');
		if(empty($orderInfo['purchaseNo'])){
			$this->renderJson(array('res' => 'error','msg' => '操作有误，请重新操作'));
		}
		$result = cgaaModel::model()->getAuditedPostedOrder($orderInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 下单时验证输入的商品名称是否存在
	 * @author WuJunhua
	 * @date 2015-12-30
	 */
	public function actionCheckGoodsNameIsExits(){
		$goodName = CInputFilter::getString('goodName');
		$result = cpaaModel::model()->checkGoodsNameIsExits($goodName);
		$this->renderJson($result);
	}

	/**
	 * @desc 下单时验证输入的款号是否存在
	 * @author WuJunhua
	 * @date 2015-12-30
	 */
	public function actionCheckGoodsNumberIsExits(){
		$goodNumber = CInputFilter::getInt('goodNumber');
		$result = cpaaModel::model()->checkGoodsNumberIsExits($goodNumber);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取库存明细-明细
	 * @return json $reslut 列表信息
	 * @author huyan
	 * @date 2016-03-17
	 */
	public function actionGetInventoryDetail(){
		$result = [];  //列表信息结果
		$pageHtml = '';  //分页字符串
		$page = CInputFilter::getInt('page',1);  //获取页码
		$psize = CInputFilter::getInt('psize', ccsConst::DEFAULT_PAGE_SIZE);  //获取每页显示的条数
		$CondList = array();
        $CondList['batch'] = CInputFilter::getString('batch');
        $CondList['styleNum'] = CInputFilter::getString('styleNum');
        $CondList['ydsjq'] = CInputFilter::getString('ydsjq');
        $CondList['ydsjz'] = CInputFilter::getString('ydsjz');
        $CondList['ydlx'] = CInputFilter::getString('ydlx');
        $CondList['ydsjz'] = !empty($CondList['ydsjz']) ? $CondList['ydsjz'].DEFAULT_END_TIME : '';
		$result = cpafModel::model()->getInventoryDetail($page,$psize,$CondList);
		$pageHtml = Utility::getPage($result['count']);
		$pageHtml = isset($pageHtml['html']) ? $pageHtml['html'] : '';						
		$result['pageHtml'] = $pageHtml;
		$this->renderJson($result);
	}

	/**
	 * @desc 获取报警产品（数量低于预警线）
	 * @return json $reslut 列表信息
	 * @author DengShaocong
	 * @date 2016-03-24
	 */
	public function actionGetWarningProducts(){
		$result = cpaaModel::model()->getWarningProducts();
		$this->renderJson($result);
	}

}
