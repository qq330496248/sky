<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $_GET['id'] ?></title>
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

    var ID = "<?php echo $_GET['id']?>";

   


    if (Data != "")
    Data = "/ccs/public/template/grfUtils/" + Data;
    if(ID != "")
      Data += "?id="+ID;


    //如果直接指定ReportURL为grf文件的URL,不能保存数据，可能是文件被打开锁定
    CreateDesignerEx("100%", "100%", Report, <?php echo "\"DesignReportSave.php?report=".$_GET['report']."\"" ?>, Data, "<param name=OnSaveReport value=OnSaveReport>");
  </script>
</body>
</html> 
