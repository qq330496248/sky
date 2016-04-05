<?php include 'mysql_GenXmlData.php'; ?>

<?php
//这个例子程序可以分别眼演示MYSQL、MSSQL与ODBC这几种数据访问方式，
//将上面的include包含文件改为mysql_GenXmlData，就是采用MYSQL数据
//将上面的include包含文件改为mssql_GenXmlData，就是采用MSSQL数据
//将上面的include包含文件改为odbc_GenXmlData，就是采用ODBC数据
$QuerySQL = "select a.xsaa02,a.xsaa05,a.xsaa09,a.xsaa06,a.xsaa07,a.xsaa23,b.xsab01,b.xsab02,b.xsab04,b.xsab06,b.xsab08,a.xsaa36,a.xsaa61 from xsab as b left join xsaa as a on b.xsab01 = a.xsaa02 where b.xsab01 = '".$_GET['id']."'";

XML_CGDRecordset($QuerySQL,'./testCGD.txt');
?>
<?php include("../General/testCHD.htm"); ?>

