$(function(){
	$.post("index.php?r=xtsz/GetDept",function(data){
		if(data){
			var length = data.length;
			for(var i = 0; i < length; i ++){
				var option = "";
				option = '<option value="'+ data[i]['depttext'] +'">'+ data[i]['depttext'] +'</option>';
				$('#department').append(option);
				
			}
		}
	},"json");

	$.post("index.php?r=xtsz/GetGroupRight",function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i ++){
				var option = "";
				option = '<option value="'+ data.list[i]['groupname'] +'">'+ data.list[i]['groupname'] +'</option>';
				$('#role').append(option);
			}
		}
	},"json");
});

//添加联系人
function addUser(){
	var name = $("#name").val();
	var sex = $("input[name='sex']:checked").val();
	var phone = $("#phone").val();
	var fenji = $("#fenji").val();
	var department = $("#department").val();
	var role = $("#role").val();
	var telephone = $("#telephone").val();
	var otherphone = $("#otherphone").val();
	var faxnumber = $("#faxnumber").val();
	var email = $("#email").val();
	var address = $("#address").val();
	var bz = $("#bz").val();
	if(checkName() && checkPhone() && checkDept() && checkTelephone()){
		if(confirm("真的确认提交吗？")){
			$.post("index.php?r=xtsz/AddUser",{name:name,sex:sex,phone:phone,fenji:fenji,department:department,role:role,telephone:telephone,otherphone:otherphone,faxnumber:faxnumber,email:email,address:address,bz:bz},function(data){
				alert(data.mes);
				if(data.res == "success"){
				//	parent.location.href = "index.php?r=xtsz/GetTxlHtml";
					parentDialog.close();
				}
			},"json");
		}
	}
}

//检验姓名
function checkName(){
	var name = "";
	name = $("#name").val();
	if(name == ""){
		alert("姓名不能为空！");
		return false;
	}
	return true;
}

//检验手机
function checkTelephone(){
	var telephone = $("#telephone").val();
	if(telephone == ""){
		alert("手机不能为空！");
		return false;
	}
	return true;
}

//验证至少有一个电话信息
function checkPhone(str){
	var phone = "";
	var telephone = "";
	var otherphone = "";
	phone = $("#phone").val();
	telephone = $("#telephone").val();
	otherphone = $("#otherphone").val();
	if(phone == "" && telephone == "" && otherphone == ""){
		alert("至少填写一个号码！");
		return false;
	}
	return true;
}

//验证部门
function checkDept(){
	if($("#department").val() == 0){
		alert("必须选择一个部门！");
		return false;
	}
	return true;
}