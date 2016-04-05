$(function(){
	$.post("index.php?r=mtgl/GetMediaByCond",function(data){
		getTable(data);
	},"json");

});

//获取表格
function getTable(data){
	if(data.result == "success"){
		$("#mediaTable").empty();
		var length = data.list.length;
		for(var i = 0;i < length; i += 2){
			var listInfo = '<tr class="singular"><td>'+(i + 1)+'</td><td>'+data.list[i]['mediaid']+'</td>'
							+'<td><input name="" id="name_'+data.list[i]['mediaid']+'" value="'+data.list[i]['mediatext']+'" type="text" class="dfinput" style="width:100px" /></td>'
							+'<td><select class="dfinput" id="type_'+data.list[i]['mediaid']+'" style="width:100px">';
			switch(data.list[i]['type']){
				case "网络":
					listInfo += '<option value="网络" selected>网络</option><option value="电视">电视</option><option value="杂志">杂志</option><option value="其他">其他</option>';
					break;
				case "电视":
					listInfo += '<option value="网络">网络</option><option value="电视" selected>电视</option><option value="杂志">杂志</option><option value="其他">其他</option>';
					break;
				case "杂志":
					listInfo += '<option value="网络">网络</option><option value="电视">电视</option><option value="杂志" selected>杂志</option><option value="其他">其他</option>';
					break;
				default:
					listInfo += '<option value="网络" selected>网络</option><option value="电视">电视</option><option value="杂志">杂志</option><option selected value="其他">其他</option>';
					break;
			}
			listInfo += '</select></td><td><input type="hidden" id="fl_'+i+'" value="'+data.list[i]['mtfl']+'"><select class="dfinput fl_'+i+'" id="fl_'+data.list[i]['mediaid']+'" style="width:100px"></select></td>'
						+'<td><input name="" id="phone_'+data.list[i]['mediaid']+'" value="'+data.list[i]['phone']+'" type="text" class="dfinput" style="width:400px" /></td>'
						+'<td><input name="" id="px_'+data.list[i]['meidaid']+'" value="'+data.list[i]['xh']+'" type="text" class="dfinput" style="width:80px" /></td>';
			if(data.list[i]['display'] == "隐藏"){
				listInfo += '<td><input type="radio" value="显示" name="dis_'+data.list[i]['mediaid']+'" /><font color="#FF0000">在用</font><input checked type="radio" value="隐藏" name="dis_'+data.list[i]['mediaid']+'" /><font>隐藏</font></td>';
			}else{
				listInfo += '<td><input checked type="radio" value="显示" name="dis_'+data.list[i]['mediaid']+'" /><font color="#FF0000">在用</font><input type="radio" value="隐藏" name="dis_'+data.list[i]['mediaid']+'" /><font>隐藏</font></td>';
			}
			listInfo += '<td><img src="public/img/save.png" title="保存" border="0" style="width:8%;cursor:pointer" onclick="updateMedia('+"'"+data.list[i]['mediaid']+"'"+')">'
						+'<img src="public/img/del.png" title="点击删除" border="0" style="width:8%;cursor:pointer" onclick="deleteMedia('+"'"+data.list[i]['mediaid']+"'"+')"></td></tr>';
			
			//第二行
			if(i < length - 1){
				listInfo += '<tr class="complex"><td>'+(i + 2)+'</td><td>'+data.list[i+1]['mediaid']+'</td>'
							+'<td><input name="" id="name_'+data.list[i+1]['mediaid']+'" value="'+data.list[i+1]['mediatext']+'" type="text" class="dfinput" style="width:100px" /></td>'
							+'<td><select class="dfinput" id="type_'+data.list[i+1]['mediaid']+'" style="width:100px">';
			switch(data.list[i+1]['type']){
				case "网络":
					listInfo += '<option value="网络" selected>网络</option><option value="电视">电视</option><option value="杂志">杂志</option><option value="其他">其他</option>';
					break;
				case "电视":
					listInfo += '<option value="网络">网络</option><option value="电视" selected>电视</option><option value="杂志">杂志</option><option value="其他">其他</option>';
					break;
				case "杂志":
					listInfo += '<option value="网络">网络</option><option value="电视">电视</option><option value="杂志" selected>杂志</option><option value="其他">其他</option>';
					break;
				default:
					listInfo += '<option value="网络" selected>网络</option><option value="电视">电视</option><option value="杂志">杂志</option><option selected value="其他">其他</option>';
					break;
			}
			listInfo += '</select></td><td><input type="hidden" id="fl_'+i+'" value="'+data.list[i+1]['mtfl']+'"><select class="dfinput fl_'+i+'" id="fl_'+data.list[i+1]['mediaid']+'" style="width:100px"></select></td>'
						+'<td><input name="" id="phone_'+data.list[i+1]['mediaid']+'" value="'+data.list[i+1]['phone']+'" type="text" class="dfinput" style="width:400px" /></td>'
						+'<td><input name="" id="px_'+data.list[i+1]['meidaid']+'" value="'+data.list[i+1]['xh']+'" type="text" class="dfinput" style="width:80px" /></td>';
			if(data.list[i+1]['display'] == "隐藏"){
				listInfo += '<td><input type="radio" value="显示" name="dis_'+data.list[i+1]['mediaid']+'" /><font color="#FF0000">在用</font><input checked type="radio" value="隐藏" name="dis_'+data.list[i+1]['mediaid']+'" /><font>隐藏</font></td>';
			}else{
				listInfo += '<td><input checked type="radio" value="显示" name="dis_'+data.list[i+1]['mediaid']+'" /><font color="#FF0000">在用</font><input type="radio" value="隐藏" name="dis_'+data.list[i+1]['mediaid']+'" /><font>隐藏</font></td>';
			}
			listInfo += '<td><img src="public/img/save.png" title="保存" border="0" style="width:8%;cursor:pointer" onclick="updateMedia('+"'"+data.list[i+1]['mediaid']+"'"+')">'
						+'<img src="public/img/del.png" title="点击删除" border="0" style="width:8%;cursor:pointer" onclick="deleteMedia('+"'"+data.list[i+1]['mediaid']+"'"+')"></td></tr>';
			}
			$("#mediaTable").append(listInfo);
		}
		var foot = '<tr><td>'+(length + 1)+'</td><td></td>'
					+'<td><input name="" id="newname" type="text" class="dfinput" style="width:100px" /></td>'
					+'<td><select class="dfinput" id="newtype" style="width:100px"><option value="网络">网络</option><option value="电视">电视</option><option value="杂志">杂志</option><option value="其他">其他</option></select></td>'
					+'<td><select class="dfinput" id="newfl" style="width:100px"></select></td>'
					+'<td><input name="" id="newphone" type="text" class="dfinput" style="width:400px" /></td>'
					+'<td><input name="" id="newpx" value="0" type="text" class="dfinput" style="width:80px" /></td>'
					+'<td><input type="radio" name="dis" value="显示" checked /><font color="#FF0000">在用</font><input type="radio" value="隐藏" name="dis" /><font>隐藏</font></td>'
					+'<td><input name="" type="button" class="btn" style="width:70px" onclick="addMedia()" value="添加"/></td></tr>';
		$("#mediaTable").append(foot);

		getKhyx(length);
	}
}

//获取客户意向
function getKhyx(num){
	$.post("index.php?r=xtsz/GetKhyx",function(data){
		if(data.result == "success"){
			var length = data.list.length;
			for(var i = 0; i < length; i ++){
				var listInfo = '<option value="'+data.list[i]['valuetype1']+'">'+data.list[i]['valuetype1']+'</option>';
				$("#newfl").append(listInfo);
				for(var j = 0; j < num; j ++){
					if($("#fl_"+j).val() == data.list[i]['valuetype1']){
						listInfo = '<option selected value="'+data.list[i]['valuetype1']+'">'+data.list[i]['valuetype1']+'</option>';
					}
					$(".fl_"+j).append(listInfo);
				}
			}
		}
	},"json");
}

//添加媒体资料
function addMedia(){
	var newname = $("#newname").val();
	var newtype = $("#newtype").val();
	var newfl = $("#newfl").val();
	var newphone = $("#newphone").val();
	var newpx = $("#newpx").val();
	var newdisplay = $("input[name='dis']:checked").val();
	if(newname == ""){
		alert("媒体来源不能为空！");
	}else{
		$.post("index.php?r=mtgl/AddMedia",{newname:newname,newtype:newtype,newfl:newfl,newphone:newphone,newpx:newpx,newdisplay:newdisplay},function(data){
			if(data){
				alert("添加成功");
				getTable(data);
			}
		},"json");
	}
}

//修改媒体资料
function updateMedia(id){
	var updatename = $("#name_"+id).val();
	var updatetype = $("#type_"+id).val();
	var updatefl = $("#fl_"+id).val();
	var updatephone = $("#phone_"+id).val();
	var updatepx = $("#px_"+id).val();
	var updatedisplay = $("input[name='dis_"+id+"']:checked").val();
	if(name == ""){
		alert("媒体来源不能为空！");
	}else{
		$.post("index.php?r=mtgl/UpdateMedia",{id:id,updatename:updatename,updatetype:updatetype,updatefl:updatefl,updatephone:updatephone,updatepx:updatepx,updatedisplay:updatedisplay},function(data){
			alert(data.msg);
			if(data.res == 'success'){
				window.location.href = 'index.php?r=mtgl/GetMtqdglHtml';
			}
		},"json");
	}
}

//删除媒体资料
function deleteMedia(id){
	var con = confirm("真的确认删除？");
	if(con){
		$.post("index.php?r=mtgl/DeleteMedia",{id:id},function(data){
			alert(data.msg);
			if(data.res == 'success'){
				window.location.href = 'index.php?r=mtgl/GetMtqdglHtml';
			}
		},"json");
	}
}


//查询媒体资料
function getMedia(){
	var type = $("#type").val();
	var display = $("#display").val();
	var mediatext = $("#keyword").val();
	$.post("index.php?r=mtgl/GetMediaByCond",{type:type,display:display,mediatext:mediatext},function(data){
		getTable(data);
	},"json");
}