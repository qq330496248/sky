$(function(){


$('#phone').on('click',function(){
    //document.getElementById("phone").value="";
    var kong=$('#phone').val();//手机号
    if (kong='请输入手机号') {
        document.getElementById('phone').style.color="#9D9D9D"; 
    }
    if (kong){
        document.getElementById('phone').style.color="#000000"; 
    }
    
});

    /**
	 * @desc 添加黑名单
	 * @author huyan
	 * @date 2015-12-07
	 */
  $('#AddBlacklist').on('click',function(){
        var khphone=$('#phone').val();//电话
        var reg=/^0?1[3|4|5|8][0-9]\d{8}$/;
        if (!khphone) {
            alert('请输入手机号');
            return;
        }
        if (!reg.test(khphone)) {
            alert('请重新输入有效的手机号');
            return;
        }
        $.post('index.php?r=khgl/AddBlacklist',{khphone:khphone},function(data){
            if(!data){
                alert('添加失败');
                return;
            }
            if(data.res == 'error'){
                alert(data.msg);
                return;
            }
            if(data.res == 'success'){
                alert(data.msg);
                window.location.href="index.php?r=khgl/GetkhhmdHtml&khhmd.html";
            }
        },"json");
    });
})

