<?php include 'mysql_GenXmlData.php'; ?>

<?php
//这个例子程序可以分别眼演示MYSQL、MSSQL与ODBC这几种数据访问方式，
//将上面的include包含文件改为mysql_GenXmlData，就是采用MYSQL数据
//将上面的include包含文件改为mssql_GenXmlData，就是采用MSSQL数据
//将上面的include包含文件改为odbc_GenXmlData，就是采用ODBC数据
$QuerySQL = "select * FROM(SELECT '下单' me,xs.xsaa61,SUM(xsaa19) money FROM rylist ry LEFT JOIN xsac ac ON ry.username=ac.xsac02 LEFT JOIN xsaa xs ON ac.xsac01 = xs.`xsaa02` WHERE ry.personname = '".$_GET['name']."' AND xs.`xsaa29` IN ('已确认','待发货','已发货','拒收','交易成功') AND xs.xsaa61 >= '".$_GET['obd']."'  AND xs.xsaa61 <= '".$_GET['oed']."' GROUP BY xs.`xsaa61` UNION ALL SELECT '审单' me,xs.xsaa61,SUM(xsaa19) money FROM rylist ry LEFT JOIN xsac ac ON ry.username=ac.xsac02 LEFT JOIN xsaa xs ON ac.xsac01 = xs.`xsaa02` WHERE ry.personname = '".$_GET['name']."' AND xs.`xsaa29` IN ('待发货','已发货','拒收','交易成功') AND xs.xsaa61 >= '".$_GET['obd']."'  AND xs.xsaa61 <= '".$_GET['oed']."' GROUP BY xs.`xsaa61` UNION ALL SELECT '发货' me,xs.xsaa61,SUM(xsaa19) money FROM rylist ry LEFT JOIN xsac ac ON ry.username=ac.xsac02 LEFT JOIN xsaa xs ON ac.xsac01 = xs.`xsaa02` WHERE ry.personname = '".$_GET['name']."' AND xs.`xsaa29` IN ('已发货','拒收','交易成功') AND xs.xsaa61 >= '".$_GET['obd']."'  AND xs.xsaa61 <= '".$_GET['oed']."' GROUP BY xs.`xsaa61` UNION ALL SELECT '拒收' me,xs.xsaa61,SUM(xsaa19) money FROM rylist ry LEFT JOIN xsac ac ON ry.username=ac.xsac02 LEFT JOIN xsaa xs ON ac.xsac01 = xs.`xsaa02` WHERE ry.personname = '".$_GET['name']."' AND xs.`xsaa29` IN ('拒收') AND xs.xsaa61 >= '".$_GET['obd']."'  AND xs.xsaa61 <= '".$_GET['oed']."' GROUP BY xs.`xsaa61` UNION ALL SELECT '签收' me,xs.xsaa61,SUM(xsaa19) money FROM rylist ry LEFT JOIN xsac ac ON ry.username=ac.xsac02 LEFT JOIN xsaa xs ON ac.xsac01 = xs.`xsaa02` WHERE ry.personname = '".$_GET['name']."' AND xs.`xsaa29` IN ('交易成功') AND xs.xsaa61 >= '".$_GET['obd']."'  AND xs.xsaa61 <= '".$_GET['oed']."' GROUP BY xs.`xsaa61`) mes;";

XML_GenOneRecordset($QuerySQL,'./testYGYJTJBB.txt');
?>
<?php include("../General/testYGYJTJBB.htm"); ?>