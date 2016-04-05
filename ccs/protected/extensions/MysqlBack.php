<?php
/**
 * @desc 数据备份+还原操作类
 * @author WuJunhua
 * @date 2016-02-14
*/
class MysqlBack {
    private $config;
    private $content;
    private $dbname = array();
 
    const DIR_SEP = DIRECTORY_SEPARATOR; //操作系统的目录分隔符
 
    public function __construct($config){ //初始化相关属性
        header("Content-type: text/html;charset=utf-8");
        $this->config = $config;
        $this->connect();
    }
 
    /*
    * @desc 连接数据库
    * @access private
    * @return void
    */
    private function connect(){
        if(@mysql_connect($this->config['host']. ':' . $this->config['port'], $this->config['db_username'], $this->config['db_password'])){
            mysql_query("SET NAMES '{$this->config['charset']}'");
            mysql_query("set interactive_timeout=24*3600");
        }else{
            echo "<script>alert('无法连接到数据库!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
            die;
            //$this->throwException('无法连接到数据库!');
        }
    }
 
    /*
    * @desc 设置欲备份的数据库
    * @param string $dbname 数据库名(支持多个参数.默认为全部的数据库)
    * @access public
    * @return void
    */
    public function setdbname($dbname = '*'){
        if($dbname == '*'){
            $rs = mysql_list_dbs();
            $rows = mysql_num_rows($rs);
            if($rows){
                for($i=0;$i<$rows;$i++){
                    $dbname = mysql_tablename($rs,$i);
                    //这些数据库不需要备份
                    $block = array('information_schema', 'mysql');
                    if(!in_array($dbname, $block)){
                        $this->dbname[] = $dbname;
                    }
                }
            }else{
                echo "<script>alert('没有任何数据库!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
                die;
                //$this->throwException('没有任何数据库!');
            }
        }else{
            $this->dbname = func_get_args();
        }
    }
 
    /*
    * @desc 获取备份文件
    * @param string $fileName 文件名
    * @access private
    * @return void
    */
    private function getfile($fileName){
        $this->content = '';
        $fileName = $this->trimPath($this->config['path'] . self::DIR_SEP .$fileName);
        if(is_file($fileName)){
            $ext = strrchr($fileName, '.');
            if($ext == '.sql'){
                $this->content = file_get_contents($fileName);
            } elseif($ext == '.gz'){
                $this->content = implode('', gzfile($fileName));
            }else{
                $this->throwException('无法识别的文件格式!');
            }
        }else{
            echo "<script>alert('文件不存在!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
            die;
            //$this->throwException('文件不存在!');
        }
    }
 
    /*
    * @desc 备份文件
    * @access private
    */
    private function setFile(){
        $recognize = '';
        $recognize = implode('_', $this->dbname);
        $fileName = $this->trimPath($this->config['path'] . self::DIR_SEP . $recognize.'_'.date('YmdHis') . '_' . mt_rand(100000000,999999999) .'.sql');
        $path = $this->setPath($fileName);
        if($path !== true){
            echo "<script>alert('无法创建备份目录!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
            die;
            //$this->throwException("无法创建备份目录目录 '$path'");
        }
 
        if($this->config['isCompress'] == 0){
            if(!file_put_contents($fileName, $this->content, LOCK_EX)){
                echo "<script>alert('写入文件失败,请检查磁盘空间或者权限!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
                die;
                //$this->throwException('写入文件失败,请检查磁盘空间或者权限!');
            }
        }else{
            if(function_exists('gzwrite')){
                $fileName .= '.gz';
                if($gz = gzopen($fileName, 'wb')){
                    gzwrite($gz, $this->content);
                    gzclose($gz);
                }else{
                    echo "<script>alert('写入文件失败,请检查磁盘空间或者权限!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
                    die;
                    //$this->throwException('写入文件失败,请检查磁盘空间或者权限!');
                }
            }else{
                echo "<script>alert('没有开启gzip扩展!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
                die;
                //$this->throwException('没有开启gzip扩展!');
            }
        }
        //if($this->config['isDownload']){
            $this->downloadFile($fileName);
        //}
    }
 
    /*
    * @desc 将路径修正为适合操作系统的形式
    * @param  string $path 路径名称
    * @return string
    */
    private function trimPath($path){
        return str_replace(array('/', '\\', '//', '\\\\'), self::DIR_SEP, $path);
    }
 
    /*
    * @desc 设置并创建目录
    * @param $fileName 路径
    * @return mixed
    * @access private
    */
    private function setPath($fileName){
        $dirs = explode(self::DIR_SEP, dirname($fileName));
        $tmp = '';
        foreach ($dirs as $dir){
            $tmp .= $dir . self::DIR_SEP;
            if(!file_exists($tmp) && !@mkdir($tmp, 0777))
            return $tmp;
        }
        return true;
    }
 
    /*
    * @desc 下载文件
    * @param string $fileName 路径
    */
    private function downloadFile($fileName){
        ob_end_clean();
        header ("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($fileName));
        header('Content-Disposition: attachment; filename=' . basename($fileName));
        readfile($fileName);
    }
 
    /*
    * @desc 给表名或者数据库名加上``
    * @param string $str
    * @return string
    * @access private
    */
    private function backquote($str){
        return "`{$str}`";
    }
 
    /*
    * @desc 获取数据库的所有表
    * @param string $dbname 数据库名
    * @return array
    * @access private
    */
    private function getTables($dbname){
    //  $rs = mysql_list_tables($dbname);  //该方法已弃用
        if(empty($dbname)){
            echo "<srcipt>alert('数据备份失败');</srcipt>";
            die;
        }
        $rs = mysql_query("show tables");
        $rows = mysql_num_rows($rs);
        for ($i=0; $i<$rows; $i++){
            $tables[] = mysql_tablename($rs, $i);
        }
        return $tables;
    }
 
    /**
    * @desc 将数组按照字节数分割成小数组
    * @param array $array  数组
    * @param int $byte     字节数
    * @return array
    */
    private function chunkArrayByByte($array, $byte = 5120){
        $i=0;
        $sum=0;
        $return = '';
        foreach ($array as $v){
            $sum += strlen($v);
            if($sum < $byte){
                $return[$i][] = $v;
            }elseif($sum == $byte){
                $return[++$i][] = $v;
                $sum = 0;
            }else{
                $return[++$i][] = $v;
                $i++;
                $sum = 0;
            }
        }
        return $return;
    }
 
    /**
    * @desc 备份
    * @access public
    */
    public function backup(){
        $this->content = '/* This file is created by MySQLReback ' . date('Y-m-d H:i:s') . ' */';
        $this->content .= $this->fkHeader() ."/* MySQLReback Separation */";
        foreach ($this->dbname as $dbname){
            $qdbname = $this->backquote($dbname);
            $rs = mysql_query("SHOW CREATE DATABASE {$qdbname}");
            if($row = mysql_fetch_row($rs)){
                //建立数据库
                $this->content .= "\r\n /* 创建数据库 {$qdbname} */";
                //必须设置一个分割符..单用分号是不够安全的.
                $this->content .= "\r\n DROP DATABASE IF EXISTS {$qdbname};/* MySQLReback Separation */ {$row[1]};/* MySQLReback Separation */ USE {$qdbname};/* MySQLReback Separation */";
                mysql_select_db($dbname);
                //取得表
                $tables = $this->getTables($dbname);
                foreach ($tables as $table){
                    $table = $this->backquote($table);
                    $tableRs = mysql_query("SHOW CREATE TABLE {$table}");
                    if($tableRow = mysql_fetch_row($tableRs)){
                        //建表
                        $this->content .= "\r\n /* 创建表结构 {$table}  */";
                        $this->content .= "\r\n DROP TABLE IF EXISTS {$table};/* MySQLReback Separation */ {$tableRow[1]};/* MySQLReback Separation */";
                         
                        //获取数据
                        $tableDateRs = mysql_query("SELECT * FROM {$table}");
                        $valuesArr = array();
                        $values = '';
                        while ($tableDateRow = mysql_fetch_row($tableDateRs)){
                            //组合INSERT的VALUE
                            foreach ($tableDateRow as &$v){
                                $v = "'" . addslashes($v) . "'"; //别忘了转义.
                            }
                            $valuesArr[] = '(' . implode(',', $tableDateRow) . ')';
                        }
 
                        $temp = $this->chunkArrayByByte($valuesArr);
 
                        if(is_array($temp)){
                            foreach ($temp as $v){
                                $values = implode(',', $v) . ';/* MySQLReback Separation */';
                                //空的数据表就不组合SQL语句了..因为没得组合
                                if($values != ';/* MySQLReback Separation */'){
                                    $this->content .= "\r\n /* 插入数据 {$table} */";
                                    $this->content .= "\r\n INSERT INTO {$table} VALUES {$values}";
                                }
                            }
                        }
                    }
                }
             
            }else {
                echo "<script>alert('未能找到数据库!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
                die;
                //$this->throwException('未能找到数据库!');
            }
        }
        if(!empty($this->content)){
            $this->content .= $this->fkFooter();
            $this->setFile();
        }
        return true;
    }
 
    /**
    * @desc 恢复数据库
    * @param string $fileName 文件名
    * @access public
    */
    public function recover($fileName){
        $this->getfile($fileName);
        if(!empty($this->content)){
            $content = explode(';/* MySQLReback Separation */', $this->content);
            foreach ($content as $sql){
                $sql = trim($sql);
                //空的SQL会被认为是错误的
                if(!empty($sql)){
                    $rs = mysql_query($sql);
                    if($rs){
                        //一定要选择数据库.不然多库恢复会出错
                        if(strstr($sql, 'CREATE DATABASE')){
                           // print_r($sql);die;
                            $dbnameArr = sscanf($sql, 'CREATE DATABASE %s');
                            $dbname = trim($dbnameArr[0], '`');
                            mysql_select_db($dbname);
                        }
                    }else {
                        echo "<script>alert('备份文件被损坏!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
                        die;
                        //$this->throwException('备份文件被损坏!' . mysql_error());
                    }
                }
            }
        }else{
            echo "<script>alert('无法读取备份文件!');window.location.href='index.php?r=xtsz/GetSjbfyhyHtml';</script>";
            die;
            //$this->throwException('无法读取备份文件!');
        }
        return true;
    }
 
    /**
     * @desc 抛出异常信息
     */
    private function throwException($error){
        throw new Exception($error);
    }
 
    //备份还原的开始的时候。关闭外键和索引
    public function fkHeader(){
        $str = "SET @ORIG_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;";
    /*  $str = "SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;";
        $str .= "SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;";
        $str .= "SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;";
        $str .= "SET NAMES utf8;";
        $str .= "SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;";
        $str .= "SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;";
        $str .= "SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';";
        $str .= "SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0;";*/
        return $str;
    }
 
    //备份还原的结束的时候。开启外键和索引
	public function fkFooter(){
	    $str = "SET FOREIGN_KEY_CHECKS=@ORIG_FOREIGN_KEY_CHECKS;";
	/*  $str = "SET SQL_MODE=@OLD_SQL_MODE;";
	    $str .= "SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;";
	    $str .= "SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;";
	    $str .= "SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;";
	    $str .= "SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;";
	    $str .= "SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;";
	    $str .= "SET SQL_NOTES=@OLD_SQL_NOTES;";*/
	    return $str;
	}
}