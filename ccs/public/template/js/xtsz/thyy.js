$(function(){
	$.post("index.php?r=xtsz/GetThyyHigherByCond",function(data){
		getTable(data);
	},"json");
});



function getTable(data){
	$("#thyyTable").empty();
	var length = data.length;
	for(var i = 0; i < length; i += 2){
		var listInfo = '<tr class="singular">'
						+'<td>'+ data[i]['xsae02'] +'</td>'
						+'<td><a href="index.php?r=xtsz/GetThzyyHtml&parent='+ data[i]['xsae01']
						+ '"><img src="public/img/1.png" title="查看子分类" border="0" style="width:6%;cursor:pointer"/></a>'
						+'<a href="index.php?r=xtsz/GetSingleThyy&id='+ data[i]['xsae01']
						+'"><img src="public/img/reservin.png" title="编辑" border="0" style="width:5.5%;cursor:pointer"></a>'
						+ '<img src="public/img/del.png" title="删除" border="0" style="width:5.5%;cursor:pointer" onclick="deleteThyy('+ data[i]['xsae01'] +')"/>'
						+'</td></tr>';
		if(i < length - 1){
			listInfo += '<tr class="complex">'
						+'<td>'+ data[i+1]['xsae02'] +'</td>'
						+'<td><a href="index.php?r=xtsz/GetThzyyHtml&parent='+ data[i+1]['xsae01']
						+ '"><img src="public/img/1.png" title="查看子分类" border="0" style="width:6%;cursor:pointer"/></a>'
						+'<a href="index.php?r=xtsz/GetSingleThyy&id='+ data[i+1]['xsae01']
						+'"><img src="public/img/reservin.png" title="编辑" border="0" style="width:5.5%;cursor:pointer"></a>'
						+ '<img src="public/img/del.png" title="删除" border="0" style="width:5.5%;cursor:pointer" onclick="deleteThyy('+ data[i+1]['xsae01'] +')"/>'
						+'</td></tr>';
		}
		$("#thyyTable").append(listInfo);
	}
}


function deleteThyy(id){
	if(confirm('真的确认删除吗？')){
		$.post("index.php?r=xtsz/GetThzyyByCond",{parent:id},function(data){
			if(data.res == 'error'){
				toDeleteThyy(id);
			}else{
				alert('还有原因详情输入这个大类，不可删除');
			}
		},"json");
	}	
}

function toDeleteThyy(id){
	$.post("index.php?r=xtsz/DeleteThyy",{id:id},function(data){
		alert(data.msg);
		if(data.mes == 'success'){
			window.location.href = 'index.php?r=xtsz/GetThyyHtml';
		}
	},"json");
}