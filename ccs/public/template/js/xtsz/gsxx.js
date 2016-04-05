function updateGsxx(){
	var id = $("#id").val();
	var number = $("#number").val();
	var name = $("#name").val();
	var address = $("#address").val();
	var type = $("#type").val();
	var email = $("#mail").val();
	var phone = $("#phone").val();
}


function checkValue(){
	var allCheck = checkName();
	var con = false;
	if(allCheck){
		con = confirm("真的确认提交吗？");
	}
	return allCheck && con;
}


function checkName(){
	var name = $("#name").val();
	if(name == ""){
		alert("公司名称不能为空！");
		return false;
	}else{
		return true;
	}
}