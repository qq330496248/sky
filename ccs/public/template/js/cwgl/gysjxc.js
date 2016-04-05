$(function(){
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;
	var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();

	var begin = year + "-" + month + "-01";
	var end  = year + "-" + month + "-" + day;

	$("#xdsjq").val(begin);
	$("#xdsjz").val(end);
	/*$.post('index.php?r=cwgl/GetGysjxcByCond',function(data){
		getTable(data);
	},"json");*/
});


function getTable(data){
	if(data.result == 'success'){
		$("#mygysjxc").empty();
		$("#total").empty();
		$("#page").empty();
		var length = data.list.length;
		for(var i = 0 ; i < length; i ++){
			var listInfo = '<tr>'
							+'<td>'+ data.list[i]['gysid'] +'</td>'
							+'<td>'+ data.list[i]['gysname'] +'</td>'
							+'<td>'+ data.list[i]['jkfs'] +'</td>'
							+'<td>'+ data.list[i]['cgwy'] +'</td>'
							+'<td>'+ data.list[i]['cgzy'] +'</td>'
							+'<td>'+ data.list[i]['jhNum'] +'</td>'
							+'<td>'+ data.list[i]['jhMoney'] +'</td>'
							+'<td>'+ data.list[i]['kcNum'] +'</td>'
							+'<td>'+ data.list[i]['kcMoney'] +'</td>'
							+'<td>'+ data.list[i]['kcCount'] +'</td>'
							+'<td>'+ data.list[i]['fhOrders'] +'</td>'
							+'<td>'+ data.list[i]['fhMoney'] +'</td>'
							+'<td>'+ data.list[i]['shOrders'] +'</td>'
							+'<td>'+ data.list[i]['shMoney'] +'</td>'
							+'<td>'+ data.list[i]['shCost'] +'</td>'
							+'<td>'+ data.list[i]['grossProfit'] +'</td>'
							+'<td>'+ data.list[i]['profitRatio'] +'</td>'
							+'<td>'+ data.list[i]['tjsj'] +'</td></tr>';
			$("#mygysjxc").append(listInfo);
		}
		var total = '<tr>'
						+'<td colspan="5">总计</td>'
						+'<td>'+ data.totalJhNum +'</td>'
						+'<td>'+ data.totalJhMoney +'</td>'
						+'<td>'+ data.totalKcNum +'</td>'
						+'<td>'+ data.totalKcMoney +'</td>'
						+'<td>'+ data.totalKcCount +'</td>'
						+'<td>'+ data.totalFhOrders +'</td>'
						+'<td>'+ data.totalFhMoney +'</td>'
						+'<td>'+ data.totalShOrders +'</td>'
						+'<td>'+ data.totalShMoney +'</td>'
						+'<td>'+ data.totalShCost +'</td>'
						+'<td>'+ data.totalGrossProfit +'</td>'
						+'<td>'+ data.totalProfitRatio +'</td>'
						+'<td></td></tr>';
		$("#total").append(total);
		$("#page").append(data.pageHtml);
	}
}






function getGysjxc(){
	var gysID = $("#gysID").val();
	var gysName = $("#gysName").val();
	var cgwy = $("#cgwy").val();
	var cgzy = $("#cgzy").val();
	var gysfl = $("#gysfl").val();
	var jkfs = $("#jkfs").val();
	var beginDate = $("#xdsjq").val();
	var endDate = $("#xdsjz").val();
	$.post("index.php?r=cwgl/GetGysjxcByCond",{gysID:gysID,gysName:gysName,cgwy:cgwy,cgzy:cgzy,gysfl:gysfl,jkfs:jkfs,beginDate:beginDate,endDate:endDate},function(data){
		getTable(data);
	},"json");
}