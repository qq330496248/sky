$(function(){
	var parent = $("#parentid").val();
	$.post("index.php?r=xtsz/GetDept",function(data){
		if(data){
			var length = data.length;
			for(var i = 0; i < length; i ++){
				var option = "";
				if(data[i]['deptid'] == parent){

					option = '<option selected level="'+ data[i]['level'] +'" value="'+ data[i]['deptid'] +'">'+ data[i]['depttext'] +'</option>';
				}else{
					option = '<option level="'+ data[i]['level'] +'" value="'+ data[i]['deptid'] +'">'+ data[i]['depttext'] +'</option>';
				}
				$('#higherlevel').append(option);	
			}
		}
	},"json");

	var ismarket = $("#ismarket").val();
	$("input:radio[name='ifmarket']").each(function(){
		if($(this).val() == ismarket){
			$(this).attr("checked","checked");
		}
	})
});

function updateDept(){
	var id = $("#deptid").val();
	var depttext = $("#depttext").val();
	var ifmarket = $("#ifmarket:checked").val();
	var higherlevel = $("#higherlevel").val();
	var level = parseInt($("#higherlevel option:selected").attr("level"))+1;
	$.post("index.php?r=xtsz/updateDept",{id:id,depttext:depttext,ifmarket:ifmarket,higherlevel:higherlevel,level:level},function(data){
		if(data.res == "success"){
			alert(data.mes);
			window.location.href="index.php?r=xtsz/GetBmglHtml";
		}else{
			alert(data.mes);
		}
	},"json");
}

//部门名称不能为空
function checkBmmc(){
	var bmmc = $("#bmmc").val();
	if(bmmc == ""){
		$("#bmmcFont").html("部门名称不能为空！");
		$("#bmmcFomt").attr("color","#FF0000");
		return false;
	}else{
		$("#bmmcFont").html("√");
		$("#bmmcFont").attr("color","#00FF00");
		return true;
	}
}

//上级部门不能为自身
function checkHigherLevel(){
	var parent = $("#higherlevel").val();
	var self = $("#deptid").val();
	if(parent == self){
		alert("上级部门不可选择自身！");
		return false;
	}else{
		return true;
	}
}