$(function(){
	$.post("index.php?r=zsk/GetZsfl",function(data){
		if(data){
			var length = data.length;
			for(var i = 0; i < length; i ++){
				var spaceStr = '';
				if(data[i]['level'] > 0){
					for(var s = 0; s < data[i]['level']; s ++){
						spaceStr += "&nbsp;&nbsp;";
					}
					spaceStr += "┖";
				}
				$("#zsktype").append('<option value="'+ data[i]['typename'] +'">'+ spaceStr + data[i]['typename'] +'</option>');
			}
		}
	},"json");
});

//检查是否选中类型
function checkType(){
	var type = $("#zsktype").val();
	if(type == 0){
		$("#typeFont").html("必须要选中一个分类");
		$("#typeFont").attr("color","#FF0000");
		return false;
	}
		$("#typeFont").html("√");
		$("#typeFont").attr("color","#00FF00");
		return true;
}
//检查标题
function checkTitle(){
	var title = $("#title").val();
	if(title == ""){
		$("#titleFont").html("请输入标题！");
		$("#titleFont").attr("color","#FF0000");
		return false;
	}
		$("#titleFont").html("√");
		$("#titleFont").attr("color","#00FF00");
		return true;
}

//检查内容
function checkText(){
	var text = $("#text").val();
	if(text == ""){
		$("#textFont").html("请输入内容！");
		$("#textFont").attr("color","#FF0000");
		return false;
	}else{
		$("#textFont").html("√");
		$("#textFont").attr("color","#00FF00");
		return true;
	}
}


function checkValue(){
	if(checkType() && checkTitle() && checkText()){
		if(confirm("真的确认提交吗？")){
			return true;
		}else{
			return false;
		}
	}else{
		alert("请根据提示正确填写信息");
		return false;
	}
}