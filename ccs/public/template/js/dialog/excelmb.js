$(function(){
	var type = $("#type").val();
	$.post("index.php?r=xtsz/GetCol",{type:type},function(data){
		getTable(data);
	},"json");
});
//获取
function getTable(data){
	$("#mbTable").empty();
	$("#page").empty();
	if(data.result == "success"){
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><td colspan="4" class="page"></td></tr>';
			$("$mbTable").append(listInfo);
		}else{
			for(var i = 0; i < length; i ++){
				var listInfo = '<tr>'
							+'<td>'+(i + 1)+'</td>'
							+'<td><span>'+data.list[i]['valuetype3']+'</span></td>'
							+'<td><input type="text" class="dfinput" value="'+data.list[i]['valuetype4']+'" id="number_'+data.list[i]['id']+'" /></td>'
							+'<td><input type="button" class="btn" value="修改保存" onclick="updateCol('+data.list[i]['id']+')" style="width:100px;" />';
				if(data.list[i]['valuetype5'] == 'N'){
					listInfo +='<input type="button" class="btn" disabled="" value="移除" onclick="emptyCol('+data.list[i]['id']+')" style="width:100px;color:#C0C0C0; background:#999999;cursor:not-allowed;" /></td>';
				}else{
					listInfo +='<input type="button" class="btn" value="移除" onclick="emptyCol('+data.list[i]['id']+')" style="width:100px;color:#000000; background:#999999;" /></td>';
				}
				$("#mbTable").append(listInfo);
							
			}
		}
		$("#page").append(data.pageHtml);
	}
}
//更新序号以及列名
function updateCol(id){
	var number = $("#number_"+id).val();
	var type = $("#type").val();
	if(confirm("确定修改此列信息吗？")){	
		$.post("index.php?r=xtsz/UpdateCol",{id:id,number:number},function(data){
			alert(data.msg);
			if(data.res == "success"){
				window.location.href="index.php?r=dialog/GetExcelmbHtml&type="+type;
			}
		},"json");
	}

}


//清空序号
function emptyCol(id){
	var type = $("#type").val();
	if(confirm("确定移除此列吗？")){
		$.post("index.php?r=xtsz/EmptyCol",{id:id},function(data){
			alert(data.msg);
			if(data.res == "success"){
				window.location.href="index.php?r=dialog/GetExcelmbHtml&type="+type;
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
	var type = $("#type").val();
	var $this = $(this);
	var $href = $this.attr('href');
	if($href == undefined){
		return;
	}
	$this.attr('href',"javascript:;");
	$.post($href,{type:type},function(data){
		getTable(data);
	});
});

//添加列
function addCol(){
	var id = $('#allCol').val();
	var type = $("#type").val();
	if(confirm("确认添加吗？（初始序号为000）")){
		$.post("index.php?r=xtsz/AddCol",{id:id},function(data){
			alert(data.msg);
			if(data.res == "success"){
				window.location.href="index.php?r=dialog/GetExcelmbHtml&type="+type;
			}
		},"json");
	}
}