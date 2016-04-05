$(function(){
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;
	var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();

	var begin = year + "-" + month + "-01";
	var end  = year + "-" + month + "-" + day;

	$("#xdsjq").val(begin);
	$("#xdsjz").val(end);

	$.post("index.php?r=flbb/GetJxyxlbb",function(data){
		getTable(data);
	},"json");
});


function getTable(data){
	if(data.result == 'success'){
		$("#jxyxlbb").empty();
		$("#tfoot").empty();

		var date = new Date();//获取当前时间
		//用作对比的时间
		var year = date.getFullYear();//年
		var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;//月
		var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();//日
		var demoDate = year + "-" + month + "-" + day;
		if(Date.parse(demoDate) <= Date.parse(data.endDate)){
			$("#nextDay").attr('style','background:#999999');
			$("#nextDay").attr('disabled','disabled');
			$("#nextSeven").attr('style','background:#999999');
			$("#nextSeven").attr('disabled','disabled');
			$("#nextThirty").attr('style','background:#999999');
			$("#nextThirty").attr('disabled','disabled');
			$("#nextMonth").attr('style','background:#999999');
			$("#nextMonth").attr('disabled','disabled');
		}else{
			$("#nextDay").attr('style','');
			$("#nextDay").removeAttr('disabled');
			$("#nextSeven").attr('style','');
			$("#nextSeven").removeAttr('disabled');
			$("#nextThirty").attr('style','');
			$("#nextThirty").removeAttr('disabled');
			$("#nextMonth").attr('style','');
			$("#nextMonth").removeAttr('disabled');
		}

		var length = data.list.length;
		for(var i = 0; i < length; i += 2){
			var listInfo = '<tr class="singular">'
							+'<td><span>'+ data.list[i]['username'] +':'+ data.list[i]['personname'] +'</span></td>'
							+'<td><span>'+ data.list[i]['bhcs']['num'] +'</span></td>'
							+'<td><span>'+ data.list[i]['jtcs']['num'] +'</span></td>'
							+'<td><span>'+ data.list[i]['khzs']['num'] +'</span></td>'
							+'<td><span>'+ data.list[i]['wxkh']['num'] +'</span></td>'
							+'<td><font style="">'+ data.list[i]['wxRatio'] +'</font></td></tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex">'
							+'<td><span>'+ data.list[i+1]['username'] +':'+ data.list[i+1]['personname'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['bhcs']['num'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['jtcs']['num'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['khzs']['num'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['wxkh']['num'] +'</span></td>'
							+'<td><font style="">'+ data.list[i+1]['wxRatio'] +'</font></td></tr>';
			}
			$("#jxyxlbb").append(listInfo);
		}
		var tfoot = '<tr>'
					+'<td><span>总计：'+ data.ryNum +' 人</span></td>'
					+'<td><span>'+ data.bhCount +'</span></td>'
					+'<td><span>'+ data.jtCount +'</span></td>'
					+'<td><span>'+ data.khCount +'</span></td>'
					+'<td><span>'+ data.wxCount +'</span></td>'
					+'<td><font style="">'+ data.totalWXRatio +'</font></td></tr>';
		$("#tfoot").append(tfoot);
	}
}



function getJxyxlbb(){
	var beginDate = $("#xdsjq").val();
	var endDate = $("#xdsjz").val();
	var dept = $("#dept").val();
	$.post("index.php?r=flbb/GetJxyxlbb",{beginDate:beginDate,endDate:endDate,dept:dept},function(data){
		getTable(data);
	},"json");
}

//选择日期区间
function selectDay(str){
	//五个按键样式改变
	$("#today").attr('style','');
	$("#yesterday").attr('style','');
	$("#seven").attr('style','');
	$("#thirty").attr('style','');
	$("#month").attr('style','');
	$("#"+str).attr('style','color:#000000; background:#999999;');

	//根据按键变化的前后按键（前一天，后一天 || 前七天，后七天 等等）
	$("#todayDiv").attr('style','display:none');
	$("#sevenDiv").attr('style','display:none');
	$("#thirtyDiv").attr('style','display:none');
	$("#monthDiv").attr('style','display:none');
	$("#"+str+"Div").attr('style','display:block');

	//往后选择的按键都不可用
	$("#nextDay").attr('style','background:#999999');
	$("#nextDay").attr('disabled','disabled');
	$("#nextSeven").attr('style','background:#999999');
	$("#nextSeven").attr('disabled','disabled');
	$("#nextThirty").attr('style','background:#999999');
	$("#nextThirty").attr('disabled','disabled');
	$("#nextMonth").attr('style','background:#999999');
	$("#nextMonth").attr('disabled','disabled');

	//如果选择昨天，做出修改
	if(str == 'yesterday'){
		$("#todayDiv").attr('style','display:block');
		$("#nextDay").removeAttr('disabled');
		$("#nextDay").attr('style','');
	}

	var dept = $("#dept").val();
	$.post("index.php?r=flbb/GetJxyxlbb",{day:str,dept:dept},function(data){
		getTable(data);
	},"json");
}


function changeDay(str){
	var beginDate = $("#hiddenBeginDate").val();
	var endDate = $("#hiddenEndDate").val();
	var dept = $("#dept").val();
	var type = $("#type").val();
	$.post("index.php?r=flbb/GetJxyxlbb",{beginDate:beginDate,endDate:endDate,day:str,dept:dept,type:type},function(data){
		getTable(data);
	},"json");
}

