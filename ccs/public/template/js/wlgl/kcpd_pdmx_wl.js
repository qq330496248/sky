$(function(){
	/*
	 * @desc 加载视图后，显示数据
	 * @author WuJunhua
	 * @date 2015-11-30
	 */
	$.post('index.php?r=wlgl/GetInventoryOrderList',function(data){
		listData(data);
	},'json');

});

/*
 * @desc 盘点明细列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-12-01
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
            listInfo += '<td><span><input type="hidden" value="'+ data[i]['pdab01'] +'" name="goodItems"/>'+ data[i]['pdab01'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['pdab02'] +'" name="goodItems"/>'+ data[i]['pdab02'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['pdab03'] +'" name="goodItems"/>'+ data[i]['pdab03'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['pdab11'] +'" name="goodItems"/>'+ data[i]['pdab11'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['pdab04'] +'" name="goodItems"/>'+ data[i]['pdab04'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['pdab07'] +'" name="goodItems"/>'+ data[i]['pdab07'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['pdab05'] +'" name="goodItems"/>'+ data[i]['pdab05'] +'/'+ data[i]['pdab06'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['pdab10'] +'" name="goodItems"/>'+ data[i]['pdab10'] +'</span></td>'
                        + '</tr>';
            if(i != length - 1){
                 listInfo += '<tr class="complex">'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['pdab01'] +'" name="goodItems"/>'+ data[i+1]['pdab01'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['pdab02'] +'" name="goodItems"/>'+ data[i+1]['pdab02'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['pdab03'] +'" name="goodItems"/>'+ data[i+1]['pdab03'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['pdab11'] +'" name="goodItems"/>'+ data[i+1]['pdab11'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['pdab04'] +'" name="goodItems"/>'+ data[i+1]['pdab04'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['pdab07'] +'" name="goodItems"/>'+ data[i+1]['pdab07'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['pdab05'] +'" name="goodItems"/>'+ data[i+1]['pdab05'] +'/'+ data[i+1]['pdab06'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['pdab10'] +'" name="goodItems"/>'+ data[i+1]['pdab10'] +'</span></td>'
                        + '</tr>';
            }
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
    }  
}

/**
 * @desc 导出excel
 * @author WuJunhua
 * @date 2015-12-18
 */
 $('body').on('click','#exportExcel',function(){
    var sign = 1; //导出excel标识
    $.post('index.php?r=wlgl/GetInventoryOrderList',{sign:sign},function(data){
        if(!data){
            return;
        }
        if(data.result == 'error'){
            alert(data.msg);
            return;
        }
        if(data.result == 'exportExcel'){
            idownload(data.url);
            //导出excel成功后，要清除服务器上的xls文件
            $.post('index.php?r=xtsz/DeleteExcelFile',{url:data.url},function(data){

            });
        }
    });   
 });

