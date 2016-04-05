$(function(){
	/**
	 * @desc 加载视图后，显示数据
	 * @author WuJunhua
	 * @date 2015-12-08
	 */
	$.post('index.php?r=cwgl/GetFinanceCheckingOrder',function(data){
		listData(data);
		//全选(全不选)特效
		checkAll($('#checkall'),$('.checkbox'));
	},'json');

	
});

/**
 * @desc 订单财务审核列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-12-08
 */
function listData(data){
	$('#getCheckeboxId').empty();
	$('.page').empty();
	if(data.result == 'success'){
		var length = data.list.length;
		$('#pagehidden').attr({ page: data.page, psize: data.psize });
		for(var i = 0; i < length; i+=2){
			var a = i+1;
			var listInfo = '';
			listInfo = '<tr class="singular">';
			listInfo += '<td style="width:10;"><input type="checkbox" orderno="'+data.list[i]['xsaa02']+'" value="'+ data.list[i]['xsaa02'] +'" class="checkbox"/>'+a+'</td>'
						+ '<td><a class="canJumpPage" href="index.php?r=cwgl/OrderFinanceCheckDetails&orderno='+data.list[i]['xsaa02']+'&ordernum='+data.list[i]['xsaa01']+'">'+ data.list[i]['xsaa02'] +'</a></td>'
						+ '<td><a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i]['xsaa04']+'">'+ data.list[i]['xsaa04'] +'</a></td>'
						+ '<td><span>'+ data.list[i]['xsaa05'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa13'] +'</span></td>'
						+ '<td><span class="totalPrice">'+ data.list[i]['xsaa19'] +'</span></td>'
						+ '<td><span class="received">'+ data.list[i]['xsaa20'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa23'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa29'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa48'] +'</span></td>'
						+ '<td><span><input name="" orderno="'+ data.list[i]['xsaa02'] +'" type="button" class="btn shipped" value="财务审核"/></span></td>'
						+ '</tr>';
			if(i != length - 1){
				listInfo += '<tr class="complex">'
						+ '<td style="width:10;"><input type="checkbox" orderno="'+data.list[i+1]['xsaa02']+'" value="'+ data.list[i+1]['xsaa02'] +'" class="checkbox"/>'+(a+1)+'</td>'
						+ '<td><a class="canJumpPage" href="index.php?r=cwgl/OrderFinanceCheckDetails&orderno='+data.list[i+1]['xsaa02']+'&ordernum='+data.list[i+1]['xsaa01']+'">'+ data.list[i+1]['xsaa02'] +'</a></td>'
						+ '<td><a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i+1]['xsaa04']+'">'+ data.list[i+1]['xsaa04'] +'</a></td>'
						+ '<td><span>'+ data.list[i+1]['xsaa05'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['xsaa13'] +'</span></td>'
						+ '<td><span class="totalPrice">'+ data.list[i+1]['xsaa19'] +'</span></td>'
						+ '<td><span class="received">'+ data.list[i+1]['xsaa20'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['xsaa23'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['xsaa29'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['xsaa48'] +'</span></td>'
						+ '<td><span><input name="" orderno="'+ data.list[i+1]['xsaa02'] +'" type="button" class="btn shipped" value="财务审核"/></span></td>'
						+ '</tr>';
			}
			$('#getCheckeboxId').append(listInfo);
		}
		$('.page').append(data.pageHtml);
		var totalPrice = 0; //金额总计
        var received = 0; //已收定金
        $('.totalPrice').each(function(index,item) { 
            totalPrice += parseFloat($(item).text()); 
        });
        $('.received').each(function(index,item) { 
            received += parseFloat($(item).text()); 
        });
        var collection = totalPrice - received; //代收金额
        $('.page').append('本页金额总计：<span style="color:#ff0000;">'+ totalPrice +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页已收定金：<span style="color:#ff0000;">'+ received +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页代收金额：<span style="color:#ff0000;">'+ collection +'</span>');
	}else{
        var listInfo = '<tr><td colspan="11" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }  
}

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-12-08
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
		//全选(全不选)特效
		checkAll($('#checkall'),$('.checkbox'));
	});
});

//单个财务审核
$('#table5').on('click','.shipped',function(){
    var orderid = [$(this).attr('orderno')];
    if(orderid.length != 0){
        var ensure = confirm('是否确定审核？该操作不能撤销，请慎重点击！');
        if(ensure){
            $.post('index.php?r=cwgl/FinanceDeliverOrders',{orderno :orderid},function(data){
                if(!data){
                    return;
                }
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
	

//批量审单【财审】
$('body').on('click','#batchArragin',function(){
	var orderno = [];
	$('.checkbox:checked').each(function(index,item){
		orderno.push($(item).attr('orderno'));	
	});
	if(orderno.length == 0){
		alert('请选择要审核的订单');
		return;
	}
	var ensure = confirm('是否确定审核？该操作不能撤销，请慎重点击！');
	if(ensure){
		$.post('index.php?r=cwgl/FinanceDeliverOrders',{orderno :orderno},function(data){
			if(!data){
				return;
			}
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
		})
		
	}
});

/**
 * @desc 查询财务审核条件请求
 * @author WuJunhua
 * @date 2016-02-03
 */
function ClientOrderData(sign,page,psize){ 
   	var shddid = $('#shddid').val();//订单id
	var shkhid = $('#shkhid').val();//客户id
	var shsjq = $('#shsjq').val();//下单时间
	var shsjz = $('#shsjz').val();//下单时间(至)
    var shzt = $("option[name='shzt']:checked").val();//审核状态
    var shszz = $("option[name='shszz']:checked").val();//所在组

   if(sign == 1){
   		if ($('#inquireSign').val() == 0 ) {
   			shsjq = '';
   			shsjz = '';
   		}
   		$.get('index.php?r=cwgl/GetFinanceCheckingOrder',{shddid:shddid,shkhid:shkhid,shsjq:shsjq,shsjz:shsjz,shzt:shzt,shszz:shszz,sign:sign,page:page,psize:psize},function(data){
	        if(!data){
	            return;
	        }
        	if(data.result == 'error'){
				alert(data.msg);
				return;
			}
			if(data.result == 'exportExcel'){
				idownload(data.url);
				//导出excel成功后，要清除服务器上的xls文件
				$.post('index.php?r=xtsz/DeleteExcelFile',{url:data.url},function(data){

				});
			}	
	    });
   }else{
   		$.get('index.php?r=cwgl/GetFinanceCheckingOrder',{shddid:shddid,shkhid:shkhid,shsjq:shsjq,shsjz:shsjz,shzt:shzt,shszz:shszz,sign:sign},function(data){
	        if(!data){
	            return;
	        }
	        $('#inquireSign').val(1);
	        listData(data);
	        //全选(全不选)特效
			checkAll($('#checkall'),$('.checkbox'));
	    },'json');
   }
   
}

/**
 * @desc 财务审核查询
 * @author huyan
 * @date 2015-12-11
 */
$('#AuditQuery').on('click',function(){
	var page = '';
    var psize = '';
	var sign = 0; //查询标识
	ClientOrderData(sign,page,psize);
});

/**
 * @desc 导出excel
 * @author WuJunhua
 * @date 2015-12-17
 */
 $('body').on('click','#exportExcel',function(){
 	var page = $('#pagehidden').attr('page');
    var psize = $('#pagehidden').attr('psize');
 	var sign = 1; //导出excel标识
 	ClientOrderData(sign,page,psize);
 });


function changeStr(str){
	var s = "";
	var order = "";
	//判断表头
	switch(str){
		case "ddh":
			s = "订单号";
			order = "xsaa02";
			break;
		case "khid":
			s = "客户ID";
			order = "xsaa04";
			break;
		case "name":
			s = "客户姓名";
			order = "xsaa05";
			break;
		case "zffs":
			s = "支付方式";
			order = "xsaa13";
			break;
		case "zje":
			s = "总金额";
			order = "xsaa19";
			break;	
		case "ysje":
			s = "已收金额";
			order = "xsaa20";
			break;
		case "xdsj":
			s = "下单时间";
			order = "xsaa23";
			break;
		case "zt":
			s = "状态";
			order = "xsaa29";
			break;
		case "xsgh":
			s = "销售工号";
			order = "xsaa48";
			break;
	}
	var img = "<img style='width:10px;height:10px' src='public/template/images/arrorDown.png'>";
	var sequence = "DESC";

	if($("#"+str).html().indexOf("arrorDown.png") > 0){
		img = "<img style='width:10px;height:10px' src='public/template/images/arrorUp.png'>";
		sequence = "ASC";
	}
	//所有表头还原，点击表头再次更换
	$("#ddh").html("订单号");
	$("#khid").html("客户ID");
	$("#name").html("客户姓名");
	$("#zffs").html("支付方式");
	$("#zje").html("总金额");
	$("#ysje").html("已收金额");
	$("#xdsj").html("下单时间");
	$("#zt").html("状态");
	$("#xsgh").html("销售工号");
	$("#"+str).html(img+" "+s);

	var page = $('#pagehidden').attr("page");
	var psize = $('#pagehidden').attr("psize");

	$.post("index.php?r=cwgl/GetFinanceCheckingOrder",{page:page,psize:psize,order:order,sequence:sequence},function(data){
		listData(data);
		//全选(全不选)特效
		checkAll($('#checkall'),$('.checkbox'));
	},"json");
}


//接取interval的值
var number;
//点击按键猴生成计时器
function refurbish(num){
    clearInterval(number);
    //每个按键先还原默认样式，再修改选中的
   	$("#60").attr("style","");
    $("#120").attr("style","");
    $("#180").attr("style","");
    $("#0").attr("style","");
    $("#"+num).attr("style","color:#000000; background:#999999");
    if(num == 0){
        $("#refurbishTime").html("不刷新");
    }else{
        $("#refurbishTime").html(num+"秒");
        number = setInterval("toRefurbish()",(num*1000));
    }
   
}
//计时器执行内容
function toRefurbish(){
   $.post('index.php?r=ddgl/GetCheckingOrder',function(data){
		listData(data);
		//全选(全不选)特效
		checkAll($('#checkall'),$('.checkbox'));
	},'json');
}