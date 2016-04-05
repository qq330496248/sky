$(function(){
	var orderno = $("#id").val();
	$.post('index.php?r=ddgl/getObtainorderdetails',{orderno:orderno},function(data){
        if(!data){
            return;
        }
        if(data.res != 'error'){
            $('#Commoditydetails').empty();
            $('#Commodi').empty();
            var length = data.length;
            for(var i = 0; i < length; i++){
                var a = i+1;
                var listInfo = '';
                listInfo = '<tr>';
                listInfo += '<td style="width:10;"><input type="checkbox" ordernomx="'+data[i]['xsab03']+'" value="'+ data[i]['xsab01'] +'" class="checkbox"/>'+a+'</td>'
                listInfo +=   '<td><span class="number">'+ data[i]['xsab03'] +'</span></td>'
                            + '<td><span>'+ data[i]['xsab02'] +'</span></td>'
                            + '<td><input name="" type="text" class="dfinput spjg"  value="'+data[i]['xsab06']+'"/><input name="" type="button" class="btn-info changeprice" style="font-size:12px;width:50px;" orderprice="'+ data[i]['xsab03'] +'" value="改"/></span></td>'
                            + '<td><input name="" type="text" class="dfinput spsl"  value="'+data[i]['xsab04']+'"/><input name="" type="button" class="btn-info changeNumber" style="font-size:12px;width:50px;" value="改"/></td>'
                            + '<td><span>'+ data[i]['xsab07'] +'</span></td>'

                            + '</tr>';
                $('#Commoditydetails').append(listInfo);
            }
        }
    },'json');
});
var ordernum = $('#ordernum').val(); //订单序号
var orderno = $('#orderno').val();  //订单编号
//关闭弹窗
function closeDialog(){
	parentDialog.close();
}

 //点击显示商品信息
    $('body').on('focus','.goodName',function(){  
        $.post('index.php?r=cpgl/GetAllGoodList',function(data){
            goodListData(data);
        },'json');
        $(this).next('.goodList').css('display','block');
    });

 /**
     * @desc 商品信息获取数据插入节点
     * @author WuJunhua
     * @date 2016-01-22
     */
     function goodListData(data){
        if(data != 'error'){
            $('.oneGoodLine').remove();
            var length = data.length;
            for(var i = 0; i < length; i++){
                if(!data[i].cpae03){
                    data[i].cpae03 = '0.00';
                }
                var listInfo = '';
                listInfo = '<tr class="oneGoodLine" style="cursor:pointer;" goodid="'+ data[i].cpaa01 +'">';
                listInfo += '<td class="goodNumber"><span><font style="color:blue;">'+ data[i].cpaa01 +'</font>:'+ data[i].cpaa02 +'</span></td>'
                            + '<td style="width:50px;"><span>'+ data[i].cpaa10 +'</span></td>'
                            + '<td><span>'+ data[i].cpaa06 +'元</span></td>'
                            + '<td><span>库存'+ data[i].cpae03 +'</span></td>'
                            + '<td><span style="cursor:pointer;color:blue;" class="goodDetails" goodid="'+ data[i].cpaa01 +'">详细</span></td>'
                            +'</tr>';
                $('.table5').append(listInfo); 
            }
        }
    }

//点击关闭商品信息
$('body').on('click','.closeGoodList',function(){
    $('.goodList').css('display','none');
});

    //添加商品行
$('body').on('click','#addGoodsLine',function(){
    $('#tbody1').append('<tr class="goodline"><td><img src="public/img/del.png" title="删除该行" border="0" style="width:17%;cursor:pointer" class="delgoodline"/></td><td><input name="goodInfo" class="styleNum" style="border:1px solid #000;text-align:center;" type="text"/></td><td  style="position:relative;"><input name="goodInfo" class="goodName" style="border:1px solid #000;text-align:center;" type="text" /><div class="goodList" style="display:none;background-color:#D3D3D3;position:absolute;overflow:auto;width:474px;height:200px;z-index:5;"><table class="table5" style="width:474px;"><tr><td class="closeGoodList" style="cursor:pointer;" colspan="5">关闭</td></table></div></td><td class="unitPrice"><input name="goodInfo" style="border:1px solid #000;text-align:center;" type="text"  value="" class="goodPrice"/></td><td><input name="goodInfo" style="border:1px solid #000;text-align:center;" type="text"  value="1" class="goodNum"/></td><td class="little"><input name="goodInfo" type="text" value="" style="text-align:center;" readonly="readonly" class="subtotal"/><input class="stock" name="goodInfo" type="hidden" value="" /></td></tr>');
});

  //删除商品行
    $('#tbody1').on('click','.delgoodline',function(){
        $(this).parent().parent().remove();
    });

//点击选中商品并在页面上显示对应的信息
    $('body').on('click','.oneGoodLine',function(){
        var $this = $(this);
        var goodId = $this.attr('goodid');

        $.post('index.php?r=cpgl/GetGoodList',{goodid: goodId},function(data){
            if(!data){
                return;
            }
            if(data){
                $('#required').empty();
                $('#tips').empty();
                if (parseFloat(data.cpae03)<1 || !data.cpae03) {
                    $('#required').append('<font class="required" style="color:#f00;">该商品库存不足</font>');
                    $this.parent().parent().parent().parent().siblings().find('.styleNum').val(data.cpaa01);
                    $this.parent().parent().parent().siblings('.goodName').val(data.cpaa02);
                    $this.parent().parent().parent().parent().siblings().find('.goodPrice').val(data.cpaa06);
                    $this.parent().parent().parent().parent().siblings().find('.subtotal').val(data.cpaa06);
                    $this.parent().parent().parent().parent().siblings().find('.stock').val(data.cpae03);

                    $('#goodTotalPrice').text(data.cpaa06);
                    $('#goodTotalNum').text(1);
                    $('.goodList').css('display','none');
                    //获取小计的值
                    var totalPrice = [];
                    $('.subtotal').each(function(index,item){
                        totalPrice.push(parseFloat($(item).val()));   
                    });
                    var totPri = totalPrice.reduce(function(a,b){
                        return a + b;
                    });
            
                    //获取商品的数量
                    var goodNumArr = [];
                    $('.goodNum').each(function(index,item){
                        goodNumArr.push(parseFloat($(item).val()));   
                    });
                    var goodTotalNum = goodNumArr.reduce(function(a,b){
                        return a + b;
                    });

                    //显示商品总数、商品总价
                    if(isNaN(totPri)){
                        totPri = '';
                    }
                    if(isNaN(goodTotalNum)){
                        goodTotalNum = '';
                    }
                    $('#goodTotalPrice').text(totPri);
                    $('#goodTotalNum').text(goodTotalNum);
                    //订单实收总价
                    $('#ddsszj').val(totPri);
                    
                }

                if (parseFloat(data.cpae03)>0) {
                    $this.parent().parent().parent().parent().siblings().find('.styleNum').val(data.cpaa01);
                    $this.parent().parent().parent().siblings('.goodName').val(data.cpaa02);
                    $this.parent().parent().parent().parent().siblings().find('.goodPrice').val(data.cpaa06);
                    $this.parent().parent().parent().parent().siblings().find('.subtotal').val(data.cpaa06);
                    $this.parent().parent().parent().parent().siblings().find('.stock').val(data.cpae03);

                    $('#goodTotalPrice').text(data.cpaa06);
                    $('#goodTotalNum').text(1);
                    $('.goodList').css('display','none');
                    //获取小计的值
                    var totalPrice = [];
                    $('.subtotal').each(function(index,item){
                        totalPrice.push(parseFloat($(item).val()));   
                    });
                    var totPri = totalPrice.reduce(function(a,b){
                        return a + b;
                    });
                
                    //获取商品的数量
                    var goodNumArr = [];
                    $('.goodNum').each(function(index,item){
                        goodNumArr.push(parseFloat($(item).val()));   
                    });
                    var goodTotalNum = goodNumArr.reduce(function(a,b){
                        return a + b;
                    });

                    //显示商品总数、商品总价
                    if(isNaN(totPri)){
                        totPri = '';
                    }
                    if(isNaN(goodTotalNum)){
                        goodTotalNum = '';
                    }
                    $('#goodTotalPrice').text(totPri);
                    $('#goodTotalNum').text(goodTotalNum);
                    //订单实收总价
                    $('#ddsszj').val(totPri);
                }
            }
        },'json');
    });

 //改价格
    $('body').on('click','.changeprice',function(){
        var orderno = $("#id").val();
        var spjg = $(this).siblings().val();//商品价格
        if (!spjg) {
                alert('价格不能为空');
                return;
        }
        //金额验证
        var regMoney = /^[0-9]+(.[0-9]{1,2})?$/;
        if (spjg.length != 0){
            if (!regMoney.test(spjg)) {
                alert('商品价格最多是两位小数，请重新输入');
                return;
            }
        }
        var ensure=confirm('确定把价格改为'+spjg+'吗');
        if(ensure){
            var goodNum = $(this).parent().siblings().find('.number').text();//款号
            var spsl = $(this).parent().siblings().find('.spsl').val();//数量
            var xiaoji=parseFloat(spjg)*parseFloat(spsl);
            $.post('index.php?r=ddgl/ChangeOrderprice',{orderno:orderno,spjg:spjg,goodNum:goodNum,xiaoji:xiaoji,spsl:spsl},function(data){
                if(data){
                    
                    if(data.res == 'success'){
                        alert(data.msg);
                        parent.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
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

    var regMoney = /^[0-9]+(.[0-9]{1,2})?$/;
    //改数量
    $('body').on('click','.changeNumber',function(){
        var orderno = $("#id").val();
        var spsl = $(this).siblings().val();//商品数量
        if (!spsl) {
            alert('数量不能为空');
            return;
        }
        if (!regMoney.test(spsl)) {
            alert('数量只能是数字且最多是两位小数');
            return;
        }
        var ensure=confirm('确定把数量改为'+spsl+'吗');
        if(ensure){
            var goodNum = $(this).parent().siblings().find('.number').text();//款号
            var spjg = $(this).parent().siblings().find('.spjg').val();//商品价格
            var xiaoji=parseFloat(spjg)*parseFloat(spsl);
            $.post('index.php?r=ddgl/ChangeOrderNumber',{orderno:orderno,goodNum:goodNum,xiaoji:xiaoji,spsl:spsl},function(data){
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        //parentDialog.close();
                        parent.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
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

     //验证商品名称是否存在
    $('body').on('change','.goodName',function(){
        var goodName = $(this).val();
        $.post('index.php?r=cpgl/CheckGoodsNameIsExits',{goodName:goodName},function(data){
            if(data.res == 'tips'){
                $('#required').empty();
                $('#required').append('<font style="color:#f00;">'+data.msg+'</font>');
                $this.val(1);
                $this.parent().siblings().find('.styleNum').val('');
                $this.parent().siblings().find('.goodName').val('');
                $this.parent().siblings().find('.goodPrice').val('');
                $this.parent().siblings().find('.subtotal').val('');
                return;
            }
            if(data.res == 'success'){
                $('#required').empty();
            }     
        },'json');
    });
    //var regGoodNumber = /^\+?[1-9][0-9]*$/;
    //验证款号是否存在
    $('body').on('change','.styleNum',function(){
        var goodNumber = $(this).val();  
        if(!regGoodNumber.test(goodNumber)){
            $('#required').empty();
            $('#required').append('<font style="color:#f00;">商品款号必须是正整数</font>');
            return;
        }      
        $.post('index.php?r=cpgl/CheckGoodsNumberIsExits',{goodNumber:goodNumber},function(data){
            if(data.res == 'tips'){
                $('#required').empty();
                $('#required').append('<font style="color:#f00;">'+data.msg+'</font>');
                $this.val(1);
                $this.parent().siblings().find('.styleNum').val('');
                $this.parent().siblings().find('.goodName').val('');
                $this.parent().siblings().find('.goodPrice').val('');
                $this.parent().siblings().find('.subtotal').val('');
                return;
            }
            if(data.res == 'success'){
                $('#required').empty();
            }     
        },'json');
    });

   //验证库存是否足够
    $('body').on('change','.goodNum',function(){
        var $this = $(this);
        var goodNum = $this.val();
        var kcl = $this.parent().siblings().find('.stock').val();
        var goodname = $this.parent().siblings().find('.goodName').val();

        if (parseFloat(kcl)-parseFloat(goodNum)<1) {
            var ensure = confirm('商品:'+"+goodname+"+'库存不足,是否继续添加？');
            if (!ensure) {
                $this.val(1);
                $this.parent().siblings().find('.styleNum').val('');
                $this.parent().siblings().find('.goodName').val('');
                $this.parent().siblings().find('.goodPrice').val('');
                $this.parent().siblings().find('.subtotal').val('');
            }
        }
    });

    //输入商品名称进行模糊搜索
    $('body').on('keyup','.goodName',function(){  
        var goodName = $(this).val();
        $.post('index.php?r=cpgl/GetAllGoodList',{goodName:goodName},function(data){
            goodListData(data);
        },'json');
        $(this).next('.goodList').css('display','block');  
    });

//改变商品数量时，修改商品小计、商品总价、商品总数
$('body').on('change','.goodNum',function(){
    var $this = $(this);
    var goodNumber = $this.val();
    var goodPrice = $this.parent().siblings('.unitPrice').find('.goodPrice').val();
    var subtotal = goodPrice*goodNumber;
    $this.parent().siblings('.little').find('.subtotal').val(subtotal);
    //获取小计的值
    var totalPrice = [];
    $('.subtotal').each(function(index,item){
        totalPrice.push(parseFloat($(item).val()));   
    });
    var totPri = totalPrice.reduce(function(a,b){
        return a + b;
    });
    //获取商品的数量
    var goodNumArr = [];
    $('.goodNum').each(function(index,item){
        goodNumArr.push(parseInt($(item).val()));   
    });
    var goodTotalNum = goodNumArr.reduce(function(a,b){
        return a + b;
    });
    //显示商品总数、商品总价
    $('#goodTotalPrice').text(totPri);
    $('#goodTotalNum').text(goodTotalNum);
    //订单实收总价
    $('#ddsszj').val(totPri);
});


//提交保存
$('#addOrder').on('click',function(){
	var orderno = $("#id").val();
    var ordernomx = [];
    $('.checkbox:checked').each(function(index,item){
        ordernomx.push($(item).attr('ordernomx'));  
    });
    var goodItems = [];
    //获取单个或多个商品信息  
    $('.goodline').find('input[name="goodInfo"]').each(function(index,item){
        goodItems.push($(item).val());   
    }); 

    var goodkuanhao = [];
   //获取商品的款号（所有商品行的商品款号）
     $('.styleNum').each(function(index,item){
         goodkuanhao.push(parseInt($(item).val()));   
     });

    var goodTotalPrice = $('#goodTotalPrice').text(); //商品总价
    var goodTotalNum = $('#goodTotalNum').text(); //商品总数
    /*var styleNum = $('.styleNum').val();//商品款号（单个商品）*/
    var goodTotalNum = $('#goodTotalNum').text(); //商品总数

    //对商品数量和商品价格进行正则验证
        var verification = false;
        $('.goodNum').each(function(index,item){
            if (!regNumber.test($(item).val())) {
                $('#required').empty();
                verification = true;
                $('#required').append('<font class="required" style="color:#f00;">商品单价只能是数字且最多是两位小数</font>');
                return;
            }
        });
        $('.goodPrice').each(function(index,item){
            if (!regMoney.test($(item).val())) {
                $('#required').empty();
                verification = true;
                $('#required').append('<font class="required" style="color:#f00;">商品单价只能是数字且最多是两位小数</font>');
                return;
            }
        });
        //正则验证不通过，则终止往下执行
        if(verification == true){
            return;
        }


    $.post('index.php?r=ddgl/ChangeOrderAudit',{ordernomx:ordernomx,orderno:orderno,goodItems:goodItems,goodTotalPrice:goodTotalPrice,goodTotalNum:goodTotalNum,goodkuanhao:goodkuanhao},function(data){
        if(data){
            if(data.res == 'tips'){
                $('#required').empty();
                $('#required').append('<font style="color:#f00;">'+data.msg+'</font>');
                return;
            }
            if(data.res == 'success'){
                alert(data.msg);
                parent.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
                return;
            }
            if(data.res == 'error'){
                alert(data.msg);
                return;
            }
            if(data.res == 'sph'){
                alert(data.msg);
                return;
            }
        }
    },'json');
});

//删除商品
$('#deletecomm').on('click',function(){
	var orderno = $("#id").val();
    var ordernomx = [];
    $('.checkbox:checked').each(function(index,item){
        ordernomx.push($(item).attr('ordernomx'));  
    });
    if(ordernomx.length == 0){
        alert('请选择要删除的商品');
        return;
    } 
    var ensure=confirm('确定要删除所选商品吗？');
    if(ensure){
        $.post('index.php?r=ddgl/DeleteCommodity',{orderno:orderno,ordernomx:ordernomx},function(data){
            if(data){
            
                if(data.res == 'success'){
                    alert(data.msg);
                    parent.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
                    parentDialog.close();
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
             }
        },'json')
    }
});


//点击详情按钮
    $('body').on('click','.goodDetails',function(){
        var $this = $(this);
        var goodId = $this.attr('goodid');
        $("#goodid").val(goodId);
        
        var dialog = new Dialog();
        dialog.Modal=false;
        dialog.Width=600;
        dialog.Height=450;
        dialog.URL="http://localhost/ccs/index.php?r=dialog/GetSpxqHtml&goodId="+goodId;
        dialog.show();
    });