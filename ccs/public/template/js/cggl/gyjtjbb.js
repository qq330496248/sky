$(function(){
	$.post("index.php?r=cggl/GetGyjForReport",function(data){
		getTable(data);
	},"json");
});

function getTable(data){
	$("#gysTable").empty();
	$("#page").empty();
	if(data.res == 'success'){
		var length = data.list.length;
		for(var i = 0; i <= length; i ++){
			var listInfo = '<tr>';
			listInfo += '<td></td>';
		}
	}
}