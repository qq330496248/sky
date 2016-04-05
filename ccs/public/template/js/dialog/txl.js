$(function(){
	$.ajax({
		type:"post",
		url:"index.php?r=xtsz/GetDept",
		async:false,
		success:function(data){
			if(data){
				var length = data.length;
				for(var i = 0; i < length; i ++){
					var option = "";
					option = '<option value="'+ data[i]['depttext'] +'">'+ data[i]['depttext'] +'</option>';
					$('#updateDepartment').append(option);
					$('#addDepartment').append(option);
					$('#dept').append(option);	
					var menu = '<dd><div class="title" style="background:#FFFFFF;height:30px;"><img src="public/template/images/phone.png" style="width:15px;height:15px" />'+ data[i]['depttext'] +'</div><ul class="menuson" style="background:#FFFFFF;color:rgb(64,152,202)" id="'+ data[i]['depttext'] +'"></ul></dd>';
					$("#leftmenu").append(menu);

					var table = '<tr><th colspan="11" style="text-align:left;font-size:13px;">'+ data[i]['depttext'] +'</th></tr>';
					$("#txlTable").append(table);
				}
			}
		},
		dataType:"json"
	});

	$.ajax({
		type:"post",
		url:"index.php?r=xtsz/GetUser",
		async:false,
		success:function(data){
			getTable(data);
		},
		dataType:"json"
	});

	$.post("index.php?r=xtsz/GetGroupRight",function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i ++){
				var option = "";
				option = '<option value="'+ data.list[i]['groupname'] +'">'+ data.list[i]['groupname'] +'</option>';
				$('#updateRole').append(option);
				$('#addRole').append(option);
			}
		}
	},"json");

	$('.title').each(function(){
	    $(this).next('.menuson').hide();
	});

$('.title').click(function(){
	var $ul = $(this).next('ul');
	$('dd').find('.menuson').slideUp();
	if($ul.is(':visible')){
		$(this).next('.menuson').slideUp();
	}else{
		$(this).next('.menuson').slideDown();
	}
});


});

function getTable(data){
	if(data.res == "success"){
		$("#txlTable").empty();
		var length = data.list.length;
		$("#length").val(length);
		for(var i = 0; i < length; i ++){
			/*var listInfo = "<tr>";
			listInfo += '<td><input type="checkbox" id="'+i+'" name="list" value="'+data.list[i]['id']+'" /></td>'
						+'<td ><font onclick="getUser('+data.list[i]['id']+')">'+data.list[i]['personname']+'</font></td>'
						+'<td>'+data.list[i]['sex']+'</td>'
						+'<td>'+data.list[i]['department']+'</td>'
						+'<td>'+data.list[i]['role']+'</td>'
						+'<td>'+data.list[i]['phone']+'('+data.list[i]['fenji']+')'+'</td>'
						+'<td>'+data.list[i]['telephone']+'</td>'
						+'<td>'+data.list[i]['otherphone']+'</td>'
						+'<td>'+data.list[i]['faxnumber']+'</td>'
						+'<td>'+data.list[i]['address']+'</td>'
						+'<td><input id="" onclick="deleteUser('+data.list[i]['id']+')" type="button" class="btn" style="color:#000000; background:#999999" value="删除"/></td>';
			$("#txlTable").append(listInfo);*/
			var divstr = '<li id="personname" style="height:10px"><span></span><font onclick="getUser('
						+ data.list[i]['id'] + ')">' + data.list[i]['personname'] + '</font>&nbsp;手机号码：' + data.list[i]['telephone'] + '&nbsp;&nbsp;&nbsp;<img src="public/img/del.png" title="删除联系人" border="0" style="width:2.5%;cursor:pointer" class="deleteFont" onclick="deleteUser('+data.list[i]['id']+')"></li>';
			$("#"+data.list[i]['department']).append(divstr);

			/*<font class="deleteFont" onclick="deleteUser('+data.list[i]['id']+')">删除联系人</font>*/
		}
	}
}

var httpHost = $('#httpHost').val();  //服务器地址
//开关弹窗
/*function showDiv(str){
	var dialog = new Dialog();
    dialog.Width=650;
    dialog.Height=400;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/Get"+str+"Html";
    dialog.show();
}*/

function showDiv(str){
	$("#"+str).show();
}

function closeDiv(str){
	$("#"+str).hide();
}


//点击关闭发送短息弹框
$('body').on('click','#AddClose',function(){
    $('#AddUser').hide();
});

//检验姓名
function checkName(str){
	if($("#"+str+"Name").val() == ""){
		alert("姓名不能为空！");
		return false;
	}
	return true;
}

//验证部门
function checkDept(str){
	if($("#"+str+"Department").val() == 0){
		alert("必须选择一个部门！");
		return false;
	}
	return true;
}

//验证角色
function checkRole(str){
	if($("#"+str+"Role").val() == 0){
		alert("必须选择一个角色！");
		return false;
	}
	return true;
}

//检验手机
function checkTelephone(str){
	if($("#"+str+"Telephone").val() == ""){
		alert("手机不能为空！");
		return false;
	}
	return true;
}

//验证至少有一个电话信息
function checkPhone(str){
	if($("#"+str+"Phone").val() == "" && $("#"+str+"Telephone").val() == "" && $("#"+str+"Otherphone").val() == ""){
		alert("至少填写一个号码！");
		return false;
	}
	return true;
}

//查找
function selectUser(){
	var department = $("#dept").val();
	var name = $("#keyword").val();
	$.post("index.php?r=xtsz/GetUser",{department:department,name:name},function(data){
		getTable(data);
	},"json");
}
//获取单个联系人
function getUser(id){
	$.post("index.php?r=xtsz/GetSingleUser",{id:id},function(data){
		if(data){
			$("#updateID").val(data['id']);
			$("#updateName").val(data['personname']);
			$("input[name='updateSex']").each(function(){
				if($(this).val() == data['sex']){
					$(this).attr('checked','checked');
				}
			});
			$("#updateDepartment option").each(function(){
				if($(this).val() == data['department']){
					$(this).attr('selected','selected');
				}
			});
			$("#updateRole option").each(function(){
				if($(this).val() == data['role']){
					$(this).attr('selected','selected');
				}
			});
			$("#updatePhone").val(data['phone']);
			$("#updateFenji").val(data['fenji']);
			$("#updateTelephone").val(data['telephone']);
			$("#updateOtherphone").val(data['otherphone']);
			$("#updateFaxnumber").val(data['faxnumber']);
			$("#updateEmail").val(data['email']);
			$("#updateAddress").val(data['address']);
			$("#updateBz").val(data['bz']);
			$("#update").show();
		}
	},"json");
}

//添加联系人
function addUser(){
	var name = $("#addName").val();
	var sex = $("input[name='addSex']:checked").val();
	var phone = $("#addPhone").val();
	var fenji = $("#addFenji").val();
	var telephone = $("#addTelephone").val();
	var otherphone = $("#addOtherphone").val();
	var faxnumber = $("#addFaxnumber").val();
	var email = $("#addEmail").val();
	var address = $("#addAddress").val();
	var department = $("#addDepartment").val();
	var role = $("#addRole").val();
	var bz = $("#addBz").val();
	if(checkName('add') && checkPhone('add') &&  checkTelephone('add') && checkDept('add') && checkRole('add')){
		if(confirm("真的确认提交吗？")){
			$.post("index.php?r=xtsz/AddUser",{name:name,sex:sex,phone:phone,fenji:fenji,department:department,role:role,telephone:telephone,otherphone:otherphone,faxnumber:faxnumber,email:email,address:address,bz:bz},function(data){
				alert(data.mes);
				if(data.res == "success"){
					window.location.href = "index.php?r=dialog/GetTxlHtml";
				}
			},"json");
		}
	}
}


//更新联系人
function updateUser(){
	var id = $("#updateID").val();
	var name = $("#updateName").val();
	var sex = $("input[name='updateSex']:checked").val();
	var phone = $("#updatePhone").val();
	var fenji = $("#updateFenji").val();
	var department = $("#updateDepartment").val();
	var telephone = $("#updateTelephone").val();
	var otherphone = $("#updateOtherphone").val();
	var faxnumber = $("#updateFaxnumber").val();
	var email = $("#updateEmail").val();
	var address = $("#updateAddress").val();
	var bz = $("#updateBz").val();
	if(checkName('update') && checkPhone('update') &&  checkTelephone('update') && checkDept('update') && checkRole('update')){
		if(confirm("真的确认提交吗？")){
			$.post("index.php?r=xtsz/UpdateUser",{id:id,name:name,sex:sex,phone:phone,fenji:fenji,department:department,telephone:telephone,otherphone:otherphone,faxnumber:faxnumber,email:email,address:address,bz:bz},function(data){
				alert(data.mes);
				if(data.res == "success"){
					window.location.href="index.php?r=dialog/GetTxlHtml";
				}
			},"json");
		}
	}
}

//删除联系人
function deleteUser(id){
	if(confirm("真的确认删除吗？")){
		$.post("index.php?r=xtsz/DeleteUser",{id:id},function(data){
			alert(data.mes);
			if(data.res == "success"){
				window.location.href="index.php?r=dialog/GetTxlHtml";
			}
		},"json");
	}
}

//关闭更新
function closeUpdate(){
	$("#UpdateUser").hide();
}


//全选/全不选
function changeAll(all){
	var check = all.checked;
	var length = $("#length").val();
	$("input[name='list']").each(function(){
		$(this).attr("checked",check);
	});
}

//批量删除
function deleteMoreUser(){
	var str = "";
	$("input[name='list']:checked").each(function(){
		str += $(this).val()+",";
	});
	if(confirm("真的确认删除吗？")){
		$.post("index.php?r=xtsz/DeleteMoreUser",{str:str},function(data){
			alert(data.mes);
			if(data.res == "success"){
				window.location.href="index.php?r=dialog/GetTxlHtml";
			}
		},"json");
	}
}