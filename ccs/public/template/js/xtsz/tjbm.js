$(function(){
	var higherlevel = $("#higher").val();
	$.post("index.php?r=xtsz/GetDept",function(data){
		if(data){
			var length = data.length;
			for(var i = 0; i < length; i ++){
				var option = "";
				if(data[i]['deptid'] == higherlevel){
					option = '<option selected level="'+ data[i]['level'] +'" value="'+ data[i]['deptid'] +'">'+ data[i]['depttext'] +'</option>';
				}else{
					option = '<option level="'+ data[i]['level'] +'" value="'+ data[i]['deptid'] +'">'+ data[i]['depttext'] +'</option>';
				}
				$('#higherlevel').append(option);	
			}
		}
	},"json");
});

function checkBmmc(){
	var bmmc = $("#bmmc").val();
	if(bmmc == ""){
		$("#bmmcFont").html("部门名称不能为空！");
		$("#bmmcFont").attr("color","#FF0000");
		return false;
	}else{
		$("#bmmcFont").html("√");
		$("#bmmcFont").attr("color","green");
		return true;
	}
}

function addBm(){
	if(checkBmmc()){
		var con = confirm("真的确认提交吗？");
		if(con){
			var level = parseInt($("#higherlevel option:selected").attr("level"))+1;
			var higherlevel = $("#higherlevel option:selected").val();
			var bmmc = $("#bmmc").val();
			var ifmarket = $("#ifmarket:checked").val();
			$.post("index.php?r=xtsz/AddDept",{level:level,higherlevel:higherlevel,bmmc:bmmc,ifmarket:ifmarket},function(data){
				if(data.res == "success"){
					alert("保存成功！");
					window.location.href="index.php?r=xtsz/GetBmglHtml";
				}else{
					alert("异常，请检查是否添加成功并联系管理员");
				}
			},"json");
		}
	}
}