function updatePwd(){
	var allCheck =  oldpwdCheck() && newpwdCheck() && conpwdCheck();
	var oldpwd = $("#oldpwd").val();
	var newpwd = $("#newpwd").val();

	
	if(allCheck){
		var con = confirm("确认提交吗？");
		if(con){
			$.post('index.php?r=xtsz/ChangePwd',{oldpwd:oldpwd,newpwd:newpwd},function(data){
				alert(data.mes);
				if(data.res == "success"){
					window.location.href="index.php?r=xtsz/GetXgmmHtml";
				}
			});
		}
	}
}

function oldpwdCheck(){
	var oldpwd = $("#oldpwd").val();
	if(oldpwd == ""){
		$("#oldpwdfont").attr("color","red");
		$("#oldpwdfont").html("请输入原始密码！");
		return false;
	}else{
		$("#oldpwdfont").attr("color","#797979");
		$("#oldpwdfont").html("");
		return true;
	}
}

function newpwdCheck(){
	var newpwd = $("#newpwd").val();
	if(newpwd == ""){
		$("#newpwdfont").attr("color","red");
		$("#newpwdfont").html("请输入新密码！");
		return false;
	}else if(newpwd.length < 6){
		$("#newpwdfont").attr("color","red");
		$("#newpwdfont").html("新密码的长度在6到12之间！");
		return false;
	}else{
		$("#newpwdfont").attr("color","#797979");
		$("#newpwdfont").html("");
		return true;
	}
}

function conpwdCheck(){
	var newpwd = $("#newpwd").val();
	var conpwd = $("#conpwd").val();
	if(conpwd == ""){
		$("#conpwdfont").attr("color","red");
		$("#conpwdfont").html("请再次输入新密码！");
		return false;
	}else if(conpwd != newpwd){
		$("#conpwdfont").attr("color","red");
		$("#conpwdfont").html("两次输入的密码不一致！");
		return false;
	}else{
		$("#conpwdfont").attr("color","#797979");
		$("#conpwdfont").html("");
		return true;
	}
}