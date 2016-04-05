$(function(){
	/**
     * @desc 加载视图后，显示数据
     * @author WuJunhua
     * @date 2015-12-10
     */
    $.post('index.php?r=cwgl/GetReturnOrderList',function(data){
        listData(data);        
    },'json');

});


/**
 * @desc 退换货订单汇总列表获取数据插入节点
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
            var nowTime = '1940-01-01 10:00:00'; //过滤显示时间
            if(data.list[i]['xsaa51'] < nowTime){ 
                data.list[i]['xsaa51'] = '';
            }
            var listInfo = '';
            listInfo = '<tr class="singular">';
            listInfo += '<td><span><a class="canJumpPage" href="index.php?r=cwgl/OrderShipmentOrReturnsDetails&orderno='+data.list[i]['xsaa02']+'">'+ data.list[i]['xsaa02'] +'</a></span></td>'
                    + '<td><span>'+ data.list[i]['xsaa04'] +'</span></td>'
                    + '<td><span>'+ data.list[i]['xsaa13'] +'</span></td>'
                    + '<td><span class="totalPrice">'+ data.list[i]['xsaa19'] +'</span></td>'
                    + '<td><span class="fare">'+ data.list[i]['xsaa16'] +'</span></td>'
                    + '<td><span class="thje">'+ data.list[i]['xsaa44'] +'</span></td>'
                    + '<td><span>'+ data.list[i]['xsaa51'] +'</span></td>'
                    + '<td><span>'+ data.list[i]['xsaa29'] +'</span></td>'
                    + '<td><span>'+ data.list[i]['xsaa41'] +'</span></td>'
                    + '<td><span>'+ data.list[i]['xsaa03'] +'</span></td>'
                    + '<td><span>'+ data.list[i]['xsaa48'] +'</span></td>'
                    + '<td><span>'+ data.list[i]['xsaa60'] +'</span></td>'
                    + '<td><span class="courier">'+ data.list[i]['xsaa57'] +'</span></td>'
                    + '<td><span class="fee">'+ data.list[i]['xsaa58'] +'</span></td>'
                    if(data.list[i]['xsaa56'] == '是'){
            listInfo += '<td><span style="color:#00C78C;">已退</span></td>'
                    }else{
            listInfo += '<td><span><input style="width:50px;" name="" type="button" orderno="'+ data.list[i]['xsaa02'] +'" class="btn refund" value="退款"/></span></td>'
                    }
                    + '</tr>';
            if(i != length - 1){
                 if(data.list[i+1]['xsaa51'] < nowTime){ 
                    data.list[i+1]['xsaa51'] = '';
                }
                listInfo += '<tr class="complex">'
                    + '<td><span><a class="canJumpPage" href="index.php?r=cwgl/OrderShipmentOrReturnsDetails&orderno='+data.list[i+1]['xsaa02']+'">'+ data.list[i+1]['xsaa02'] +'</a></span></td>'
                    + '<td><span>'+ data.list[i+1]['xsaa04'] +'</span></td>'
                    + '<td><span>'+ data.list[i+1]['xsaa13'] +'</span></td>'
                    + '<td><span class="totalPrice">'+ data.list[i+1]['xsaa19'] +'</span></td>'
                    + '<td><span class="fare">'+ data.list[i+1]['xsaa16'] +'</span></td>'
                    + '<td><span class="thje">'+ data.list[i+1]['xsaa44'] +'</span></td>'
                    + '<td><span>'+ data.list[i+1]['xsaa51'] +'</span></td>'
                    + '<td><span>'+ data.list[i+1]['xsaa29'] +'</span></td>'
                    + '<td><span>'+ data.list[i+1]['xsaa41'] +'</span></td>'
                    + '<td><span>'+ data.list[i+1]['xsaa03'] +'</span></td>'
                    + '<td><span>'+ data.list[i+1]['xsaa48'] +'</span></td>'
                    + '<td><span>'+ data.list[i+1]['xsaa60'] +'</span></td>'
                    + '<td><span class="courier">'+ data.list[i+1]['xsaa57'] +'</span></td>'
                    + '<td><span class="fee">'+ data.list[i+1]['xsaa58'] +'</span></td>'
                    if(data.list[i]['xsaa56'] == '是'){
                        listInfo += '<td><span style="color:#00C78C;">已退</span></td>'
                    }else{
                        listInfo += '<td><span><input style="width:50px;" name="" type="button" orderno="'+ data.list[i+1]['xsaa02'] +'" class="btn refund" value="退款"/></span></td>'
                    }
                    + '</tr>';
            }

            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
        var totalPrice = 0; //金额总计
        var fare = 0; //运费
        var thje = 0; //退货金额
        var courier = 0; //快递费
        var fee = 0; //服务费
        $('.totalPrice').each(function(index,item) { 
            totalPrice += parseFloat($(item).text()); 
        });
        $('.fare').each(function(index,item) { 
            fare += parseFloat($(item).text()); 
        });
        $('.thje').each(function(index,item) { 
            thje += parseFloat($(item).text()); 
        });
        $('.courier').each(function(index,item) { 
            courier += parseFloat($(item).text()); 
        });
        $('.fee').each(function(index,item) { 
            fee += parseFloat($(item).text()); 
        });
        $('.page').append('本页金额总计：<span style="color:#ff0000;">'+ totalPrice +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页运费：<span style="color:#ff0000;">'+ fare +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页退货金额总计：<span style="color:#ff0000;">'+ thje +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页快递费：<span style="color:#ff0000;">'+ courier +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页服务费：<span style="color:#ff0000;">'+ fee +'</span>');
    }else{
        $('#getGoodsDetail').empty();
        $('.detailPage').empty();
        var listInfo = '<tr><td colspan="15" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }    
}

/**
 * @desc 退换货订单明细列表获取数据插入节点
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
            var nowTime = '1940-01-01 10:00:00'; //过滤显示时间
            if(data.list[i]['xsaa51'] < nowTime){ 
                data.list[i]['xsaa51'] = '';
            }
            var listInfo = '';
            listInfo = '<tr class="singular">';
            listInfo +=   '<td><span>'+ data.list[i]['xsaa02'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa51'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa13'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa41'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa03'] +'</span></td>'
                        + '<td><span class="thje">'+ data.list[i]['xsab15'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab03'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsab02'] +'</span></td>'
                        + '<td><span class="thsl">'+ data.list[i]['xsab14'] +'</span></td>'
                        if(data.list[i]['xsaa49'] == '退'){
            listInfo +=  '<td><span style="color:#f00;">'+ data.list[i]['xsaa49'] +'</span></td>'
                        }
                        if(data.list[i]['xsaa49'] == '换'){
            listInfo +=  '<td><span style="color:#00f;">'+ data.list[i]['xsaa49'] +'</span></td>'
                        }
                        if(data.list[i]['xsab20'] == '未'){
            listInfo +=  '<td><span style="color:#f00;">'+ data.list[i]['xsab20'] +'</span></td>'
                        }
                        if(data.list[i]['xsab20'] == '已'){
            listInfo +=  '<td><span style="color:#00C78C;">'+ data.list[i]['xsab20'] +'</span></td>'
                        }
                        if(data.list[i]['xsab20'] == '终'){
            listInfo +=  '<td><span style="color:#00f;">'+ data.list[i]['xsab20'] +'</span></td>'
                        }
                        + '</tr>';
            if(i != length - 1){
                if(data.list[i+1]['xsaa51'] < nowTime){ 
                    data.list[i+1]['xsaa51'] = '';
                }
                 listInfo += '<tr class="complex">'
                        + '<td><span>'+ data.list[i+1]['xsaa02'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsaa51'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsaa13'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsaa41'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsaa03'] +'</span></td>'
                        + '<td><span class="thje">'+ data.list[i+1]['xsab15'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab03'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['xsab02'] +'</span></td>'
                        + '<td><span class="thsl">'+ data.list[i+1]['xsab14'] +'</span></td>'
                        if(data.list[i]['xsaa49'] == '退'){
                            listInfo +=  '<td><span style="color:#f00;">'+ data.list[+1]['xsaa49'] +'</span></td>'
                        }
                        if(data.list[i]['xsaa49'] == '换'){
                            listInfo +=  '<td><span style="color:#00f;">'+ data.list[i+1]['xsaa49'] +'</span></td>'
                        }
                        if(data.list[i]['xsab20'] == '未'){
                            listInfo +=  '<td><span style="color:#f00;">'+ data.list[i+1]['xsab20'] +'</span></td>'
                        }
                        if(data.list[i]['xsab20'] == '已'){
                            listInfo +=  '<td><span style="color:#00C78C;">'+ data.list[i+1]['xsab20'] +'</span></td>'
                        }
                        if(data.list[i]['xsab20'] == '终'){
                            listInfo +=  '<td><span style="color:#00f;">'+ data.list[i+1]['xsab20'] +'</span></td>'
                        }
                        + '</tr>';
            }
            $('#getGoodsDetail').append(listInfo);
        }
        $('.detailPage').append(data.pageHtml);
        var thsl = 0; //运费
        var thje = 0; //退货金额
        $('.thsl').each(function(index,item) { 
            thsl += parseFloat($(item).text()); 
        });
        $('.thje').each(function(index,item) { 
            thje += parseFloat($(item).text()); 
        });
        $('.detailPage').append('本页退货总数：<span style="color:#ff0000;">'+ thsl +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页退货金额总计：<span style="color:#ff0000;">'+ thje +'</span>');
    }else{
        $('#getCheckeboxId').empty();
        $('.page').empty();
        var listInfo = '<tr><td colspan="11" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getGoodsDetail').append(listInfo);
    }
}

/**
 * @desc 点击分页后加载汇总数据
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

//财务退款
$('#table5').on('click','.refund',function(){
    var orderid = $(this).attr('orderno');
    var ensure = confirm('确认退款吗？');
    if(ensure){
        $.post('index.php?r=cwgl/OrderRefund',{orderno :orderid},function(data){
            if(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=cwgl/GetThhddHtml";
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
            }
        });
    }

});

//点击加载退货款号汇总列表或退货款号明细列表
/*$('.type').on('click',function(){
    var style = $("input[name='type']:checked").val();
    if(style == 1){
        $.post('index.php?r=cwgl/GetReturnOrderList',function(data){
            listData(data);
        },'json');
    }
    if(style == 2){
        $.post('index.php?r=cwgl/GetReturnOrderDetailsList',function(data){
            detailsListData(data);
        },'json');
    }
});*/

/**
 * @desc 查询退换货订单汇总、明细条件请求
 * @author WuJunhua
 * @date 2016-02-04
 */
function ExchangeOrderData(sign,page,psize){ 
    var fhsjq = $('#fhsjq').val();//发货时间
    var fhsjz = $('#fhsjz').val();
    var thsjq=$('#thsjq').val();//退换时间
    var thsjz=$('#thsjz').val();//
    var ddid=$('#ddid').val();//订单号
    var ddgh=$('#ddgh').val();//工号
    var zffs=$("option[name='zffs']:checked").val(); //支付方式
    var kdgs=$("option[name='kdgs']:checked").val(); //快递公司
    var thdd=$("option[name='thdd']:checked").val(); //退换订单
    var sfrk=$("option[name='sfrk']:checked").val(); //是否入库
    var syz=$("option[name='syz']:checked").val(); //所有组
    var qbdd=$("option[name='qbdd']:checked").val(); //全部订单
    var style = $("input[name='type']:checked").val(); //汇总和明细标识
    var exportExcelSign = $('#exportExcelSign').val(); //导出汇总或明细excel的标识
    
    if(sign == 1){
        if ( $('#inquireSign').val() == 0 ) {
            fhsjq = '';
            fhsjz = '';
        }
        //导出汇总excel
        if(exportExcelSign == 1){
            $.get('index.php?r=cwgl/GetReturnOrderList',{fhsjq:fhsjq,fhsjz:fhsjz,thsjq:thsjq,thsjz:thsjz,ddid:ddid,ddgh:ddgh,zffs:zffs,kdgs:kdgs,thdd:thdd,sfrk:sfrk,syz:syz,qbdd:qbdd,sign:sign,page:page,psize:psize},function(data){
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
            $.get('index.php?r=cwgl/GetReturnOrderDetailsList',{fhsjq:fhsjq,fhsjz:fhsjz,thsjq:thsjq,thsjz:thsjz,ddid:ddid,ddgh:ddgh,zffs:zffs,kdgs:kdgs,thdd:thdd,sfrk:sfrk,syz:syz,qbdd:qbdd,sign:sign,page:page,psize:psize},function(data){
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
                url: "index.php?r=cwgl/GetReturnOrderList",
                async: true,
                data: {fhsjq:fhsjq,fhsjz:fhsjz,thsjq:thsjq,thsjz:thsjz,ddid:ddid,ddgh:ddgh,zffs:zffs,kdgs:kdgs,thdd:thdd,sfrk:sfrk,syz:syz,qbdd:qbdd,sign:sign},
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
                url: "index.php?r=cwgl/GetReturnOrderDetailsList",
                async: true,
                data: {fhsjq:fhsjq,fhsjz:fhsjz,thsjq:thsjq,thsjz:thsjz,ddid:ddid,ddgh:ddgh,zffs:zffs,kdgs:kdgs,thdd:thdd,sfrk:sfrk,syz:syz,qbdd:qbdd,sign:sign},
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
 * @desc 退换货订单汇总、明细查询
 * @author huyan
 * @date 2015-12-25
 */
$('#ReturnQuery').on('click',function(){
    var page = '';
    var psize = '';
    var sign = 0; //查询标识
    ExchangeOrderData(sign,page,psize);
});

/**
 * @desc 导出退换货订单汇总excel
 * @author WuJunhua
 * @date 2015-12-21
 */
 $('body').on('click','#exportExcel1',function(){
    var page = $('#pagehidden').attr('page');
    var psize = $('#pagehidden').attr('psize');
    var sign = 1; //导出excel标识
    ExchangeOrderData(sign,page,psize);
 });

 /**
 * @desc 导出退换货订单明细excel
 * @author WuJunhua
 * @date 2015-12-21
 */
 $('body').on('click','#exportExcel2',function(){
    var page = $('#pagehidden2').attr('page');
    var psize = $('#pagehidden2').attr('psize');
    var sign = 1; //导出excel标识
    ExchangeOrderData(sign,page,psize);
 }); 


function changeStr(str){
    var s = "";
    var order = "";
    //判断表头
    switch(str){
        case "ddh":
            s = "订单号";
            order = "xsaa02";
            break;
        case "khid":
            s = "客户ID";
            order = "xsaa04";
            break;
        case "zffs":
            s = "支付方式";
            order = "xsaa13";
            break;
        case "je":
            s = "金额";
            order = "xsaa19";
            break;  
        case "yf":
            s = "运费";
            order = "xsaa16";
            break;
        case "tje":
            s = "退金额";
            order = "xsaa44";
            break;
        case "thsj":
            s = "退货时间";
            order = "xsaa51";
            break;
        case "zt":
            s = "状态";
            order = "xsaa29";
            break;
        case "kdgs":
            s = "快递公司";
            order = "xsaa03";
            break;
        case "kddh":
            s = "快递单号";
            order = "xsaa41";
            break;   
        case "gh":
            s = "工号";
            order = "xsaa03";
            break;
        case "ly":
            s = "来源";
            order = "xsaa48";
            break;
        case "kdf":
            s = "快递费";
            order = "xsaa57";
            break;
        case "sxf":
            s = "服务费";
            order = "xsaa58";
            break;
    }
    var img = "<img style='width:10px;height:10px' src='public/template/images/arrorDown.png'>";
    var sequence = "DESC";
      

    if($("#"+str).html().indexOf("arrorDown.png") > 0){
        img = "<img style='width:10px;height:10px' src='public/template/images/arrorUp.png'>";
        sequence = "ASC";
    }
    //所有表头还原，点击表头再次更换
    $("#ddh").html("订单号");
    $("#khid").html("客户ID");
    $("#zffs").html("支付方式");
    $("#je").html("金额");
    $("#yf").html("运费");
    $("#tje").html("退金额");
    $("#thsj").html("退货时间");
    $("#zt").html("状态");
    $("#kdgs").html("快递公司");
    $("#kddh").html("快递单号");
    $("#gh").html("工号");
    $("#ly").html("来源");
    $("#kdf").html("快递费");
    $("#sxf").html("服务费");
    $("#"+str).html(img+" "+s);

    var page = $('#pagehidden').attr("page");
    var psize = $('#pagehidden').attr("psize");

    $.post("index.php?r=cwgl/GetReturnOrderList",{page:page,psize:psize,order:order,sequence:sequence},function(data){
        listData(data);
    },"json");
}

        
  



