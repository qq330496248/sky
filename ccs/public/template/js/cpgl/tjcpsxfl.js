
function addCpsx(){
	var cpsx = $("#cpsx").val();
	if(checkCpsx()){
		if(confirm("真的确认提交吗？")){
			$.post("index.php?r=cpgl/AddCpsx",{cpsx:cpsx},function(data){
				if(data.res == "success"){
					alert("添加成功！");
					window.location.href=data.address;
				}else{
					alert(data.msg);
				}
			},"json");
		}
	}else{
		alert("请根据提示正确填写信息");
	}	
}


function checkCpsx(){
	var cpsx = $("#cpsx").val();
	if(cpsx == ""){
		$("#sxfont").html("请输入属性名称！");
		return false;
	}else{
		$("#sxfont").html("");
		return true;
	}
}