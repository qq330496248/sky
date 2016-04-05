function updateCgd(){
	var con = confirm("真的确认提交吗？");
	if(con){
		var id = $("#id").val();
		var count = $("#count").val();
		var cgjhj = $("#cgjhj").val();
		var cgsl = $("#cgsl").val();

		$.post("index.php?r=cggl/UpdateCgd",{id:id,count:count,cgjhj:cgjhj,cgsl:cgsl},function(data){
			if(data){
				alert("修改成功");
				 window.location.href="index.php?r=cggl/GetCgdlbHtml";
			}else{
				alert("修改失败");
			}
		},"json");
	}
}

