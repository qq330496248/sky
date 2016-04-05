	
var clientno = $('#clientno').val();
$(function(){
	/**
	 * @desc 加载视图后，显示数据
	 * @author WuJunhua
	 * @date 2016-01-21
	 */
	$.post('index.php?r=ddgl/GetClientOrderRecord',{clientno:clientno},function(data){
		listData(data);
	},'json');
	
});	


/**
 * @desc 客户的订单历史交易记录列表获取数据插入节点
 * @author WuJunhua
 * @date 2016-01-21
 */
function listData(data){
	if(data.result == 'success'){
		$('#getCheckeboxId').empty();
		$('.page').empty();
		var length = data.list.length;
		//$('#pagehidden').attr({ page: data.page, psize: data.psize });
		for(var i = 0; i < length; i++){
			var listInfo = '';
			listInfo = '<tr>';
			listInfo += '<td><a class="canJumpPage" href="index.php?r=ddgl/OrderDetails&orderno='+data.list[i]['xsaa02']+'&ordernum='+data.list[i]['xsaa01']+'">'+ data.list[i]['xsaa02'] +'</a></td>'
						+ '<td><a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i]['xsaa04']+'">'+ data.list[i]['xsaa04'] +'</a></td>'
						+ '<td><span>'+ data.list[i]['xsaa05'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa13'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa19'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa20'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa23'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa48'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa33'] +'</span></td>'   
						+ '<td><span>'+ data.list[i]['xsaa29'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa08'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa39'] +data.list[i]['xsaa40']+','+'备注://'+data.list[i]['xsaa36']+'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa41'] +','+'//'+data.list[i]['xsaa03']+'</span></td>'
						+ '</tr>';
			$('#getCheckeboxId').append(listInfo);
		}
		$('.page').append(data.pageHtml);
	}
}

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2016-01-21
 */
$('body').on('click','.page a',function(){
	var $this = $(this);
	var $href = $this.attr('href');
	if($href == undefined){
		return;
	}
	$this.attr('href',"javascript:;");
	$.post($href,{clientno:clientno},function(data){
		listData(data);
	});
});

