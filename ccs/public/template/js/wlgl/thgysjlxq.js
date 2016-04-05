$(function(){
    var orderno = $('#orderno').val(); //订单编号
   $.post('index.php?r=wlgl/ReturnSupplierOrder',{orderno:orderno},function(data){
        listData(data);
    },'json');
});

 //加载列表
 function listData(data){
    $('#getCheckeboxId').empty();
    if(data.result == 'success'){
        var length = data.list.length;
        $('#pagehidden').attr({ page: data.page, psize: data.psize });
        for(var i = 0; i < length; i+=2){
            var a = i+1;
            var listInfo = '';
            var a = i+1;
            listInfo = '<tr class="singular">';
            listInfo += '<td>'+a+'</td>';
            listInfo += '<td><span>'+ data.list[i]['cgac02'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cgac03'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cgac14'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cgac13'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cgac06'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cgac05'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cgac07'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cgac09'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cgac15'] +'</span></td>'
                 + '</tr>';
            if(i != length - 1){
                listInfo += '<tr class="complex">'
                        + '<td>'+(a+1)+'</td>'
                        + '<td><span>'+ data.list[i+1]['cgac02'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cgac03'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cgac14'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cgac13'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cgac06'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cgac05'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cgac07'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cgac09'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cgac15'] +'</span></td>'
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

