
//添加广告
function addAd(){
	var media = $("#media").val();
	var begindate = $("#begindate").val();
	var enddate = $("#enddate").val();
	var time = $("#time").val();
	var duration = $("#duration").val();
	var cost = $("#cost").val();
	var type = $("#type").val();

	if(checkMedia() && checkDate() && checkTime()){
		if(confirm("真的确认提交吗？")){
			$.post("index.php?r=mtgl/AddAdvert",{media:media,begindate:begindate,enddate:enddate,time:time,duration:duration,cost:cost,type:type},function(data){
				alert(data.msg);
				if(data.res == "success"){
					window.location.href="index.php?r=mtgl/GetGgtfjhHtml";
				}
			},"json");
		}
	}else{
		alert("请根据提示正确填写各项信息");
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
	var begindate = $("#begindate").val();
	var enddate = $("#enddate").val();
	if(begindate == ""){
		$("#dateFont").html("请选择日期！");
		$("#dateFont").attr("color","#FF0000");
		return false;
	}else if(enddate == ""){
		$("#dateFont").html("两个日期都不能为空！");
		$("#dateFont").attr("color","#FF0000");
		return false;
	}else{
		$("#dateFont").html("√");
		$("#dateFont").attr("color","green");
		return true;
	}
}

//检验时长
function checkTime(){
	var time = $("#time").val();
	if(time == ""){
		$("#timeFont").html("请输入时间！ 格式：09:00:00");
		$("#timeFont").attr("color","#FF0000");
		return false;
	}else if(isTime(time)){
		$("#timeFont").html("请输入正确的时间！ 格式：09:00:00");
		$("#timeFont").attr("color","#FF0000");
		return false;
	}else{
		$("#timeFont").html("√");
		$("#timeFont").attr("color","green");
		return true;
	}
}

