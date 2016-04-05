
function updateCpsx(){
	var id = $("#id").val();
	var cpsx = $("#cpsx").val();
	if(confirm("真的确认提交吗？")){
		$.post("index.php?r=cpgl/UpdateCpsx",{id:id,cpsx:cpsx},function(data){
			alert(data.msg);
			if(data.res == "success"){
				window.location.href="index.php?r=cpgl/GetCpsxHtml";
			}
		},"json");
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