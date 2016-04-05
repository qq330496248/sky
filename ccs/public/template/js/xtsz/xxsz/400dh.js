//400电话
$(function(){
	$.post('index.php?r=xtsz/Get400Dh',function(data){
		getTable(data);
	},'json');
});

function getTable(data){
	if(data.result == 'success'){
		$('#dhTable').empty();
		var length = data.list.length;
		if(length == 0){
			var foot = '<tr>';
			foot += '<td><font name="bh" id="bh">1</font></td>'
					+'<td><input type="text" class="dfinput" onkeyup="checkNum(this)" id="neworphone" name="neworphone" /></td>'
					+'<td><input type="text" class="dfinput" onkeyup="checkNum(this)" id="newrealphone" name="newrealphone" /></td>'
					+'<td><input type="button" class="btn" name="add" id="add" onclick="new400Dh();" value="添加" /></td>'
					+'</tr>';
			$('#dhTable').append(foot);
		}
		for(var i = 0; i < length; i+= 2){
			var listInfo = '';
			listInfo += '<tr class="singular"><input type="hidden" id="id_'+ data.list[i]['id'] +'" value="'+ data.list[i]['id'] +'" />';
			listInfo += '<td><span>'+ (i+1) +'</span></td>'
						+'<td><input type="text" class="dfinput" value="'+ data.list[i]['orphone'] +'" id="orphone_'+ data.list[i]['id'] +'" name="'+ data.list[i]['id'] +'" /></span></td>'
						+'<td><input type="text" class="dfinput" value="'+ data.list[i]['realphone'] +'" id="realphone_'+ data.list[i]['id'] +'" name="'+ data.list[i]['id'] +'" /></span></td>';		
			listInfo +=	'<td>'
						+ '<input name="" type="button" class="btn" onclick="update400Dh('+ data.list[i]['id'] +');" style="width:50px;" value="保存"/>'
						+'&nbsp;&nbsp;&nbsp;'
						+ '<input name="" type="button" class="btn" onclick="delete400Dh('+ data.list[i]['id'] +');" style="width:50px; color:#000000; background:#999999" value="删除"/></td>'
						+'</tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex"><input type="hidden" id="id_'+ data.list[i+1]['id'] +'" value="'+ data.list[i+1]['id'] +'" />';
				listInfo += '<td><span>'+ (i+2) +'</span></td>'
							+'<td><input type="text" class="dfinput" value="'+ data.list[i+1]['orphone'] +'" id="orphone_'+ data.list[i+1]['id'] +'" name="'+ data.list[i+1]['id'] +'" /></span></td>'
							+'<td><input type="text" class="dfinput" value="'+ data.list[i+1]['realphone'] +'" id="realphone_'+ data.list[i+1]['id'] +'" name="'+ data.list[i+1]['id'] +'" /></span></td>';		
				listInfo +=	'<td>'
							+ '<input name="" type="button" class="btn" onclick="update400Dh('+ data.list[i+1]['id'] +');" style="width:50px;" value="保存"/>'
							+'&nbsp;&nbsp;&nbsp;'
							+ '<input name="" type="button" class="btn" onclick="delete400Dh('+ data.list[i+1]['id'] +');" style="width:50px; color:#000000; background:#999999" value="删除"/></td>'
							+'</tr>';
			}
			$('#dhTable').append(listInfo);	
		}
		var foot = '<tr>';
		foot += '<td><font name="bh" id="bh">'+ (length+1) +'</font></td>'
				+'<td><input type="text" class="dfinput" onkeyup="checkNum(this)" id="neworphone" name="neworphone" /></td>'
				+'<td><input type="text" class="dfinput" onkeyup="checkNum(this)" id="newrealphone" name="newrealphone" /></td>'
				+'<td><input type="button" class="btn" name="add" id="add" onclick="new400Dh();" value="添加" /></td>'
				+'</tr>';
		$('#dhTable').append(foot);
	}else{
		var foot = '<tr>';
		foot += '<td><font name="bh" id="bh">1</font></td>'
				+'<td><input type="text" class="dfinput" onkeyup="checkNum(this)" id="neworphone" name="neworphone" /></td>'
				+'<td><input type="text" class="dfinput" onkeyup="checkNum(this)" id="newrealphone" name="newrealphone" /></td>'
				+'<td><input type="button" class="btn" name="add" id="add" onclick="new400Dh();" value="添加" /></td>'
				+'</tr>';
		$('#dhTable').append(foot);
	}
}

function checkNum(phone){
	phone.value = phone.value.replace(/[^\d]/g,'');
}


function new400Dh(){
	var orphone = $("#neworphone").val();
	var realphone = $("#newrealphone").val();
	if(orphone == ""){
		alert("400电话不能为空！");
	}else if(realphone == ""){
		alert("实际电话不能为空！");
	}else{
		if(isNum(orphone) && isNum(realphone)){
			$.post('index.php?r=xtsz/Add400Dh',{orphone:orphone,realphone:realphone},function(data){
	        	alert(data.msg);
	        	if(data.res == 'success'){
	        		window.location.href = "index.php?r=xtsz/Get400dhHtml";
	        	}
	        },'json');
		}
	}
}

function update400Dh(id){
	var pid = $("#id_"+id).val();
	var orphone = $("#orphone_"+id).val();
	var realphone = $("#realphone_"+id).val();
	if(orphone == ""){
		alert("400电话不能为空！");
	}else if(realphone == ""){
		alert("实际电话不能为空！");
	}else{
		if(isNum(orphone) && isNum(realphone)){
			$.post('index.php?r=xtsz/Update400Dh',{id:pid,orphone:orphone,realphone:realphone},function(data){
	           getTable(data);
	        },'json');
		}	
	}
}

function delete400Dh(id){
	var id = $("#id_"+id).val();
	if(confirm("真的确认删除吗？")){
		$.post('index.php?r=xtsz/Delete400Dh',{id:id},function(data){
	         getTable(data);
	    },'json');
	}
}