$(function(){
	/**
	 * @desc 加载视图后，显示数据
	 * @author huyan
	 * @date 2015-11-10
	 */
	$.post('index.php?r=khgl/getFollowing',function(data){
		listData(data);
	},'json')
})

/**
 * @desc 跟进记录获取数据插入节点
 * @author huyan
 * @date 2015-10-30
 */
function listData(data){
	$('#FollowRecord').empty();
	$('.page').empty();
	if(data.result == 'success'){
		var length = data.list.length;
		$('#pagehidden').attr({ page: data.page, psize: data.psize });
		var nowTime = '1920-01-01 10:00:00';
		for(var i = 0; i < length; i+=2){
			if(data.list[i]['khae09'] < nowTime){
				data.list[i]['khae09'] = '';
			}
			var listInfo = '';
			var a = i+1;
			listInfo = '<tr class="singular">';
			listInfo += '<td style="width:10;">'+a+'</td>';
			listInfo += '<td><a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i]['khae01']+'">'+ data.list[i]['khae01'] +'</a></td>'
						+ '<td><span>'+ data.list[i]['khae02'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khae03'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khae04'] +':'+data.list[i]['khae05']+'</span></td>'
						+ '<td><span>'+ data.list[i]['khae06'] +':'+data.list[i]['khae07']+'</span></td>'
						+ '<td><span>'+ data.list[i]['khae08'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khae09'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['khae10'] +'</span></td>'
						+ '<td><img id="Shipped" src="public/img/del.png"  border="0" title="删除该条记录" style="width:9%;cursor:pointer" orderno="'+ data.list[i]['khae12'] +'" value="删除"/></td>'
                        + '</tr>';
             if(i != length - 1){
             	if(data.list[i+1]['khae09'] < nowTime){
				    data.list[i+1]['khae09'] = '';
			    }
             		listInfo += '<tr class="complex">'
			        +'<td style="width:10;">'+(a+1)+'</td>'
			        + '<td><a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i+1]['khae01']+'">'+ data.list[i+1]['khae01'] +'</a></td>'
						+ '<td><span>'+ data.list[i+1]['khae02'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['khae03'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['khae04'] +':'+data.list[i+1]['khae05']+'</span></td>'
						+ '<td><span>'+ data.list[i+1]['khae06'] +':'+data.list[i+1]['khae07']+'</span></td>'
						+ '<td><span>'+ data.list[i+1]['khae08'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['khae09'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['khae10'] +'</span></td>'
						+ '<td><img id="Shipped" src="public/img/del.png"  border="0" title="删除该条记录" style="width:9%;cursor:pointer" orderno="'+ data.list[i+1]['khae12'] +'" value="删除"/></td>'
                        + '</tr>';

             }            		
			$('#FollowRecord').append(listInfo);
		}
		$('.page').append(data.pageHtml);
	}else{
        var listInfo = '<tr><td colspan="10" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
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
//单个删除跟进记录
    $('#table4').on('click','#Shipped',function(){
        var orderid = $(this).attr('orderno');
        //alert(orderid);return;
        if(orderid){
            var ensure = confirm('确定要删除吗？');
            if(ensure){
                $.post('index.php?r=khgl/DeleteRecords',{orderno:orderid},function(data){
                    if(!data){
                        alert('删除失败，请重新操作！');
                    }
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=khgl/GetKhgjjlHtml&khgjjl.html";
                    }else{
                        alert(data.msg);
                        return;
                    }
                })
            }
        }
    });


/**
 * @desc 查询客户跟进记录条件请求
 * @author WuJunhua
 * @date 2016-02-02
 */
function ClientFollowData(sign,page,psize){ 
   var khid = $('#khid').val();//客户ID
   var gjsjq= $('#gjsjq').val();//时间
   var gjsjz= $('#gjsjz').val();//时间（至）

   var khszz=$("option[name='khszz']:checked").val();//所在组
   var gjbq=$("option[name='gjbq']:checked").val();//跟进标签
   var sfwc=$("option[name='sfwc']:checked").val();//是否完成
   var khapr=$("option[name='khapr']:checked").val();//安排人
   var khgjr=$("option[name='khgjr']:checked").val();//跟进人

   if(sign == 1){
   	    if ($('#inquireSign').val() == 0 ) {
   			gjsjq = '';
   			gjsjz = '';
   		}

   		$.get('index.php?r=khgl/getFollowing',{khid:khid,gjsjq:gjsjq,gjsjz:gjsjz,khszz:khszz,gjbq:gjbq,sfwc:sfwc,khapr:khapr,khgjr:khgjr,sign:sign,page:page,psize:psize},function(data){
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
	     $.get('index.php?r=khgl/getFollowing',{khid:khid,gjsjq:gjsjq,gjsjz:gjsjz,khszz:khszz,gjbq:gjbq,sfwc:sfwc,khapr:khapr,khgjr:khgjr,sign:sign},function(data){
	        if(!data){
	            return;
	        }
	        $('#inquireSign').val(1);
	        listData(data);
    	});
   }
   
}


/**
 * @desc 跟进记录查询
 * @author huyan
 * @date 2015-11-10
 */

$('#getFollowQuery').on('click',function(){
	var page = '';
    var psize = '';
	var sign = 0; //查询标识
	ClientFollowData(sign,page,psize);
  
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
 	ClientFollowData(sign,page,psize);
 });

