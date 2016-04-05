$(function(){
	var parent = $("#parent").val();
	$.post('index.php?r=cpgl/GetCpsxxqByCond',{parent:parent},function(data){
		getTable(data);
	},'json');
});


function getTable(data){
	if(data.result == 'success'){
		$('#cpsxxqTable').empty();
		var length = data.list.length;
		for(var i = 0; i < length; i++){
			var listInfo = '';
			listInfo = '<tr>';
			listInfo += '<td><span>'+ data.list[i]['cpag02'] +'</span></td>'
						+'<td><span>'+ data.list[i]['cpag04'] +'</span></td>'
						+ '<td><a href="index.php?r=cpgl/GetUpdateCpsx&id='+ data.list[i]['cpag01']
						+ '"><input name="" type="button" class="btn" style="width:50px;" value="修改"/></a>&nbsp;&nbsp;&nbsp;'
						+ '<input name="" type="button" class="btn" onclick="deleteCpsxxq('+ data.list[i]['cpag01'] +')" style="width:50px; color:#000000; background:#999999" value="删除"/>'
						+'</td>'
						+'</tr>';
			$('#cpsxxqTable').append(listInfo);	
		}
		/*if(data.pageHtml){
			//var pageInfo = '<tr><td colspan="15">'+ data.pageHtml +'</td></tr>';
			$('#pageInfo').empty();
			$('#pageInfo').append(pageInfo);
		}*/
	}else{
		$('#cpsxxqTable').empty();
		var listInfo = '<tr><td>暂时没有记录！</td></tr>';
		$('#cpsxxqTable').append(listInfo);	
	}
}

function deleteCpsxxq(id){
	var ensure = confirm("确定要删除吗？");
	if(ensure){
		$.post('index.php?r=cpgl/DeleteCpsx',{id:id},function(data){
			if(data.result == 'success'){
				window.location.href="index.php?r=cpgl/GetCpsxHtml";
			}
		},'json');
	}
}