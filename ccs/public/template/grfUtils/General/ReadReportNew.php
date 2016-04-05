<?php
//不把 grf 文件放在网站虚拟目录下，让 grf 文件不能直接下载
//这里假设 grf 在 "d:\grf\" 目录下
$filename = "d:\\grf\\" . $_GET['report'];

if ( !$handle = fopen($filename, 'r') ) 
{
    print "不能打开文件 $filename，可能是文件不存在或WEB服务用户不具有相关权限";
    exit;
}

$contents = fread($handle, filesize($filename));
fclose($handle);

echo $contents;
?>
 