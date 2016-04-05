
$(function(){
    $.post('index.php?r=ddgl/GetReturnOrder',function(data){
        listData(data);
    },'json');
});

/**
 * @desc 退货订单列表获取数据插入节点
 * @author WuJunhua
 * @date 2016-03-09
 */
function listData(data){
    $('#tbody2').empty();
    $('.page').empty();
    if(data.result == 'success'){
        var length = data.list.length;
        //$('#pagehidden').attr({ page: data.page, psize: data.psize });
        for(var i = 0; i < length; i++){
            var a = i+1;
            var listInfo = '';
            listInfo = '<tr>';
            listInfo += '<td style="width:10;"><input name="radioname" type="radio" value="'+ data.list[i]['xsaa02'] +'" />'+a+'</td>' 
                 +'<td><span>'+ data.list[i]['xsaa02'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['xsaa05'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['xsaa19'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['xsaa44'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['xsaa48'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['xsaa23'] +'</span></td>'
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
        alert('请选择退货的订单');return;
    }
    parent.document.getElementById("orderno").value = ordernogdrg;
    parent.$('.goodList').remove();
    parent.$('.returnMark').css('display','none');
    parentDialog.close();
});

//点击查询按钮
$('body').on('click','#inquire',function(){
    var xdsjq = $('#xdsjq').val();//下单时间
    var xdsjz = $('#xdsjz').val();//下单时间（至）
    $.get('index.php?r=ddgl/GetReturnOrder',{xdsjq:xdsjq,xdsjz:xdsjz},function(data){
       if(!data){
           return;
       }
       listData(data);
   });
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