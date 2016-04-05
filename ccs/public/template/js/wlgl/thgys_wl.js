$(function(){
    //获取采购单的相关明细信息
    $('#inquire').on('click',function(){
        //初始化
        $('#tips').html('');
        var orderno = $('#orderno').val();  //查询输入的采购单号
        if(!$.trim(orderno)){
            $('#tips').html('*采购单号不能为空');
            return;
        }
        $.post('index.php?r=wlgl/GetPurchaseOrderInfo',{orderno:orderno},function(data){
            if(!data){
                return;
            }
            if(data.res != 'error'){
                var length = data.length;
                $('.goodList').remove();
                $('#noOrders').remove();
                for(var i = 0; i < length; i+=2){
                    if(!data[i]['cgac08']){
                        data[i]['cgac08'] = '';
                    }
                    var listInfo = '';
                    listInfo = '<tr class="singular">';
                    listInfo += '<td><span><input type="checkbox" checked class="checkbox"/></span></td>'
                                + '<td><span>'+ data[i]['cgaa09'] +'</span></td>'
                                + '<td><span class="goodDetails" goodid=" '+ data[i]['cgac03'] +' ">'+ data[i]['cgac03'] +'<input name="goodItems" type="hidden" value="'+ data[i]['cgac03'] +'"/></td>'
                                + '<td><span>'+ data[i]['cgac04'] +'</span></td>'
                                + '<td><span>'+ data[i]['cgac06'] +'</span></td>'
                                + '<td><span>'+ data[i]['cpae03'] +'</span></td>'
                                + '<td><span>'+ data[i]['cgac14'] +'</span></td>'
                                + '<td><span><input name="goodItems" type="text" class="dfinput" style="width:80px;border:1px solid #000;" value="'+ data[i]['cpae03'] +'"/></span></td>'
                                + '<td><span>'+ data[i]['cgac05'] +'</span></td>'
                                + '<td><span>'+ data[i]['cgac08'] +'</span></td>'
                                + '<td><span>'+ data[i]['cgac07'] +'</span></td>'
                                + '</tr>';
                    if(i != length - 1){
                         listInfo += '<tr class="complex">'
                                + '<td><span><input type="checkbox" checked class="checkbox"/></span></td>'
                                + '<td><span>'+ data[i+1]['cgaa09'] +'</span></td>'
                                + '<td><span class="goodDetails" goodid=" '+ data[i+1]['cgac03'] +' ">'+ data[i+1]['cgac03'] +'<input name="goodItems" type="hidden" value="'+ data[i+1]['cgac03'] +'"/></td>'
                                + '<td><span>'+ data[i+1]['cgac04'] +'</span></td>'
                                + '<td><span>'+ data[i+1]['cgac06'] +'</span></td>'
                                + '<td><span>'+ data[i+1]['cpae03'] +'</span></td>'
                                + '<td><span>'+ data[i+1]['cgac14'] +'</span></td>'
                                + '<td><span><input name="goodItems" type="text" class="dfinput" style="width:80px;border:1px solid #000;" value="'+ data[i+1]['cpae03'] +'"/></span></td>'
                                + '<td><span>'+ data[i+1]['cgac05'] +'</span></td>'
                                + '<td><span>'+ data[i+1]['cgac08'] +'</span></td>'
                                + '<td><span>'+ data[i+1]['cgac07'] +'</span></td>'
                                + '</tr>';
                    }
                    $('#tbody2').append(listInfo);
                }
                $('.returnMark').css('display','table-row');
            }
            if(data.res == 'error'){
                $('#noOrders').remove();
                $('.goodList').remove();
                $('.returnMark').css('display','none');
                $('#tbody2').append('<tr id="noOrders"><td colspan="10" style="color:#f00;">没有搜索到该采购单号！</td></tr>');
            }
        });
       
    });

    //退货供应商
    $('body').on('click','#warehousing',function(){
        //初始化
        $('#prompt').html('');
        var orderno = $('#orderno').val();  //输入的采购单号
        var goodItems = [];
        //获取单个或多个商品信息  
        $('.checkbox:checked').parent().parent().siblings().find('input[name="goodItems"]').each(function(index,item){
            goodItems.push($(item).val());   
        });
        if(goodItems.length == 0){
            alert('请至少勾选一个款号');
            return;
        }
        var ensure = confirm('确定要退货供应商吗？');
        if(ensure){
            $.post('index.php?r=wlgl/ReturnSuppliers',{orderno:orderno,goodItems:goodItems},function(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=wlgl/GetThgysxqHtml";
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
                if(data.res == 'tips'){
                    $('#prompt').html(data.msg);
                    return;
                }
            });
        }
    });

});

//查找采购单号
var httpHost = $('#httpHost').val();  //服务器地址
function showCzCgdh(){
    var dialog = new Dialog();
    dialog.Width=1000;
    dialog.Height=600;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetCzCgdhHtml";
    dialog.show();
}


