$(function(){
	var gysid = $("#gysid").val();
	$('option').each(function(){
		if($(this).val() == gysid){
			$(this).attr("selected","selected");
		}
	});
});


function updateCgd(){
	var id = $("#id").val();
	var gysStr = $("#gys").val().split(":");
	var gys = gysStr[1];
	var gysID = gysStr[0];
	var cgyf = $("#cgyf").val();
	var dhsj = $("#dhsj").val();
	if(!dhsj){
		alert("到货时间不能为空！");
	}else{
		var con = confirm("真的确认提交吗？");
		if(con){
			
			$.post("index.php?r=cggl/UpdateSomeCgd",{id:id,gys:gys,gysID:gysID,cgyf:cgyf,dhsj:dhsj},function(data){
				if(data){
					 window.location.href="index.php?r=cggl/GetCgdlbHtml";
				}else{
					alert("出现异常，请检查是否修改成功");
				}
			},"json");
		}
	}
}

