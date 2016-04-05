$(function(){
	var fl = $("#fl").val();
	var zfl = $("#zfl").val();
	var pp = $("#pp").val();
	var sx = $("#sx").val();
	var cpid = $("#cpid").val();
	var gys = $("#gysbh").val();
	var bmbs = $("#bs").val();
	var cx = $("#cpcx").val();
	var ifon = $("#on").val();
	$("input[name='bmbs']").each(function(){
		if($(this).val() == bmbs){
			$(this).attr("checked","checked");
		}
	});
	$("input[name='ifon']").each(function(){
		if($(this).val() == ifon){
			$(this).attr("checked","checked");
		}
	});
	if(cx == "是"){
		$("#cx").attr("checked","checked");
	}
	//产品分类option添加以及选择
	$.ajax({
		type:"post",
		url:"index.php?r=cpgl/GetCpfl",
		async:false,
		success:function(data){
			if(data.result == 'success'){
				var length = data.list.length;
				for(var i = 0; i < length; i++){
					if(data.list[i]['cpab01'] == fl){
						$('#cpfl').append('<option value="'+ data.list[i]['cpab01'] +'" selected>'+ data.list[i]['cpab02'] +'</option>');
					}else{
						$('#cpfl').append('<option value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');
					}
				}
			}
		},
		dataType:"json"
	});
	//产品子分类option添加以及选择
	$.ajax({
		type:"post",
		url:"index.php?r=cpgl/GetCpzfl",
		data:{parent:fl},
		async:false,
		success:function(data){
			if(data.result == 'success'){
				var length = data.list.length;
				for(var i = 0; i < length; i++){
					if(data.list[i]['cpab01'] == zfl){
						$('#cpzfl').append('<option value="'+ data.list[i]['cpab01'] +'" selected>'+ data.list[i]['cpab02'] +'</option>');
					}else{
						$('#cpzfl').append('<option value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');
					}
				}
			}
		},
		dataType:"json"
	});
	//产品品牌option添加以及选择
	$.ajax({
		type:"post",
		url:"index.php?r=cpgl/GetCpppByCond",
		async:false,
		success:function(data){
			if(data.result == 'success'){
				var length = data.list.length;
				for(var i = 0; i < length; i++){
					if(data.list[i]["cpad01"] == pp){
						$('#cppp').append('<option value="'+ data.list[i]['cpad01'] +'" selected>'+ data.list[i]['cpad03'] +'</option>');	
					}else{
						$('#cppp').append('<option value="'+ data.list[i]['cpad01'] +'">'+ data.list[i]['cpad03'] +'</option>');	
					}
				}
			}
		},
		dataType:"json"
	});
	//产品属性option添加以及选择
	$.ajax({
		type:"post",
		url:"index.php?r=cpgl/GetCpsxByCond",
		async:false,
		success:function(data){
			if(data.result == 'success'){
				var length = data.list.length;
				for(var i = 0; i < length; i++){
					if(data.list[i]["cpag01"] == sx){
						$('#cpsx').append('<option value="'+ data.list[i]['cpag01'] +'" selected>'+ data.list[i]['cpag02'] +'</option>');
					}else{
						$('#cpsx').append('<option value="'+ data.list[i]['cpag01'] +'">'+ data.list[i]['cpag02'] +'</option>');
					}
				}	
			}
		},
		dataType:"json"
	});

	var sx = $("#sx").val();
	//获取已经选中的二级菜单下的checkbox，并在页面中选中
	$.ajax({
		type:"post",
		url:"index.php?r=cpgl/GetCpsxxqByCond",
		data:{parent:sx},
		async:false,
		success:function(data){
			if(data.result == 'success'){				
				$('#cpsxTable').empty();
				var length = data.list.length;
				for(var i = 0; i < length; i++){
					listInfo = '';
					listInfo += '<tr><input type="hidden" name="id[]" id="id" value="'+data.list[i]['cpag01']+'" />'
								+'<td style="text-align:right; padding:5px" width="15%">'+data.list[i]['cpag02']+'</td>'
								+'<td style="text-align:left">';
					var str = data.list[i]['cpag04'].split("|");
					for(var a = 0; a < str.length; a ++){
						listInfo += '<input type="checkbox" name="str_'+data.list[i]['cpag01']+'[]" value="'+ str[a] +'" />' + str[a];
					}			
					listInfo += '</td></tr>';

					$('#cpsxTable').append(listInfo);	
				}
			}
		},
		dataType:"json"
	});

	//获取checkbox之后，在页面中选中
	$.ajax({
		type:"post",
		url:"index.php?r=cpgl/GetCpsxxqFromCp",
		data:{cpid:cpid},
		async:false,
		success:function(data){
			if(data.result == 'success'){
				var length = data.list.length;
				for(var i = 0; i < length; i++){
					//分割获取的字符串
					var s = data.list[i]['cpsxxq'].split("_");
					var cpsxxq = s[1].split("|");
					//双for循环判断是否有选中的值
					for(var a = 0; a < cpsxxq.length; a ++){
						$("input:checkbox").each(function(){
							if(cpsxxq[a] == $(this).val()){
								$(this).attr("checked","checked");
							}
						});
					}				
				}
			}
		},
		dataType:"json"
	});

	//产品供应商option添加以及选择
	$.ajax({
		type:"post",
		url:"index.php?r=cggl/GetGys",
		async:false,
		success:function(data){
			if(data.result == 'success'){
				var length = data.list.length;
				for(var i = 0; i < length; i++){
					if(data.list[i]["cgab01"] == gys){
						$('#gys').append('<option value="'+ data.list[i]['cgab01'] +'" selected>'+ data.list[i]['cgab02'] +'</option>');	
					}else{
						$('#gys').append('<option value="'+ data.list[i]['cgab01'] +'">'+ data.list[i]['cgab02'] +'</option>');	
					}
				}
			}
		},
		dataType:"json"
	});
	
	

	//部门标示
	var bmbs = $("#oldBmbs").val();
	var demo1 = bmbs.split(',');
	var length = demo1.length;
	//checkbox按键计数
	var checkCount = 0;
	//被选中的checkbox按键计数
	var checkedCount = 0;
	
	$("input[type='checkbox'][name='bmbs[]']").each(function(){
		checkCount ++;
		for(var i = 0;i < length; i ++){
			if($(this).val() == demo1[i]){
				checkedCount ++;
				$(this).attr('checked','checked');
			}
		}
	});

	//如果全部checkbox都被选中，则选中【共用】
	if(checkCount == checkedCount){
		$("#bmbsAll").attr('checked','checked');
		ifAllSelected();
	}
});


//获取子分类
function getCpzfl(){
	var parent = $("#cpfl").val();

	$.post('index.php?r=cpgl/GetCpzfl',{parent:parent},function(data){
		if(data.result == 'success'){
			$('#cpzfl').empty();
			$('#cpzfl').append('<option value="0">请选择</option>');
			if(parent != 0){
				var length = data.list.length;
				for(var i = 0; i < length; i++){
					$('#cpzfl').append('<option value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');	
				}
			}
		}
	},'json');
}


//获取二级属性的方法
function getCpsxU(){
	var parent = $("#cpsx").val();
	if(parent == 0){
		$('#cpsxTable').empty();
	}else{
		$.post('index.php?r=cpgl/GetCpsxxqByCond',{parent:parent},function(data){
			if(data.result == 'success'){
				$('#cpsxTable').empty();
				var length = data.list.length;
				for(var i = 0; i < length; i++){
					listInfo = '';
					listInfo += '<tr><input type="hidden" name="id[]" id="id" value="'+data.list[i]['cpag01']+'" />'
								+'<td style="text-align:right; padding:5px" width="15%">'+data.list[i]['cpag02']+'</td>'
								+'<td style="text-align:left">';
					var str = data.list[i]['cpag04'].split("|");
					for(var a = 0; a < str.length; a ++){
						listInfo += '<input type="checkbox" name="str_'+data.list[i]['cpag01']+'[]" value="'+ str[a] +'" />' + str[a];
					}			
					listInfo += '</td></tr>';

					$('#cpsxTable').append(listInfo);	
				}
			}
		},'json');
	}
}


//表单提交验证
function checkValue(){
	var allCheck = cpmcCheck() && cpflCheck() && sjppCheck() && xsjCheck();
	var con = false;
	if(allCheck){
		con = confirm("真的确认提交吗？");
	}
	return allCheck && con;
}
//blur验证——产品名称
function cpmcCheck(){
	var cpmc = $("#cpmc").val();
	if(cpmc == ""){
		$("#check").html("请输入产品名称！");
		$("#check").attr("color","red");
		return false;
	}else{
		$("#check").html("");
		return true;
	}
}
//blur验证——产品分类
function cpflCheck(){
	var cpfl = $("#cpfl").val();
	if(cpfl == 0){
		$("#check").html("请选择产品分类！");
		$("#check").attr("color","red");
		return false;
	}else{
		$("#check").html("");
		return true;
	}
}
//blur验证——商家品牌
function sjppCheck(){
	var sjpp = $("#sjpp").val();
	if(sjpp == 0){
		$("#check").html("请选择商家品牌！");
		$("#check").attr("color","red");
		return false;
	}else{
		$("#check").html("");
		return true;
	}
}
//blur验证——销售价
function xsjCheck(){
	var xsj = $("#xsj").val();
	if(xsj == ""){
		$("#check").html("请输入销售价！");
		$("#check").attr("color","red");
		return false;
	}else{
		$("#check").html("");
		return true;
	}
}

//如果选择了共用，其他多选项都不能选
function ifAllSelected(){
	if($("#bmbsAll").attr('checked') == 'checked'){
		$("input[type='checkbox'][name='bmbs[]']").each(function(){
			$(this).attr('disabled','disabled');
		});
	}else{
		$("input[type='checkbox'][name='bmbs[]']").each(function(){
			$(this).removeAttr('disabled');
		});
	}
	
}