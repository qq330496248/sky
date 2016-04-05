$(function(){
	$.post("index.php?r=cggl/GetGysForReport",function(data){
		getTable(data);
	},"json");
});

function getTable(data){
	$("#gysTable").empty();
	$("#page").empty();
	
	if(data.result == 'success'){
		var length = data.list.length;
		for(var i = 0; i < length; i ++){
			var listInfo = '<tr class="singular">';
			listInfo += '<td><span>'+ data.list[i]['gysID'] +'</span></td>'
						+'<td><span>'+ data.list[i]['gysName'] +'</span></td>'
						+'<td><span>'+ data.list[i]['gysType'] +'</span></td>';
			if(data.list[i]['cgwy'] != ''){
				listInfo += '<td><span>'+ data.list[i]['cgwy'].split(":")[1] +'</span></td>';
			}else{
				listInfo += '<td><span></span></td>';
			}
			if(data.list[i]['cgzy'] != ''){
				listInfo += '<td><span>'+ data.list[i]['cgzy'].split(":")[1] +'</span></td>';
			}else{
				listInfo += '<td><span></span></td>';
			}
			if(data.list[i]['cglist']['totalNum'] != null){
				listInfo += '<td><span>'+ data.list[i]['cglist']['totalNum'] +'</span></td>';
			}else{
				listInfo += '<td><span>0</span></td>';
			}
			if(data.list[i]['kclist']['totalNum'] != null){
				listInfo += '<td><span>'+ data.list[i]['kclist']['totalNum'] +'</span></td>';
			}else{
				listInfo += '<td><span>0</span></td>';
			}
			if(data.list[i]['fhlist']['totalNum'] != null){
				listInfo += '<td><font style="color:#0000FF">'+ data.list[i]['fhlist']['totalNum'] +'</font>/<font>'+ data.list[i]['fhlist']['totalMoney'] +'</font></td>';
			}else{
				listInfo += '<td><font style="color:#0000FF">0</font>/<font>0</font></td>';
			}
			if(data.list[i]['shlist']['totalNum'] != null){
				listInfo += '<td><font style="color:#0000FF">'+ data.list[i]['shlist']['totalNum'] +'</font>/<font>'+ data.list[i]['shlist']['totalMoney'] +'</font></td>';
			}else{
				listInfo += '<td><font style="color:#0000FF">0</font>/<font>0</font></td>';
			}
			listInfo += '</tr>';
			if(i != length - 1){
				    listInfo += '<tr class="complex">'
					        + '<td><span>'+ data.list[i|+1]['gysID'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['gysName'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['gysType'] +'</span></td>'
				if(data.list[i]['cgwy'] != ''){
					listInfo += '<td><span>'+ data.list[i+1]['cgwy'].split(":")[1] +'</span></td>';
				}else{
					listInfo += '<td><span></span></td>';
				}
				if(data.list[i]['cgzy'] != ''){
					listInfo += '<td><span>'+ data.list[i+1]['cgzy'].split(":")[1] +'</span></td>';
				}else{
					listInfo += '<td><span></span></td>';
				}
				if(data.list[i]['cglist']['totalNum'] != null){
					listInfo += '<td><span>'+ data.list[i+1]['cglist']['totalNum'] +'</span></td>';
				}else{
					listInfo += '<td><span>0</span></td>';
				}
				if(data.list[i]['kclist']['totalNum'] != null){
					listInfo += '<td><span>'+ data.list[i+1]['kclist']['totalNum'] +'</span></td>';
				}else{
					listInfo += '<td><span>0</span></td>';
				}
				if(data.list[i]['fhlist']['totalNum'] != null){
					listInfo += '<td><font style="color:#0000FF">'+ data.list[i+1]['fhlist']['totalNum'] +'</font>/<font>'+ data.list[i+1]['fhlist']['totalMoney'] +'</font></td>';
				}else{
					listInfo += '<td><font style="color:#0000FF">0</font>/<font>0</font></td>';
				}
				if(data.list[i+1]['shlist']['totalNum'] != null){
					listInfo += '<td><font style="color:#0000FF">'+ data.list[i+
					1]['shlist']['totalNum'] +'</font>/<font>'+ data.list[i+1]['shlist']['totalMoney'] +'</font></td>';
				}else{
					listInfo += '<td><font style="color:#0000FF">0</font>/<font>0</font></td>';
				}
				listInfo += '</tr>';
			}
			$("#gysTable").append(listInfo);
		}
		$("#page").append(data.pageHtml);
	}
}


function getGysbb(){
	var gysid = $("#gysid").val();
	var name = $("#name").val();
	var cgwy = $("#cgwy").val();
	var cgzy = $("#cgzy").val();
	var begindate = $("#begindate").val();
	var enddate = $("#enddate").val();
	$.post("index.php?r=cggl/GetGysForReport",{gysid:gysid,name:name,cgwy:cgwy,cgzy:cgzy,begindate:begindate,enddate:enddate},function(data){
		getTable(data);
	},"json");
}