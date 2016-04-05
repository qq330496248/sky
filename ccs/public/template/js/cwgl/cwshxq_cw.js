$(function(){
    //$("#khczxx").slideToggle("toggle");
    //跟进记录下拉特效
    $("#gjjl").click(function(){
        $(".gjjlxx").slideToggle("slow");
    });

    var ordernum = $('#ordernum').val(); //订单序号
    var orderno = $('#orderno').text();  //订单编号
    var clientno = $('#clientno').text(); //客户编号
	
	//单个财务审核
    $('body').on('click','#checkedOrder',function(){
        var orderid = [orderno];
        var goodsTotalPrice = $('#goodsTotalPrice').text();
        var orderTotalPrice = $('#orderTotalPrice').text();
        if(parseFloat(goodsTotalPrice) != parseFloat(orderTotalPrice)){
            alert('订单总价与商品总价不相等,请重新核实');
            return;
        }
        if(orderid.length != 0){
            var ensure = confirm('是否确定审核？该操作不能撤销，请慎重点击！');
            if(ensure){
                $.post('index.php?r=cwgl/FinanceDeliverOrders',{orderno :orderid},function(data){
                    if(data){
						if(data.res == 'success'){
							alert(data.msg);
							window.location.href="index.php?r=cwgl/GetCwshHtml";
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
        var ddlx = $("option[name='ddlx']:checked").val();//订单类型

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
                        window.location.href="index.php?r=cwgl/OrderFinanceCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
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
                        window.location.href="index.php?r=cwgl/OrderFinanceCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
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

	//撤回修改
	$('#backToUnconfirmed').on('click',function(){
		var ensure = confirm('是否确认撤回修改？');
		if(ensure){
			$.post('index.php?r=cwgl/FinanceOrderBackToUnConfirm',{orderno :orderno},function(data){
				if(data){
					if(data.res == 'success'){
						alert(data.msg);
						window.location.href="index.php?r=cwgl/GetCwshHtml";
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
    // $('body').on('click','.deleteFollow',function(){
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
                        window.location.href="index.php?r=cwgl/OrderFinanceCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
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
	    				window.location.href="index.php?r=cwgl/OrderFinanceCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
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
	    				window.location.href="index.php?r=cwgl/OrderFinanceCheckDetails&orderno="+orderno+'&ordernum='+ordernum;
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