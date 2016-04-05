$(function(){
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;
	var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();

	var begin = year + "-" + month + "-01";
	var end  = year + "-" + month + "-" + day;

	$("#xdsjq").val(begin);
	$("#xdsjz").val(end);
	
	$.post("index.php?r=flbb/GetThyytj",function(data){
		$('#urlRequest').val('index.php?r=flbb/GetThyytj');
		getTable(data);
	},"json");
});

function getTable(data){
	if(data.result == 'success'){
		$("#xdsjq").val(data.beginDate);//从后台传来的时间显示
		$("#xdsjz").val(data.endDate);//同上
		$("#hiddenBeginDate").val(data.beginDate);//防误操
		$("#hiddenEndDate").val(data.endDate);//防误操
		$("#thyytj").empty();
		$("#tfoot").empty();

		var date = new Date();//获取当前时间
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
			if(data.list[i]['thMoney'] == null){
				data.list[i]['thMoney'] = 0;
			}
			//
			/*if(data.list[i]['thlist']['orders'] > 0){
				var listInfo = '<tr>'
								+'<td><span>'+ data.list[i]['type'] +'</span></td>'
								+'<td><span>'+ data.list[i]['reason'] +'</span></td>'
								+'<td><font style="color:#FF0000">'+ data.fhNum +'</font>/<font style="color:#0000FF">'+ data.fhMoney +'</font></td>'
								+'<td><font style="color:#FF0000">'+ data.list[i]['thlist']['orders'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['thlist']['money'] +'</font></td>'
								+'<td><span>'+ data.list[i]['thRatio'] +'</span></td></tr>';
				$("#thyytj").append(listInfo);
			}*/
			var listInfo = '<tr>'
							+'<td><span>'+ data.list[i]['type'] +'</span></td>'
							+'<td><span>'+ data.list[i]['reason'] +'</span></td>'
							+'<td><font style="color:#FF0000">'+ data.fhOrders +'</font>/<font style="color:#0000FF">'+ data.fhMoney +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['thOrders'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['thMoney'] +'</font></td>'
							+'<td><span>'+ data.list[i]['thRatio'] +'</span></td></tr>';
			if(i < length - 1){
				listInfo += '<tr>'
							+'<td><span>'+ data.list[i+1]['type'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['reason'] +'</span></td>'
							+'<td><font style="color:#FF0000">'+ data.fhOrders +'</font>/<font style="color:#0000FF">'+ data.fhMoney +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i+1]['thOrders'] +'</font>/<font style="color:#0000FF">'+ data.list[i+1]['thMoney'] +'</font></td>'
							+'<td><span>'+ data.list[i+1]['thRatio'] +'</span></td></tr>';
			}
			$("#thyytj").append(listInfo);
		}
		var tfoot = '<tr><th colspan="2">总计：</th>'
					+'<th><font style="color:#FF0000">'+ data.fhOrders +'</font>/<font style="color:#0000FF">'+ data.fhMoney +'</font></th>'
					+'<th><font style="color:#FF0000">'+ data.thNum +'</font>/<font style="color:#0000FF">'+ data.thMoney +'</font></th>'
					+'<th>'+ data.totalRatio +'</th></tr>';
		$("#tfoot").append(tfoot);
	}
}


function getThcptj(){
	var beginDate = $("#xdsjq").val();
	var endDate = $("#xdsjz").val();
	var kdgs = $("#kdgs").val();
	var dept = $("#dept").val();
	$.post("index.php?r=flbb/GetThyytj",{beginDate:beginDate,endDate:endDate,kdgs:kdgs,dept:dept},function(data){
		$('#urlRequest').val('index.php?r=flbb/GetThyytj&beginDate='+beginDate+'&endDate='+endDate+'&dept='+dept+'&kdgs='+kdgs);
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
	$.post("index.php?r=flbb/GetThyytj",{day:str},function(data){
		$('#urlRequest').val('index.php?r=flbb/GetThyytj&day='+str);
		getTable(data);
	},"json");
}

function changeDay(str){
	var beginDate = $("#hiddenBeginDate").val();
	var endDate = $("#hiddenEndDate").val();
	$.post("index.php?r=flbb/GetThyytj",{beginDate:beginDate,endDate:endDate,day:str},function(data){
		$('#urlRequest').val('index.php?r=flbb/GetThyytj&beginDate='+beginDate+'&endDate='+endDate+'&day='+str);
		getTable(data);
	},"json");
}

/**
 * @desc 导出excel
 * @author WuJunhua
 * @date 2016-03-29
 */
 $('body').on('click','#exportExcel',function(){
 	var sign = 1; //导出excel标识
 	var $href = $('#urlRequest').val();
 	if(!$href){
 		alert('导出有误');
 		return;
 	}
 	$.post($href,{sign:sign},function(data){
 		if(!data){
            return;
        }
    	if(data.result == 'error'){
			alert(data.msg);
			return;
		}
		if(data.result == 'exportExcel'){
			idownload(data.url);
			//导出excel成功后，要清除服务器上的xls文件
			$.post('index.php?r=xtsz/DeleteExcelFile',{url:data.url},function(data){

			});
		}	
 	},'json');	
 });

