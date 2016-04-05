$(function(){
    function listData(data){
        $('.gonghao').remove();//工号
        $('#addJobNum').removeAttr("disabled");
        $('#WorkNumber').show();
        var yonghu = $('#sxyh').val();
        var aaa= []; //定义一数组
        aaa=yonghu.split(","); //字符分割 
        var len = aaa.length;

        //$('#FollowRecord').empty();
        $('.page').empty();
        if(data.result == 'success'){
           if(!data){
                return;
            }
            if(data.res != 'error'){
                $('#tbody2').empty();
                var length = data.list.length;
                $('#pagehidden').attr({ page: data.page, psize: data.psize });
                for(var i = 0; i < length; i++){
                    var a = i+1;
                    var listInfo = '';
                    listInfo = '<tr>';
                    if (yonghu.indexOf(data.list[i]['username'])!=-1){
                                listInfo += '<td style="width:10;"><input type="checkbox" checked ordernomx="'+data.list[i]['username']+'" value="'+ data.list[i]['username'] +'" class="checkbox"/>'+a+'</td>'
                            }else{
                                listInfo += '<td style="width:10;"><input type="checkbox" ordernomx="'+data.list[i]['username']+'"value="'+ data.list[i]['username'] +'" class="checkbox"/>'+a+'</td>'  
                            }
                            listInfo +='<td><span>'+ data.list[i]['username'] +'</span></td>'
                                + '<td><span>'+ data.list[i]['personname'] +'</span></td>'
                                + '</tr>';

                        $('#tbody2').append(listInfo);
                        }
                    $('.page').append(data.pageHtml);
                }
        }
}

//点击发送内部短信弹框
    $('body').on('click','#QueryNumber',function(){
         $.post('index.php?r=khgl/getNamNumber',function(data){
            listData(data);
        },'json');
    });

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-10-31
 */
$('body').on('click','.page a',function(){
    var $this = $(this);
    var $href = $this.attr('href');
    $('#url').val($href);
    if($href == undefined){
        return;
    }
    $this.attr('href',"javascript:;");
    $.post($href,function(data){
       /* var orderno = [];
        $('.checkbox:checked').each(function(index,item){
            orderno.push($(item).attr('ordernomx'));  
        });
        $('#sxyh').val(orderno);
        var gtrdt=$('#sxyh').val();
        var obj2 = gtrdt.split(",");
        if (orderno.length>0) {
            $('#sxyh').val(obj2+','+orderno);
        }*/
        listData(data);
    });
});



    /*
    * @desc 选定用户
    * @author huyan
    * @date 2015-11-24
    */
    $('body').on('click','#Determine',function(){
       var sxyh =  $('#sxyh').val();
        $('#sxyh').val(sxyh);
    });

    //点击关闭发送短息弹框
    $('body').on('click','#CloseCommit',function(){
        $('#WorkNumber').hide();
    });

      //点击确定获取选中数据
    $('body').on('click','#SelectUser',function(){
        var orderno = [];
        $('.checkbox:checked').each(function(index,item){
            orderno.push($(item).attr('ordernomx'));  
        });
        for(var i=0;i<orderno.length;i++){
            orderno[i] = orderno[i]
        }
        $('#sxyh').val(orderno);
        $('#WorkNumber').hide();
    });

    //群发特效
    $("#qunfa").click(function(){ 
        var pitchon=($("#qunfa").attr("checked"));
        if (pitchon='checked') {
            $('#sxyh').attr('disabled', true);
            $("#QueryNumber").attr('disabled',true);
            $("#QueryNumber").css("background","gray");
            $("#sxyh").css("boreder","rgb(64,153,203)");
            $("#QueryNumber").css("cursor","not-allowed");
        }
    });

     $("#qunfa").click(function(){ 
        var pitchon=($("#qunfa").attr("checked"));
        if(pitchon!='checked'){
            $('#sxyh').attr('disabled',false);
            $("#QueryNumber").css("background","rgb(64,153,203)");
            $("#QueryNumber").attr('disabled',false);
            $("#QueryNumber").css("cursor","");
        }
    });

/*
 * @desc 确定：发送短信
 * @author huyan
 * @date 2015-11-24
 */
    $('body').on('click','#SendOut',function(){
        var sxyh = $('#sxyh').val();//收信人
        var dxbt = $('#dxbt').val();//标题
        var dxnr= $('#dxnr').val();//内容
        /*var aaa= $('#cxjg').text(cxjg);
        alert(aaa);return;*/
        
        if (!dxnr) {
            alert('短信内容不能为空');
            return;
        }
        var pitchon=($("#qunfa").attr("checked"));
        var sfqf=pitchon;

        $.get('index.php?r=khgl/SendMessages',{sxyh:sxyh,dxbt:dxbt,dxnr:dxnr,sfqf:sfqf},function(data){
            if(!data){
                alert('发送失败');
                return;
            }
            if(data.res == 'error'){
                alert(data.msg);
                return;
             }
             if(data.res == 'success'){
                alert(data.msg);
                window.location.href="index.php?r=dxgl/GetYfnbdxHtml&yfnbdx.html";
            }

        },'json')
    });


    /*
 * @desc 工号姓名查询
 * @author huyan
 * @date 2015-11-24
 */
/*    $('body').on('click','#searchgonghao',function(){
        var searchtype = $("input[name='search']:checked").val();
        var keyword = $('#keyword').val();
       $.get('index.php?r=khgl/getUserNumber',{searchtype:searchtype,keyword:keyword},function(data){
            if(!data){
                $('#cxjg').text('没有查询到该用户');
                return;
            }
            var cxjg = data.username+':'+data.personname;
            $('#cxjg').text(cxjg);
            var sxyh=data.username;
            $('#sxyh').val(sxyh);
            var dxbt=data.username;
            var laiz="发送给";
            var ddx="的短信";
            $('#dxbt').val(laiz+dxbt+ddx);
        });
    });*/
})

var httpHost = $('#httpHost').val();  //服务器地址
//打开弹出框
function showXzyh(){
    var dialog = new Dialog();
//    dialog.Modal = false;
    dialog.Width=710;
    dialog.Height=450;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetXzyhHtml";
    dialog.show();
}

function closeXzyh(){
    Dialog.close();
}