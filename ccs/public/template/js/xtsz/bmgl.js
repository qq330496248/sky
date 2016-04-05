$(function(){
	$.post("index.php?r=xtsz/GetDept",function(data){
		getTable(data);
	},"json");
});

function getTable(data){
	if(data){
		$("#bmTable").empty();
		var length = data.length;
		if(length == 0){
			var listInfo = '<tr><th colspan="4">暂时没有记录！</th></tr>';
			$('#bmTable').append(listInfo);
		}
		for(var i = 0; i < length; i += 2){
			var spaceStr = '';
			if(data[i]['level'] > 0){
				for(var s = 0; s < data[i]['level']; s ++){
					spaceStr += "&nbsp;&nbsp;";
				}
				spaceStr += "┖";
			}
			var listInfo = '';
			listInfo += '<tr class="singular"><td><span>'+ (i + 1) +'</span></td>'
						+ '<td style="text-align:left"><span>'+ spaceStr + data[i]['depttext'] +'</span></td>'
						+'<td><span>'+ data[i]['ifmarket'] +'</span></td>'
						+ '<td><a href="index.php?r=xtsz/GetTjbmHtml&higher='+ data[i]['deptid']
						+'"><input name="" type="button" class="btn" style="width:100px;" value="添加子部门"/></a>'
						+'<a href="index.php?r=xtsz/GetSingleDept&id='+ data[i]['deptid']
						+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:4%;cursor:pointer"></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="delBm(' + data[i]['deptid'] +')">'
						+'</td></tr>';
			if(i != length - 1){
				spaceStr = '';
				if(data[i+1]['level'] > 0){
					for(var s = 0; s < data[i+1]['level']; s ++){
						spaceStr += "&nbsp;&nbsp;";
					}
					spaceStr += "┖";
				}
				listInfo += '<tr class="complex"><td><span>'+ (i + 2) +'</span></td>'
							+ '<td style="text-align:left"><span>'+ spaceStr + data[i+1]['depttext'] +'</span></td>'
							+'<td><span>'+ data[i+1]['ifmarket'] +'</span></td>'
							+ '<td><a href="index.php?r=xtsz/GetTjbmHtml&higher='+ data[i+1]['deptid']
							+'"><input name="" type="button" class="btn" style="width:100px;" value="添加子部门"/></a>'
							+'<a href="index.php?r=xtsz/GetSingleDept&id='+ data[i+1]['deptid']
							+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:4%;cursor:pointer"></a>'
							+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="delBm(' + data[i+1]['deptid'] +','+ data[i+1]['depttext'] +')">'
							+'</td></tr>';
			}
			$('#bmTable').append(listInfo);	
		}
	}else{
		$("#bmTable").empty();
		var listInfo = '<tr><th colspan="4">暂时没有记录！</th></tr>';
		$('#bmTable').append(listInfo);
	}
}



//删除部门的信息确认
function delBm(id,dept){
	var con = confirm("真的确认删除吗？");
	if(con){
		$.post("index.php?r=xtsz/GetRylistByBm",{dept:dept},function(data){
			if(data.result == "success"){
				if(data.list.length == 0){
					getBm(id);
				}else{
					alert("仍有员工属于这个部门，不能删除！");
				}
			}
		},"json");
	}
}

//
function getBm(id){
	$.post("index.php?r=xtsz/GetBmByHigher",{id:id},function(data){
		if(data.result == "success"){
			if(data.list.length == 0){
				del(id);
			}else{
				alert("仍有部门属于这个部门，不能删除！");
			}
		}
	},"json");
}

//删除
function del(id){
	$.post("index.php?r=xtsz/DeleteDept",{id:id},function(data){
		alert(data.mes);
		if(data.res == "success"){
			window.location.href = "index.php?r=xtsz/GetBmglHtml";
		}
	},"json");
}