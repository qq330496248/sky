$(function(){
/**
 * @座席状态js操作文件
 * @author WuJunhua
 * @date 2016-01-12
 */
	//声明各个多次使用的对象
	var dndon = $('#dndon');
	var dndoff = $('#dndoff');
	var dial = $('#dial');
	var transout = $('#transout');
	var transin = $('#transin');
	var hangup = $('#hangup');
	var chanspyb = $('#chanspyb');
	var chanspyw = $('#chanspyw');
	var chanspyw2 = $('#chanspyw2');
	var extension = $('#extension'); //选中的分机号码对象
	var callNumber = $('#callNumber'); //选中的通话号码对象
	var currentExtension = $('#currentExtension'); //当前登录的分机号码对象

	//座席监控列表输出
	jsonp('index.php?r=ShjApi/SeatingMonitoringApi',function(data){
		//var data = JSON.parse(data); //将data格式(非对象)变成js对象
		var length = data.length;
		for(var i = 0; i < length; i++){
			var thsj = data[i]['time'];
			if(data[i]['time'] != ''){
				thsj = data[i]['time'] + '（秒）';
			}
			var listInfo = '';
			listInfo = '<tr class="seatsNumber" style="cursor:pointer;">';
			listInfo += '<td><span>'+ data[i]['id'] +'</span></td>'
						+ '<td><span>'+ data[i]['agent'] +'</span></td>'
						+ '<td><span class="exten">'+ data[i]['exten'] +'</span></td>'
						if(data[i]['status'] == 0){
							data[i]['status'] = '空闲';
							listInfo += '<td><span style="color:#00C957;">'+ data[i]['status'] +'</span></td>'
						}
						if(data[i]['status'] == 1){
							data[i]['status'] = '通话中';
							listInfo += '<td><span style="color:#FF00FF;">'+ data[i]['status'] +'</span></td>'
						}
						if(data[i]['status'] == 4){
							data[i]['status'] = '未注册';
							listInfo += '<td><span style="color:#696969;">'+ data[i]['status'] +'</span></td>'
						}
						if(data[i]['dnd'] == -1){
							data[i]['dnd'] = '示闲';
							listInfo += '<td><span style="color:#00C957;">'+ data[i]['dnd'] +'</span></td>'
						}else{
							data[i]['dnd'] = '示忙';
							listInfo += '<td><span style="color:#FF00FF;">'+ data[i]['dnd'] +'</span></td>'
						}
						listInfo += '<td><span class="callNum">'+ data[i]['num'] +'</span></td>'
						+ '<td><span>'+ thsj +'</span></td>'
						+ '</tr>';
			if(data[i]['id'] == undefined){
				dndon.attr('auth',data[i]['dndon']);
				dndoff.attr('auth',data[i]['dndoff']);
				dial.attr('auth',data[i]['dial']);
				transout.attr('auth',data[i]['transout']);
				transin.attr('auth',data[i]['transin']);
				hangup.attr('auth',data[i]['hangup']);
				chanspyb.attr('auth',data[i]['chanspyb']);
				chanspyw.attr('auth',data[i]['chanspyw']);
				chanspyw2.attr('auth',data[i]['chanspyw2']);
				continue;
			}	
			$('#getCheckeboxId').append(listInfo);
		}
		
	});
	
	//点击选中的分机或通话号码
	$('body').on('click','.seatsNumber',function(){
		var $this = $(this);
		$this.siblings().css("background",'');
		var extenNum = $this.find('.exten').text();
		var callNum = $this.find('.callNum').text();
		$this.css('background','#8BB5D9');
		extension.val(extenNum); //写入选中的分机号码
		callNumber.val(callNum); //写入选中的通话
	});

	//电话监听
	$('#chanspyb').on('click',function(){
		var extensionVal = extension.val(); //选中的分机号码
		if(!extensionVal){
			alert('分机号不能为空！请选择需要监听的目的分机号');
			return;
		}
		var auth = chanspyb.attr('auth');
		if(auth != 1){
			alert('你没有权限进行该操作');
			return;
		}
		jsonp('index.php?r=ShjApi/WiretappingApi&secondPhone=' + extensionVal,function(data){
			//var data = JSON.parse(data); //将data格式(非对象)变成js对象
			if(data.result == 1){
				alert('监听成功');
			}else{
				alert('监听失败');
			}
			
		});
		
	});

	//分机强插
	$('#transin').on('click',function(){
		var extensionVal = extension.val(); //选中的分机号码
		if(!extensionVal){
			alert('分机号不能为空！请选择需要强插的目的分机号');
			return;
		}
		var auth = transin.attr('auth');
		if(auth != 1){
			alert('你没有权限进行该操作');
			return;
		}
		jsonp('index.php?r=ShjApi/PhoneOverrideApi&firstPhone=' + extensionVal,function(data){
			//var data = JSON.parse(data); //将data格式(非对象)变成js对象
			if(data.result == 1){
				alert('强插成功');
			}else{
				alert('强插失败');
			}
			
		});
		
	});

	//分机强拆
	$('#hangup').on('click',function(){
		var extensionVal = extension.val(); //选中的分机号码
		if(!extensionVal){
			alert('分机号不能为空！请选择需要强拆的目的分机号');
			return;
		}
		var auth = hangup.attr('auth');
		if(auth != 1){
			alert('你没有权限进行该操作');
			return;
		}
		jsonp('index.php?r=ShjApi/DemolitionsApi&firstPhone=' + extensionVal,function(data){
			//var data = JSON.parse(data); //将data格式(非对象)变成js对象
			if(data.result == 1){
				alert('强拆成功');
			}else{
				alert('强拆失败');
			}
			
		});
		
	});

	//电话转移
	$('#transout').on('click',function(){
		var extensionVal = extension.val(); //选中的分机号码
		if(!extensionVal){
			alert('分机号不能为空！请选择需要转移的目的分机号');
			return;
		}
		var auth = transout.attr('auth');
		if(auth != 1){
			alert('你没有权限进行该操作');
			return;
		}
		jsonp('index.php?r=ShjApi/PhoneTransferApi&secondPhone=' + extensionVal,function(data){
			if(data.result == 1){
				alert('转移成功');
			}else{
				alert('转移失败');
			}
			
		});
	});
	
	//内部呼叫
	$('#dial').on('click',function(){
		var extensionVal = extension.val(); //选中的分机号码
		if(!extensionVal){
			alert('分机号不能为空！请选择需要呼叫分机号');
			return;
		}
		var auth = dial.attr('auth');
		if(auth != 1){
			alert('你没有权限进行该操作');
			return;
		}
		jsonp('index.php?r=ShjApi/ExtensionNumberToMbPhoneApi&secondPhone=' + extensionVal,function(data){
			if(data.result == 1){
				alert('呼叫成功');
			}else{
				alert('呼叫失败');
			}
			
		});
	});

	//强制示闲
	$('#dndoff').on('click',function(){
		var extensionVal = extension.val(); //选中的分机号码
		if(!extensionVal){
			alert('分机号不能为空！请选择需要强制示闲的分机号');
			return;
		}
		var auth = dndoff.attr('auth');
		if(auth != 1){
			alert('你没有权限进行该操作');
			return;
		}
		jsonp('index.php?r=ShjApi/ForcedFreeApi&firstPhone=' + extensionVal,function(data){
			if(data.result == 1){
				alert('强制示闲成功');
				window.location.href="index.php?r=hwgl/GetZxztHtml";
			}else{
				alert('强制示闲失败');
			}
			
		});
	});

	//强制示忙
	$('#dndon').on('click',function(){
		var extensionVal = extension.val(); //选中的分机号码
		if(!extensionVal){
			alert('分机号不能为空！请选择需要强制示忙的分机号');
			return;
		}
		var auth = dndon.attr('auth');
		if(auth != 1){
			alert('你没有权限进行该操作');
			return;
		}
		jsonp('index.php?r=ShjApi/ForcedBusyApi&firstPhone=' + extensionVal,function(data){
			if(data.result == 1){
				alert('强制示忙成功');
				window.location.href="index.php?r=hwgl/GetZxztHtml";
			}else{
				alert('强制示忙失败');
			}
			
		});
	});

	//强制注销
	$('#chanspyw2').on('click',function(){
		$('#tips').html(''); //初始化
		var fenji = extension.val(); //选中的分机号码
		var sign = 1; //座席状态的强制注销标识
		if(!fenji){
			alert('分机号不能为空！请选择需要强制示忙的分机号');
			return;
		}
		var auth = chanspyw2.attr('auth');
		if(auth != 1){
			alert('你没有权限进行该操作');
			return;
		}
		$.post('index.php?r=hwgl/ForceLogoff',{fenji:fenji,sign:sign},function(data){
			if(data){
				if(data.res == 'success'){
					alert(data.msg);
					return;
				}
				if(data.res == 'error'){
					alert(data.msg);
					return;
				}
				if(data.res == 'tips'){
					$('#tips').html(data.msg);
					return;
				}
				if(data.res == 'selfSuccess'){
					alert(data.msg);
					top.location.href="index.php?r=login/Index";
					return;
				}
			}
		});
	});
	
	
});	


