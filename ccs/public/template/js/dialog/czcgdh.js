
$(function(){
    $.post('index.php?r=cggl/GetReturnSuppliersOrder',function(data){
        listData(data);
    },'json');
});

/**
 * @desc 退货采购单列表获取数据插入节点
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
            listInfo += '<td style="width:10;"><input name="radioname" type="radio" value="'+ data.list[i]['cgaa01'] +'" />'+a+'</td>' 
                 +'<td><span>'+ data.list[i]['cgaa01'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['cgaa09'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['cgaa04'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['cgaa03'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['cgaa16'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['cgaa15'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['cgaa05'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['cgaa06'] +'</span></td>'
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
        alert('请选择退货的采购单号');return;
    }
    parent.document.getElementById("orderno").value = ordernogdrg;
    parent.$('#tbody2').empty();
    parent.$('.returnMark').css('display','none');
    parentDialog.close();
});

//点击查询按钮
$('body').on('click','#inquire',function(){
    var xdsjq = $('#xdsjq').val();//下单时间
    var xdsjz = $('#xdsjz').val();//下单时间（至）
    var gys = $("option[name='gys']:checked").val();//供应商
    $.get('index.php?r=cggl/GetReturnSuppliersOrder',{xdsjq:xdsjq,xdsjz:xdsjz,gys:gys},function(data){
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