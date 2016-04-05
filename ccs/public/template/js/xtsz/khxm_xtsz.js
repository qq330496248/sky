//获取考核项目列表
$(function(){
	$.post('index.php?r=xtsz/GetAllXm',function(data){
		getTable(data);
	},'json');

});

function getTable(data){
	if(data.result == 'success'){
		$('#khxmTable').empty();
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><td colspan="5">暂时没有记录！</td></tr>';
			$('#khxmTable').append(listInfo);
		}
		for(var i = 0; i < length; i+= 2){
			var listInfo = '';
			listInfo += '<tr class="singular"><td><span>'+ data.list[i]['id'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khxm'] +'</span></td>';
			if(data.list[i]['type'] == 'F'){
				listInfo += '<td><span>罚</span></td>';
			}else{
				listInfo += '<td><span>奖</span></td>';
			}
			
			listInfo += '<td><span>'+ data.list[i]['score'] +'</span></td>'
			 			+'<td><a href="index.php?r=xtsz/GetUpdateXm&id='+ data.list[i]['id']
			 			+'"><input name="" type="button" class="btn" value="修改"/></a>&nbsp;&nbsp;&nbsp;'
						+'<input name="" type="button" class="btn" onclick="delXm('+data.list[i]['id']+')" style="color:#000000; background:#999999" value="删除"/></td>'
						+'</tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex"><td><span>'+ data.list[i+1]['id'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['khxm'] +'</span></td>';
				if(data.list[i+1]['type'] == 'F'){
					listInfo += '<td><span>罚</span></td>';
				}else{
					listInfo += '<td><span>奖</span></td>';
				}
				
				listInfo += '<td><span>'+ data.list[i+1]['score'] +'</span></td>'
				 			+'<td><a href="index.php?r=xtsz/GetUpdateXm&id='+ data.list[i+1]['id']
				 			+'"><input name="" type="button" class="btn" value="修改"/></a>&nbsp;&nbsp;&nbsp;'
							+'<input name="" type="button" class="btn" onclick="delXm('+data.list[i+1]['id']+')" style="color:#000000; background:#999999" value="删除"/></td>'
							+'</tr>';
			}
			$('#khxmTable').append(listInfo);
		}
	}else{
		$("#khxmTable").empty();
		var listInfo = '<tr><td colspan="5">暂时没有记录！</td></tr>';
		$('#khxmTable').append(listInfo);
	}
}

//focus验证——khxm
function checkKhxm1(){
	var khxm = $("#khxm").val();
	if(khxm == "输入项目名称"){
		$("#khxm").val("");
		$("#khxm").attr("style","color:#000000");
	}
}
//blur验证——khxm
function checkKhxm2(){
	var khxm = $("#khxm").val();
	if(khxm == ""){
		$("#khxm").val("输入项目名称");
		$("#khxm").attr("style","color:#999999");
	}
}

function addXm(){
	var khxm = $("#khxm").val();
	var type = $("#type").val();
	var score = $("#score").val();
	if(checkValue()){
		if(confirm("真的确认提交吗？")){
			$.post("index.php?r=xtsz/AddKhxm",{khxm:khxm,type:type,score:score},function(data){
				if(data.res == "success"){
					alert(data.mes);
					window.location.href="index.php?r=xtsz/GetTjkhxmHtml"
				}else{
					alert(data.mes);
				}
			},"json");
		}
	}
}


function checkValue(){
	var khxm = $("#khxm").val();
	var type = $("#type").val();
	var score = $("#score").val();
	if(khxm == "输入项目名称" || khxm == ""){
		alert("请输入项目名称！");
		return false;
	}
	if(score == ""){
		alert("请输入分数！");
		return false;
	}
	if(isNaN(score)){
		alert("分数必须为数字！");
		return false;
	}
	if(type == "F" && score > 0){
		alert("分数与类型不相符，请输入小于零的数字！");
		return false;
	}
	if(type == "T" && score < 0){
		alert("分数与类型不相符，请输入大于零的数字！");
		return false;
	}
	return true;
}

function delXm(id){
	if(confirm("真的确认删除吗？")){
		$.post("index.php?r=xtsz/DeleteXm",{id:id},function(data){
			if(data.res == "success"){
				alert(data.mes);
				window.location.href="index.php?r=xtsz/GetTjkhxmHtml";
			}else{
				alert(data.mes);
			}
		},"json");
	}
}