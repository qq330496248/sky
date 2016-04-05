/**
 * @desc 优化jquery操作对象
 * @author WuJunhua
 * @date 2016-01-26
 */
//获取常用的操作对象
var $khname = $('#khname'); //客户姓名对象
var $khphone = $('#khphone'); //客户手机对象
var $khgmcp = $('#khgmcp'); //购买产品对象
var $khnlsq = $('#khnlsq'); //年龄对象
var $khnlsz = $('#khnlsz'); //年龄（至）对象
var $xfjed = $('#xfjed'); //消费金额（大于）对象
var $xfjex = $('#xfjex'); //消费金额（小于）对象

var $zxgjq = $('#zxgjq'); //最新跟进时间对象
var $zxgjz = $('#zxgjz'); //最新跟进时间（至）对象
var $zxzdq = $('#zxzdq'); //最新转单时间对象
var $zxzdz = $('#zxzdz'); //最新转单时间(至)对象
var $zxqsq = $('#zxqsq'); //最新签收时间对象
var $zxqsz = $('#zxqsz'); //最新签收时间(至)对象
var $zxjsq = $('#zxjsq'); //最新拒收时间对象
var $zxjsz = $('#zxjsz'); //最新拒收时间(至)对象
var $khzcsjq = $('#khzcsjq'); //注册时间对象
var $khzcsjz = $('#khzcsjz'); //注册时间（至）对象
var $khsr = $('#khsr'); //生日

$(function(){

	//显示更多资料
    $("#sxss").click(function(){
        $(".xsgdzl").slideToggle("slow");
        $('yinc').css('display','block');
        yinc.style.display = "block";
        sxss.style.display = "none";
    });

    //隐藏更多资料
     $("#yinc").click(function(){
        $(".xsgdzl").slideToggle("hide");
        yinc.style.display = "none";
        sxss.style.display = "block";
    });

	/**
	 * @desc 加载视图后，显示数据
	 * @author WuJunhua
	 * @date 2015-10-30
	 */
	$.post('index.php?r=khgl/GetNoDistribution',function(data){
		listData(data);
		//全选(全不选)特效
        checkAll($('#checkall'),$('.checkbox'));
	},'json')
})

/**
 * @desc 我的客户列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-10-30
 */
function listData(data){
	$('#getCheckeboxId').empty();
	$('.page').empty();
	if(data.result == 'success'){
		var length = data.list.length;
		$('#pagehidden').attr({ page: data.page, psize: data.psize });
		var nowTime = '1920-01-01 10:00:00';
		for(var i = 0; i < length; i+=2){
			if(data.list[i]['khaa18'] < nowTime){
				data.list[i]['khaa18'] = '';
			}
			if(data.list[i]['khaa19'] < nowTime){
				data.list[i]['khaa19'] = '';
			}
			if(data.list[i]['khaa20'] < nowTime){
				data.list[i]['khaa20'] = '';
			}
			var listInfo = '';
			var a = i+1;
			listInfo = '<tr class="singular">';
			listInfo += '<td style="width:10;"><input type="checkbox" orderno="'+data.list[i]['khaa02']+'" value="'+ data.list[i]['khaa02'] +'" class="checkbox"/>'+a+'</td>'
			listInfo += '<td><a class="canJumpPage" href="index.php?r=ddgl/GetTjddHtml&clientno='+ data.list[i]['khaa02'] +'&ordernum='+data.list[i]['khaa01']+'&sign=1">订&nbsp;&nbsp;<a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i]['khaa02']+'&ordernum='+data.list[i]['khaa01']+'&sign=2">'+ data.list[i]['khaa02'] +'</a></td>'
						+ '<td><span>'+ data.list[i]['khaa03'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khaa04'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khaa23'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khaa38'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khaa30'] +'</span></td>'
				        + '<td><span>'+ data.list[i]['khaa18'] +'</span></td>'
				        + '<td><span>'+ data.list[i]['khaa19'] +'</span></td>'
				        + '<td><span>'+ data.list[i]['khaa20'] +'</span></td>'
			            + '<td><span>'+ data.list[i]['khaa28'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khaa25'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khaa22'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khaa12'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khaa32'] +':'+data.list[i]['khaa33']+'</span></td>'
						+ '</tr>';
			if(i != length - 1){
				if(data.list[i+1]['khaa18'] < nowTime){
				    data.list[i+1]['khaa18'] = '';
			    }
			    if(data.list[i+1]['khaa19'] < nowTime){
				    data.list[i+1]['khaa19'] = '';
			    }
				if(data.list[i+1]['khaa20'] < nowTime){
					data.list[i+1]['khaa20'] = '';
				}
				listInfo += '<tr class="complex">'
					+'<td style="width:10;"><input type="checkbox" orderno="'+data.list[i+1]['khaa02']+'" value="'+ data.list[i+1]['khaa02'] +'" class="checkbox"/>'+(a+1)+'</td>'
					+ '<td><a class="canJumpPage" href="index.php?r=ddgl/GetTjddHtml&clientno='+ data.list[i+1]['khaa02'] +'&ordernum='+data.list[i+1]['khaa01']+'&sign=1">订&nbsp;&nbsp;<a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i+1]['khaa02']+'&ordernum='+data.list[i+1]['khaa01']+'&sign=2">'+ data.list[i+1]['khaa02'] +'</a></td>'
					+ '<td><span>'+ data.list[i+1]['khaa03'] +'</span></td>'
					+ '<td><span>'+ data.list[i+1]['khaa04'] +'</span></td>'
					+ '<td><span>'+ data.list[i+1]['khaa23'] +'</span></td>'
					+ '<td><span>'+ data.list[i+1]['khaa38'] +'</span></td>'
					+ '<td><span>'+ data.list[i+1]['khaa30'] +'</span></td>'
			        + '<td><span>'+ data.list[i+1]['khaa18'] +'</span></td>'
			        + '<td><span>'+ data.list[i+1]['khaa19'] +'</span></td>'
			        + '<td><span>'+ data.list[i+1]['khaa20'] +'</span></td>'
		            + '<td><span>'+ data.list[i+1]['khaa28'] +'</span></td>'
					+ '<td><span>'+ data.list[i+1]['khaa25'] +'</span></td>'
					+ '<td><span>'+ data.list[i+1]['khaa22'] +'</span></td>'
					+ '<td><span>'+ data.list[i+1]['khaa12'] +'</span></td>'
					+ '<td><span>'+ data.list[i+1]['khaa32'] +':'+data.list[i+1]['khaa33']+'</span></td>'
					+ '</tr>';
			}			
			$('#getCheckeboxId').append(listInfo);
		}
		$('.page').append(data.pageHtml);
	}else{
        var listInfo = '<tr><td colspan="15" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }
}

//批量转客户
$('body').on('click','#batchArragin',function(){
    var orderno = [];
    $('.checkbox:checked').each(function(index,item){
        orderno.push($(item).attr('orderno'));  
    });

    if(orderno.length == 0){
        alert('请选择要分配的客户资料');
        return;
    } 
    var zgtsgh=$("option[name='zcgh']:checked").val();//转给跟进工号
    var a= zgtsgh.split(":");
    var ensure = confirm('确定要把选中的客户资料分配给工号:'+a[0]+'吗？');
    if(ensure){
        $.post('index.php?r=khgl/DistributionCustomer',{orderno :orderno,zgtsgh:zgtsgh},function(data){
            if(!data){
                alert('分配失败，请重新操作！');
            }
            if(data.res == 'success'){
                alert(data.msg);
              window.location.href="index.php?r=khgl/GetWfpkhHtml&wfpkh.html";
            }
            if(data.res == 'error'){
                alert(data.msg);
                return;
            }
        },'json');
        
    }
});

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-10-31
 * modify  huyan  2015-12-09
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
 * @desc 查询我的客户资料条件请求
 * @author WuJunhua
 * @date 2016-01-26
 */
function MyClientData(sign,page,psize){ 
   var khname = $khname.val();//客户姓名
   var khphone = $khphone.val();//客户手机
   var khgmcp = $khgmcp.val();//购买产品
   var khnlsq = $khnlsq.val();//年龄
   var khnlsz = $khnlsz.val();//年龄（至）
   var xfjed = $xfjed.val();//消费金额（大于）
   var xfjex = $xfjex.val();//消费金额（小于）

   var zxgjq = $zxgjq.val();//最新跟进时间
   var zxgjz = $zxgjz.val();//最新跟进时间（至）
   var zxzdq = $zxzdq.val();//最新转单时间
   var zxzdz = $zxzdz.val();//最新转单时间(至)
   var zxqsq = $zxqsq.val();//最新签收时间
   var zxqsz = $zxqsz.val();//最新签收时间(至)
   var zxjsq = $zxjsq.val();//最新拒收时间
   var zxjsz = $zxjsz.val();//最新拒收时间(至)
   var khzcsjq = $khzcsjq.val();//注册时间
   var khzcsjz = $khzcsjz.val();//注册时间（至）
   var khsr = $khsr.val();//生日

   var khsf = $("option[name='khsf']:checked").val();//省份
   var city = $("option[name='city']:checked").val(); //城市
   var area = $("option[name='area']:checked").val(); //区县
   var khdj = $("option[name='khdj']:checked").val();//客户等级
   var zcfs = $("option[name='zcfs']:checked").val();//注册方式
   var khly = $("option[name='khly']:checked").val();//客户来源
   var nsr = $("option[name='nsr']:checked").val();//年收入
   var gjbq = $("option[name='gjbq']:checked").val();//跟进标签
   var gmcs = $("option[name='gmcs']:checked").val();//购买次数
   var khxb = $("option[name='khxb']:checked").val();//客户性别

   if(sign == 1){
     	if ($('#inquireSign').val() == 0 ) {
   			khzcsjq = '';
   			khzcsjz = '';
   		}

   		$.get('index.php?r=khgl/GetNoDistribution',{khname :khname,khphone :khphone,khgmcp:khgmcp,khnlsq:khnlsq,khnlsz:khnlsz,khdj:khdj,
   	xfjed:xfjed,xfjex:xfjex,zcfs:zcfs,khly:khly,nsr:nsr,gjbq:gjbq,gmcs:gmcs,zxgjq:zxgjq,zxgjz:zxgjz,zxzdq:zxzdq,zxzdz:zxzdz,zxqsq:zxqsq,zxqsz:zxqsz,zxjsq:zxjsq,zxjsz:zxjsz,khzcsjq:khzcsjq,khzcsjz:khzcsjz,khxb:khxb,khsr:khsr,khsf:khsf,city:city,area:area,sign:sign,page:page,psize:psize},function(data){
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
            url: "index.php?r=khgl/GetNoDistribution",
            async: true,
            data: {khname :khname,khphone :khphone,khgmcp:khgmcp,khnlsq:khnlsq,khnlsz:khnlsz,khdj:khdj,xfjed:xfjed,xfjex:xfjex,zcfs:zcfs,khly:khly,nsr:nsr,gjbq:gjbq,gmcs:gmcs,zxgjq:zxgjq,zxgjz:zxgjz,zxzdq:zxzdq,zxzdz:zxzdz,zxqsq:zxqsq,zxqsz:zxqsz,zxjsq:zxjsq,zxjsz:zxjsz,khzcsjq:khzcsjq,khzcsjz:khzcsjz,khxb:khxb,khsr:khsr,khsf:khsf,city:city,area:area,sign:sign},
            success: function(data){
                if(!data){
                    return;
                }
                $('#inquireSign').val(1);
                listData(data);
                //全选(全不选)特效
        		checkAll($('#checkall'),$('.checkbox'));
            }
        });
   }
   
}


/**
 * @desc 我的客户查询
 * @author huyan
 * @date 2015-11-03
 */

$('#StartSearchingClient').on('click',function(){
	var page = '';
    var psize = '';
	var sign = 0; //查询标识
	MyClientData(sign,page,psize);
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
 	MyClientData(sign,page,psize);	
 });

	//表格表头，按照顺序倒序，加入箭头图标
	function changeStr(str){
		var s = "";
		var order = "";
		//判断表头
		switch(str){
			case "khid":
				s = "客户ID";
				order = "khaa02";
				break;
			case "name":
				s = "姓名";
				order = "khaa03";
				break;
			case "sex":
				s = "性别";
				order = "khaa04";
				break;
			case "level":
				s = "等级";
				order = "khaa23";
				break;
			case "deal":
				s = "成交";
				order = "khaa38";
				break;	
			case "zc":
				s = "注册时间";
				order = "khaa30";
				break;
			case "last":
				s = "最新跟进";
				order = "khaa18";
				break;
			case "zd":
				s = "转单时间";
				order = "khaa19";
				break;
			case "qs":
				s = "最新签收";
				order = "khaa20";
				break;
			case "pay":
				s = "消费";
				order = "khaa28";
				break;
			case "yx":
				s = "意向";
				order = "khaa25";
				break;
			case "ly":
				s = "来源";
				order = "khaa22";
				break;
			case "dq":
				s = "地区";
				order = "khaa12";
				break;
			case "gh":
				s = "工号";
				order = "khaa32";
				break;
		}
		var img = "<img style='width:10px;height:10px' src='public/template/images/arrorDown.png'>";
		var sequence = "DESC";

		if($("#"+str).html().indexOf("arrorDown.png") > 0){
			img = "<img style='width:10px;height:10px' src='public/template/images/arrorUp.png'>";
			sequence = "ASC";
		}
		//所有表头还原，点击表头再次更换
		$("#khid").html("客户ID");
		$("#name").html("姓名");
		$("#sex").html("性别");
		$("#level").html("等级");
		$("#deal").html("成交");
		$("#zc").html("注册时间");
		$("#last").html("最新跟进");
		$("#zd").html("转单时间");
		$("#qs").html("最新签收");
		$("#pay").html("消费");
		$("#yx").html("意向");
		$("#ly").html("来源");
		$("#dq").html("地区");
		$("#gh").html("工号");
		$("#"+str).html(img+" "+s);

		var page = $('#pagehidden').attr("page");
		var psize = $('#pagehidden').attr("psize");

		$.post("index.php?r=khgl/GetNoDistribution",{page:page,psize:psize,order:order,sequence:sequence},function(data){
			listData(data);
			//全选(全不选)特效
			checkAll($('#checkall'),$('.checkbox'));
		},"json");
	}

/*	$('#khzcsjq').on('click',function(){
    //document.getElementById("phone").value="";
    var khzcsjz=$('#khzcsjz').val();//手机号
    if (khzcsjz='请输入要添加的手机号') {
        document.getElementById('phone').style.color="#9D9D9D"; 
    }
    if (kong){
        document.getElementById('phone').style.color="#000000"; 
    }
    
});*/





