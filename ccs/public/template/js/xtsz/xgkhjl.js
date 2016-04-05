$(function(){
	var xmid = $("#xmid").val();
	var ryid = $("#ry").val();
	$.post('index.php?r=xtsz/GetAllXm',function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				if(data.list[i]['id'] == xmid){
					$('#khxm').append('<option selected value="'+ data.list[i]['id'] +'">'+ data.list[i]['khxm'] +'('+ data.list[i]['score'] +'分)</option>');	
				}else{
					$('#khxm').append('<option value="'+ data.list[i]['id'] +'">'+ data.list[i]['khxm'] +'('+ data.list[i]['score'] +'分)</option>');	
				}
			}
		}
	},'json');
	$.post('index.php?r=xtsz/GetRylistForSelect',function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				if(data.list[i]['id'] == ryid){
					$('#ryid').append('<option selected value="'+ data.list[i]['id'] +'">'+ data.list[i]['username'] +':'+ data.list[i]['personname'] +'</option>');	
				}else{
					$('#ryid').append('<option value="'+ data.list[i]['id'] +'">'+ data.list[i]['username'] +':'+ data.list[i]['personname'] +'</option>');	
				}	
			}
		}
	},'json');
	
});

//修改考核记录
function updateJl(){
	var id = $("#id").val();
	var khxm = $("#khxm").val();
	var ryid = $("#ryid").val();
	var bz = $("#bz").val();
	var khdate = $("#khdate").val();
	if(checkXm() && checkGh() && checkKhdate()){
		if(confirm("真的确认提交吗？")){
			$.post("index.php?r=xtsz/UpdateKhjl",{id:id,khxm:khxm,ryid:ryid,khdate:khdate,bz:bz},function(data){
				if(data.res == "success"){
					alert(data.mes);
					window.location.href="index.php?r=xtsz/GetYgkhHtml";
				}else{
					alert(data.mes);
				}
			},"json");
		}
	}else{
		alert("请根据提示正确填写信息");
	}
}



//考核项目验证
function checkXm(){
	var xmid = $("#khxm").val();
	if(xmid == 0){
		$("#xmfont").html("请选择考核项目！");
		$("#xmfont").attr("color","#FF0000");
		return false;
	}else{
		$("#xmfont").html("");
		$("#xmfont").attr("color","#00FF00");
		return true;
	}
}

//工号验证
function checkGh(){
	var ryid = $("#ryid").val();
	if(ryid == 0){
		$("#ghfont").html("请选择员工工号！");
		$("#ghfont").attr("color","#FF0000");
		return false;
	}else{
		$("#ghfont").html("");
		$("#ghfont").attr("color","#00FF00");
		return true;
	}
}

//考核日期验证
function checkKhdate(){
	var khdate = $("#khdate").val();
	if(khdate == ""){
		$("#khdatefont").html("请输入考核时间！");
		$("#khdatefont").attr("color","#FF0000");
		return false;
	}else{
		$("#khdatefont").html("");
		$("#khdatefont").attr("color","#00FF00");
		return true;
	}
}