$(function(){
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;
	var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();

	var begin = year + "-" + month + "-01";
	var end  = year + "-" + month + "-" + day;

	$("#xdsjq").val(begin);
	$("#xdsjz").val(end);

	/*$.post("index.php?r=xtsz/GetCzjlByCond",function(data){
		getTable(data);
	},'json');*/
});

function getTable(data){
	if(data.result == 'success'){
		$("#czjlTable").empty();
		$("#page").empty();
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><td colspan="6">暂时没有记录！</td></tr>';
			$('#czjlTable').append(listInfo);
		}
		for(var i = 0; i < length; i += 2){
			var listInfo = '';
			listInfo += '<tr class="singular"><td><span>'+ (i + 1) +'</span></td>'
						+ '<td><span>'+ data.list[i]['type'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['thingid'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['difference'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['ry'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['opetime'] +'</span></td>'
						+'</tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex"><td><span>'+ (i + 2) +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['type'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['thingid'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['difference'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['ry'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['opetime'] +'</span></td>'
							+'</tr>';
			}
			$('#czjlTable').append(listInfo);	
		}
		$("#page").append(data.pageHtml);
	}else{
		$("#czjlTable").empty();
		var listInfo = '<tr><td colspan="6">暂时没有记录！</td></tr>';
		$('#czjlTable').append(listInfo);
	}
}



function getCzjl(){
	var type = $("#type").val();
	var ry = $("#ry").val();
	var difference = $("#difference").val();
	var thingid = $("#thingid").val();
	var beginDate = $("#xdsjq").val();
	var endDate = $("#xdsjz").val();

	$.post("index.php?r=xtsz/GetCzjlByCond",{type:type,ry:ry,difference:difference,thingid:thingid,beginDate:beginDate,endDate:endDate},function(data){
		getTable(data);
	},"json");
}

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-10-31
 */
$('body').on('click','#page a',function(){
	var type = $("#type").val();
	var ry = $("#ry").val();
	var difference = $("#difference").val();
	var thingid = $("#thingid").val();
	var beginDate = $("#xdsjq").val();
	var endDate = $("#xdsjz").val();
	
	var $this = $(this);
	var $href = $this.attr('href');
	if($href == undefined){
		return;
	}
	$this.attr('href',{type:type,ry:ry,difference:difference,thingid:thingid,beginDate:beginDate,endDate:endDate},"javascript:;");
	$.post($href,function(data){
		getTable(data);
	});
});
