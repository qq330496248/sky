<?php

/////////////////////////////////////////////////////////////////////////////////////////
//��������Ķ����¼���� XML ����
function XML_GenMultiRecordset($QueryList, $DataType=const_DefaultDataType)
{
	// connect to DSN with a user and password
	$connect = odbc_connect("WebReport", "sa", "") or die("couldn't connect to database");
	odbc_exec($connect, "use GridReport");
    
	$XMLText="<xml>\n";
    foreach ($QueryList as $RecordsetName => $QuerySQL) 
    {
        //echo "Key: $key; Value: $value<br>\n";
	    $result = odbc_query($QuerySQL);
    	
	    $fldTypes = array();
	    $numfields = odbc_num_fields($result);
	    for($i=0;$i<$numfields;$i++)
	    {
		    $fldType = odbc_field_type($result, $i);
		    if (stripos($fldType, "date") !== false)
		        $fldTypes[$i]=1;
		    else if ($fldType == "blob" || $fldType == "image")
		        $fldTypes[$i]=2;
		    else
		        $fldTypes[$i]=0;
	    }
    	
        while ($row = odbc_fetch_array($result))
	    {
		    $XMLText.="<".$RecordsetName.">"; //$XMLText.="<row>";
		    for($i=0;$i<$numfields;$i++)
		    {
			    if ($fldTypes[$i] == 2)
				    $XMLText.=("<".odbc_field_name($result, $i).">".base64_encode($row[$i])."</".odbc_field_name($result, $i).">");
			    else
				    $XMLText.=("<".odbc_field_name($result, $i).">".htmlspecialchars($row[$i], ENT_QUOTES)."</".odbc_field_name($result, $i).">");
		    }
		    $XMLText.="</".$RecordsetName.">\n"; //$XMLText.="</row>\n";
	    }
	    
	    odbc_free_result($result);
	}
	$XMLText.="</xml>\n";
	

	ResponseReportData($XMLText, $DataType);
}

//���������һ����¼���� XML ����
function XML_GenOneRecordset($QuerySQL, $DataType=const_DefaultDataType)
{
    $QueryList = array ("row" => $QuerySQL);
    XML_GenMultiRecordset($QueryList, $DataType);
}

function BatchGetDataCount($QuerySQL)
{
	// connect to DSN with a user and password
	$connect = odbc_connect("WebReport", "sa", "") or die("couldn't connect to database");
	odbc_exec($connect, "use GridReport");
   	
    $result = odbc_query($QuerySQL);
    
    $Total = 0;
    if ($row = odbc_fetch_array($result))
	{
		$Total = $row[0];
	}
    
    odbc_free_result($result);
	odbc_close($connect);
    
    return $Total;
}







/////////////////////////////////////////////////////////////////////////////////////////
//�ر���ʾ�����º���Ϊ������ǰ�汾����������������֮��������ݿ��ǿ�ɾ��֮
//<<����ǰ��汾�ĺ�����������ǰ�汾��д����

//����������Ҫ��XML�ڵ���������
function XML_GenDetailData($QuerySQL, $DataType=const_DefaultDataType)
{
	// connect to DSN MSSQL with a user and password
	$connect = odbc_connect("WebReport", "sa", "") or die("couldn't connect to database");
	odbc_exec($connect, "use GridReport");
    
	$result = odbc_query($QuerySQL);
	$numfields = odbc_num_fields($result);
	
	$fldTypes = array();
	for($i=0;$i<$numfields;$i++)
	{
		$fldType = odbc_field_type($result, $i);
		if (stripos($fldType, "date") !== false)
		    $fldTypes[$i]=1;
		else if ($fldType == "blob" || $fldType == "image")
		    $fldTypes[$i]=2;
		else
		    $fldTypes[$i]=0;
	}
	
	$XMLText="<xml>\n";
    while ($row = odbc_fetch_array($result))
	{
		$XMLText.="<row>";
		for($i=0;$i<$numfields;$i++)
		{
			if ($fldTypes[$i] == 2)
				$XMLText.=("<".odbc_field_name($result, $i).">".base64_encode($row[$i])."</".odbc_field_name($result, $i).">");
			else
				$XMLText.=("<".odbc_field_name($result, $i).">".htmlspecialchars($row[$i], ENT_QUOTES)."</".odbc_field_name($result, $i).">");
		}
		$XMLText.="</row>\n";
	}
	$XMLText.="</xml>\n";
	
	odbc_free_result($result);
	odbc_close($connect);
	
	ResponseReportData($XMLText, $DataType);
}

//����������Ҫ��XML�ڵ���������
//����RecordsetQuerySQL�����ṩ������������Ҫ��XML���ݣ���ͬʱ��ParameterQuerySQL��ȡ�ı����������һ����������ToCompressָ���Ƿ�ѹ������
function XML_GenEntireData($RecordsetQuerySQL, $ParameterPart, $DataType=const_DefaultDataType)
{
	// connect to DSN MSSQL with a user and password
	$connect = odbc_connect("WebReport", "sa", "") or die("couldn't connect to database");
	odbc_exec($connect, "use GridReport");
	
	//<<RecordsetQuerySQL
	$result = odbc_query($RecordsetQuerySQL);
	$numfields = odbc_num_fields($result);
	
	$fldTypes = array();
	for($i=0;$i<$numfields;$i++)
	{
		$fldType = odbc_field_type($result, $i);
		if (stripos($fldType, "date") !== false)
		    $fldTypes[$i]=1;
		else if ($fldType == "blob" || $fldType == "image")
		    $fldTypes[$i]=2;
		else
		    $fldTypes[$i]=0;
	}
	
	$XMLText="<xml>\n";
    while ($row = odbc_fetch_array($result))
	{
		$XMLText.="<row>";
		for($i=0;$i<$numfields;$i++)
		{
			if ($fldTypes[$i] == 2)
				$XMLText.=("<".odbc_field_name($result, $i).">".base64_encode($row[$i])."</".odbc_field_name($result, $i).">");
			else
				$XMLText.=("<".odbc_field_name($result, $i).">".htmlspecialchars($row[$i], ENT_QUOTES)."</".odbc_field_name($result, $i).">");
		}
		$XMLText.="</row>\n";
	}
	$XMLText.="</xml>\n";
	
	odbc_free_result($result);
	odbc_close($connect);
	//>>RecordsetQuerySQL
	
    $XMLText = "<report>\n" . $XMLText . $ParameterPart . "</report>"; 
	
	ResponseReportData($XMLText, $DataType);
}

//�������������Ҫ��XML�ڵ��������ݣ���������ϸ��¼���ݣ���ο������С�������(WEB����)->�������ݡ��е�˵��
function XML_GenParameterData($QuerySQL, $DataType=const_DefaultDataType)
{
	$XMLText="<xml>\n";
	$XMLText.=BuildParameterXmlText($QuerySQL);
	$XMLText.="</xml>\n";
	
	ResponseReportData($XMLText, $DataType);
}

/////////////////////////////////////////////////////////////////////////////////////////
//����ParameterQuerySQL��ȡ�ı����������һ����ΪXML����
function BuildParameterXmlText($ParameterQuerySQL)
{
	// connect to DSN MSSQL with a user and password
	$connect = odbc_connect("WebReport", "sa", "") or die("couldn't connect to database");
	odbc_exec($connect, "use GridReport");
    	
    $result = odbc_query($ParameterQuerySQL);
    $numfields = odbc_num_fields($result);

	$fldTypes = array();
	for($i=0;$i<$numfields;$i++)
	{
		$fldType = odbc_field_type($result, $i);
		if (stripos($fldType, "date") !== false) //if ($fldType == "datetime")
		    $fldTypes[$i]=1;
		else if ($fldType == "blob" || $fldType == "image")
		    $fldTypes[$i]=2;
		else
		    $fldTypes[$i]=0;
	}
	
    $row = odbc_fetch_array($result);
    $ParameterPart = "<_grparam>\r\n";
    for($i=0;$i<$numfields;$i++)
    {
		if ($fldTypes[$i] == 2)
			$ParameterPart.=("<".odbc_field_name($result, $i).">".base64_encode($row[$i])."</".odbc_field_name($result, $i).">");
		else
			$ParameterPart.=("<".odbc_field_name($result, $i).">".htmlspecialchars($row[$i], ENT_QUOTES)."</".odbc_field_name($result, $i).">");
    }
    $ParameterPart .= "</_grparam>\r\n";

    odbc_free_result($result);
	odbc_close($connect);
    
    return $ParameterPart;
}

//�����ֶ����ͣ����ڵ����з����Ӷε���������
function ListFieldType($QuerySQL)
{
	header("Content-Type: text/plain");

	// connect to DSN MSSQL with a user and password
	$connect = odbc_connect("WebReport", "sa", "") or die("couldn't connect to database");
	odbc_exec($connect, "use GridReport");
    
	$result = odbc_query($QuerySQL);
	
	$XMLText="<xml>\n";
	
	$numfields = odbc_num_fields($result);
	for($i=0;$i<$numfields;$i++)
	{
		$XMLText.=(odbc_field_name($result, $i)."=".odbc_field_type($result, $i)."\n");
	}
	
	odbc_free_result($result);
	odbc_close($connect);
	
	$XMLText.="</xml>\n";
    echo $XMLText;
}

/////////////////////////////////////////////////////////////////////////////////////////
function GenNodeXmlData($QuerySQL, $ToCompress) //�ṩ�˺�����Ϊ�˼�����ǰ�����ӳ���
{
    if ($ToCompress)
        $DataType = const_ZipBinary;
    else
        $DataType = const_PlainText;
    XML_GenDetailData($QuerySQL, $DataType);
}
function GenFullXmlData($RecordsetQuerySQL, $ParameterPart, $ToCompress) //�ṩ�˺�����Ϊ�˼�����ǰ�����ӳ���
{
    if ($ToCompress)
        $DataType = const_ZipBinary;
    else
        $DataType = const_PlainText;
    XML_GenEntireData($RecordsetQuerySQL, $ParameterPart, $DataType);
}
function GenParameterXmlData($QuerySQL, $ToCompress) //�ṩ�˺�����Ϊ�˼�����ǰ�����ӳ���
{
    if ($ToCompress)
        $DataType = const_ZipBinary;
    else
        $DataType = const_PlainText;
    XML_GenParameterData($QuerySQL, $DataType);
}
function GenNodeXmlDataForBin64($QuerySQL, $ToCompress) //�ṩ�˺�����Ϊ�˼�����ǰ�����ӳ���
{
    if ($ToCompress)
        $DataType = const_ZipBinary;
    else
        $DataType = const_PlainText;
    XML_GenDetailData(QuerySQL, $DataType);
}
//>>����ǰ��汾�ĺ�����������ǰ�汾��д����
?>