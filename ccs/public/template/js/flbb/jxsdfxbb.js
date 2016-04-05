$(function(){
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;
	var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();

	var begin = year + "-" + month + "-01";
	var end  = year + "-" + month + "-" + day;

	$("#xdsjq").val(begin);
	$("#xdsjz").val(end);

	/*$.post("index.php?r=flbb/GetJxsdfxbb",function(data){
		getTable(data);
	},"json");*/
});

function getTable(data){
	if(data.result == "success"){
		$("#xdsjq").val(data.beginDate);//从后台传来的时间显示
		$("#xdsjz").val(data.endDate);//同上
		$("#hiddenBeginDate").val(data.beginDate);//防误操
		$("#hiddenEndDate").val(data.endDate);//防误操
		
		$("#jxshfxbb").empty();
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
							+'<td>'+ data.list[i]['timeStr'] +'</td>'
							+'<td>'+ data.list[i]['people']['num'] +'</td>'
							+'<td><font style="color:#0000FF">'+ data.list[i]['rsRatio'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['qrlist']['orders'] 
							+'</font>/<font style="color:#0000FF">'+ data.list[i]['qrlist']['money'] +'</font></td>'
							+'<td><font style="color:#0000FF">'+ data.list[i]['qrRatio'] +'</font></td></tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex">'
							+'<td>'+ data.list[i+1]['timeStr'] +'</td>'
							+'<td>'+ data.list[i+1]['people']['num'] +'</td>'
							+'<td><font style="color:#0000FF">'+ data.list[i+1]['rsRatio'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i+1]['qrlist']['orders'] 
							+'</font>/<font style="color:#0000FF">'+ data.list[i+1]['qrlist']['money'] +'</font></td>'
							+'<td><font style="color:#0000FF">'+ data.list[i+1]['qrRatio'] +'</font></td></tr>';
			}
			$("#jxshfxbb").append(listInfo);				
		}

		var tfoot = '<tr><td>总计：</td>'
					+'<td><font style="color:#FF0000">'+ data.peopleNum + '</font></td><td></td>'
					+'<td><font style="color:#FF0000">'+ data.qrNum + '</font>/<font style="color:#0000FF">'+ data.qrMoney + '</font></td><td></td></tr>';
		$("#tfoot").append(tfoot);
	}
}


function getJxsdfxbb(){
	var beginDate = $("#xdsjq").val();
	var endDate = $("#xdsjz").val();
	var dept = $("#dept").val();
	var khyx = $("#khyx").val();
	$.post("index.php?r=flbb/GetJxsdfxbb",{beginDate:beginDate,endDate:endDate,dept:dept,khyx:khyx},function(data){
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
	var khyx = $("#khyx").val();
	$.post("index.php?r=flbb/GetJxsdfxbb",{day:str,dept:dept,khyx:khyx},function(data){
		getTable(data);
	},"json");
}


function changeDay(str){
	var beginDate = $("#hiddenBeginDate").val();
	var endDate = $("#hiddenEndDate").val();

	var dept = $("#dept").val();
	var khyx = $("#khyx").val();
	$.post("index.php?r=flbb/GetJxsdfxbb",{beginDate:beginDate,endDate:endDate,day:str,dept:dept,khyx:khyx},function(data){
		getTable(data);
	},"json");
}