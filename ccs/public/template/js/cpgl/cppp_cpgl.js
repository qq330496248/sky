$(function(){
	$.post('index.php?r=cpgl/GetCpppByCond',function(data){
		getTable(data);
	},'json');
});

function getTable(data){
	$('#cpppTable').empty();
	$('#page').empty();
	if(data.result == 'success'){
		var length = data.list.length;
		for(var i = 0; i < length; i+=2){
			var listInfo = '';
			listInfo = '<tr class="singular">';
			listInfo += '<td><span>'+ data.list[i]['cpad01'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cpad03'] +'</span></td>'
						+ '<td><a href="index.php?r=cpgl/GetUpdateCppp&id='+ data.list[i]['cpad01']
						+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:4%;cursor:pointer"/></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="deleteCppp('+ data.list[i]['cpad01'] 
						+')"></td></tr>';
            if(i != length - 1){
            		listInfo += '<tr class="complex">'
			            + '<td><span>'+ data.list[i+1]['cpad01'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['cpad03'] +'</span></td>'
						+ '<td><a href="index.php?r=cpgl/GetUpdateCppp&id='+ data.list[i+1]['cpad01']
						+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:4%;cursor:pointer"/></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="deleteCppp('+ data.list[i+1]['cpad01'] 
						+')"></td></tr>';
            }
			$('#cpppTable').append(listInfo);	
		}
		$('#page').append(data.pageHtml);
		/*if(data.pageHtml){
			//var pageInfo = '<tr><td colspan="15">'+ data.pageHtml +'</td></tr>';
			$('#pageInfo').empty();
			$('#pageInfo').append(pageInfo);
		}*/
	}else{
		$('#cpppTable').empty();
		var listInfo = '<tr><td colspan="5">暂时没有记录！</td></tr>';
		$('#cpppTable').append(listInfo);	
	}
}

//删除品牌的信息确认
function deleteCppp(id){
	var con = confirm("真的要删除吗？");
	if(con){
		$.post("index.php?r=cpgl/GetCpByPp",{id:id},function(data){
			if(data.result == 'success'){
				if(data.list.length == 0){
					del(id);
				}else{
					alert("仍有产品属于这个品牌，不能删除！");
				}
			}
		},"json");
	}
}

function del(id){
	$.post('index.php?r=cpgl/DeleteCppp',{id:id},function(data){
		alert(data.msg);
		if(data.rse == 'success'){
			window.location.href = 'index.php?r=cpgl/GetCpppHtml';
		}
	},'json');
}

function cpppClick(){
	 var cpmc = $("#cpmc").val();
	$.post('index.php?r=cpgl/GetCpppByCond',{cpmc:cpmc},function(data){
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
	var cpmc = $("#cpmc").val();
	if($href == undefined){
		return;
	}
	$this.attr('href',{cpmc:cpmc},"javascript:;");
	$.post($href,function(data){
		getTable(data);
	});
});
