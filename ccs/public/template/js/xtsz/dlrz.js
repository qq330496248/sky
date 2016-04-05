$(function(){
	$.post('index.php?r=login/GetSetByCond',function(data){
		getTable(data);
	},'json');

});

function getTable(data){
	if(data.result == 'success'){
		$('#dlrzTable').empty();
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><td colspan="6">暂时没有记录！</td></tr>';
			$('#dlrzTable').append(listInfo);
		}
		for(var i = 0; i < length; i+= 2){
			var listInfo = '';
			listInfo += '<tr class="singular"><td><span>'+ (i + 1) +'</span></td>'
						+ '<td><span>'+ data.list[i]['username'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['loginfj'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['loginip'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['loginmac'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['logintime'] +'</span></td>'
						+'</tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex"><td><span>'+ (i + 2) +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['username'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['loginfj'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['loginip'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['loginmac'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['logintime'] +'</span></td>'
							+'</tr>';
			}
			$('#dlrzTable').append(listInfo);	
		}
		/*if(data.pageHtml){
			//var pageInfo = '<tr><td colspan="15">'+ data.pageHtml +'</td></tr>';
			$('#pageInfo').empty();
			$('#pageInfo').append(pageInfo);
		}*/
	}else{
		$('#dlrzTable').empty();
		var listInfo = '<tr><td colspan="6">暂时没有记录！</td></tr>';
		$('#dlrzTable').append(listInfo);	
	}
}

function getSet(){
	var username = $("#gh").val();
	var loginfj = $("#fj").val();
	var begindate = $("#begindate").val();
	var enddate = $("#enddate").val();
	$.post('index.php?r=login/GetSetByCond',{username:username,loginfj:loginfj,begindate:begindate,enddate:enddate},function(data){
		getTable(data);
	},'json');
}