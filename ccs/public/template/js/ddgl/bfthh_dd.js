$(function(){
    var orderno = $('#orderno').text();  //订单编号
	//获取订单的商品信息
    $.post('index.php?r=ddgl/GetOrderDetailGoodsMsg',{orderno:orderno},function(data){
        if(!data){
            return;
        }
        if(data.res != 'error'){
            var length = data.length;
            for(var i = 0; i < length; i++){
                var listInfo = '';
                listInfo = '<tr>';
                listInfo +=   '<td><span><input type="checkbox" class="checkbox"/></span></td>'
                            + '<td><input type="hidden" name="goodItems" value="'+ data[i]['xsab03'] +'"/><span>'+ data[i]['xsab03'] +'</span></td>'
                            + '<td><input type="hidden" name="goodItems" value="'+ data[i]['xsab02'] +'"/><span>'+ data[i]['xsab02'] +'</span></td>'
                            + '<td><input type="hidden" name="goodItems" value="'+ data[i]['xsab06'] +'"/><span>'+ data[i]['xsab06'] +'</span></td>'
                            + '<td><input type="hidden" name="goodItems" value="'+ parseInt(data[i]['xsab04']) +'"/><span>'+ parseInt(data[i]['xsab04']) +'</span></td>'
                            + '<td><input type="hidden" name="goodItems" value="'+ data[i]['xsab08'] +'"/><span class="subtotal">'+ data[i]['xsab08'] +'</span></td>'
                            + '</tr>';
                $('#barcode').after(listInfo);
            }

        }
    });

    //显示退换货原因
    $('#jsyyxs').on('click','.rejectId',function(){
        var $this = $(this);
        var rejectId = $this.val();
        $.post('index.php?r=ddgl/GetRejectionContent',{rejectid:rejectId},function(data){
            if(data.msg != 'error'){
                $('.chageReject').remove();
                var length = data.length;
                for(var i = 0; i < length; i++){
                    var listInfo = '';
                    listInfo += '<li class="chageReject" style="height:5px;line-height:5px;"><input class="jsyynr" name="jsyynr" type="radio" value="'+ data[i]['xsaf02'] +'"/>'+ data[i]['xsaf02'] +'</li>';
                    $('#rejectcontent').append(listInfo);
                }
            }
        },'json');
    });

    //勾选退换货商品,改变退换金额
    $('#table5').on('click','.checkbox',function(){
        //获取小计的值
        var totalPrice = [];
        $('.checkbox:checked').parent().parent().siblings().find('.subtotal').each(function(index,item){
            totalPrice.push(parseFloat($(item).text()));   
        });
        if(totalPrice && totalPrice.length > 0){
            var totPri = totalPrice.reduce(function(a,b){
                return a + b;
            });
            //改变退换金额
            $('#refundAmount').val(totPri);
        }
        if(totalPrice.length == 0){
            $('#refundAmount').val(0);
        }
        
    });

    //确定退货
    $('body').on('click','#confirmReturn',function(){
        //商品信息
        var goodItems = [];
        $('.checkbox:checked').parent().parent().siblings().find('input[name="goodItems"]').each(function(index,item){
            goodItems.push($(item).val());   
        });
        //获取订单总额
        var totalPrice = [];
        $('.subtotal').each(function(index,item){
            totalPrice.push(parseFloat($(item).text()));   
        });
        var totPri = totalPrice.reduce(function(a,b){
            return a + b;
        });
        var jsyynr = $("input[name='jsyynr']:checked").val();
        var remark = $('#remark').val();
        var thje = $('#refundAmount').val();
        if(parseFloat(thje) > parseFloat(totPri)){
            alert('退换金额不能大于订单总价');
            return;
        }

        var ensure = confirm('你真的确定退货操作吗？并且退货金额'+thje+'元');
        if(ensure){
            $.post('index.php?r=ddgl/OrderConfirmReturn',{orderno:orderno,goodItems:goodItems,jsyynr:jsyynr,remark:remark,thje:thje},function(data){
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
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

    //确定换货
    $('body').on('click','#confirmExchange',function(){
        //商品信息
        var goodItems = [];
        $('.checkbox:checked').parent().parent().siblings().find('input[name="goodItems"]').each(function(index,item){
            goodItems.push($(item).val());   
        });
        //获取订单总额
        var totalPrice = [];
        $('.subtotal').each(function(index,item){
            totalPrice.push(parseFloat($(item).text()));   
        });
        var totPri = totalPrice.reduce(function(a,b){
            return a + b;
        });
        var jsyynr = $("input[name='jsyynr']:checked").val();
        var remark = $('#remark').val();
        var thje = $('#refundAmount').val();
        if(parseFloat(thje) > parseFloat(totPri)){
            alert('退换金额不能大于订单总价');
            return;
        }

        var ensure = confirm('你真的确定换货操作吗？并且换货金额'+thje+'元');
        if(ensure){
            $.post('index.php?r=ddgl/OrderConfirmExchange',{orderno:orderno,goodItems:goodItems,jsyynr:jsyynr,remark:remark,thje:thje},function(data){
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
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


    

    //获取订单的跟进记录信息
    $.post('index.php?r=ddgl/GetOrderFollowRecording',{orderno:orderno},function(data){
        if(!data){
            return;
        }
        if(data.res != 'error'){
            var length = data.length;
            for(var i = 0; i < length; i++){
                var a = i+1;
                var listInfo = '';
                listInfo = '<tr>';
                listInfo += '<td><span>'+ a +'</span></td>'
                            + '<td><span>'+ data[i]['xsad07'] +'</span></td>'
                            + '<td><span>'+ data[i]['xsad08'] +'</span></td>'
                            + '<td><span>'+ data[i]['xsad04'] +'</span></td>'
                            + '<td><span>'+ data[i]['xsad06'] +'</span></td>'
                            + '</tr>';
                $('#tbody2').append(listInfo);
            }

        }
    },'json');

   
});
