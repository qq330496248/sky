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
	$.post('index.php?r=flbb/GetYgyjtjbb',function(data){
		getTable(data);
	},'json');
});

function getTable(data){
	if(data.result == "success"){
		$("#ygyjtjbb").empty();
		$("#tfoot").empty();
		var length = data.list.length;
		for(var i = 0; i < length; i += 2){
			var listInfo = '<tr class="singular">'
						+'<td>'+data.list[i]['personname']+'</td>'
						+'<td><font>'+ data.list[i]['peopleNum'] +'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i]['xdOrders']+'</font>/<font style="color:#0000FF">'+data.list[i]['xdMoney']+'</font></td>'
						+'<td><font>'+data.list[i]['xdratio']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i]['sdOrders']+'</font>/<font style="color:#0000FF">'+data.list[i]['sdMoney']+'</font></td>'
						+'<td><font>'+data.list[i]['sdratio']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i]['fhOrders']+'</font>/<font style="color:#0000FF">'+data.list[i]['fhMoney']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i]['jsOrders']+'</font>/<font style="color:#0000FF">'+data.list[i]['jsMoney']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i]['qsOrders']+'</font>/<font style="color:#0000FF">'+data.list[i]['qsMoney']+'</font></td>'
						+'<td><font>'+data.list[i]['qsratio']+'</font></td>'
				//		+'<td><a target="_blank" style="color:#0000FF" href="public/template/grfUtils/data/xmlYGYJTJBB.php?name='+data.list[i]['personname']+'&obd='+data.orderBeginDate+'&oed='+data.orderEndDate+'">报表查询</a></td></tr>';
						+'<td><a target="_blank" style="color:#0000FF" href="index.php?r=flbb/GetYgyjtjbbChartHtml&name='+data.list[i]['personname']+'">报表查询</a></td></tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex">'
						+'<td>'+data.list[i+1]['personname']+'</td>'
						+'<td><font>'+ data.list[i+1]['peopleNum'] +'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i+1]['xdOrders']+'</font>/<font style="color:#0000FF">'+data.list[i+1]['xdMoney']+'</font></td>'
						+'<td><font>'+data.list[i+1]['xdratio']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i+1]['sdOrders']+'</font>/<font style="color:#0000FF">'+data.list[i+1]['sdMoney']+'</font></td>'
						+'<td><font>'+data.list[i+1]['sdratio']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i+1]['fhOrders']+'</font>/<font style="color:#0000FF">'+data.list[i+1]['fhMoney']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i+1]['jsOrders']+'</font>/<font style="color:#0000FF">'+data.list[i+1]['jsMoney']+'</font></td>'
						+'<td><font style="color:#FF0000">'+data.list[i+1]['qsOrders']+'</font>/<font style="color:#0000FF">'+data.list[i+1]['qsMoney']+'</font></td>'
						+'<td><font>'+data.list[i+1]['qsratio']+'</font></td>'
				//		+'<td><a target="_blank" style="color:#0000FF" href="public/template/grfUtils/data/xmlYGYJTJBB.php?name='+data.list[i+1]['personname']+'&obd='+data.orderBeginDate+'&oed='+data.orderEndDate+'">报表查询</a></td></tr>';
						+'<td><a target="_blank" style="color:#0000FF" href="index.php?r=flbb/GetYgyjtjbbChartHtml&name='+data.list[i+1]['personname']+'">报表查询</a></td></tr>';
			}	
			$("#ygyjtjbb").append(listInfo);				
		}
		var tfoot = '<tr>'
					+'<td>总计：<font style="color:#FF0000">'+ data.ryNum +'</font>人</td>'
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

function getBB(sign){
	var orderBeginDate = $("#xdsjq").val();
	var orderEndDate = $("#xdsjz").val();
	var accBeginDate = $("#cjsjq").val();
	var accEndDate = $("#cjsjz").val();
	var dept = $("#dept").val();
	var media = $("#media").val();

	if(sign == 1){
   		$.get('index.php?r=flbb/GetYgyjtjbb',{orderBeginDate:orderBeginDate,orderEndDate:orderEndDate,accBeginDate:accBeginDate,accEndDate:accEndDate,dept:dept,media:media,sign:sign},function(data){
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
            url: "index.php?r=flbb/GetYgyjtjbb",
            async: true,
            dataType: "json",
            data: {orderBeginDate:orderBeginDate,orderEndDate:orderEndDate,accBeginDate:accBeginDate,accEndDate:accEndDate,dept:dept,media:media,sign:sign},
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
 	getBB(sign);	
 });