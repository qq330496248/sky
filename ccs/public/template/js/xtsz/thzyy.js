$(function(){
	var parent = $("#parent").val();
	$.post('index.php?r=xtsz/GetThzyyByCond',{parent:parent},function(data){
		getTable(data);
	},"json");
});


function getTable(data){
	$("#thzyyTable").empty();
	var length = data.length;
	for(var i = 0; i < length; i += 2){
		var listInfo = '<tr class="singular">'
						+'<td>'+ data[i]['xsaf02'] +'</td>'
						+'<td><a href="index.php?r=xtsz/GetSingleThzyy&id='+ data[i]['xsaf03']
						+ '"><input name="" type="button" class="btn" style="width:50px;" value="修改"/></a>'
						+ '<input name="" type="button" class="btn" onclick="deleteThzyy('+ data[i]['xsaf01'] +')" style="width:50px; color:#000000; background:#999999" value="删除"/>'
						+'</td></tr>';
		if(i < length - 1){
			listInfo += '<tr class="complex">'
						+'<td>'+ data[i+1]['xsaf02'] +'</td>'
						+'<td><a href="index.php?r=xtsz/GetSingleThzyy&id='+ data[i+1]['xsaf03']
						+ '"><input name="" type="button" class="btn" style="width:50px;" value="修改"/></a>'
						+ '<input name="" type="button" class="btn" onclick="deleteThzyy('+ data[i+1]['xsaf01'] +')" style="width:50px; color:#000000; background:#999999" value="删除"/>'
						+'</td></tr>';
		}
		$("#thzyyTable").append(listInfo);
	}
}


function deleteThzyy(id){
	var parent = $("#parent").val();
	if(confirm('真的确认删除吗?')){
		$.post("index.php?r=xtsz/DeteleThzyy",{id:id},function(data){
			alert(data.msg);
			if(data.mes == 'success'){
				window.location.href = "index.php?r=xtsz/GetThzyyHtml&parent="+parent;
			}
		},"json");
	}
}