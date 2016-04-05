//职业
function updateZy(){
	var zy = $("#zy").val();
	$.post("index.php?r=xtsz/UpdateZy",{zy:zy},function(data){
		alert(data.msg);
		if(data.res == "success"){
			window.location.href="index.php?r=xtsz/GetZyHtml";
		}
		
	});
}

