$(function(){
	var anntype = $("#anntype").val();
	var iftop = $("#iftop").val();
	$("option").each(function(){
		if($(this).val() == anntype){
			$(this).attr("selected","selected");
		}
	});
	$("input[name='iftop']").each(function(){
		if($(this).val() == iftop){
			$(this).attr("checked","checked");
		}
	});
});