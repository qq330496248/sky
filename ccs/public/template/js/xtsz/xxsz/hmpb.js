//修改号码屏蔽信息
$(function(){
	$('#updateNumberShield').on('click',function(){
		$('#tips').html('');
		var id = $("#updateNumberShield").attr('configid');
		var number = $("#number").val();
		var shield = $("input[name='shield']:checked").val();
		var position = $("input[name='position']:checked").val();
		if (number.length != 0){
            if (!regNumber.test(number)) {
            	$('#tips').html('*号码屏蔽数只能是数字,请重新输入');
                return;
            }
        }
        if(parseInt(number) > 8){
        	$('#tips').html('*号码最多只能屏蔽8位数');
            return;
        }
        if(shield == '是' && parseInt(number) == 0){
        	$('#tips').html('*号码屏蔽数不能为0');
            return;
        }
        var ensure = confirm('确定要修改吗？');
        if(ensure){
			$.post("index.php?r=xtsz/UpdateHmpb",{id:id,number:number,shield:shield,position:position},function(data){
				if(!data){
					alert('数据有误');
					return;
				}
				if(data){
					if(data.res == "success"){
						alert(data.msg);
						window.location.href="index.php?r=xtsz/GetHmpbHtml";
						return;
					}
					if(data.res == "error"){
						alert(data.msg);
						return;
					}
				}
			},"json");
        }
	});
})