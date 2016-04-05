$(function(){
	var post = $("#post").val();
	if(post.indexOf("采购") > -1){
		$("#account").attr('style',"");
		$("#cgwy").attr('style',"display:none");
	}
	$.post("index.php?r=cggl/GetGysByCond",function(data){
		getTable(data,post);
	},'json');
});

function getTable(data,post){
	$('#gysTable').empty();
	$('#page').empty();
	if(data.result == 'success'){
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><td colspan="10" style="color:#0000ff;">暂时没有记录！</td></tr>';
			$('#gysTable').append(listInfo);
		}
		for(var i = 0; i < length; i+=2){
			var listInfo = '';
			listInfo = '<tr class="singular">';
			listInfo += '<td><span>'+ (i + 1) +'</span></td>'
						+ '<td><span>'+ data.list[i]['cgab01'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cgab02'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cgab04'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cgab18'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cgab15'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cgab17'] +'</span></td>';
			if(data.list[i]['cgab21'] != ''){
				listInfo += '<td><span>'+ data.list[i]['cgab21'].split(':')[1] +'</span></td>';
			}else{
				listInfo += '<td><span></span></td>';
			}
			var str = "";
			//权限，如果是财务人员，才能进行修改（或者高权限）
			//if(post.indexOf("财务") > -1 || post.indexOf("管理员") > -1){
				str = '<img src="public/img/reservin.png" title="编辑" border="0" style="width:9%;cursor:pointer;">';
			//}
			listInfo += '<td><a href="index.php?r=cggl/GetSingleGys&id='+ data.list[i]['cgab01']
						+ '">'+ str +'</a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:9%;cursor:pointer" onclick="delGys('+"'"+data.list[i]['cgab01']+"'"+')"/>'
						+'</td>'
						+'</tr>';

			if(i != length - 1){
				listInfo += '<tr class="complex">'
							+ '<td><span>'+ (i + 2) +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['cgab01'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['cgab02'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['cgab04'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['cgab18'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['cgab15'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['cgab17'] +'</span></td>';
				if(data.list[i]['cgab21'] != ''){
					listInfo += '<td><span>'+ data.list[i+1]['cgab21'].split(':')[1] +'</span></td>';
				}else{
					listInfo += '<td><span></span></td>';
				}
							var str = "";
							//权限，如果是财务人员，才能进行修改（或者高权限）
							//if(post.indexOf("财务") > -1 || post.indexOf("管理员") > -1){
								str = '<img src="public/img/reservin.png" title="编辑" border="0" style="width:9%;cursor:pointer;">';
							//}
							listInfo += '<td><a href="index.php?r=cggl/GetSingleGys&id='+ data.list[i+1]['cgab01']
							+ '">'+ str +'</a>'
							+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:9%;cursor:pointer" onclick="delGys('+"'"+data.list[i+1]['cgab01']+"'"+')"/>'
							+'</td>'
							+'</tr>';
			}
			$('#gysTable').append(listInfo);	
		}
		$('#page').append(data.pageHtml);
	}else{
		var listInfo = '<tr><td colspan="10" style="color:#0000ff;">暂时没有记录！</td></tr>';
		$('#gysTable').append(listInfo);
	}
}


function delGys(id){
	var con = confirm("确认删除吗？");
	if(con){
		$.post('index.php?r=cggl/DeleteGys',{id:id},function(data){
			alert(data.msg);
			if(data.mes == "success"){
				window.location.href="index.php?r=cggl/GetGyslbHtml";
			}
		},'json');
	}
}


function getGys(){
	var gysid = $("#gysid").val();
	var name = $("#name").val();
	var begindate = $("#begindate").val();
	var enddate = $("#enddate").val();
	var cgwy = $("#cgwy").val();
	var money = $("#money").val();
	$.post("index.php?r=cggl/GetGysByCond",{gysid:gysid,name:name,begindate:begindate,enddate:enddate,cgwy:cgwy,money:money},function(data){
		getTable(data);
	},'json');
}

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-10-31
 */
$('body').on('click','#page a',function(){
	var gysid = $("#gysid").val();
	var name = $("#name").val();
	var begindate = $("#begindate").val();
	var enddate = $("#enddate").val();
	var cgwy = $("#cgwy").val();
	var money = $("#money").val();
	var $this = $(this);
	var $href = $this.attr('href');
	if($href == undefined){
		return;
	}
	$this.attr('href',{gysid:gysid,name:name,begindate:begindate,enddate:enddate,cgwy:cgwy,money:money},"javascript:;");
	$.post($href,function(data){
		getTable(data);
	});
});
