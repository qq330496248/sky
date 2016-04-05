<?php include 'BaseReportData.php'; ?>
<?php

/////////////////////////////////////////////////////////////////////////////////////////
//产生报表的多个记录集的 XML 数据
//$savePlace保存数据的地方
function XML_GenMultiRecordset($QueryList,$savePlace, $DataType=const_DefaultDataType)
{
	// connect to mysql server with a user and password
	@mysql_connect("localhost", "root", "") or die("couldn't connect: ".mysql_error());
    mysql_select_db("db000");
    mysql_query("set names 'utf8'");
    
	$XMLText="<xml>\n";
    foreach ($QueryList as $RecordsetName => $QuerySQL) 
    {
        //echo "Key: $key; Value: $value<br>\n";
	    $result = mysql_query($QuerySQL);
    	
	    $fldTypes = array();
	    $numfields = mysql_num_fields($result);
	    for($i=0;$i<$numfields;$i++)
	    {
		    $fldType = mysql_field_type($result, $i);
		    if (stripos($fldType, "date") !== false)
		        $fldTypes[$i]=1;
		    else if ($fldType == "blob" || $fldType == "image")
		        $fldTypes[$i]=2;
		    else
		        $fldTypes[$i]=0;
	    }
    	
        while ($row = mysql_fetch_array($result))
	    {
		    $XMLText.="<".$RecordsetName.">"; //$XMLText.="<row>";
		    for($i=0;$i<$numfields;$i++)
		    {
			    if ($fldTypes[$i] == 2)
				    $XMLText.=("<".mysql_field_name($result, $i).">".base64_encode($row[$i])."</".mysql_field_name($result, $i).">");
			    else
				    $XMLText.=("<".mysql_field_name($result, $i).">".htmlspecialchars($row[$i], ENT_QUOTES)."</".mysql_field_name($result, $i).">");
		    }
		    $XMLText.="</".$RecordsetName.">\n"; //$XMLText.="</row>\n";
	    }
	    
	    mysql_free_result($result);
	}

	$XMLText.="</xml>\n";
	
	ResponseReportData($XMLText, $savePlace, $DataType);
}

//产生报表的一个记录集的 XML 数据
//$savePlace保存数据的地方
function XML_GenOneRecordset($QuerySQL,$savePlace, $DataType=const_DefaultDataType)
{
    $QueryList = array ("row" => $QuerySQL);
    XML_GenMultiRecordset($QueryList,$savePlace, $DataType);
}


//采购单
//$savePlace保存数据的地方
function XML_CGDRecordset($QuerySQL,$savePlace, $DataType=const_DefaultDataType)
{
    $QueryList = array ("row" => $QuerySQL);
    XML_CGDMessRecordset($QueryList,$savePlace, $DataType);
}

/////////////////////////////////////////////////////////////////////////////////////////
//产生报表的多个记录集的 XML 数据
//$savePlace保存数据的地方
function XML_CGDMessRecordset($QueryList,$savePlace, $DataType=const_DefaultDataType)
{
	// connect to mysql server with a user and password
	@mysql_connect("localhost", "root", "") or die("couldn't connect: ".mysql_error());
    mysql_select_db("db000");
    mysql_query("set names 'utf8'");
    
	$XMLText="<xml>\n";
    foreach ($QueryList as $RecordsetName => $QuerySQL) 
    {
        //echo "Key: $key; Value: $value<br>\n";
	    $result = mysql_query($QuerySQL);
    	
	    $fldTypes = array();
	    $numfields = mysql_num_fields($result);
	    for($i=0;$i<$numfields;$i++)
	    {
		    $fldType = mysql_field_type($result, $i);
		    if (stripos($fldType, "date") !== false)
		        $fldTypes[$i]=1;
		    else if ($fldType == "blob" || $fldType == "image")
		        $fldTypes[$i]=2;
		    else
		        $fldTypes[$i]=0;
	    }
    	
        while ($row = mysql_fetch_array($result))
	    {
		    $XMLText.="<Table>"; //$XMLText.="<row>";
		    for($i=0;$i<$numfields;$i++)
		    {
			    if ($fldTypes[$i] == 2)
				    $XMLText.=("<".mysql_field_name($result, $i).">".base64_encode($row[$i])."</".mysql_field_name($result, $i).">");
			    else
				    $XMLText.=("<".mysql_field_name($result, $i).">".htmlspecialchars($row[$i], ENT_QUOTES)."</".mysql_field_name($result, $i).">");
		    }
		    $XMLText.="</Table>\n"; //$XMLText.="</row>\n";
	    }
	    
	    mysql_free_result($result);
	}

	$XMLText.="</xml>\n";
	
	ResponseReportData($XMLText, $savePlace, $DataType);
}

function BatchGetDataCount($QuerySQL)
{
    // connect to mysql server with a user and password
    mysql_connect("localhost", "root", "") or die("couldn't connect: ".mysql_error());
    mysql_select_db("db000");
    mysql_query("set names 'utf8'");
   	
    $result = mysql_query($QuerySQL);
    
    $Total = 0;
    if ($row = mysql_fetch_array($result))
	{
		$Total = $row[0];
	}
    
    mysql_free_result($result);
    
    return $Total;
}

//产生字段类型，用于调试中分析子段的类型名称
function ListFieldType($QuerySQL)
{
	header("Content-Type: text/plain");

	mysql_connect("localhost", "root", "") or die("couldn't connect: ".mysql_error());
    mysql_select_db("db000");
    mysql_query("set names 'utf8'");
	$result = mysql_query($QuerySQL);
	
	$XMLText="<xml>\n";
	
	$numfields = mysql_num_fields($result);
	for($i=0;$i<$numfields;$i++)
	{
		$XMLText.=(mysql_field_name($result, $i)."=".mysql_field_type($result, $i)."\n");
	}
	
	mysql_free_result($result);
	
	$XMLText.="</xml>\n";
    echo $XMLText;
}

/////////////////////////////////////////////////////////////////////////////////////////
//特别提示：以下函数为兼容以前版本而保留，请勿再用之，无须兼容考虑可删除之
//<<保留前面版本的函数，兼容以前版本所写程序

//产生报表需要的XML节点类型数据
function XML_GenDetailData($QuerySQL, $DataType=const_DefaultDataType)
{
	// connect to mysql server with a user and password
	mysql_connect("localhost", "root", "") or die("couldn't connect: ".mysql_error());
    mysql_select_db("db000");
    mysql_query("set names 'utf8'");
    
	$result = mysql_query($QuerySQL);
	$numfields = mysql_num_fields($result);
	
	$fldTypes = array();
	for($i=0;$i<$numfields;$i++)
	{
		$fldType = mysql_field_type($result, $i);
		if (stripos($fldType, "date") !== false)
		    $fldTypes[$i]=1;
		else if ($fldType == "blob" || $fldType == "image")
		    $fldTypes[$i]=2;
		else
		    $fldTypes[$i]=0;
	}
	
	$XMLText="<xml>\n";
    while ($row = mysql_fetch_array($result))
	{
		$XMLText.="<row>";
		for($i=0;$i<$numfields;$i++)
		{
			if ($fldTypes[$i] == 2)
				$XMLText.=("<".mysql_field_name($result, $i).">".base64_encode($row[$i])."</".mysql_field_name($result, $i).">");
			else
				$XMLText.=("<".mysql_field_name($result, $i).">".htmlspecialchars($row[$i], ENT_QUOTES)."</".mysql_field_name($result, $i).">");
		}
		$XMLText.="</row>\n";
	}
	$XMLText.="</xml>\n";
	
	mysql_free_result($result);
	
	ResponseReportData($XMLText, $DataType);
}

//产生报表需要的XML节点类型数据
//根据RecordsetQuerySQL产生提供给报表生成需要的XML数据，并同时将ParameterQuerySQL或取的报表参数数据一起打包，参数ToCompress指定是否压缩数据
function XML_GenEntireData($RecordsetQuerySQL, $ParameterPart, $DataType=const_DefaultDataType)
{
	// connect to mysql server with a user and password
	mysql_connect("localhost", "root", "") or die("couldn't connect: ".mysql_error());
    mysql_select_db("db000");
    mysql_query("set names 'utf8'");
	
	//<<RecordsetQuerySQL
	$result = mysql_query($RecordsetQuerySQL);
	$numfields = mysql_num_fields($result);
	
	$fldTypes = array();
	for($i=0;$i<$numfields;$i++)
	{
		$fldType = mysql_field_type($result, $i);
		if (stripos($fldType, "date") !== false)
		    $fldTypes[$i]=1;
		else if ($fldType == "blob" || $fldType == "image")
		    $fldTypes[$i]=2;
		else
		    $fldTypes[$i]=0;
	}
	
	$XMLText="<xml>\n";
    while ($row = mysql_fetch_array($result))
	{
		$XMLText.="<row>";
		for($i=0;$i<$numfields;$i++)
		{
			if ($fldTypes[$i] == 2)
				$XMLText.=("<".mysql_field_name($result, $i).">".base64_encode($row[$i])."</".mysql_field_name($result, $i).">");
			else
				$XMLText.=("<".mysql_field_name($result, $i).">".htmlspecialchars($row[$i], ENT_QUOTES)."</".mysql_field_name($result, $i).">");
		}
		$XMLText.="</row>\n";
	}
	$XMLText.="</xml>\n";
	
	mysql_free_result($result);
	//>>RecordsetQuerySQL
	
    $XMLText = "<report>\n" . $XMLText . $ParameterPart . "</report>"; 
	
	ResponseReportData($XMLText, $DataType);
}

//产生报表参数需要的XML节点类型数据，不存在明细记录数据，请参考帮助中“报表插件(WEB报表)->报表数据”中的说明
function XML_GenParameterData($QuerySQL, $DataType=const_DefaultDataType)
{
	$XMLText="<xml>\n";
	$XMLText.=BuildParameterXmlText($QuerySQL);
	$XMLText.="</xml>\n";
	
	ResponseReportData($XMLText, $DataType);
}

//根据ParameterQuerySQL获取的报表参数数据一起打包为XML文字
function BuildParameterXmlText($ParameterQuerySQL)
{
    // connect to mysql server with a user and password
    mysql_connect("localhost", "root", "") or die("couldn't connect: ".mysql_error());
    mysql_select_db("db000");
    mysql_query("set names 'utf8'");
    	
    $result = mysql_query($ParameterQuerySQL);
    $numfields = mysql_num_fields($result);

	$fldTypes = array();
	for($i=0;$i<$numfields;$i++)
	{
		$fldType = mysql_field_type($result, $i);
		if (stripos($fldType, "date") !== false) //if ($fldType == "datetime")
		    $fldTypes[$i]=1;
		else if ($fldType == "blob" || $fldType == "image")
		    $fldTypes[$i]=2;
		else
		    $fldTypes[$i]=0;
	}
	
    $row = mysql_fetch_array($result);
    $ParameterPart = "<_grparam>\r\n";
    for($i=0;$i<$numfields;$i++)
    {
		if ($fldTypes[$i] == 2)
			$ParameterPart.=("<".mysql_field_name($result, $i).">".base64_encode($row[$i])."</".mysql_field_name($result, $i).">");
		else
			$ParameterPart.=("<".mysql_field_name($result, $i).">".htmlspecialchars($row[$i], ENT_QUOTES)."</".mysql_field_name($result, $i).">");
    }
    $ParameterPart .= "</_grparam>\r\n";

    mysql_free_result($result);
    
    return $ParameterPart;
}

function GenNodeXmlData($QuerySQL, $ToCompress)
{
    if ($ToCompress)
        $DataType = const_ZipBinary;
    else
        $DataType = const_PlainText;
    XML_GenDetailData($QuerySQL, $DataType);
}
function GenFullXmlData($RecordsetQuerySQL, $ParameterPart, $ToCompress)
{
    if ($ToCompress)
        $DataType = const_ZipBinary;
    else
        $DataType = const_PlainText;
    XML_GenEntireData($RecordsetQuerySQL, $ParameterPart, $DataType);
}
function GenParameterXmlData($QuerySQL, $ToCompress)
{
    if ($ToCompress)
        $DataType = const_ZipBinary;
    else
        $DataType = const_PlainText;
    XML_GenParameterData($QuerySQL, $DataType);
}
function GenNodeXmlDataForBin64($QuerySQL, $ToCompress)
{
    if ($ToCompress)
        $DataType = const_ZipBinary;
    else
        $DataType = const_PlainText;
    XML_GenDetailData(QuerySQL, $DataType);
}
//>>保留前面版本的函数，兼容以前版本所写程序

?>