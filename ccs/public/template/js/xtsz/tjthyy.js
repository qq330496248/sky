$(function(){
	var parent = $("#parentID").val();
	$("#parent option").each(function(){
		if($(this).val() == parent){
			$(this).attr('selected','selected');
		}
	});
});

//退货原因不为空
function checkName(){
	var thyy = $("#thyy").val();
	if(!thyy || thyy.length > 10){
		$("#yyfont").html("退货原因不为空，且在10个汉字以内");
		$("#yyfont").attr('color','#ff0000');
		return false;
	}
	$("#yyfont").html("√");
	$("#yyfont").attr('color','#00ff00');
	return true;
}


function addThyy(){
	var parent = $("#parent").val();
	var thyy = $("#thyy").val();
	if(checkName()){
		if(confirm('真的确认提交吗？')){
			$.post("index.php?r=xtsz/AddThyy",{parent:parent,thyy:thyy},function(data){
				alert(data.msg);
				if(data.res == 'success'){
					window.location.href = data.http;
				}
			},"json");
		}
	}else{
		alert("请根据提示正确填写信息");
	}
}