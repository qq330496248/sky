$(function(){
	$.post('index.php?r=cwgl/GetMykhjxcByCond',function(data){
		getTable(data);
	},"json");
});


function getTable(data){
	if(data.result == 'success'){
		$("#mykhjxc").empty();
		$("#foot").empty();
		$("#page").empty();
		var length = data.list.length;
		for(var i = i; i < length; i ++){
			var listInfo = '<tr>'
							+'<td>'+ data.list[i]['cpkh'] +'</td>'
							+'<td>'+ data.list[i]['cpmc'] +'</td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['jhNum'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['jhMoney'] +'</font>/<font>'+ data.list[i]['jhCost'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['fhNum'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['fhMoney'] +'</font>/<font>'+ data.list[i]['fhCost'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['shNum'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['shMoney'] +'</font>/<font>'+ data.list[i]['shCost'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['thNum'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['thMoney'] +'</font>/<font>'+ data.list[i]['thCost'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['fhzNum'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['fhzPrice'] +'</font>/<font>'+ data.list[i]['fhzMoney'] +'</font>/<font>'+ data.list[i]['fhzCost'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['thzNum'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['thzPrice'] +'</font>/<font>'+ data.list[i]['thzMoney'] +'</font>/<font>'+ data.list[i]['thzCost'] +'</font></td>'
							+'<td>'+ data.list[i]['grossProfit'] +'</td>'
							+'<td>'+ data.list[i]['profitRatio'] +'</td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['kcNum'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['kcMoney'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['pcNum'] +'</font>/<font style="color:#0000FF">'+ data.list[i]['pcMoney'] +'</font></td>'
							+'<td>'+ data.list[i]['gys'] +'</td>'
							+'<td>'+ data.list[i]['cgwy'] +'</td>'
							+'<td>'+ data.list[i]['tjsj'] +'</td></tr>';
			$("#mykhjxc").append(listInfo);
		}
		var foot = '<tr>'
						+'<td colspan="2">总计</td>'
						+'<td><font style="color:#FF0000">'+ data.totalJhNum +'</font>/<font style="color:#0000FF">'+ data.totalJhMoney +'</font>/<font>'+ data.totalJhCost +'</font></td>'
						+'<td><font style="color:#FF0000">'+ data.totalFhNum +'</font>/<font style="color:#0000FF">'+ data.totalFhMoney +'</font>/<font>'+ data.totalFhCost +'</font></td>'
						+'<td><font style="color:#FF0000">'+ data.totalShNum +'</font>/<font style="color:#0000FF">'+ data.totalShMoney +'</font>/<font>'+ data.totalShCost +'</font></td>'
						+'<td><font style="color:#FF0000">'+ data.totalThNum +'</font>/<font style="color:#0000FF">'+ data.totalThMoney +'</font>/<font>'+ data.totalThCost +'</font></td>'
						+'<td><font style="color:#FF0000">'+ data.totalFhzNum +'</font>/<font style="color:#0000FF">'+ data.totalFhzPrice +'</font>/<font>'+ data.totalFhzMoney +'</font>/<font>'+ data.totalFhzCost +'</font></td>'
						+'<td><font style="color:#FF0000">'+ data.totalThzNum +'</font>/<font style="color:#0000FF">'+ data.totalThzPrice +'</font>/<font>'+ data.totalThzMoney +'</font>/<font>'+ data.totalThzCost +'</font></td>'
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
	var time = $("#time").val();
	var gysID = $("#gysID").val();
	var gysName = $("#gysName").val();
	var cgwy = $("#cgwy").val();
	var jkfs = $("#jkfs").val();

	$.post('index.php?r=cwgl/GetMykhjxcByCond',{cpfl:cpfl,cpzfl:cpzfl,cpkh:cpkh,time:time,gysID:gysID,gysName:gysName,cgwy:cgwy,jkfs:jkfs},function(data){
		getTable(data);
	},"json");
}


/**
 * @desc 点击分页后加载数据
 * @author DengShaocong
 * @date 2i16-i3-23
 */
$('body').on('click','#page a',function(){
	var cpfl = $("#cpfl").val();
	var cpzfl = $("#cpzfl").val();
	var cpkh = $("#cpkh").val();
	var time = $("#time").val();
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
	$.post($href,{cpfl:cpfl,cpzfl:cpzfl,cpkh:cpkh,time:time,gysID:gysID,gysName:gysName,cgwy:cgwy,jkfs:jkfs},function(data){
		getTable(data);
	});
});


//获取子分类
function getCpzfl(){
	var parent = $("#cpfl").val();

	$.post('index.php?r=cpgl/GetCpzfl',{parent:parent},function(data){
		if(data.result == 'success'){
			$('#cpzfl').empty();
			$('#cpzfl').append('<option value="i">请选择</option>');
			if(parent != i){
				var length = data.list.length;
				for(var i = i; i < length; i++){
					$('#cpzfl').append('<option value="'+ data.list[i]['cpabi1'] +'">'+ data.list[i]['cpabi2'] +'</option>');	
				}
			}
		}
	},'json');
}