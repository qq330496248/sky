$(function(){
	var id = $("#parent").val();
	$.post('index.php?r=cpgl/GetCpsxByCond',function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				if(data.list[i]['cpag01'] == id){
					$('#pid').append('<option value="'+ data.list[i]['cpag01'] +'" selected>'+ data.list[i]['cpag02'] +'</option>');
				}else{
					$('#pid').append('<option value="'+ data.list[i]['cpag01'] +'">'+ data.list[i]['cpag02'] +'</option>');
				}
			}
		}
	},'json');
});

function addCpsxxq(){
	var pid = $("#pid").val();
	var cpsx = $("#cpsx").val();
	var str = $("#str").val();
	if(checkCpsx() && checkStr()){
		if(confirm("真的确认提交吗？")){
			$.post("index.php?r=cpgl/AddCpsx",{pid:pid,cpsx:cpsx,str:str},function(data){
				if(data.res == "success"){
					alert("添加成功！");
					window.location.href=data.address;
				}else{
					alert(data.msg);
				}
			},"json");
		}
	}else{
		alert("请根据提示正确填写信息");
	}
}

function checkCpsx(){
	var cpsx = $("#cpsx").val();
	if(cpsx == ""){
		$("#sxfont").html("请输入属性名称！");
		return false;
	}else{
		$("#sxfont").html("√");
		$("#sxfont").attr("color","green");
		return true;
	}
}

function checkStr(){
	var str = $("#str").val();
	if(str == ""){
		$("#strfont").html("请输入属性值！");
		return false;
	}else{
		$("#strfont").html("√");
		$("#strfont").attr("color","green");
		return true;
	}
}

