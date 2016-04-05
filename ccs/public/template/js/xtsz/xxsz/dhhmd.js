//电话黑名单
$(function(){
	$.post('index.php?r=xtsz/GetDhhmd',function(data){
		getTable(data);
	},'json');
});


function getTable(data){
	if(data.result == 'success'){
		$('#dhhmdTable').empty();
		var length = data.list.length;
		if(length == 0){
			var listInfo = '<tr><td>暂时没有记录！</td></tr>';
			$('#dhhmdTable').append(listInfo);	
		}
		for(var i = 0; i < length; i+= 2){
			var listInfo = '';
			listInfo += '<tr class="singular"><input type="hidden" id="id_'+ data.list[i]['id'] +'" value="'+ data.list[i]['id'] +'" />';
			listInfo += '<td><span><input type="hidden" id="" />'+ (i+1) +'</span></td>'
						+'<td><span>'+ data.list[i]['valuetype1'] +'</span></td>'		
						+'<td><span>'+ data.list[i]['valuetype4'] +'</span></td>'
						+'<td><span>'+ data.list[i]['valuetype5'] +'</span></td>';
			listInfo +=	'<td>'
						+ '<img class="deleteDhhmd" src="public/img/del.png" title="点击删除" border="0" style="width:8%;cursor:pointer" num="'+ data.list[i]['id'] +'" phone="'+ data.list[i]['valuetype1'] +'"></td>'
						+'</tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex"><input type="hidden" id="id_'+ data.list[i+1]['id'] +'" value="'+ data.list[i+1]['id'] +'" />';
				listInfo += '<td><span><input type="hidden" id="" />'+ (i+2) +'</span></td>'
							+'<td><span>'+ data.list[i+1]['valuetype1'] +'</span></td>'		
							+'<td><span>'+ data.list[i+1]['valuetype4'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['valuetype5'] +'</span></td>';
				listInfo +=	'<td>'
							+ '<img class="deleteDhhmd" src="public/img/del.png" title="点击删除" border="0" style="width:8%;cursor:pointer" num="'+ data.list[i+1]['id'] +'" phone="'+ data.list[i+1]['valuetype1'] +'"></td>'
							+'</tr>';
			}
			$('#dhhmdTable').append(listInfo);	
		}
	}else{
		$('#dhhmdTable').empty();
		var listInfo = '<tr><td>暂时没有记录！</td></tr>';
		$('#dhhmdTable').append(listInfo);	
	}
}

//添加用户黑名单
function addDhhmd(){
	var phone = $("#phone").val();
	if(!$.trim(phone)){
		alert("输入的号码不能为空");
		return;
	}
	if(isNum(phone) && isTelPhone(phone)){
		var ensure = confirm("你确定要把号码"+phone+"设为黑名单吗？");
		if(ensure){
			jsonp('index.php?r=ShjApi/AddBlacklistApi&phone=' + phone,function(data){
				if(data.result == 1){
					$.post('index.php?r=xtsz/AddDhhmd',{phone:phone},function(data){
						if(!data){
							alert('添加失败');
							return;
						}
						if(data){
							if(data.res == 'success'){
								alert(data.msg);
								window.location.href="index.php?r=xtsz/GetDhhmdHtml";
								return;
							}
							if(data.res == 'error'){
								alert(data.msg);
								return;
							}
						}
					},'json');
				}else{
					alert('添加失败');
				}
			});	
		}
		
	}else{
		alert("格式有误，请输入正确的手机号码或者固定电话");
	}
}

//删除黑名单
$('body').on('click','.deleteDhhmd',function(){
	var $this = $(this);
	var id = $this.attr('num');
	var phone = $this.attr('phone');
	if(!$.trim(phone)){
		alert("操作有误,请重新操作");
		return;
	}
	var ensure = confirm("你确认要删除号码"+phone+"的黑名单吗？");
	if(ensure){
		jsonp('index.php?r=ShjApi/DelBlacklistApi&phone=' + phone,function(data){
			if(data.result == 1){
				$.post('index.php?r=xtsz/DeleteDhhmd',{id:id},function(data){
					if(!data){
						alert('删除失败');
						return;
					}
					if(data){
						if(data.res == 'success'){
							alert(data.msg);
							window.location.href="index.php?r=xtsz/GetDhhmdHtml";
							return;
						}
						if(data.res == 'error'){
							alert(data.msg);
							return;
						}
					}
				},'json');
			}else{
				alert('删除失败');
			}
		});
	}
});
