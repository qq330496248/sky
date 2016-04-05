<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Web报表(B/S报表)演示，在网页中应用报表设计器设计报表 - <?php echo $_GET['report'] ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script src="../../CreateControl.js" type="text/javascript"></script>
    <script type="text/javascript">
function OnSaveReport()
{
  alert("为了保护报表的正常演示，这里放弃了对报表设计的保存！");
  //ReportDesigner.DefaultAction = false;
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

      //如果直接指定ReportURL为grf文件的URL,不能保存数据，可能是文件被打开锁定
      CreateDesignerEx("100%", "100%", Report, <?php echo "\"DesignReportSave.php?report=".$_GET['report']."\"" ?>, "", "<param name=OnSaveReport value=OnSaveReport>");

      CreateReport("ReportObject");
      ReportObject.LoadFromURL(Report);
      var QuerySQL = ReportObject.DetailGrid.Recordset.QuerySQL;
      ReportDesigner.DataURL = encodeURI("../../data/xmlSQLParam.php?QuerySQL=" + QuerySQL);
    </script>
</body>
</html> 
