$(function(){
	$.post("index.php?r=zsk/GetZsfl",function(data){
		getTable(data);
	},"json");
});


function getTable(data){
	if(data){
		$("#zsflTable").empty();
		var length = data.length;
		if(length == 0){
			var listInfo = '<tr><th colspan="4">暂时没有记录！</th></tr>';
			$('#zsflTable').append(listInfo);
		}
		var num = 0;
		for(var i = 0; i < length; i ++){
			var listInfo = '';

			var spaceStr = '';
			if(data[i]['level'] > 0){
				for(var s = 0; s < data[i]['level']; s ++){
					spaceStr += "&nbsp;&nbsp;";
				}
				spaceStr += "┖";
			}
			if(data[i]['level'] == 0){
				num = data[i]['id']; 
				listInfo += '<tr onclick="showTheSon('+ data[i]['id'] +')"><th style="text-align:left;height:30px"><span>'+ spaceStr + data[i]['typename'] +'</span></th>'
							+'<th><span>'+ data[i]['operylist'] +'</span></th>'
							+'<th><span>'+ data[i]['viewrylist'] +'</span></th>'
							+ '<th><a href="index.php?r=zsk/GetTjzsflHtml&higher='+ data[i]['id']
							+'"><input name="" type="button" class="btn" style="width:100px;" value="添加子分类"/></a>'
							+'<a href="index.php?r=zsk/GetSingleFl&id='+ data[i]['id']
							+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:2.5%;cursor:pointer"></a>'
							+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:2.5%;cursor:pointer" onclick="checkZslb(' + data[i]['id'] +')">'
							+'</th></tr>';
			}else{
				listInfo += '<tr id="'+num+'" now="hide"><td style="text-align:left"><span>'+ spaceStr + data[i]['typename'] +'</span></td>'
						+'<td><span>'+ data[i]['operylist'] +'</span></td>'
						+'<td><span>'+ data[i]['viewrylist'] +'</span></td>'
						+ '<td><a href="index.php?r=zsk/GetTjzsflHtml&higher='+ data[i]['id']
						+'"><input name="" type="button" class="btn" style="width:100px;" value="添加子分类"/></a>'
						+'<a href="index.php?r=zsk/GetSingleFl&id='+ data[i]['id']
						+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:2.5%;cursor:pointer"></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:2.5%;cursor:pointer" onclick="checkZslb(' + data[i]['id'] +')"/>'
						+'</td></tr>';
			}
			$('#zsflTable').append(listInfo);	
		}
	}else{
		$("#zsflTable").empty();
		var listInfo = '<tr><th colspan="4">暂时没有记录！</th></tr>';
		$('#zsflTable').append(listInfo);
	}
}

/*
function showTheSon(id){
	if($('#'+id).attr('now') == 'hide'){
		$('#'+id).show();
		$('#'+id).attr('now','show');
	}else{
		$('#'+id).hide();
		$('#'+id).attr('now','hide');
	}
}*/

//检查这一个分类下有没有知识列表
function checkZslb(id){
	if(confirm("真的确认删除吗？")){
		$.post("index.php?r=zsk/GetZsk",{type:id},function(data){
			if(data.res == 'success'){
				alert('这个知识分类下仍有知识列表，不可删除！');
				return ;
			}
			checkZszfl(id);
		});
		/*$.post("index.php?r=zsk/DeleteZsfl",{id:id},function(data){
			alert(data.mes);
			if(data.res == "success"){
				window.location.href = "index.php?r=zsk/GetZsflHtml";
			}
		},"json");*/
	}
}

//检查这一分类下有没有子分类
function checkZszfl(id){
	$.post("index.php?r=zsk/CheckZszfl",{id:id},function(data){
		if(data.res == 'false'){
			delZsfl(id);
		}else{
			alert('这个知识分类下仍有子分类，不可删除！');
		}
	});
}

//
function delZsfl(id){
	$.post("index.php?r=zsk/DeleteZsfl",{id:id},function(data){
		alert(data.msg);
		if(data.res == "success"){
			window.location.href = "index.php?r=zsk/GetZsflHtml";
		}
	},"json");
}
