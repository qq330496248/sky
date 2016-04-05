$(function(){
	//采购单已审核的商品信息(标识)
    $('body').on('click','#inquire',function(){
        $('#tips').text('');
        $('#choiceGys').remove();
        var purchaseNo = $('#purchaseNo').val();  //查询输入的采购单号
        $.post('index.php?r=cpgl/GetAuditedPostedOrder',{purchaseNo:purchaseNo},function(data){
            if(!data){
                return;
            }
            if(data.res != 'error'){
                $('#getCheckeboxId').empty();
                var length = data.length;
                //显示采购单信息
                $('#gys').text(data[0]['cgaa09']);
                $('#gys').attr('gysid',data[0]['cgaa14']);
                $('#xdr').text(data[0]['cgaa05']);
                $('#xdsj').text(data[0]['cgaa06']);
                $('#cgzs').text(data[0]['cgaa04']);
                $('#cgze').text(data[0]['cgaa03']);
                $('#fare').text(data[0]['cgaa08']);
                $('#remark').text(data[0]['cgaa10']);

                for(var i = 0; i < length; i++){
                    if(data[i]['cgac06'] == 0.00){
                        data[i]['cgac06'] = 0;
                    }
                    if(!data[i]['cpae03'] || data[i]['cpae03'] == 0.00){
                        data[i]['cpae03'] = 0;
                    }
                    if(!data[i]['cpae06']){
                        data[i]['cpae06'] = '';
                    }
                    if(!data[i]['cpae22']){
                        data[i]['cpae22'] = '';
                    }
                    $('#purchaseStatus').val(data[i]['cgaa20']);
                    var zprus = data[i]['cgac06'] - data[i]['cpae03'];
                    var listInfo = '';
                    listInfo = '<tr class="goodList">';
                    listInfo += '<td><span><input type="checkbox" class="checkbox" value="'+ data[i]['cgac03'] +'"/></span></td>'
                                + '<td><input type="hidden" name="goodItems" value="'+ data[i]['cgac03'] +'"/><span class="goodDetails" goodid=" '+ data[i]['cgac03'] +' ">'+ data[i]['cgac03'] +'</span></td>'
                                + '<td><span>'+ data[i]['cgac04'] +'</span></td>'
                                + '<td><span><input name="goodItems" type="text" class="dfinput" style="width:140px;border:1px solid #000;" onClick="WdatePicker()" value=""/></span></td>'
                                + '<td><span><input name="goodItems" type="text" class="dfinput" style="width:140px;border:1px solid #000;" onClick="WdatePicker()" value=""/></span></td>'
                                + '<td><input type="hidden" name="goodItems" value="'+ data[i]['cgac06'] +'"/><span>'+ data[i]['cgac06'] +'</span></td>'
                                + '<td><input type="hidden" name="goodItems" value="'+ data[i]['cpae03'] +'"/><span>'+ data[i]['cpae03'] +'</span></td>'
                                + '<td><span><input name="goodItems" type="text" class="dfinput GenuInenventory" style="width:80px;border:1px solid #000;" value="'+ zprus +'"/></span></td>'
                                + '<td><span><input name="goodItems" type="text" class="dfinput DefectiveInventory" style="width:80px;border:1px solid #000;" value="0"/></span></span></td>'
                                + '<td><span><input name="goodItems" type="text" class="dfinput location" style="width:120px;border:1px solid #000;" value="'+ data[i]['cpae06'] +'"/><div class="localList" style="display:none;background-color:#D3D3D3;position:absolute;overflow:auto;width:299px;height:342px;"><table style="width:299px;" class="table8"><tr><td class="closeLocalList" style="cursor:pointer;">关闭</td></tr></table></div></span></span></td>'
                                + '<td><span><input name="goodItems" type="text" class="dfinput" style="width:120px;border:1px solid #000;" value="'+ data[i]['cpae22'] +'"/><input type="hidden" name="goodItems" value="'+ data[i]['cgac02'] +'"/></span></td>'
                                + '</tr>';
                    $('#getCheckeboxId').append(listInfo);
                }
                $('#showPsg').css('display','block');
            }
            if(data.res == 'error'){
                $('#getCheckeboxId').empty();
                $('#showPsg').css('display','none');
            }
            
        });
       
    });

    //提交保存
    /*$('#submitSave').on('click',function(){
        $('#tips').text('');
        var purchaseNo = $('#purchaseNo').val();  //输入的采购单号
        if(!$.trim(purchaseNo)){
            $('#tips').text('采购单号不能为空');
            return;
        }
        var goodItems = [];
        //获取单个或多个产品信息  
        $('.checkbox:checked').each(function(index,item){
            goodItems.push($(item).val());   
        }); 
        if(goodItems.length == 0){
            alert('请至少勾选一个款号');
            return;
        }
        var purchaseStatus = $('#purchaseStatus').val();
        if(purchaseStatus == '已提交保存'){
            $('#tips').text('该采购单已提交保存,请进行采购单入库操作');
            return;
        }

        $.post('index.php?r=cpgl/GeneratePurchaseNumber',{goodItems:goodItems,purchaseno:purchaseNo},function(data){
            if(!data){
                alert('提交保存失败');
                return;
            }
            if(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    $('#purchaseStatus').val(data.sign);
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
                if(data.res == 'tips'){
                    $('#tips').text(data.msg);
                    return;
                }
            }

        },'json');
    });*/

    //采购单入库(添加产品)
    $('#addGood').on('click',function(){
        $('#tips').text('');
        var purchaseNo = $('#purchaseNo').val();  //输入的采购单号
        if(!$.trim(purchaseNo)){
            $('#tips').text('采购单号不能为空');
            return;
        }
        var goodNum = [];
        $('.checkbox:checked').each(function(index,item){
            goodNum.push($(item).val());   
        }); 
        //勾选的商品数不能为空
        if(goodNum.length == 0){
            alert('请至少勾选一个款号');
            return;
        }
        var goodItems = [];
        //获取单个或多个产品信息  
        $('.checkbox:checked').parent().parent().parent().find('input[name="goodItems"]').each(function(index,item){
            goodItems.push($(item).val());   
        });  


        //对商品数量和商品价格进行正则验证
        var verification = false;
        $('.GenuInenventory').each(function(index,item){
            if (!regNumber.test($(item).val())) {
                $('#tips').empty();
                verification = true;
                $('#tips').append('<font style="color:#f00;">正品入库数和次品入库数只能是数字</font>');
                return;
            }
        });
        $('.DefectiveInventory').each(function(index,item){
            if (!regMoney.test($(item).val())) {
                $('#tips').empty();
                verification = true;
                $('#tips').append('<font style="color:#f00;">正品入库数和次品入库数只能是数字且最多是两位小数</font>');
                return;
            }
        });
        //正则验证不通过，则终止往下执行
        if(verification == true){
            return;
        }

        var supplier = $('#gys').text();//供应商
        var supplierId = $('#gys').attr('gysid');//供应商编号
        var fare = $('#fare').text();//运费
        var remark = $('#remark').text();//备注
        $.post('index.php?r=cpgl/PurchaseOrderStorage',{purchaseno:purchaseNo,goodItems:goodItems,supplierId:supplierId,supplier:supplier,fare:fare,remark:remark},function(data){
            if(!data){
                alert('入库失败');
                return;
            }
            if(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=wlgl/GetCprkHtml";
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
                if(data.res == 'tips'){
                    $('#tips').text(data.msg);
                    return;
                }
            }
        },'json');
    });

    //点击显示库位信息
    $('body').on('focus','.location',function(){  
        $.post('index.php?r=xtsz/GetTenWarehouseData',function(data){
            locationData(data);
        },'json');
        $(this).next('.localList').css('display','block');
    });

    //输入库位进行模糊搜索
    $('body').on('keyup','.location',function(){  
        var location = $(this).val();
        $.post('index.php?r=xtsz/GetTenWarehouseData',{location:location},function(data){
            locationData(data);
        },'json');
        $(this).next('.localList').css('display','block');
    });

    //点击关闭库位信息
    $('body').on('click','.closeLocalList',function(){
        $('.localList').css('display','none');
    });

    /**
     * @desc 库位信息获取数据插入节点
     * @author WuJunhua
     * @date 2016-01-22
     */
     function locationData(data){
        if(data){
            if(data != 'error'){
                $('.oneLocation').remove();
                if(data.list != undefined){
                    var length = data.list.length;
                    for(var i = 0; i < length; i++){
                        var listInfo = '';
                        listInfo = '<tr class="oneLocation">';
                        listInfo += '<td style="cursor:pointer;" class="local" localcationId="'+ data.list[i]['id'] +'"><span>'+ data.list[i]['place'] +'</span></td>'
                                    +'</tr>';
                        $('.table8').append(listInfo); 
                    }
                }
            }
        }
    }

    //点击选中库位并在页面上显示对应的信息
    $('body').on('click','.local',function(){
        var $this = $(this);
        var localcationId = $this.attr('localcationId');
        $.post('index.php?r=xtsz/GetSingleWarehouse',{id: localcationId},function(data){
            if(!data){
                return;
            }
            if(data){
                $this.parent().parent().parent().parent().parent().find('.location').val(data.place);
                $('.localList').css('display','none');
            }
        },'json');
    });

})

//查找采购单号
var httpHost = $('#httpHost').val();  //服务器地址
function showCzCgdh(){
    var dialog = new Dialog();
    dialog.Width=900;
    dialog.Height=600;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetCzCgdrkdhHtml";
    dialog.show();
}