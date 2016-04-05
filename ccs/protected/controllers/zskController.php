<?php
/**
 * @desc 知识库控制器操作类
 * @author DengShaocong
 * @date 2016-01-07
 */	
class zskController extends Controller{
	/**
	 * @desc 知识分类模板显示
	 * @author DengShaocong
	 * @date 2016-01-07
	 */
	public function actionGetZsflHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('zsk/zsfl.html');
	}
	/**
	 * @desc 知识列表模板显示
	 * @author DengShaocong
	 * @date 2016-01-07
	 */
	public function actionGetZslbHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('defaultStartTime',DEFAULT_START_TIME);
	    $this->assign('defaultCurrentTime',DEFAULT_CURRENT_TIME);
		$this->display('zsk/zslb.html');
	}
	/**
	 * @desc 添加知识分类模板显示
	 * @author DengShaocong
	 * @date 2016-01-07
	 */
	public function actionGetTjzsflHtml(){
		$parent = CInputFilter::getString('higher');
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->assign('parent', $parent);
		$this->display('zsk/tjzsfl.html');
	}
	/**
	 * @desc 添加知识库模板显示
	 * @author DengShaocong
	 * @date 2016-01-07
	 */
	public function actionGetTjzskHtml(){
		$sessionInfo = $this->getSessionInfo();
		$this->assign('sessioninfo', $sessionInfo);
		$this->display('zsk/tjzsk.html');
	}


	/**
	 * function      上传文件处理函数
	 * date          2015-11-23
	 * author        WuJunhua
	 * param    string     $name      表单的上传文件框的name名称
	 * param    int        $size      限制上传文件的大小[君子协定] 单位: 字节[例：2M为2*1024*1024]
	 * return   array                 上传成功返回2个成员，失败返回一个成员
	 **/
    public function uploads($name,$size){
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

        $path = Yii::app()->params['attachment'];    //上传文件的路径


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
        $newPath .= $file['name'];
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
	 * @desc 添加知识分类
	 * @author DengShaocong
	 * @date 2016-01-07
	 */
	public function actionAddZsfl(){
		$zsflInfo['higherlevel'] = CInputFilter::getString('parent');
		$zsflInfo['typename'] = CInputFilter::getString('flmc');
		$zsflInfo['typetext'] = CInputFilter::getString('flms');
		$zsflInfo['operylist'] = CInputFilter::getString('opeid');
		$zsflInfo['viewrylist'] = CInputFilter::getString('viewid');
		$zsflInfo['level'] = CInputFilter::getString('level');
		$zsflInfo['opetime'] = date('Y-m-d H:i:s');	
	
		$addResult = knowledgetypeModel::model()->addZsfl($zsflInfo);
		$this->renderJson($addResult);
	}

	/**
	 * @desc 获取知识分类
	 * @author DengShaocong
	 * @date 2016-01-07
	 */
	public function actionGetZsfl(){
		$result = knowledgetypeModel::model()->getTypeList();
		$this->renderJson($result);	
	}
	
	/**
	 * @desc 获取单个知识分类
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function actionGetSingleFl(){
		$id = CInputFilter::getString('id');
		$zsfl = knowledgetypeModel::model()->getSingleFl($id);
		$this->assign('id',$zsfl['id']);
		$this->assign('parent',$zsfl['higherlevel']);
		$this->assign('name',$zsfl['typename']);
		$this->assign('text',$zsfl['typetext']);
		$this->assign('opeid',$zsfl['operylist']);
		$this->assign('viewid',$zsfl['viewrylist']);
		$this->display('zsk/updatezsfl.html');
	}

	/**
	 * @desc 更新知识分类
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function actionUpdateZsfl(){
		$id = CInputFilter::getString('id');
		$zsflInfo['higherlevel'] = CInputFilter::getString('parent');
		$zsflInfo['typename'] = CInputFilter::getString('flmc');
		$zsflInfo['typetext'] = CInputFilter::getString('flms');
		$zsflInfo['operylist'] = CInputFilter::getString('opeid');
		$zsflInfo['viewrylist'] = CInputFilter::getString('viewid');
		$zsflInfo['level'] = CInputFilter::getString('level');
		$zsflInfo['opetime'] = date('Y-m-d H:i:s');	
	
		$updateResult = knowledgetypeModel::model()->updateZsfl($id,$zsflInfo);
		$this->renderJson($updateResult);
	}

	/**
	 * @desc 删除知识分类
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function actionDeleteZsfl(){
		$id = CInputFilter::getString('id');
		$deleteResult = knowledgetypeModel::model()->deleteZsfl($id);
		$this->renderJson($deleteResult);
	}

	/**
	 * @desc 添加知识库
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function actionAddZsk(){
		$zskInfo['type'] = CInputFilter::getString('zsktype');
		$zskInfo['title'] = CInputFilter::getString('title');
		$zskInfo['private'] = CInputFilter::getString('ifprivate') != "" ? CInputFilter::getString('ifprivate') : "否";
		$zskInfo['tag'] = CInputFilter::getString('tag');
		$zskInfo['source'] = CInputFilter::getString('source');
		$zskInfo['iftop'] = CInputFilter::getString('iftop');
		$zskInfo['text'] = CInputFilter::getString('text');
		$zskInfo['zsktime'] = date('Y-m-d H:i:s');
		$zskInfo['opetime'] = date('Y-m-d H:i:s');
		$zskInfo['setter'] = Yii::app()->session['name'];
		if($_FILES){
		    #处理多个文件上传就是在循环中对文件分别进行处理
		    $size=10*1024*1024;

		    foreach($_FILES as $key=>$value){
			    $file=$this->uploads($key,$size);
			    if(!isset($file[1])){  //$img[1]是上传文件的名字
			        //show_msg('图片上传失败');
			    }else{
			    	$zskInfo['attachment'] = $file[1];
			    	//$data[$key]='/uploads/product/'.$img[1];
			    }
		    }
		}
		$addResult = knowledgebaseModel::model()->addZsk($zskInfo);
		if($addResult['res'] == 'success'){
			echo '<script type="text/javascript">alert("添加成功！");window.location.href="index.php?r=zsk/GetZslbHtml";</script>';
		}else{
			echo '<script type="text/javascript">alert("添加失败");</script>';
		}
	}

	/**
	 * @desc 获取知识库列表
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function actionGetZsk(){
		$type = CInputFilter::getString('type');
		$condInfo['type'] = knowledgetypeModel::model()->getTypeAndSon($type);
		$condInfo['title'] = CInputFilter::getString('title');
		$condInfo['begindate'] = CInputFilter::getString('begindate');
		$condInfo['enddate'] = CInputFilter::getString('enddate');
		$condInfo['enddate'] = !empty($condInfo['enddate']) ? $condInfo['enddate'].DEFAULT_END_TIME : '';
		$condInfo['private'] = CInputFilter::getString('ifprivate'); 
		$result = knowledgebaseModel::model()->getZsk($condInfo);
		$this->renderJson($result);
	}

	/**
	 * @desc 获取一个知识库
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function actionGetSingleZsk(){
		$id = CInputFilter::getString('id');
		$zsk = knowledgebaseModel::model()->getSingleZsk($id);
		$attachment = $zsk['attachment'] != "" ? explode('/', $zsk['attachment'])[6] : "";
		$this->assign('id',$zsk['id']);
		$this->assign('type',$zsk['type']);
		$this->assign('private',$zsk['private']);
		$this->assign('title',$zsk['title']);
		$this->assign('tag',$zsk['tag']);
		$this->assign('resource',$zsk['source']);
		$this->assign('iftop',$zsk['iftop']);
		$this->assign('text',$zsk['text']);
		$this->assign('file',$zsk['attachment']);
		$this->assign('attachment',$attachment);
		$this->display('zsk/updatezsk.html');
	}

	/**
	 * @desc 修改知识库
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function actionUpdateZsk(){
		$id = CInputFilter::getString('id');
		$zskInfo['type'] = CInputFilter::getString('zsktype');
		$zskInfo['title'] = CInputFilter::getString('title');
		$zskInfo['private'] = CInputFilter::getString('ifprivate') != "" ? CInputFilter::getString('ifprivate') : "否";
		$zskInfo['tag'] = CInputFilter::getString('tag');
		$zskInfo['source'] = CInputFilter::getString('source');
		$zskInfo['iftop'] = CInputFilter::getString('iftop');
		$zskInfo['text'] = CInputFilter::getString('text');
		$zskInfo['opetime'] = date('Y-m-d H:i:s');
		$zskInfo['setter'] = Yii::app()->session['name'];
		if($_FILES){
		    #处理多个文件上传就是在循环中对文件分别进行处理
		    $size=10*1024*1024;

		    foreach($_FILES as $key=>$value){
			    $file=$this->uploads($key,$size);
			    if(!isset($file[1])){  //$img[1]是上传文件的名字
			        //show_msg('图片上传失败');
			    }else{
			    	$zskInfo['attachment'] = $file[1];
			    	//$data[$key]='/uploads/product/'.$img[1];
			    }
		    }
		}
		$updateResult = knowledgebaseModel::model()->updateZsk($id,$zskInfo);
		if($updateResult['res'] == 'success'){
			echo '<script type="text/javascript">alert("修改成功！");window.location.href="index.php?r=zsk/GetZslbHtml";</script>';
		}else{
			echo '<script type="text/javascript">alert("修改失败");</script>';
		}
	}

	/**
	 * @desc 删除知识库
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function actionDeleteZsk(){
		 $id = CInputFilter::getString('id');
		$deleteResult = knowledgebaseModel::model()->deleteZsk($id);
		$this->renderJson($deleteResult);
	}


	/**
	 * @desc 删除知识库中的附件
	 * @author DengShaocong
	 * @date 2016-01-08
	 */
	public function actionDeleteAttachment(){
		$id = CInputFilter::getString('id');
		$file = CInputFilter::getString('file');
		if(unlink($file)){
			$zskInfo['attachment'] = '';
			$zskInfo['setter'] = Yii::app()->session['name'];
			$updateResult = knowledgebaseModel::model()->updateZsk($id,$zskInfo);
			$this->renderJson($updateResult);
		}else{
			$result['res'] = 'fail';
			$result['mes'] = '删除失败';
			$this->renderJson($result);
		}
	}

	/**
	 * @desc 删除知识分类前的子分类验证
	 * @author DengShaocong
	 * @date 2016-04-01
	 */
	public function actionCheckZszfl(){
		$id = CInputFilter::getString('id');
		$result = knowledgetypeModel::model()->getZszfl($id);
		$this->renderJson($result);
	}
}
?>