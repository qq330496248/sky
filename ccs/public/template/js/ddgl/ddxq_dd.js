$(function(){
    //$("#khczxx").slideToggle("toggle");
    //跟进记录下拉特效
    $("#gjjl").click(function(){
        $(".gjjlxx").slideToggle("slow");
    });

    var ordernum = $('#ordernum').val(); //订单序号
    var orderno = $('#orderno').val();  //订单编号
    var clientno = $('#clientno').val(); //客户编号

	//修改客户订单信息
	$('body').on('click','#saveOrder',function(){
		var xdr = $('#xdr').text(); //下单人
		var yjfp = $('#orderPerformance').text(); //业绩分配
	    var khname = $('#khname').val();//客户姓名
	    var khphone = $('#mobilePhone').val();//客户手机
	    var telphone = $('#telphone').val();//客户电话
	    var province = $("option[name='province']:checked").val(); //省份
        var city = $("option[name='city']:checked").val(); //城市
        var area = $("option[name='area']:checked").val(); //区县
        var deaddress = $('#deaddress').val();//地址
        var postcode = $('#postcode').val();//邮政编码
	    var kddh = $('#kddh').val();//快递单号
	    var xdsj = $('#xdsj').val();//下单时间
	    var ddje = $('#ddje').val();//订单金额
	    var khysdj =$('#khysdj').val();//已收定金
	    var dsje =$('#dsje').val();//代收金额
	    var khddyf = $('#khddyf').val();//订单运费
	    var khddbz = $('#khddbz').val();//备注
	    var khfplx = $("option[name='khfplx']:checked").val();//发票类型
	    var ddzffs = $("option[name='ddzffs']:checked").val();//支付方式
	    var ddkdgs = $("option[name='ddkdgs']:checked").val();//快递公司
        var goodsTotalPrice = $('#goodsTotalPrice').text(); //商品总价
        if (khphone.length != 0){
            if (!regMobliePhone.test(khphone)) {
                alert('手机号码格式有误,请重新输入');
                return;
            }
        }
        if (telphone.length != 0){
            if (!regPhone.test(telphone)) {
                alert('客户电话格式错误,请重新输入');
                return;
            }
        }
        if (khysdj.length != 0){
            if (!regMoney.test(khysdj)) {
                alert('已收定金只能是数字且最多是两位小数');return;
            }
        }
        if(parseFloat(khysdj) > parseFloat(ddje)){
            alert('已收定金不能大于订单金额');
            return;
        }
        /*if (ddzffs=='货到付款') {
            if(parseFloat(khysdj) >= parseFloat(ddje)){
                alert('货到付款的订单已收定金必须小于订单实收总价');
                return;
            }
        }*/
        if(ddzffs == '免费已付'){
            var con = confirm('该订单的支付方式为免费支付,确定要保存吗？');
            if(!con){
                return;
            }
        }
        if(parseFloat(goodsTotalPrice) != parseFloat(ddje)){
            alert('订单金额与商品总价不相等,请重新操作');
            return;
        }

		$.post('index.php?r=ddgl/UpdateOrderMsg',{orderno:orderno,xdr:xdr,yjfp:yjfp,khname:khname,khphone:khphone,telphone:telphone,khysdj:khysdj,khddyf:khddyf,khddbz:khddbz,khfplx:khfplx,ddzffs:ddzffs,ddkdgs:ddkdgs,ddje :ddje,province:province,city:city,area:area,deaddress:deaddress,postcode:postcode,dsje:dsje,xdsj:xdsj,kddh:kddh},function(data){
            if(data){
            	if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
            }
		},'json');
	})

	//把订单设为作废
	$('body').on('click','#useless',function(){
		var ensure = confirm('真的要作废吗？');
		if(ensure){
			$.post('index.php?r=ddgl/SetOrderUseless',{orderno:orderno},function(data){
	            if(!data){
	            	return;
	            }
                if(data){
                    if(data.res == 'success'){
                        $('#useless').remove();
                        window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
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

	//删除客户订单
	$('#delete').on('click',function(){
		var ensure=confirm('你确定要删除这个订单吗？');
		if(ensure){
			$.post('index.php?r=ddgl/DeleteOrderData',{orderno :orderno},function(data){
				if(!data){
					return;
				}
                if(data){
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
			},'json')
		}
	})

	//单个确认到提审
	$('#confirmCheck').on('click',function(){
		var orderid = [$('#orderno').val()];
        var goodsTotalPrice = $('#goodsTotalPrice').text();
        var ddje = $('#ddje').val();
        if(parseFloat(goodsTotalPrice) != parseFloat(ddje)){
            alert('订单金额与商品总价不相等,请重新操作');
            return;
        }
		if(orderid.length != 0){
			var ensure = confirm('真的要确认么？该操作不能撤销，请认真审核！');
			if(ensure){
				$.post('index.php?r=ddgl/ConfirmToDeliverOrders',{orderno :orderid},function(data){
					if(!data){
						return;
					}
                    if(data){
                        if(data.res == 'success'){
                            alert(data.msg);
                            window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
                            return;
                        }
                        if(data.res == 'error'){
                            alert(data.msg);
                            return;
                        }
                    }
				},'json');
			}
		}
	})

	//确认收货
	$('body').on('click','#receiving',function(){
		var ensure = confirm('真的要设为收货么？(该操作无法撤销，请认真审核！)');
		if(ensure){
			$.post('index.php?r=ddgl/ConfirmReceiving',{orderno:orderno},function(data){
	            if(!data){
	            	return;
	            }
				if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
                        return;
                    }
                    if(data.res == 'error'){
                        alert(data.msg);
                        return;
                    }
                }
			},'json');
		}
	})
	
    //获取订单的商品信息
    $.post('index.php?r=ddgl/GetOrderDetailGoodsMsg',{orderno:orderno},function(data){
    	if(!data){
        	return;
        }
		if(data.res != 'error'){
			var goodsTotalNum = data[0]['xsaa42'];
			var goodsTotalPrice = data[0]['xsaa19'];
			var goodsTotalOriginalPrice = data[0]['xsaa17'];
			var length = data.length;
			for(var i = 0; i < length; i++){
				if(!data[i]['cpae03']){
					data[i]['cpae03'] = 0;
				}
				if(data[i]['xsab10'] == 0.00){
					data[i]['xsab10'] = '';
				}
				var listInfo = '';
				listInfo = '<tr>';
				if(data[i]['xsaa49'] == ''){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'</span></td>' 
                }
                if(data[i]['xsaa49'] == '退' && data[i]['xsab20'] == '未'){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'<font style="color:#f00;">['+ data[i]['xsaa49'] +']</font><font style="color:#f00;">['+ data[i]['xsab20'] +']</font></span></td>' 
                }
                if(data[i]['xsaa49'] == '退' && data[i]['xsab20'] == '已'){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'<font style="color:#f00;">['+ data[i]['xsaa49'] +']</font><font style="color:#00C78C;">['+ data[i]['xsab20'] +']</font></span></td>'  
                }
                if(data[i]['xsaa49'] == '退' && data[i]['xsab20'] == '终'){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'<font style="color:#f00;">['+ data[i]['xsaa49'] +']</font><font style="color:#00f;">['+ data[i]['xsab20'] +']</font></span></td>' 
                }
                if(data[i]['xsaa49'] == '换' && data[i]['xsab20'] == '未'){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'<font style="color:#00f;">['+ data[i]['xsaa49'] +']</font><font style="color:#f00;">['+ data[i]['xsab20'] +']</font></span></td>' 
                }
                if(data[i]['xsaa49'] == '换' && data[i]['xsab20'] == '已'){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'<font style="color:#00f;">['+ data[i]['xsaa49'] +']</font><font style="color:#00C78C;">['+ data[i]['xsab20'] +']</font></span></td>'  
                }
                if(data[i]['xsaa49'] == '换' && data[i]['xsab20'] == '终'){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'<font style="color:#00f;">['+ data[i]['xsaa49'] +']</font><font style="color:#00f;">['+ data[i]['xsab20'] +']</font></span></td>' 
                }
					listInfo += '<td><span style="color:blue;cursor:pointer;" class="goodDetails" goodid=" '+ data[i]['xsab03'] +' ">'+ data[i]['xsab02'] +'</span></td>'
							+ '<td><span>'+ data[i]['xsab06'] +'</span></td>'
							+ '<td><span>'+ data[i]['xsab05'] +'</span></td>'
							+ '<td><span>'+ data[i]['xsab11'] +'</span></td>'
							+ '<td><span>'+ parseFloat(data[i]['xsab04']) +'</span></td>'
							+ '<td><span>'+ data[i]['xsab08'] +'</span></td>'
							+ '<td><span>'+ data[i]['cpae03'] +'</span></td>'
							+ '</tr>';
				$('#orderTotalNum').before(listInfo);
				$('#goodsTotalNum').text(goodsTotalNum);
				$('#goodsTotalPrice').text(goodsTotalPrice);
				$('#goodsTotalOriginalPrice').text(goodsTotalOriginalPrice);
			}

		}
    });

    //点击详情按钮
    $('body').on('click','.goodDetails',function(){
        var $this = $(this);
        var goodId = $this.attr('goodid');
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
     //   $('#goodDetilDiv').show();

        var dialog = new Dialog();
        dialog.Modal=false;
        dialog.Width=600;
        dialog.Height=450;
        dialog.URL="http://localhost/ccs/index.php?r=dialog/GetSpxqHtml&goodId="+goodId;
        dialog.show();
    });

    //点击关闭商品信息
    $('body').on('click','#closeDetail',function(){
        $('#goodDetilDiv').hide();
    }); 

    /**
     * @desc点击改单显示修改订单商品弹框
     * @author huyan
     * @date 2015-12-15
     */
    $('body').on('click','#xiugai',function(){
        $('#changeOrderGoods').show();
         $.get('index.php?r=ddgl/getObtainorderdetails',{orderno:orderno},function(data){
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
                                    + '<td><input name="" type="text" class="dfinput spjg"  value="'+data[i]['xsab05']+'"/><input name="" type="button" class="btn changeprice" style="font-size:12px;width:50px;" orderprice="'+ data[i]['xsab03'] +'" value="改"/></span></td>'
                                    + '<td><input name="" type="text" class="dfinput spsl"  value="'+data[i]['xsab04']+'"/><input name="" type="button" class="btn changeNumber" style="font-size:12px;width:50px;" value="改"/></td>'
                                    + '<td><span>'+ data[i]['xsab07'] +'</span></td>'

                                    + '</tr>';
                        $('#Commoditydetails').append(listInfo);
                    }
                }
        },'json');
    });

    //删除商品
    $('#deletecomm').on('click',function(){
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
                        window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
                        return;
                    }
                    if(data.res == 'error'){
                        alert(data.msg);
                        return;
                    }
                 }
            },'json')
        }
    })

    //改价格
    $('body').on('click','.changeprice',function(){
        var spjg = $(this).siblings().val();//商品价格
        if (!spjg) {
                alert('价格不能为空');
                return;
        }
         if (spjg.length != 0){
            if (!regMoney.test(spjg)) {
                alert('商品价格最多是两位小数，请重新输入');
                return;
            }
        }

        var goodNum = $(this).parent().siblings().find('.number').text();//款号
        var spsl = $(this).parent().siblings().find('.spsl').val();//数量
        var xiaoji=parseFloat(spjg)*parseFloat(spsl);

        $.post('index.php?r=ddgl/ChangeOrderprice',{orderno:orderno,spjg:spjg,goodNum:goodNum,xiaoji:xiaoji},function(data){
            if(data){
                
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
                    return;
                    
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
               
            }
        },'json');
    });

    //改数量
    $('body').on('click','.changeNumber',function(){
        var spsl = $(this).siblings().val();//商品数量
        if (!spsl) {
            alert('数量不能为空');
            return;
        }
        if (!regMoney.test(spsl)) {
            alert('数量只能是数字且最多是两位小数');
            return;
        }
        var goodNum = $(this).parent().siblings().find('.number').text();//款号
        var spjg = $(this).parent().siblings().find('.spjg').val();//商品价格
        var xiaoji=parseFloat(spjg)*parseFloat(spsl);
        $.post('index.php?r=ddgl/ChangeOrderNumber',{orderno:orderno,goodNum:goodNum,xiaoji:xiaoji,spsl:spsl},function(data){
            if(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
            }
        },'json');
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


   //点击选中商品并在页面上显示对应的信息
    $('body').on('click','.oneGoodLine',function(){
        var $this = $(this);
        var goodId = $this.attr('goodid');

        $.post('index.php?r=cpgl/GetGoodList',{goodid:goodId},function(data){
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
       /* var tjspsl= $('#tjspsl').val();//数量
        if (!tjspsl) {
            alert('商品数量不能为空');return;
        }*/

        $.post('index.php?r=ddgl/ChangeOrderAudit',{ordernomx:ordernomx,orderno:orderno,goodItems:goodItems,goodTotalPrice:goodTotalPrice,goodTotalNum:goodTotalNum,goodkuanhao:goodkuanhao},function(data){
            if(data){
                if(data.res == 'tips'){
                    $('#required').empty();
                    $('#required').append('<font style="color:#f00;">'+data.msg+'</font>');
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
                   window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
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

    //点击关闭商品信息
    $('body').on('click','.closeGoodList',function(){
        $('.goodList').css('display','none');
    });

     //添加商品行
    $('body').on('click','#addGoodsLine',function(){
        $('#tbody1').append('<tr class="goodline"><td><input name="" style="width:60px;" type="button" class="btn delgoodline" value="删除"/></td><td><input name="goodInfo" class="styleNum" style="border:1px solid #000;text-align:center;" type="text"/></td><td  style="position:relative;"><input name="goodInfo" class="goodName" style="border:1px solid #000;text-align:center;" type="text" /><div class="goodList" style="display:none;background-color:#D3D3D3;position:absolute;overflow:auto;width:474px;height:100px;z-index:5;"><table class="table5" style="width:450px;"><tr><td class="closeGoodList" style="cursor:pointer;" colspan="5">关闭</td></table></div></td><td class="unitPrice"><input name="goodInfo" style="border:1px solid #000;text-align:center;" type="text"  value="" class="goodPrice"/></td><td><input name="goodInfo" style="border:1px solid #000;text-align:center;" type="text"  value="1" class="goodNum"/></td><td class="little"><input name="goodInfo" type="text" value="" style="text-align:center;" readonly="readonly" class="subtotal"/><input class="stock" name="goodInfo" type="hidden" value="" /></td></tr>');
    });
    //删除商品行
    $('#tbody1').on('click','.delgoodline',function(){
        $(this).parent().parent().remove();
    });

//点击关闭改单弹框
    $('body').on('click','#guanbi',function(){
        $('#changeOrderGoods').hide();
        window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
    });

     //点击关闭订单商品弹框
    $('body').on('click','#closeOrderGoods',function(){
        $('#changeOrderGoods').hide();
    }); 

    //点击显示订单分业绩弹框
    $('body').on('click','#MinPerformance',function(){
        $('.gonghao').remove();
        $('#addJobNum').removeAttr("disabled");
        $('#orderSeparateAchievement').show();
    });

    //点击关闭订单分业绩弹框
    $('body').on('click','#cancelJobNum',function(){
        $('#orderSeparateAchievement').hide();
    });

     /**
     * @desc 增加工号
     * @author WuJunhua
     * @date 2015-11-13
     */
    $('body').on('click','#addJobNum',function(){
    	var JnLine = $('.JnLine').length;
        var length = JnLine+1;
        if(length == 4){
            $('#addJobNum').attr("disabled","disabled");
        }
        $('#table8').append('<tr class="JnLine gonghao"><td>工号'+length+'<font></font>： <input class="showNumber" style="border:1px solid #000;" type="text" name="" value=""/><div class="workNumberList" style="display:none;background-color:#D3D3D3;position:absolute;overflow:auto;width:200px;height:150px;z-index:5;"><table style="width:400px;" class="table3"><tr><td class="closeNumberList" style="cursor:pointer;">关闭</td></tr></table></div></td><td style="padding-left:30px;">业绩比例：<select style="width:60px;height:20px;" name="" id=""><option name="yjbl" value="1">1</option><option name="yjbl" value="0.9">0.9</option><option name="yjbl" value="0.8">0.8</option><option name="yjbl" value="0.7">0.7</option><option name="yjbl" value="0.6">0.6</option><option name="yjbl" value="0.5">0.5</option><option name="yjbl" value="0.4">0.4</option><option name="yjbl" value="0.3">0.3</option><option name="yjbl" value="0.2">0.2</option><option name="yjbl" value="0.1">0.1</option></select></td></tr>');
    });

    //获取订单的跟进记录信息
    $.get('index.php?r=ddgl/GetOrderFollowRecording',{orderno:orderno},function(data){
        listData(data);
    },'json');

   /**
     * @desc 订单的跟进记录信息获取数据插入节点
     * @author huyan
     * @date 2015-11-02
     */
    function listData(data){
    /*$.post('index.php?r=ddgl/GetOrderFollowRecording',{orderno:orderno},function(data){
    	if(!data){
        	return;
        }*/
        $('#tbody2').empty();
        $('.page').empty();
		if(data.result == 'success'){
			var length = data.list.length;
            $('#pagehidden').attr({ page: data.page, psize: data.psize });
			for(var i = 0; i < length; i++){
				var a = i+1;
				var listInfo = '';
				listInfo = '<tr>';
				listInfo += '<td><span>'+ a +'</span></td>'
							+ '<td><span>'+ data.list[i]['xsad07'] +'</span></td>'
							+ '<td><span>'+ data.list[i]['xsad08'] +'</span></td>'
							+ '<td><span>'+ data.list[i]['xsad04'] +'</span></td>'
							+ '<td><span>'+ data.list[i]['xsad06'] +'</span></td>'
                            + '<td><img src="public/img/del.png"  border="0" style="width:15%;cursor:pointer" title="删除该条记录" id="deleteFollow" followid="'+ data.list[i]['xsad10'] +'"/></td>'
							+ '</tr>';
				$('#tbody2').append(listInfo);
			}
            $('.page').append(data.pageHtml);
		}
    }
    /**
    * @desc 点击分页后加载数据
    * @author WuJunhua
    * @date 2015-10-31
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

    var addToDoSign = 0;  //添加待办事项标识
    //设置待办事项
    $('#szdbsx').on('click',function(){
    	var tick = $('#szdbsx:checked').length;
    	if(tick){
    		addToDoSign = tick;
    		$('.dbsx').css('display','block');
    	}else{    	
    		addToDoSign = tick;
    		$('.dbsx').css('display','none');
    	}
    });

    //添加待办事项
    $('body').on('click','#addToDo',function(){
    	var content = $('#content').val();
    	var dbsj = $('#dbsj').val();
		var gjr = $("option[name='khgsgh']:checked").val();
		var fz = $("option[name='khszz']:checked").val();
		if(!content){
			alert('内容不能为空');
			return;
		}
    	if(addToDoSign){
			if(!dbsj){
				alert('待办时间不能为空');
				return;
			}
			$.post('index.php?r=ddgl/AddToDoThings',{clientno:clientno,orderno:orderno,dbsj:dbsj,gjr:gjr,fz:fz,content:content},function(data){
				if(data){
	    			if(data.res == 'success'){
						alert(data.msg);
	    				window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
						return;
	    			}
	    			if(data.res == 'error'){
	    				alert(data.msg);
	    				return;
	    			}
    			}
			},'json');
    	}else{
    		$.post('index.php?r=ddgl/AddToDoThings',{orderno:orderno,content:content},function(data){
    			if(data){
	    			if(data.res == 'success'){
						alert(data.msg);
	    				window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
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

    //拒收订单
    $('#rejected').on('click',function(){
    	var css = $('#jsyyxs').css('display');
    	var show = 1; //记录拒收原因是否显示出来
    	if(css == 'none'){
	    	$('#jsyyxs').css('display','block');
	    	show += 1;
    	}
    	if(show == 2){
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
							$('#thbz').before(listInfo);
						}
    				}
    			},'json');
    		});
    	}

    	if(show == 2){
    		$('#rejected').on('click',function(){
    			//var jsyy = $("input[name='rejectid']:checked").val();
                var ddje = $('#ddje').val();
    			var jsyynr = $("input[name='jsyynr']:checked").val();
    			var thbz = $('#thbznr').val();
    			var ensure = confirm('真的要设为拒收么？请谨慎操作');
    			if(ensure){
    				$.post('index.php?r=ddgl/RejectOrders',{orderno:orderno,jsyynr:jsyynr,thbz:thbz,ddje:ddje},function(data){
    					if(!data){
	            			return;
	            		}
	            		if(data){
                            if(data.res == 'success'){
                                alert(data.msg);
                                window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
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
    	}    	

    });

  //撤销退货(把拒收状态改为已发货状态)
	$('body').on('click','#revocationReturn',function(){
		var ensure = confirm('真的确认撤销到已发货状态吗？');
		if(ensure){
			$.post('index.php?r=ddgl/RevocationReturn',{orderno:orderno},function(data){
	            if(!data){
                    return;
                }
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
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

	//撤销收货(把交易成功状态改为已发货状态)
	$('body').on('click','#revocation',function(){
		var ensure = confirm('真的确认撤销到已发货状态吗？');
		if(ensure){
			$.post('index.php?r=ddgl/RevocationReceiving',{orderno:orderno},function(data){
	            if(!data){
                    return;
                }
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
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

    /* //点击'提交保存' 分业绩
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
            	$.post('index.php?r=ddgl/OrderTurnPerformance',{orderno:orderno,yjfp:newShowNum},function(data){
		            if(!data){
		            	return;
		            }
					if(data.res == 'success'){
						$('#yjfp').text(newShowNum);
                		$('#orderSeparateAchievement').hide();
						return;
					}
				},'json');
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
            	$.post('index.php?r=ddgl/OrderTurnPerformance',{orderno:orderno,yjfp:servalNum},function(data){
		            if(!data){
		            	return;
		            }
					if(data.res == 'success'){
						$('#yjfp').text(servalNum);
                		$('#orderSeparateAchievement').hide();
						return;
					}
				},'json');
            }
            
        }
    });*/

    //删除订单跟进记录
    /*$('body').on('click','.deleteFollow',function(){*/
    $('#tableFollow').on('click','#deleteFollow',function(){
        var followid = $(this).attr('followid');
        var ensure = confirm('你确定要删除这条订单记录吗？');
        if(ensure){
            $.post('index.php?r=ddgl/DeleteOrderFollowRecording',{followid :followid},function(data){
                if(!data){
                    return;
                }
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
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

    //取消提审
    $('#cancelArraignment').on('click',function(){
        var ensure = confirm('是否确认取消提审？');
        if(ensure){
            $.post('index.php?r=ddgl/OrderWithdrawalModify',{orderno :orderno},function(data){
                if(!data){
                    return;
                }
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=ddgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
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

    //直接拨打
    $('.dial').on('click',function(){
        var sign = $(this).attr('sign');
        //根据标识来区分要拨打的号码
        switch (sign) {
            case '1':
                var secondPhone = $('#khphone').val();//客户手机
                break;
            case '2':
                var secondPhone = $('#telphone').val();//客户电话
                break;
            default:
                alert('操作有误');
                return;
                break;
        }
        if(!$.trim(secondPhone)){
            alert('拨打的号码不能为空');
            return;
        }
        if(!regNumber.test(secondPhone)){
            alert('拨打的号码只能是数字,请重新输入');
            return;
        }
        jsonp('index.php?r=ShjApi/ExtensionNumberToMbPhoneApi&secondPhone=' + secondPhone,function(data){
            if(data.result == 1){
                alert('拨打成功');
            }else{
                alert('拨打失败');
            }
            
        });
    });

    //外地拨打
    $('#overseasCall').on('click',function(){
        var secondPhone = $('#khphone').val(); //客户手机
        var fieldDialVal = $('#fieldDial').val(); //电话加拨号码
        if(fieldDialVal){
            secondPhone = fieldDialVal + secondPhone;
        }
        if(!$.trim(secondPhone)){
            alert('拨打的号码不能为空');
            return;
        }
        if(!regNumber.test(secondPhone)){
            alert('拨打的号码只能是数字,请重新输入');
            return;
        }
        jsonp('index.php?r=ShjApi/ExtensionNumberToMbPhoneApi&secondPhone=' + secondPhone,function(data){
            if(data.result == 1){
                alert('拨打成功');
            }else{
                alert('拨打失败');
            }     
        });
    });

});

var httpHost = $('#httpHost').val();  //服务器地址
//弹出框——改单
function showDdgd(){
    var ordernum = $("#ordernum").val();
    var goodsTotalPrice = $('#goodsTotalPrice').text(); //商品总价
    var dialog = new Dialog();
    dialog.Width=1300;
    dialog.Height=600;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetDdgdHtml&ordernum="+ordernum+"&goodprice="+goodsTotalPrice;
    dialog.show();
}

//弹出框——分业绩
function showDdfyj(){
    var dialog = new Dialog();
    dialog.Width = 500;
    dialog.Height = 400;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetDdfyjHtml";
    dialog.show();
}