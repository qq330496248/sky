<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Web报表(B/S报表)演示, 用报表打印显示器插件展现报表 - <?php echo $_GET['report'] ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="../../js/grid/CreateControl.js" type="text/javascript"></script>
</head>
<body style="margin:0">
<script type="text/javascript">
  var Report = "<?php echo $_GET['report']?>";
  if (Report != "")
  Report = "../../grf/" + Report;

  var Data = "<?php echo $_GET['data']?>";

  var ID = "<?php echo $_GET['id']?>";

  if (Data != "")
  Data = "/ccs/public/template/grfUtils/" + Data;
  if(ID != "")
    Data += "?id="+ID;
  CreatePrintViewerEx("100%", "100%", Report, Data, true, "");
</script>
</body>
</html>
 