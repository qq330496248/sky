//点击显示所有工号
$('body').on('focus','.showNumber',function(){  
    $.post('index.php?r=ddgl/GetAllWorkNumber',function(data){
        if(data != 'error'){
            $('.oneNumberLine').remove();
            var length = data.length;
            for(var i = 0; i < length; i++){
                var listInfo = '';
                listInfo = '<tr class="oneNumberLine">';
                listInfo += '<td class="workNumber" workid="'+ data[i].id +'"><span style="cursor:pointer;">'+ data[i].username +':'+ data[i].personname +'</span></td>'
                            +'</tr>';
                $('.table3').append(listInfo); 
            }
        }
    },'json');
    $(this).next('.workNumberList').css('display','block');
});

 //点击关闭工号信息
$('body').on('click','.closeNumberList',function(){
    $('.workNumberList').css('display','none');
});

//点击选中工号并显示对应的信息
    $('body').on('click','.workNumber',function(){
        var $this = $(this);
        var workid = $this.attr('workid');
        $.post('index.php?r=ddgl/GetWorkNumberList',{workid: workid},function(data){
            if(!data){
                return;
            }
            if(data){
                $this.parent().parent().parent().parent().siblings('.showNumber').val(data);
                $('.workNumberList').css('display','none');
            }
        },'json');
    });

    function closeDialog(){
         parentDialog.close();
    }

//点击'提交保存' 分业绩
$('body').on('click','#saveJobNum',function(){
    $('#showRatio').text(); //提示初始化
    var JnLine = $('.JnLine').length;
    if(JnLine == 1){
        var showNumber = $('.showNumber').val(); //当前操作工号
        var loginNumber = $('#currentNum').val(); //登录工号
        var numIndex = showNumber.indexOf(':');
        var currentBL =  $("option[name='yjbl']:checked").val();
        if(parseInt(currentBL) != 1){
            $('#showRatio').text('比例相加必须等于1');
            return;
        }
        var numName = showNumber.substr(0,numIndex);
        var newShowNum = numName+':'+currentBL;
        var ensure = confirm('真的确定提交业绩分配吗？');
        if(ensure){
            parent.document.getElementById("yjfp").innerHTML = newShowNum;
            parentDialog.close();
        }
    }

    if(JnLine > 1){
        var sign = 1;  //判断数组中有没有值为空的标识
        var workNumArr = []; //获取多个工号姓名
        var numberArr = []; //获取多个工号
        var ratio = [];
        $('.showNumber').each(function(index,item){
            if($(item).val() == ''){
                sign = 0;
            }
            workNumArr.push($(item).val());  
        });
        if(sign == 0){
            $('#showRatio').text('工号不能为空');
            return;
        }
        var nary=workNumArr.sort();
        for(var i=0;i<workNumArr.length;i++){
            if (nary[i]==nary[i+1]) {
                $('#showRatio').text('业绩不能重复分配给相同的工号，请先删除相同工号');
                return;
            }
            var index = workNumArr[i].indexOf(':');
            var name = workNumArr[i].substr(0,index);
            numberArr.push(name);
        } 

        $("option[name='yjbl']:checked").each(function(index,item){
            ratio.push($(item).val()); 
        });
        var bili = ratio.reduce(function(a,b){
            return parseFloat(a) + parseFloat(b);
        });
        if(bili != '1'){
            $('#showRatio').text('比例相加必须等于1');
            return;
        }else{
            $('#showRatio').text('');
        }

        var sure = confirm('真的确定提交业绩分配吗？');

        /*if(sure){
            var orderno = parent.document.getElementById("orderno").value;
            var servalNum = '';
            for(var a=0;a<numberArr.length;a++){
                servalNum += numberArr[a]+':'+ratio[a]+'*';
            }
            servalNum = servalNum.substring(0,servalNum.length-1); //去掉最后一个字符串
            $.post('index.php?r=ddgl/OrderTurnPerformance',{orderno:orderno,yjfp:servalNum},function(data){
                if(!data){
                    alert("业绩分配没变化");
                    return;
                }
                if(data.res == 'success'){
                    parent.document.getElementById("yjfp").innerHTML = servalNum;
                    parentDialog.close();
                }
                
            },'json');
        }*/
        if(sure){
            var servalNum = '';
            for(var a=0;a<numberArr.length;a++){
                servalNum += numberArr[a]+':'+ratio[a]+'*';
            }
            servalNum = servalNum.substring(0,servalNum.length-1); //去掉最后一个字符串
            parent.document.getElementById("orderPerformance").innerHTML = servalNum;
            parentDialog.close();
        }
        
    }
});

/**
 * @desc 增加工号
 * @author WuJunhua
 * @date 2015-11-11
 */
$('body').on('click','#addJobNum',function(){
    var JnLine = $('.JnLine').length;
    var length = JnLine+1;
    if(length == 4){
        $('#addJobNum').attr("disabled","disabled");
    }
    $('#table8').append('<tr class="JnLine gonghao"><td>工号'+length+'<font></font>： <input class="showNumber" style="border:1px solid #000;" type="text" name="" value=""/><div class="workNumberList" style="display:none;background-color:#D3D3D3;position:absolute;overflow:auto;width:200px;height:150px;z-index:5;"><table style="width:400px;" class="table3"><tr><td class="closeNumberList" style="cursor:pointer;">关闭</td></tr></table></div></td><td style="padding-left:30px;">业绩比例：<select style="width:60px;height:20px;" name="" id=""><option name="yjbl" value="1">1</option><option name="yjbl" value="0.9">0.9</option><option name="yjbl" value="0.8">0.8</option><option name="yjbl" value="0.7">0.7</option><option name="yjbl" value="0.6">0.6</option><option name="yjbl" value="0.5">0.5</option><option name="yjbl" value="0.4">0.4</option><option name="yjbl" value="0.3">0.3</option><option name="yjbl" value="0.2">0.2</option><option name="yjbl" value="0.1">0.1</option></select></td><td>&nbsp;&nbsp;&nbsp;&nbsp;<img class="delgoodline" src="public/img/del.png"  border="0" style="width:50%;cursor:pointer" title="删除该行"/></td></tr>');
});

  //删除工号行
   $('#table8').on('click','.delgoodline',function(){
        var JnLine = $('.JnLine').length;
        if(JnLine == 1){
            alert('请最少保留一行');return;
        }
        $(this).parent().parent().remove();
    });