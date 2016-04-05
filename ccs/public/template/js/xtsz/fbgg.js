$(function(){
	$.post('index.php?r=xtsz/GetAnnByCond',function(data){
		getTable(data);
	},'json');
});

function getTable(data){
	if(data.result == 'success'){
		$('#annTable').empty();
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><th colspan="5">暂时没有记录！</th></tr>'
			$('#annTable').append(listInfo);
		}
		for(var i = 0; i < length; i+= 2){
			var listInfo = '';
			listInfo = '<tr class="singular">';
			if(data.list[i]['iftop'] =='T'){
				listInfo += '<td><span><font color="#FF0000">[顶]</font>'+ data.list[i]['title'] +'</span></td>';
			}else{
				listInfo += '<td><span>'+ data.list[i]['title'] +'</span></td>';
			}
			listInfo += '<td><span>'+ data.list[i]['anntype'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['personname'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['anndate'] +'</span></td>'		
						+'<td><a href="index.php?r=xtsz/GetSingleAnn&id='+ data.list[i]['id']
						+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:7%;cursor:pointer"></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:7%;cursor:pointer" onclick="deleteAnn('+data.list[i]['id']+')"></td>'
						+'</tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex">';
				if(data.list[i+1]['iftop'] =='T'){
					listInfo += '<td><span><font color="#FF0000">[顶]</font>'+ data.list[i+1]['title'] +'</span></td>';
				}else{
					listInfo += '<td><span>'+ data.list[i+1]['title'] +'</span></td>';
				}
				listInfo += '<td><span>'+ data.list[i+1]['anntype'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['personname'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['anndate'] +'</span></td>'		
							+'<td><a href="index.php?r=xtsz/GetSingleAnn&id='+ data.list[i+1]['id']
							+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:7%;cursor:pointer"></a>'
							+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:7%;cursor:pointer" onclick="deleteAnn('+data.list[i+1]['id']+')"></td>'
							+'</tr>';
			}
			$('#annTable').append(listInfo);	
		}
	}else{
		$('#annTable').empty();
		var listInfo = '<tr><th colspan="5">暂时没有记录！</th></tr>'
		$('#annTable').append(listInfo);
	}
}

//查找公告
function getAnn(){
	var anntype = $("#anntype").val();
	var begindate = $("#begindate").val();
	var enddate = $("#enddate").val();
	$.post('index.php?r=xtsz/GetAnnByCond',{anntype:anntype,begindate:begindate,enddate:enddate},function(data){
		getTable(data);
	},'json');
}


//删除公告
function deleteAnn(id){
	if(confirm("真的确认删除吗？")){
		$.post("index.php?r=xtsz/DeleteAnn",{id:id},function(data){
			getTable(data);
		},"json");
	}
}