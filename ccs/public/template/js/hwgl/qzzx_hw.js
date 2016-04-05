$(function(){
	//强制注销
	$('#forceLogoff').on('click',function(){
		//初始化
		$('#usertips').html(''); 
		$('#fenjitips').html('');
		$('#tips').html('');
		var username = $('#username').val(); //用户名
		var fenji = $('#fenji').val(); //分机号
		var sign = 2; //座席状态的强制注销标识
		if(!$.trim(username)){
			$('#usertips').html('*用户名不能为空');
			return;
		}
		if(!$.trim(fenji)){
			$('#fenjitips').html('*分机号不能为空');
			return;
		}

		$.post('index.php?r=hwgl/ForceLogoff',{username:username,fenji:fenji,sign:sign},function(data){
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

	//重置
	$('#reset').on('click',function(){
		//初始化
		$('#usertips').html(''); 
		$('#fenjitips').html('');
		$('#tips').html('');
		$('#username').val('');
		$('#fenji').val('');
	});
	
});	


