//快递公司
$(function(){
	$.post('index.php?r=xtsz/GetKdgs',function(data){
		 getTable(data);
	},'json');

	
});

function getTable(data){
	if(data.result == 'success'){
		$('#kdgsTable').empty();
		var length = data.list.length;
		if(length == 0){
			var foot = '<tr>';
			foot += '<td><font name="bh" id="bh">'+ (length+1) +'</font></td>'
					+'<td><input type="text" class="dfinput" id="kdgs" name="kdgs" /></td>'
					+'<td style="text-align:left"><input type="button" class="btn" name="add" id="add" onclick="newKdgs();" value="添加" /></td>'
					+'</tr>';
			$('#kdgsTable').append(foot);
		}
		for(var i = 0; i < length; i+= 2){
			var listInfo = '';
			listInfo += '<tr class="singular"><input type="hidden" id="id_'+ data.list[i]['kdgsid'] +'" value="'+ data.list[i]['id'] +'" />';
			listInfo += '<td><span>'+ (i+1) +'</span></td>'
						+'<td><input type="text" class="dfinput" value="'+ data.list[i]['kdgstext'] +'" id="kdgs_'+ data.list[i]['id'] +'" name="'+ data.list[i]['id'] +'" /></td>'
						+'<td style="text-align:left">';
			if(data.list[i]['ifuse'] == "T"){
				listInfo += '<font color="#FF0000">已启用</font>'
							+'<input name="" type="button" disabled="disabled" class="btn" onclick="startKdgs('+ data.list[i]['id'] +');" style="width:50px;cursor:not-allowed;background:gray;" value="启用"/>'
							+ '<input name="" type="button" class="btn" onclick="stopKdgs('+ data.list[i]['kdgsid'] +');" style="width:50px;" value="禁用"/>';
			}else{
				listInfo += '<font color="#000000">已停用</font>'
							+'<input name="" type="button" class="btn" onclick="startKdgs('+ data.list[i]['kdgsid'] +');" style="width:50px;" value="启用"/>'
							+ '<input name="" type="button" disabled="disabled" class="btn" onclick="stopKdgs('+ data.list[i]['kdgsid'] +');" style="width:50px;cursor:not-allowed;background:gray;" value="禁用"/>';
			}
			listInfo += '<img src="public/img/del.png" title="点击删除" border="0" style="width:1.3%;cursor:pointer" onclick="delKdgs('+ data.list[i]['kdgsid'] +');"/>'
						+'</td></tr>';

			if(i < length - 1){
				listInfo += '<tr class="complex"><input type="hidden" id="id_'+ data.list[i+1]['kdgsid'] +'" value="'+ data.list[i+1]['id'] +'" />';
				listInfo += '<td><span>'+ (i+2) +'</span></td>'
							+'<td><input type="text" class="dfinput" value="'+ data.list[i+1]['kdgstext'] +'" id="kdgs_'+ data.list[i+1]['id'] +'" name="'+ data.list[i+1]['id'] +'" /></td>'
							+'<td style="text-align:left">';
				if(data.list[i+1]['ifuse'] == "T"){
					listInfo += '<font color="#FF0000">已启用</font>'
								+'<input name="" type="button" disabled="disabled" class="btn" onclick="startKdgs('+ data.list[i+1]['id'] +');" style="width:50px;cursor:not-allowed;background:gray;" value="启用"/>'
								+ '<input name="" type="button" class="btn" onclick="stopKdgs('+ data.list[i+1]['kdgsid'] +');" style="width:50px;" value="禁用"/>';
				}else{
					listInfo += '<font color="#000000">已停用</font>'
								+'<input name="" type="button" class="btn" onclick="startKdgs('+ data.list[i+1]['kdgsid'] +');" style="width:50px;" value="启用"/>'
								+ '<input name="" type="button" disabled="disabled" class="btn" onclick="stopKdgs('+ data.list[i+1]['kdgsid'] +');" style="width:50px;cursor:not-allowed;background:gray;" value="禁用"/>';
				}
				listInfo += '<img src="public/img/del.png" title="点击删除" border="0" style="width:1.3%;cursor:pointer" onclick="delKdgs('+ data.list[i+1]['kdgsid'] +');"/>'
							+'</td></tr>';
			}
			$('#kdgsTable').append(listInfo);	
		}
		var foot = '<tr>';
		foot += '<td><font name="bh" id="bh">'+ (length+1) +'</font></td>'
				+'<td><input type="text" class="dfinput" id="kdgs" name="kdgs" /></td>'
				+'<td style="text-align:left"><input type="button" class="btn" name="add" id="add" onclick="newKdgs();" value="添加" /></td>'
				+'</tr>';
		$('#kdgsTable').append(foot);
	}else{
		$('#kdgsTable').empty();
		var foot = '<tr>';
		foot += '<td><font name="bh" id="bh">1</font></td>'
				+'<td><input type="text" class="dfinput" id="kdgs" name="kdgs" /></td>'
				+'<td style="text-align:left"><input type="button" class="btn" name="add" id="add" onclick="newKdgs();" value="添加" /></td>'
				+'</tr>';
		$('#kdgsTable').append(foot);
	}
}

function newKdgs(){
	var kdgs = $("#kdgs").val();
	if(kdgs == ""){
		alert("快递公司不能为空！");
	}else{
		var con = confirm("真的确认提交吗？");
		if(con){
			$.post('index.php?r=xtsz/AddKdgs',{kdgs:kdgs},function(data){
		       alert(data.msg);
		       if(data.res == 'success'){
		       		window.location.href = "index.php?r=xtsz/GetKdgsHtml";
		       }
	        },'json');
		}
	}
	
}
//启用
function startKdgs(id){
	$.post('index.php?r=xtsz/StartKdgs',{id:id},function(data){
        getTable(data);
    },'json');
}
//禁用
function stopKdgs(id){
	$.post('index.php?r=xtsz/StopKdgs',{id:id},function(data){
       getTable(data);
    },'json');
}


function delKdgs(id){
	var con = confirm("真的确认删除吗？");
	if(con){
		$.post('index.php?r=xtsz/DeleteKdgs',{id:id},function(data){
		   alert(data.msg);
	       if(data.res == 'success'){
	       		window.location.href = "index.php?r=xtsz/GetKdgsHtml";
	       }
		},'json');
	}
}