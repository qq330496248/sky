<?php include 'mysql_GenXmlData.php'; ?>

<?php
//这个例子程序可以分别眼演示MYSQL、MSSQL与ODBC这几种数据访问方式，
//将上面的include包含文件改为mysql_GenXmlData，就是采用MYSQL数据
//将上面的include包含文件改为mssql_GenXmlData，就是采用MSSQL数据
//将上面的include包含文件改为odbc_GenXmlData，就是采用ODBC数据
$QuerySQL = "select * FROM (SELECT '下单' me,a.xsaa61,SUM(b.xsab07) money FROM cpab ab LEFT JOIN cpaa cp ON ab.cpab01 = cp.cpaa03 LEFT JOIN xsab b ON cp.cpaa01 = b.`xsab03` LEFT JOIN xsaa a ON a.xsaa02 = b.xsab01 LEFT JOIN khaa kh ON a.`xsaa04` = kh.khaa02 WHERE ab.cpab02 = '".$_GET['cplb']."'  AND a.xsaa29 IN ('已确认','待发货','已发货','拒收','交易成功') AND a.xsaa61 >= '".$_GET['obd']."'  AND a.xsaa61 <= '".$_GET['oed']."' GROUP BY a.xsaa61 UNION ALL SELECT '审单' me,a.xsaa61,SUM(b.xsab07) money FROM cpab ab LEFT JOIN cpaa cp ON ab.cpab01 = cp.cpaa03 LEFT JOIN xsab b ON cp.cpaa01 = b.`xsab03` LEFT JOIN xsaa a ON a.xsaa02 = b.xsab01 LEFT JOIN khaa kh ON a.`xsaa04` = kh.khaa02 WHERE ab.cpab02 = '".$_GET['cplb']."'  AND a.xsaa29 IN ('待发货','已发货','拒收','交易成功') AND a.xsaa61 >= '".$_GET['obd']."'  AND a.xsaa61 <= '".$_GET['oed']."' GROUP BY a.xsaa61 UNION ALL SELECT '发货' me,a.xsaa61,SUM(b.xsab07) money FROM cpab ab LEFT JOIN cpaa cp ON ab.cpab01 = cp.cpaa03 LEFT JOIN xsab b ON cp.cpaa01 = b.`xsab03` LEFT JOIN xsaa a ON a.xsaa02 = b.xsab01 LEFT JOIN khaa kh ON a.`xsaa04` = kh.khaa02 WHERE ab.cpab02 = '".$_GET['cplb']."'  AND a.xsaa29 IN ('已发货','拒收','交易成功') AND a.xsaa61 >= '".$_GET['obd']."'  AND a.xsaa61 <= '".$_GET['oed']."' GROUP BY a.xsaa61 UNION ALL SELECT '拒收' me,a.xsaa61,SUM(b.xsab07) money FROM cpab ab LEFT JOIN cpaa cp ON ab.cpab01 = cp.cpaa03 LEFT JOIN xsab b ON cp.cpaa01 = b.`xsab03` LEFT JOIN xsaa a ON a.xsaa02 = b.xsab01 LEFT JOIN khaa kh ON a.`xsaa04` = kh.khaa02 WHERE ab.cpab02 = '".$_GET['cplb']."'  AND a.xsaa29 IN ('拒收') AND a.xsaa61 >= '".$_GET['obd']."'  AND a.xsaa61 <= '".$_GET['oed']."' GROUP BY a.xsaa61 UNION ALL SELECT '签收' me,a.xsaa61,SUM(b.xsab07) money FROM cpab ab LEFT JOIN cpaa cp ON ab.cpab01 = cp.cpaa03 LEFT JOIN xsab b ON cp.cpaa01 = b.`xsab03` LEFT JOIN xsaa a ON a.xsaa02 = b.xsab01 LEFT JOIN khaa kh ON a.`xsaa04` = kh.khaa02 WHERE ab.cpab02 = '".$_GET['cplb']."'  AND a.xsaa29 IN ('交易成功') AND a.xsaa61 >= '".$_GET['obd']."'  AND a.xsaa61 <= '".$_GET['oed']."' GROUP BY a.xsaa61) mes;";

XML_GenOneRecordset($QuerySQL,'./testCPLBTJBB.txt');
?>
<?php include("../General/testCPLBTJBB.htm"); ?>

