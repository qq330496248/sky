$(function(){
	/**
	 * @desc 加载视图后，显示数据
	 * @author huyan
	 * @date 2015-11-16
	 */
	/*$.post('index.php?r=khgl/GetShortMessage',function(data){
		listData(data);
	},'json')*/
})

 	/* @desc 加载视图后，显示数据
	 * @author WuJunhua
	 * @date 2015-11-04
	 */
	var orderstatus = $('#orderstatus').val();
	$.get('index.php?r=khgl/GetShortMessage',{orderstatus :orderstatus},function(data){
		listData(data);

		/*//全选(全不选)特效
		checkAll($('#checkall'),$('.checkbox'));
*/
	},'json');

/**
 * @desc 客户短信获取数据插入节点
 * @author huyan
 * @date 2015-11-16
 */
function listData(data){
	$('#CustomerMessage').empty();
	$('.page').empty();
	if(data.result == 'success'){
		var length = data.list.length;
		/*var nowTime = '1980-01-01 10:00:00';*/
		
		$('#pagehidden').attr({ page: data.page, psize: data.psize });
		for(var i = 0; i < length; i++){
			// if(data.list[i]['khaf07'] < nowTime){
			// 	data.list[i]['khaf07'] = '';
			// }
			var listInfo = '';
			var a = i+1;
			listInfo = '<tr>';
			listInfo += '<td>'+a+'&nbsp;&nbsp;</td>';
			listInfo += '<td><span>'+ data.list[i]['khaf02'] +'</span></td>'
					  + '<td><span>'+ data.list[i]['khaf03'] +'</span></td>'
					  + '<td><span>'+ data.list[i]['khaf04'] +'</span></td>'
					  + '<td><span>'+ data.list[i]['khaf05'] +'</span></td>'
					  + '<td><span>'+ data.list[i]['khaf06'] +'</span></td>'
					  + '<td><span>'+ data.list[i]['khaf07'] +'</span></td>'
					  + '<td><span>'+ data.list[i]['khaf08'] +'</span></td>'
						
			$('#CustomerMessage').append(listInfo);
		}
		$('.page').append(data.pageHtml);
	};
}

/**
 * @desc 客户短信查询
 * @author huyan
 * @date 2015-11-16
 */
$(function(){
    $('#SMSQuery').on('click',function(){  
       var gsgh = $('#gsgh').val();//工号
       var khphone= $('#khphone').val();//手机
       var kssj= $('#kssj').val();//开始时间
       var jssj= $('#jssj').val();//结束时间
       var khszz=$("option[name='khszz']:checked").val();//所在组
       //alert(kssj);return;

       $.get('index.php?r=khgl/GetShortMessage',{gsgh:gsgh,khphone:khphone,kssj:kssj,jssj:jssj,khszz:khszz},function(data){
            if(!data){
                return;
            }
            listData(data);
        });
	});
});

