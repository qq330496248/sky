//客户等级
$(function(){
	$.post('index.php?r=xtsz/GetHydj',function(data){
		getTable(data);
	},'json');
});


function getTable(data){
	if(data.result == 'success'){
		$('#hydjTable').empty();
		var length = data.list.length;
		if(length == 0){
			var foot = '<tr>';
			foot += '<td><font name="bh" id="bh">1</font></td>'
					+'<td><input type="text" class="dfinput" id="new" name="new" /></td>'
					+'<td><input type="button" class="btn" name="add" id="add" onclick="newHydj();" value="添加" /></td>'
					+'</tr>';
			$('#hydjTable').append(foot);
		}
		for(var i = 0; i < length; i+= 2){
			var listInfo = '';
			listInfo += '<tr class="singular"><input type="hidden" id="id_'+ data.list[i]['id'] +'" value="'+ data.list[i]['id'] +'" />';
			listInfo += '<td><span>'+ (i+1) +'</span></td>'
						+'<td><input type="text" class="dfinput" value="'+ data.list[i]['valuetype1'] +'" id="hydj_'+ data.list[i]['id'] +'" name="'+ data.list[i]['id'] +'" /></span></td>';		
			listInfo +=	'<td>'
						+ '<img src="public/img/save.png" title="保存" border="0" style="width:4%;cursor:pointer" onclick="updateHydj('+ data.list[i]['id'] +');">'
						+''
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="deleteHydj('+ data.list[i]['id'] +');"/></td>'
						+'</tr>';
			
			if(i < length - 1){
				listInfo += '<tr class="complex"><input type="hidden" id="id_'+ data.list[i+1]['id'] +'" value="'+ data.list[i+1]['id'] +'" />';
				listInfo += '<td><span>'+ (i+2) +'</span></td>'
							+'<td><input type="text" class="dfinput" value="'+ data.list[i+1]['valuetype1'] +'" id="hydj_'+ data.list[i+1]['id'] +'" name="'+ data.list[i+1]['id'] +'" /></span></td>';		
				listInfo +=	'<td>'
							+ '<img src="public/img/save.png" title="保存" border="0" style="width:4%;cursor:pointer" onclick="updateHydj('+ data.list[i+1]['id'] +');">'
							+''
							+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="deleteHydj('+ data.list[i+1]['id'] +');"/></td>'
							+'</tr>';
			}
			$('#hydjTable').append(listInfo);	
		}
		var foot = '<tr>';
		foot += '<td><font name="bh" id="bh">'+ (length+1) +'</font></td>'
				+'<td><input type="text" class="dfinput" id="new" name="new" /></td>'
				+'<td><input type="button" class="btn" name="add" id="add" onclick="newHydj();" value="添加" /></td>'
				+'</tr>';
		$('#hydjTable').append(foot);
	}else{
		var foot = '<tr>';
		foot += '<td><font name="bh" id="bh">1</font></td>'
				+'<td><input type="text" class="dfinput" id="new" name="new" /></td>'
				+'<td><input type="button" class="btn" name="add" id="add" onclick="newHydj();" value="添加" /></td>'
				+'</tr>';
		$('#hydjTable').append(foot);
	}
}

function newHydj(){
	var hydj = $("#new").val();
	if(hydj == ""){
		alert("客户等级不能为空！");
	}else{
		$.post('index.php?r=xtsz/AddHydj',{hydj:hydj},function(data){
           alert(data.msg);
           if(data.mes == 'success'){
           		window.location.href = 'index.php?r=xtsz/GetHydjHtml';
           }
        },'json');
	}
}

function updateHydj(id){
	var id = $("#id_"+id).val();
	var hydj = $("#hydj_"+id).val();
	if(hydj == ""){
		alert("客户等级不能为空！");
	}else{
		$.post('index.php?r=xtsz/UpdateHydj',{id:id,hydj:hydj},function(data){
        	alert(data.msg);
			if(data.mes == 'success'){
					window.location.href = 'index.php?r=xtsz/GetHydjHtml';
			}
        },'json');
	}
}

function deleteHydj(id){
	var id = $("#id_"+id).val();
	if(confirm("真的确认删除吗？")){
		$.post('index.php?r=xtsz/DeleteHydj',{id:id},function(data){
	       alert(data.msg);
           if(data.mes == 'success'){
           		window.location.href = 'index.php?r=xtsz/GetHydjHtml';
           }
	    },'json');
	}
}