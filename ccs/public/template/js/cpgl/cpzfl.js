$(function(){
	var parent = $("#parent").val();
	$.post('index.php?r=cpgl/GetCpzfl',{parent:parent},function(data){
		getTable(data);
	},'json');
});


function getTable(data){
	if(data.result == 'success'){
		$('#cpzflTable').empty();
		var length = data.list.length;
		for(var i = 0; i < length; i++){
			var listInfo = '';
			listInfo = '<tr>';
			listInfo += '<td><span>'+ data.list[i]['cpab02'] 
						+ '('+ data.list[i]['cpab01'] +')' +'</span></td>'
						+ '<td><a href="index.php?r=cpgl/GetUpdateCpfl&id='+ data.list[i]['cpab01']
						+ '"><input name="" type="button" class="btn" style="width:50px;" value="修改"/></a>'
						+ '<input name="" type="button" class="btn" onclick="deleteCpzfl('+ data.list[i]['cpab01'] +')" style="width:50px; color:#000000; background:#999999" value="删除"/>'
						+'</td>'
						+'</tr>';
			$('#cpzflTable').append(listInfo);	
		}
		/*if(data.pageHtml){
			//var pageInfo = '<tr><td colspan="15">'+ data.pageHtml +'</td></tr>';
			$('#pageInfo').empty();
			$('#pageInfo').append(pageInfo);
		}*/
	}else{
		$('#cpflTable').empty();
		var listInfo = '<tr><td colspan="2">暂时没有记录！</td></tr>';
		$('#cpflTable').append(listInfo);
	}
}

//删除产品子分类的确认
function deleteCpzfl(id){
	var con = confirm("真的确认删除吗？");
	if(con){
		$.post("index.php?r=cpgl/GetCpByZfl",{id:id},function(data){
			if(data.result == "success"){
				if(data.list.length == 0){
					 del(id);
				}else{
					alert("仍有产品属于这个子分类，不能删除！");
				}
			}
		},"json");
	}
}


//删除
function del(id){
	$.post('index.php?r=cpgl/DeleteCpfl',{id:id},function(data){
		getTable(data)
	},'json');
}