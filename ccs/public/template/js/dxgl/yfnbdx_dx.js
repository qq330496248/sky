$(function(){
	/**
	 * @desc 加载视图后，显示数据
	 * @author huyan
	 * @date 2015-11-10
	 */
	$.post('index.php?r=dxgl/getSentMessages',function(data){
		listData(data);
	},'json')
})

/**
 * @desc 已发短信获取数据插入节点
 * @author huyan
 * @date 2015-10-30
 */
function listData(data){
	$('#getCheckeboxId').empty();
	$('.page').empty();
	if(data.result == 'success'){
		var length = data.list.length;
		$('#pagehidden').attr({ page: data.page, psize: data.psize });	
		for(var i = 0; i < length; i+=2){
			var listInfo = '';
			var a = i+1;
			listInfo = '<tr class="singular">';
			listInfo += '<td>'+a+'</td>';
			listInfo +=  '<td><span>'+ data.list[i]['khag03'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khag05'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khag07'] +'</span></td>'
						+ '<td><img src="public/img/del.png" id="Shipped" title="点击删除" border="0" style="width:7%;cursor:pointer" orderno="'+ data.list[i]['khag09'] +'"></td>'
                        + '</tr>';
            if(i != length - 1){
            	listInfo += '<tr class="complex">'
						+ '<td>'+(a+1)+'</td>'
						+ '<td><span>'+ data.list[i+1]['khag03'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['khag05'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['khag07'] +'</span></td>'
						+ '<td><img src="public/img/del.png" id="Shipped" title="点击删除" border="0" style="width:7%;cursor:pointer" orderno="'+ data.list[i+1]['khag09'] +'"></td>'
                        + '</tr>';
            }
						
			$('#getCheckeboxId').append(listInfo);
		}
		$('.page').append(data.pageHtml);
	}
}

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-10-31
 */
$('body').on('click','.page a',function(){
	var $this = $(this);
	var $href = $this.attr('href');
	$('#url').val($href);
	if($href == undefined){
		return;
	}
	$this.attr('href',"javascript:;");
	$.post($href,function(data){
		listData(data);
	});
});
//单个删除跟进记录
    $('#table4').on('click','#Shipped',function(){
        var orderid = $(this).attr('orderno');
        if(orderid){
            var ensure = confirm('确定要删除吗？');
            if(ensure){
                $.post('index.php?r=dxgl/DelSentMessages',{orderno:orderid},function(data){
                    if(!data){
                        alert('删除失败，请重新操作！');
                    }
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=dxgl/GetYfnbdxHtml&yfnbdx.html";
                    }else{
                        alert(data.msg);
                        return;
                    }
                })
            }
        }
    });


/**
 * @desc 已发短信查询
 * @author huyan
 * @date 2015-11-10
 */
$(function(){
    $('#QuerySentMess').on('click',function(){
        var fssjq = $('#fssjq').val();//发送时间
        var fssjz = $('#fssjz').val();//发送时间
        var jsgh = $('#jsgh').val();//接收工号
        var dxbt = $('#dxbt').val();//接收工号

        $.get('index.php?r=dxgl/getSentMessages',{fssjq:fssjq,fssjz:fssjz,jsgh:jsgh,dxbt:dxbt},function(data){
            if(!data){
                return;
            }
            listData(data);
        });
	});
});


