$(function(){
	var pub = $("#pub").val();
	$("#isPub").each(function(){
		if($(this).val() == pub){
			$(this).attr("checked","checked");
		}
	});
});
function updateCppp(){
	var id = $("#id").val();
	var ppmc = $("#ppmc").val();
	var pysx = $("#pysx").val();
	var ppms = $("#ppms").val();
	var px = $("#px").val();
	var isPub = $("#isPub:checked").val();
	if(checkPpmc() && checkPysx() && checkPpms()){
		if(confirm("真的确认提交吗？")){
			$.post("index.php?r=cpgl/UpdateCppp",{id:id,ppmc:ppmc,pysx:pysx,px:px,isPub:isPub},function(data){
				alert(data.msg);
				if(data.res == "success"){
					window.location.href="index.php?r=cpgl/GetCpppHtml";
				}
			},"json");
		}
	}else{
		alert("请根据提示正确填写信息");
	}
}

function checkPpmc(){
	var ppmc = $("#ppmc").val();
	if(ppmc == ""){
		$("#ppfont").html("请输入品牌名称！");
		$("#ppfont").attr("color","#FF0000");
		return false;
	}else if(ppmc.length > 10){
		$("#ppfont").html("品牌名称要在10个字以内！");
		$("#ppfont").attr("color","#FF0000");
		return false;
	}else{
		$("#ppfont").html("√");
		$("#ppfont").attr("color","green");
		return true;
	}
}

function checkPysx(){
	var pysx = $("#pysx").val();
	if(pysx == ""){
		$("#pyfont").html("请输入拼音缩写！");
		$("#pyfont").attr("color","#FF0000");
		return false;
	}else if(pysx.length > 10){
		$("#pyfont").html("拼音缩写要在10个字以内！");
		$("#pyfont").attr("color","#FF0000");
		return false;
	}else{
		$("#pyfont").html("√");
		$("#pyfont").attr("color","green");
		return true;
	}
}

function checkPpms(){
	var ppms = $("#ppms").val();
	if(ppms.length > 500){
		$("#msFont").attr("color","#FF0000");
		$("#msFont").html("请控制在500字以内");
		return false;
	}else{
		$("#msFont").attr("color","#00FF00");
		$("#msFont").html("");
		return true;
	}
}