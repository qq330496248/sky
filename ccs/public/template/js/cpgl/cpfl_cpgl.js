$(function(){
	$.post('index.php?r=cpgl/GetCpfl',function(data){
		getTable(data);
	},'json');
});


function getTable(data){
	$('#cpflTable').empty();
	$('#page').empty();
	if(data.result == 'success'){
		var length = data.list.length;
		for(var i = 0; i < length; i+=2){
			var listInfo = '';
			listInfo = '<tr class="singular">';
			listInfo += '<td><span>'+ data.list[i]['cpab02'] 
						+ '('+ data.list[i]['cpab01'] +')' +'</span></td>'
						+ '<td><a href="index.php?r=cpgl/GetCpzflHtml&id='+ data.list[i]['cpab01']
						+ '"><img src="public/img/1.png" title="查看子分类" border="0" style="width:6%;cursor:pointer"/></a>'
						+'<a href="index.php?r=cpgl/GetUpdateCpfl&id='+ data.list[i]['cpab01']
						+'"><img src="public/img/reservin.png" title="编辑" border="0" style="width:5.5%;cursor:pointer"></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:5.5%;cursor:pointer" onclick="deleteCpfl('+ data.list[i]['cpab01'] +')"/>'
						+'</td>'
						+'</tr>';
			if(i != length - 1){
				listInfo += '<tr class="complex">'
			            + '<td><span>'+ data.list[i+1]['cpab02'] 
						+ '('+ data.list[i+1]['cpab01'] +')' +'</span></td>'
						+ '<td><a href="index.php?r=cpgl/GetCpzflHtml&id='+ data.list[i+1]['cpab01']
						+ '"><img src="public/img/1.png" title="查看子分类" border="0" style="width:6%;cursor:pointer"/></a>'
						+'<a href="index.php?r=cpgl/GetUpdateCpfl&id='+ data.list[i+1]['cpab01']
						+'"><img src="public/img/reservin.png" title="编辑" border="0" style="width:5.5%;cursor:pointer"></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:5.5%;cursor:pointer" onclick="deleteCpfl('+ data.list[i+1]['cpab01'] +')"/>'
						+'</td>'
						+'</tr>';
			}
						
			$('#cpflTable').append(listInfo);	
		}
		$('#page').append(data.pageHtml);
		/*if(data.pageHtml){
			//var pageInfo = '<tr><td colspan="15">'+ data.pageHtml +'</td></tr>';
			$('#pageInfo').empty();
			$('#pageInfo').append(pageInfo);
		}*/
	}else{
		$('#cpflTable').empty();
		var listInfo = '<tr><td colspan="2">暂时没有记录！</td></tr>';
		$('#cpflTable').append(listInfo);
	}
}
//删除产品分类的确认信息，商品确认
function deleteCpfl(id){
	var con = confirm("确定要删除吗？");
	if(con){
		$.post("index.php?r=cpgl/GetCpByFl",{id:id},function(data){
			if(data.result == "success"){
				if(data.list.length == 0){
					 getCpzfl(id);
				}else{
					alert("仍有产品属于这个分类，不能删除！");
				}
			}
		},"json");	
	}
}
//子分类确认
function getCpzfl(id){
	$.post("index.php?r=cpgl/GetCpzfl",{parent:id},function(data){
		if(data.result == "success"){
			if(data.list.length == 0){
				del(id);
			}else{
				alert("仍有子分类属于这个分类，不能删除！");
			}
		}
	},"json");	
}

function cpflClick(){
	var cpfl = $("#cpfl").val();
	$.post("index.php?r=cpgl/GetCpfl",{cpfl:cpfl},function(data){
		getTable(data);
	},"json");
}


//删除
function del(id){
	alert(1);
	$.post('index.php?r=cpgl/DeleteCpfl',{id:id},function(data){
		alert(data.msg);
		if(data.mes == 'success'){
			window.location.href = "index.php?r=cpgl/GetCpflHtml";
		}
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
