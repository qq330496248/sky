/**验证JS，各类正则表达式
*/


//验证是否为数字
function isNum(str){
	if(! str){return false;}
	return (/^[0-9]*$/).test(str);
}

//验证是否为小数
function isPoint(str){
	if(str == ""){return false;}
	return (/^[0-9]+(.[0-9]{1,2})?$/).test(str);
}

//是否为手机或者固话
function isTelPhone(str){
	if(str == ""){return false;}
	return (/^1[3|4|5|8]\d{9}$/).test(str) || (/^([0-9]{3,4}-)?[0-9]{7,8}$/).test(str);

}
//是否为正确Email地址
function isEmail(str){
	if(str == ""){return false;}
	return (/w+([-+.]w+)*@w+([-.]w+)*.w+([-.]w+)*/).test(str);

}
//是否为中文
function isChinese(str){
	if(str == ""){return false;}
	return (/[u4e00-u9fa5]/).test(str);
}

//是否为正确日期
function isTime(str){
	var time = /^([0-2][0-9]):([0-5][0-9]):([0-5][0-9])$/;
	var result = true;
	if(str == ""){
		result = false;
	}else{
		if(time.test(str)){
			if ((parseInt(RegExp.$1) < 24) && (parseInt(RegExp.$2) < 60) && (parseInt(RegExp.$3) < 60)) {
	            result = false;
	        }
	    }
	}
	return result;
}