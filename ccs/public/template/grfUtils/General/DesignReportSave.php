<?php
//$filename = $_SERVER['PATH_TRANSLATED'] . "\\php\\grf\\" . $_GET['report'];
//$filename = $_SERVER['DOCUMENT_ROOT'] . "\\php\\grf\\" . $_GET['report'];
$filename = dirname($_SERVER['SCRIPT_FILENAME']) . "\\grf\\" . $_GET['report'];
$content = file_get_contents("php://input");

if ( !$handle = fopen($filename, 'w') ) 
{
    print "不能打开文件 $filename，可能是WEB服务用户不具有目录的写入权限";
    exit;
}

// 将$content写入到我们打开的文件中。
if ( !fwrite($handle, $content) ) 
{
   print "不能写入到文件 $filename";
   exit;
}
fclose($handle);
?>
