$(function(){
	$.post("index.php?r=xtsz/GetWarehouse",function(data){
		getTable(data);
	},"json");
});

function getTable(data){
	$("#kwTable").empty();
	$("#page").empty();
	if(data.res == "success"){
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><td colspan="5">暂时没有记录！</td><tr>';
			$("#kwTable").append(listInfo);
		}
		for(var i = 0; i < length; i += 2){
			var listInfo = '';
			listInfo += '<tr class="singular"><td><span>'+ (i + 1) +'</span></td>'
						+'<td><span>'+ data.list[i]['name'] +'</span></td>'
						+'<td><span>'+ data.list[i]['place'] +'</span></td>';
			if(data.list[i]['ifuse'] == "是"){
				listInfo += '<td><span>'+ data.list[i]['ifuse'] +'</span></td>'
							+ '<td><input type="button" class="btn" value="禁用" style="color:#000000; background:#999999; width:50px" onclick="stopKw('+"'"+ data.list[i]['id']+"'" +')" />';
			}else{
				listInfo += '<td><span style="color:#FF0000">'+ data.list[i]['ifuse'] +'</span></td>'
							+ '<td><input type="button" class="btn" value="启用" style="width:50px" onclick="startKw('+"'"+ data.list[i]['id']+"'" +')" />';
			}
			listInfo += '<img src="public/img/reservin.png" title="编辑" border="0" style="width:4%;cursor:pointer" onclick="getKw('+"'"+ data.list[i]['id']+"'" +')" />'
						+'<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="deleteKw('+"'"+ data.list[i]['id']+"'" +')" /></td></tr>';
			
			if(i < length - 1){
				listInfo += '<tr class="complex"><td><span>'+ (i + 2) +'</span></td>'
							+'<td><span>'+ data.list[i+1]['name'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['place'] +'</span></td>';
				if(data.list[i+1]['ifuse'] == "是"){
					listInfo += '<td><span>'+ data.list[i+1]['ifuse'] +'</span></td>'
								+ '<td><input type="button" class="btn" value="禁用" style="color:#000000; background:#999999; width:50px" onclick="stopKw('+"'"+ data.list[i+1]['id']+"'" +')" />';
				}else{
					listInfo += '<td><span style="color:#FF0000">'+ data.list[i+1]['ifuse'] +'</span></td>'
								+ '<td><input type="button" class="btn" value="启用" style="width:50px" onclick="startKw('+"'"+ data.list[i+1]['id']+"'" +')" />';
				}
				listInfo += '<img src="public/img/reservin.png" title="编辑" border="0" style="width:4%;cursor:pointer" onclick="getKw('+"'"+ data.list[i+1]['id']+"'" +')" />'
							+'<img src="public/img/del.png" title="点击删除" border="0" style="width:4%;cursor:pointer" onclick="deleteKw('+"'"+ data.list[i+1]['id']+"'" +')" /></td></tr>';
			}
			$("#kwTable").append(listInfo);
		}
		$("#page").append(data.pageHtml);
	}else{
		$("#kwTable").empty();
		var listInfo = '<tr><th colspan="5">暂时没有记录！</th><tr>';
		$("#kwTable").append(listInfo);
	}
}

//开关DIV
function showDiv(str){
	$("#"+str).show();
}
function closeDiv(str){
	$("#"+str).hide();
}

//检验库名
function checkName(){
	var name = $("#name").val();
	if(name == ""){
		$("#nameFont").html("库名不能为空！");
		$("#nameFont").attr('color','#FF0000');
		return false;
	}
	$("#nameFont").html("√");
	$("#nameFont").attr('color','#00FF00');
	return true;
}

//检验位置
function checkPlace(){
	var place = $("#place").val();
	if(place == ""){
		$("#placeFont").html("位置不能为空！");
		$("#placeFont").attr('color','#FF0000');
		return false;
	}
	$("#placeFont").html("√");
	$("#placeFont").attr('color','#00FF00');
	return true;
}

//检验库名
function checkUpdateName(){
	var name = $("#updateName").val();
	if(name == ""){
		$("#updateNameFont").html("库名不能为空！");
		$("#updateNameFont").attr('color','#FF0000');
		return false;
	}
	$("#updateNameFont").html("√");
	$("#updateNameFont").attr('color','#00FF00');
	return true;
}

//检验位置
function checkUpdatePlace(){
	var place = $("#updatePlace").val();
	if(place == ""){
		$("#updatePlaceFont").html("位置不能为空！");
		$("#updatePlaceFont").attr('color','#FF0000');
		return false;
	}
	$("#updatePlaceFont").html("√");
	$("#updatePlaceFont").attr('color','#00FF00');
	return true;
}






//添加库位信息
function addKw(){
	var name = $("#name").val();
	var place = $("#place").val();
	var ifuse = $("input[name='ifuse']:checked").val();
	if(checkName() && checkPlace()){
		if(confirm("真的确认提交吗？")){
			$.post("index.php?r=xtsz/AddWarehouse",{name:name,place:place,ifuse:ifuse},function(data){
				alert(data.mes);
				if(data.res == "success"){
					window.location.href = "index.php?r=xtsz/GetKwglHtml";
				}
			},"json");
		}
	}else{
		alert("请根据提示正确填写信息！");	
	}
}

//获取库位信息
function getKw(id){
	$.post("index.php?r=xtsz/GetSingleWarehouse",{id:id},function(data){
		if(data){
			$("#updateID").val(data['id']);
			$("#updateName").val(data['name']);
			$("#updatePlace").val(data['place']);
			$("input[name='updateIfuse']").each(function(){
				if($(this).val() == data['ifuse']){
					$(this).attr('checked',"checked");
				}
			});
			showDiv("update");
		}
	},"json");
}


//修改库位信息
function updateKw(){
	var id = $("#updateID").val();
	var name = $("#updateName").val();
	var place = $("#updatePlace").val();
	var ifuse = $("input[name='updateIfuse']:checked").val();
	$.post("index.php?r=xtsz/UpdateWarehouse",{id:id,name:name,place:place,ifuse:ifuse},function(data){
		if(data){
			alert(data.mes);
			if(data.res == "success"){
				window.location.href = "index.php?r=xtsz/GetKwglHtml";
			}
		}
	},"json");
}

//删除库位信息
function deleteKw(id){
	if(confirm("真的确认删除吗？")){
		$.post("index.php?r=xtsz/DeleteWarehouse",{id:id},function(data){
			alert(data.mes);
			if(data.res == "success"){
				window.location.href = "index.php?r=xtsz/GetKwglHtml";
			}
		},"json");
	}
}

//禁用库位
function startKw(id){
	if(confirm("确定启用吗？")){
		$.post("index.php?r=xtsz/StartWarehouse",{id:id},function(data){
			alert(data.mes);
			if(data.res == "success"){
				window.location.href = "index.php?r=xtsz/GetKwglHtml";
			}
		},"json");
	}
}

//启用库位
function stopKw(id){
	if(confirm("确定禁用吗？")){
		$.post("index.php?r=xtsz/StopWarehouse",{id:id},function(data){
			alert(data.mes);
			if(data.res == "success"){
				window.location.href = "index.php?r=xtsz/GetKwglHtml";
			}
		},"json");
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
