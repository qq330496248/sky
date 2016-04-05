<?php include 'mysql_GenXmlData.php'; ?>

<?php
//这个例子程序可以分别眼演示MYSQL、MSSQL与ODBC这几种数据访问方式，
//将上面的include包含文件改为mysql_GenXmlData，就是采用MYSQL数据
//将上面的include包含文件改为mssql_GenXmlData，就是采用MSSQL数据
//将上面的include包含文件改为odbc_GenXmlData，就是采用ODBC数据
$QuerySQL = "select c.cgac02,c.cgac03,c.cgac04,c.cgac05,c.cgac06,c.cgac07,c.cgac08,a.cgaa03,a.cgaa05,a.cgaa06,a.cgaa08,a.cgaa09,a.cgaa10  from cgac as c left join cgaa as a on c.cgac02 = a.cgaa01 where a.cgaa01 = '".$_GET['id']."'";

XML_CGDRecordset($QuerySQL,'./testCGD.txt');
?>
<?php include("../General/testCGD.htm"); ?>

