function checkValue(){
	var checkAll = checkTitle() && checkType() && checkContent();
	var con = false;
	if(checkAll){
		con = confirm("真的确认提交吗？");
	}
	return checkAll && con;
	
}

function checkTitle(){
	var title = $("#title").val();
	if(title == ""){
		$("#titleFont").html("请输入标题！");
		$("#titleFont").attr("color","#FF0000");
		return false;
	}else{
		$("#titleFont").html("√");
		$("#titleFont").attr("color","green");
		return true;
	}
}

function checkType(){
	var type = $("#anntype").val();
	if(type == 0){
		$("#typeFont").html("请选择类型！");
		$("#typeFont").attr("color","#FF0000");
		return false;
	}else{
		$("#typeFont").html("√");
		$("#typeFont").attr("color","green");
		return true;
	}
}

function checkContent(){
	var content = $("#content").val();
	if(content == ""){
		$("#contFont").html("请输入内容！");
		$("#contFont").attr("color","#FF0000");
		return false;
	}else{
		$("#contFont").html("√");
		$("#contFont").attr("color","green");
		return true;
	}
}

