$(function(){
	$.post("index.php?r=cpgl/GetCpfl",function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				$('#gysfl').append('<option value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');	
			}
		}
	},"json");

	/*$.post("index.php?r=cggl/GetCgwy",function(data){
		if(data.res == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				$('#cgwy').append('<option value="'+ data.list[i]['id'] +'-'+ data.list[i]['username'] +':'+ data.list[i]['personname'] +'">'+ data.list[i]['personname'] +'</option>');	
			}
		}
	},"json");

	$.post("index.php?r=cggl/GetCgzy",function(data){
		if(data.res == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				$('#cgzy').append('<option value="'+ data.list[i]['id'] +'-'+ data.list[i]['username'] +':'+ data.list[i]['personname'] +'">'+ data.list[i]['personname'] +'</option>');	
			}
		}
	},"json");*/
});


function checkValue(){
	var allCheck = checkName() && checkAddress() && checkAccount();
	var con = false;
	if(allCheck){
		con = confirm("真的确认提交吗？");
	}

	return allCheck && con;
}

function checkName(){
	var name = $("#name").val();
	if(name == ""){
		$("#nameFont").attr("color","#FF0000");
		$("#nameFont").html("供应商名字不能为空！");
		return false;
	}else{
		var name = $("#name").val();
		$.post("index.php?r=cggl/CheckExist",{name:name},function(data){
			if(data != null){
				$("#nameFont").attr("color","#FF0000");
				$("#nameFont").html("供应商名字已存在！");
				return false;
			}
		},"json");
		$("#nameFont").attr("color","#00FF00");
		$("#nameFont").html("√");
		return true;
	}
}

function checkAddress(){
	var address = $("#address").val();
	if(address == ""){
		$("#addressFont").attr("color","#FF0000");
		$("#addressFont").html("供应商地址不能为空！");
		return false;
	}else{
		$("#addressFont").attr("color","#00FF00");
		$("#addressFont").html("√");
		return true;
	}
}

function checkAccount(){
	var zh = $("#zh").val();
	if(zh == ""){
		$("#zhFont").attr("color","#FF0000");
		$("#zhFont").html("供应商账号不能为空！");
		return false;
	}else{
		$("#zhFont").attr("color","#00FF00");
		$("#zhFont").html("√");
		return true;
	}
}


function addGys(){
	if(checkValue()){
		var name = $("#name").val();
		var address = $("#address").val();
		var type = $("#type:checked").val();
		var zh = $("#zh").val();
		var jkfs = $("#jkfs:checked").val();
		var gysfl = $("#gysfl").val();
		var bz = $("#bz").val();
		var cgwy = $("#cgwy").val();
		$.post("index.php?r=cggl/AddGys",{name:name,address:address,type:type,zh:zh,jkfs:jkfs,gysfl:gysfl,bz:bz,cgwy:cgwy},function(data){
			if(data){
				alert(data.mes);
				if(data.res == 'success'){
					window.location.href = "index.php?r=cggl/GetGyslbHtml";
				}
			}
		},"json");
	}	
}