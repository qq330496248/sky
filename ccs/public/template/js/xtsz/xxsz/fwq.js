//服务器
$(function(){
	$.post("index.php?r=xtsz/GetServerByCond",function(data){
		getTable(data);
	},"json");
});

function getTable(data){
	if(data.result == 'success'){
		$("#fwqTable").empty();
		var length = data.list.length;
		for(var i = 0; i < length; i += 2){
			var listInfo = '<tr class="singular">'
							+'<td>'+ data.list[i]['refSigns'] +'</td>'
							+'<td>'+ data.list[i]['serverIp'] +'</td>'
							+'<td>'+ data.list[i]['dbName'] +'</td>'
							+'<td><img src="public/img/reservin.png" title="编辑" border="0" onclick="showXg('+ "'" + data.list[i]['refSigns'] + "'" +')" style="width:5.5%;cursor:pointer"></a>'
							+'<img src="public/img/del.png" title="点击删除" border="0" style="width:5.5%;cursor:pointer" onclick="deleteServer('+ "'" + data.list[i]['refSigns'] + "'" +')"/></td></tr>';
			
			if(i < length - 1){
				listInfo += '<tr class="complex">'
							+'<td>'+ data.list[i+1]['refSigns'] +'</td>'
							+'<td>'+ data.list[i+1]['serverIp'] +'</td>'
							+'<td>'+ data.list[i+1]['dbName'] +'</td>'
							+'<td><img src="public/img/reservin.png" title="编辑" border="0" onclick="showXg('+ "'" + data.list[i+1]['refSigns'] + "'" +')" style="width:5.5%;cursor:pointer"></a>'
							+'<img src="public/img/del.png" title="点击删除" border="0" style="width:5.5%;cursor:pointer" onclick="deleteServer('+ "'" + data.list[i+1]['refSigns'] + "'" +')"/></td></tr>';
				
			}
			$("#fwqTable").append(listInfo);
		}
	}
}


var httpHost = $("#httpHost").val();

function showTj(){
    var dialog = new Dialog();
    dialog.Width=450;
    dialog.Height=250;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetTjserverHtml";
    dialog.show();
}

function showXg(id){
    var dialog = new Dialog();
    dialog.Width=450;
    dialog.Height=250;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetXgserverHtml&id="+id;
    dialog.show();
}


function deleteServer(id){
	if(confirm('此操作不可修复，真的确认删除吗？')){
		$.post('index.php?r=xtsz/DeleteServer',{id:id},function(data){
			alert(data.msg);
			if(data.mes == 'success'){
				window.location.href = "index.php?r=xtsz/GetFwqHtml";
			}
		},"json");
	}
}