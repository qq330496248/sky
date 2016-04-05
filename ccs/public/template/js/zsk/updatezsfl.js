$(function(){
	var parent = $("#parentid").val();
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
				if(data[i]['id'] == parent){
					$("#parent").append('<option selected value="'+ data[i]['id'] +'" level="' + data[i]['level'] + '">'+ spaceStr + data[i]['typename'] +'</option>');
				}else{
					$("#parent").append('<option value="'+ data[i]['id'] +'" level="' + data[i]['level'] + '">'+ spaceStr + data[i]['typename'] +'</option>');
				}
			}
		}
	},"json");
});

function updateZsfl(){
	var id = $("#id").val();
	var parent = $("#parent").val();
	var flmc = $("#flmc").val();
	var flms = $("#flms").val();
	var opeid = $("#opeid").val();
	var viewid = $("#viewid").val();
	var level = parseInt($("#parent option:selected").attr("level"))+1;
	if(checkFlmc()){
		if(confirm("真的确认提交吗？")){
			$.post("index.php?r=zsk/UpdateZsfl",{id:id,parent:parent,flmc:flmc,flms:flms,opeid:opeid,viewid:viewid,level:level},function(data){
				if(data.res == "success"){
					alert(data.mes);
					window.location.href = "index.php?r=zsk/GetZsflHtml";
				}else{
					alert(data.mes);
				}
			},"json");
		}
	}
}

function checkFlmc(){
	var flmc = $("#flmc").val();
	if(flmc == ""){
		$("#flfont").html("分类名称不能为空！");
		$("#flfont").attr("color","#FF0000");
		return false;
	}else if(flmc.length > 10){
		$("#flfont").html("分类名称长度不可超过10！");
		$("#flfont").attr("color","#FF0000");
		return false;
	}
	$("#flfont").html("√");
	$("#flfont").attr("color","#00FF00");
	return true;
}