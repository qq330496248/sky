//地区区号
$(function(){
	$.post("index.php?r=xtsz/GetAllCode",function(data){
		getTable(data);
	},"json");
});


function getTable(data){
	if(data.res == 'success'){
		$('#areaTable').empty();
		$('#page').empty();
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><td colspan="5">暂时没有记录！</td></tr>';
			$('#areaTable').append(listInfo);
		}
		for(var i = 0; i < length; i+= 2){
			var listInfo = '';
			listInfo += '<tr class="singular">';
			listInfo += '<td><span>'+ (i + 1) +'.</span></td>'
						+ '<td><span>'+ data.list[i]['cname'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['areaCode'] +'</span></td>'
						+'<td style="text-align:left"><img src="public/img/reservin.png" title="编辑" border="0" style="width:1.4%;cursor:pointer" onclick="updateDialog('+data.list[i]['cid']+')"></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:1.4%;cursor:pointer" onclick="deleteCity('+data.list[i]['cid']+')"/></td>'
						+'</tr>';
			
			if(i < length - 1){
				listInfo += '<tr class="complex">';
				listInfo += '<td><span>'+ (i + 2) +'.</span></td>'
							+ '<td><span>'+ data.list[i+1]['cname'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['areaCode'] +'</span></td>'
							+'<td style="text-align:left"><img src="public/img/reservin.png" title="编辑" border="0" style="width:1.4%;cursor:pointer" onclick="updateDialog('+data.list[i+1]['cid']+')"></a>'
							+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:1.4%;cursor:pointer" onclick="deleteCity('+data.list[i+1]['cid']+')"/></td>'
							+'</tr>';
			}
			$('#areaTable').append(listInfo);	
		}
		$('#page').append(data.pageHtml);
		/*if(data.pageHtml){
			//var pageInfo = '<tr><td colspan="5">'+ data.pageHtml +'</td></tr>';
			$('#pageInfo').empty();
			$('#pageInfo').append(pageInfo);
		}*/
	}else{
		$("#areaTable").empty();
		var listInfo = '<tr><td colspan="5">暂时没有记录！</td></tr>';
		$('#areaTable').append(listInfo);
	}
}

//查找城市
function selCity(){
	var provinceID = $("#province").val();
	var keyword = $("#keyword").val();
	$.post("index.php?r=xtsz/GetAllCode",{provinceID:provinceID,keyword:keyword},function(data){
		getTable(data);
	},"json");
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
	var provinceID = $("#province").val();
	var keyword = $("#keyword").val();
	$this.attr('href',"javascript:;");
	$.post($href,{provinceID:provinceID,keyword:keyword},function(data){
		getTable(data);
	});
});

var httpHost = $('#httpHost').val();  //服务器地址
//弹出添加城市以及区号的窗口
function addDialog(){
	var dialog = new Dialog();
	dialog.Width = 500;
	dialog.Height = 400;
	dialog.URL = "http://"+httpHost+"/index.php?r=dialog/GetAddCityAndCodeHtml";
	dialog.show();
}

//弹出修改城市以及区号的窗口
function updateDialog(id){
	var dialog = new Dialog();
	dialog.Width = 500;
	dialog.Height = 400;
	dialog.URL = "http://"+httpHost+"/index.php?r=dialog/GetUpdateCityAndCodeHtml&id="+id;
	dialog.show();
}


function deleteCity(id){
	if(confirm("删除后不可恢复，确认删除吗？")){
		$.post("index.php?r=xtsz/DeleteCode",{id:id},function(data){
			alert(data.mes);
			if(data.res == "success"){
				window.location.href = "index.php?r=xtsz/GetDqqhHtml";
			}
		},"json");
	}
}
