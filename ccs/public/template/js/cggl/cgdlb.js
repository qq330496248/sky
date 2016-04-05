$(function(){
	/**
	 * @desc 加载视图后，显示数据
	 * @author huyan
	 * @date 2015-11-11
	 */
	 $.post('index.php?r=cggl/GetCgdByCond',function(data){
        if(!data){
            return;
        }
        listData(data);
    });
})

/**
 * @desc 采购单列表获取数据插入节点
 * @author huyan
 * @date 2015-11-11
 */
function listData(data){
	$('#getPurchase').empty();
	$('#page').empty();
	if(data.result == 'success'){
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<th colspan="14">暂无任何记录！</th>';
			$("#getPurchase").append(listInfo);
		}
		for(var i = 0; i < length; i+=2){
			var listInfo = '';
			var sum = data.list[i]['cgaa03']*1.00 + data.list[i]['cgaa08']*1.00;
			//判断是否采购单号下第一条数据
			if(data.list[i]['cgac11'] == 0){
				listInfo = '<tr class="singular"><td><span>'+ data.list[i]['cgac02'] +'</span></td>';
				if(data.list[i]['cgaa02'] == '未审核'){
					listInfo +='<td><input type="button" value="审核" onclick="checkCgd('+"'"+data.list[i]['cgaa01']+"'"+')" class="btn" style="width:50px" />'
							+'<a href="index.php?r=cggl/GetCgdxgHtml&id='+ data.list[i]['cgaa01']+'"><input type="button" value="改单" onclick="" class="btn" style="width:50px" /></a></td>';
				}else{
					listInfo +='<td><font color="#FF0000">已审核</font><input type="button" value="撤销审核" onclick="uncheckCgd('+"'"+data.list[i]['cgaa01']+"'"+')" class="btn" style="" /></td>';
				}
				
			}else{
				listInfo = '<tr class="singular"><td></td><td></td>';
			}
			listInfo +='<td><span>'+ data.list[i]['cgac03'] +'</span></td>'
					 + '<td><span>'+ data.list[i]['cgac04'] +'</span></td>'
					 + '<td><span>'+ data.list[i]['cgac09'] +'</span></td>'
					 + '<td><span>'+ data.list[i]['cgac08'] +'</span></td>'
					 + '<td><span>'+ data.list[i]['cgac05'] +'</span></td>'
					 + '<td><span>'+ data.list[i]['cgac06'] +'</span></td>';
			//判断是否采购单号下第一条数据
			if(data.list[i]['cgac11'] == 0){
				listInfo  += '<td><span>'+ data.list[i]['cgaa08'] +'</span></td>';
			}else{
				listInfo  += '<td></td>';
			}
			//判断是否采购单号下第一条数据
			if(data.list[i]['cgac11'] == 0){
				//是否审核
				if(data.list[i]['cgaa02'] == '未审核'){
					listInfo +='<td><span>未审核</span></td>';
				}else{
					if(data.list[i]['cgaa12'] == '已打款'){
						listInfo +='<td><font color="#FF0000">订单金额：'+ sum +'元，已打款：'+ data.list[i]['cgaa22'] +'元</td>';
					}else{
						listInfo +='<td><input type="text" id="money_'+data.list[i]['cgaa01']+'" class="dfinput" style="width:60px" value="'+ sum +'" /><input type="button" value="过账" onclick="postCgd('+"'"+data.list[i]['cgaa01']+"'"+','+ data.list[i]['cgaa03'] +','+ data.list[i]['cgaa08'] +')" class="btn" style="width:50px" /></td>';
					}
					
				}
			}else{
				listInfo  += '<td></td>';
			}
			listInfo +='<td><span>'+ data.list[i]['cgac10'] +'</span></td>';
			if(data.list[i]['cgac11'] == 0){
				listInfo  +='<td><span>'+ data.list[i]['cgaa05'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['cgaa09'] +'</span></td>';
			}else{
				listInfo  +='<td></td><td></td>';
			}
					 
			if(data.list[i]['cgac11'] == 0){
				listInfo += '<td style="text-align:left"><span>'+ data.list[i]['cgaa06'] +'</span>';
				if(data.list[i]['cgaa02'] != '已审核'){
				listInfo += '<a href="index.php?r=cggl/GetAddcgdHtml&id='+data.list[i]['cgaa01']+'"><input type="button" value="加" onclick="" class="btn" style="width:30px" /></a>'
							+'<a href="index.php?r=cggl/GetUpdatecgdHtml&id='+data.list[i]['cgaa01']+'&count='+data.list[i]['cgac11']+'"><input type="button" value="改" class="btn" style="width:30px" /></a>'
							+'<input type="button" value="删" onclick="delCgd('+"'"+data.list[i]['cgaa01']+"'"+','+data.list[i]['cgac11']+')" class="btn" style="width:30px" />';
				}
				listInfo += '<a href="public/template/grfUtils/data/xmlCaiGoudan.php?id='+ data.list[i]['cgaa01']+'" target="_blank"><input type="button" value="打印" class="btn" style="width:50px" /></a></td>';	
			}else{
				listInfo += '<td style="text-align:left"><span></span>';
				if(data.list[i]['cgaa02'] != '已审核'){
					listInfo += '<a href="index.php?r=cggl/GetUpdatecgdHtml&id='+data.list[i]['cgaa01']+'&count='+data.list[i]['cgac11']+'"><input type="button" value="改" class="btn" style="width:30px" /></a>'
								+'<input type="button" value="删" onclick="delCgd('+"'"+data.list[i]['cgaa01']+"'"+','+data.list[i]['cgac11']+')" class="btn" style="width:30px" />';		
				}
				listInfo += '</td>';
			}


			if(i != length - 1){
				//判断是否采购单号下第一条数据
				if(data.list[i+1]['cgac11'] == 0){
					listInfo += '<tr class="complex"><td><span>'+ data.list[i+1]['cgac02'] +'</span></td>'
					if(data.list[i+1]['cgaa02'] == '未审核'){
						listInfo +='<td><input type="button" value="审核" onclick="checkCgd('+"'"+data.list[i+1]['cgaa01']+"'"+')" class="btn" style="width:50px" />'
								+'<a href="index.php?r=cggl/GetCgdxgHtml&id='+ data.list[i+1]['cgaa01']+'"><input type="button" value="改单" onclick="" class="btn" style="width:50px" /></a></td>';
					}else{
						listInfo +='<td><font color="#FF0000">已审核</font><input type="button" value="撤销审核" onclick="uncheckCgd('+"'"+data.list[i+1]['cgaa01']+"'"+')" class="btn" style="" /></td>';
					}
					
				}else{
					listInfo += '<tr class="complex"><td></td><td></td>';
				}
				listInfo +='<td><span>'+ data.list[i+1]['cgac03'] +'</span></td>'
						 + '<td><span>'+ data.list[i+1]['cgac04'] +'</span></td>'
						 + '<td><span>'+ data.list[i+1]['cgac09'] +'</span></td>'
						 + '<td><span>'+ data.list[i+1]['cgac08'] +'</span></td>'
						 + '<td><span>'+ data.list[i+1]['cgac05'] +'</span></td>'
						 + '<td><span>'+ data.list[i+1]['cgac06'] +'</span></td>';
				//判断是否采购单号下第一条数据
				if(data.list[i+1]['cgac11'] == 0){
					listInfo  += '<td><span>'+ data.list[i+1]['cgaa08'] +'</span></td>';
				}else{
					listInfo  += '<td></td>';
				}
				//判断是否采购单号下第一条数据
				if(data.list[i+1]['cgac11'] == 0){
					//是否审核
					if(data.list[i+1]['cgaa02'] == '未审核'){
						listInfo +='<td><span>未审核</span></td>';
					}else{
						if(data.list[i+1]['cgaa12'] == '已打款'){
							listInfo +='<td><font color="#FF0000">订单金额：'+ sum +'元，已打款：'+ data.list[i+1]['cgaa22'] +'元</td>';
						}else{
							listInfo +='<td><input type="text" id="money_'+data.list[i+1]['cgaa01']+'" class="dfinput" style="width:60px" value="'+ sum +'" /><input type="button" value="过账" onclick="postCgd('+"'"+data.list[i+1]['cgaa01']+"'"+','+ data.list[i+1]['cgaa03'] +','+ data.list[i+1]['cgaa08'] +')" class="btn" style="width:50px" /></td>';
						}
						
					}
				}else{
					listInfo  += '<td></td>';
				}
				listInfo +='<td><span>'+ data.list[i+1]['cgac10'] +'</span></td>';
				if(data.list[i+1]['cgac11'] == 0){
					listInfo  +='<td><span>'+ data.list[i+1]['cgaa05'] +'</span></td>'
							+ '<td><span>'+ data.list[i+1]['cgaa09'] +'</span></td>';
				}else{
					listInfo  +='<td></td><td></td>';
				}
						 
				if(data.list[i+1]['cgac11'] == 0){
					listInfo += '<td style="text-align:left"><span>'+ data.list[i+1]['cgaa06'] +'</span>';
					if(data.list[i+1]['cgaa02'] != '已审核'){
					listInfo += '<a href="index.php?r=cggl/GetAddcgdHtml&id='+data.list[i+1]['cgaa01']+'"><input type="button" value="加" onclick="" class="btn" style="width:30px" /></a>'
								+'<a href="index.php?r=cggl/GetUpdatecgdHtml&id='+data.list[i+1]['cgaa01']+'&count='+data.list[i+1]['cgac11']+'"><input type="button" value="改" class="btn" style="width:30px" /></a>'
								+'<input type="button" value="删" onclick="delCgd('+"'"+data.list[i+1]['cgaa01']+"'"+','+data.list[i+1]['cgac11']+')" class="btn" style="width:30px" />';
					}
					listInfo += '<a href="public/template/grfUtils/data/xmlCaiGoudan.php?id='+ data.list[i+1]['cgaa01']+'" target="_blank"><input type="button" value="打印" class="btn" style="width:50px" /></a></td>';	
				}else{
					listInfo += '<td style="text-align:left"><span></span>';
					if(data.list[i+1]['cgaa02'] != '已审核'){
						listInfo += '<a href="index.php?r=cggl/GetUpdatecgdHtml&id='+data.list[i+1]['cgaa01']+'&count='+data.list[i+1]['cgac11']+'"><input type="button" value="改" class="btn" style="width:30px" /></a>'
									+'<input type="button" value="删" onclick="delCgd('+"'"+data.list[i+1]['cgaa01']+"'"+','+data.list[i+1]['cgac11']+')" class="btn" style="width:30px" />';		
					}
					listInfo += '</td>';
				}
		    }





			$('#getPurchase').append(listInfo);

		}
		$('#page').append(data.pageHtml);
	}else{
		var listInfo = '<th colspan="14" style="color:#0000ff;">暂时没有记录！</th>';
		$("#getPurchase").append(listInfo);
	}
}

//删除采购单
function delCgd(id,count){
	var con = confirm("真的确认删除吗？");
	if(con){
		$.post('index.php?r=cggl/DeleteCgd',{id:id,count:count},function(data){
			alert(data.msg);
			if(data.res == 'success'){
				window.location.href = "index.php?r=cggl/GetCgdlbHtml";
			}
		},'json');
	}
}

//采购单审核
function checkCgd(id){
	var con = confirm("是否确认审核？");
	if(con){
		$.post('index.php?r=cggl/AuditingCgd',{id:id},function(data){
			alert(data.msg);
			if(data.res == 'success'){
				window.location.href = "index.php?r=cggl/GetCgdlbHtml";
			}
		},'json');
	}
}

//采购单撤销审核
function uncheckCgd(id){
	if(confirm("是否撤销审核？")){
		$.post('index.php?r=cggl/UnauditingCgd',{id:id},function(data){
			alert(data.msg);
			if(data.res == 'success'){
				window.location.href = "index.php?r=cggl/GetCgdlbHtml";
			}
		},'json');
	}
}

//过账到采购单
function postCgd(id,money,pmoney){
	var postMoney = $("#money_"+id).val();
	var con = confirm("订单总计："+money+" 元，邮费："+ pmoney +"元，过账 "+postMoney+"元，是否确认？");
	if(con){
		$.post('index.php?r=cggl/PostCgd',{id:id,postMoney:postMoney},function(data){
			alert(data.msg);
			if(data.res == 'success'){
				window.location.href = "index.php?r=cggl/GetCgdlbHtml";
			}
		},'json');
	}
}

/**
 * @desc 采购单查询
 * @author huyan
 * @date 2015-11-11
 */
    $('#PurchaseList').on('click',function(){
       var cpmc = $('#cpmc').val();//名称
       var cgkh = $('#cgkh').val();//款号
       var cgdh = $('#cgdh').val();//采购单号
       var begindate = $('#begindate').val();//开始时间
       var enddate = $('#enddate').val();//结束时间（至）
       var gys = $("#gys").val();//供应商
       var finish = $("#finish").val();//是否完成
       var check = $("#check").val();//是否完成
       $.post('index.php?r=cggl/GetCgdByCond',{cpmc:cpmc,cgkh:cgkh,cgdh:cgdh,begindate:begindate,enddate:enddate,gys:gys,finish:finish,check:check},function(data){
            if(!data){
                return;
            }
            listData(data);
        });
	});

	$('#ChangePur').on('click',function(){
		var khname = $('#khname').val();//客户姓名
        var khphone=$('#khphone').val();//客户手机

		$.post('index.php?r=khgl/AddClient',{clientName:khname},function(data){
            if(!data){
                alert('添加失败');
                return;
            }
            if(data.clientno){
                alert(data.msg);
                window.location.href="index.php?r=khgl/NewClientData&clientno="+data.clientno;
            }
        },"json");

	});

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-10-31
 */
$('body').on('click','#page a',function(){
	var cpmc = $('#cpmc').val();//名称
	var cgkh = $('#cgkh').val();//款号
	var cgdh = $('#cgdh').val();//采购单号
	var begindate = $('#begindate').val();//开始时间
	var enddate = $('#enddate').val();//结束时间（至）
	var gys = $("#gys").val();//供应商
	var finish = $("#finish").val();//是否完成
	var $this = $(this);
	var $href = $this.attr('href');
	if($href == undefined){
		return;
	}
	$this.attr('href',"javascript:;");
	$.post($href,{cpmc:cpmc,cgkh:cgkh,cgdh:cgdh,begindate:begindate,enddate:enddate,gys:gys,finish:finish},function(data){
		listData(data);
	});
});
