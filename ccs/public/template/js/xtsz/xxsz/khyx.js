//客户意向
$(function(){
	$.post('index.php?r=xtsz/GetKhyx',function(data){
		getTable(data);
	},'json');

	
});

function getTable(data){
	if(data.result == 'success'){
		$('#khyxTable').empty();
		var length = data.list.length;
		if(length == 0){
			var foot = '<tr>';
			foot += '<td><font name="bh" id="bh">1</font></td>'
					+'<td><input type="text" class="dfinput" id="new" name="new" /></td>'
					+'<td><input type="radio" name="newPub" value="T" checked />显示'
					+'<input type="radio" name="newPub" value="F" />隐藏</td>'
					+'<td><input type="button" class="btn" name="add" id="add" onclick="newKhyx();" value="添加" /></td>'
					+'</tr>';
			$('#khyxTable').append(foot);
		}
		for(var i = 0; i < length; i+= 2){
			var listInfo = '';
			listInfo += '<tr class="singular"><input type="hidden" id="id_'+ data.list[i]['id'] +'" value="'+ data.list[i]['id'] +'" />';
			listInfo += '<td><span>'+ (i+1) +'</span></td>'
						+'<td><input type="text" class="dfinput" value="'+ data.list[i]['valuetype1'] +'" id="khyx_'+ data.list[i]['id'] +'" name="'+ data.list[i]['id'] +'" /></span></td>';
			if(data.list[i]['valuetype2'] == "T"){
				listInfo += '<td><input type="radio" name="isPub_'+ data.list[i]['id'] +'" id="isPub_'+ data.list[i]['id'] +'" value="T" checked />显示'
							+'<input type="radio" name="isPub_'+ data.list[i]['id'] +'" id="isPub_'+ data.list[i]['id'] +'" value="F" />隐藏</td>';
			}else{
				listInfo += '<td><input type="radio" name="isPub_'+ data.list[i]['id'] +'" id="isPub_'+ data.list[i]['id'] +'" value="T"/>显示'
							+'<input type="radio" name="isPub_'+ data.list[i]['id'] +'" id="isPub_'+ data.list[i]['id'] +'" value="F"  checked />隐藏</td>';
			}			
			listInfo +=	'<td>'
						+ '<img src="public/img/save.png" title="保存" border="0" style="width:4%;cursor:pointer" onclick="updateKhyx('+ data.list[i]['id'] +');">'
						+''
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="deleteKhyx('+ data.list[i]['id'] +');"></td>'
						+'</tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex"><input type="hidden" id="id_'+ data.list[i+1]['id'] +'" value="'+ data.list[i+1]['id'] +'" />';
				listInfo += '<td><span>'+ (i+2) +'</span></td>'
							+'<td><input type="text" class="dfinput" value="'+ data.list[i+1]['valuetype1'] +'" id="khyx_'+ data.list[i+1]['id'] +'" name="'+ data.list[i+1]['id'] +'" /></span></td>';
				if(data.list[i]['valuetype2'] == "T"){
					listInfo += '<td><input type="radio" name="isPub_'+ data.list[i+1]['id'] +'" id="isPub_'+ data.list[i+1]['id'] +'" value="T" checked />显示'
								+'<input type="radio" name="isPub_'+ data.list[i+1]['id'] +'" id="isPub_'+ data.list[i+1]['id'] +'" value="F" />隐藏</td>';
				}else{
					listInfo += '<td><input type="radio" name="isPub_'+ data.list[i+1]['id'] +'" id="isPub_'+ data.list[i+1]['id'] +'" value="T"/>显示'
								+'<input type="radio" name="isPub_'+ data.list[i+1]['id'] +'" id="isPub_'+ data.list[i+1]['id'] +'" value="F"  checked />隐藏</td>';
				}			
				listInfo +=	'<td>'
							+ '<img src="public/img/save.png" title="保存" border="0" style="width:4%;cursor:pointer" onclick="updateKhyx('+ data.list[i+1]['id'] +');">'
							+''
							+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="deleteKhyx('+ data.list[i+1]['id'] +');"></td>'
							+'</tr>';
			}
			$('#khyxTable').append(listInfo);	
		}
		var foot = '<tr>';
		foot += '<td><font name="bh" id="bh">'+ (length+1) +'</font></td>'
				+'<td><input type="text" class="dfinput" id="new" name="new" /></td>'
				+'<td><input type="radio" name="newPub" value="T" checked />显示'
				+'<input type="radio" name="newPub" value="F" />隐藏</td>'
				+'<td><input type="button" class="btn" name="add" id="add" onclick="newKhyx();" value="添加" /></td>'
				+'</tr>';
		$('#khyxTable').append(foot);
	}else{
		var foot = '<tr>';
		foot += '<td><font name="bh" id="bh">1</font></td>'
				+'<td><input type="text" class="dfinput" id="new" name="new" /></td>'
				+'<td><input type="radio" name="newPub" value="T" checked />显示'
				+'<input type="radio" name="newPub" value="F" />隐藏</td>'
				+'<td><input type="button" class="btn" name="add" id="add" onclick="newKhyx();" value="添加" /></td>'
				+'</tr>';
		$('#khyxTable').append(foot);
	}
}

function newKhyx(){
	var khyx = $("#new").val();
	var isPub = $("input[name='newPub']:checked").val();
	if(khyx == ""){
		alert("客户意向不能为空！");
	}else{
		var con = confirm("真的确认提交吗？");
		if(con){
			$.post('index.php?r=xtsz/AddKhyx',{khyx:khyx,isPub:isPub},function(data){
		       alert(data.msg);
		       if(data.res == 'success'){
		       		window.location.href = 'index.php?r=xtsz/GetKhyxHtml';
		       }
	        },'json');
		}
	}
	
}

function updateKhyx(id){
	var id = $("#id_"+id).val();
	var khyx = $("#khyx_"+id).val();
	var isPub = $("input[name='isPub_"+id+"']:checked").val();
	if(khyx == ""){
		alert("客户意向不能为空！");
	}else{
		var con = confirm("真的确认提交吗？");
		if(con){
			$.post('index.php?r=xtsz/UpdateKhyx',{id:id,khyx:khyx,isPub:isPub},function(data){
		       alert(data.msg);
		       if(data.res == 'success'){
		       		window.location.href = 'index.php?r=xtsz/GetKhyxHtml';
		       }
	        },'json');
	    }
	}
	
}

function deleteKhyx(id){
	var id = $("#id_"+id).val();
	var con = confirm("确认删除吗？");
	if(con){
		$.post('index.php?r=xtsz/DeleteKhyx',{id:id},function(data){
	       alert(data.msg);
	       if(data.res == 'success'){
	       		window.location.href = 'index.php?r=xtsz/GetKhyxHtml';
	       }
	    },'json');
	}
}