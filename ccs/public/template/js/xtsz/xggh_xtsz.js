$(function(){
	var post = $("#post").val();
	var dept = $("#dept").val();
	var level = $("#level").val();
	var enabled = $("#enabled").val();
	$("#groupbh option").each(function(){
		if($(this).val() == post){
			$(this).attr("selected","selected");
		}
	});
	$("#department option").each(function(){
		if($(this).val() == dept){
			$(this).attr("selected","selected");
		}
	});
	$("#higherlevel option").each(function(){
		if($(this).val() == level){
			$(this).attr("selected","selected");
		}
	});
	$("input[name='ban']").each(function(){
		if($(this).val() == enabled){
			$(this).attr("checked","checked");
		}
	});
});

//更新
function updateRylist(){
	var id = $("#id").val();
	var hqgh= document.getElementById("hqgh").innerText;
	var personname = $("#personname").val();
	var pwd = $("#pwd").val();
	var oldpwd = $("#oldpwd").val();
	var groupbh = $("#groupbh").val().split(":")[0];
	var groupname = $("#groupbh").val().split(":")[1];
	var department = $("#department").val();
	var higherlevel = $("#higherlevel").val();
	var telephone = $("#telephone").val();
	var phone = $("#phone").val();
	var fenji = $("#fenji").val();
	var IPlimit = $("#IPlimit").val();
	var MAClimit = $("#MAClimit").val();
	var ban = $("#ban:checked").val();

	if(personnameCheck() && pwdCheck() && conpwdCheck()){
		$.post("index.php?r=xtsz/CheckFenji",{fenji:fenji},function(data){
			if(data.res != "can" && id != data.id){
				$("#newFenjiFont").html("分机号已存在，请检查后再输入");
				$("#newFenjiFont").attr("color","#FF0000");
			}else{
				if(confirm("真的确认提交吗？")){
					$.post("index.php?r=xtsz/UpdateRylist",{id:id,personname:personname,pwd:pwd,oldpwd:oldpwd,telephone:telephone,phone:phone,groupbh:groupbh,groupname:groupname,department:department,higherlevel:higherlevel,fenji:fenji,IPlimit:IPlimit,MAClimit:MAClimit,ban:ban,hqgh:hqgh},function(data){
						if(data.res == "success"){
							alert("修改成功！");
							window.location.href = "index.php?r=xtsz/GetGhglHtml";
						}else{
							alert(data.mes);
						}
					},"json");
				}
			}
		},"json");
	}else{
		alert("请根据提示正确填写信息！");
	}
}


//blur验证——personname
function personnameCheck(){
	var personname = $("#personname").val();
	if(personname == ""){
		$("#personnameCheck").attr("color","#FF0000");
		$("#personnameCheck").html("请输入真实姓名！");
		return false;
	}else{
		$("#personnameCheck").attr("color","#00FF00");
		$("#personnameCheck").html("√");
		return true;
	}

}
//blur验证——pwd
function pwdCheck(){
	var pwd = $("#pwd").val();
	if(pwd != ""){
		if(pwd.length > 12 || pwd.length < 6){
			$("#pwdCheck").attr("color","#FF0000");
			$("#pwdCheck").html("密码的长度应在6~12之间");
			return false;
		}else{
			$("#pwdCheck").attr("color","#00FF00");
			$("#pwdCheck").html("√");
			return true;
		}
	}
	return true;
}
//blur验证——conpwd
function conpwdCheck(){
	var pwd = $("#pwd").val();
	var conpwd = $("#conpwd").val();
	if(pwd != "" || conpwd != ""){
		if(conpwd.length > 12 || conpwd.length < 6){
			$("#conpwdCheck").attr("color","#FF0000");
			$("#conpwdCheck").html("密码的长度应在6~12之间");
		}else if(pwd != conpwd){
			$("#conpwdCheck").attr("color","#FF0000");
			$("#conpwdCheck").html("两次输入的密码不一致！");
			return false;
		}else{
			$("#conpwdCheck").attr("color","#00FF00");
			$("#conpwdCheck").html("√");
			return true;
		}
	}
	return true;
}

//上级测试
function higherlevelCheck(){
	var id = $("#id").val();
	var higherlevel = $("#higherlevel").val();
	if(higherlevel == 0){
		$("#levelFont").html("当前添加员工的直属上级，没有可为空。");
		$("#conpwdCheck").attr("color","#797979");
		return true;
	}
	if(higherlevel == id){
		$("#levelFont").html("不可选择自己为上级");
		$("#conpwdCheck").attr("color","#FF0000");
		return false;
	}
	$("#levelFont").html("当前添加员工的直属上级，没有可为空。");
	$("#conpwdCheck").attr("color","#797979");
	return true;
}

//分机检验
function fenjiCheck(){
	var id = $("#id").val();
	var fenji = $("#fenji").val();
	if(fenji != ""){
		$.post("index.php?r=xtsz/CheckFenji",{fenji:fenji},function(data){
			if(data.res != "can" && id != data.id){
				$("#newFenjiFont").html("分机号已存在，请检查后再输入");
				$("#newFenjiFont").attr("color","#FF0000");
			}else{
				$("#newFenjiFont").html("√");
				$("#newFenjiFont").attr("color","#00FF00");
			}
		},"json");
	}
}