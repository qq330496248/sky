$(function(){
	/**
     * @desc 加载视图后，显示数据
     * @author WuJunhua
     * @date 2015-11-17
     */
    var hpage = $('#historyPages').attr('page'); //历史页码
    var hpsize = $('#historyPages').attr('psize'); //历史显示条数
    //if(hpage != 0){
        $.post('index.php?r=wlgl/GetLogisticsDeliveryList',function(data){
            listData(data);
            //全选(全不选)特效
            checkAll($('#checkall'),$('.checkbox')); 
        },'json');
    //}

});

/**
 * @desc 待发货订单列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-11-13
 */
function listData(data){
    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data.result == 'success'){
        var length = data.list.length;
        $('#pagehidden').attr({ page: data.page, psize: data.psize });
        var nowTime = '1940-01-01 10:00:00';  
        for(var i = 0; i < length; i+=2){
            //让默认时间显示为空
            if(data.list[i]['xsaa25'] < nowTime){ 
                data.list[i]['xsaa25'] = '';
            }
            if(!data.list[i]['xsaa25']){
                data.list[i]['xsaa25'] = '';
            }
            var listInfo = '';
            listInfo = '<tr class="singular">';
            listInfo += '<td><span><input class="orderno checkbox" style="margin-right:5px;" type="checkbox" orderno="'+ data.list[i]['xsaa02'] +'"  value="'+ data.list[i]['xsaa02'] +'" /><a class="canJumpPage" href="index.php?r=wlgl/OrderDetails&orderno='+data.list[i]['xsaa02']+'&ordernum='+data.list[i]['xsaa01']+'&page='+ data.page +'&psize='+ data.psize +'">'+ data.list[i]['xsaa02'] +'</a></span></td>'
                        + '<td><span>'+ data.list[i]['xsaa05'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa23'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa25'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa29'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa41'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa03'] +'</span></td>'
                        + '<td><span><a href="public/template/grfUtils/General/data/xmlChuHuodan.php?id='+ data.list[i]['xsaa02'] +'" target="_blank"><font style="color:blue;">出</font></a>&nbsp;<font style="color:#FE007F;">||</font>&nbsp;<font>快</font></span></td>'
                        + '<td><span>'+ data.list[i]['xsaa13'] +'</span></td>'
                        + '<td><span class="totalPrice">'+ data.list[i]['xsaa19'] +'</span></td>'
                        + '<td style="width:350px;"><span>'+ data.list[i]['xsaa36'] +'</span></td>'
                        + '<td><input style="width:50px;" name="" type="button" class="btn shipped" orderno="'+ data.list[i]['xsaa02'] +'" value="发货"/></td>'
                        + '</tr>';
                        if(i != length - 1){
                             if(data.list[i+1]['xsaa25'] < nowTime){ 
                                data.list[i+1]['xsaa25'] = '';
                            }
                            if(!data.list[i+1]['xsaa25']){
                                data.list[i+1]['xsaa25'] = '';
                            }
                            listInfo += '<tr class="complex">'
                            +'<td><span><input class="orderno checkbox" style="margin-right:5px;" type="checkbox" orderno="'+ data.list[i+1]['xsaa02'] +'"  value="'+ data.list[i+1]['xsaa02'] +'" /><a class="canJumpPage" href="index.php?r=wlgl/OrderDetails&orderno='+data.list[i+1]['xsaa02']+'&ordernum='+data.list[i+1]['xsaa01']+'&page='+ data.page +'&psize='+ data.psize +'">'+ data.list[i+1]['xsaa02'] +'</a></span></td>'
                            + '<td><span>'+ data.list[i+1]['xsaa05'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['xsaa23'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['xsaa25'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['xsaa29'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['xsaa41'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['xsaa03'] +'</span></td>'
                            + '<td><span><a href="publi+1c/template/grfUtils/General/data/xmlChuHuodan.php?id='+ data.list[i+1]['xsaa02'] +'" target="_blank"><font style="color:blue;">出</font></a>&nbsp;<font style="color:#FE007F;">||</font>&nbsp;<font>快</font></span></td>'
                            + '<td><span>'+ data.list[i+1]['xsaa13'] +'</span></td>'
                            + '<td><span class="totalPrice">'+ data.list[i+1]['xsaa19'] +'</span></td>'
                            + '<td style="width:350px;"><span>'+ data.list[i+1]['xsaa36'] +'</span></td>'
                            + '<td><input style="width:50px;" name="" type="button" class="btn shipped" orderno="'+ data.list[i+1]['xsaa02'] +'" value="发货"/></td>'
                            + '</tr>';
                        }
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
        var totalPrice = 0; //金额总计
        $('.totalPrice').each(function(index,item) { 
            totalPrice += parseFloat($(item).text()); 
        });
        $('.page').append('本页金额总计：<span style="color:#ff0000;">'+ totalPrice +'</span>');
    }else{
        var listInfo = '<tr><td colspan="12" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }  
}

//批量确认发货
$('body').on('click','#batchArragin',function(){
    var orderno = [];
    $('.checkbox:checked').each(function(index,item){
        orderno.push($(item).attr('orderno'));  
    });

    if(orderno.length == 0){
        alert('请选择要发货的订单');
        return;
    }
    var ensure = confirm('真的确认发货吗？');
    if(ensure){
        $.post('index.php?r=wlgl/ConfirmShipped',{orderno :orderno},function(data){
            if(!data){
                return;
            }
            if(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=wlgl/GetWlfhHtml";
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
            }
        },'json');
        
    }
});

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-11-13
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
        //全选(全不选)特效
        checkAll($('#checkall'),$('.checkbox'));
    });
});

//单个订单发货
$('#table5').on('click','.shipped',function(){
    var orderid = [$(this).attr('orderno')];
    if(orderid.length != 0){
        var ensure = confirm('真的确认发货吗？');
        if(ensure){
            $.post('index.php?r=wlgl/ConfirmShipped',{orderno :orderid},function(data){
                if(!data){
                    return;
                }
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=wlgl/GetWlfhHtml";
                    }
                    if(data.res == 'error'){
                        alert(data.msg);
                        return;
                    }
                }
            },'json');
        }
    }
});

/**
 * @desc 查询待发货订单条件请求
 * @author WuJunhua
 * @date 2016-02-02
 */
function ClientOrderData(sign,page,psize){ 
    var wlddh = $('#wlddh').val();//订单号
    var xdsjq=$('#xdsjq').val();//下单时间
    var xdsjz=$('#xdsjz').val();//下单时间(到)
    var kddh=$('#kddh').val();//快递单号
    var khid=$('#khid').val();//客户id
    var khname=$('#khname').val();//客户姓名

    var kdgs=$("option[name='kdgs']:checked").val();//快递公司
    var zffs=$("option[name='zffs']:checked").val();//支付方式
    var szz=$("option[name='szz']:checked").val();//所在组
    var khyx=$("option[name='khyx']:checked").val();//客户意向
    var ddlx=$("option[name='ddlx']:checked").val();//订单类型
    var ddfhzt=$("option[name='ddfhzt']:checked").val();//订单状态

   if(sign == 1){
        if ($('#inquireSign').val() == 0 ) {
            xdsjq = '';
            xdsjz = '';
        }

        $.get('index.php?r=wlgl/GetLogisticsDeliveryList',{wlddh:wlddh,xdsjq:xdsjq,xdsjz:xdsjz,kddh:kddh,khid:khid,khname:khname,kdgs:kdgs,zffs:zffs,szz:szz,khyx:khyx,ddlx:ddlx,ddfhzt:ddfhzt,sign:sign,page:page,psize:psize},function(data){
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
        $.get('index.php?r=wlgl/GetLogisticsDeliveryList',{wlddh:wlddh,xdsjq:xdsjq,xdsjz:xdsjz,kddh:kddh,khid:khid,khname:khname,kdgs:kdgs,zffs:zffs,szz:szz,khyx:khyx,ddlx:ddlx,ddfhzt:ddfhzt,sign:sign},function(data){
            if(!data){
                return;
            }
            $('#inquireSign').val(1);
            listData(data);
            //全选(全不选)特效
            checkAll($('#checkall'),$('.checkbox'));
        });
   }
   
}

/**
 * @desc 物流发货查询
 * @author huyan
 * @date 2015-11-25
 */
$('#LogisticsQuery').on('click',function(){
    var page = '';
    var psize = '';
    var sign = 0; //查询标识
    ClientOrderData(sign,page,psize);
});


/**
 * @desc 导出excel
 * @author WuJunhua
 * @date 2015-12-17
 */
 $('body').on('click','#exportExcel',function(){
    var page = $('#pagehidden').attr('page');
    var psize = $('#pagehidden').attr('psize');
    var sign = 1; //导出excel标识
    ClientOrderData(sign,page,psize);
 });


function changeStr(str){
    var s = "";
    var order = "";
    //判断表头
    switch(str){
        case "ddid":
            s = "订单ID";
            order = "xsaa02";
            break;
        case "name":
            s = "姓名";
            order = "xsaa05";
            break;
        case "ddsj":
            s = "订单时间";
            order = "xsaa23";
            break;
        case "sdsj":
            s = "审单时间";
            order = "xsaa25";
            break;  
        case "zt":
            s = "状态";
            order = "xsaa29";
            break;
        case "kdgs":
            s = "快递公司";
            order = "xsaa41";
            break;
        case "kddh":
            s = "快递单号";
            order = "xsaa03";
            break;
        case "fkfs":
            s = "付款方式";
            order = "xsaa13";
            break;
        case "zje":
            s = "总金额";
            order = "xsaa19";
            break; 
    }
    var img = "<img style='width:10px;height:10px' src='public/template/images/arrorDown.png'>";
    var sequence = "DESC";

    if($("#"+str).html().indexOf("arrorDown.png") > 0){
        img = "<img style='width:10px;height:10px' src='public/template/images/arrorUp.png'>";
        sequence = "ASC";
    }
    //所有表头还原，点击表头再次更换
    $("#ddid").html("订单ID");
    $("#name").html("姓名");
    $("#ddsj").html("订单时间");
    $("#sdsj").html("审单时间");
    $("#zt").html("状态");
    $("#kdgs").html("快递公司");
    $("#kddh").html("快递单号");
    $("#dy").html("打印");
    $("#fkfs").html("付款方式");
    $("#zje").html("总金额");
    $("#"+str).html(img+" "+s);

    var page = $('#pagehidden').attr("page");
    var psize = $('#pagehidden').attr("psize");

    $.post("index.php?r=wlgl/GetLogisticsDeliveryList",{page:page,psize:psize,order:order,sequence:sequence},function(data){
        listData(data);
        //全选(全不选)特效
        checkAll($('#checkall'),$('.checkbox'));
    },"json");
}


var number;

function refurbish(num){
    clearInterval(number);
    //每个按键先还原默认样式，再修改选中的
    $("#120").attr("style","");
    $("#300").attr("style","");
    $("#0").attr("style","");
    $("#"+num).attr("style","color:#000000; background:#999999");
    if(num == 0){
        $("#refurbishTime").html("不刷新");
    }else{
        $("#refurbishTime").html(num+"秒");
        number = setInterval("toRefurbish()",(num*1000));
    }
   
}

function toRefurbish(){
    $.post('index.php?r=wlgl/GetLogisticsDeliveryList',function(data){
        listData(data);
        //全选(全不选)特效
        checkAll($('#checkall'),$('.checkbox'));       
    },'json');
}