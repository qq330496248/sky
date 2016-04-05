$(function(){
	$.post("index.php?r=xtsz/GetTransfer",function(data){
		getTable(data);
	},"json");
});

function getTable(data){
	$("#txlTable").empty();
	$('#page').empty();
	if(data.res == "success"){
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><th colspan="6">暂时没有记录！</th></tr>';
			$("#txlTable").append(listInfo);
		}
		for(var i = 0; i < length; i ++){
			var listInfo = '<tr onclick="getPhone('+ data.list[i]['fenji'] +')" style="cursor:pointer;">';
			listInfo += '<td><span>'+ data.list[i]['username'] +'</span></td>'
						+'<td><span>'+ data.list[i]['fenji'] +'</span></td>'
						+'<td><span>'+ data.list[i]['personname'] +'</span></td>'
						+'<td><span>'+ data.list[i]['telephone'] +'</span></td>'
						+'<td><span>'+ data.list[i]['role'] +'</span></td>'
						+'<td><span>'+ data.list[i]['department'] +'</span></td>';
			$("#txlTable").append(listInfo);
		}
		$('#page').append(data.pageHtml);
	}else{
		 var listInfo = '<tr><th colspan="6">暂时没有记录！</th></tr>';
		 $("#txlTable").append(listInfo);
	}
}

function selectFj(){
	var fenji = $("#fenji").val();
	$.post("index.php?r=xtsz/GetTransfer",{fenji:fenji},function(data){
		getTable(data);
	},"json");
}


function getPhone(phone){
	$("#fenji").val(phone);
}