//单据格式
$(function(){
	$.post('index.php?r=xtsz/GetKdgs',function(data){
		 getTable(data);
	},'json');

	
});

function getTable(data){
	if(data.result == 'success'){
		$('#kdgsTable').empty();
		var length = data.list.length;
		for(var i = 0; i < length; i++){
			var listInfo = '<tr><td><span>'+ (i+1) +'</span></td>'
						+'<td><span>'+ data.list[i]['kdgstext'] +'</span></td>'
						+'<td style="text-align:left">'
						+'<input type="button" class="btn" value="设计代收模板" />'
						+'<input type="button" class="btn" value="设计非代收模板" />'
						+'</td></tr>';
			$('#kdgsTable').append(listInfo);	
		}
	}
}


function showKHMBDialog(){
	var dialog = new Dialog();
    dialog.Width=1100;
    dialog.Height=600;
    dialog.URL="http://localhost/ccs/index.php?r=dialog/GetExcelmbHtml&type=khzl";
    dialog.show();
}


function showCPMBDialog(){
	var dialog = new Dialog();
    dialog.Width=1100;
    dialog.Height=600;
    dialog.URL="http://localhost/ccs/index.php?r=dialog/GetExcelmbHtml&type=good";
    dialog.show();
}