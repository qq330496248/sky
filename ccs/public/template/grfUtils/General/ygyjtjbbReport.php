<!-- <html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?php echo $_GET['name']?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <script src="../../js/grid/CreateControl.js" type="text/javascript"></script>
    <script type="text/javascript">
function OnSaveReport()
{
    //设置 DefaultAction 属性为 false，不执行控件本身的默认保存行为
    ReportDesigner.DefaultAction = false;
  
    ReportDesigner.Post();  //将设计器中的设计数据提交到报表对象
    
    var ReportName = "<?php echo $_GET['report']?>"; //这里可以是一个参数化的变量
    var LoadURL = "DesignReportSave.php?report=" + ReportName;
    var success = ReportDesigner.Report.SaveToURL( encodeURI(LoadURL) );
    if ( success )
        alert("保存报表成功!");
    else
        alert("保存报表失败!");
}
    </script>
    <style type="text/css">
      html,body {
      margin:0;
      height:100%;
      }
    </style>
</head>
<body style="margin:0">
  <script type="text/javascript">
    var Report = "<?php echo $_GET['report']?>";
    if (Report != "")
    Report = "../../grf/" + Report;

    var Data = "<?php echo $_GET['data']?>";

    //员工业绩统计
    //name名字，obd下单时间（起），oed下单时间（止）
    var NAME = "<?php echo $_GET['name']?>";
    var OBD = "<?php echo $_GET['obd']?>";
    var OED = "<?php echo $_GET['oed']?>";


    if (Data != "")
    Data = "/ccs/public/template/grfUtils/" + Data;


    //员工业绩统计
    if(NAME != "")
      Data += "?name="+NAME;
    if(OBD != "")
      Data += "?obd="+OBD;
    if(OED != "")
      Data += "?oed="+OED;

    //如果直接指定ReportURL为grf文件的URL,不能保存数据，可能是文件被打开锁定
    CreateDesignerEx("100%", "100%", Report, <?php echo "\"DesignReportSave.php?report=".$_GET['report']."\"" ?>, Data, "<param name=OnSaveReport value=OnSaveReport>");
  </script>
</body>
</html>  -->

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $_GET['name']?>业绩报表</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="../../js/grid/CreateControl.js" type="text/javascript"></script>
</head>
<body style="margin:0">
<script type="text/javascript">
  var Report = "<?php echo $_GET['report']?>";
  if (Report != "")
  Report = "../../grf/" + Report;

  var Data = "<?php echo $_GET['data']?>";

    //员工业绩统计
    //name名字，obd下单时间（起），oed下单时间（止）
    var NAME = "<?php echo $_GET['name']?>";
    var OBD = "<?php echo $_GET['obd']?>";
    var OED = "<?php echo $_GET['oed']?>";


/*  if (Data != "")
  Data = "/ccs/public/template/grfUtils/" + Data;
  //员工业绩统计
    if(NAME != "")
      Data += "?name="+NAME;
    if(OBD != "")
      Data += "&obd="+OBD;
    if(OED != "")
      Data += "&oed="+OED;*/

//  CreatePrintViewerEx("100%", "100%", Report, "", true, "");
</script>
<?php include '../data/mysql_GenXmlData.php'; ?>

<?php
//这个例子程序可以分别眼演示MYSQL、MSSQL与ODBC这几种数据访问方式，
//将上面的include包含文件改为mysql_GenXmlData，就是采用MYSQL数据
//将上面的include包含文件改为mssql_GenXmlData，就是采用MSSQL数据
//将上面的include包含文件改为odbc_GenXmlData，就是采用ODBC数据
$QuerySQL = "select * FROM(SELECT '下单' me,xs.xsaa61,SUM(xsac05) money FROM rylist ry LEFT JOIN xsac ac ON ry.username=ac.xsac02 LEFT JOIN xsaa xs ON ac.xsac01 = xs.`xsaa02` WHERE ry.personname = '".$_GET['name']."' AND xs.`xsaa29` IN ('已确认','待发货','已发货','拒收','交易成功') AND xs.xsaa61 >= '".$_GET['obd']."'  AND xs.xsaa61 <= '".$_GET['oed']."' GROUP BY xs.`xsaa61` UNION ALL SELECT '审单' me,xs.xsaa61,SUM(xsac05) money FROM rylist ry LEFT JOIN xsac ac ON ry.username=ac.xsac02 LEFT JOIN xsaa xs ON ac.xsac01 = xs.`xsaa02` WHERE ry.personname = '".$_GET['name']."' AND xs.`xsaa29` IN ('待发货','已发货','拒收','交易成功') AND xs.xsaa61 >= '".$_GET['obd']."'  AND xs.xsaa61 <= '".$_GET['oed']."' GROUP BY xs.`xsaa61` UNION ALL SELECT '发货' me,xs.xsaa61,SUM(xsac05) money FROM rylist ry LEFT JOIN xsac ac ON ry.username=ac.xsac02 LEFT JOIN xsaa xs ON ac.xsac01 = xs.`xsaa02` WHERE ry.personname = '".$_GET['name']."' AND xs.`xsaa29` IN ('已发货','拒收','交易成功') AND xs.xsaa61 >= '".$_GET['obd']."'  AND xs.xsaa61 <= '".$_GET['oed']."' GROUP BY xs.`xsaa61` UNION ALL SELECT '拒收' me,xs.xsaa61,SUM(xsac05) money FROM rylist ry LEFT JOIN xsac ac ON ry.username=ac.xsac02 LEFT JOIN xsaa xs ON ac.xsac01 = xs.`xsaa02` WHERE ry.personname = '".$_GET['name']."' AND xs.`xsaa29` IN ('拒收') AND xs.xsaa61 >= '".$_GET['obd']."'  AND xs.xsaa61 <= '".$_GET['oed']."' GROUP BY xs.`xsaa61` UNION ALL SELECT '签收' me,xs.xsaa61,SUM(xsac05) money FROM rylist ry LEFT JOIN xsac ac ON ry.username=ac.xsac02 LEFT JOIN xsaa xs ON ac.xsac01 = xs.`xsaa02` WHERE ry.personname = '".$_GET['name']."' AND xs.`xsaa29` IN ('交易成功') AND xs.xsaa61 >= '".$_GET['obd']."'  AND xs.xsaa61 <= '".$_GET['oed']."' GROUP BY xs.`xsaa61`) mes;";

XML_GenOneRecordset($QuerySQL);
?>

<?php include("testYGYJTJBB.htm"); ?>
</body>
</html>
 