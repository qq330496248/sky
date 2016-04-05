$(function(){
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;
	var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();

	var begin = year + "-" + month + "-01";
	var end  = year + "-" + month + "-" + day;

	$("#xdsjq").val(begin);
	$("#xdsjz").val(end);

	/*$.post("index.php?r=flbb/GetYgkhtjbb",function(data){
		getTable(data);
	},"json");*/
});


function getTable(data){
	if(data.result == 'success'){
		$("#ygkhtjbb").empty();
		$("#tfoot").empty();
		var length = data.list.length;
		for(var i = 0; i <length; i += 2){
			if(data.list[i]['punish']['score'] == null){
				data.list[i]['punish']['score'] = 0;
			}
			if(data.list[i]['reward']['score'] == null){
				data.list[i]['reward']['score'] = 0;
			}
			var listInfo = '<tr class="singular">'
							+'<td><span>'+ data.list[i]['username'] +'</span></td>'
							+'<td><span>'+ data.list[i]['personname'] +'</span></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['punish']['num'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['punish']['score'] +'</font></td>'
							+'<td><font style="color:#0000FF">'+ data.list[i]['reward']['num'] +'</font></td>'
							+'<td><font style="color:#0000FF">'+ data.list[i]['reward']['score'] +'</font></td>'
							+'<td><font style="">'+ data.list[i]['totalScore'] +'</font></td></tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex">'
							+'<td><span>'+ data.list[i+1]['username'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['personname'] +'</span></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i+1]['punish']['num'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i+1]['punish']['score'] +'</font></td>'
							+'<td><font style="color:#0000FF">'+ data.list[i+1]['reward']['num'] +'</font></td>'
							+'<td><font style="color:#0000FF">'+ data.list[i+1]['reward']['score'] +'</font></td>'
							+'<td><font style="">'+ data.list[i+1]['totalScore'] +'</font></td></tr>';
			}
			$("#ygkhtjbb").append(listInfo);
		}
		var tfoot = '<tr>'
						+'<td colspan="2"><span></span></td>'
						+'<td><font style="color:#FF0000">'+ data.totalPunishTime +'</font></td>'
						+'<td><font style="color:#FF0000">'+ data.totalPunishScore +'</font></td>'
						+'<td><font style="color:#0000FF">'+ data.totalRewardTime +'</font></td>'
						+'<td><font style="color:#0000FF">'+ data.totalRewardScore +'</font></td>'
						+'<td><font style="">'+ data.totalScore +'</font></td></tr>';

		$("#tfoot").append(tfoot);
	}
}


function getYgkhtjbb(){
	var dept = $("#dept").val();
	var beginDate = $("#xdsjq").val();
	var endDate = $("#xdsjz").val();

	$.post("index.php?r=flbb/GetYgkhtjbb",{dept:dept,beginDate:beginDate,endDate:endDate},function(data){
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

	$.post("index.php?r=flbb/GetYgkhtjbb",{day:str},function(data){
		getTable(data);
	},"json");
}


function changeDay(str){
	var beginDate = $("#hiddenBeginDate").val();
	var endDate = $("#hiddenEndDate").val();
	var dept = $("#dept").val();
	$.post("index.php?r=flbb/GetYgkhtjbb",{dept:dept,beginDate:beginDate,endDate:endDate,day:str},function(data){
		getTable(data);
	},"json");
}