<? include '../../data/mysql_GenXmlData.php'; ?>
<?php
//这个例子程序可以分别眼演示MYSQL、MSSQL与ODBC这几种数据访问方式，
//将上面的include包含文件改为mysql_GenXmlData，就是采用MYSQL数据
//将上面的include包含文件改为mssql_GenXmlData，就是采用MSSQL数据
//将上面的include包含文件改为odbc_GenXmlData，就是采用ODBC数据
$QuerySQL = <<<QuerySQL
select * from Products 
where ProductID>=%d and ProductID<=%d
order by ProductID
QuerySQL;
$RealQuerySQL = sprintf($QuerySQL, $_GET['BeginNo'], $_GET['EndNo']);
XML_GenOneRecordset($RealQuerySQL);
?> 