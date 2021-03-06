<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Web报表(B/S报表)演示　－ 服务端生成加载报表数据脚本代码</title>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=gb2312">
		<script src="../CreateControl.js" type="text/javascript"></script>
		<script type="text/javascript">
// <!CDATA[

//在网页初始加载时向报表提供数据
function window_onload() {
    ReportViewer.Stop();
    
    ReportViewer.Report.PrepareRecordset();

    var Recordset = ReportViewer.Report.DetailGrid.Recordset;
    var fldCustomerID = ReportViewer.Report.FieldByName("CustomerID");
    var fldCompanyName = ReportViewer.Report.FieldByDBName("CompanyName");
    var fldContactName = ReportViewer.Report.FieldByDBName("ContactName");
    var fldContactTitle = ReportViewer.Report.FieldByDBName("ContactTitle");
    var fldAddress = ReportViewer.Report.FieldByDBName("Address");
    var fldCity = ReportViewer.Report.FieldByDBName("City");
    var fldRegion = ReportViewer.Report.FieldByDBName("Region");
    var fldPostalCode = ReportViewer.Report.FieldByDBName("PostalCode");
    var fldCountry = ReportViewer.Report.FieldByDBName("Country");
    var fldPhone = ReportViewer.Report.FieldByDBName("Phone");
    var fldFax = ReportViewer.Report.FieldByDBName("Fax");

    <?
	// connect to mysql server with a user and password
	mysql_connect("localhost", "root", "") or die("couldn't connect: ".mysql_error());
    mysql_select_db("gridreport");
    //mysql_query("set names 'gbk'");
    mysql_query("set names 'utf8'");
	$result = mysql_query("select * from Customers order by CustomerID");
	
    while ($cols = mysql_fetch_array($result))
	{
	?>
		Recordset.Append();
		fldCustomerID.AsString = "<? echo $cols[0] ?>";
		fldCompanyName.AsString = "<? echo $cols[1] ?>";
		fldContactName.AsString = "<? echo $cols[2] ?>";
		fldContactTitle.AsString = "<? echo $cols[3] ?>";
		fldAddress.AsString = "<? echo $cols[4] ?>";
		fldCity.AsString = "<? echo $cols[5] ?>";
		fldRegion.AsString = "<? echo $cols[6] ?>";
		fldPostalCode.AsString = "<? echo $cols[7] ?>";
		fldCountry.AsString = "<? echo $cols[8] ?>";
		fldPhone.AsString = "<? echo $cols[9] ?>";
		fldFax.AsString = "<? echo $cols[10] ?>";
		Recordset.Post();
		
    <?
    } 

	mysql_free_result($result);
    ?>
    
    ReportViewer.Start();
}
// ]]>
		</script>
	</head>
	<body style="margin:0" onload="window_onload()">
	<script type="text/javascript"> 
           CreateDisplayViewer("../grf/1a.grf", "");
	</script>
	</body>
</html>
 