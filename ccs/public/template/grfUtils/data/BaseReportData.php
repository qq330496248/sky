<?php

//以下常量指定报表数据的格式类型
define("const_PlainText", 1); //报表数据为XML或JSON文本，在调试时可以查看报表数据。数据未经压缩，大数据量报表采用此种方式不合适
define("const_ZipBinary", 2); //报表数据为XML或JSON文本经过压缩得到的二进制数据。此种方式数据量最小(约为原始数据的1/10)，但用Ajax方式加载报表数据时不能为此种方式
define("const_ZipBase64", 3); //报表数据为将 ZipBinary 方式得到的数据再进行 BASE64 编码的数据。此种方式适合用Ajax方式加载报表数据

//指定报表的默认数据类型，便于统一定义整个报表系统的数据类型
//在报表开发调试阶段，通常指定为 ResponseDataType.PlainText, 以便在浏览器中查看响应的源文件时能看到可读的文本数据
//在项目部署时，通常指定为 ResponseDataType.ZipBinary 或 ResponseDataType.ZipBase64，这样可以极大减少数据量，提供报表响应速度
define("const_DefaultDataType", const_PlainText);

//将文本形式(XML或JSON)的报表数据响应到网页，根据参数确定是否压缩数据
//$savePlace保存数据的地方
function ResponseReportData($XMLText, $savePlace, $DataType)
{
	if ($DataType == const_PlainText)
	{
        header("Content-Type: text/html; charset=utf-8"); //这里应根据实际运行环境调整，如：utf-8、gbk等
//	    echo $XMLText;
//	    var_dump($XMLText);
//	    file_put_contents('./testYGYJTJBB.txt', '');
	    file_put_contents($savePlace, $XMLText);
	}
	else
	{
	    //写入特有的压缩头部信息，以便报表客户端插件能识别数据
        header("gr_zip_type: deflate");                                      //指定压缩方法
        header("gr_zip_size: ".strval(strlen($XMLText)));                    //指定数据的原始长度
        header("gr_zip_encode: ".iconv_get_encoding('internal_encoding'));   //指定数据的编码方式 utf-8 utf-16 ...
    	
	    //压缩数据并输出
        $compressed = gzdeflate($XMLText); 
	    if ($DataType == const_ZipBinary)
	        echo $compressed;
	    else
	        echo base64_encode($compressed);
	}
}

?>

