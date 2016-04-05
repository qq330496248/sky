<?php
/**
* @desc 后台数据备份+还原等操作类
* @author WuJunhua
* @date 2016-02-15
*/
class DataBackController extends Controller{
    private $config;
    private $mr;
    //  public $layout=false;//设置当前默认布局文件为假
 
    //初始化相关属性
    /*  public function __construct(){ 
        Yii::import('application.extensions.MysqlBack', TRUE);//导入Mysql备份类库  
        $connect_str = parse_url(Yii::app()->db->connectionString);
        $re_str = explode('=', implode('=', explode(';', $connect_str['path'])));//取得数据库IP,数据库名
        $this->config = array( //设置参数
            'host' => $re_str[1],
            'dbname'=> $re_str[3],
            'port' => 3306,
            'db_username' => Yii::app()->db->username,
            'db_password' => Yii::app()->db->password,
            'db_prefix' => Yii::app()->db->tablePrefix,
            'charset' => Yii::app()->db->charset,
            'path' => Yii::app()->basePath . '/../protected/data/backup/',       //定义备份文件的路径
            'isCompress' => 1,                   //是否开启gzip压缩{0为不开启1为开启}
            'isDownload' => 0                    //压缩完成后是否自动下载{0为不自动1为自动}
        );
        $this->mr = new MysqlBack($this->config);    
    }*/
 
    //----替代上面的方法的临时方法
    /**
     * @desc 初始化相关属性
     * @author WuJunhua
     * @date 2016-02-15
     */
    public function initNew(){
        Yii::import('application.extensions.MysqlBack', TRUE);  //导入Mysql备份类库  
        $connect_str = parse_url(Yii::app()->db->connectionString);
        $re_str = explode('=', implode('=', explode(';', $connect_str['path']))); //取得数据库IP,数据库名
        $this->config = array( //设置参数
            'host' => $re_str[1],
            'dbname'=> $re_str[3],
            'port' => 3306,
            'db_username' => Yii::app()->db->username,
            'db_password' => Yii::app()->db->password,
            'db_prefix' => Yii::app()->db->tablePrefix,
            'charset' => Yii::app()->db->charset,
            'path' => Yii::app()->basePath . '/data/backup/',       //定义备份文件的路径
            'isCompress' => 0,                   //是否开启gzip压缩{0为不开启1为开启}
            'isDownload' => 0                    //压缩完成后是否自动下载{0为不自动1为自动}
        );
        $this->mr = new MysqlBack($this->config);     //实例化
    }
 
    /**
     * @desc 备份数据库
     * @author WuJunhua
     * @date 2016-02-15
     */
    public function actionBackup(){ 
        $this->initNew();
        $this->mr->setDBName($this->config['dbname']);
        $result = $this->mr->backup();
        if($result){
            $this->renderJson(array('res'=>'success'));
        }else{  
            $this->renderJson(array('res'=>'error'));
        }       
    }
    
    /**
     * @desc 删除指定目录下的所有文件，不删除目录文件夹
     * @author WuJunhua
     * @date 2016-02-15
     */ 
    public function DelFile($dirName){
        if(file_exists($dirName) && $handle = opendir($dirName)){
            while(false !== ($item = readdir($handle))){
                if($item != "." && $item != ".."){
                    if(file_exists($dirName.'/'.$item) && is_dir($dirName.'/'.$item)){              
                        $this->DelFile($dirName.'/'.$item);
                    }else{
                        if(unlink($dirName.'/'.$item)){
                           // return true;                    
                        }             
                    }           
                }     
            }       
            closedir($handle);
        }else{
            return false;
        }
    }

    /**
     * @desc 删除服务器上的所有数据库文件
     * @author WuJunhua
     * @date 2016-02-15
     */
    public function actionDelBack(){
        $this->initNew();
        chmod($this->config['path'], 777);
        $result = $this->DelFile($this->config['path']);
        if($result === null){
            $this->renderJson(array('res' => 'success','msg' => '数据库清理成功'));
        }else{
            $this->renderJson(array('res' => 'error','msg' => '数据库清理失败'));
        }     
    }
 
    /**
     * @desc 还原数据库
     * @author WuJunhua
     * @date 2016-02-15
     */
    public function actionRecover(){
        $this->initNew();
        $this->mr->setDBName($this->config['dbname']);
        $filename = $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $extend = strrchr($filename,'.');//获取文件后缀名(.sql)
        $time = date("YmdHis");
        $filePath = 'protected/data/backup/'; //存放地址
        file_exists($filePath) ? null : mkdir($filePath);
        //$str = strstr ( $filename ,  '.' ,  true );  //获取'.'前面的所有字符
        $name = $this->config['dbname'].'_'.$time.'_'.mt_rand(100000000,999999999).$extend; //上传后的文件名
        $uploadfile = $filePath.$name; //上传后的文件名地址

        if(empty($filename)){
            echo "<script>alert('上传文件不能为空!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
            die;
        }
        if(!empty($filename)) { 
            $uploadResult = move_uploaded_file($tmp_name,$uploadfile);
            if(empty($uploadResult)){
                echo "<script>alert('数据还原有误,请重新操作!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
                die;
            }
        }

        $result = $this->mr->recover($name);
        if($result){  
            echo "<script>alert('数据还原成功!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
            die;
        }else{
            echo "<script>alert('数据还原失败!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
            die;
        }                         
    }
 
    /**
     * @desc 公共下载方法
     * @author WuJunhua
     * @date 2016-02-15
     */
    /*public function download($filename){              
        ob_end_clean();
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-streamextension');
        header('Content-Length: '.filesize($filename));
        header('Content-Disposition: attachment; filename='.basename($filename));
        flush();
        readfile($filename);
    }*/
}