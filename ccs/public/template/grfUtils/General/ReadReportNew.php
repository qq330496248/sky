<?php
//���� grf �ļ�������վ����Ŀ¼�£��� grf �ļ�����ֱ������
//������� grf �� "d:\grf\" Ŀ¼��
$filename = "d:\\grf\\" . $_GET['report'];

if ( !$handle = fopen($filename, 'r') ) 
{
    print "���ܴ��ļ� $filename���������ļ������ڻ�WEB�����û����������Ȩ��";
    exit;
}

$contents = fread($handle, filesize($filename));
fclose($handle);

echo $contents;
?>
 