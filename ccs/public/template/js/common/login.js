/**
 * @desc 进入页面后 焦点在输入框上
 * @author WuJunhua
 * @date 2016-02-26
 */
$(document).ready(function(){
	$('#username').focus();
});

function login(){
	var username = $("#username").val();
	var psd = $("#pwd").val();
	if(!$.trim(username)){
		alert('用户名不能为空！');
		return;
	}
	if(!$.trim(psd)){
		alert('密码不能为空！');
		return;
	}
	$.post("index.php?r=login/Login",{username:username,psd:psd},function(data){
		if(data.res == "success"){
			window.location.href="index.php?r=login/GetIndexHtml";
		}else{
			alert(data.mes);
		}
	});
}

//点击登录按钮，进行登录验证
$('#IbtnEnter').click(function(){
	login();
});

//点击回车，进行登陆验证
$(document).keydown(function(e){
	if(e.keyCode == 13){
		login();
	}
})

