<?php
/**
 * @desc 导入excel控制器操作类
 * @author Dengshaocong
 * @date 2015-11-12
 */
class excelController extends Controller{
	//导入Excel文件
	function actionUploadExcel() {	
		$filename = $_FILES['file']['name'];
    	$tmp_name = $_FILES['file']['tmp_name'];
    	$extend=strrchr($filename,'.');//获取文件后缀名（.xls , .csv）
    	$type = CInputFilter::getString('type');//获取上传的内容标示（khzl，hmddr）
//	    $dbInfo = syssetModel::model()->getDBInfo($type);//
		$info = syssetModel::model()->getDBList($type);//根据一定的顺序获取字段名
		$sum = 0;//数据条数
		$success = 0;//成功导入条数
		$false = 0;//导入失败条数
    	$error = 0;//数据错误条数
    	$none = 0;//匹配不上的数据条数
    	$alert = '';
    	$url = '';//跳转地址
    	$filePath = '';//存放地址

    	//上传文件存放路径
    	if($extend == '.xls'){
    		$filePath = 'public/xls/';
    	}else if($extend == '.csv'){
    		$filePath = 'public/csv/';
    	}
	    file_exists($filePath) ? null : mkdir($filePath);
    	$time=date("y-m-d-H-i-s");
	    //获取上传文件的扩展名
	    //上传后的文件名
	    $name=$time.$extend;
	    $uploadfile=$filePath.$name;//上传后的文件名地址 
	    //move_uploaded_file() 函数将上传的文件移动到新位置。若成功，则返回 true，否则返回 false。
	    $result=move_uploaded_file($tmp_name,$uploadfile);//假如上传到当前目录下
	    if($extend == '.xls'){	    	//excel
		    //PHPExcel的路径
		    require_once 'protected/extensions/PHPExcel.php';
		    require_once 'protected/extensions/PHPExcel/IOFactory.php';
		    require_once 'protected/extensions/PHPExcel/Reader/Excel5.php';
		    //echo $result;
		    if($result){ //如果上传文件成功，就执行导入excel操作
		    //  include "conn.php";
		        $objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format 
		        $objPHPExcel = $objReader->load($uploadfile); 
		        $sheet = $objPHPExcel->getSheet(0); 
		        $highestRow = $sheet->getHighestRow();           //取得总行数 
		        $highestColumn = $sheet->getHighestColumn(); //取得总列数
		        
		        /* 第二种方法*/
		        $objWorksheet = $objPHPExcel->getActiveSheet();
		        $highestRow = $objWorksheet->getHighestRow(); 
		        $highestColumn = $objWorksheet->getHighestColumn();
		        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);//总列数
		        $headtitle=array(); 
		        for ($row = 2;$row <= $highestRow;$row++){
		            $strs=array();
		            //注意highestColumnIndex的列数索引从0开始
		            for ($col = 0;$col < $highestColumnIndex;$col++){
		            	$strs[$info[$col]['valuetype2']] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
		            } 
		            $sum ++;
		            $addResult = array();
		            //根据不同的来源，选择不同的方法
		            switch($type){
		            	case 'khzl':
		            		$addResult = khaaModel::model()->addFromExcel($strs);
		            		break;
		            	case 'good':
		            		$addResult = cpaaModel::model()->addCpFromExcel($strs);
		            		break;
		            	case 'drkdd':
		            		$addResult = xsaaModel::model()->addOrderFromExcel($strs);
		            		break;
		            	case 'wckdd':
		            		$addResult = xsaaModel::model()->addOrderFromExcel($strs);
		            		break;
		            }
		            //结果整理
		            switch($addResult['res']){
		            	case 'success':
		            		$success ++;
		            		break;
		            	case 'false':
		            		$false ++;
		            		break;
		            	case 'error':
		            		$error ++;
		            		break;
		            	case 'same':
		            		$false ++;
		            		break;
		            	case 'hmd':
		            		$error ++;
		            		break;
		            	case 'none':
		            		$none ++;
		            		break;
		            }
		        }
		        //提示语句和跳转地址整理
		        switch($type){
		        	case 'khzl':
		        		$alert = "共有 $sum 条记录，其中成功导入 $success 条，有 $false 条记录已存在，有 $error 条非法记录";
		        		$url = 'index.php?r=xtsz/GetKhzldrHtml';
		        		break;
		        	case 'good':
		        		$alert = "共有 $sum 条记录，其中成功导入 $success 条， $false 条记录导入失败，有 $error 条非法记录";
		        		$url = 'index.php?r=cpgl/GetCplbHtml';
		        		break;
		        	case 'drkdd':
		        		$alert = "共有 $sum 条记录，其中成功导入 $success 条， $false 条记录导入失败，有 $none 条记录无法匹配，有 $error 条非法记录";
		        		$url = 'index.php?r=wlgl/GetDrddclHtml';
		        		break;
		        	case 'wckdd':
		        		$alert = "共有 $sum 条记录，其中成功导入 $success 条， $false 条记录导入失败，有 $none 条记录无法匹配，有 $error 条非法记录";
		        		$url = 'index.php?r=wlgl/GetDrddclHtml';
		        		break;	
		        }
		    }
	    }else{	    	//csv
		    if($result){ //如果上传文件成功，就执行导入csv操作
		    	$handle = fopen('http://localhost/ccs/'.$uploadfile, 'r');
		    	//fgetcsv() 解析读入的行并找出 CSV格式的字段然后返回一个包含这些字段的数组。
		    	$data = fgetcsv($handle,'，');
		    	$sum = count($data);
		    	if($type == 'hmddr'){
			    	foreach ($data as $phone) {
			    		if(preg_match("/1[3458]{1}\d{9}$/",$phone)){
			    			$listInfo['khai03'] = $phone;
			    			$result = khaiModel::model()->addListFromCsv($listInfo);
			    			if($result['res'] == 'success'){
			    				$success ++;
			    			}else{
			    				$false ++;
			    			}
			    		}else{
			    			$error ++;
			    		}
			    	}
		    	}else{

		    	}
		    	if($type == 'hmddr'){
		    		$alert = "共有 $sum 条记录，其中成功导入 $success 条，有 $false 条导入失败，有 $error 条非法记录";
		    		$url = 'index.php?r=khgl/GetHmddrHtml&status=1';
		    	}else{

		    	}
		    }
	    }
	    echo "<script>alert('$alert');window.location.href='$url';</script>";
	}
}

/* 第一种方法(导入excel)

		        //循环读取excel文件,读取一条,插入一条
		        for($j=1;$j<=$highestRow;$j++)                        //从第一行开始读取数据
		        { 
		            for($k='A';$k<=$highestColumn;$k++)            //从A列读取数据
		            { 
		                //
		                这种方法简单，但有不妥，以'\\'合并为数组，再分割\\为字段值插入到数据库
		                实测在excel中，如果某单元格的值包含了\\导入的数据会为空        
		                //
		                $str .=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'\\';//读取单元格
		            } 
		            //echo $str; die();
		            //explode:函数把字符串分割为数组。
		            $strs = explode("\\",$str);
		            $sql = "INSERT INTO te(`1`, `2`, `3`, `4`, `5`) VALUES (
		            '{$strs[0]}',
		            '{$strs[1]}',
		            '{$strs[2]}',
		            '{$strs[3]}',
		            '{$strs[4]}')";
		            //die($sql);
		            if(!mysql_query($sql))
		            {
		                return false;
		                echo 'sql语句有误';
		            }
		            $str = "";
		        }  
		        unlink($uploadfile); //删除上传的excel文件
		        $msg = "导入成功！";
		        */
 ?>
