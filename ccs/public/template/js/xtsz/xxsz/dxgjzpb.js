
function updateGjz(){
	var gjz = $("#gjz").val();
	$.post("index.php?r=xtsz/UpdateDxgjz",{gjz:gjz},function(data){
		alert(data.mes);
		if(data.res == "success"){
			window.location.href="index.php?r=xtsz/GetDxgjzpbHtml";
		}
	});
}

