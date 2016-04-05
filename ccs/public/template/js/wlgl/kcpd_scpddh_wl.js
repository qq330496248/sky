$(function(){
	/*
	 * @desc 加载视图后，显示数据
	 * @author WuJunhua
	 * @date 2015-11-30
	 */
	$.post('index.php?r=wlgl/GetInventoryCheckList',function(data){
		listData(data);
	},'json');

});

/*
 * @desc 生产盘点单号列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-11-30
 */
 function listData(data){
    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data){
        $('#getCheckeboxId').empty();
        var length = data.length;
        for(var i = 0; i < length; i+=2){
            var listInfo = '';
            listInfo = '<tr class="singular">';
            listInfo += '<td><span><input type="hidden" value="'+ data[i]['cpae01'] +'" name="goodItems"/>'+ data[i]['cpae01'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['cpaa01'] +'" name="goodItems"/>'+ data[i]['cpaa01'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['cpaa02'] +'" name="goodItems"/>'+ data[i]['cpaa02'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['cpaa10'] +'" name="goodItems"/>'+ data[i]['cpaa10'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['cpae12'] +'" name="goodItems"/>'+ data[i]['cpae12'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['cpae03'] +'" name="goodItems"/>'+ data[i]['cpae03'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['cpae06'] +'" name="goodItems"/>'+ data[i]['cpae06'] +'</span></td>'
                        + '</tr>';
            if(i != length - 1){
            	listInfo += '<tr class="complex">'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['cpae01'] +'" name="goodItems"/>'+ data[i+1]['cpae01'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['cpaa01'] +'" name="goodItems"/>'+ data[i+1]['cpaa01'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['cpaa02'] +'" name="goodItems"/>'+ data[i+1]['cpaa02'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['cpaa10'] +'" name="goodItems"/>'+ data[i+1]['cpaa10'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['cpae12'] +'" name="goodItems"/>'+ data[i+1]['cpae12'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['cpae03'] +'" name="goodItems"/>'+ data[i+1]['cpae03'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['cpae06'] +'" name="goodItems"/>'+ data[i+1]['cpae06'] +'</span></td>'
                        + '</tr>';
            }
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
    }  
}

/*
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-11-30
 */

$('body').on('click','.page a',function(){
	var $this = $(this);
	var $href = $this.attr('href');
	if($href == undefined){
		return;
	}
	$this.attr('href',"javascript:;");
	$.post($href,function(data){
		listDate(data);
	});
});

//生成盘点单号
$('.forminfo').on('click','#generateInventoryOrder',function(){
	var goodsItems = [];
	$('.goodline').find("input[name='goodItems']").each(function(index,item){
        goodsItems.push($(item).val());   
    });
	var choiceNum = goodsItems.length;
	if(!choiceNum){
		alert('操作有误，请重新操作');
		return;
	}
	$.post('index.php?r=wlgl/GenerateInventoryOrder',{goodsItems:goodsItems},function(data){
	    if(data){
		    if(data.res == 'success'){
		        alert(data.msg);
		        return;
		    }
	    	if(data.res == 'error'){
		        alert(data.msg);
		        return;
		    }
	    }
	},'json');
});
