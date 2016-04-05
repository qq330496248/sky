<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Web报表(B/S报表)演示, 用报表查询显示器插件展现报表 - <?php echo $_GET['report'] ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script src="../../CreateControl.js" type="text/javascript"></script>
	</head>
	<body style="margin:0">
	<script type="text/javascript">
    var Report = "<?php echo $_GET['report']?>";
    if (Report != "")
    Report = "../../grf/" + Report;

    CreateDisplayViewerEx("100%", "100%", Report, "", false, "");

    var QuerySQL = ReportViewer.Report.DetailGrid.Recordset.QuerySQL;
    ReportViewer.DataURL = encodeURI("../../data/xmlSQLParam.php?QuerySQL=" + QuerySQL);

    ReportViewer.Start();
  </script>
	</body>
</html>
 