$(function(){
})

    //点击显示商品信息
    $('body').on('focus','.goodName',function(){  
        $.post('index.php?r=cpgl/GetAllGoodList',function(data){
            goodListData(data);
        },'json');
        $(this).next('.goodList').css('display','block');
    });

      /**
     * @desc 商品信息获取数据插入节点
     * @author WuJunhua
     * @date 2016-01-22
     */
     function goodListData(data){
        if(data != 'error'){
            $('.oneGoodLine').remove();
            var length = data.length;
            for(var i = 0; i < length; i++){
                if(!data[i].cpae03){
                    data[i].cpae03 = '0.00';
                }
                var listInfo = '';
                listInfo = '<tr class="oneGoodLine" style="cursor:pointer;" goodid="'+ data[i].cpaa01 +'">';
                listInfo += '<td class="goodNumber"><span><font style="color:blue;">'+ data[i].cpaa01 +'</font>:'+ data[i].cpaa02 +'</span></td>'
                            +'</tr>';
                $('.table5').append(listInfo); 
            }
        }
    }

    //输入商品名称进行模糊搜索
    $('body').on('keyup','.goodName',function(){  
        var goodName = $(this).val();
        $.post('index.php?r=cpgl/GetAllGoodList',{goodName:goodName},function(data){
            goodListData(data);
        },'json');
        $(this).next('.goodList').css('display','block');  
    });

    //点击选中商品并在页面上显示对应的信息
     $('body').on('click','.oneGoodLine',function(){
        var $this = $(this);
        var goodId = $this.attr('goodid');
        $.post('index.php?r=cpgl/GetGoodList',{goodid: goodId},function(data){
            if(!data){
                return;
            }
            if(data){
                $this.parent().parent().parent().siblings('.goodName').val(data.cpaa02);
            }
            $('.goodList').css('display','none');
        },'json');
    });


     //点击关闭商品信息
    $('body').on('click','.closeGoodList',function(){
        $('.goodList').css('display','none');
    });

     //加载客户列表
     function listData(data){
        /*$('.gonghao').remove();//工号
        $('#addJobNum').removeAttr("disabled");*/
        $('#WorkNumber').show();
        $('#tbody2').empty();
        $('.page').empty();
        if(data.result == 'success'){
            $('#tbody2').empty();
            var length = data.list.length;
            $('#pagehidden').attr({ page: data.page, psize: data.psize });
            for(var i = 0; i < length; i++){
                var a = i+1;
                var listInfo = '';
                listInfo = '<tr>';
                listInfo += '<td style="width:10;"><input name="radioname" type="radio" ordernomx="'+data.list[i]['khaa01']+'"value="'+ data.list[i]['khaa03'] +'" />'+a+'</td>' 
                listInfo +='<td><span>'+ data.list[i]['khaa02'] +'</span></td>'
                     + '<td><span>'+ data.list[i]['khaa03'] +'</span></td>'
                     + '</tr>';
                $('#tbody2').append(listInfo);
                }
            $('.page').append(data.pageHtml);
        }
    }
    //点击确定获取选中数据
    $('body').on('click','#SelectUser',function(){
        var ordernogdrg = $('input[name="radioname"]:checked').val();
        if (!ordernogdrg) {
            alert('请选择要投诉的客户');return;
        }
        var khxm =  $('#khxm').val();
        $('#khxm').val(ordernogdrg);
        $('#WorkNumber').hide();
    });

    /*
    * @desc 工号姓名查询
    * @author huyan
    * @date 2015-11-24
    */
    $(function(){
        $('#searchgonghao').on('click',function(){
           var searchtype = $("input[name='search']:checked").val();
           var keyword = $('#keyword').val();
         $.get('index.php?r=khgl/QueryNameOrdId',{searchtype:searchtype,keyword:keyword},function(data){
               if(!data){
                   return;
               }
               listData(data);
           });
        });
    });

    //点击查找弹框
    $('body').on('click','#LookUp',function(){
         $.post('index.php?r=khgl/getNameAndId',function(data){
            listData(data);
        },'json');
    });

      //点击关闭弹框
    $('body').on('click','#CloseCommit',function(){
        $('#WorkNumber').hide();
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
            listData(data);
        });
    });

    /**
     * @desc 修改投诉
     * @author huyan
     * @date 2015-12-04
     */
  $('#UpdateCom').on('click',function(){
        var ddbh=$('#ddbh').val();//订单id
        var khxm=$('#khxm').val();//客户姓名
        var tsbz=$('#tsbz').val();//备注
        var tscp=$('#tscp').val();//投诉产品
        var clientno = $('#clientno').val();//客户投诉自增id
        var khtsgh=$('#khtsgh').val();//投诉工号
        var tsgjgh=$('#tsgjgh').val();//跟进工号
        /*var khtsgh=$("option[name='khtsgh']:checked").val();//投诉工号
        var tsgjgh=$("option[name='tsgjgh']:checked").val();//跟进工号*/
        var tscljg=$("option[name='tscljg']:checked").val();//处理结果
        var khwt=$("option[name='khwt']:checked").val();//客户问题
        if (!khxm) {
            alert('请填写客户姓名');
            return;
        }
      /*  if (!khid) {
             alert('请填写或查找客户id');
             return;
        }*/
        if (!khwt) {
            alert('请选择投诉问题');
            return;
        }; 
       
        $.post('index.php?r=khgl/UpdateCustomerComplaints',{clientno:clientno,khxm:khxm,ddbh:ddbh,tsbz:tsbz,khtsgh:khtsgh,tsgjgh:tsgjgh,tscljg:tscljg,tscp:tscp,khwt:khwt},function(data){
            if(!data){
                alert('修改失败');
                return;
            }
            if(data.res == 'error'){
                alert(data.msg);
                return;
             }
            if(data.res == 'success'){
                alert(data.msg);
                window.location.href="index.php?r=khgl/GetKhtsHtml";
            }
             
        },"json");

    });

var httpHost = $('#httpHost').val();  //服务器地址
function showCzKhxm(){
    var dialog = new Dialog();
    dialog.Width=600;
    dialog.Height=500;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetCzkhxmHtml";
    dialog.show();
}

//var httpHost = $('#httpHost').val();  //服务器地址
$('#xzgjgh').on('click',function(){
    var dialog = new Dialog();
    dialog.Modal = false;
    dialog.Width=710;
    dialog.Height=450;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetXzgjghHtml";
    dialog.show();
});

$('#xztsgh').on('click',function(){
    var dialog = new Dialog();
    dialog.Modal = false;
    dialog.Width=710;
    dialog.Height=450;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetXztsghHtml";
    dialog.show();
});

$('#xztscp').on('click',function(){
    var dialog = new Dialog();
    dialog.Modal = false;
    dialog.Width=710;
    dialog.Height=450;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GettscpHtml";
    dialog.show();
});

function closeXzyh(){
    Dialog.close();
}


