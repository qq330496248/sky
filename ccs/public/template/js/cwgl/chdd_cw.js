$(function(){
	/**
     * @desc 加载视图后，显示数据
     * @author WuJunhua
     * @date 2015-12-09
     */
    var hpage = $('#pagehidden').attr('page');
    var hpsize = $('#pagehidden').attr('psize');
    /*if(hpage != 0){

    }*/
    $.post('index.php?r=cwgl/GetShipmentOrderList',function(data){
        listData(data);
        //全选(全不选)特效
        checkAll($('#checkall'),$('.checkbox'));
    },'json');

});

/**
 * @desc 出货订单列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-12-09
 */
function listData(data){
    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data.result == 'success'){
        var length = data.list.length;
        var nowTime = '1940-01-01 10:00:00'; 
        $('#pagehidden').attr({ page: data.page, psize: data.psize }); 
        for(var i = 0; i < length; i+=2){
            //让默认时间显示为空
            if(data.list[i]['xsaa27'] < nowTime){ 
                data.list[i]['xsaa27'] = '';
            }
            var listInfo = '';
            listInfo = '<tr class="singular">';
            if(data.list[i]['xsaa54'] == '是' && data.list[i]['xsaa55'] == '是'){
                listInfo += '<td><span><a class="canJumpPage" href="index.php?r=cwgl/OrderShipmentOrReturnsDetails&orderno='+data.list[i]['xsaa02']+'">'+ data.list[i]['xsaa02'] +'</a></span></td>'
            }else{
                listInfo += '<td><span><input class="orderno checkbox" style="margin-right:5px;" type="checkbox" orderno="'+ data.list[i]['xsaa02'] +'"  value="'+ data.list[i]['xsaa02'] +'" /><a class="canJumpPage" href="index.php?r=cwgl/OrderShipmentOrReturnsDetails&orderno='+data.list[i]['xsaa02']+'&ordernum='+data.list[i]['xsaa01']+'">'+ data.list[i]['xsaa02'] +'</a></span></td>'
            }
            
              listInfo += '<td><span>'+ data.list[i]['xsaa13'] +'</span></td>'
                        + '<td><span class="totalPrice">'+ data.list[i]['xsaa19'] +'</span></td>'
                        + '<td><span class="fare">'+ data.list[i]['xsaa16'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa27'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa29'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa41'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa03'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['xsaa33'] +'</span></td>'
                        if(data.list[i]['xsaa54'] == '' && data.list[i]['xsaa55'] == ''){
                            listInfo += '<td><span><input orderno="'+ data.list[i]['xsaa02'] +'" class="courier" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i]['xsaa57'] +'"/><input style="width:50px;" name="" type="button" class="btn remember1" orderno="'+ data.list[i]['xsaa02'] +'" value="记1"/><input style="width:50px;display:none;" name="" type="button" class="btn revocation1" orderno="'+ data.list[i]['xsaa02'] +'" value="撤1"/></span></td>'
                            listInfo += '<td><span><input orderno="'+ data.list[i]['xsaa02'] +'" class="fee" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i]['xsaa58'] +'"/><input style="width:50px;" name="" type="button" class="btn remember2" orderno="'+ data.list[i]['xsaa02'] +'" value="记2"/><input style="width:50px;display:none;" name="" type="button" class="btn revocation2" orderno="'+ data.list[i]['xsaa02'] +'" value="撤2"/></span></td>'
                        }

                        if(data.list[i]['xsaa54'] == '否' && data.list[i]['xsaa55'] == '否'){
                            listInfo += '<td><span><input orderno="'+ data.list[i]['xsaa02'] +'" class="courier" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i]['xsaa57'] +'"/><input style="width:50px;" name="" type="button" class="btn remember1" orderno="'+ data.list[i]['xsaa02'] +'" value="记1"/><input style="width:50px;display:none;" name="" type="button" class="btn revocation1" orderno="'+ data.list[i]['xsaa02'] +'" value="撤1"/></span></td>'
                            listInfo += '<td><span><input orderno="'+ data.list[i]['xsaa02'] +'" class="fee" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i]['xsaa58'] +'"/><input style="width:50px;" name="" type="button" class="btn remember2" orderno="'+ data.list[i]['xsaa02'] +'" value="记2"/><input style="width:50px;display:none;" name="" type="button" class="btn revocation2" orderno="'+ data.list[i]['xsaa02'] +'" value="撤2"/></span></td>'
                        }

                        if(data.list[i]['xsaa54'] == '是' && data.list[i]['xsaa55'] == '是'){
                            listInfo += '<td><span><input readonly="readonly" orderno="'+ data.list[i]['xsaa02'] +'" class="courier" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i]['xsaa57'] +'"/><input style="width:50px;" name="" type="button" class="btn revocation1" orderno="'+ data.list[i]['xsaa02'] +'" value="撤1"/><input style="width:50px;display:none;" name="" type="button" class="btn remember1" orderno="'+ data.list[i]['xsaa02'] +'" value="记1"/></span></td>'
                            listInfo += '<td><span><input readonly="readonly" orderno="'+ data.list[i]['xsaa02'] +'" class="fee" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i]['xsaa58'] +'"/><input style="width:50px;" name="" type="button" class="btn revocation2" orderno="'+ data.list[i]['xsaa02'] +'" value="撤2"/><input style="width:50px;display:none;" name="" type="button" class="btn remember2" orderno="'+ data.list[i]['xsaa02'] +'" value="记2"/></span></td>'
                        }

                        if(data.list[i]['xsaa54'] == '是' && data.list[i]['xsaa55'] == '否'){
                            listInfo += '<td><span><input readonly="readonly" orderno="'+ data.list[i]['xsaa02'] +'" class="courier" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i]['xsaa57'] +'"/><input style="width:50px;" name="" type="button" class="btn revocation1" orderno="'+ data.list[i]['xsaa02'] +'" value="撤1"/><input style="width:50px;display:none;" name="" type="button" class="btn remember1" orderno="'+ data.list[i]['xsaa02'] +'" value="记1"/></span></td>'
                            listInfo += '<td><span><input orderno="'+ data.list[i]['xsaa02'] +'" class="fee" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i]['xsaa58'] +'"/><input style="width:50px;" name="" type="button" class="btn remember2" orderno="'+ data.list[i]['xsaa02'] +'" value="记2"/><input style="width:50px;display:none;" name="" type="button" class="btn revocation2" orderno="'+ data.list[i]['xsaa02'] +'" value="撤2"/></span></td>'
                        }

                        if(data.list[i]['xsaa54'] == '否' && data.list[i]['xsaa55'] == '是'){
                            listInfo += '<td><span><input orderno="'+ data.list[i]['xsaa02'] +'" class="courier" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i]['xsaa57'] +'"/><input style="width:50px;" name="" type="button" class="btn remember1" orderno="'+ data.list[i]['xsaa02'] +'" value="记1"/><input style="width:50px;display:none;" name="" type="button" class="btn revocation1" orderno="'+ data.list[i]['xsaa02'] +'" value="撤1"/></span></span></td>'
                            listInfo += '<td><span><input readonly="readonly" orderno="'+ data.list[i]['xsaa02'] +'" class="fee" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i]['xsaa58'] +'"/><input style="width:50px;" name="" type="button" class="btn revocation2" orderno="'+ data.list[i]['xsaa02'] +'" value="撤2"/><input style="width:50px;display:none;" name="" type="button" class="btn remember2" orderno="'+ data.list[i]['xsaa02'] +'" value="记2"/></span></td>'
                        }
                        listInfo += '<td><span><input name="" orderno="'+ data.list[i]['xsaa02'] +'" type="button" class="btn saveCost" value="保存"/></span></td>'
                        + '</tr>';

            if(i != length - 1){
                if(data.list[i+1]['xsaa27'] < nowTime){ 
                    data.list[i+1]['xsaa27'] = '';
                }
                listInfo += '<tr class="complex">'
                if(data.list[i]['xsaa54'] == '是' && data.list[i+1]['xsaa55'] == '是'){
                     listInfo += '<td><span><a class="canJumpPage" href="index.php?r=cwgl/OrderShipmentOrReturnsDetails&orderno='+data.list[i+1]['xsaa02']+'">'+ data.list[i+1]['xsaa02'] +'</a></span></td>'
                }else{
                     listInfo += '<td><span><input class="orderno checkbox" style="margin-right:5px;" type="checkbox" orderno="'+ data.list[i+1]['xsaa02'] +'"  value="'+ data.list[i+1]['xsaa02'] +'" /><a class="canJumpPage" href="index.php?r=cwgl/OrderShipmentOrReturnsDetails&orderno='+data.list[i+1]['xsaa02']+'&ordernum='+data.list[i+1]['xsaa01']+'">'+ data.list[i+1]['xsaa02'] +'</a></span></td>'
                }
                     listInfo += '<td><span>'+ data.list[i+1]['xsaa13'] +'</span></td>'
                     listInfo += '<td><span class="totalPrice">'+ data.list[i+1]['xsaa19'] +'</span></td>'
                     listInfo += '<td><span class="fare">'+ data.list[i+1]['xsaa16'] +'</span></td>'
                     listInfo += '<td><span>'+ data.list[i+1]['xsaa27'] +'</span></td>'
                     listInfo += '<td><span>'+ data.list[i+1]['xsaa29'] +'</span></td>'
                     listInfo += '<td><span>'+ data.list[i+1]['xsaa41'] +'</span></td>'
                     listInfo += '<td><span>'+ data.list[i+1]['xsaa03'] +'</span></td>'
                     listInfo += '<td><span>'+ data.list[i+1]['xsaa33'] +'</span></td>'
                    if(data.list[i+1]['xsaa54'] == '' && data.list[i+1]['xsaa55'] == ''){
                        listInfo += '<td><span><input orderno="'+ data.list[i+1]['xsaa02'] +'" class="courier" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i+1]['xsaa57'] +'"/><input style="width:50px;" name="" type="button" class="btn remember1" orderno="'+ data.list[i+1]['xsaa02'] +'" value="记1"/><input style="width:50px;display:none;" name="" type="button" class="btn revocation1" orderno="'+ data.list[i+1]['xsaa02'] +'" value="撤1"/></span></td>'
                        listInfo += '<td><span><input orderno="'+ data.list[i+1]['xsaa02'] +'" class="fee" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i+1]['xsaa58'] +'"/><input style="width:50px;" name="" type="button" class="btn remember2" orderno="'+ data.list[i+1]['xsaa02'] +'" value="记2"/><input style="width:50px;display:none;" name="" type="button" class="btn revocation2" orderno="'+ data.list[i+1]['xsaa02'] +'" value="撤2"/></span></td>'
                    }

                    if(data.list[i+1]['xsaa54'] == '否' && data.list[i+1]['xsaa55'] == '否'){
                        listInfo += '<td><span><input orderno="'+ data.list[i+1]['xsaa02'] +'" class="courier" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i+1]['xsaa57'] +'"/><input style="width:50px;" name="" type="button" class="btn remember1" orderno="'+ data.list[i]+1['xsaa02'] +'" value="记1"/><input style="width:50px;display:none;" name="" type="button" class="btn revocation1" orderno="'+ data.list[i+1]['xsaa02'] +'" value="撤1"/></span></td>'
                        listInfo +=  '<td><span><input orderno="'+ data.list[i+1]['xsaa02'] +'" class="fee" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i+1]['xsaa58'] +'"/><input style="width:50px;" name="" type="button" class="btn remember2" orderno="'+ data.list[i+1]['xsaa02'] +'" value="记2"/><input style="width:50px;display:none;" name="" type="button" class="btn revocation2" orderno="'+ data.list[i+1]['xsaa02'] +'" value="撤2"/></span></td>'
                    }
                    if(data.list[i+1]['xsaa54'] == '是' && data.list[i+1]['xsaa55'] == '是'){
                       listInfo +='<td><span><input readonly="readonly" orderno="'+ data.list[i+1]['xsaa02'] +'" class="courier" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i+1]['xsaa57'] +'"/><input style="width:50px;" name="" type="button" class="btn revocation1" orderno="'+ data.list[i+1]['xsaa02'] +'" value="撤1"/><input style="width:50px;display:none;" name="" type="button" class="btn remember1" orderno="'+ data.list[i+1]['xsaa02'] +'" value="记1"/></span></td>'
                        listInfo +=  '<td><span><input readonly="readonly" orderno="'+ data.list[i+1]['xsaa02'] +'" class="fee" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i+1]['xsaa58'] +'"/><input style="width:50px;" name="" type="button" class="btn revocation2" orderno="'+ data.list[i+1]['xsaa02'] +'" value="撤2"/><input style="width:50px;display:none;" name="" type="button" class="btn remember2" orderno="'+ data.list[i+1]['xsaa02'] +'" value="记2"/></span></td>'
                    }

                    if(data.list[i+1]['xsaa54'] == '是' && data.list[i+1]['xsaa55'] == '否'){
                        listInfo += '<td><span><input readonly="readonly" orderno="'+ data.list[i+1]['xsaa02'] +'" class="courier" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i+1]['xsaa57'] +'"/><input style="width:50px;" name="" type="button" class="btn revocation1" orderno="'+ data.list[i+1]['xsaa02'] +'" value="撤1"/><input style="width:50px;display:none;" name="" type="button" class="btn remember1" orderno="'+ data.list[i+1]['xsaa02'] +'" value="记1"/></span></td>'
                        listInfo +=  '<td><span><input orderno="'+ data.list[i+1]['xsaa02'] +'" class="fee" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i+1]['xsaa58'] +'"/><input style="width:50px;" name="" type="button" class="btn remember2" orderno="'+ data.list[i+1]['xsaa02'] +'" value="记2"/><input style="width:50px;display:none;" name="" type="button" class="btn revocation2" orderno="'+ data.list[i+1]['xsaa02'] +'" value="撤2"/></span></td>'
                    }

                    if(data.list[i+1]['xsaa54'] == '否' && data.list[i+1]['xsaa55'] == '是'){
                        listInfo += '<td><span><input orderno="'+ data.list[i+1]['xsaa02'] +'" class="courier" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i+1]['xsaa57'] +'"/><input style="width:50px;" name="" type="button" class="btn remember1" orderno="'+ data.list[i+1]['xsaa02'] +'" value="记1"/><input style="width:50px;display:none;" name="" type="button" class="btn revocation1" orderno="'+ data.list[i+1]['xsaa02'] +'" value="撤1"/></span></span></td>'
                        listInfo +=  '<td><span><input readonly="readonly" orderno="'+ data.list[i+1]['xsaa02'] +'" class="fee" style="border:1px solid #000;text-align:center;width:50px;" type="text" value="'+ data.list[i+1]['xsaa58'] +'"/><input style="width:50px;" name="" type="button" class="btn revocation2" orderno="'+ data.list[i+1]['xsaa02'] +'" value="撤2"/><input style="width:50px;display:none;" name="" type="button" class="btn remember2" orderno="'+ data.list[i+1]['xsaa02'] +'" value="记2"/></span></td>'
                    }
                    listInfo += '<td><span><input name="" orderno="'+ data.list[i+1]['xsaa02'] +'" type="button" class="btn saveCost" value="保存"/></span></td>'
                    + '</tr>';
            }
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
        var totalPrice = 0; //金额总计
        var fare = 0; //运费
        var courier = 0; //快递费
        var fee = 0; //服务费
        $('.totalPrice').each(function(index,item) { 
            totalPrice += parseFloat($(item).text()); 
        });
        $('.fare').each(function(index,item) { 
            fare += parseFloat($(item).text()); 
        });
        $('.courier').each(function(index,item) { 
            courier += parseFloat($(item).val()); 
        });
        $('.fee').each(function(index,item) { 
            fee += parseFloat($(item).val()); 
        });
        $('.page').append('本页金额总计：<span style="color:#ff0000;">'+ totalPrice +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页运费：<span style="color:#ff0000;">'+ fare +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页快递费：<span style="color:#ff0000;">'+ courier +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页服务费：<span style="color:#ff0000;">'+ fee +'</span>');
    }else{
        var listInfo = '<tr><td colspan="12" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }    
}

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-12-09
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

//单个订单记账1
$('#table5').on('click','.remember1',function(){
    var $this = $(this);
    var orderid = [$this.attr('orderno')];
    var sign = 1;
    if(orderid.length != 0){
        var ensure = confirm('真的确认记账1吗？');
        if(ensure){
            $.post('index.php?r=cwgl/OrderAccounting',{orderno :orderid,sign:sign},function(data){
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        $this.hide();
                        $this.siblings('.revocation1').show();
                        $this.siblings('.courier').attr('readonly','readonly');
                    }
                    if(data.res == 'error'){
                        alert(data.msg);
                        return;
                    }
                }
            });
        }
    }
});

//单个订单记账2
$('#table5').on('click','.remember2',function(){
    var $this = $(this);
    var orderid = [$this.attr('orderno')];
    var sign = 2;
    if(orderid.length != 0){
        var ensure = confirm('真的确认记账2吗？');
        if(ensure){
            $.post('index.php?r=cwgl/OrderAccounting',{orderno :orderid,sign:sign},function(data){
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        $this.hide();
                        $this.siblings('.revocation2').show();
                        $this.siblings('.fee').attr('readonly','readonly');
                    }
                    if(data.res == 'error'){
                        alert(data.msg);
                        return;
                    }
                }
            });
        }
    }
});

//单个订单撤销1
$('#table5').on('click','.revocation1',function(){
    var $this = $(this);
    var orderid = [$this.attr('orderno')];
    var sign = 3;
    if(orderid.length != 0){
        var ensure = confirm('真的确认撤销1吗？');
        if(ensure){
            $.post('index.php?r=cwgl/OrderAccounting',{orderno :orderid,sign:sign},function(data){
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        $this.hide();
                        $this.siblings('.remember1').show();
                        $this.siblings('.courier').removeAttr('readonly');
                    }
                    if(data.res == 'error'){
                        alert(data.msg);
                        return;
                    }
                }
            });
        }
    }
});

//单个订单撤销2
$('#table5').on('click','.revocation2',function(){
    var $this = $(this);
    var orderid = [$this.attr('orderno')];
    var sign = 4;
    if(orderid.length != 0){
        var ensure = confirm('真的确认撤销2吗？');
        if(ensure){
            $.post('index.php?r=cwgl/OrderAccounting',{orderno :orderid,sign:sign},function(data){
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        $this.hide();
                        $this.siblings('.remember2').show();
                        $this.siblings('.fee').removeAttr('readonly');
                    }
                    if(data.res == 'error'){
                        alert(data.msg);
                        return;
                    }
                }
            });
        }
    }
});

//批量记账1
$('body').on('click','#batchArragin1',function(){
    var orderno = [];
    var sign = 1;
    $('.checkbox:checked').each(function(index,item){
        orderno.push($(item).attr('orderno'));  
    });

    if(orderno.length == 0){
        alert('请选择要记账的订单');
        return;
    }
    var ensure = confirm('真的确认批量记账1吗？');
    if(ensure){
        $.post('index.php?r=cwgl/OrderAccounting',{orderno :orderno,sign:sign},function(data){
            if(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=cwgl/GetChddHtml";
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
            }
        },'json');
        
    }
});

//批量记账2
$('body').on('click','#batchArragin2',function(){
    var orderno = [];
    var sign = 2;
    $('.checkbox:checked').each(function(index,item){
        orderno.push($(item).attr('orderno'));  
    });

    if(orderno.length == 0){
        alert('请选择要记账的订单');
        return;
    }
    var ensure = confirm('真的确认批量记账2吗？');
    if(ensure){
        $.post('index.php?r=cwgl/OrderAccounting',{orderno :orderno,sign:sign},function(data){
            if(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=cwgl/GetChddHtml";
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
            }
        },'json');
        
    }
});

//修改快递费和服务费
$('#table5').on('click','.saveCost',function(){
    var $this = $(this);
    var orderid = $this.attr('orderno');
    var courier = $this.parent().parent().siblings().find('.courier').val();
    var fee = $this.parent().parent().siblings().find('.fee').val();
    if(!regMoney.test(courier)){
        alert('快递费只能是数字且最多是两位小数');
        return;
    }
    if(!regMoney.test(fee)){
        alert('服务费只能是数字且最多是两位小数');
        return;
    }
    $.post('index.php?r=cwgl/OrderCourierFees',{orderno :orderid,courier:courier,fee:fee},function(data){
        if(data){
            if(data.res == 'success'){
                alert(data.msg);
                window.location.href="index.php?r=cwgl/GetChddHtml";
                return;
            }
            if(data.res == 'error'){
                alert(data.msg);
                return;
            }
        }
    });
});

/**
 * @desc 查询订单审核条件请求
 * @author WuJunhua
 * @date 2016-02-02
 */
function ShipmentOrderData(sign,page,psize){ 
    var ddid = $('#ddid').val();//订单id
    var khid=$('#khid').val();//客户id
    var kddh=$('#kddh').val();//快递单号
    var xdsjq=$('#xdsjq').val();//下单时间
    var xdsjz=$('#xdsjz').val();//
    var fhsjq=$('#fhsjq').val();//发货时间
    var fhsjz=$('#fhsjz').val();//
    var shsjq=$('#shsjq').val();//收货时间
    var shsjz=$('#shsjz').val();//）
    var jzsj1q=$('#jz1sjq').val();//记账时间1
    var jzsj1z=$('#jz1sjz').val();//）
    var jzsj2q=$('#jz2sjq').val();//记账时间2
    var jzsj2z=$('#jz2sjz').val();//

    var kdgs=$("option[name='kdgs']:checked").val();//快递公司
    var ddzt=$("option[name='ddzt']:checked").val();//订单状态
    var zffs=$("option[name='zffs']:checked").val();//支付方式
    var szz=$("option[name='szz']:checked").val();//组别
    var fplx=$("option[name='fplx']:checked").val();//发票类型
    var sfjz=$("option[name='sfjz']:checked").val();//是否记账
    var khly=$("option[name='khly']:checked").val();//客户来源
    var ywkdf=$("option[name='ywkdf']:checked").val();//快递费

   if(sign == 1){
        if ($('#inquireSign').val() == 0 ) {
            fhsjq = '';
            fhsjz = '';
        }
        $.get('index.php?r=cwgl/GetShipmentOrderList',{ddid:ddid,khid:khid,kddh:kddh,xdsjq:xdsjq,xdsjz:xdsjz,fhsjq:fhsjq,fhsjz:fhsjz,shsjq:shsjq,shsjz:shsjz,jzsj1q:jzsj1q,jzsj1z:jzsj1z,jzsj2q:jzsj2q,jzsj2z:jzsj2z,kdgs:kdgs,ddzt:ddzt,zffs:zffs,szz:szz,fplx:fplx,sfjz:sfjz,khly:khly,ywkdf:ywkdf,sign:sign,page:page,psize:psize},function(data){
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
            url: "index.php?r=cwgl/GetShipmentOrderList",
            async: true,
            data: {ddid:ddid,khid:khid,kddh:kddh,xdsjq:xdsjq,xdsjz:xdsjz,fhsjq:fhsjq,fhsjz:fhsjz,shsjq:shsjq,shsjz:shsjz,jzsj1q:jzsj1q,jzsj1z:jzsj1z,jzsj2q:jzsj2q,jzsj2z:jzsj2z,kdgs:kdgs,ddzt:ddzt,zffs:zffs,szz:szz,fplx:fplx,sfjz:sfjz,khly:khly,ywkdf:ywkdf,sign:sign},
            success: function(data){
                if(!data){
                    return;
                }
                $('#inquireSign').val(1);
                listData(data);
                //全选(全不选)特效
                checkAll($('#checkall'),$('.checkbox'));
            }
        });
   }
   
}

 /**
 * @desc 出货订单查询
 * @author huyan
 * @date 2015-12-23
 */
$('#ShipmentQuery').on('click',function(){
    var page = '';
    var psize = '';
    var sign = 0; //查询标识
    ShipmentOrderData(sign,page,psize);
});


/**
 * @desc 导出excel
 * @author WuJunhua
 * @date 2015-12-18
 */
 $('body').on('click','#exportExcel',function(){
    var page = $('#pagehidden').attr('page');
    var psize = $('#pagehidden').attr('psize');
    var sign = 1; //导出excel标识
    ShipmentOrderData(sign,page,psize);
 });