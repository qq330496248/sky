$(function(){
	$.post('index.php?r=cpgl/GetCpflByCond',function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				$('#cpfl').append('<option value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');	
			}
		}
	},'json');
	$.post('index.php?r=cpgl/GetCpppByCond',function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				$('#cppp').append('<option value="'+ data.list[i]['cpad01'] +'">'+ data.list[i]['cpad03'] +'</option>');	
			}
		}
	},'json');

	$.post('index.php?r=cpgl/GetCpByCond',function(data){
		getTable(data);
	},'json');
});

function getTable(data){
	if(data.result == 'success'){
		$('#cpTable').empty();
		$('#page').empty();
		var length = data.list.length;
		$('#pagehidden').attr({ page: data.page, psize: data.psize });
		if(length == 0){
			var listInfo = '<tr><td colspan="11">暂时没有记录！</td></tr>';
			$('#cpTable').append(listInfo);	
		}
		for(var i = 0; i < length; i+=2){
			var listInfo = '';
			listInfo = '<tr class="singular">';
			listInfo += '<td><span>'+ data.list[i]['cpaa01'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cpaa02'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cpaa10'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['fl'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cpaa14'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cpaa16'] +'</span></td>'
						+ '<td height="130px"><img src="'+ data.list[i]['cpaa13'] +'" style="width: 180px; height: 120px;border: solid 1px #d2e2e2;" alt="" ></td>'
						+ '<td><span>'+ data.list[i]['cpaa06'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cpaa08'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cpaa19'] +'</span></td>'
						+ '<td><a href="index.php?r=cpgl/GetUpdateCp&id='+ data.list[i]['cpaa01']
						+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:11%;cursor:pointer"></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:11%;cursor:pointer" onclick="delCp('+data.list[i]['cpaa01'] +')"/>'
						+'</td>'
						+'</tr>';
			if(i != length - 1){
				listInfo += '<tr class="complex">'
			            + '<td><span>'+ data.list[i+1]['cpaa01'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['cpaa02'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['cpaa10'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['fl'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['cpaa14'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['cpaa16'] +'</span></td>'
						+ '<td height="130px"><img src="'+ data.list[i+1]['cpaa13'] +'" style="width: 180px; height: 120px;border: solid 1px #d2e2e2;" alt="" ></td>'
						+ '<td><span>'+ data.list[i+1]['cpaa06'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['cpaa08'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['cpaa19'] +'</span></td>'
						+ '<td><a href="index.php?r=cpgl/GetUpdateCp&id='+ data.list[i+1]['cpaa01']
						+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:11%;cursor:pointer"></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:11%;cursor:pointer" onclick="delCp('+data.list[i+1]['cpaa01'] +')"/>'
						+'</td>'
						+'</tr>';
			}

			$('#cpTable').append(listInfo);	
		}
		$('#page').append(data.pageHtml);
		/*if(data.pageHtml){
			//var pageInfo = '<tr><td colspan="15">'+ data.pageHtml +'</td></tr>';
			$('#pageInfo').empty();
			$('#pageInfo').append(pageInfo);
		}*/
	}else{
		$('#cpTable').empty();
		var listInfo = '<tr><td colspan="11">暂时没有记录！</td></tr>';
		$('#cpTable').append(listInfo);	
	}
}

function delCp(id){
	var con = confirm("确认删除吗？");
	if(con){
		$.post('index.php?r=cpgl/DeleteCp',{id:id},function(data){
			alert(data.msg);
			if(data.mes == 'success'){
				window.location.href = "index.php?r=cpgl/GetCplbHtml";
			}
		},'json');
	}
}

/**
 * @desc 查询客户订单条件请求
 * @author WuJunhua
 * @date 2016-02-04
 */
function ProductData(sign,page,psize){ 
   	var cpfl = $("#cpfl").val();
	var cppp = $("#cppp").val();
	var cpmc = $("#cpmc").val();
	var cjhh = $("#cjhh").val();
	var ifon = $("#ifon").val();
	var bmbs = $("#bmbs").val();
	var begindate = $("#begindate").val();
	var enddate = $("#enddate").val();
	var cx = $("#cx:checked").val();
	if(cx == undefined){
		cx = "";
	}

	if(sign == 1){
		if ($('#inquireSign').val() == 0 ) {
   			begindate = '';
   			enddate = '';
   		}
		$.post('index.php?r=cpgl/GetCpByCond',{cpfl:cpfl,cppp:cppp,cjhh:cjhh,cpmc:cpmc,ifon:ifon,bmbs:bmbs,begindate:begindate,enddate:enddate,cx:cx,sign:sign,page:page,psize:psize},function(data){
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
		$.post('index.php?r=cpgl/GetCpByCond',{cpfl:cpfl,cppp:cppp,cjhh:cjhh,cpmc:cpmc,ifon:ifon,bmbs:bmbs,begindate:begindate,enddate:enddate,cx:cx,sign:sign},function(data){
	        if(!data){
	            return;
	        }
	        $('#inquireSign').val(1);
	        getTable(data);
	    });
	}
   
}

/**
 * @desc 查询产品列表
 * @author WuJunhua
 * @date 2016-02-04
 */
$('#cpQuery').on('click',function(){
	var page = '';
    var psize = '';
	var sign = 0; //查询标识
	ProductData(sign,page,psize);
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
 	ProductData(sign,page,psize);	
 });

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-10-31
 */
$('body').on('click','#page a',function(){
	var $this = $(this);
	var $href = $this.attr('href');
	if($href == undefined){
		return;
	}
	$this.attr('href',"javascript:;");
	$.post($href,function(data){
		getTable(data);
	});
});
