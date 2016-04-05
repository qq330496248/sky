//客户跟进标签
$(function(){
	$.post('index.php?r=xtsz/GetKhgjbq',function(data){
		getTable(data);
	},'json');

	
});

function getTable(data){
	if(data.result == 'success'){
		$('#gjbqTable').empty();
		var length = data.list.length;
		if(length == 0){
			var foot = '<tr>';
			foot += '<td><font name="bh" id="bh">1</font></td>'
					+'<td><input type="text" class="dfinput" id="new" name="new" /></td>'
					+'<td><input type="text" class="dfinput" id="xh" name="xh" /></td>'
					+'<td><input type="button" class="btn" name="add" id="add" onclick="newKhgjbq();" value="添加" /></td>'
					+'</tr>';
			$('#gjbqTable').append(foot);
		}
		for(var i = 0; i < length; i+= 2){
			var listInfo = '';
			listInfo += '<tr class="singular"><input type="hidden" id="id_'+ data.list[i]['id'] +'" value="'+ data.list[i]['id'] +'" />';
			listInfo += '<td><span>'+ (i+1) +'</span></td>'
						+'<td><input type="text" class="dfinput" value="'+ data.list[i]['valuetype1'] +'" id="khgjbq_'+ data.list[i]['id'] +'" name="'+ data.list[i]['id'] +'" /></span></td>'	
						+'<td><input type="text" class="dfinput" value="'+ data.list[i]['valuetype3'] +'" id="xh_'+ data.list[i]['id'] +'" name="'+ data.list[i]['id'] +'" /></span></td>'
						+'<td>'
						+ '<img src="public/img/save.png" title="保存" border="0" style="width:4%;cursor:pointer" onclick="updateKhgjbq('+ data.list[i]['id'] +');">'
						+''
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="deleteKhgjbq('+ data.list[i]['id'] +');"></td>'
						+'</tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex"><input type="hidden" id="id_'+ data.list[i+1]['id'] +'" value="'+ data.list[i+1]['id'] +'" />';
				listInfo += '<td><span>'+ (i+2) +'</span></td>'
							+'<td><input type="text" class="dfinput" value="'+ data.list[i+1]['valuetype1'] +'" id="khgjbq_'+ data.list[i+1]['id'] +'" name="'+ data.list[i+1]['id'] +'" /></span></td>'	
							+'<td><input type="text" class="dfinput" value="'+ data.list[i+1]['valuetype3'] +'" id="xh_'+ data.list[i+1]['id'] +'" name="'+ data.list[i+1]['id'] +'" /></span></td>'
							+'<td>'
							+ '<img src="public/img/save.png" title="保存" border="0" style="width:4%;cursor:pointer" onclick="updateKhgjbq('+ data.list[i+1]['id'] +');">'
							+''
							+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="deleteKhgjbq('+ data.list[i+1]['id'] +');"></td>'
							+'</tr>';
			}
			$('#gjbqTable').append(listInfo);	
		}
		var foot = '<tr>';
		foot += '<td><font name="bh" id="bh">'+ (length+1) +'</font></td>'
				+'<td><input type="text" class="dfinput" id="new" name="new" /></td>'
				+'<td><input type="text" class="dfinput" id="xh" name="xh" /></td>'
				+'<td><input type="button" class="btn" name="add" id="add" onclick="newKhgjbq();" value="添加" /></td>'
				+'</tr>';
		$('#gjbqTable').append(foot);
	}else{
		var foot = '<tr>';
		foot += '<td><font name="bh" id="bh">1</font></td>'
				+'<td><input type="text" class="dfinput" id="new" name="new" /></td>'
				+'<td><input type="text" class="dfinput" id="xh" name="xh" /></td>'
				+'<td><input type="button" class="btn" name="add" id="add" onclick="newKhgjbq();" value="添加" /></td>'
				+'</tr>';
		$('#gjbqTable').append(foot);
	}
}

function newKhgjbq(){
	var khgjbq = $("#new").val();
	var xh = $("#xh").val();
	if(khgjbq == ""){
		alert("客户跟进标签不能为空！");
	}else{
		$.post('index.php?r=xtsz/AddKhgjbq',{khgjbq:khgjbq,xh:xh},function(data){
        	alert(data.msg);
        	if(data.res == 'success'){
        		window.location.href = "index.php?r=xtsz/GetKhgjbqHtml";
        	}
        },'json');
	}
}

function updateKhgjbq(id){
	var id = $("#id_"+id).val();
	var khgjbq = $("#khgjbq_"+id).val();
	var xh = $("#xh_"+id).val();
	if(khgjbq == ""){
		alert("客户跟进标签不能为空！");
	}else{
		if(confirm("真的确认提交吗？")){
			$.post('index.php?r=xtsz/UpdateKhgjbq',{id:id,khgjbq:khgjbq,xh:xh},function(data){
	            alert(data.msg);
	        	if(data.res == 'success'){
	        		window.location.href = "index.php?r=xtsz/GetKhgjbqHtml";
	        	}
	        },'json');
		}
	}
}

function deleteKhgjbq(id){
	var id = $("#id_"+id).val();
	if(confirm("真的确认删除吗？")){
		$.post('index.php?r=xtsz/DeleteKhgjbq',{id:id},function(data){
			alert(data.msg);
			if(data.res == 'success'){
				window.location.href = "index.php?r=xtsz/GetKhgjbqHtml";
			}
	    },'json');
	}
}