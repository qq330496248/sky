$(function(){
	$.post('index.php?r=cpgl/GetCpfl',function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				$('#cpfl').append('<option value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');	
			}
		}
	},'json');
	$.post('index.php?r=cpgl/GetCpppByCond',function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				$('#sjpp').append('<option value="'+ data.list[i]['cpad03'] +'">'+ data.list[i]['cpad03'] +'</option>');	
			}
		}
	},'json');
	$.post('index.php?r=cpgl/GetCpsxByCond',function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				$('#cpsx').append('<option value="'+ data.list[i]['cpag01'] +'">'+ data.list[i]['cpag02'] +'</option>');	
			}
		}
	},'json');
	$.post('index.php?r=cggl/GetGys',function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				$('#gys').append('<option value="'+ data.list[i]['cgab01'] +'">'+ data.list[i]['cgab02'] +'</option>');	
			}
		}
	},'json');

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

//添加
function addCp(){
	var image = $("#image").val();
	$('#image').uploadify({
		'auto': true, //打开自动上传
		'removeTimeout': 0, //文件队列上传完成1秒后删除
		'width':80,
		'height':25,
		'swf': 'public/template/swf/uploadify.swf', 
		'uploader': '?r=cpgl/Upload', //
		'method': 'post', //方法，服务端可以用$_POST数组获取数据
		'buttonText': '选择图片', //设置按钮文本
		'multi': true, //允许同时上传多张图片
		'uploadLimit':  5, //一次最多只允许上传5张图片
		'fileTypeDesc': 'Image Files', //只允许上传图像
		'fileTypeExts': '*.gif;*.jpg;*.png;*.jpeg', //限制允许上传的图片后缀
		'fileSizeLimit': '4MB', //限制上传的图片不得超过4M 
		'onUploadSuccess': function(file, data, response) { //每次成功上传后执行的回调函数，从服务端返回数据到前端
			
		},
		'onQueueComplete': function(queueData) { //上传队列全部完成后执行的回调函数
		}
	});
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
//获取二级属性的方法
function getCpsx(){
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