$(function(){
    /**
     * @desc 加载页面时判断该客户3天内有没重复下单
     * @author WuJunhua
     * @date 2015-11-03
     */
    var clientno = $('#clientno').text();//客户编号
    $.post('index.php?r=ddgl/CheckClientOrder',{clientno:clientno},function(data){
        if(data){
            $('#notice').css("display","block");
            var length = data.length;
            for(var i = 0; i < length; i++){
                var listInfo = '';
                var a = i+1;
                listInfo = '<tr>';
                listInfo += '<td><span style="padding-right:10px;"><font style="color:red;">'+a+'.订单ID：</font><a class="canJumpPage" href="index.php?r=ddgl/OrderDetails&orderno='+ data[i]['xsaa02'] +'&ordernum='+ data[i]['xsaa01'] +'">'+ data[i]['xsaa02'] +'</a></span></td>'
                         + '<td><span style="color:red;padding-right:10px;">订单金额：'+ data[i]['xsaa19'] +'</span></td>'
                         + '<td><span style="color:red;padding-right:10px;">状态：'+ data[i]['xsaa29'] +'</span></td>'
                         + '<td><span style="color:red;padding-right:10px;">下单工号：'+ data[i]['xsaa48'] +'</span></td>'
                         + '<td><span style="color:red;">下单时间：'+ data[i]['xsaa23'] +'</span></td>'
                         + '</tr>';
                $('#tbody5').append(listInfo);
            }
        }
    },'json');

	//客户查找下拉特效
    $("#khcz").click(function(){
        $("#khczxx").slideToggle("slow");
    });
    //订单信息下拉特效
    $("#ddxx").click(function(){
        $("#ddxxxx").slideToggle("slow");
    });

    /**
     * @desc 添加和删除商品行的特效
     * @author WuJunhua
     * @date 2015-11-03
     */
     //添加商品行
    $('body').on('click','#addGoodsLine',function(){
        $('#tbody1').append('<tr class="goodline"><td><img src="public/img/del.png" title="删除该行" border="0" style="width:17%;cursor:pointer" class="delgoodline"/></td><td><input name="goodInfo" class="styleNum" style="border:1px solid #000;text-align:center;" type="text"/></td><td  style="position:relative;"><input name="goodInfo" class="goodName" style="border:1px solid #000;text-align:center;" type="text" /><div class="goodList" style="display:none;background-color:#D3D3D3;position:absolute;overflow:auto;width:550px;height:342px;z-index:5;"><table class="table5" style="width:550px;"><tr><td class="closeGoodList" style="cursor:pointer;" colspan="5">关闭</td></table></div></td><td class="unitPrice"><input name="goodInfo" style="border:1px solid #000;text-align:center;" type="text"  value="" class="goodPrice"/></td><td><input name="goodInfo" style="border:1px solid #000;text-align:center;" type="text"  value="1" class="goodNum"/></td><td class="little"><input name="goodInfo" type="text" value="" style="text-align:center;" readonly="readonly" class="subtotal"/><input class="stock" name="goodInfo" type="hidden" value="" /></td></tr>');
    });
    //删除商品行
    $('#tbody1').on('click','.delgoodline',function(){
        $(this).parent().parent().remove();
        //计算商品总价
        var totalPrice = 0;
        $('.subtotal').each(function(index,item){
            totalPrice += parseFloat($(item).val());   
        });
        //计算商品总数
        var goodTotalNum = 0;
        $('.goodNum').each(function(index,item){
            goodTotalNum += parseFloat($(item).val());   
        });

        //显示商品总数、商品总价
        if(isNaN(totalPrice)){
            totalPrice = '';
        }
        if(isNaN(goodTotalNum)){
            goodTotalNum = '';
        }
        $('#goodTotalPrice').text(totalPrice);
        $('#goodTotalNum').text(goodTotalNum);

    });

    //添加订单
    $('body').on('click','#addOrder',function(){
        $('#required').empty();
        $('#tips').empty();
        var gsgh = $('#gsgh').text();//归属工号
        var dlxm = $('#gsgh').attr('user');//登录姓名
        var clientno = $('#clientno').text();//客户编号
        var khname = $('#khname').val();//客户姓名
        var khphone = $('#khphone').val();//客户手机
        var telphone = $('#telphone').val();//客户电话
        var province = $("option[name='province']:checked").val(); //省份
        var city = $("option[name='city']:checked").val(); //城市
        var area = $("option[name='area']:checked").val(); //区县
        var deaddress = $('#deaddress').val();//地址
        var postcode = $('#postcode').val();//邮编

        var ddyf = $('#ddyf').val();//订单运费
        var ddsszj = $('#ddsszj').val();//订单实收总价
        var ysdj = $('#ysdj').val();//已收定金
        var ddlx = $("option[name='ddlx']:checked").val();//订单类型
        var zffs = $("option[name='zffs']:checked").val();//支付方式
        var kdgs = $("option[name='kdgs']:checked").val();//快递公司
        var fplx = $("option[name='fplx']:checked").val();//发票类型
        var ddyj = $('#orderPerformance').text(); //订单业绩
        var goodItems = [];
        //获取单个或多个商品信息  
        $('.goodline').find('input[name="goodInfo"]').each(function(index,item){
            goodItems.push($(item).val());   
        });

        //对商品数量和商品价格进行正则验证
        var verification = false;
        $('.goodNum').each(function(index,item){
            if (!regNumber.test($(item).val())) {
                $('#required').empty();
                verification = true;
                $('#required').append('<font class="required" style="color:#f00;">商品数量只能是数字</font>');
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

        var goodTotalPrice = $('#goodTotalPrice').text(); //商品总价
        var goodTotalNum = $('#goodTotalNum').text(); //商品总数
        var goodkuanhao = [];
        //获取商品的款号（所有商品行的商品款号）
         $('.styleNum').each(function(index,item){
             goodkuanhao.push(parseInt($(item).val()));   
         });

        //前台验证
        if(!clientno){
            $('#required').append('<font class="required" style="color:#f00;">客户编号不能为空</font>');
            return;
        }
        if(!gsgh){
            $('#required').append('<font class="required" style="color:#f00;">归属工号不能为空</font>');
            return;
        }
        if(!khname){
            $('#required').append('<font class="required" style="color:#f00;">收货人姓名不能为空</font>');
            return;
        }
        if(!khphone){
            $('#required').append('<font class="required" style="color:#f00;">手机号不能为空</font>');
            return;
        }
        
        if (!regPhone.test(khphone)) {
            $('#required').append('<font class="required" style="color:#f00;">手机号码的格式有误，请重新输入</font>');
            return;
        }
        if(!province || !city || !area){
            $('#required').append('<font class="required" style="color:#f00;">地区不能为空</font>');
            return;
        }
        if(!deaddress){
            $('#required').append('<font class="required" style="color:#f00;">详细地址不能为空</font>');
            return;
        }
        var goodName = $('.goodName').val();
        if(!goodName){
            $('#required').append('<font class="required" style="color:#f00;">商品名称不能为空</font>');
            return;
        }
        if(!ddsszj){
            $('#required').append('<font class="required" style="color:#f00;">订单实收总价不能为空</font>');
            return;
        }
                
        if (!regMoney.test(ddyf)) {
            $('#tips').append('<font class="tips" style="color:#f00;">运费只能是数字且最多是两位小数</font>');
            return;
        }
        if (!regMoney.test(ddsszj)) {
            $('#tips').append('<font class="tips" style="color:#f00;">订单实收总价只能是数字且最多是两位小数</font>');
            return;
        }
        if (!regMoney.test(ysdj)) {
            $('#tips').append('<font class="tips" style="color:#f00;">已收定金只能是数字且最多是两位小数</font>');
            return;
        }
        if(parseFloat(ysdj) > parseFloat(ddsszj)){
            $('#tips').append('<font class="tips" style="color:#f00;">已收定金不能大于订单实收总价</font>');
            return;
        }
        /*if (zffs == '货到付款') {
            if(parseFloat(ysdj) >= parseFloat(ddsszj)){
                $('#tips').append('<font class="tips" style="color:#f00;">货到付款的订单已收定金必须小于或等于订单实收总价</font>');
                return;
            }
        }*/
        if(parseFloat(goodTotalPrice) != parseFloat(ddsszj)){
            var ensure = confirm('商品总价与订单实收总价不相等,确定要下单吗？');
            if(!ensure){
                return;
            }
        }

        if(zffs == '免费已付'){
            var con = confirm('该订单的支付方式为免费支付,确定要下单吗？');
            if(!con){
                return;
            }
        }
        
        $.post('index.php?r=ddgl/AddOrder',{gsgh:gsgh,dlxm:dlxm,clientno:clientno,khname:khname,khphone:khphone,telphone:telphone,ddyf:ddyf,ddsszj:ddsszj,ysdj:ysdj,ddlx:ddlx,zffs:zffs,kdgs:kdgs,fplx:fplx,province:province,city:city,area:area,deaddress:deaddress,postcode:postcode,goodItems:goodItems,goodTotalPrice:goodTotalPrice,goodTotalNum:goodTotalNum,ddyj:ddyj,goodkuanhao:goodkuanhao},function(data){
            if(data){
                if(data.res == 'tips'){
                    $('#required').append('<font style="color:#f00;">'+data.msg+'</font>');
                    return;
                }
                if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=ddgl/GetKhddHtml";
                        return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
            }
        },'json');
    });

    //点击显示商品信息
    $('body').on('focus','.goodName',function(){
        $.post('index.php?r=cpgl/GetAllGoodList',function(data){
            goodListData(data);
        },'json');
        $(this).next('.goodList').css('display','block');
    });

    //输入商品名称进行模糊搜索
    $('body').on('keyup','.goodName',function(){  
        var goodName = $(this).val();
        $.post('index.php?r=cpgl/GetAllGoodList',{goodName:goodName},function(data){
            goodListData(data);
        },'json');
        $(this).next('.goodList').css('display','block');  
    });

    //点击关闭商品信息
    $('body').on('click','.closeGoodList',function(){
        $('.goodList').css('display','none');
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
                            + '<td class="goodDetails"><span style="cursor:pointer;color:blue;" goodid="'+ data[i].cpaa01 +'">详细</span></td>'
                            +'</tr>';
                $('.table5').append(listInfo); 
            }
        }
    }

    //点击详情按钮
    $('body').on('click','.goodDetails',function(){
        var $this = $(this);
        var goodId = $this.attr('goodid');
        $("#goodid").val(goodId);
        $.post('index.php?r=cpgl/GetGoodList',{goodid: goodId},function(data){
            if(!data){
                return;
            }
            if(data){
                $('#spkh').text(data.cpaa01);
                $('#spgg').text(data.cpaa10);
                $('#spmc').text(data.cpaa02);
                $('#xsj').text(data.cpaa06);
                $('#sptp').attr("src",data.cpaa13);
                $('#xxms').text(data.cpaa12);
            }
        })
        //$('#goodDetilDiv').show();

        var dialog = new Dialog();
        dialog.Modal=false;
        dialog.Width=600;
        dialog.Height=450;
        dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetSpxqHtml&goodId="+goodId;
        dialog.show();
    });

    //点击关闭商品信息
    $('body').on('click','#closeDetail',function(){
        $('#goodDetilDiv').hide();
    });

   //$('body').on('click','#MinPerformance',function(){
        //提示初始化
        /*$('#showRatio').text(''); 
        $('.gonghao').remove();
        $('#addJobNum').removeAttr("disabled");*/
    //    $('#orderSeparateAchievement').show();

        /*var dialog = new Dialog();
        dialog.Modal=false;
        dialog.Width=600;
        dialog.Height=450;
        dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetTjddfyjHtml";
        dialog.show();
    });*/

     //点击关闭订单分业绩弹框
    /*$('body').on('click','#cancelJobNum',function(){
        $('#orderSeparateAchievement').hide();
    });*/

  $('#MinPerformance').on('click',function(){
        var dialog = new Dialog();
        dialog.Modal = false;
        dialog.Width=710;
        dialog.Height=450;
        dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetDdfyjHtml";
        dialog.show();
    });


    /**
     * @desc 增加工号
     * @author WuJunhua
     * @date 2015-11-11
     */
    $('body').on('click','#addJobNum',function(){
        var JnLine = $('.JnLine').length;
        var length = JnLine+1;
        if(length == 4){
            $('#addJobNum').attr("disabled","disabled");
        }
        $('#table8').append('<tr class="JnLine gonghao"><td>工号'+length+'<font></font>： <input class="showNumber" style="border:1px solid #000;" type="text" name="" value=""/><div class="workNumberList" style="display:none;background-color:#D3D3D3;position:absolute;overflow:auto;width:200px;height:150px;z-index:5;"><table style="width:400px;" class="table3"><tr><td class="closeNumberList" style="cursor:pointer;">关闭</td></tr></table></div></td><td style="padding-left:30px;">业绩比例：<select style="width:60px;height:20px;" name="" id=""><option name="yjbl" value="1">1</option><option name="yjbl" value="0.9">0.9</option><option name="yjbl" value="0.8">0.8</option><option name="yjbl" value="0.7">0.7</option><option name="yjbl" value="0.6">0.6</option><option name="yjbl" value="0.5">0.5</option><option name="yjbl" value="0.4">0.4</option><option name="yjbl" value="0.3">0.3</option><option name="yjbl" value="0.2">0.2</option><option name="yjbl" value="0.1">0.1</option></select></td></tr>');
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

   //验证库存是否足够
    $('body').on('change','.goodNum',function(){
        var $this = $(this);
        var goodNum = $this.val();
        var kcl = $this.parent().siblings().find('.stock').val();
        var goodname = $this.parent().siblings().find('.goodName').val();

        if (parseFloat(kcl)-parseFloat(goodNum)<1) {
            var ensure = confirm('商品:'+goodname+'库存不足,是否继续添加？');
            if (!ensure) {
                $this.val(1);
                $this.parent().siblings().find('.styleNum').val('');
                $this.parent().siblings().find('.goodName').val('');
                $this.parent().siblings().find('.goodPrice').val('');
                $this.parent().siblings().find('.subtotal').val('');
            }
        }
    });

    //改变商品数量时，修改商品小计、商品总价、商品总数
    $('body').on('change','.goodNum',function(){
        var $this = $(this);
        var goodNumber = $this.val();
        /*$('#required').empty();
        if(!regMoney.test(goodNumber)){
            $('#required').append('<font style="color:#f00;">数量只能是数字且最多是两位小数</font>');
            return;
        }*/
        var goodPrice = $this.parent().siblings('.unitPrice').find('.goodPrice').val();
        var subtotal = goodPrice*goodNumber;
        if(isNaN(subtotal)){
            subtotal = '';
            return;
        }
        
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
    });

    //改变商品单价时，修改商品小计、商品总价、商品总数
    $('body').on('change','.goodPrice',function(){
        var $this = $(this);
        var goodPrice = $this.val();
        /*$('#required').empty();
        if(!regMoney.test(goodPrice)){
            $('#required').append('<font style="color:#f00;">商品单价只能是数字且最多是两位小数</font>');
            return;
        }*/
        var goodNumber = $this.parent().siblings().find('.goodNum').val();
        var subtotal = goodPrice*goodNumber;
        if(isNaN(subtotal)){
            subtotal = '';
            return;
        }
        
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
            goodNumArr.push(parseFloat($(item).val()));   
        });
        var goodTotalNum = goodNumArr.reduce(function(a,b){
            return a + b;
        });
        //显示商品总数、商品总价
        (totPri == NaN) ? 0 : totPri;
        $('#goodTotalPrice').text(totPri);
        $('#goodTotalNum').text(goodTotalNum);
        //订单实收总价
        $('#ddsszj').val(totPri);
    });

    //验证商品名称是否存在
    $('body').on('change','.goodName',function(){
        var goodName = $(this).val();        
        $.post('index.php?r=cpgl/CheckGoodsNameIsExits',{goodName:goodName},function(data){
            if(data.res == 'tips'){
                $('#required').empty();
                $('#required').append('<font style="color:#f00;">'+data.msg+'</font>');
                return;
            }
            if(data.res == 'success'){
                $('#required').empty();
            }     
        },'json');
    });
    
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
                return;
            }
            if(data.res == 'success'){
                $('#required').empty();
            }     
        },'json');
    });

    //点击显示所有工号
    $('body').on('focus','.showNumber',function(){  
        $.post('index.php?r=ddgl/GetAllWorkNumber',function(data){
            if(data != 'error'){
                $('.oneNumberLine').remove();
                var length = data.length;
                for(var i = 0; i < length; i++){
                    var listInfo = '';
                    listInfo = '<tr class="oneNumberLine">';
                    listInfo += '<td class="workNumber" workid="'+ data[i].id +'"><span style="cursor:pointer;">'+ data[i].username +':'+ data[i].personname +'</span></td>'
                                +'</tr>';
                    $('.table3').append(listInfo); 
                }
            }
        },'json');
        $(this).next('.workNumberList').css('display','block');
    });

    //点击关闭工号信息
    $('body').on('click','.closeNumberList',function(){
        $('.workNumberList').css('display','none');
    });

    //点击选中工号并显示对应的信息
    $('#table8').on('click','.workNumber',function(){
        var $this = $(this);
        var workid = $this.attr('workid');
        $.post('index.php?r=ddgl/GetWorkNumberList',{workid: workid},function(data){
            if(!data){
                return;
            }
            if(data){
                $this.parent().parent().parent().parent().siblings('.showNumber').val(data);
                $('.workNumberList').css('display','none');
            }
        },'json');
    });

    /*//点击'提交保存' 分业绩
    $('body').on('click','#saveJobNum',function(){
        $('#showRatio').text(); //提示初始化
        var JnLine = $('.JnLine').length;
        if(JnLine == 1){
            var showNumber = $('.showNumber').val(); //当前操作工号
            var loginNumber = $('#currentNum').val(); //登录工号
            var numIndex = showNumber.indexOf(':');
            var currentBL =  $("option[name='yjbl']:checked").val();
            if(parseInt(currentBL) != 1){
                $('#showRatio').text('比例相加必须等于1');
                return;
            }
            var numName = showNumber.substr(0,numIndex);
            var newShowNum = numName+':'+currentBL;
            var ensure = confirm('真的确定提交业绩分配吗？');
            if(ensure){
                $('#orderPerformance').text(newShowNum);
                $('#orderSeparateAchievement').hide();
            }
        }

        if(JnLine > 1){
            var sign = 1;  //判断数组中有没有值为空的标识
            var workNumArr = []; //获取多个工号姓名
            var numberArr = []; //获取多个工号
            var ratio = [];
            $('.showNumber').each(function(index,item){
                if($(item).val() == ''){
                    sign = 0;
                }
                workNumArr.push($(item).val());  
            });
            if(sign == 0){
                $('#showRatio').text('工号不能为空');
                return;
            }

            for(var i=0;i<workNumArr.length;i++){
                var index = workNumArr[i].indexOf(':');
                var name = workNumArr[i].substr(0,index);
                numberArr.push(name);
            }
            $("option[name='yjbl']:checked").each(function(index,item){
                ratio.push($(item).val()); 
            });
            var bili = ratio.reduce(function(a,b){
                return parseFloat(a) + parseFloat(b);
            });
            if(bili != '1'){
                $('#showRatio').text('比例相加必须等于1');
                return;
            }else{
                $('#showRatio').text('');
            }

            var sure = confirm('真的确定提交业绩分配吗？');
            if(sure){
                var servalNum = '';
                for(var a=0;a<numberArr.length;a++){
                    servalNum += numberArr[a]+':'+ratio[a]+'*';
                }
                servalNum = servalNum.substring(0,servalNum.length-1); //去掉最后一个字符串
                $('#orderPerformance').text(servalNum);
                $('#orderSeparateAchievement').hide();
            }
            
        }
    });*/

});

var httpHost = $('#httpHost').val();  //服务器地址
//点击显示订单分业绩弹框
function showDdfyj(){
    var dialog = new Dialog();
    dialog.Width = 500;
    dialog.Height = 400;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetTjddfyjHtml";
    dialog.show();
}

