<?php
$filename = dirname($_SERVER['SCRIPT_FILENAME']) . "\\" . $_GET['report'];

if ( !$handle = fopen($filename, 'r') ) 
{
    print "���ܴ��ļ� $filename���������ļ������ڻ�WEB�����û����������Ȩ��";
    exit;
}

$contents = fread($handle, filesize($filename));
fclose($handle);

echo $contents;
?>
 