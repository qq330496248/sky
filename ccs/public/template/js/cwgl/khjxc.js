$(function(){
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;
	var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();

	var begin = year + "-" + month + "-01";
	var end  = year + "-" + month + "-" + day;

	$("#xdsjq").val(begin);
	$("#xdsjz").val(end);

	/*$.post('index.php?r=cwgl/GetKhjxcByCond',function(data){
		getTable(data);
	},"json");*/
});


function getTable(data){
	if(data.result == 'success'){
		$("#khjxc").empty();
		$("#foot").empty();
		$("#page").empty();
		var length = data.list.length;
		for(var i = 0; i < length; i ++){
			var listInfo = '<tr>'
							+'<td>'+ data.list[i]['cpkh'] +'</td>'
							+'<td>'+ data.list[i]['cpmc'] +'</td>'
							+'<td>'+ data.list[i]['jhNum'] +'</td>'
							+'<td>'+ data.list[i]['jhMoney'] +'</td>'
							+'<td>'+ data.list[i]['jhCost'] +'</td>'
							+'<td>'+ data.list[i]['fhNum'] +'</td>'
							+'<td>'+ data.list[i]['fhMoney'] +'</td>'
							+'<td>'+ data.list[i]['fhPrice'] +'</td>'
							+'<td>'+ data.list[i]['shNum'] +'</td>'
							+'<td>'+ data.list[i]['shMoney'] +'</td>'
							+'<td>'+ data.list[i]['fhzNum'] +'</td>'
							+'<td>'+ data.list[i]['fhzMoney'] +'</td>'
							+'<td>'+ data.list[i]['thzNum'] +'</td>'
							+'<td>'+ data.list[i]['thzMoney'] +'</td>'
							+'<td>'+ data.list[i]['thNum'] +'</td>'
							+'<td>'+ data.list[i]['thMoney'] +'</td>'
							+'<td>'+ data.list[i]['thCost'] +'</td>'
							+'<td>'+ data.list[i]['grossProfit'] +'</td>'
							+'<td>'+ data.list[i]['profitRatio'] +'</td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['kcNum'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['kcMoney'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['pcNum'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['pcMoney'] +'</font></td>'
							+'<td>'+ data.list[i]['gys'] +'</td>'
							+'<td>'+ data.list[i]['cgwy'] +'</td>'
							+'<td>'+ data.list[i]['tjsj'] +'</td></tr>';
			$("#khjxc").append(listInfo);
		}
		var foot = '<tr>'
						+'<td colspan="2">总计</td>'
						+'<td>'+ data.totalJhNum +'</td>'
						+'<td>'+ data.totalJhMoney +'</td>'
						+'<td>'+ data.totalJhCost +'</td>'
						+'<td>'+ data.totalFhNum +'</td>'
						+'<td>'+ data.totalFhMoney +'</td>'
						+'<td>'+ data.totalFhCost +'</td>'
						+'<td>'+ data.totalShNum +'</td>'
						+'<td>'+ data.totalShMoney +'</td>'
						+'<td>'+ data.totalFhzNum +'</td>'
						+'<td>'+ data.totalFhzMoney +'</td>'
						+'<td>'+ data.totalThzNum +'</td>'
						+'<td>'+ data.totalThzMoney +'</td>'
						+'<td>'+ data.totalThNum +'</td>'
						+'<td>'+ data.totalThMoney +'</td>'
						+'<td>'+ data.totalThCost +'</td>'
						+'<td>'+ data.totalGrossProfit +'</td>'
						+'<td>'+ data.totalProfitRatio +'</td>'
						+'<td><font style="color:#FF0000">'+ data.totalKcNum +'</font>/<font style="color:#0000FF">'+ data.totalKcMoney +'</font></td>'
						+'<td><font style="color:#FF0000">'+ data.totalPcNum +'</font>/<font style="color:#0000FF">'+ data.totalPcMoney +'</font></td>'
						+'<td colspan="3"></td></tr>';
		$("#foot").append(foot);
		$("#page").append(data.pageHtml);
		
	}
}



function getKhjxc(){
	var cpfl = $("#cpfl").val();
	var cpzfl = $("#cpzfl").val();
	var cpkh = $("#cpkh").val();
	var gysID = $("#gysID").val();
	var gysName = $("#gysName").val();
	var cgwy = $("#cgwy").val();
	var jkfs = $("#jkfs").val();
	var beginDate = $("#beginDate").val();
	var endDate = $("#endDate").val()

	$.post('index.php?r=cwgl/GetKhjxcByCond',{cpfl:cpfl,cpzfl:cpzfl,cpkh:cpkh,beginDate:beginDate,endDate:endDate,gysID:gysID,gysName:gysName,cgwy:cgwy,jkfs:jkfs},function(data){
		getTable(data);
	},"json");
}


/**
 * @desc 点击分页后加载数据
 * @author DengShaocong
 * @date 2016-03-23
 */
$('body').on('click','#page a',function(){
	var cpfl = $("#cpfl").val();
	var cpzfl = $("#cpzfl").val();
	var cpkh = $("#cpkh").val();
	var gysID = $("#gysID").val();
	var gysName = $("#gysName").val();
	var cgwy = $("#cgwy").val();
	var jkfs = $("#jkfs").val();

	var $this = $(this);
	var $href = $this.attr('href');
	if($href == undefined){
		return;
	}
	$this.attr('href',"javascript:;");
	$.post($href,{cpfl:cpfl,cpzfl:cpzfl,cpkh:cpkh,beginDate:beginDate,endDate:endDate,gysID:gysID,gysName:gysName,cgwy:cgwy,jkfs:jkfs},function(data){
		getTable(data);
	});
});


//获取子分类
function getCpzfl(){
	var parent = $("#cpfl").val();

	$.post('index.php?r=cpgl/GetCpzfl',{parent:parent},function(data){
		if(data.result == 'success'){
			$('#cpzfl').empty();
			$('#cpzfl').append('<option value="0">请选择</option>');
			if(parent != 0){
				var length = data.list.length;
				for(var i = 0; i < length; i++){
					$('#cpzfl').append('<option value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');	
				}
			}
		}
	},'json');
}