//添加跟进记录
$('body').on('click','#SaveFollow',function(){
    var gjnr=$('#gjnr').val();//内容
    var dbsj=$('#dbsj').val();//待办时间
    var gjfz = $("option[name='gjfz']:checked").val(); //分组
    var gjbq= $("option[name='gjbq']:checked").val(); //跟进标签
    var gjr= $("option[name='gjr']:checked").val();//跟进人
    var clientno = parent.document.getElementById("clientno").value;
    if(!gjnr){
     	alert("内容不能为空");
        return;
    }

    var checkbox = document.getElementById('szdbsx');//
    if(checkbox.checked){
        if (!dbsj) {
            alert("请选择待办时间");return;
        }
    }
    $.post('index.php?r=khgl/AddFollowRecord',{clientno:clientno,gjnr:gjnr,dbsj:dbsj,gjfz:gjfz,gjbq:gjbq,gjr:gjr},function(data){
        if(!data){
            alert('添加失败');
            return;
        }
        if(data.res == 'success'){
            alert(data.msg);
            parent.location.href="index.php?r=khgl/NewClientData&clientno="+data.clientno;
        }
        if (data.res=='error') {
        	alert(data.msg);
        	return;
        };
        /*else{
        	alert(data.msg);
        	return;
        }*/
    },"json");

});

//是否设置待办特效
 $('#szdbsx').on('click',function(){
    var tick = $('#szdbsx:checked').length;
    if(tick){
        $('.dbsx').css('display','block');
    }else{
        $('.dbsx').css('display','none');
    }
});