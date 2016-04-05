
function newRylist(){
	var username = $("#username").val();
	var personname = $("#personname").val();
	var pwd = $("#pwd").val();
	var telephone = $("#telephone").val();
	var phone = $("#phone").val();
	var groupbh = $("#groupbh").val().split(":")[0];
	var groupname = $("#groupbh").val().split(":")[1];
	var department = $("#department").val();
	var higherlevel = $("#higherlevel").val();
	var fenji = $("#fenji").val();
	var IPlimit = $("#IPlimit").val();
	var MAClimit = $("#MAClimit").val();
	var managerPower = $("#managerPower").val();
	var ban = $("#ban:checked").val();

	if(usernameCheck() && personnameCheck() && pwdCheck() && conpwdCheck()){
		$.post("index.php?r=xtsz/CheckFenji",{fenji:fenji},function(data){
			if(data.res != "can"){
				$("#newFenjiFont").html("分机号已存在，请检查后再输入");
				$("#newFenjiFont").attr("color","#FF0000");
			}else{
				$.post('index.php?r=xtsz/CheckExist',{username:username},function(data){
					if(data.res != "can"){
						$("#usernameCheck").attr("color","#FF0000");
						$("#usernameCheck").html("工号已存在！");
					}else{
						$.post("index.php?r=xtsz/CheckFenji",{fenji:fenji},function(data){
							if(data.res != "can" && fenji != ""){
								$("#newFenjiFont").html("分机号已存在，请检查后再输入");
								$("#newFenjiFont").attr("color","#FF0000");
							}else{
								if(confirm("真的确认提交吗？")){
									$.post("index.php?r=xtsz/AddRylist",{username:username,personname:personname,pwd:pwd,telephone:telephone,phone:phone,groupbh:groupbh,groupname:groupname,department:department,higherlevel:higherlevel,fenji:fenji,IPlimit:IPlimit,MAClimit:MAClimit,managerPower:managerPower,ban:ban},function(data){
										if(data.res == "success"){
											alert("保存成功！");
											window.location.href="index.php?r=xtsz/GetGhglHtml";
										}else{
											alert("保存失败！");
										}
									},"json");
								}
							}
						},"json");
					}
				},'json');	
			}
		},"json");	
	}else{
		alert("请根据提示正确填写信息！");
	}
}

//blur验证——username
function usernameCheck(){
	var username = $("#username").val();
	if(username == ""){
		$("#usernameCheck").attr("color","#FF0000");
		$("#usernameCheck").html("请输入工号！");
		return false;
	}else{
		$.post('index.php?r=xtsz/CheckExist',{username:username},function(data){
			if(data.res != "can"){
				$("#usernameCheck").attr("color","#FF0000");
				$("#usernameCheck").html("工号已存在！");
			}else{
				//alert('inside:'+con);
				$("#usernameCheck").attr("color","#00FF00");
				$("#usernameCheck").html("√");
			}
		},'json');
		return true;
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
	if(pwd == ""){
		$("#pwdCheck").attr("color","#FF0000");
		$("#pwdCheck").html("请输入密码！");
		return false;
	}else if(pwd.length > 12 || pwd.length < 6){
		$("#pwdCheck").attr("color","#FF0000");
		$("#pwdCheck").html("密码的长度应在6~12之间");
		return false;
	}else{
		$("#pwdCheck").attr("color","#00FF00");
		$("#pwdCheck").html("√");
		return true;
	}
}
//blur验证——conpwd
function conpwdCheck(){
	var pwd = $("#pwd").val();
	var conpwd = $("#conpwd").val();
	if(conpwd == ""){
		$("#conpwdCheck").attr("color","#FF0000");
		$("#conpwdCheck").html("请再次输入密码！");
		return false;
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


function fenjiCheck(){
	var fenji = $("#fenji").val();
	if(fenji != ""){
		$.post("index.php?r=xtsz/CheckFenji",{fenji:fenji},function(data){
			if(data.res != "can"){
				$("#newFenjiFont").html("分机号已存在，请检查后再输入");
				$("#newFenjiFont").attr("color","#00FF00");
			}else{
				$("#newFenjiFont").html("√");
				$("#newFenjiFont").attr("color","#00FF00");
			}
		},"json");
	}
}