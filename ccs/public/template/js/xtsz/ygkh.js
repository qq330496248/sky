$(function(){
	$.post('index.php?r=xtsz/GetAllXm',function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				$('#xmid').append('<option value="'+ data.list[i]['id'] +'">'+ data.list[i]['khxm'] +'('+ data.list[i]['score'] +'分)</option>');	
			}
		}
	},'json');

	$.post('index.php?r=xtsz/GetKhjlByCond',function(data){
		getTable(data);
	},'json');

});

function getTable(data){
	if(data.result == 'success'){
		$('#ygkhTable').empty();
		$('#page').empty();
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><td colspan="11">暂时没有记录！</td></tr>';
			$('#ygkhTable').append(listInfo);
		}
		for(var i = 0; i < length; i+= 2){
			var listInfo = '';
			listInfo += '<tr class="singular"><td><span>'+ (i + 1) +'</span></td>'
						+ '<td><span>'+ data.list[i]['username'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['personname'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khxm'] +'</span></td>';
			if(data.list[i]['type'] == 'F'){
				listInfo += '<td><font>罚</font></td><td><span>'+ data.list[i]['score'] +'</span></td>';
			}else{
				listInfo += '<td><font color="#FF0000">奖</font></td><td><font color="#FF0000">'+ data.list[i]['score'] +'</font></td>';
			}			
			listInfo += '<td><span>'+ data.list[i]['khdate'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['remark'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['setter'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['lrdate'] +'</span></td>'
						+'<td><a href="index.php?r=xtsz/GetUpdateKhjl&id=' + data.list[i]['id']
						+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:8%;cursor:pointer"></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:8%;cursor:pointer" onclick="delKhjl('+ data.list[i]['id']+')"></td>'
						+'</tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex"><td><span>'+ (i + 2) +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['username'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['personname'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['khxm'] +'</span></td>';
				if(data.list[i+1]['type'] == 'F'){
					listInfo += '<td><font>罚</font></td><td><span>'+ data.list[i+1]['score'] +'</span></td>';
				}else{
					listInfo += '<td><font color="#FF0000">奖</font></td><td><font color="#FF0000">'+ data.list[i+1]['score'] +'</font></td>';
				}			
				listInfo += '<td><span>'+ data.list[i+1]['khdate'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['remark'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['setter'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['lrdate'] +'</span></td>'
							+'<td><a href="index.php?r=xtsz/GetUpdateKhjl&id=' + data.list[i+1]['id']
							+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:8%;cursor:pointer"></a>'
							+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:8%;cursor:pointer" onclick="delKhjl('+ data.list[i+1]['id']+')"></td>'
							+'</tr>';
			}
			$('#ygkhTable').append(listInfo);	
		}
		$('#page').append(data.pageHtml);
		/*if(data.pageHtml){
			//var pageInfo = '<tr><td colspan="15">'+ data.pageHtml +'</td></tr>';
			$('#pageInfo').empty();
			$('#pageInfo').append(pageInfo);
		}*/
	}else{
		$("#ygkhTable").empty();
		var listInfo = '<tr><td colspan="11">暂时没有记录！</td></tr>';
		$('#ygkhTable').append(listInfo);
	}
}


function getKhjl(){
	var type = $("#type").val();
	var xmid = $("#xmid").val();
	var username = $("#username").val();
	var begindate = $("#begindate").val();
	var enddate = $("#enddate").val();
	$.post('index.php?r=xtsz/GetKhjlByCond',{type:type,xmid:xmid,username:username,begindate:begindate,enddate:enddate},function(data){
		getTable(data);
	},'json');
}

function delKhjl(id){
	var con = confirm("确认要删除吗？");
	if(con){
		$.post('index.php?r=xtsz/DeleteKhjl',{id:id},function(data){
			getTable(data);
		},'json');
	}else{

	}
}

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-10-31
 */
$('body').on('click','#page a',function(){
	var $this = $(this);
	var $href = $this.attr('href');
	if($href == undefined){
		return;
	}
	$this.attr('href',"javascript:;");
	$.post($href,function(data){
		getTable(data);
	});
});
