$(function(){
    //$("#khczxx").slideToggle("toggle");
    //跟进记录下拉特效
    $("#gjjl").click(function(){
        $(".gjjlxx").slideToggle("slow");
    });

    var ordernum = $('#ordernum').val(); //订单序号
    var orderno = $('#orderno').text();  //订单编号
    var clientno = $('#clientno').text(); //客户编号
	//确认修改收货人信息
	$('#saveOrder').on('click',function(){
	    var khphone = $('#mobilePhone').val();//客户手机
	    var telphone = $('#telphone').val();//客户电话
		var khname = $('#khname').val();//客户姓名
	    var khddbz = $('#khddbz').val();//备注
	    var khfplx = $("option[name='khfplx']:checked").val();//发票类型
	    var ddkdgs = $("option[name='ddkdgs']:checked").val();//快递公司
	    var province = $("option[name='province']:checked").val(); //省份
        var city = $("option[name='city']:checked").val(); //城市
        var area = $("option[name='area']:checked").val(); //区县
        var deaddress = $('#deaddress').val();//地址
        var postcode = $('#postcode').val();//邮编

	    //前台验证
	    if(!khname){
            alert('客户姓名不能为空');
            return;
        }
        if(!province){
            alert('省份不能为空');
            return;
        }
        if(!province){
            alert('省份不能为空');
            return;
        }
        if(!city){
            alert('城市不能为空');
            return;
        }
        if(!area){
            alert('区县不能为空');
            return;
        }
        if(!deaddress){
            alert('详细地址不能为空');
            return;
        }
        if(!khphone){
            alert('手机号码不能为空');
            return;
        }
        if(!regMobliePhone.test(khphone)){
            alert('手机号码的格式有误，请重新输入');
            return;
        }
	    var goodsTotalPrice = parseFloat($('#goodsTotalPrice').text());
        var orderTotalPrice = parseFloat($('#orderTotalPrice').text());
        if(goodsTotalPrice != orderTotalPrice){
        	alert('订单总价与商品总价不相等，请重新操作');
        	return;
        }

		var ensure = confirm('确认修改收货联系信息吗？');
		if(ensure){
			$.post('index.php?r=ddgl/SaveOrderMsg',{orderno:orderno,khphone:khphone,telphone:telphone,khname:khname,khddbz:khddbz,khfplx:khfplx,ddkdgs:ddkdgs,province:province,city:city,area:area,deaddress:deaddress,postcode:postcode},function(data){
	            if(!data){
	            	return;
	            }
	            if(data){
					if(data.res == 'success'){
						alert(data.msg);
						window.location.href="index.php?r=ddgl/OrderCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
					}
					if(data.res == 'error'){
						alert(data.msg);
						return;
					}

	            }
			},'json');
		}
	});
	
	//修改订单类型
	$('#saveOrderType').on('click',function(){
		var ddlx = $("option[name='ddlx']:checked").val();//订单类型
		var ensure = confirm('真的确认把类型改为"'+ddlx+'"吗？');
		if(ensure){
			$.post('index.php?r=ddgl/ChangeOrderType',{orderno:orderno,ddlx:ddlx},function(data){
				if(!data){
	            	return;
	            }
				if(data){
					if(data.res == 'success'){
						alert(data.msg);
						window.location.href="index.php?r=ddgl/OrderCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
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

	//单个提审订单(审核通过)
	$('#checkedOrder').on('click',function(){
		$('#tips').html('');
		var orderid = [$('#orderno').text()];
		//再次确认订单总价和商品总价是否相等
        var goodsTotalPrice = parseFloat($('#goodsTotalPrice').text());
        var orderTotalPrice = parseFloat($('#orderTotalPrice').text());
        if(goodsTotalPrice != orderTotalPrice){
        	$('#tips').html('订单总价与商品总价不相等，不能审单');
        	return;
        }
		if(orderid.length != 0){
			var ensure = confirm('是否确定审核？该操作不能撤销，请慎重点击！');
			if(ensure){
				$.post('index.php?r=ddgl/DeliverOrders',{orderno:orderid},function(data){
					if(!data){
						return;
					}
					if(data){
						if(data.res == 'success'){
							alert(data.msg);
							window.location.href="index.php?r=ddgl/GetDdshHtml";
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

	//撤回修改
	$('#backToUnconfirmed').on('click',function(){
		var ensure = confirm('是否确认撤回修改？');
		if(ensure){
			$.post('index.php?r=ddgl/OrderWithdrawalModify',{orderno :orderno},function(data){
				if(!data){
					return;
				}
				if(data){
					if(data.res == 'success'){
						alert(data.msg);
						window.location.href="index.php?r=ddgl/GetDdshHtml";
					}
					if(data.res == 'error'){
						alert(data.msg);
						return;
					}
	            }
			},'json');
		}
	});

	//获取订单的商品信息
    $.post('index.php?r=ddgl/GetOrderDetailGoodsMsg',{orderno:orderno},function(data){
    	if(!data){
        	return;
        }
		if(data.res != 'error'){
			var goodsTotalNum = data[0]['xsaa42'];
			var goodsTotalPrice = data[0]['xsaa19'];
			var goodsTotalOriginalPrice = data[0]['xsaa17'];
			var orderShipment = data[0]['xsaa16'];
			var orderTotalPrice = data[0]['xsaa19'];
			var gotEarnestMoney = data[0]['xsaa20'];
			var collectionMoney = data[0]['xsaa21'];
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
							+ '<td><span>'+ data[i]['xsab10'] +'</span></td>'
							+ '<td><span>'+ parseInt(data[i]['xsab04']) +'</span></td>'
							+ '<td><span>'+ data[i]['xsab08'] +'</span></td>'
							+ '<td><span>'+ data[i]['cpae03'] +'</span></td>'
							+ '<td><span>0</span></td>'
							+ '</tr>';
				$('#orderTotalNum').before(listInfo);
				$('#goodsTotalNum').text(goodsTotalNum);
				$('#goodsTotalPrice').text(goodsTotalPrice);
				$('#goodsTotalOriginalPrice').text(goodsTotalOriginalPrice);
				$('#orderShipment').text(orderShipment);
				$('#orderTotalPrice').text(orderTotalPrice);
				$('#gotEarnestMoney').text(gotEarnestMoney);
				$('#collectionMoney').text(collectionMoney);
			}

		}
    });

    //点击商品名称显示商品详情
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
        $('#goodDetilDiv').show();
    });

    //点击关闭商品信息
    $('body').on('click','#closeDetail',function(){
        $('#goodDetilDiv').hide();
    });	

     $.get('index.php?r=ddgl/GetOrderFollowRecording',{orderno:orderno},function(data){
            listData(data);
        },'json');

   //获取订单的跟进记录信息
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
                        window.location.href="index.php?r=ddgl/OrderCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
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
	    				window.location.href="index.php?r=ddgl/OrderCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
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
	    				window.location.href="index.php?r=ddgl/OrderCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
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

     /**
     * @desc点击改单显示修改订单商品弹框
     * @author huyan
     * @date 2015-12-15
     */
    $('body').on('click','#changeOrder',function(){
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
                        window.location.href="index.php?r=ddgl/OrderCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
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
        var goodNum = $(this).parent().siblings().find('.number').text();//款号
        var spsl = $(this).parent().siblings().find('.spsl').val();//数量
        var xiaoji=parseFloat(spjg)*parseFloat(spsl);

        $.post('index.php?r=ddgl/ChangeOrderprice',{orderno:orderno,spjg:spjg,goodNum:goodNum,xiaoji:xiaoji},function(data){
            if(data){
                
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=ddgl/OrderCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
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
        var goodNum = $(this).parent().siblings().find('.number').text();//款号
        var spjg = $(this).parent().siblings().find('.spjg').val();//商品价格
        var xiaoji=parseFloat(spjg)*parseFloat(spsl);
        $.post('index.php?r=ddgl/ChangeOrderNumber',{orderno:orderno,goodNum:goodNum,xiaoji:xiaoji,spsl:spsl},function(data){
            if(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=ddgl/OrderCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
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


 //删除商品行
    $('#tbody1').on('click','.delgoodline',function(){
        $(this).parent().parent().remove();
    });

     /**
     * @desc 添加和删除商品行的特效
     * @author huyan
     * @date 2015-12-15
     */

 //添加商品行
$('body').on('click','#addGoodsLine',function(){
    $('#tbody1').append('<tr class="goodline"><td><input name="" type="button" style="width:60px;" class="btn delgoodline" value="删除"/></td><td><input name="goodInfo" style="border:1px solid #000;text-align:center;" type="text" class="styleNum" readonly="readonly"/></td><td  style="position:relative;"><input name="goodInfo" class="goodName" style="border:1px solid #000;text-align:center;" type="text" readonly="readonly" /><div class="goodList" style="display:none;background-color:#D3D3D3;position:absolute;overflow:auto;width:474px;height:100px;z-index:5;"><table class="table5" style="width:450px;"><tr><td class="closeGoodList" style="cursor:pointer;" colspan="5">关闭</td></table></div></td><td class="unitPrice"><input name="goodInfo" style="border:1px solid #000;text-align:center;" type="text"  value="" class="goodPrice" readonly="readonly"/></td><td><input name="goodInfo" style="border:1px solid #000;text-align:center;" type="text"  value="1" class="goodNum"/></td><td class="little"><input name="goodInfo" type="text" value="" style="text-align:center;" readonly="readonly" class="subtotal"/><input class="stock" name="goodInfo" type="hidden" value="" /></td></tr>');
});

 	//点击关闭改单弹框
    $('body').on('click','#guanbi',function(){
        $('#changeOrderGoods').hide();
        window.location.href="index.php?r=ddgl/OrderCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
    });

    //点击关闭订单商品弹框
    $('body').on('click','#closeOrderGoods',function(){
        $('#changeOrderGoods').hide();
    });	


    //点击显示商品信息
    $('body').on('focus','.goodName',function(){  
        $.post('index.php?r=cpgl/GetAllGoodList',function(data){

            if(data != 'error'){
                $('.oneGoodLine').remove();
                var length = data.length;
                for(var i = 0; i < length; i++){
                    if(!data[i].cpae03){
                        data[i].cpae03 = '0.00';
                    }
                    var listInfo = '';
                    listInfo = '<tr class="oneGoodLine">';
                    listInfo += '<td class="goodNumber" goodid="'+ data[i].cpaa01 +'"><span style="cursor:pointer;">'+ data[i].cpaa01 +':'+ data[i].cpaa02 +'</span></td>'
                                + '<td style="width:50px;"><span>'+ data[i].cpaa10 +'</span></td>'
                                + '<td><span>'+ data[i].cpaa06 +'元</span></td>'
                                + '<td><span>库存'+ data[i].cpae03 +'</span></td>'
                                + '<td><span style="cursor:pointer;color:blue;" class="goodDetails" goodid="'+ data[i].cpaa01 +'">详细</span></td>'
                                +'</tr>';
                    $('.table5').append(listInfo); 
                }
            }
        },'json');
        $(this).next('.goodList').css('display','block');
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
                if (parseFloat(data.cpae03)<1 || !data.cpae03) {
                    var ensure=confirm('商品:'+data.cpaa02+'库存不足,是否继续添加？');
                    if (ensure) {
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

    //点击关闭商品信息
    $('body').on('click','.closeGoodList',function(){
        $('.goodList').css('display','none');
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
                    $('#required').append('<font style="color:#f00;">'+data.msg+'</font>');
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
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