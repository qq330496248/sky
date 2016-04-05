$(function(){
	var dept = $("#dept").val();
	$.post("index.php?r=flbb/GetFztjbbChart",{dept:dept},function(data){
		getTable(data);	
	},"json");
});

function getTable(data){
	if(data.result == "success"){
		var date = new Date();//获取当前时间
		//用作对比的时间
		var year = date.getFullYear();//年
		var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;//月
		var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();//日
		var demoDate = year + "-" + month + "-" + day;
		//如果返回的时间大于等于今天
		if(Date.parse(demoDate) <= Date.parse(data.endDate)){
			//前15天，最近15天，不可用
			$("#nextFifteenDays").attr('style','cursor:not-allowed;color:#FFFFFF;');
			$("#nextFifteenDays").attr('disabled','disabled');
			$("#days2").attr('style','cursor:not-allowed;color:#FFFFFF;');
			$("#days2").attr('disabled','disabled');
			//前15周，最近15周，不可用
			$("#nextFifteenWeeks").attr('style','cursor:not-allowed;color:#FFFFFF;');
			$("#nextFifteenWeeks").attr('disabled','disabled');
			$("#weeks2").attr('style','cursor:not-allowed;color:#FFFFFF;');
			$("#weeks2").attr('disabled','disabled');
			//前15月，最近15月，不可用
			$("#nextFifteenMonths").attr('style','cursor:not-allowed;color:#FFFFFF;');
			$("#nextFifteenMonths").attr('disabled','disabled');
			$("#months2").attr('style','cursor:not-allowed;color:#FFFFFF;');
			$("#months2").attr('disabled','disabled');
		}else{
			//前15天，最近15天，可用
			$("#nextFifteenDays").attr('style','');
			$("#nextFifteenDays").removeAttr('disabled');
			$("#days2").attr('style','');
			$("#days2").removeAttr('disabled');
			//前15周，最近15周，可用
			$("#nextFifteenWeeks").attr('style','');
			$("#nextFifteenWeeks").removeAttr('disabled');
			$("#weeks2").attr('style','');
			$("#weeks2").removeAttr('disabled');
			//前15月，最近15月，可用
			$("#nextFifteenMonths").attr('style','');
			$("#nextFifteenMonths").removeAttr('disabled');
			$("#months2").attr('style','');
			$("#months2").removeAttr('disabled');
		}

		$("#ygyjtjbb").empty();
		$("#tfoot").empty();
		var length = data.list.length;
		$("#date").val(data.endDate);//隐藏域，接收日期末尾，用于【前15，后15】的按键
		for(var i = 1; i <= length; i ++){
			$("#day"+i).html(data.list[i-1]['day']);
			$("#xd"+i).html(data.list[i-1]['xdNum']);
			$("#sd"+i).html(data.list[i-1]['sdNum']);
			$("#fh"+i).html(data.list[i-1]['fhNum']);
			$("#js"+i).html(data.list[i-1]['jsNum']);
			$("#qs"+i).html(data.list[i-1]['qsNum']);
		}
		for(var i = 0; i < length; i += 2){
			var listInfo = '<tr class="singular">'
						+'<td>'+data.list[i]['beginDate']+data.list[i]['endDate']+'</td>'
						+'<td><font style="color:#FF0000">'+data.list[i]['xdNum']+'</font>/<font style="color:#0000FF">'+data.list[i]['xdMoney']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i]['sdNum']+'</font>/<font style="color:#0000FF">'+data.list[i]['sdMoney']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i]['fhNum']+'</font>/<font style="color:#0000FF">'+data.list[i]['fhMoney']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i]['jsNum']+'</font>/<font style="color:#0000FF">'+data.list[i]['jsMoney']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i]['qsNum']+'</font>/<font style="color:#0000FF">'+data.list[i]['qsMoney']+'</font></td></tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex">'
						+'<td>'+data.list[i+1]['beginDate']+data.list[i+1]['endDate']+'</td>'
						+'<td><font style="color:#FF0000">'+data.list[i+1]['xdNum']+'</font>/<font style="color:#0000FF">'+data.list[i+1]['xdMoney']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i+1]['sdNum']+'</font>/<font style="color:#0000FF">'+data.list[i+1]['sdMoney']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i+1]['fhNum']+'</font>/<font style="color:#0000FF">'+data.list[i+1]['fhMoney']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i+1]['jsNum']+'</font>/<font style="color:#0000FF">'+data.list[i+1]['jsMoney']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i+1]['qsNum']+'</font>/<font style="color:#0000FF">'+data.list[i+1]['qsMoney']+'</font></td></tr>';
			}	
			$("#ygyjtjbb").append(listInfo);
		}
		var tfoot = '<tr>'
					+'<td>总计：'
					+'<td><font style="color:#FF0000">'+ data.totalXdNum +'</font>/<font style="color:#0000FF">'+ data.totalXdMoney +'</font></td>'
					+'<td><font style="color:#FF0000">'+ data.totalSdNum +'</font>/<font style="color:#0000FF">'+ data.totalSdMoney +'</font></td>'
					+'<td><font style="color:#FF0000">'+ data.totalFhNum +'</font>/<font style="color:#0000FF">'+ data.totalFhMoney +'</font></td>'
					+'<td><font style="color:#FF0000">'+ data.totalJsNum +'</font>/<font style="color:#0000FF">'+ data.totalJsMoney +'</font></td>'
					+'<td><font style="color:#FF0000">'+ data.totalQsNum +'</font>/<font style="color:#0000FF">'+ data.totalQsMoney +'</font></td></tr>';
		$("#tfoot").append(tfoot);
	}

	//绘图
	gvChartInit();
	jQuery(document).ready(function(){
    	var width = document.body.clientWidth; 
	    jQuery('#myTable5').gvChart({
	        chartType: 'LineChart',
	        gvSettings: {
	            vAxis: {title: '签单数'},
	            hAxis: {title: '日期'},
	            width: width,
	            height: 250
	        }
	    });
	});
}

function getChart(str){
	//样式重置，display重置，disabled重置
	$("#days").attr('style','');
	$("#days").removeAttr('disabled');
	$("#weeks").attr('style','');
	$("#weeks").removeAttr('disabled');
	$("#months").attr('style','');
	$("#months").removeAttr('disabled');
	$("#daysBtn").attr('style','display:none;');
	$("#weeksBtn").attr('style','display:none;');
	$("#monthsBtn").attr('style','display:none;');

	if(str.indexOf('ays') > -1){
		$("#days").attr('style','color:#999999;cursor:not-allowed;');
		$("#days").attr('disabled','disabled');
		$("#daysBtn").attr('style','display:block;');
	}else if(str.indexOf('eeks') > -1){
		$("#weeks").attr('style','color:#999999;cursor:not-allowed;');
		$("#weeks").attr('disabled','disabled');
		$("#weeksBtn").attr('style','display:block;');
	}else{
		$("#months").attr('style','color:#999999;cursor:not-allowed;');
		$("#months").attr('disabled','disabled');
		$("#monthsBtn").attr('style','display:block;');
	}

	var dept = $("#dept").val();
	var endDate = $("#date").val();
	$.post("index.php?r=flbb/GetFztjbbChart",{dept:dept,day:str,endDate:endDate},function(data){
		getTable(data);	
	},"json");
}