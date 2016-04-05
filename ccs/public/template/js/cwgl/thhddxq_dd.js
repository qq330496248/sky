$(function(){
    //$("#khczxx").slideToggle("toggle");
    //跟进记录下拉特效
    $("#gjjl").click(function(){
        $(".gjjlxx").slideToggle("slow");
    });

    var orderno = $('#orderno').text();  //订单编号
    var clientno = $('#clientno').val(); //客户编号

	var oldOrderMoney = parseFloat($('#oldOrderMoney').val()); //原来的订单金额
	var oldReceivedMoney = parseFloat($('#oldReceivedMoney').val()); //原来的订单已收金额

	//修改订单金额
	$('#changeOrderMoney').on('click',function(){
		var money = parseFloat($('#orderMoney').val());
		if(money < oldReceivedMoney){
			alert('订单金额不能小于已收金额');
			return;
		}
		var ensure = confirm('确认修改订单总价为'+money+'吗？');
		if(ensure){
			var sign = 1;
			$.post('index.php?r=cwgl/ChangeOrderMoney',{orderno:orderno,sign:sign,money:money,oldOrderMoney:oldOrderMoney,oldReceivedMoney:oldReceivedMoney},function(data){
				if(data){
	    			if(data.res == 'success'){
						alert(data.msg);
	    				window.location.href="index.php?r=cwgl/OrderShipmentOrReturnsDetails&orderno="+orderno;
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

	//修改已收金额
	$('#changeReceivedMoney').on('click',function(){
		var money = parseFloat($('#receivedMoney').val());
		if(money > oldOrderMoney){
			alert('已收金额不能大于订单金额');
			return;
		}
		var ensure = confirm('确认修改订单已收金额为'+money+'吗？');
		if(ensure){
			var sign = 2;
			$.post('index.php?r=cwgl/ChangeOrderMoney',{orderno:orderno,sign:sign,money:money,oldOrderMoney:oldOrderMoney,oldReceivedMoney:oldReceivedMoney},function(data){
				if(data){
	    			if(data.res == 'success'){
						alert(data.msg);
	    				window.location.href="index.php?r=cwgl/OrderShipmentOrReturnsDetails&orderno="+orderno;
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


	//获取订单的商品信息
    $.post('index.php?r=ddgl/GetOrderDetailGoodsMsg',{orderno:orderno},function(data){
    	if(!data){
        	return;
        }
		if(data.res != 'error'){
			var goodsTotalPrice = data[0]['xsaa19'];
			var orderShipment = data[0]['xsaa16'];
			var orderTotalPrice = data[0]['xsaa19'];
			var gotEarnestMoney = data[0]['xsaa20'];
			var collectionMoney = data[0]['xsaa21'];
			var length = data.length;
			for(var i = 0; i < length; i++){
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
					listInfo += '<td><span>'+ data[i]['xsab02'] +'</span></td>'
							+ '<td><span>'+ data[i]['xsab06'] +'</span></td>'
							+ '<td><span>'+ data[i]['xsab05'] +'</span></td>'
							+ '<td><span>'+ data[i]['xsab10'] +'</span></td>'
							+ '<td><span>'+ parseInt(data[i]['xsab04']) +'</span></td>'
							+ '</tr>';
				$('#orderTotalNum').before(listInfo);
				$('#goodsTotalPrice').text(goodsTotalPrice);
				$('#orderShipment').text(orderShipment);
				$('#orderTotalPrice').text(orderTotalPrice);
				$('#gotEarnestMoney').text(gotEarnestMoney);
				$('#collectionMoney').text(collectionMoney);
			}

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
							+ '<td><input style="width:50px;" name="" type="button" class="btn deleteFollow" value="删除" followid="'+ data[i]['xsad10'] +'"/></td>'
							+ '</tr>';
				$('#tbody2').append(listInfo);
			}
		}
    });

    //删除订单跟进记录
    $('body').on('click','.deleteFollow',function(){
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
                        window.location.href="index.php?r=cwgl/OrderShipmentOrReturnsDetails&orderno="+orderno;
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
	    				window.location.href="index.php?r=cwgl/OrderShipmentOrReturnsDetails&orderno="+orderno;
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
	    				window.location.href="index.php?r=cwgl/OrderShipmentOrReturnsDetails&orderno="+orderno;
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

});