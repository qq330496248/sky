$(function(){
    //显示更多信息
    $("#sxss").click(function(){
        $(".xsgdzl").slideToggle("slow");
        $('yinc').css('display','block');
        yinc.style.display = "block";
        sxss.style.display = "none";
    });

    //隐藏更多信息
     $("#yinc").click(function(){
        $(".xsgdzl").slideToggle("hide");
        yinc.style.display = "none";
        sxss.style.display = "block";
    });

    //新增客户
	$('#addClient').on('click',function(){
        var khgsgh = $("option[name='khgsgh']:checked").val();//归属工号
		var khname = $('#khname').val();//客户姓名
        var khphone=$('#khphone').val();//客户手机
        var khTelephone2 = $('#khTelephone2').val();//客户电话2
        var khTelephone3 = $('#khTelephone3').val();//客户电话3
        var csrq=$('#csrq').val();//出生日期
        if (!csrq) {
            csrq='1900-01-01';
        }
        var sglm=$('#sglm').val();//身高
        if (!sglm) {
            sglm='0.00';
        }
        var tzqk=$('#tzqk').val();//体重
        if (!tzqk) {
            tzqk='0.00';
        }
        var dzyxhm=$('#dzyxhm').val();//电子邮箱
   
        var radnan=$("input[name='sex']:checked").val();//获取男女
        var khdj=$("option[name='khdj']:checked").val();//客户等级
        var khqqhm=$('#khqqhm').val();//qq号码
        var province = $("option[name='province']:checked").val(); //省份
        var city = $("option[name='city']:checked").val(); //城市
        var area = $("option[name='area']:checked").val(); //区县
        var deaddress = $('#deaddress').val();//地址
        var postcode = $('#postcode').val();//邮编

        var khszz=$("option[name='khszz']:checked").val();//所在组
        var kehuyx=$("option[name='kehuyx']:checked").val();//客户意向
        var jxfs=$("option[name='jxfs']:checked").val();//进线方式
        var khly=$("option[name='khly']:checked").val();//客户来源
        var phonetype=$("option[name='phonetype']:checked").val();//手机类型
        var khnsr=$("option[name='khnsr']:checked").val();//年收入
        var khzgxl=$("option[name='khzgxl']:checked").val();//学历
        var cshy=$("option[name='cshy']:checked").val();//职业
        var khbz=$('#khbz').val();//备注
        var telphonetype=$("option[name='telphonetype']:checked").val(); //电话1类型
        var teltype=$("option[name='teltype']:checked").val(); //电话2类型
        if(!khname){
            alert('姓名不能为空');
            return;
        };

        var reg=/^0?1[3|4|5|8][0-9]\d{8}$/;
        if (!khphone) {
            alert('手机号不能为空');
            return;
        }
        if (!reg.test(khphone)) {
            alert('手机号有误,请重新输入');
            return;
        }

        //身高体重验证
        var reg=/^[0-9]+(.[0-9]{1,2})?$/;
        //var strings = '';
        if (sglm.length != 0){
            if (!reg.test(sglm)) {
                alert('身高必须为数字');
                return;
            }
        }
        if (tzqk.length != 0){
            if (!reg.test(tzqk)) {
                alert('体重必须为数字');
                return;
            } 

        }
        //QQ验证
        var sdfg =/^[0-9]*$/;
        if (khqqhm.length != 0){
            if (!sdfg.test(khqqhm)) {
                alert('QQ需要输入数字');
                return;
            }
            if (khqqhm.length < 7) {
                alert('QQ号不能少于7位数字');
                return;
            }
        }
        
        //支持手机号码，3-4位区号，7-8位直播号码，1－4位分机号
        var dianhua=/^1\d{10}$|^(0\d{2,3}-?|\(0\d{2,3}\))?[1-9]\d{4,7}(-\d{1,8})?$/;
        if (khTelephone2.length != 0){
            if (!dianhua.test(khTelephone2)) {
                alert('电话2输入有误,请重新输入');
                return;
            }
        }
        if (khTelephone3.length != 0){
            if (!dianhua.test(khTelephone3)) {
                alert('电话3输入有误,请重新输入');
                return;
            }
        }
        var youx= /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;　//email地址 
        if (dzyxhm.length != 0){
            if (!youx.test(dzyxhm)) {
                alert('电子邮箱格式有误,请重新输入');
                return;
            }
        }
        $.post('index.php?r=khgl/QueryUser',{khname:khname},function(data){
            if(!data){
                alert('添加失败');
                return;
            } 

            if(data.res == 'Presence'){
                 $.post('index.php?r=khgl/AddClient',{khgsgh:khgsgh,clientName:khname,khphone:khphone,khTelephone2:khTelephone2,khTelephone3:khTelephone3,csrq:csrq,sglm:sglm,tzqk:tzqk,dzyxhm:dzyxhm,radnan:radnan,khdj:khdj,khqqhm:khqqhm,deaddress:deaddress,
            khszz:khszz,kehuyx:kehuyx,jxfs:jxfs,khly:khly,phonetype:phonetype,khnsr:khnsr,khzgxl:khzgxl,cshy:cshy,khbz:khbz,province:province,city:city,area:area,deaddress:deaddress,postcode:postcode,telphonetype:telphonetype,teltype:teltype},function(data){
                if(!data){
                    alert('添加失败');
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=khgl/NewClientData&clientno="+data.clientno;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                 }
                 
                },'json');
            }

            if(data.res == 'UserPresence'){
                var ensure=confirm('客户姓名已存在，是否继续保存？');
                if (ensure) {
                    $.post('index.php?r=khgl/AddClient',{khgsgh:khgsgh,clientName:khname,khphone:khphone,khTelephone2:khTelephone2,khTelephone3:khTelephone3,csrq:csrq,sglm:sglm,tzqk:tzqk,dzyxhm:dzyxhm,radnan:radnan,khdj:khdj,khqqhm:khqqhm,deaddress:deaddress,
            khszz:khszz,kehuyx:kehuyx,jxfs:jxfs,khly:khly,phonetype:phonetype,khnsr:khnsr,khzgxl:khzgxl,cshy:cshy,khbz:khbz,province:province,city:city,area:area,deaddress:deaddress,postcode:postcode,telphonetype:telphonetype,teltype:teltype},function(data){
            if(!data){
                alert('添加失败');
                return;
            }
           if(data.res == 'success'){
                alert(data.msg);
                window.location.href="index.php?r=khgl/NewClientData&clientno="+data.clientno;
                return;
            }
            if(data.res == 'error'){
                alert(data.msg);
                return;
             }
             
            },'json');
                };
             }
            },'json');
      
             
        //}

    });
     /**
     * @desc 保存继续添加
     * @author huyan
     * @date 2015-11-03
     */
    $('#addingClient').on('click',function(){
        var khgsgh = $("option[name='khgsgh']:checked").val();//归属工号
        var khname = $('#khname').val();//客户姓名
        var khphone=$('#khphone').val();//客户手机
        var khTelephone2 = $('#khTelephone2').val();//客户电话2
        var khTelephone3 = $('#khTelephone3').val();//客户电话3
        var csrq=$('#csrq').val();//出生日期
        var sglm=$('#sglm').val();//身高
        var tzqk=$('#tzqk').val();//体重
        if (!csrq) {
            csrq='1900-01-01';
        }
        var sglm=$('#sglm').val();//身高
        if (!sglm) {
            sglm='0.00';
        }
        var tzqk=$('#tzqk').val();//体重
        if (!tzqk) {
            tzqk='0.00';
        }
        var dzyxhm=$('#dzyxhm').val();//电子邮箱
   
        var radnan=$("input[name='sex']:checked").val();//获取男女
        var khdj=$("option[name='khdj']:checked").val();//客户等级
        var khqqhm=$('#khqqhm').val();//qq号码
        var province = $("option[name='province']:checked").val(); //省份
        var city = $("option[name='city']:checked").val(); //城市
        var area = $("option[name='area']:checked").val(); //区县
        var deaddress = $('#deaddress').val();//地址
        var postcode = $('#postcode').val();//邮编

        var khszz=$("option[name='khszz']:checked").val();//所在组
        var kehuyx=$("option[name='kehuyx']:checked").val();//客户意向
        var jxfs=$("option[name='jxfs']:checked").val();//进线方式
        var khly=$("option[name='khly']:checked").val();//客户来源
        var phonetype=$("option[name='phonetype']:checked").val();//手机类型
        var khnsr=$("option[name='khnsr']:checked").val();//年收入
        var khzgxl=$("option[name='khzgxl']:checked").val();//学历
        var cshy=$("option[name='cshy']:checked").val();//职业
        var khbz=$('#khbz').val();//备注
        var telphonetype=$("option[name='telphonetype']:checked").val(); //电话1类型
        var teltype=$("option[name='teltype']:checked").val(); //电话2类型
        if(!khname){
            alert('姓名不能为空');
            return;
        };
        var reg=/^0?1[3|4|5|8][0-9]\d{8}$/;
        if (!reg.test(khphone)) {
            alert('手机号有误,请重新输入');
            return;
        }
        //身高体重验证
        var reg=/^[0-9]+(.[0-9]{1,2})?$/;
        //var strings = '';
        if (sglm.length != 0){
            if (!reg.test(sglm)) {
                alert('身高必须为数字');
                return;
            }
        }
        if (tzqk.length != 0){
            if (!reg.test(tzqk)) {
                alert('体重必须为数字');
                return;
            }   
        }
        //QQ验证
        var sdfg =/^[0-9]*$/;
        if (khqqhm.length != 0){
            if (!sdfg.test(khqqhm)) {
                alert('QQ需要输入数字');
                return;
            }
            if (khqqhm.length < 7) {
                alert('QQ号不能少于7位数字');
                return;
            }
        }

        //支持手机号码，3-4位区号，7-8位直播号码，1－4位分机号
        var dianhua=/^1\d{10}$|^(0\d{2,3}-?|\(0\d{2,3}\))?[1-9]\d{4,7}(-\d{1,8})?$/;
        if (khTelephone2.length != 0){
            if (!dianhua.test(khTelephone2)) {
                alert('电话2输入有误,请重新输入');
                return;
            }
        }
        if (khTelephone3.length != 0){
            if (!dianhua.test(khTelephone3)) {
                alert('电话3输入有误,请重新输入');
                return;
            }
        }
        var youx= /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;　//email地址 
        if (dzyxhm.length != 0){
            if (!youx.test(dzyxhm)) {
                alert('电子邮箱格式有误,请重新输入');
                return;
            }
        }
        $.post('index.php?r=khgl/QueryUser',{khname:khname},function(data){
            if(!data){
                alert('添加失败');
                return;
            } 
            if(data.res == 'Presence'){
                 $.post('index.php?r=khgl/AddClient',{khgsgh:khgsgh,clientName:khname,khphone:khphone,khTelephone2:khTelephone2,khTelephone3:khTelephone3,csrq:csrq,sglm:sglm,tzqk:tzqk,dzyxhm:dzyxhm,radnan:radnan,khdj:khdj,khqqhm:khqqhm,deaddress:deaddress,
            khszz:khszz,kehuyx:kehuyx,jxfs:jxfs,khly:khly,phonetype:phonetype,khnsr:khnsr,khzgxl:khzgxl,cshy:cshy,khbz:khbz,province:province,city:city,area:area,deaddress:deaddress,postcode:postcode,telphonetype:telphonetype,teltype:teltype},function(data){
                if(!data){
                    alert('添加失败');
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=khgl/GetTjkhzlHtml&tjkhzl.html";
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                 }
                 
                },'json');
            }

            if(data.res == 'UserPresence'){
                var ensure=confirm('客户姓名已存在，是否继续保存？');
                if (ensure) {
                    $.post('index.php?r=khgl/AddClient',{khgsgh:khgsgh,clientName:khname,khphone:khphone,khTelephone2:khTelephone2,khTelephone3:khTelephone3,csrq:csrq,sglm:sglm,tzqk:tzqk,dzyxhm:dzyxhm,radnan:radnan,khdj:khdj,khqqhm:khqqhm,deaddress:deaddress,
            khszz:khszz,kehuyx:kehuyx,jxfs:jxfs,khly:khly,phonetype:phonetype,khnsr:khnsr,khzgxl:khzgxl,cshy:cshy,khbz:khbz,province:province,city:city,area:area,deaddress:deaddress,postcode:postcode,telphonetype:telphonetype,teltype:teltype},function(data){
                if(!data){
                    alert('添加失败');
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=khgl/GetTjkhzlHtml&tjkhzl.html";
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
             
            },'json');
                };
            }
        },'json');
    });

})

   

