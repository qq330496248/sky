$(function(){
	$.post('index.php?r=cpgl/GetCpsxByCond',function(data){
		 getTable(data);
	},'json');
});

function getTable(data){
	$('#cpsxTable').empty();
	$('#page').empty();
	if(data.result == 'success'){
		var length = data.list.length;
		for(var i = 0; i < length; i+=2){
			var listInfo = '';
			var a = i+1;
			listInfo = '<tr class="singular">';
			listInfo += '<td><span>'+a+'</span></td>'
						+'<td><span>'+ data.list[i]['cpag02'] +'</span></td>'
						+'<td><span>属性数</span></td>'
						+ '<td><a href="index.php?r=cpgl/GetUpdateCpsx&id='+ data.list[i]['cpag01']
						+ '"><img src="public/img/1.png" title="查看属性列表" border="0" style="width:4%;cursor:pointer"/></a>'
						+'<a href="index.php?r=cpgl/GetCpsxxqHtml&id='+ data.list[i]['cpag01'] + '">'
						+' <img src="public/img/reservin.png" title="编辑" border="0" style="width:4%;cursor:pointer"/></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="deleteCpsx('+ data.list[i]['cpag01'] +')">'
						+'</td>'
						+'</tr>';
			if(i != length - 1){
				listInfo += '<tr class="complex">'
			            + '<td><span>'+(a+1)+'</span></td>'
						+'<td><span>'+ data.list[i+1]['cpag02'] +'</span></td>'
						+'<td><span>属性数</span></td>'
						+ '<td><a href="index.php?r=cpgl/GetUpdateCpsx&id='+ data.list[i+1]['cpag01']
						+ '"><img src="public/img/1.png" title="查看属性列表" border="0" style="width:4%;cursor:pointer"/></a>'
						+'<a href="index.php?r=cpgl/GetCpsxxqHtml&id='+ data.list[i+1]['cpag01'] + '">'
						+' <img src="public/img/reservin.png" title="编辑" border="0" style="width:4%;cursor:pointer"/></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="deleteCpsx('+ data.list[i+1]['cpag01'] +')">'
						+'</td>'
						+'</tr>';
			}
						
			$('#cpsxTable').append(listInfo);	
		}
		$('#page').append(data.pageHtml);
		/*if(data.pageHtml){
			//var pageInfo = '<tr><td colspan="15">'+ data.pageHtml +'</td></tr>';
			
			
		}*/
	}else{
		$('#cpsxTable').empty();
		var listInfo = '<tr><td colspan="4">暂时没有记录！</td></tr>';
		$('#cpsxTable').append(listInfo);
	}
}

function cpsxClick(){
	var cpsx = $("#cpsx").val();
	$.post("index.php?r=cpgl/GetCpsxByCond",{cpsx:cpsx},function(data){
		getTable(data);
	},"json");
}


function deleteCpsx(id){
	var con = confirm("确定要删除吗？");
	if(con){
		$.post("index.php?r=cpgl/GetCpsxxqByCond",{parent:id},function(data){
			if(data.result == "success"){
				if(data.list.length == 0){
					del(id);
				}else{
					alert("仍有属性与这个属性有关，不能删除！");
				}
			}
		},"json");
	}
}


function del(id){
	$.post('index.php?r=cpgl/DeleteCpsx',{id:id},function(data){
		 getTable(data);
	},'json');
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
