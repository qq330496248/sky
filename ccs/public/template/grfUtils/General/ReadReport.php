<?php
//$filename = $_SERVER['PATH_TRANSLATED'] . "\\grf\\" . $_GET['report'];
//$filename = $_SERVER['DOCUMENT_ROOT'] . "\\grf\\" . $_GET['report'];
$filename = dirname($_SERVER['SCRIPT_FILENAME']) . "\\grf\\" . $_GET['report'];

if ( !$handle = fopen($filename, 'r') ) 
{
    print "���ܴ��ļ� $filename���������ļ������ڻ�WEB�����û����������Ȩ��";
    exit;
}

$contents = fread($handle, filesize($filename));
fclose($handle);

echo $contents;
?>
 