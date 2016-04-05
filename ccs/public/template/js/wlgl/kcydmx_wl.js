$(function(){
    /**
     * @desc 加载视图后，显示数据
     * @author WuJunhua
     * @date 2015-11-05
     */
    $.post('index.php?r=wlgl/GetProductWarehousingRecording',function(data){
        listData(data);
    },'json');

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-12-31
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

/**
 * @desc 入库记录列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-12-31
 */
function listData(data,str,img,s){
    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data.result == 'success'){
        $("#sequence").val(data.sequence);
        $("#order").val(data.order);
        $('#pagehidden').attr({ page: data.page, psize: data.psize });
        var nowTime = '1940-10-01 10:00:00';
        var length = data.list.length;
        for(var i = 0; i < length; i+=2){
            var listInfo = '';
            if(data.list[i]['cpaf07'] < nowTime){
                data.list[i]['cpaf07'] = '';
            }
            if(data.list[i]['cpaf12'] == 0.00){
                data.list[i]['cpaf12'] = '';
            }
            listInfo = '<tr class="singular">';
            listInfo +=   '<td><span>'+ data.list[i]['cpaf02'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpaa01'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpaa02'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpaf16'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpaf08'] +'</span></td>' 
                        + '<td><span>'+ data.list[i]['cpaf05'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpaf07'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpaf09'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpaf14'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpaf12'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpaf10'] +'</span></td>'
                        + '</tr>';
            if(i != length - 1){
                if(data.list[i+1]['cpaf07'] < nowTime){
                    data.list[i+1]['cpaf07'] = '';
                }
                if(data.list[i+1]['cpaf12'] == 0.00){
                    data.list[i+1]['cpaf12'] = '';
                }
                 listInfo += '<tr class="complex">'
                        + '<td><span>'+ data.list[i+1]['cpaf02'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpaa01'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpaa02'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpaf16'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpaf08'] +'</span></td>' 
                        + '<td><span>'+ data.list[i+1]['cpaf05'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpaf07'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpaf09'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpaf14'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpaf12'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpaf10'] +'</span></td>'
                        + '</tr>';
            }
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
    }else{
        var listInfo = '<tr><td colspan="12" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }
}

/**
 * @desc 查询退货订单记录条件请求
 * @author WuJunhua
 * @date 2016-02-03
 */
function ReturnOrderData(sign,page,psize){ 
    var rkpc = $('#rkpc').val();//批次
    var rkgys=$('#rkgys').val();//供应商
    var rcsjq=$('#rcsjq').val();//出入仓时间
    var rcsjz=$('#rcsjz').val();
    var rkcw=$('#rkcw').val();//仓位

   if(sign == 1){
    if ($('#inquireSign').val() == 0 ) {
            rcsjq = '';
            rcsjz = '';
        }

        $.get('index.php?r=wlgl/GetProductWarehousingRecording',{rkpc:rkpc,rkgys:rkgys,rcsjq:rcsjq,rcsjz:rcsjz,rkcw:rkcw,sign:sign,page:page,psize:psize},function(data){
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
   }else{
        $.ajax({
            type: "get",
            url: "index.php?r=wlgl/GetProductWarehousingRecording",
            async: true,
            data: {rkpc:rkpc,rkgys:rkgys,rcsjq:rcsjq,rcsjz:rcsjz,rkcw:rkcw,sign:sign},
            success: function(data){
                if(!data){
                    return;
                }
                $('#inquireSign').val(1);
                listData(data);
            }
        });
   }
   
}

/**
 * @desc 退货订单记录查询
 * @author huyan
 * @date 2015-12-11
 */
$('#ReturnOrderQuery').on('click',function(){
    var page = '';
    var psize = '';
    var sign = 0; //查询标识
    ReturnOrderData(sign,page,psize);
});

/**
 * @desc 导出excel
 * @author WuJunhua
 * @date 2015-12-31
 */
 $('body').on('click','#exportExcel',function(){
    var page = $('#pagehidden').attr('page');
    var psize = $('#pagehidden').attr('psize');
    var sign = 1; //导出excel标识
    ReturnOrderData(sign,page,psize);
 });


});