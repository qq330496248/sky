$(function(){
	$.post('index.php?r=xtsz/GetGroupRight',function(data){
		getTable(data);
	},'json');
});

function getTable(data){
	if(data.result == 'success'){
		$('#qxjsTable').empty();
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><td colspan="4">暂时没有记录！</td></tr>';
			$('#qxjsTable').append(listInfo);
		}
		for(var i = 0; i < length; i+= 2){
			var listInfo = '';
			listInfo += '<tr class="singular"><td><span>'+ data.list[i]['groupname'] +'</span></td>'
						+ '<td><span></span></td>'
						+ '<td><span></span></td>'
						+ '<td><a href="index.php?r=xtsz/GetSingleGroupRight&groupbh=' + data.list[i]['groupbh']
						+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:2%;cursor:pointer"></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:2%;cursor:pointer" onclick="delQxjs('+"'"+data.list[i]['groupbh']+"'"+')"></td>'
						+'</tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex"><td><span>'+ data.list[i+1]['groupname'] +'</span></td>'
						+ '<td><span></span></td>'
						+ '<td><span></span></td>'
						+ '<td><a href="index.php?r=xtsz/GetSingleGroupRight&groupbh=' + data.list[i+1]['groupbh']
						+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:2%;cursor:pointer"></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:2%;cursor:pointer" onclick="delQxjs('+"'"+data.list[i+1]['groupbh']+"'"+')"></td>'
						+'</tr>';
			}
			$('#qxjsTable').append(listInfo);	
		}
		/*if(data.pageHtml){
			//var pageInfo = '<tr><td colspan="15">'+ data.pageHtml +'</td></tr>';
			$('#pageInfo').empty();
			$('#pageInfo').append(pageInfo);
		}*/
	}else{
		$("#qxjsTable").empty();
		var listInfo = '<tr><td colspan="4">暂时没有记录！</td></tr>';
		$('#qxjsTable').append(listInfo);
	}
}

//DeleteGroupRight
function delQxjs(groupbh){
	var con = confirm("真的要删除吗？");
	var a = false;//用于接收确认能否删除的信息
	if(con){
		$.post("index.php?r=xtsz/GetRylistByGroupbh",{groupbh:groupbh},function(data){
			if(data.result == "success"){
				if(data.list.length == 0){
					a = true;
				}
			}
			if(con && a){
				del(groupbh);
			}else{
				alert("仍有工号属于这个权限角色，不能删除！")
			}
		},"json");
		
	}
}

function del(groupbh){
	$.post('index.php?r=xtsz/DeleteGroupRight',{groupbh:groupbh},function(data){
		alert(data.msg);
		if(data.res == 'success'){
			window.location.href = 'index.php?r=xtsz/GetQxjsHtml';
		}
	},'json');
}