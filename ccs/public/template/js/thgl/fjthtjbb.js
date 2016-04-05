$(function(){
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;
	var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();

	var begin = year + "-" + month + "-" + day;
	var end  = year + "-" + month + "-" + day;

	$("#xdsjq").val(begin);
	$("#xdsjz").val(end);

	/*$.post("index.php?r=thgl/GetFjthtjbb",function(data){
		getTable(data);
	},"json");*/
});


function getTable(data){
	if(data.result == "success"){
		$("#xdsjq").val(data.beginDate);//从后台传来的时间显示
		$("#xdsjz").val(data.endDate);//同上
		$("#hiddenBeginDate").val(data.beginDate);//防误操
		$("#hiddenEndDate").val(data.endDate);//防误操
		
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

		$("#fjthtjbb").empty();
		$("#tfoot").empty();

		var length = data.list.length;
		for(var i = 0; i < length; i ++){
			var listInfo = '<tr><td>'+ data.list[i]['username'] +'</td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['ybdh']['count'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['ybdh']['time'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['yjdh']['count'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['yjdh']['time'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['wjdh']['count'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['wjdh']['time'] +'</font></td>'
							+'<td>'+ data.list[i]['noCallRatio'] +'</td>'
							+'<td>'+ data.list[i]['allTime'] +'</td></tr>';

			$("#fjthtjbb").append(listInfo);
		}
		var tfoot = '<tr><th>总计：</th>'
						+'<th><font style="color:#FF0000">'+ data.ybCount +'</font>/<font style="color:#0000FF">'+ data.ybTime +'</font></th>'
						+'<th><font style="color:#FF0000">'+ data.yjCount +'</font>/<font style="color:#0000FF">'+ data.yjTime +'</font></th>'
						+'<th><font style="color:#FF0000">'+ data.wjCount +'</font>/<font style="color:#0000FF">'+ data.wjTime +'</font></th>'
						+'<th>'+ data.noCallRatio +'</td>'
						+'<th>'+ data.totalTime +'</td></tr>';

		$("#tfoot").append(tfoot);
	}
}



function getFjthtjbb(){
	var beginDate = $("#xdsjq").val();
	var endDate = $("#xdsjz").val();
	var dept = $("#dept").val();

	$.post("index.php?r=thgl/GetFjthtjbb",{beginDate:beginDate,endDate:endDate,dept:dept},function(data){
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
	$.post("index.php?r=thgl/GetFjthtjbb",{day:str,dept:dept},function(data){
		getTable(data);
	},"json");
}


function changeDay(str){
	var beginDate = $("#hiddenBeginDate").val();
	var endDate = $("#hiddenEndDate").val();

	var dept = $("#dept").val();
	$.post("index.php?r=thgl/GetFjthtjbb",{beginDate:beginDate,endDate:endDate,day:str,dept:dept},function(data){
		getTable(data);
	},"json");
}