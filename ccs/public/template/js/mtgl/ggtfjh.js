$(function(){
	/*$.post("index.php?r=mtgl/GetAdvertByCond",function(data){
		getTable(data);
	},"json");*/
});


function getTable(data){
	if(data.result == "success"){
		$("#advertTable").empty();
		$("#page").empty();
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><th colspan="10">暂时没有记录！</th></tr>';
			$("#advertTable").append(listInfo);
		}
		for(var i = 0; i < length; i += 2){
			var listInfo = '<tr class="singular"><td>' +(i + 1)+ '</td><td>' + data.list[i]['adverttext'] + '</td><td>' + data.list[i]['advertdate']
							+ '</td><td>' + data.list[i]['adverttime'] + '</td><td>' + data.list[i]['duration'] + '</td><td>' + data.list[i]['cost']
							+ '</td><td>' + data.list[i]['adverttype'] + '</td><td>' + data.list[i]['setter'] + '</td><td>' +data.list[i]['submittime']
							+ '</td><td><a href="index.php?r=mtgl/GetSingleAdvert&id='+data.list[i]['advertid']+'"><input type="button" class="btn" style="width:70px" value="修改"/></a>'
							+ '<input type="button" class="btn" onclick="deleteAdvert('+"'"+data.list[i]['advertid']+"'"+')" style="color:#000000; background:#999999; width:70px" value="删除"/></td></tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex"><td>' +(i + 2)+ '</td><td>' + data.list[i+1]['adverttext'] + '</td><td>' + data.list[i+1]['advertdate']
								+ '</td><td>' + data.list[i+1]['adverttime'] + '</td><td>' + data.list[i+1]['duration'] + '</td><td>' + data.list[i+1]['cost']
								+ '</td><td>' + data.list[i+1]['adverttype'] + '</td><td>' + data.list[i+1]['setter'] + '</td><td>' +data.list[i+1]['submittime']
								+ '</td><td><a href="index.php?r=mtgl/GetSingleAdvert&id='+data.list[i+1]['advertid']+'"><input type="button" class="btn" style="width:70px" value="修改"/></a>'
								+ '<input type="button" class="btn" onclick="deleteAdvert('+"'"+data.list[i+1]['advertid']+"'"+')" style="color:#000000; background:#999999; width:70px" value="删除"/></td></tr>';
			}
			$("#advertTable").append(listInfo);
		}
		$("#page").append(data.pageHtml);
	}else{
		$("#advertTable").empty();
		var listInfo = '<tr><th colspan="10">暂时没有记录！</th></tr>';
		$("#advertTable").append(listInfo);
	}
}


function deleteAdvert(id){
	var con = confirm("真的确认删除吗？");
	if(con){
		$.post("index.php?r=mtgl/DeleteAdvert",{id:id},function(data){
			alert(data.msg);
			if(data.res == 'success'){
				window.location.href='index.php?r=mtgl/GetGgtfjhHtml';
			}
		},"json");
	}
}


function selectAdvert(){
	var adverttext = $("#adverttext").val();
	var advertBegindate = $("#advertBegindate").val();
	var advertEnddate = $("#advertEnddate").val();
	var submitBegindate = $("#submitBegindate").val();
	var submitEnddate = $("#submitEnddate").val();
	$.post("index.php?r=mtgl/GetAdvertByCond",{adverttext:adverttext,advertBegindate:advertBegindate,advertEnddate:advertEnddate,submitBegindate:submitBegindate,submitEnddate:submitEnddate},function(data){
		getTable(data);
	},"json");
}


/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-10-31
 */
$('body').on('click','#page a',function(){
	var adverttext = $("#adverttext").val();
	var advertBegindate = $("#advertBegindate").val();
	var advertEnddate = $("#advertEnddate").val();
	var submitBegindate = $("#submitBegindate").val();
	var submitEnddate = $("#submitEnddate").val();
	var $this = $(this);
	var $href = $this.attr('href');
	if($href == undefined){
		return;
	}
	$this.attr('href',"javascript:;");
	$.post($href,{adverttext:adverttext,advertBegindate:advertBegindate,advertEnddate:advertEnddate,submitBegindate:submitBegindate,submitEnddate:submitEnddate},function(data){
		getTable(data);
	});
});