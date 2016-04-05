$(function(){
	$.post("index.php?r=zsk/GetZsfl",function(data){
		if(data){
			var length = data.length;
			for(var i = 0; i < length; i ++){
				var spaceStr = '';
				if(data[i]['level'] > 0){
					for(var s = 0; s < data[i]['level']; s ++){
						spaceStr += "&nbsp;&nbsp;";
					}
					spaceStr += "┖";
				}
				$("#zsktype").append('<option value="'+ data[i]['id'] +'" level="' + data[i]['level'] + '">'+ spaceStr + data[i]['typename'] +'</option>');
			}
		}
	},"json");
	$.post("index.php?r=zsk/GetZsk",function(data){
		getTable(data);
	},"json");
});


function getTable(data){
	$("#zskTable").empty();
	if(data.res == "success"){
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><th colspan="7">暂时没有记录！</th></tr>';
			$('#zskTable').append(listInfo);
		}
		for(var i = 0; i < length; i += 2){
			var listInfo = '<tr class="singular"><td class="zsktd"><a href="index.php?r=zsk/GetSingleZsk&id='+data.list[i]['id']+'">' + data.list[i]['title'] + '</a></td>'
							+'<td>' + data.list[i]['type'] + '</td>'
							+'<td>' + data.list[i]['setter'] + '</td>'
							+'<td>' + data.list[i]['viewtime'] + '</td>'
							+'<td>' + data.list[i]['zsktime'] + '</td>';
			if(data.list[i]['attachment'] != ""){
				var attachment = data.list[i]['attachment'].split("/");
				var count = attachment.length;
				listInfo += '<td><a href="">' + attachment[count-1] + '</a></td>';
			}else{
				listInfo += '<td>无附件</td>';
			}
			listInfo += '<td><a href="index.php?r=zsk/GetSingleZsk&id='+data.list[i]['id']+'"><img src="public/img/reservin.png" title="编辑" border="0" style="width:5%;cursor:pointer"></a>'
						+'<img src="public/img/del.png" title="点击删除" border="0" style="width:5%;cursor:pointer" onclick="delZsk(' + '"' + data.list[i]['id'] + '"' +')" ></td></tr>';
			
			if(i < length - 1){
				listInfo += '<tr class="complex"><td class="zsktd"><a href="index.php?r=zsk/GetSingleZsk&id='+data.list[i+1]['id']+'">' + data.list[i+1]['title'] + '</a></td>'
								+'<td>' + data.list[i+1]['type'] + '</td>'
								+'<td>' + data.list[i+1]['setter'] + '</td>'
								+'<td>' + data.list[i+1]['viewtime'] + '</td>'
								+'<td>' + data.list[i+1]['zsktime'] + '</td>';
				if(data.list[i+1]['attachment'] != ""){
					var attachment = data.list[i+1]['attachment'].split("/");
					var count = attachment.length;
					listInfo += '<td><a href="">' + attachment[count-1] + '</a></td>';
				}else{
					listInfo += '<td>无附件</td>';
				}
				listInfo += '<td><a href="index.php?r=zsk/GetSingleZsk&id='+data.list[i+1]['id']+'"><img src="public/img/reservin.png" title="编辑" border="0" style="width:5%;cursor:pointer"></a>'
							+'<img src="public/img/del.png" title="点击删除" border="0" style="width:5%;cursor:pointer" onclick="delZsk(' + "'" + data.list[i+1]['id'] + "'" +')" ></td></tr>';
			}
			$('#zskTable').append(listInfo);
		}
	}else{
		var listInfo = '<tr><th colspan="7">暂时没有记录！</th></tr>';
		$('#zskTable').append(listInfo);
	}
}


function seleteZsk(){
	var type = $("#zsktype").val();
	var title = $("#title").val();
	var begindate = $("#begindate").val();
	var enddate = $("#enddate").val();
	var ifprivate = $("#private:checked").val();
	$.post("index.php?r=zsk/GetZsk",{type:type,title:title,begindate:begindate,enddate:enddate,ifprivate:ifprivate},function(data){
		getTable(data);
	},"json");
}


function delZsk(id){
	if(confirm("真的确认删除吗？")){
		$.post("index.php?r=zsk/DeleteZsk",{id:id},function(data){
			alert(data.mes);
			if(data.res == "success"){
				window.location.href = "index.php?r=zsk/GetZslbHtml";
			}
		},"json");
	}
}