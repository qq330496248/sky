$(function(){
	$.post("index.php?r=cpgl/GetCp",function(data){
		if(data.result == 'success'){
			$("#select1_left").empty();
			var length = data.list.length;
			for(var i = 0; i < length; i ++){
				var option = '<option value="'+ data.list[i]['cpaa01'] +'">'+ data.list[i]['cpaa02'] +'</option>';
				$("#select1_left").append(option);
			}
		}
	},"json");
	$.post("index.php?r=cpgl/GetCpfl",function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i ++){
				var option = '<option value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>';
				$("#cpfl").append(option);
			}
		}
	},"json");
	$.post("index.php?r=cpgl/GetCpppByCond",function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i ++){
				var option = '<option value="'+ data.list[i]['cpad01'] +'">'+ data.list[i]['cpad03'] +'</option>';
				$("#cppp").append(option);
			}
		}
	},"json");
});

//改变产品项
function getCp(){
	var cpfl = $("#cpfl").val();
	var cpzfl = $("#cpzfl").val();
	var cppp = $("#cppp").val();
	var cpid = $("#cpid").val();
	var cpmc = $("#cpmc").val();
	$.post("index.php?r=cpgl/GetCp",{cpfl:cpfl,cpzfl:cpzfl,cppp:cppp,cpid:cpid,cpmc:cpmc},function(data){
		if(data.result == 'success'){
			$("#select1_left").empty();
			var length = data.list.length;
			for(var i = 0; i < length; i ++){
				var option = '<option value="'+ data.list[i]['cpaa01'] +'">'+ data.list[i]['cpaa02'] +'</option>';
				$("#select1_left").append(option);
			}
		}
	},"json");
}


//获取子分类
function getCpzfl(){
	var parent = $("#cpfl").val();

	$.post('index.php?r=cpgl/GetCpzfl',{parent:parent},function(data){
		if(data.result == 'success'){
			$('#cpzfl').empty();
			$('#cpzfl').append('<option value="0">--</option>');
			if(parent != 0){
				var length = data.list.length;
				for(var i = 0; i < length; i++){
					$('#cpzfl').append('<option value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');	
				}
			}
		}
	},'json');
}


function getSelect(){
	var cp = "";
	$("#select1_right option").each(function(){
		cp += $(this).val() + " ";
	});
	$("#allCp").val(cp);
	var sx = "";
	$("#select2_right option").each(function(){
		sx += $(this).val() + " ";
	});
	$("#allSx").val(sx);
	if(cp == ""){
		alert("至少选择一个商品！");
		return false;
	}
	if(sx == ""){
		alert("至少选择一个属性！");
		return false;
	}
	return true;
}