$(function(){
	var parent = $("#parentid").val();
	$.post('index.php?r=cpgl/GetCpfl',function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				if(data.list[i]['cpab01'] == parent){
					$('#parent').append('<option selected value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');	
				}else{
					$('#parent').append('<option value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');	
				}
			}
		}
	},'json');
});

function addCpfl(){
	var parent = $("#parent").val();
	var flmc = $("#flmc").val();
	var pysx = $("#pysx").val();
	var flms = $("#flms").val();
	var isPub = $("#isPub:checked").val();
	if(checkFlmc() && checkPysx()){
		if(confirm("真的确认提交吗？")){
			$.post("index.php?r=cpgl/AddCpfl",{parent:parent,flmc:flmc,pysx:pysx,flms:flms,isPub:isPub},function(data){
				if(data.res == "success"){
					alert("添加成功！");
					if(data.type == "fl"){
						window.location.href=data.address;
					}else{
						window.location.href=data.address+"&id="+parent;
					}
				}else{
					alert(data.msg);
				}
			},"json");
		}
	}
}

//分类名称
function checkFlmc(){
	var flmc = $("#flmc").val();
	if(flmc == ""){
		$("#flfont").html("请输入分类名称！");
		$("#flfont").attr("color","#FF0000");
		return false;
	}else if(flmc.length > 10){
		$("#flfont").html("分类名称的长度在10个汉字以内！");
		$("#flfont").attr("color","#FF0000");
		return false;
	}else{
		$("#flfont").html("√");
		$("#flfont").attr("color","green");
		return true;
	}
}
//拼音缩写
function checkPysx(){
	var pysx = $("#pysx").val();
	if(pysx == ""){
		$("#pyfont").html("请输入拼音缩写！");
		$("#pyfont").attr("color","#FF0000");
		return false;
	}else if(pysx.length > 10){
		$("#pyfont").html("拼音缩写的长度在10个汉字以内！");
		$("#pyfont").attr("color","#FF0000");
		return false;
	}else{
		$("#pyfont").html("√");
		$("#pyfont").attr("color","green");
		return true;
	}
}