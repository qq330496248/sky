$(function(){
    /* 电话弹屏特效 */
    var flag=1;
    $('body').on('click','#rightArrow',function(){
        if(flag == 1){
            $("#floatDivBoxs").animate({right: '-250px'},300);
            $(this).animate({right: '-5px'},300);
            $(this).css('background-position','-50px 0');
            flag = 0;
        }else{
            $("#floatDivBoxs").animate({right: '0'},300);
            $(this).animate({right: '250px'},300);
            $(this).css('background-position','0px 0');
            flag = 1;
        }
    });
    
	//分机呼叫手机或电话
    $('#phonecall').on('click',function(){
        var secondPhone = $('#secondPhone').val();
        if(!$.trim(secondPhone)){
            alert('被叫号码不能为空！')
            return;
        }
        if(!isNum(secondPhone)){
            alert('呼叫的号码只能是数字');
            return;
        }
        jsonp('index.php?r=ShjApi/ExtensionNumberToMbPhoneApi&secondPhone='+secondPhone,function(data){
            //var data = JSON.parse(data); //将data格式(非对象)变成js对象
            if(data.result == 1){
                alert('拨打成功');
            }else{
                alert('拨打失败');
            }  
        });
    });

    //通话保持
    $('#keep').on('click',function(){
        jsonp('index.php?r=ShjApi/CallOnHoldApi',function(data){
            if(data.result == 1){
                alert('操作成功');
            }else{
                alert('操作失败');
            }  
        });
    });

    //电话转移
    /*$('#shift').on('click',function(){
        var firstPhone = $('#firstPhone').val();
        var secondPhone = $('#secondPhone').val();
        jsonp('index.php?r=ShjApi/PhoneTransferApi&firstPhone=' + firstPhone+'&secondPhone='+secondPhone,function(data){
            //var data = JSON.parse(data); //将data格式(非对象)变成js对象
            if(data.result == 1){
                alert('转移成功');
            }else{
                alert('转移失败');
            }
            
        });
    });*/

    //电话挂断
    $('#hangup').on('click',function(){
        jsonp('index.php?r=ShjApi/PhoneHangUpApi',function(data){
            if(data.result == 1){
                alert('挂断成功');
            }else{
                alert('挂断失败');
            }
            
        });
    });
    
})