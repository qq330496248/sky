$(function(){
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;
	var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();

	var begin = year + "-" + month + "-" + day;
	var end  = year + "-" + month + "-" + day;

	$("#xdsjq").val(begin);
	$("#xdsjz").val(end);

	/*$.post("index.php?r=mtgl/GetGgxgfxbb",function(data){
		getTable(data);
	},"json");*/
});


function getTable(data){
	if(data.result == "success"){
		$("#ggxgfxbb").empty();
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
			var listInfo = '<tr class="singular"><td>'+ data.list[i]['mediatext'] +'</td>'
							+'<td>'+ data.list[i]['fee']['fee'] +'</td>'
							+'<td>'+ data.list[i]['people']['num'] +'</td>'
							+'<td>'+ data.list[i]['peopleCost'] +'</td>'
							+'<td><font color="#0000FF">'+ data.list[i]['xdlist']['num'] +'</font>/<font color="#FF0000">'+ data.list[i]['xdlist']['money'] +'</font></td>'
							+'<td>'+ data.list[i]['xdRatio'] +'</td>'
							+'<td>'+ data.list[i]['payRatio'] +'</td>'
							+'<td><font color="#0000FF">'+ data.list[i]['sdlist']['num'] +'</font>/<font color="#FF0000">'+ data.list[i]['sdlist']['money'] +'</font></td>'
							+'<td>'+ data.list[i]['sdRatio'] +'</td>'
							+'<td>'+ data.list[i]['AVGCost'] +'</td>'
							+'<td>'+ data.list[i]['AVGPrice'] +'</td>'
							+'<td><font color="#0000FF">'+ data.list[i]['fhlist']['num'] +'</font>/<font color="#FF0000">'+ data.list[i]['fhlist']['money'] +'</font></td>'
							+'<td><font color="#0000FF">'+ data.list[i]['qslist']['num'] +'</font>/<font color="#FF0000">'+ data.list[i]['qslist']['money'] +'</font></td>'
							+'<td><font color="#0000FF">'+ data.list[i]['jslist']['num'] +'</font>/<font color="#FF0000">'+ data.list[i]['jslist']['money'] +'</font></td>'
							+'<td><a href="">报表查询</a></td></tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex"><td>'+ data.list[i+1]['mediatext'] +'</td>'
							+'<td>'+ data.list[i+1]['fee']['fee'] +'</td>'
							+'<td>'+ data.list[i+1]['people']['num'] +'</td>'
							+'<td>'+ data.list[i+1]['peopleCost'] +'</td>'
							+'<td><font color="#0000FF">'+ data.list[i+1]['xdlist']['num'] +'</font>/<font color="#FF0000">'+ data.list[i+1]['xdlist']['money'] +'</font></td>'
							+'<td>'+ data.list[i+1]['xdRatio'] +'</td>'
							+'<td>'+ data.list[i+1]['payRatio'] +'</td>'
							+'<td><font color="#0000FF">'+ data.list[i+1]['sdlist']['num'] +'</font>/<font color="#FF0000">'+ data.list[i+1]['sdlist']['money'] +'</font></td>'
							+'<td>'+ data.list[i+1]['sdRatio'] +'</td>'
							+'<td>'+ data.list[i+1]['AVGCost'] +'</td>'
							+'<td>'+ data.list[i+1]['AVGPrice'] +'</td>'
							+'<td><font color="#0000FF">'+ data.list[i+1]['fhlist']['num'] +'</font>/<font color="#FF0000">'+ data.list[i+1]['fhlist']['money'] +'</font></td>'
							+'<td><font color="#0000FF">'+ data.list[i+1]['qslist']['num'] +'</font>/<font color="#FF0000">'+ data.list[i+1]['qslist']['money'] +'</font></td>'
							+'<td><font color="#0000FF">'+ data.list[i+1]['jslist']['num'] +'</font>/<font color="#FF0000">'+ data.list[i+1]['jslist']['money'] +'</font></td>'
							+'<td><a href="">报表查询</a></td></tr>';
			}
			$("#ggxgfxbb").append(listInfo);
		}
		var tfoot = '<tr><td>总计</td>'
						+'<td>'+ data.advertFee +'</td>'
						+'<td>'+ data.peopleNum +'</td>'
						+'<td>'+ data.peopleCost +'</td>'
						+'<td><font color="#0000FF">'+ data.xdCount +'</font>/<font color="#FF0000">'+ data.xdMoney +'</font></td>'
						+'<td>'+ data.totalXDRatio +'</td>'
						+'<td>'+ data.totalPayRatio +'</td>'
						+'<td><font color="#0000FF">'+ data.sdCount +'</font>/<font color="#FF0000">'+ data.sdMoney +'</font></td>'
						+'<td>'+ data.totalSDRatio +'</td>'
						+'<td>'+ data.totalAVGCost +'</td>'
						+'<td>'+ data.totalAVGPrice +'</td>'
						+'<td><font color="#0000FF">'+ data.fhCount +'</font>/<font color="#FF0000">'+ data.fhMoney +'</font></td>'
						+'<td><font color="#0000FF">'+ data.qsCount +'</font>/<font color="#FF0000">'+ data.qsMoney +'</font></td>'
						+'<td><font color="#0000FF">'+ data.jsCount +'</font>/<font color="#FF0000">'+ data.jsMoney +'</font></td>'
						+'<td></td></tr>';
		$("#tfoot").append(tfoot);
	}
}


function getGgxgfxbb(){
	var beginDate = $("#xdsjq").val();
	var endDate = $("#xdsjz").val();
	var dept = $("#dept").val();

	$.post("index.php?r=mtgl/GetGgxgfxbb",{beginDate:beginDate,endDate:endDate,dept:dept},function(data){
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
	$.post("index.php?r=mtgl/GetGgxgfxbb",{day:str,dept:dept},function(data){
		getTable(data);
	},"json");
}


function changeDay(str){
	var beginDate = $("#hiddenBeginDate").val();
	var endDate = $("#hiddenEndDate").val();

	var dept = $("#dept").val();
	$.post("index.php?r=mtgl/GetGgxgfxbb",{beginDate:beginDate,endDate:endDate,day:str,dept:dept},function(data){
		getTable(data);
	},"json");
}

function changeType(str){
	var beginDate = $("#xdsjq").val();
	var endDate = $("#xdsjz").val();
	$("#ope").attr('style',''); 
	$("#xd").attr('style',''); 
	$("#"+str).attr('style','color:#000000; background:#999999;'); 
	$("#type").val(str);

	var dept = $("#dept").val();
	$.post("index.php?r=mtgl/GetGgxgfxbb",{beginDate:beginDate,endDate:endDate,type:str,dept:dept},function(data){
		getTable(data);
	},"json");
}