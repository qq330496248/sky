$(function(){
	var media = $("#oldmedia").val();
	var type = $("#oldtype").val();
	$("#media option").each(function(){
		if($(this).val() == media){
			$(this).attr("selected","selected");
		}
	});
	$("#type option").each(function(){
		if($(this).val() == type){
			$(this).attr("selected","selected");
		}
	});
});


//更新广告
function updateAd(){
 	var id = $("#advertid").val();
 	var media = $("#media").val();
 	var date = $("#date").val();
 	var time = $("#time").val();
 	var duration = $("#duration").val();
 	var cost = $("#cost").val();
 	var type = $("#type").val();
 	if(checkMedia() && checkDate() && checkTime()){
 		if(confirm("真的确认提交吗？")){
 			$.post("index.php?r=mtgl/UpdateAdvert",{id:id,media:media,date:date,time:time,duration:duration,cost:cost,type:type},function(data){
		 		alert(data.msg);
		 		if(data.res == "success"){
		 			window.location.href="index.php?r=mtgl/GetGgtfjhHtml";
		 		}
		 	},"json");
 		}
 	}	
}

//检验媒体
function checkMedia(){
	var media = $("#media").val();
	if(media == "-"){
		$("#mediaFont").html("请选择媒体！");
		$("#mediaFont").attr("color","#FF0000");
		return false;
	}else{
		$("#mediaFont").html("√");
		$("#mediaFont").attr("color","green");
		return true;
	}
}

//日期检验
function checkDate(){
	var date = $("#date").val();
	if(date == ""){
		$("#dateFont").html("请选择日期！");
		$("#dateFont").attr("color","#FF0000");
		return false;
	}else{
		$("#dateFont").html("√");
		$("#dateFont").attr("color","green");
		return true;
	}
}

//检验时间
function checkTime(){
	var time = $("#time").val();
	if(time == ""){
		$("#timeFont").html("请输入时间！");
		$("#timeFont").attr("color","#FF0000");
		return false;
	}else if(isTime(time)){
		$("#timeFont").html("请输入正确的时间！");
		$("#timeFont").attr("color","#FF0000");
		return false;
	}else{
		$("#timeFont").html("√");
		$("#timeFont").attr("color","green");
		return true;
	}
}