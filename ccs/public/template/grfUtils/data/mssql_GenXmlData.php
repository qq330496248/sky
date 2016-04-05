<?php

/////////////////////////////////////////////////////////////////////////////////////////
//产生报表的多个记录集的 XML 数据
function XML_GenMultiRecordset($QueryList, $DataType=const_DefaultDataType)
{
	// connect to mssql server with a user and password
	mssql_connect("", "sa", "") or die("couldn't connect: ".mssql_error());
    mssql_select_db("GridReport");
    
	$XMLText="<xml>\n";
    foreach ($QueryList as $RecordsetName => $QuerySQL) 
    {
        //echo "Key: $key; Value: $value<br>\n";
	    $result = mssql_query($QuerySQL);
    	
	    $fldTypes = array();
	    $numfields = mssql_num_fields($result);
	    for($i=0;$i<$numfields;$i++)
	    {
		    $fldType = mssql_field_type($result, $i);
		    if (stripos($fldType, "date") !== false)
		        $fldTypes[$i]=1;
		    else if ($fldType == "blob" || $fldType == "image")
		        $fldTypes[$i]=2;
		    else
		        $fldTypes[$i]=0;
	    }
    	
        while ($row = mssql_fetch_array($result))
	    {
		    $XMLText.="<".$RecordsetName.">"; //$XMLText.="<row>";
		    for($i=0;$i<$numfields;$i++)
		    {
			    if ($fldTypes[$i] == 2)
				    $XMLText.=("<".mssql_field_name($result, $i).">".base64_encode($row[$i])."</".mssql_field_name($result, $i).">");
			    else
				    $XMLText.=("<".mssql_field_name($result, $i).">".htmlspecialchars($row[$i], ENT_QUOTES)."</".mssql_field_name($result, $i).">");
		    }
		    $XMLText.="</".$RecordsetName.">\n"; //$XMLText.="</row>\n";
	    }
	    
	    mssql_free_result($result);
	}
	$XMLText.="</xml>\n";
	

	ResponseReportData($XMLText, $DataType);
}

//产生报表的一个记录集的 XML 数据
function XML_GenOneRecordset($QuerySQL, $DataType=const_DefaultDataType)
{
    $QueryList = array ("row" => $QuerySQL);
    XML_GenMultiRecordset($QueryList, $DataType);
}

function BatchGetDataCount($QuerySQL)
{
	// connect to mssql server with a user and password
	mssql_connect("", "sa", "") or die("couldn't connect: ".mssql_error());
    mssql_select_db("GridReport");
   	
    $result = mssql_query($QuerySQL);
    
    $Total = 0;
    if ($row = mssql_fetch_array($result))
	{
		$Total = $row[0];
	}
    
    mssql_free_result($result);
    
    return $Total;
}








/////////////////////////////////////////////////////////////////////////////////////////
//特别提示：以下函数为兼容以前版本而保留，请勿再用之，无须兼容考虑可删除之
//<<保留前面版本的函数，兼容以前版本所写程序

//产生报表需要的XML节点类型数据
function XML_GenDetailData($QuerySQL, $DataType=const_DefaultDataType)
{
	// connect to mssql server with a user and password
	mssql_connect("", "sa", "") or die("couldn't connect: ".mssql_error());
    mssql_select_db("GridReport");
    
	$result = mssql_query($QuerySQL);
	$numfields = mssql_num_fields($result);
	
	$fldTypes = array();
	for($i=0;$i<$numfields;$i++)
	{
		$fldType = mssql_field_type($result, $i);
		if (stripos($fldType, "date") !== false)
		    $fldTypes[$i]=1;
		else if ($fldType == "blob" || $fldType == "image")
		    $fldTypes[$i]=2;
		else
		    $fldTypes[$i]=0;
	}
	
	$XMLText="<xml>\n";
    while ($row = mssql_fetch_array($result))
	{
		$XMLText.="<row>";
		for($i=0;$i<$numfields;$i++)
		{
			if ($fldTypes[$i] == 2)
				$XMLText.=("<".mssql_field_name($result, $i).">".base64_encode($row[$i])."</".mssql_field_name($result, $i).">");
			else
				$XMLText.=("<".mssql_field_name($result, $i).">".htmlspecialchars($row[$i], ENT_QUOTES)."</".mssql_field_name($result, $i).">");
		}
		$XMLText.="</row>\n";
	}
	$XMLText.="</xml>\n";
	
	mssql_free_result($result);
	
	ResponseReportData($XMLText, $DataType);
}

//产生报表需要的XML节点类型数据
//根据RecordsetQuerySQL产生提供给报表生成需要的XML数据，并同时将ParameterQuerySQL或取的报表参数数据一起打包，参数ToCompress指定是否压缩数据
function XML_GenEntireData($RecordsetQuerySQL, $ParameterPart, $DataType=const_DefaultDataType)
{
	// connect to mssql server with a user and password
	mssql_connect("", "sa", "") or die("couldn't connect: ".mssql_error());
    mssql_select_db("GridReport");
	
	//<<RecordsetQuerySQL
	$result = mssql_query($RecordsetQuerySQL);
	$numfields = mssql_num_fields($result);
	
	$fldTypes = array();
	for($i=0;$i<$numfields;$i++)
	{
		$fldType = mssql_field_type($result, $i);
		if (stripos($fldType, "date") !== false)
		    $fldTypes[$i]=1;
		else if ($fldType == "blob" || $fldType == "image")
		    $fldTypes[$i]=2;
		else
		    $fldTypes[$i]=0;
	}
	
	$XMLText="<xml>\n";
    while ($row = mssql_fetch_array($result))
	{
		$XMLText.="<row>";
		for($i=0;$i<$numfields;$i++)
		{
			if ($fldTypes[$i] == 2)
				$XMLText.=("<".mssql_field_name($result, $i).">".base64_encode($row[$i])."</".mssql_field_name($result, $i).">");
			else
				$XMLText.=("<".mssql_field_name($result, $i).">".htmlspecialchars($row[$i], ENT_QUOTES)."</".mssql_field_name($result, $i).">");
		}
		$XMLText.="</row>\n";
	}
	$XMLText.="</xml>\n";
	
	mssql_free_result($result);
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

/////////////////////////////////////////////////////////////////////////////////////////
//根据ParameterQuerySQL获取的报表参数数据一起打包为XML文字
function BuildParameterXmlText($ParameterQuerySQL)
{
	// connect to mssql server with a user and password
	mssql_connect("", "sa", "") or die("couldn't connect: ".mssql_error());
    mssql_select_db("GridReport");
    	
    $result = mssql_query($ParameterQuerySQL);
    $numfields = mssql_num_fields($result);

	$fldTypes = array();
	for($i=0;$i<$numfields;$i++)
	{
		$fldType = mssql_field_type($result, $i);
		if (stripos($fldType, "date") !== false) //if ($fldType == "datetime")
		    $fldTypes[$i]=1;
		else if ($fldType == "blob" || $fldType == "image")
		    $fldTypes[$i]=2;
		else
		    $fldTypes[$i]=0;
	}
	
    $row = mssql_fetch_array($result);
    $ParameterPart = "<_grparam>\r\n";
    for($i=0;$i<$numfields;$i++)
    {
		if ($fldTypes[$i] == 2)
			$ParameterPart.=("<".mssql_field_name($result, $i).">".base64_encode($row[$i])."</".mssql_field_name($result, $i).">");
		else
			$ParameterPart.=("<".mssql_field_name($result, $i).">".htmlspecialchars($row[$i], ENT_QUOTES)."</".mssql_field_name($result, $i).">");
    }
    $ParameterPart .= "</_grparam>\r\n";

    mssql_free_result($result);
    
    return $ParameterPart;
}

//产生字段类型，用于调试中分析子段的类型名称
function ListFieldType($QuerySQL)
{
	header("Content-Type: text/plain");

	// connect to mssql server with a user and password
	mssql_connect("", "sa", "") or die("couldn't connect: ".mssql_error());
    mssql_select_db("GridReport");
    
	$result = mssql_query($QuerySQL);
	
	$XMLText="<xml>\n";
	
	$numfields = mssql_num_fields($result);
	for($i=0;$i<$numfields;$i++)
	{
		$XMLText.=(mssql_field_name($result, $i)."=".mssql_field_type($result, $i)."\n");
	}
	
	mssql_free_result($result);
	
	$XMLText.="</xml>\n";
    echo $XMLText;
}

/////////////////////////////////////////////////////////////////////////////////////////
function GenNodeXmlData($QuerySQL, $ToCompress) //提供此函数是为了兼容以前的例子程序
{
    if ($ToCompress)
        $DataType = const_ZipBinary;
    else
        $DataType = const_PlainText;
    XML_GenDetailData($QuerySQL, $DataType);
}
function GenFullXmlData($RecordsetQuerySQL, $ParameterPart, $ToCompress) //提供此函数是为了兼容以前的例子程序
{
    if ($ToCompress)
        $DataType = const_ZipBinary;
    else
        $DataType = const_PlainText;
    XML_GenEntireData($RecordsetQuerySQL, $ParameterPart, $DataType);
}
function GenParameterXmlData($QuerySQL, $ToCompress) //提供此函数是为了兼容以前的例子程序
{
    if ($ToCompress)
        $DataType = const_ZipBinary;
    else
        $DataType = const_PlainText;
    XML_GenParameterData($QuerySQL, $DataType);
}
function GenNodeXmlDataForBin64($QuerySQL, $ToCompress) //提供此函数是为了兼容以前的例子程序
{
    if ($ToCompress)
        $DataType = const_ZipBinary;
    else
        $DataType = const_PlainText;
    XML_GenDetailData(QuerySQL, $DataType);
}
//>>保留前面版本的函数，兼容以前版本所写程序
?>