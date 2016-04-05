$(function(){
	/**
	 * @desc 加载视图后，显示数据
	 * @author WuJunhua
	 * @date 2015-11-05
	 */
	$.post('index.php?r=ddgl/GetCheckingOrder',function(data){
		listData(data);
		//全选(全不选)特效
		checkAll($('#checkall'),$('.checkbox'));
	},'json');
	

	//批量审单
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
			$.post('index.php?r=ddgl/DeliverOrders',{orderno :orderno},function(data){
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
			})
			
		}
	});
})

/**
 * @desc 订单审核列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-11-05
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
						+ '<td><a class="canJumpPage" href="index.php?r=ddgl/OrderCheckDetails&orderno='+data.list[i]['xsaa02']+'&ordernum='+data.list[i]['xsaa01']+'">'+ data.list[i]['xsaa02'] +'</a></td>'
						+ '<td><a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i]['xsaa04']+'">'+ data.list[i]['xsaa04'] +'</a></td>'
						+ '<td><span>'+ data.list[i]['xsaa05'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa13'] +'</span></td>'
						+ '<td><span class="totalPrice">'+ data.list[i]['xsaa19'] +'</span></td>'
						+ '<td><span class="received">'+ data.list[i]['xsaa20'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa23'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa29'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa41'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa48'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa33'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa08'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa39'] +data.list[i]['xsaa40']+','+'备注://'+data.list[i]['xsaa36']+'</span></td>'
						+ '</tr>';
						if(i != length - 1){
							listInfo += '<tr class="complex">'
			                +'<td style="width:10;"><input type="checkbox" orderno="'+data.list[i+1]['xsaa02']+'" value="'+ data.list[i+1]['xsaa02'] +'" class="checkbox"/>'+(a+1)+'</td>'
						    + '<td><a class="canJumpPage" href="index.php?r=ddgl/OrderCheckDetails&orderno='+data.list[i+1]['xsaa02']+'&ordernum='+data.list[i+1]['xsaa01']+'">'+ data.list[i+1]['xsaa02'] +'</a></td>'
						    + '<td><a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i+1]['xsaa04']+'">'+ data.list[i+1]['xsaa04'] +'</a></td>'
						    + '<td><span>'+ data.list[i+1]['xsaa05'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa13'] +'</span></td>'
							+ '<td><span class="totalPrice">'+ data.list[i+1]['xsaa19'] +'</span></td>'
							+ '<td><span class="received">'+ data.list[i+1]['xsaa20'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa23'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa29'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa41'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa48'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa33'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa08'] +'</span></td>'
						    + '<td><span>'+ data.list[i+1]['xsaa39'] +data.list[i+1]['xsaa40']+','+'备注://'+data.list[i+1]['xsaa36']+'</span></td>'
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
        var listInfo = '<tr><td colspan="14" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }
}

 /**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-11-05
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

/**
 * @desc 查询订单审核条件请求
 * @author WuJunhua
 * @date 2016-02-02
 */
function ClientOrderData(sign,page,psize){ 
   	var xdsjq=$('#xdsjq').val();//下单时间
	var xdsjz=$('#xdsjz').val();//下单时间（至）
	var ddid=$('#ddid').val();//订单ID
    var khid=$('#khid').val();//客户ID
	var kddh=$('#kddh').val();//快递单号
	var khfz=$("option[name='khfz']:checked").val();//分组
    var khyx=$("option[name='khyx']:checked").val();//客户意向
    var ddlx=$("option[name='ddlx']:checked").val();//订单类型
    var ddshzt=$("option[name='ddshzt']:checked").val();//审核状态
    var khsf=$("option[name='khsf']:checked").val();//省份
    var city = $("option[name='city']:checked").val(); //城市

   if(sign == 1){
   		if ($('#inquireSign').val() == 0 ) {
   			xdsjq = '';
   			xdsjz = '';
   		}
   		$.get('index.php?r=ddgl/GetCheckingOrder',{xdsjq:xdsjq,xdsjz:xdsjz,ddid:ddid,khid:khid,kddh:kddh,khfz:khfz,khyx:khyx,ddlx:ddlx,ddshzt:ddshzt,khsf:khsf,city:city,sign:sign,page:page,psize:psize},function(data){
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
   		$.get('index.php?r=ddgl/GetCheckingOrder',{xdsjq:xdsjq,xdsjz:xdsjz,ddid:ddid,khid:khid,kddh:kddh,khfz:khfz,khyx:khyx,ddlx:ddlx,ddshzt:ddshzt,khsf:khsf,city:city,sign:sign},function(data){
	        if(!data){
	            return;
	        }
	        $('#inquireSign').val(1);
	        listData(data);
	        //全选(全不选)特效
			checkAll($('#checkall'),$('.checkbox'));
	    });
   }
   
}

/**
 * @desc 订单审核查询
 * @author huyan
 * @date 2015-11-10
 */
$('#ddQuery').on('click',function(){
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
	},'json');
}