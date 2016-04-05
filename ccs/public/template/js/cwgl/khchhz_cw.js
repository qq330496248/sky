$(function(){
	/**
     * @desc 加载视图后，显示数据
     * @author WuJunhua
     * @date 2015-12-10
     */
    $.post('index.php?r=cwgl/GetShipmentGoodsList',function(data){
        listData(data);        
    },'json');

});


/**
 * @desc 出货款号汇总列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-12-10
 */
function listData(data){
    $('#table2').css('display','none');   
    $('#table5').css('display','block');
    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data.result == 'success'){
        var length = data.list.length;
        $('#pagehidden').attr({ page: data.page, psize: data.psize });
        for(var i = 0; i < length; i+=2){
            if(data.list[i]['xsab19'] == 0.00){
                data.list[i]['xsab19'] = '';
            }
            var listInfo = '';
            listInfo = '<tr class="singular">';
            listInfo += '<td><span>'+ data.list[i]['xsab03'] +'</span></td>'
                    + '<td><span>'+ data.list[i]['xsab02'] +'</span></td>'
                    + '<td><span class="totalNumber">'+ parseInt(data.list[i]['xsab04']) +'</span></td>'
                    + '<td><span class="totalPrice">'+ data.list[i]['xsab06'] +'</span></td>'
                    + '<td><span>'+ data.list[i]['xsab19'] +'</span></td>'
                    + '</tr>';
            if(i != length - 1){
                listInfo += '<tr class="complex">'
                        + '<td><span>'+ data.list[i+1]['xsab03'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab02'] +'</span></td>'
                        + '<td><span class="totalNumber">'+ parseInt(data.list[i+1]['xsab04']) +'</span></td>'
                        + '<td><span class="totalPrice">'+ data.list[i+1]['xsab06'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab19'] +'</span></td>'
                        + '</tr>';
            }
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
        var totalPrice = 0; //金额总计
        var totalNumber = 0; //总数
        $('.totalPrice').each(function(index,item) { 
            totalPrice += parseFloat($(item).text()); 
        });
        $('.totalNumber').each(function(index,item) { 
            totalNumber += parseFloat($(item).text()); 
        });
        $('.page').append('本页总数：<span style="color:#ff0000;">'+ totalNumber +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页金额总计：<span style="color:#ff0000;">'+ totalPrice +'</span>');
    }else{
        $('#getGoodsDetail').empty();
        $('.detailPage').empty();
        var listInfo = '<tr><td colspan="5" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }  
}

/**
 * @desc 出货款号明细列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-12-10
 */
function detailsListData(data){
    $('#table5').css('display','none');   
    $('#table2').css('display','block');   
    $('#getGoodsDetail').empty();
    $('.detailPage').empty();
    if(data.result == 'success'){
        var length = data.list.length;
        $('#pagehidden2').attr({ page: data.page, psize: data.psize });
        for(var i = 0; i < length; i+=2){
            if(data.list[i]['xsab19'] == 0.00){
                data.list[i]['xsab19'] = '';
            }
            var listInfo = '';
            listInfo = '<tr class="singular">';
            listInfo +=   '<td><span>'+ data.list[i]['xsab01'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab03'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab02'] +'</span></td>'
                        + '<td><span class="totalNumber">'+ parseInt(data.list[i]['xsab04']) +'</span></td>'
                        + '<td><span class="totalPrice">'+ data.list[i]['xsab06'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab19'] +'</span></td>'
                        + '</tr>';
            if(i != length - 1){
                 listInfo += '<tr class="complex">'
                        +   '<td><span>'+ data.list[i+1]['xsab01'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab03'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab02'] +'</span></td>'
                        + '<td><span class="totalNumber">'+ parseInt(data.list[i+1]['xsab04']) +'</span></td>'
                        + '<td><span class="totalPrice">'+ data.list[i+1]['xsab06'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab19'] +'</span></td>'
                        + '</tr>';
            }
            $('#getGoodsDetail').append(listInfo);
        }
        $('.detailPage').append(data.pageHtml);
        var totalPrice = 0; //金额总计
        var totalNumber = 0; //总数
        $('.totalPrice').each(function(index,item) { 
            totalPrice += parseFloat($(item).text()); 
        });
        $('.totalNumber').each(function(index,item) { 
            totalNumber += parseFloat($(item).text()); 
        });
        $('.detailPage').append('本页总数：<span style="color:#ff0000;">'+ totalNumber +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页金额总计：<span style="color:#ff0000;">'+ totalPrice +'</span>');
    }else{
        $('#getCheckeboxId').empty();
        $('.page').empty();
        var listInfo = '<tr><td colspan="6" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getGoodsDetail').append(listInfo);
    }
}

/**
 * @desc 点击分页后加载出货款号汇总数据
 * @author WuJunhua
 * @date 2015-12-10
 */
$('body').on('click','.page a',function(){
    var $this = $(this);
    var $href = $this.attr('href');
    $('#url1').val($href);
    if($href == undefined){
        return;
    }
    $this.attr('href',"javascript:;");
    $.post($href,function(data){
        listData(data);
    });
});

/**
 * @desc 点击分页后加载出货款号明细数据
 * @author WuJunhua
 * @date 2015-12-10
 */
$('body').on('click','.detailPage a',function(){
    var $this = $(this);
    var $href = $this.attr('href');
    $('#url2').val($href);
    if($href == undefined){
        return;
    }
    $this.attr('href',"javascript:;");
    $.post($href,function(data){
        detailsListData(data);
    });
});


//点击加载退货款号汇总列表或退货款号明细列表
/*$('.type').on('click',function(){
    var style = $("input[name='type']:checked").val();
    if(style == 1){
        $.post('index.php?r=cwgl/GetShipmentGoodsList',function(data){
            listData(data);
        },'json');
    }
    if(style == 2){
        $.post('index.php?r=cwgl/GetShipmentGoodsDetailsList',function(data){
            detailsListData(data);
        },'json');
    }
});*/

/**
 * @desc 查询款号出货汇总、明细条件请求
 * @author WuJunhua
 * @date 2016-02-04
 */
function ReturnStyleData(sign,page,psize){ 
    var xdsjq = $('#xdsjq').val();//下单时间
    var xdsjz=$('#xdsjz').val();
    var fhsjq=$('#fhsjq').val();//发货时间
    var fhsjz=$('#fhsjz').val();//
    var shsjq=$('#shsjq').val();//收货时间
    var shsjz=$('#shsjz').val();//
    var thsjq=$('#thsjq').val();//退货时间
    var thsjz=$('#thsjz').val();//

    var cpkh=$('#cpkh').val();//款号
    var ddid=$('#ddid').val();//订单号
    var ddgh=$('#ddgh').val();//工号
    var khzt=$("option[name='khzt']:checked").val(); //款号状态
    var ddzt=$("option[name='ddzt']:checked").val(); //订单状态
    var gys=$("option[name='gys']:checked").val(); //供应商
    var szz=$("option[name='szz']:checked").val(); //所有组
    var khly=$("option[name='khly']:checked").val();//来源
    var style = $("input[name='type']:checked").val(); //汇总和明细标识
    var exportExcelSign = $('#exportExcelSign').val(); //导出汇总或明细excel的标识

    if(sign == 1){
        if ( $('#inquireSign').val() == 0 ) {
            fhsjq = '';
            fhsjz = '';
        }
        //导出汇总excel
        if(exportExcelSign == 1){
            $.get('index.php?r=cwgl/GetShipmentGoodsList',{xdsjq:xdsjq,xdsjz:xdsjz,fhsjq:fhsjq,fhsjz:fhsjz,shsjq:shsjq,shsjz:shsjz,thsjq:thsjq,thsjz:thsjz,khzt:khzt,ddzt:ddzt,gys:gys,szz:szz,khly:khly,cpkh:cpkh,ddid:ddid,ddgh:ddgh,sign:sign,page:page,psize:psize},function(data){
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
            //导出明细excel
            $.get('index.php?r=cwgl/GetShipmentGoodsDetailsList',{xdsjq:xdsjq,xdsjz:xdsjz,fhsjq:fhsjq,fhsjz:fhsjz,shsjq:shsjq,shsjz:shsjz,thsjq:thsjq,thsjz:thsjz,khzt:khzt,ddzt:ddzt,gys:gys,szz:szz,khly:khly,cpkh:cpkh,ddid:ddid,ddgh:ddgh,sign:sign,page:page,psize:psize},function(data){
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
        }

    }else{
        if(style == 1){
            //查询出货款号汇总条件请求
            $.ajax({
                type: "get",
                url: "index.php?r=cwgl/GetShipmentGoodsList",
                async: true,
                data: {xdsjq:xdsjq,xdsjz:xdsjz,fhsjq:fhsjq,fhsjz:fhsjz,shsjq:shsjq,shsjz:shsjz,thsjq:thsjq,thsjz:thsjz,khzt:khzt,ddzt:ddzt,gys:gys,szz:szz,khly:khly,cpkh:cpkh,ddid:ddid,ddgh:ddgh,sign:sign},
                success: function(data){
                    if(!data){
                        return;
                    }
                    $('#inquireSign').val(1);
                    $('#exportExcelSign').val(1);
                    listData(data);
                }
            });
        }else{
            //查询出货款号明细条件请求
            $.ajax({
                type: "get",
                url: "index.php?r=cwgl/GetShipmentGoodsDetailsList",
                async: true,
                data: {xdsjq:xdsjq,xdsjz:xdsjz,fhsjq:fhsjq,fhsjz:fhsjz,shsjq:shsjq,shsjz:shsjz,thsjq:thsjq,thsjz:thsjz,khzt:khzt,ddzt:ddzt,gys:gys,szz:szz,khly:khly,cpkh:cpkh,ddid:ddid,ddgh:ddgh,sign:sign},
                success: function(data){
                    if(!data){
                        return;
                    }
                    $('#inquireSign').val(1);
                    $('#exportExcelSign').val(2);
                    detailsListData(data);
                }
            });
        }
    }
}

/**
 * @desc 款号出货汇总和明细查询
 * @author huyan
 * @date 2015-12-23
 */
$('#chaxunmxhz').on('click',function(){
    var page = '';
    var psize = '';
    var sign = 0; //查询标识
    ReturnStyleData(sign,page,psize);
});

/**
 * @desc 导出款号出货汇总excel
 * @author WuJunhua
 * @date 2015-12-21
 */
 $('body').on('click','#exportExcel1',function(){
    var page = $('#pagehidden').attr('page');
    var psize = $('#pagehidden').attr('psize');
    var sign = 1; //导出excel标识
    ReturnStyleData(sign,page,psize);
 });

 /**
 * @desc 导出款号出货明细excel
 * @author WuJunhua
 * @date 2015-12-21
 */
 $('body').on('click','#exportExcel2',function(){
    var page = $('#pagehidden2').attr('page');
    var psize = $('#pagehidden2').attr('psize');
    var sign = 1; //导出excel标识
    ReturnStyleData(sign,page,psize);
 });  


