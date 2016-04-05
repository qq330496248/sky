 $(function(){
	$.post('index.php?r=xtsz/GetRylistByCond',function(data){
		getTable(data);
	},'json');


});

function getTable(data){
	if(data.result == 'success'){
		$('#ghglTable').empty();
		$('#page').empty();
		var length = data.list.length;
		$('#pagehidden').attr({ page: data.page, psize: data.psize });
		if(length == 0){
			var listInfo = '<tr><td colspan="12">暂时没有记录！</td></tr>';
			$('#ghglTable').append(listInfo);
		}
		for(var i = 0; i < length; i+= 2){
			var listInfo = '';
			listInfo += '<tr class="singular"><td><span>'+ data.list[i]['username'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['personname'] +'</span></td>'
						+'<td><span>'+ data.list[i]['post'] +'</span></td>';
						
			if(data.list[i]['loginTime'] == "2015-01-01 23:59:59"){
				listInfo += '<td><span>暂无记录</span></td>';
			}else{
				listInfo += '<td><span>'+ data.list[i]['loginTime'] +'</span></td>';
			}
			if(data.list[i]['loginIp'] == "127.0.0.1"){
				listInfo += '<td><span></span></td>';
			}else{
				listInfo += '<td><span>'+ data.list[i]['loginIp'] +'</span></td>';
			}
			
			listInfo += '<td><span>'+ data.list[i]['fenji'] +'</span></td>'
						+'<td><span>'+ data.list[i]['telephone'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['managerPower'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['limitIp'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['limitMAC'] +'</span></td>';
			
			if(data.list[i]['isonline'] == "T"){
				listInfo +=  '<td><span><font color="#F00">在线</font></span></td>';
			}else{
				listInfo +=  '<td><span>离线</span></td>';
			}	
			if(data.list[i]['enabled'] == "T"){
				listInfo +=  '<td><span>可用</span></td>';
			}else{
				listInfo +=  '<td><span>禁用</span></td>';
			}			
			listInfo += '<td><a href="index.php?r=xtsz/GetSingleRylist&id='+ data.list[i]['id']
						+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:8%;cursor:pointer"/></a>'
						+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:8%;cursor:pointer" onclick="delGhgl(' + data.list[i]['id'] +')"></td>'
						+'</tr>';


			if(i < length - 1){
				listInfo += '<tr class="complex"><td><span>'+ data.list[i+1]['username'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['personname'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['post'] +'</span></td>';
							
				if(data.list[i+1]['loginTime'] == "2015-01-01 23:59:59"){
					listInfo += '<td><span>暂无记录</span></td>';
				}else{
					listInfo += '<td><span>'+ data.list[i+1]['loginTime'] +'</span></td>';
				}
				if(data.list[i+1]['loginIp'] == "127.0.0.1"){
					listInfo += '<td><span></span></td>';
				}else{
					listInfo += '<td><span>'+ data.list[i+1]['loginIp'] +'</span></td>';
				}
				
				listInfo += '<td><span>'+ data.list[i+1]['fenji'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['telephone'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['managerPower'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['limitIp'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['limitMAC'] +'</span></td>';
				
				if(data.list[i+1]['isonline'] == "T"){
					listInfo +=  '<td><span><font color="#F00">在线</font></span></td>';
				}else{
					listInfo +=  '<td><span>离线</span></td>';
				}	
				if(data.list[i+1]['enabled'] == "T"){
					listInfo +=  '<td><span>可用</span></td>';
				}else{
					listInfo +=  '<td><span>禁用</span></td>';
				}			
				listInfo += '<td><a href="index.php?r=xtsz/GetSingleRylist&id='+ data.list[i+1]['id']
							+ '"><img src="public/img/reservin.png" title="编辑" border="0" style="width:8%;cursor:pointer"/></a>'
							+ '<img src="public/img/del.png" title="点击删除" border="0" style="width:8%;cursor:pointer" onclick="delGhgl(' + data.list[i+1]['id'] +')"></td>'
							+'</tr>';
			}
			$('#ghglTable').append(listInfo);
		}
		$('#page').append(data.pageHtml);
	}else{
		$('#ghglTable').empty();
		var listInfo = '<tr><td colspan="12">暂时没有记录！</td></tr>';
		$('#ghglTable').append(listInfo);
	}
}

/**
 * @desc 查询客户订单条件请求
 * @author WuJunhua
 * @date 2016-02-04
 */
function JobNumberData(sign,page,psize){ 
   	var groupbh = $("#groupbh").val();
   	var dept = $("#dept").val();
	var username = $("#username").val();
	var personname = $("#personname").val();
	var isonline = $("#isonline").val();
	var enabled = $("#enabled").val();

	if(sign == 1){
		$.post('index.php?r=xtsz/GetRylistByCond',{groupbh:groupbh,username:username,personname:personname,isonline:isonline,enabled:enabled,sign:sign,page:page,psize:psize},function(data){
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
	    },'json');
	}else{
		$.post('index.php?r=xtsz/GetRylistByCond',{dept:dept,groupbh:groupbh,username:username,personname:personname,isonline:isonline,enabled:enabled,sign:sign},function(data){
	        if(!data){
	            return;
	        }
	        getTable(data);
	    },'json');
	}
   
}

/**
 * @desc 查询工号列表
 * @author WuJunhua
 * @date 2016-02-04
 */
$('#ghQuery').on('click',function(){
	var page = '';
    var psize = '';
	var sign = 0; //查询标识
	JobNumberData(sign,page,psize);
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
 	JobNumberData(sign,page,psize);	
 });

function delGhgl(id){
	var con = confirm("确认要删除吗？");
	if(con){
		$.post('index.php?r=xtsz/DeleteRylist',{id:id},function(data){
			alert("删除成功");
			getTable(data);
		},'json');
	}
}

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-10-31
 */
$('body').on('click','#page a',function(){
	var groupbh = $("#groupbh").val();
	var dept = $("#dept").val();
	var username = $("#username").val();
	var personname = $("#personname").val();
	var isonline = $("#isonline").val();
	var enabled = $("#enabled").val();
	var $this = $(this);
	var $href = $this.attr('href');
	if($href == undefined){
		return;
	}
	$this.attr('href',"javascript:;");
	$.post($href,{dept:dept,groupbh:groupbh,username:username,personname:personname,isonline:isonline,enabled:enabled},function(data){
		getTable(data);
	});
});
