//地区
$(function(){
	$.post("index.php?r=xtsz/GetAllArea",function(data){
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
						+ '<td><span>'+ data.list[i]['aname'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cname'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['pname'] +'</span></td>'
						+'<td style="text-align:left"><img src="public/img/reservin.png" title="编辑" border="0" style="width:1.7%;cursor:pointer" onclick="updateDialog('+ data.list[i]['aid'] +')"></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:1.7%;cursor:pointer" onclick="deleteArea('+ data.list[i]['aid'] +')"></td>'
						+'</tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex">';
				listInfo += '<td><span>'+ (i + 2) +'.</span></td>'
							+ '<td><span>'+ data.list[i+1]['aname'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['cname'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['pname'] +'</span></td>'
							+'<td style="text-align:left"><img src="public/img/reservin.png" title="编辑" border="0" style="width:1.7%;cursor:pointer" onclick="updateDialog('+ data.list[i+1]['aid'] +')"></a>'
							+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:1.7%;cursor:pointer" onclick="deleteArea('+ data.list[i+1]['aid'] +')"></td>'
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


//获取城市
function getCity(){
	var provinceID = $("#province").val();
	$.post("index.php?r=xtsz/GetCity",{provinceID:provinceID},function(data){
		$("#city").empty();
		$("#city").append('<option name="city" value="0">选择市</option>');
		if(data.res == "success"){
			$.each(data.list,function(i, n){
				$("#city").append('<option name="city" value="'+ i+'">'+ n +'</option>');
			});
		}
	},"json");
}


//获取地区
function getArea(){
	var cityID = $("#city").val();
	$.post("index.php?r=xtsz/GetArea",{cityID:cityID},function(data){
		$("#area").empty();
		$("#area").append('<option name="area" value="0">选择区/县</option>');
		if(data.res == "success"){
			$.each(data.list,function(i, n){
				$("#area").append('<option name="area" value="'+ i+'">'+ n +'</option>');
			});
		}
	},"json");
}


function selArea(){
	var provinceID = $("#province").val();
	var cityID = $("#city").val();
	var areaID = $("#area").val();
	$.post("index.php?r=xtsz/GetAllArea",{provinceID:provinceID,cityID:cityID,areaID:areaID},function(data){
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
	var cityID = $("#city").val();
	var areaID = $("#area").val();
	$this.attr('href',"javascript:;");
	$.post($href,{provinceID:provinceID,cityID:cityID,areaID:areaID},function(data){
		getTable(data);
	});
});

var httpHost = $('#httpHost').val();  //服务器地址
//弹出添加区县信息窗口
function addDialog(){
	var dialog = new Dialog();
	dialog.Width = 500;
	dialog.Height = 400;
	dialog.URL = "http://"+httpHost+"/index.php?r=dialog/GetAddAreaHtml";
	dialog.show();
}

//弹出修改区县信息窗口
function updateDialog(id){
	var dialog = new Dialog();
	dialog.Width = 500;
	dialog.Height = 400;
	dialog.URL = "http://"+httpHost+"/index.php?r=dialog/GetUpdateAreaHtml&id="+id;
	dialog.show();
}


function deleteArea(id){
	if(confirm("删除后不可恢复，确认删除吗？")){
		$.post("index.php?r=xtsz/DeleteArea",{id:id},function(data){
			alert(data.mes);
			if(data.res == "success"){
				window.location.href = "index.php?r=xtsz/GetDqHtml";
			}
		},"json");
	}
}


//弹出修改默认省市区信息窗口
function deafultAddrDialog(){
	var dialog = new Dialog();
	dialog.Width = 500;
	dialog.Height = 400;
	dialog.URL = "http://"+httpHost+"/index.php?r=dialog/GetDeafultAddrHtml";
	dialog.show();
}