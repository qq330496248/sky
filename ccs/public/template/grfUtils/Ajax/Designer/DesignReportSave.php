<?php
$filename = dirname($_SERVER['SCRIPT_FILENAME']) . "\\" . $_GET['report'];
$content = file_get_contents("php://input");

if ( !$handle = fopen($filename, 'w') ) 
{
    print "���ܴ��ļ� $filename��������WEB�����û�������Ŀ¼��д��Ȩ��";
    exit;
}

// ��$contentд�뵽���Ǵ򿪵��ļ��С�
if ( !fwrite($handle, $content) ) 
{
   print "����д�뵽�ļ� $filename";
   exit;
}

fclose($handle);
?>
 