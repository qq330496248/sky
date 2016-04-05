$(function(){
    /**
     * @desc 加载视图后，显示数据
     * @author WuJunhua
     * @date 2016-03-11
     */
    $.post('index.php?r=wlgl/GetReturnSupplierRecordList',function(data){
        listData(data);
    },'json');

});

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2016-03-11
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
 * @desc 查询退货供应商记录条件请求
 * @author WuJunhua
 * @date 2016-03-11
 */
function ReturnOrderData(sign,page,psize){
    var cgdh = $('#cgdh').val(); //采购单号
    var ddsjq=$('#ddsjq').val();//下单时间
    var ddsjz=$('#ddsjz').val();//下单时间（到）
    var rcsjq=$('#rcsjq').val();///退货时间
    var rcsjz=$('#rcsjz').val();///退货时间(到)
    var gys=$("option[name='gys']:checked").val();//供应商
   if(sign == 1){
        if ($('#inquireSign').val() == 0 ) {
            rcsjq = '';
            rcsjq = '';
        }
        $.get('index.php?r=wlgl/GetReturnSupplierRecordList',{cgdh:cgdh,ddsjq:ddsjq,ddsjz:ddsjz,rcsjq:rcsjq,rcsjz:rcsjz,gys:gys,sign:sign,page:page,psize:psize},function(data){
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
        $.get('index.php?r=wlgl/GetReturnSupplierRecordList',{cgdh:cgdh,ddsjq:ddsjq,ddsjz:ddsjz,rcsjq:rcsjq,rcsjz:rcsjz,gys:gys,sign:sign},function(data){
            if(!data){
                return;
            }
            $('#inquireSign').val(1);
            listData(data);
        });
   }
   
}

/**
 * @desc 退货供应商记录查询
 * @author WuJunhua
 * @date 2016-03-11
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
 * @date 2016-03-11
 */
 $('body').on('click','#exportExcel',function(){
    var page = $('#pagehidden').attr('page');
    var psize = $('#pagehidden').attr('psize');
    var sign = 1; //导出excel标识
    ReturnOrderData(sign,page,psize);
 });

/**
 * @desc 退货供应商记录列表获取数据插入节点
 * @author WuJunhua
 * @date 2016-03-11
 */
function listData(data){
    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data.result == 'success'){
        $('#pagehidden').attr({ page: data.page, psize: data.psize });
        var length = data.list.length;
        for(var i = 0; i < length; i+=2){
            var listInfo = '';
            listInfo = '<tr class="singular">';
            listInfo +=   '<td><a class="canJumpPage" href="index.php?r=wlgl/GetThgysjlxqHtml&orderno='+data.list[i]['cgaa01']+'">'+ data.list[i]['cgaa01'] +'</a></td>'
                        + '<td><span>'+ data.list[i]['cgaa09'] +'</span></td>'
                        + '<td><span class="totalNumber">'+ data.list[i]['cgaa16'] +'</span></td>'
                        + '<td><span class="totalPrice">'+ data.list[i]['cgaa15'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cgaa05'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cgaa06'] +'</span></td>' 
                        + '<td><span>'+ data.list[i]['cgaa17'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cgaa18'] +'</span></td>'
                        + '</tr>';
            if(i != length - 1){
                listInfo += '<tr class="complex">'
                        + '<td><a class="canJumpPage" href="index.php?r=wlgl/GetThgysjlxqHtml&orderno='+data.list[i+1]['cgaa01']+'">'+ data.list[i+1]['cgaa01'] +'</a></td>'
                        + '<td><span>'+ data.list[i+1]['cgaa09'] +'</span></td>'
                        + '<td><span class="totalNumber">'+ data.list[i+1]['cgaa16'] +'</span></td>'
                        + '<td><span class="totalPrice">'+ data.list[i+1]['cgaa15'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cgaa05'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cgaa06'] +'</span></td>' 
                        + '<td><span>'+ data.list[i+1]['cgaa17'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cgaa18'] +'</span></td>'
                        + '</tr>';
            }
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
        var totalPrice = 0; //金额总计
        var totalNumber = 0; //数量总计
        $('.totalPrice').each(function(index,item) { 
            totalPrice += parseFloat($(item).text()); 
        });
        $('.totalNumber').each(function(index,item) { 
            totalNumber += parseFloat($(item).text()); 
        });
        $('.page').append('本页退货总数：<span style="color:#ff0000;">'+ totalNumber +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页退货金额总计：<span style="color:#ff0000;">'+ totalPrice +'</span>');
    }else{
        var listInfo = '<tr><td colspan="10" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }
}
