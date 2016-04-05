$(function(){
    var nowTime = '1940-11-10 18:00:00';  //处理页面显示的时间

    /**
     * @desc 加载视图后，显示数据
     * @author WuJunhua
     * @date 2015-11-05
     */
    $.post('index.php?r=wlgl/GetReturnGoodsSummaryList',function(data){
        listData(data);
    },'json');

/**
 * @desc 退货款号明细列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-11-26
 */
function detailsListData(data){
    $('#getGoodsDetail').empty();
    $('.detailPage').empty();
    $('#table1').css('display','none');   
    $('#table2').css('display','block');   
    if(data.result == 'success'){
        $('#pagehidden2').attr({ page: data.page, psize: data.psize });
        var length = data.list.length;
        for(var i = 0; i < length; i+=2){
            if(data.list[i]['xsab17'] < nowTime){
                data.list[i]['xsab17'] = '';
            }
            var listInfo = '';
            listInfo = '<tr class="singular">';
            listInfo +=   '<td><span>'+ data.list[i]['xsab01'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab03'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab02'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab14'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab15'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab19'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab17'] +'</span></td>'
                        + '</tr>';
            if(i != length - 1){
                if(data.list[i+1]['xsab17'] < nowTime){
                    data.list[i+1]['xsab17'] = '';
                }
                listInfo += '<tr class="complex">'
                        + '<td><span>'+ data.list[i+1]['xsab01'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab03'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab02'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab14'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab15'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab19'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab17'] +'</span></td>'
                        + '</tr>'; 
            }
            $('#getGoodsDetail').append(listInfo);
        }
        $('.detailPage').append(data.pageHtml);
    }else{
        $('#getCheckeboxId').empty();
        $('.page').empty();
        var listInfo = '<tr><td colspan="7" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getGoodsDetail').append(listInfo);
    }
}

//点击加载退货款号汇总列表或退货款号明细列表
/*$('.type').on('click',function(){
    var style = $("input[name='type']:checked").val();
    if(style == 1){
        $.post('index.php?r=wlgl/GetReturnGoodsSummaryList',function(data){
            listData(data);
        },'json');
    }
    if(style == 2){
        $.post('index.php?r=wlgl/GetReturnGoodsDetailsList',function(data){
            detailsListData(data);
        },'json');
    }
});*/

/**
 * @desc 查询退货款号汇总、明细条件请求
 * @author WuJunhua
 * @date 2016-02-03
 */
function ReturnStyleData(sign,page,psize){ 
    var cpmc = $('#cpmc').val(); //名称
    var cpkh=$('#cpkh').val(); //款号
    var rcsjq=$('#rcsjq').val(); //入仓时间
    var rcsjz=$('#rcsjz').val(); //入仓时间
    var ddid=$('#ddid').val(); //订单id
    var gysid=$('#gysid').val(); //供应商id
    var kdgs=$("option[name='kdgs']:checked").val(); //快递公司
    var zffs=$("option[name='zffs']:checked").val(); //支付方式
    var syz=$("option[name='syz']:checked").val(); //所有组
    var style = $("input[name='type']:checked").val(); //
    var exportExcelSign = $('#exportExcelSign').val(); //导出汇总或明细excel的标识

    if(sign == 1){
        if ( $('#inquireSign').val() == 0 ) {
            rcsjq = '';
            rcsjz = '';
        }
        //导出汇总excel
        if(exportExcelSign == 1){
            $.get('index.php?r=wlgl/GetReturnGoodsSummaryList',{cpmc:cpmc,cpkh:cpkh,rcsjq:rcsjq,rcsjz:rcsjz,ddid:ddid,gysid:gysid,kdgs:kdgs,zffs:zffs,syz:syz,sign:sign,page:page,psize:psize},function(data){
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
            $.get('index.php?r=wlgl/GetReturnGoodsDetailsList',{cpmc:cpmc,cpkh:cpkh,rcsjq:rcsjq,rcsjz:rcsjz,ddid:ddid,gysid:gysid,kdgs:kdgs,zffs:zffs,syz:syz,sign:sign,page:page,psize:psize},function(data){
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
            //查询退换货订单汇总条件请求
            $.ajax({
                type: "get",
                url: "index.php?r=wlgl/GetReturnGoodsSummaryList",
                async: true,
                data: {cpmc:cpmc,cpkh:cpkh,rcsjq:rcsjq,rcsjz:rcsjz,ddid:ddid,gysid:gysid,kdgs:kdgs,zffs:zffs,syz:syz,sign:sign},
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
            //查询退换货订单明细条件请求
            $.ajax({
                type: "get",
                url: "index.php?r=wlgl/GetReturnGoodsDetailsList",
                async: true,
                data: {cpmc:cpmc,cpkh:cpkh,rcsjq:rcsjq,rcsjz:rcsjz,ddid:ddid,gysid:gysid,kdgs:kdgs,zffs:zffs,syz:syz,sign:sign},
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


    /*//查询退货款号汇总条件请求
    if(style == 1){
       if(sign == 1){
            if ($('#inquireSign').val() == 0 ) {
                rcsjq = '';
                rcsjz = '';
            }

            $.get('index.php?r=wlgl/GetReturnGoodsSummaryList',{cpmc:cpmc,cpkh:cpkh,rcsjq:rcsjq,rcsjz:rcsjz,ddid:ddid,gysid:gysid,kdgs:kdgs,zffs:zffs,syz:syz,sign:sign,page:page,psize:psize},function(data){
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
                url: "index.php?r=wlgl/GetReturnGoodsSummaryList",
                async: true,
                data: {cpmc:cpmc,cpkh:cpkh,rcsjq:rcsjq,rcsjz:rcsjz,ddid:ddid,gysid:gysid,kdgs:kdgs,zffs:zffs,syz:syz,sign:sign},
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
    
    //查询退货款号明细条件请求
    if(style == 2){
       if(sign == 1){
            if ($('#inquireSign').val() == 0 ) {
                rcsjq = '';
                rcsjz = '';
            }
            $.get('index.php?r=wlgl/GetReturnGoodsDetailsList',{cpmc:cpmc,cpkh:cpkh,rcsjq:rcsjq,rcsjz:rcsjz,ddid:ddid,gysid:gysid,kdgs:kdgs,zffs:zffs,syz:syz,sign:sign,page:page,psize:psize},function(data){
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
                url: "index.php?r=wlgl/GetReturnGoodsDetailsList",
                async: true,
                data: {cpmc:cpmc,cpkh:cpkh,rcsjq:rcsjq,rcsjz:rcsjz,ddid:ddid,gysid:gysid,kdgs:kdgs,zffs:zffs,syz:syz,sign:sign},
                success: function(data){
                    if(!data){
                        return;
                    }
                    $('#inquireSign').val(1);
                    detailsListData(data);
                }
            });
       }
    }*/
}

/**
 * @desc 退货款号汇总和明细查询
 * @author huyan
 * @date 2015-12-10
 */
$('body').on('click','#NumberInquiry',function(){
    var page = '';
    var psize = '';
    var sign = 0; //查询标识
    ReturnStyleData(sign,page,psize);
});

/**
 * @desc 导出退货款号汇总excel
 * @author WuJunhua
 * @date 2015-12-17
 */
 $('body').on('click','#exportExcel1',function(){
    var page = $('#pagehidden').attr('page');
    var psize = $('#pagehidden').attr('psize');
    var sign = 1; //导出excel标识
    ReturnStyleData(sign,page,psize);
 });

 /**
 * @desc 导出退货款号明细excel
 * @author WuJunhua
 * @date 2015-12-17
 */
 $('body').on('click','#exportExcel2',function(){
    var page = $('#pagehidden2').attr('page');
    var psize = $('#pagehidden2').attr('psize');
    var sign = 1; //导出excel标识
    ReturnStyleData(sign,page,psize);
 });

/**
 * @desc 点击分页后加载汇总数据
 * @author WuJunhua
 * @date 2015-11-26
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
 * @desc 点击分页后加载明细数据
 * @author WuJunhua
 * @date 2015-11-26
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

/**
 * @desc 退货款号汇总列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-11-26
 */
function listData(data,str,img,s){//DSC新增参数
    $("#kh").html("款号");
    $("#cpm").html("产品名");
    $("#rks").html("入库数");
    $("#ze").html("总额");
    $("#cb").html("成本");
    $("#" + str).html(img+s);

    $('#getCheckeboxId').empty();
    $('.page').empty();
    $('#table2').css('display','none');   
    $('#table1').css('display','block');
    if(data.result == 'success'){
        $("#sequence").val(data.sequence);
        $("#order").val(data.order);
        $('#pagehidden').attr({ page: data.page, psize: data.psize });
        var length = data.list.length;
        for(var i = 0; i < length; i+=2){
            var listInfo = '';
            listInfo = '<tr class="singular">';
            listInfo +=   '<td><span>'+ data.list[i]['xsab03'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab02'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab14'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab15'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab19'] +'</span></td>'
                        + '</tr>';
             if(i != length - 1){
                listInfo += '<tr class="complex">'
                        + '<td><span>'+ data.list[i+1]['xsab03'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab02'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab14'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab15'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab19'] +'</span></td>'
                        + '</tr>';
             }
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
    }else{
        $('#getGoodsDetail').empty();
        $('.detailPage').empty();
        var listInfo = '<tr><td colspan="5" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }
    
}



//根据不同表头变换顺序，并加入箭头图标
function changeStr(str){
    var s = "";
    var order = "";
    //判断表头
    switch(str){
        case "kh":
            s = "款号";
            order = "xsab03";
            break;
        case "cpm":
            s = "产品名";
            order = "xsab02";
            break;
        case "rks":
            s = "入库数";
            order = "xsab14";
            break;
        case "ze":
            s = "总额";
            order = "xsab15";
            break;
        case "cb":
            s = "成本";
            order = "xsab19";
            break;
    }
    var img = "<img style='width:10px;height:10px' src='public/template/images/arrorDown.png'>";
    var sequence = "DESC";
    if($("#"+str).html().indexOf("arrorDown.png") > 0){
        img = "<img style='width:10px;height:10px' src='public/template/images/arrorUp.png'>";
        sequence = "ASC";
    }
    var page = $('#pagehidden').attr("page");
    var psize = $('#pagehidden').attr("psize");
    $.post('index.php?r=wlgl/GetReturnGoodsSummaryList&page='+page+'&psize='+psize,{sequence :sequence,order:order},function(data){
        listData(data,str,img,s);
    },'json');
}

});
