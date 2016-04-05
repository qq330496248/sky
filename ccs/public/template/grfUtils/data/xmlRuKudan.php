<?php include 'mysql_GenXmlData.php'; ?>

<?php
//这个例子程序可以分别眼演示MYSQL、MSSQL与ODBC这几种数据访问方式，
//将上面的include包含文件改为mysql_GenXmlData，就是采用MYSQL数据
//将上面的include包含文件改为mssql_GenXmlData，就是采用MSSQL数据
//将上面的include包含文件改为odbc_GenXmlData，就是采用ODBC数据
//库存明细
$QuerySQL = "select a.cpaa01,a.cpaa02,a.cpaa10,e.cpae06,sum(e.cpae03) AS cpae03,e.cpae04,e.cpae09,e.cpae07,e.cpae13,gb.cgab02,d.cpad03 from cpae e left join cpaa a on a.`cpaa01` = e.`cpae02` left join cgab gb on a.cpaa18 = gb.cgab01 left join cpad d on a.`cpaa05` = d.cpad01 where a.cpaa01 = '".$_GET['id']."' group by a.`cpaa01`";

XML_CGDRecordset($QuerySQL,'./testRKD.txt');
?>
<?php include("../General/testRKD.htm"); ?>

