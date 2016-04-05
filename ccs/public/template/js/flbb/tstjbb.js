$(function(){
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;
	var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();

	var begin = year + "-" + month + "-01";
	var end  = year + "-" + month + "-" + day;

	$("#xdsjq").val(begin);
	$("#xdsjz").val(end);

	$.post("index.php?r=flbb/GetTstjbb",function(data){
		$('#urlRequest').val('index.php?r=flbb/GetTstjbb');
		getTable(data);
	},"json");
});


function getTable(data){
	if(data.result == 'success'){
		$("#xdsjq").val(data.beginDate);//从后台传来的时间显示
		$("#xdsjz").val(data.endDate);//同上
		$("#hiddenBeginDate").val(data.beginDate);//防误操
		$("#hiddenEndDate").val(data.endDate);//防误操

		$("#tstj").empty();
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
							+'<td><span>'+ data.list[i]['colName'] +'</span></td>'
							+'<td><span>'+ data.list[i]['complaintNum'] +'</span></td>'
							+'<td><span>'+ data.list[i]['compRatio'] +'</span></td>'
							+'<td><span>'+ data.list[i]['wclNum'] +'</span></td>'
							+'<td><span>'+ data.list[i]['qetkNum'] +'</span></td>'
							+'<td><span>'+ data.list[i]['bftkNum'] +'</span></td>'
							+'<td><span>'+ data.list[i]['thNum'] +'</span></td>'
							+'<td><span>'+ data.list[i]['hhNum'] +'</span></td>'
							+'<td><span>'+ data.list[i]['cpzsNum'] +'</span></td>'
							+'<td><span>'+ data.list[i]['zpzsNum'] +'</span></td></tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex">'
							+'<td><span>'+ data.list[i+1]['colName'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['complaintNum'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['compRatio'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['wclNum'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['qetkNum'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['bftkNum'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['thNum'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['hhNum'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['cpzsNum'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['zpzsNum'] +'</span></td></tr>';
			}
			$("#tstj").append(listInfo);
		}
		var tfoot = '<tr>'
					+'<td><span>总计：</span></td>'
					+'<td><span>'+ data.complaintNum +'</span></td>'
					+'<td><span></span></td>'
					+'<td><span>'+ data.wclCount +'</span></td>'
					+'<td><span>'+ data.qetkCount +'</span></td>'
					+'<td><span>'+ data.bftkCount +'</span></td>'
					+'<td><span>'+ data.thCount +'</span></td>'
					+'<td><span>'+ data.hhCount +'</span></td>'
					+'<td><span>'+ data.cpzsCount +'</span></td>'
					+'<td><span>'+ data.zpzsCount +'</span></td></tr>';
		$("#tfoot").append(tfoot);
	}
}

function getTstjbb(){
	var beginDate = $("#xdsjq").val();
	var endDate = $("#xdsjz").val();
	var method = $("#method").val();
	$.post("index.php?r=flbb/GetTstjbb",{beginDate:beginDate,endDate:endDate},function(data){
		$('#urlRequest').val('index.php?r=flbb/GetTstjbb&beginDate='+beginDate+'&endDate='+endDate);
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
	var type = $("#type").val();
	$.post("index.php?r=flbb/GetTstjbb",{day:str,type:type},function(data){
		$('#urlRequest').val('index.php?r=flbb/GetTstjbb&day='+str+'&type='+type);
		getTable(data);
	},"json");
}


function changeDay(str){
	var beginDate = $("#hiddenBeginDate").val();
	var endDate = $("#hiddenEndDate").val();
	var type = $("#type").val();
	$.post("index.php?r=flbb/GetTstjbb",{beginDate:beginDate,endDate:endDate,day:str,type:type},function(data){
		$('#urlRequest').val('index.php?r=flbb/GetTstjbb&beginDate='+beginDate+'&endDate='+endDate+'&day='+str+'&type='+type);
		getTable(data);
	},"json");
}

function changeType(str){
	var beginDate = $("#xdsjq").val();
	var endDate = $("#xdsjz").val();
	$("#tsgh").attr('style',''); 
	$("#lx").attr('style',''); 
	$("#xlx").attr('style',''); 
	$("#jg").attr('style',''); 
	$("#gjgh").attr('style',''); 
	$("#"+str).attr('style','color:#000000; background:#999999;'); 

	$("#tsghTable").attr('style','display:none'); 
	$("#lxTable").attr('style','display:none'); 
	$("#jgTable").attr('style','display:none'); 
	$("#gjghTable").attr('style','display:none'); 
	$("#"+str+"Table").attr('style','display:block'); 
	if(str == 'xlx'){
		$("#lxTable").attr('style','display:block'); 
	}

	$("#type").val(str);
	$.post("index.php?r=flbb/GetTstjbb",{beginDate:beginDate,endDate:endDate,type:str},function(data){
		$('#urlRequest').val('index.php?r=flbb/GetTstjbb&beginDate='+beginDate+'&endDate='+endDate+'&type='+str);
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