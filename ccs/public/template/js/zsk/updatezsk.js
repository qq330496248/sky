$(function(){
	var oldtype = $("#oldtype").val();
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
				if(data[i]['typename'] == oldtype){
					$("#zsktype").append('<option selected="" value="'+ data[i]['typename'] +'">'+ spaceStr + data[i]['typename'] +'</option>');
				}else{
					$("#zsktype").append('<option value="'+ data[i]['typename'] +'">'+ spaceStr + data[i]['typename'] +'</option>');
				}
				
			}
		}
	},"json");
	var top = $("#oldtop").val();

	$("input[name='iftop']").each(function(){
		if($(this).val() == top){
			$(this).attr("checked","checked");
		}
	});
	var ifprivate = $("#oldprivate").val();
	
	if(ifprivate == "是"){
		$("#ifprivate").attr("checked","checked");
	}

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

//删除附件
function delFile(){
	var file = $("#file").val();
	var id = $("#id").val();
	if(confirm("确认删除附件吗？")){
		$.post("index.php?r=zsk/DeleteAttachment",{file:file,id:id},function(data){
			alert(data.mes);
			if(data.res == 'success'){
				window.location.href = "index.php?r=zsk/GetSingleZsk&id="+id;
			}
		},"json");
	}
}