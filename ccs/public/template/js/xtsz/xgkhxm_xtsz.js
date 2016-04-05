$(function(){
	var type = $("#type").val();
	if(type == 'F'){
		$("#no").attr("selected","selected");
	}else if(type == 'T'){
		$("#yes").attr("selected","selected");
	}
});


function updateXm(){
	var id = $("#id").val();
	var khxm = $("#khxm").val();
	var type = $("#newtype").val();
	var score = $("#score").val();
	if(khxmCheck() && scoreCheck()){
		if(confirm("真的确认提交吗？")){
			$.post("index.php?r=xtsz/UpdateXm",{id:id,khxm:khxm,type:type,score:score},function(data){
				if(data.res == "success"){
					alert(data.mes);
					window.location.href="index.php?r=xtsz/GetTjkhxmHtml";
				}else{
					alert(data.mes);
				}
			},"json");
		}
	}else{
		alert("请根据提示正确填写信息");
	}
}

//考核项目验证
function khxmCheck(){
	var khxm = $("#khxm").val();
	if(khxm == ""){
		$("#khxmfont").attr("color","#FF0000");
		$("#khxmfont").html("请输入项目名称");
		return false;
	}else{
		$("#khxmfont").attr("color","#00FF00");
		$("#khxmfont").html("√");
		return true;
	}
}

//分数验证
function scoreCheck(){
	var type = $("#newtype").val();
	var score = $("#score").val();
	if(score == ""){
		$("#scorefont").html("请输入分数");
		$("#scorefont").attr("color","#FF0000");
		return false;
	}
	if(isNaN(score)){
		$("#scorefont").html("分数必须为数字");
		$("#scorefont").attr("color","#FF0000");
		return false;
	}
	if(type == "F" && score > 0){
		$("#scorefont").html("分数与类型不相符，请输入小于零的数字");
		$("#scorefont").attr("color","#FF0000");
		return false;
	}
	if(type == "T" && score < 0){
		$("#scorefont").html("分数与类型不相符，请输入大于零的数字");
		$("#scorefont").attr("color","#FF0000");
		return false;
	}
	$("#scorefont").html("√");
	$("#scorefont").attr("color","#00FF00");
	return true;
}

