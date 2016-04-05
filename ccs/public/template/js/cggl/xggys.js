$(function(){
	var type = $("#typestr").val();
	var jkfs = $("#jkfsstr").val();
	var gysfl = $("#gysflid").val();
	$("input[name='type']").each(function(){
		if($(this).val() == type){
			$(this).attr("checked","checked");
		}
	});
	$("input[name='jkfs']").each(function(){
		if($(this).val() == jkfs){
			$(this).attr("checked","checked");
		}
	});

	$.post("index.php?r=cpgl/GetCpfl",function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				if(data.list[i]['cpab01'] == gysfl){
					$('#gysfl').append('<option selected value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');
				}else{
					$('#gysfl').append('<option value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');
				}	
			}
		}
	},"json");


	var cgwy = $("#oldcgwy").val();
	var cgzy = $("#oldcgzy").val();
	$("#cgwy option").each(function(){
		if($(this).val() == cgwy){
			$(this).attr('selected','selected');
		}
	});

	$("#cgzy option").each(function(){
		if($(this).val() == cgzy){
			$(this).attr('selected','selected');
		}
	});

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
		$("#nameFont").attr("color","#F00");
		$("#nameFont").html("供应商名字不能为空！");
		return false;
	}else{
		$("#nameFont").attr("color","#0F0");
		$("#nameFont").html("√");
		return true;
	}
}

function checkAddress(){
	var address = $("#address").val();
	if(address == ""){
		$("#addressFont").attr("color","#F00");
		$("#addressFont").html("供应商地址不能为空！");
		return false;
	}else{
		$("#addressFont").attr("color","#0F0");
		$("#addressFont").html("√");
		return true;
	}
}

function checkAccount(){
	var zh = $("#zh").val();
	if(zh == ""){
		$("#zhFont").attr("color","#F00");
		$("#zhFont").html("供应商账号不能为空！");
		return false;
	}else{
		$("#zhFont").attr("color","#0F0");
		$("#zhFont").html("√");
		return true;
	}
}


function updateAccount(){
	if(checkValue()){
		var id = $("#id").val();
		var name = $("#name").val();
		var address = $("#address").val();
		var type = $("#type:checked").val();
		var zh = $("#zh").val();
		var jkfs = $("#jkfs:checked").val();
		var gysfl = $("#gysfl").val();
		var bz = $("#bz").val();
		var cgwy = $("#cgwy").val();
		$.post("index.php?r=cggl/UpdateGys",{id:id,name:name,address:address,type:type,zh:zh,jkfs:jkfs,gysfl:gysfl,bz:bz,cgwy:cgwy},function(data){
			if(data){
				if(data.res == 'false'){
					alert(data.mes);
					return ;
				}
				window.location.href = "index.php?r=cggl/GetGyslbHtml";
			}else{
				alert(data.mes);
			}
		},"json");
	}
}