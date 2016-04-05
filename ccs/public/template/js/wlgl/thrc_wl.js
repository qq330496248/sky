$(function(){
    //获取已拒收或退换货订单(标识)
    $('#inquire').on('click',function(){
        //初始化
        $('#tips').html('');
        $('#ordernum').val('');
        $('.goodLine').remove();
        var orderno = $('#orderno').val();  //查询输入的订单号
        var expressno = $('#expressno').val(); //查询输入的快递号
        if(!$.trim(orderno) && !$.trim(expressno)){
            $('#tips').html('*至少填写一个查询条件');
            return;
        }
        $.post('index.php?r=wlgl/GetRejectedOrder',{orderno:orderno,expressno:expressno},function(data){
            if(!data){
                return;
            }
            if(data.res != 'error'){
                var length = data.length;
                $('.goodList').remove();
                $('#noOrders').remove();
                for(var i = 0; i < length; i++){
                    var listInfo = '';
                    listInfo = '<tr class="goodLine">';
                    listInfo += '<td><span><input type="checkbox" checked class="checkbox"/></span></td>'
                                + '<td><span class="goodDetails" goodid=" '+ data[i]['xsab03'] +' ">'+ data[i]['xsab03'] +'<input name="goodItems" type="hidden" value="'+ data[i]['xsab03'] +'"/><font style="color:#f00;">【退】</font></span></td>'
                                + '<td><span>'+ data[i]['xsab02'] +'</span></td>'
                                + '<td><span>'+ data[i]['xsab06'] +'<input name="goodItems" type="hidden" value="'+ data[i]['xsab06'] +'"/></span></td>'
                                + '<td><span>'+ data[i]['xsab04'] +'</span></td>'
                                + '<td><span>'+ data[i]['xsab04'] +'<input name="goodItems" style="border:1px solid #000;" type="hidden" value="'+ data[i]['xsab04'] +'"/></span></td>'
                                + '<td><span>'+ data[i]['xsab08'] +'</span></td>'
                                + '</tr>';
                    $('#mark').before(listInfo);
                }
                $('.returnMark').css('display','table-row');
                $('#ordernum').val(orderno);
            }
            if(data.res == 'error'){
                $('#noOrders').remove();
                $('.goodList').remove();
                $('.returnMark').css('display','none');
                $('#tbody2').append('<tr id="noOrders"><td colspan="7" style="color:#f00;">没有搜索到该订单号或该订单未做退货处理！</td></tr>');
            }
        });
       
    });

    //商品入库
    $('body').on('click','#warehousing',function(){
        var orderno = $('#ordernum').val();  //查询成功后的订单号
        var goodItems = [];
        //获取单个或多个商品信息  
        $('.checkbox:checked').parent().parent().siblings().find('input[name="goodItems"]').each(function(index,item){
            goodItems.push($(item).val());   
        });
        if(goodItems.length == 0){
            alert('请至少勾选一个款号');
            return;
        }
        var ensure = confirm('你确定要退货入仓吗？');
        if(ensure){
            $.post('index.php?r=wlgl/ReturnWarehousing',{orderno:orderno,goodItems:goodItems},function(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=wlgl/GetCpthrcHtml";
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                }
            });
        }
    });

    //终止退货入仓
    $('body').on('click','#termination',function(){
        var orderno = $('#ordernum').val();  //查询成功后的订单号
        var goodItems = [];
        //获取单个或多个商品信息  
        $('.checkbox:checked').parent().parent().siblings().find('input[name="goodItems"]').each(function(index,item){
            goodItems.push($(item).val());   
        });
        if(goodItems.length == 0){
            alert('请至少勾选一个款号');
            return;
        }
        var ensure = confirm('你确定要终止退货入仓吗？');
        if(ensure){
            $.post('index.php?r=wlgl/EndWarehousing',{orderno:orderno,goodItems:goodItems},function(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=wlgl/GetCpthrcHtml";
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                }
            });
        }
    });

});

//查找退货订单号
var httpHost = $('#httpHost').val();  //服务器地址
function showCzThdd(){
    var dialog = new Dialog();
    dialog.Width=800;
    dialog.Height=600;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetCzThddHtml";
    dialog.show();
}


