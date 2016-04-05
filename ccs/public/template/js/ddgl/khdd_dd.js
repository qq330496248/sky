$(function(){
	/**
	 * @desc 加载视图后，显示数据
	 * @author WuJunhua
	 * @date 2015-11-02
	 */
	$.post('index.php?r=ddgl/GetClientOrder',function(data){
		listData(data);
	},'json');

	//客户订单下拉特效
	$("#ddcx").click(function(){
		$("#ddcxtj").slideToggle("slow");
	});
	
});	

/**
 * @desc 客户订单列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-11-02
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
		$("#sequence").val(data.sequence);
		$("#order").val(data.order);
		var length = data.list.length;
		$('#pagehidden').attr({ page: data.page, psize: data.psize });
		for(var i = 0; i < length; i+=2){
			var listInfo = '';
			listInfo = '<tr class="singular">';
			listInfo += '<td><a class="canJumpPage" href="index.php?r=ddgl/OrderDetails&orderno='+data.list[i]['xsaa02']+'&ordernum='+data.list[i]['xsaa01']+'">'+ data.list[i]['xsaa02'] +'</a></td>'
						+ '<td><a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i]['xsaa04']+'">'+ data.list[i]['xsaa04'] +'</a></td>'
						+ '<td><span>'+ data.list[i]['xsaa05'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa13'] +'</span></td>'
						+ '<td><span class="totalPrice">'+ data.list[i]['xsaa19'] +'</span></td>'
						+ '<td><span class="received">'+ data.list[i]['xsaa20'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa23'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa48'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa33'] +'</span></td>'   
						+ '<td><span>'+ data.list[i]['xsaa29'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa08'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa39'] +data.list[i]['xsaa40']+','+'备注://'+data.list[i]['xsaa36']+'</span></td>'
						+ '<td><span>'+ data.list[i]['xsaa41'] +','+'//'+data.list[i]['xsaa03']+'</span></td>'
						+ '</tr>';
			if(i != length - 1){
				listInfo += '<tr class="complex">'
							+ '<td><a class="canJumpPage" href="index.php?r=ddgl/OrderDetails&orderno='+data.list[i+1]['xsaa02']+'&ordernum='+data.list[i+1]['xsaa01']+'">'+ data.list[i+1]['xsaa02'] +'</a></td>'
							+ '<td><a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i+1]['xsaa04']+'">'+ data.list[i+1]['xsaa04'] +'</a></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa05'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa13'] +'</span></td>'
							+ '<td><span class="totalPrice">'+ data.list[i+1]['xsaa19'] +'</span></td>'
							+ '<td><span class="received">'+ data.list[i+1]['xsaa20'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa23'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa48'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa33'] +'</span></td>'   
							+ '<td><span>'+ data.list[i+1]['xsaa29'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa08'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa39'] +data.list[i+1]['xsaa40']+','+'备注://'+data.list[i+1]['xsaa36']+'</span></td>'
							+ '<td><span>'+ data.list[i+1]['xsaa41'] +','+'//'+data.list[i+1]['xsaa03']+'</span></td>'
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
        var listInfo = '<tr><td colspan="13" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }
}

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-11-02
 */
$('body').on('click','.page a',function(){
	var $this = $(this);
	var $href = $this.attr('href');
	$('#url').val($href);
	if($href == undefined){
		return;
	}
	var sequence = $("#sequence").val();
	var order = $("#order").val();
	$this.attr('href',"javascript:;");
	$.post($href,{sequence:sequence,order:order},function(data){
		listData(data);
	},'json');
});


/**
 * @desc 查询客户订单条件请求
 * @author WuJunhua
 * @date 2016-02-02
 */
function ClientOrderData(sign,page,psize){ 
   	var jefwd=$('#jefwd').val();//金额范围（大于）
	var jefwx=$('#jefwx').val();//金额范围（小于）
	var sdsjq=$('#sdsjq').val();//审单时间
	var sdsjz=$('#sdsjz').val();//审单时间（至）
	var xdsjq=$('#xdsjq').val();//下单时间
	var xdsjz=$('#xdsjz').val();//下单时间（至）
	var fhsjq=$('#fhsjq').val();//发货时间
	var fhsjz=$('#fhsjz').val();//发货时间（至）
	var qssjq=$('#qssjq').val();//签收时间
	var qssjz=$('#qssjz').val();//签收时间（至）

	var ddid=$('#ddid').val();//订单ID
	var ddkh=$('#ddkh').val();//款号
	var cpmc=$('#cpmc').val();//产品名称
	var khid=$('#khid').val();//客户ID
	var khxm=$('#khxm').val();//客户姓名
	var phone=$('#phone').val();//手机电话
	var kddh=$('#kddh').val();//快递单号
	var ddwqs=$('#ddwqs').val();//未签收
	var shgh=$('#shgh').val();//审核工号

    var ddzt=$("option[name='ddzt']:checked").val();//订单状态
    var jxfs=$("option[name='jxfs']:checked").val();//进线方式
    var khfz=$("option[name='khfz']:checked").val();//分组
    var zffs=$("option[name='zffs']:checked").val();//支付方式
    var ddlx=$("option[name='ddlx']:checked").val();//订单类型
    var khly=$("option[name='khly']:checked").val();//客户来源
    var khyx=$("option[name='khyx']:checked").val();//客户意向
    var kdgs=$("option[name='kdgs']:checked").val();//快递公司
    var sfjz=$("option[name='sfjz']:checked").val();//是否记账
    var shzt=$("option[name='shzt']:checked").val();//审核
    var ddgsgh=$("option[name='ddgsgh']:checked").val();//工号

    var khsf=$("option[name='khsf']:checked").val();//省份
    var city = $("option[name='city']:checked").val(); //城市

   if(sign == 1){
   		if ($('#inquireSign').val() == 0 ) {
   			xdsjq = '';
   			xdsjz = '';
   		}
   		$.get('index.php?r=ddgl/GetClientOrder',{jefwd:jefwd,jefwx:jefwx,sdsjq:sdsjq,sdsjz:sdsjz,xdsjq:xdsjq,xdsjz:xdsjz,fhsjq:fhsjq,fhsjz:fhsjz,qssjq:qssjq,qssjz:qssjz,ddid:ddid,ddkh:ddkh,cpmc:cpmc,khid:khid,khxm:khxm,phone:phone,kddh:kddh,ddwqs:ddwqs,shgh:shgh,ddzt:ddzt,jxfs:jxfs,khfz:khfz,ddlx:ddlx,khly:khly,khyx:khyx,kdgs:kdgs,sfjz:sfjz,shzt:shzt,zffs:zffs,ddgsgh:ddgsgh,khsf:khsf,city:city,sign:sign,page:page,psize:psize},function(data){
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
   		$.ajax({
            type: "get",
            url: "index.php?r=ddgl/GetClientOrder",
            async: true,
            dataType: "json",
            data: {jefwd:jefwd,jefwx:jefwx,sdsjq:sdsjq,sdsjz:sdsjz,xdsjq:xdsjq,xdsjz:xdsjz,fhsjq:fhsjq,fhsjz:fhsjz,qssjq:qssjq,qssjz:qssjz,ddid:ddid,ddkh:ddkh,cpmc:cpmc,khid:khid,khxm:khxm,phone:phone,kddh:kddh,ddwqs:ddwqs,shgh:shgh,ddzt:ddzt,jxfs:jxfs,khfz:khfz,ddlx:ddlx,khly:khly,khyx:khyx,kdgs:kdgs,sfjz:sfjz,shzt:shzt,zffs:zffs,ddgsgh:ddgsgh,khsf:khsf,city:city,sign:sign},
            success: function(data){
                if(!data){
                    return;
                }
                $('#inquireSign').val(1);
                listData(data);
            }
        });
   }
   
}

/**
 * @desc 查询客户订单
 * @author huyan
 * @date 2015-11-09
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
 * @date 2015-12-28
 */
 $('body').on('click','#exportExcel',function(){
 	var page = $('#pagehidden').attr('page');
    var psize = $('#pagehidden').attr('psize');
 	var sign = 1; //导出excel标识
 	ClientOrderData(sign,page,psize);	
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
	$.post('index.php?r=ddgl/GetClientOrder&page='+page+'&psize='+psize,{sequence :sequence,order:order},function(data){
		listData(data,str,img,s);
	},'json');
	
}