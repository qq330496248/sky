//电话加拨
function updateDhjb(){
	var number = $("#number").val();
	$.post("index.php?r=xtsz/UpdateDhjb",{number:number},function(data){
		alert(data.mes);
		if(data.res == "success"){
			window.location.href="index.php?r=xtsz/GetDhjbHtml";
		}
	},"json");
}