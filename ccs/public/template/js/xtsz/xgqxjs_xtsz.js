$(function(){
	$.ajax({
		type:"post",
		url:"index.php?r=xtsz/GetMenu",
		async:false,
		success:function(data){
			if(data.result == 'success'){
				var length = data.list.length;
				for(var i = 0; i < length; i++){
					var listInfo = '<tr>';
					if(i > 0){
						if(data.list[i]['menu_bh'] == ""){
							listInfo += '<th style="text-align:left; text-indent:5px;">'
										+'<input type="checkbox" id="'+ data.list[i]['menu_name'] +'_'+ data.list[i]['menu_name'] + '" name="rightset" value="'+data.list[i]['right_id']+'" onclick="checkAll(this)" /><b style="color:black">'
										+ data.list[i]['illustrate'] +'</b></th>';

						}else{
							listInfo += '<td style="text-align:left; text-indent:20px;">'
										+'<input type="checkbox" id="'+ data.list[i]['menu_bh'] +'" name="rightset" value="'+data.list[i]['right_id']+'" onclick="checkOne(this)" /><b style="color:black">'
										+data.list[i]['illustrate']+'</b></td>';
						}
					}else{
						listInfo += '<th style="text-align:right;" rowspan="'+length+'">权限设置：</th><th style="text-align:left; text-indent:5px;">'
									+'<input type="checkbox" id="'+ data.list[i]['menu_name'] +'_'+ data.list[i]['menu_name'] + '" name="rightset" value="'+data.list[i]['right_id']+'" onclick="checkAll(this)" /><b style="color:black">'
									+ data.list[i]['illustrate'] +'</b></th>';
					}
					listInfo += '</tr>';
					$('#menuTable').append(listInfo);
				}
			}
		},
		dataType:"json"
	});

	var groupbh = $("#groupbh").val();

	$.ajax({
		type:"post",
		url:"index.php?r=xtsz/GetSingleAppRightList",
		data:{groupbh:groupbh},
		async:false,
		success:function(data){
			if(data.result == 'success'){
				var length = data.list.length;
				for(var i = 0; i < length; i++){
					$("input:checkbox").each(function(){
						if(data.list[i]['rightbh'] == $(this).val()){
							$(this).attr("checked","checked");
						}
					});
				}
			}
		},
		dataType:"json"
	});

});

function updateQxjs(){
	var groupbh = $("#groupbh").val();
	var groupname = $("#groupname").val();
	var xdcp = $("#xdcp:checked").val();
	var rightset = $("input[name='rightset']:checked").serialize();
	if(confirm("真的确认提交吗？")){
		if(qxjsCheck() && checkBoxCheck()){
			$.post("index.php?r=xtsz/UpdateGroupRight",{groupbh:groupbh,groupname:groupname,xdcp:xdcp,rightset:rightset},function(data){
				alert(data.msg);
				if(data.res == 'success'){
					window.location.href="index.php?r=xtsz/GetQxjsHtml";
				}
			},"json");
		}
			
	}else{
		alert("请根据提示正确填写信息");
	}	
}

//blur验证
function qxjsCheck(){
	var groupbh = $("#groupbh").val();
	var groupname = $("#groupname").val();
	if(groupname == ""){
		$("#qxjsCheck").html("请输入权限角色名字！");
		$("#qxjsCheck").attr("color","red");
		return false;
	}else if(groupname.length > 10){
		$("#qxjsCheck").html("十个字以内");
		$("#qxjsCheck").attr("color","red");
		return false;
	}else{
		$.post("index.php?r=xtsz/CheckGroupRightExist",{groupname:groupname},function(data){
			if(data.result == "fail" || data.list['groupbh'] == groupbh){
				$("#qxjsCheck").html("√");
				$("#qxjsCheck").attr("color","green");
			}else{
				$("#qxjsCheck").html("权限角色已存在！");
				$("#qxjsCheck").attr("color","red");
			}
		},"json");
			
		return true;
	}
}

//权限设置验证
function checkBoxCheck(){
	var check = 0;
	$("input:checkbox").each(function(){
		if($(this).attr("checked") == "checked"){
			check ++;
		}
	});
	if(check == 0){
		alert("请至少选择一项权限设置！");
		return false;
	}
	return true;
}


//全选，全不选
function checkAll(type){
	var checked = type.checked;
	var id = type.id.split("_")[0];
	
	$("input[name='rightset']").each(function(){
		if($(this).attr("id") == id){
			$(this).attr("checked",checked);
		}
	});
}
//选中父级菜单
function checkOne(type){
	var id = type.id;
	var count = 0;
	
	$("input[name='rightset']").each(function(){
		if($(this).attr("id") == id && $(this).attr("checked") == "checked"){
			count ++;
		}
	});
	$("input[name='rightset']").each(function(){
		
	});
	if(count == 0){
		$("#"+id+"_"+id).attr("checked",false);
	}else{
		$("#"+id+"_"+id).attr("checked","checked");
	}
}