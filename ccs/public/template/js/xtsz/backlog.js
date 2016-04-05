$(function(){
	$.post("index.php?r=xtsz/GetClientBacklog",function(data){
		getClientBacklogTable(data);
	},"json");

	$.post("index.php?r=xtsz/GetOrderBacklog",function(data){
		getOrderBacklogTable(data);
	},"json");
});
//客户待办事项
function getClientBacklogTable(data){
	$("#clientPage").empty();
	if(data.result == 'success'){
		$("#khdbsxTable").empty();
		var length = data.list.length;
		var str = 'client';//用于【完成】操作
		for(var i = 0; i < length; i += 2){
			var str = data.list[i]['khae03'].split('：');
			var listInfo = '<tr class="singular">'
							+'<td><input type="checkbox" value="'+ data.list[i]['khae12'] +'" name="clientBacklog" ><a class="kh" style="color:#0000FF" href="index.php?r=khgl/NewClientData&clientno='+ data.list[i]['khae01'] +'&ordernum='+ data.list[i]['khaa01'] +'&sign=2">'+ data.list[i]['khae01'] +'</a>:'+ data.list[i]['khaa03'] +'</td>'
							+'<td>'+ data.list[i]['khae02'] +'</td>'
							+'<td><a style="color:#FF0000" href="index.php?r=ddgl/OrderDetails&orderno='+ data.list[i]['xsaa02'] +'&ordernum='+ data.list[i]['xsaa01'] +'">'+ str[0] +'</a>：'+ str[1] + '</td>'
							+'<td>'+ data.list[i]['khae04'] +':'+ data.list[i]['khae05'] +'</td>'
							+'<td>'+ data.list[i]['khae06'] +':'+ data.list[i]['khae07'] +'</td>'
							+'<td>'+ data.list[i]['khae09'] +'</td>'
							+'<td>'+ data.list[i]['khae08'] +'</td>'
							+'<td><font style="color:#FF0000;cursor:pointer;" onclick="backlogFinished('+ data.list[i]['khae12'] +','+"'"+str+"'"+')">完成</font></td></tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex">'
							+'<td><input type="checkbox" value="'+ data.list[i+1]['khae12'] +'" name="clientBacklog" ><a class="kh" style="color:#0000FF" href="index.php?r=khgl/NewClientData&clientno='+ data.list[i+1]['khae01'] +'&ordernum='+ data.list[i+1]['khaa01'] +'&sign=2">'+ data.list[i+1]['khae01'] +'</a>:'+ data.list[i+1]['khaa03'] +'</td>'
							+'<td>'+ data.list[i+1]['khae02'] +'</td>'
							+'<td><a style="color:#FF0000" href="index.php?r=ddgl/OrderDetails&orderno='+ data.list[i+1]['xsaa02'] +'&ordernum='+ data.list[i+1]['xsaa01'] +'">'+ str[0] +'</a>：'+ str[1] + '</td>'
							+'<td>'+ data.list[i+1]['khae04'] +':'+ data.list[i+1]['khae05'] +'</td>'
							+'<td>'+ data.list[i+1]['khae06'] +':'+ data.list[i+1]['khae07'] +'</td>'
							+'<td>'+ data.list[i+1]['khae09'] +'</td>'
							+'<td>'+ data.list[i+1]['khae08'] +'</td>'
							+'<td><font style="color:#FF0000;cursor:pointer;" onclick="backlogFinished('+ data.list[i+1]['khae12'] +','+"'"+str+"'"+')">完成</font></td></tr>';
			}
			$("#khdbsxTable").append(listInfo);
		}
		$("#clientPage").append(data.pageHtml);
	}
}

//订单待办事项
function getOrderBacklogTable(data){
	$("#orderPage").empty();
	if(data.result == 'success'){
		$("#xsdbsxTable").empty();
		var length = data.list.length;
		var str = 'order';
		for(var i = 0; i < length; i ++){
			var listInfo = '<tr>'
							+'<td><input type="checkbox" value="'+ data.list[i]['xsad10'] +'" name="orderBacklog" ><a class="kh" style="color:#0000FF" href="index.php?r=khgl/NewClientData&clientno='+ data.list[i]['khae01'] +'&ordernum='+ data.list[i]['khaa01'] +'&sign=2">'+ data.list[i]['khaa02'] +'</a>:'+ data.list[i]['khaa03'] +'</td>'
							+'<td>订单跟进</td>'
							+'<td><a style="color:#FF0000" href="index.php?r=ddgl/OrderDetails&orderno='+ data.list[i]['xsaa02'] +'&ordernum='+ data.list[i]['xsaa01'] +'">'+ data.list[i]['xsad01'] +'</a>:'+ data.list[i]['xsad06'] +'</td>'
							+'<td>'+ data.list[i]['xsad07'] +':'+ data.list[i]['xsad08'] +'</td>'
							+'<td>'+ data.list[i]['xsad02'] +':'+ data.list[i]['xsad03'] +'</td>'
							+'<td>'+ data.list[i]['xsad05'] +'</td>'
							+'<td>'+ data.list[i]['xsad04'] +'</td>'
							+'<td><font style="color:#FF0000;cursor:pointer;" onclick="backlogFinished('+ data.list[i]['khae12'] +','+"'"+str+"'"+')">完成</font></td></tr>';
			$("#xsdbsxTable").append(listInfo);
		}
		$("#orderPage").append(data.pageHtml);
	}
}
//查找客户待办事项，用str来区分客户还是订单
function getBacklog(str){
	var type = $("#"+str+"Type").val();
	var backlogType = $("#"+str+"BacklogType").val();
	var khid = $("#"+str+"Khid").val();
	var khxm = $("#"+str+"Khxm").val();
	if(str == 'client'){
		$.post("index.php?r=xtsz/GetClientBacklog",{type:type,backlogType:backlogType,khid:khid,khxm:khxm},function(data){
			getClientBacklogTable(data);
		},"json");
	}else{
		$.post("index.php?r=xtsz/GetOrderBacklog",{type:type,backlogType:backlogType,khid:khid,khxm:khxm},function(data){
			getOrderBacklogTable(data);
		},"json");
	}
		
}


//待办事项完成，用str区分
function backlogFinished(id,str){
	alert(str);
	if(confirm("真的已经完成了吗？")){
		$.post("index.php?r=xtsz/Finish"+str+"Backlog",{id:id},function(data){
			alert(data.msg);
			if(data.mes == 'success'){
				window.location.href = 'index.php?r=xtsz/GetBacklogHtml';
			}
		},"json");
	}
}

//选择所有事项，用str区分
function checkAll(str){
	var all = $("#"+str+"AllChecked").attr('checked');
	if(all == 'checked'){
		$("input[name='"+str+"Backlog']").each(function(){
			$(this).attr('checked','checked');
		});
	}else{
		$("input[name='"+str+"Backlog']").each(function(){
			$(this).attr('checked',null);
		});
	}
}

//待办事项批量完成，用type区分
function backlogsFinished(type){
	var str = "";
	var href = "";
	if(type == 'clients'){
		$("input[name='clientBacklog']").each(function(){
			if($(this).attr('checked') == 'checked'){
				str += $(this).val() + ',';
			}
		});
		href = "index.php?r=xtsz/FinishClientBacklogs";
	}else{
		$("input[name='orderBacklog']").each(function(){
			if($(this).attr('checked') == 'checked'){
				str += $(this).val() + ',';
			}
		});
		href = "index.php?r=xtsz/FinishOrderBacklogs";
	}
		
	if(confirm("真的都完成了吗？")){
		$.post(href,{str:str},function(data){
			alert(data.msg);
			if(data.mes == 'success'){
				window.location.href = 'index.php?r=xtsz/GetBacklogHtml';
			}
		},"json");
	}
}





/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-10-31
 */
$('body').on('click','#clientPage a',function(){
	var type = $("#clientType").val();
	var backlogType = $("#clientBacklogType").val();
	var khid = $("#clientKhid").val();
	var khxm = $("#clientKhxm").val();

	var $this = $(this);
	var $href = $this.attr('href');
	if($href == undefined){
		return;
	}
	$this.attr('href',{type:type,backlogType:backlogType,khid:khid,khxm:khxm},"javascript:;");
	$.post($href,function(data){
		getTable(data);
	});
});
