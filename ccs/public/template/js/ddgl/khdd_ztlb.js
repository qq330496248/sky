$(function(){
	var status = $("#orderstatus").val();
	$("#btn_" + status).attr("style","color:#000000; background:#999999;");


	//客户订单下拉特效
	$("#ddcx").click(function(){
			$("#ddcxtj").slideToggle("slow");
	});
	
	/**
	 * @desc 加载视图后，显示数据
	 * @author WuJunhua
	 * @date 2015-11-04
	 */
	var orderstatus = $('#orderstatus').val();
	$.get('index.php?r=ddgl/GetOrderList',{orderstatus :orderstatus},function(data){
		listData(data);
		//全选(全不选)特效
		checkAll($('#checkall'),$('.checkbox'));
	},'json');

	//不同状态的订单列表倒序
	$('body').on('click','#rsort',function(){
		var sequence = 'rsort';
		var page = $('#pagehidden').attr("page");
		var psize = $('#pagehidden').attr("psize");
		$.get('index.php?r=ddgl/GetOrderList',{sequence :sequence,orderstatus :orderstatus,page :page,psize :psize},function(data){
			listData(data);
			//全选(全不选)特效
			checkAll($('#checkall'),$('.checkbox'));
		},'json')
	})

	//不同状态的订单列表顺序
	$('body').on('click','#sort',function(){
		var sequence = 'sort';
		var page = $('#pagehidden').attr("page");
		var psize = $('#pagehidden').attr("psize");
		$.get('index.php?r=ddgl/GetOrderList',{sequence :sequence,orderstatus :orderstatus,page :page,psize :psize},function(data){
			listData(data);
			//全选(全不选)特效
			checkAll($('#checkall'),$('.checkbox'));
		},'json')
	})

	//批量确认到审单
	$('body').on('click','#confirmToCheck',function(){
		var orderno = [];
		$('.checkbox:checked').each(function(index,item){
			orderno.push($(item).attr('orderno'));	
		});
		if(orderno.length == 0){
			alert('请选择要确认的订单');
			return;
		}
		var orderstatus = $('#orderstatus').val();
		var ensure = confirm('真的要确认么？该操作不能撤销，请认真审核！');
		if(ensure){
			$.post('index.php?r=ddgl/ConfirmToDeliverOrders',{orderno :orderno},function(data){
				if(!data){
					alert('确认审单失败，请重新确认！');
					return;
				}
				if(data){
					if(data.res == 'success'){
						alert(data.msg);
						window.location.href="index.php?r=ddgl/GetKhztddHtml&status="+orderstatus;
						return;
					}
					if(data.res == 'error'){
						alert(data.msg);
						return;
					}

				}
			})
		}
	})
})

/**
 * @desc 不同状态的订单列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-11-04
 */
function listData(data,str,img,s){//新增参数
	//所有表头还原，点击表头再次更换（DSC新增）
	$("#ddid").html("订单ID");
	$("#khid").html("客户ID");
	$("#name").html("姓名");
	$("#fkfs").html("付款方式");
	$("#zje").html("总金额");
	$("#ys").html("已收");
	$("#xdsj").html("下单时间");
	$("#xdr").html("下单人");
	$("#yjfp").html("业绩分配");
	$("#ddzt").html("订单状态");
	$("#khyx").html("客户意向");
	$("#last").html("最新跟进/备注");
	$("#kd").html("快递/单号");
	$("#"+str).html(img+" "+s);

	$('#getCheckeboxId').empty();
	$('.page').empty();
	if(data.result == 'success'){
		var length = data.list.length;
		$('#pagehidden').attr({ page: data.page, psize: data.psize });
		for(var i = 0; i < length; i++){
			var listInfo = '';
			var a = i+1;
			listInfo = '<tr>';
			if(data.status == 1 && data.list[i]['xsaa50'] == '是'){
				listInfo += '<td><font style="color:#0000ff;">√</font></td>';
			}else if(data.status == 1){
				listInfo += '<td><input type="checkbox" orderno="'+data.list[i]['xsaa02']+'" value="'+ data.list[i]['xsaa02'] +'" class="checkbox"/></td>';
			}else{
				listInfo += '<td>'+a+'</td>';
			}
			
			listInfo += '<td><a class="canJumpPage" href="index.php?r=ddgl/OrderDetails&orderno='+data.list[i]['xsaa02']+'&ordernum='+data.list[i]['xsaa01']+'">'+ data.list[i]['xsaa02'] +'</a></td>'
						+ '<td><a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i]['xsaa04']+'">'+ data.list[i]['xsaa04'] +'</a></td>'
						+ '<td><span>'+ data.list[i]['xsaa05'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa13'] +'</span></td>'
						+ '<td><span class="totalPrice">'+ data.list[i]['xsaa19'] +'</span></td>'
						+ '<td><span class="received">'+ data.list[i]['xsaa20'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa23'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa48'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa33'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa08'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa39'] +data.list[i]['xsaa40']+','+'//'+data.list[i]['xsaa36']+'</span></td>'
						+ '</tr>';
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
        var listInfo = '<tr><td colspan="12" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }
}

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-11-04
 */
$('body').on('click','.page a',function(){
	var $this = $(this);
	var $href = $this.attr('href');
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

//表格表头，按照顺序倒序，加入箭头图标
	function changeStr(str){
		var s = "";
		var order = "";
		//判断表头
		switch(str){
			case "ddid":
				s = "订单ID";
				order = "xsaa02";
				break;
			case "khid":
				s = "客户ID";
				order = "xsaa04";
				break;
			case "name":
				s = "姓名";
				order = "xsaa05";
				break;
			case "fkfs":
				s = "付款方式";
				order = "xsaa13";
				break;
			case "zje":
				s = "总金额";
				order = "xsaa17";
				break;
			case "ys":
				s = "已收";
				order = "xsaa20";
				break;	
			case "xdsj":
				s = "下单时间";
				order = "xsaa23";
				break;
			case "xdr":
				s = "下单人";
				order = "xsaa22";
				break;
			case "yjfp":
				s = "业绩分配";
				break;
			case "ddzt":
				s = "订单状态";
				order = "xsaa29";
				break;
			case "khyx":
				s = "客户意向";
				break;
			case "last":
				s = "最新跟进/备注";
				order = "xsaa39";
				break;
			case "kd":
				s = "快递/单号";
				order = "xsaa41";
				break;
		}
		var img = "<img style='width:10px;height:10px' src='public/template/images/arrorDown.png'>";
		var sequence = "DESC";

		if($("#"+str).html().indexOf("arrorDown.png") > 0){
			img = "<img style='width:10px;height:10px' src='public/template/images/arrorUp.png'>";
			sequence = "ASC";
		}
		var page = $('#pagehidden').attr("page");
		var psize = $('#pagehidden').attr("psize");
		var orderstatus = $('#orderstatus').val();
		$.post('index.php?r=ddgl/GetOrderList',{sequence:sequence,order:order,orderstatus:orderstatus},function(data){
			listData(data,str,img,s);
			//全选(全不选)特效
			checkAll($('#checkall'),$('.checkbox'));
		},'json');
		
	}