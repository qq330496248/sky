$(function(){
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;
	var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();

	var begin = year + "-" + month + "-01";
	var end  = year + "-" + month + "-" + day;

	$("#xdsjq").val(begin);
	$("#xdsjz").val(end);
	
	/**
	 * @desc 加载视图后，显示数据
	 * @author WuJunhua
	 * @date 2016-03-29
	 */
	$.post('index.php?r=flbb/GetFzyjtjbb',function(data){
		getTable(data);
	},'json');

});


function getTable(data){
	if(data.result == "success"){
		$("#fztjbb").empty();
		$("#tfoot").empty();
		var length = data.list.length;
		for(var i = 0; i < length; i += 2){
			var listInfo = '<tr class="singular">'
							+'<td><span>'+ data.list[i]['depttext'] +'</span></td>'
							+'<td><span><font>'+ data.list[i]['peopleNum'] +'</font></span></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['xdOrders'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['xdMoney'] +'</font></td>'
							+'<td><span>'+data.list[i]['xdratio']+'</span></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['sdOrders'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['sdMoney'] +'</font></td>'
							+'<td><span>'+data.list[i]['sdratio']+'</span></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['fhOrders'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['fhMoney'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['jsOrders'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['jsMoney'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['qsOrders'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['qsMoney'] +'</font></td>'
							+'<td><span>'+data.list[i]['qsratio']+'</span></td>'
					//		+'<td><a target="_blank" style="color:#0000FF" href="public/template/grfUtils/data/xmlFZXSTJBB.php?dept='+data.list[i]['depttext']+'&obd='+data.beginDate+'&oed='+data.endDate+'">报表查询</a></td></tr>';
							+'<td><a target="_blank" style="color:#0000FF" href="index.php?r=flbb/GetFztjbbChartHtml&dept='+data.list[i]['depttext']+'">报表查询</a></td></tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex">'
							+'<td><span>'+ data.list[i+1]['depttext'] +'</span></td>'
							+'<td><span><font>'+ data.list[i+1]['peopleNum'] +'</font></span></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i+1]['xdOrders'] +'</font>/<font style="color:#0000FF">'+ data.list[i+1]['xdMoney'] +'</font></td>'
							+'<td><span>'+data.list[i+1]['xdratio']+'</span></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i+1]['sdOrders'] +'</font>/<font style="color:#0000FF">'+ data.list[i+1]['sdMoney'] +'</font></td>'
							+'<td><span>'+data.list[i+1]['sdratio']+'</span></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i+1]['fhOrders'] +'</font>/<font style="color:#0000FF">'+ data.list[i+1]['fhMoney'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i+1]['jsOrders'] +'</font>/<font style="color:#0000FF">'+ data.list[i+1]['jsMoney'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i+1]['qsOrders'] +'</font>/<font style="color:#0000FF">'+ data.list[i+1]['qsMoney'] +'</font></td>'
							+'<td><span>'+data.list[i+1]['qsratio']+'</span></td>'
					//		+'<td><a target="_blank" style="color:#0000FF" href="public/template/grfUtils/data/xmlFZXSTJBB.php?dept='+data.list[i+1]['depttext']+'&obd='+data.beginDate+'&oed='+data.endDate+'">报表查询</a></td></tr>';
							+'<td><a target="_blank" style="color:#0000FF" href="index.php?r=flbb/GetFztjbbChartHtml&dept='+data.list[i+1]['depttext']+'">报表查询</a></td></tr>';
			}
			$("#fztjbb").append(listInfo);
		}
		var tfoot = '<tr>'
					+'<td>总计：</td>'
					+'<td><font style="color:#FF0000">'+ data.peopleNum +'</font></td>'
					+'<td><font style="color:#FF0000">'+ data.xdCount +'</font>/<font style="color:#0000FF">'+ data.xdMoney +'</font></td>'
					+'<td>'+ data.totalXdRatio +'</td>'
					+'<td><font style="color:#FF0000">'+ data.sdCount +'</font>/<font style="color:#0000FF">'+ data.sdMoney +'</font></td>'
					+'<td>'+ data.totalSdRatio +'</td>'
					+'<td><font style="color:#FF0000">'+ data.fhCount +'</font>/<font style="color:#0000FF">'+ data.fhMoney +'</font></td>'
					+'<td><font style="color:#FF0000">'+ data.jsCount +'</font>/<font style="color:#0000FF">'+ data.jsMoney +'</font></td>'
					+'<td><font style="color:#FF0000">'+ data.qsCount +'</font>/<font style="color:#0000FF">'+ data.qsMoney +'</font></td>'
					+'<td>'+ data.totalQsRatio +'</td>'
					+'<td></td></tr>';
		$("#tfoot").append(tfoot);
	}
}

function getFztjbb(sign){
	var orderBeginDate = $("#xdsjq").val();
	var orderEndDate = $("#xdsjz").val();
	var accBeginDate = $("#cjsjq").val();
	var accEndDate = $("#cjsjz").val();
	var khyx = $("#khyx").val();
	var media = $("#media").val();

	if(sign == 1){
   		$.get('index.php?r=flbb/GetFzyjtjbb',{orderBeginDate:orderBeginDate,orderEndDate:orderEndDate,accBeginDate:accBeginDate,accEndDate:accEndDate,media:media,khyx:khyx,sign:sign},function(data){
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
	    });
   }else{
   		$.ajax({
            type: "post",
            url: "index.php?r=flbb/GetFzyjtjbb",
            async: true,
            dataType: "json",
            data: {orderBeginDate:orderBeginDate,orderEndDate:orderEndDate,accBeginDate:accBeginDate,accEndDate:accEndDate,media:media,khyx:khyx,sign:sign},
            success: function(data){
                if(!data){
                    return;
                }
                getTable(data);
            }
        });
   }
}

/**
 * @desc 导出excel
 * @author WuJunhua
 * @date 2016-03-29
 */
 $('body').on('click','#exportExcel',function(){
 	var sign = 1; //导出excel标识
 	getFztjbb(sign);	
 });