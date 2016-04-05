$(function(){
    /**
     * @desc 加载视图后，显示数据
     * @author WuJunhua
     * @date 2015-11-05
     */
    $.post('index.php?r=wlgl/GetReturnOrderRecordList',function(data){
        listData(data);
    },'json');
});


/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-11-26
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
 * @desc 查询退货订单记录条件请求
 * @author WuJunhua
 * @date 2016-02-03
 */
function ReturnOrderData(sign,page,psize){ 
    var ddbh = $('#ddbh').val();//订单号
    var ddsjq=$('#ddsjq').val();//订单时间
    var ddsjz=$('#ddsjz').val();//订单时间（到）
    var rcsjq=$('#rcsjq').val();///入库时间
    var rcsjz=$('#rcsjz').val();///入库时间(到)
    var zffs=$("option[name='zffs']:checked").val();//支付方式
    var syz=$("option[name='syz']:checked").val();//所有组
    var kdgs=$("option[name='kdgs']:checked").val();//快递公司
    alert(34343);return;

   if(sign == 1){
        if ($('#inquireSign').val() == 0 ) {
            rcsjq = '';
            rcsjz = '';
        }

        $.get('index.php?r=wlgl/GetReturnOrderRecordList',{ddbh:ddbh,ddsjq:ddsjq,ddsjz:ddsjz,rcsjq:rcsjq,rcsjz:rcsjz,zffs:zffs,syz:syz,kdgs:kdgs,sign:sign,page:page,psize:psize},function(data){
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
            url: "index.php?r=wlgl/GetReturnOrderRecordList",
            async: true,
            data: {ddbh:ddbh,ddsjq:ddsjq,ddsjz:ddsjz,rcsjq:rcsjq,rcsjz:rcsjz,zffs:zffs,syz:syz,kdgs:kdgs,sign:sign},
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
 * @date 2015-12-17
 */
 $('body').on('click','#exportExcel',function(){
    var page = $('#pagehidden').attr('page');
    var psize = $('#pagehidden').attr('psize');
    var sign = 1; //导出excel标识
    ReturnOrderData(sign,page,psize);
 });

/**
 * @desc 退货订单记录列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-11-26
 */
function listData(data,str,img,s){
    $("#ddid").html("订单ID");
    $("#fkfs").html("付款方式");
    $("#ddzt").html("订单状态");
    $("#thje").html("退货金额（元）");
    $("#ddsj").html("订单时间");
    $("#kdgs").html("快递公司");
    $("#kddh").html("快递单号");
    $("#xsgh").html("销售工号");
    $("#czr").html("操作人");
    $("#rcsj").html("入仓时间");
    $("#"+str).html(img+s);

    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data.result == 'success'){
        $("#sequence").val(data.sequence);
        $("#order").val(data.order);
        $('#pagehidden').attr({ page: data.page, psize: data.psize });
        var length = data.list.length;
        for(var i = 0; i < length; i+=2){
            var listInfo = '';
            listInfo = '<tr class="singular">';
            listInfo +=   '<td><a class="canJumpPage" href="index.php?r=wlgl/GetThddjlxqHtml&orderno='+data.list[i]['xsaa02']+'&ordernum='+data.list[i]['xsaa01']+'">'+ data.list[i]['xsaa02'] +'</a></td>'
                        + '<td><span>'+ data.list[i]['xsaa13'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa29'] +'</span></td>'
                        + '<td><span class="totalPrice">'+ data.list[i]['xsaa44'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa23'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa41'] +'</span></td>' 
                        + '<td><span>'+ data.list[i]['xsaa03'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa48'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa22'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa43'] +'</span></td>'
                        + '</tr>';
            if(i != length - 1){
                listInfo += '<tr class="complex">'
                +   '<td><a class="canJumpPage" href="index.php?r=wlgl/GetThddjlxqHtml&orderno='+data.list[i+1]['xsaa02']+'&ordernum='+data.list[i+1]['xsaa01']+'">'+ data.list[i+1]['xsaa02'] +'</a></td>'
                + '<td><span>'+ data.list[i+1]['xsaa13'] +'</span></td>'
                + '<td><span>'+ data.list[i+1]['xsaa29'] +'</span></td>'
                + '<td><span class="totalPrice">'+ data.list[i+1]['xsaa44'] +'</span></td>'
                + '<td><span>'+ data.list[i+1]['xsaa23'] +'</span></td>'
                + '<td><span>'+ data.list[i+1]['xsaa41'] +'</span></td>' 
                + '<td><span>'+ data.list[i+1]['xsaa03'] +'</span></td>'
                + '<td><span>'+ data.list[i+1]['xsaa48'] +'</span></td>'
                + '<td><span>'+ data.list[i+1]['xsaa22'] +'</span></td>'
                + '<td><span>'+ data.list[i+1]['xsaa43'] +'</span></td>'
                + '</tr>';
            }
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
        var totalPrice = 0; //金额总计
        $('.totalPrice').each(function(index,item) { 
            totalPrice += parseFloat($(item).text()); 
        });
        $('.page').append('本页退货金额总计：<span style="color:#ff0000;">'+ totalPrice +'</span>');
    }else{
        var listInfo = '<tr><td colspan="10" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }
}



//根据不同表头变换顺序，并加入箭头图标
function changeStr(str){
    var s = "";
    var order = "";
    //判断表头
    switch(str){
        case "ddid":
            s = "订单ID";
            order = "xsaa02";
            break;
        case "fkfs":
            s = "付款方式";
            order = "xsaa13";
            break;
        case "ddzt":
            s = "订单状态";
            order = "xsaa29";
            break;
        case "thje":
            s = "退货金额（元）";
            order = "xsaa44";
            break;
        case "ddsj":
            s = "订单时间";
            order = "xsaa23";
            break;
        case "kdgs":
            s = "快递公司";
            order = "xsaa41";
            break;
        case "kddh":
            s = "快递单号";
            order = "xsaa03";
            break;
        case "xsgh":
            s = "销售工号";
            order = "xsaa48";
            break;
        case "czr":
            s = "操作人";
            order = "xsaa22";
            break;
        case "rcsj":
            s = "入仓时间";
            order = "xsaa43";
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
    $.post('index.php?r=wlgl/GetReturnOrderRecordList&page='+page+'&psize='+psize,{sequence :sequence,order:order},function(data){
        listData(data,str,img,s);
    },'json');
}
