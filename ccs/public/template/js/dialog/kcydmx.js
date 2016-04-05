
var batch = $('#batch').val();//批次
var styleNum = $('#styleNum').val();//款号
$(function(){
    $.get('index.php?r=cpgl/getInventoryDetail',{batch:batch,styleNum:styleNum},function(data){
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
        for(var i = 0; i < length; i++){
            var a = i+1;
            var listInfo = '';
            listInfo = '<tr>';
            listInfo += '<td style="width:10;"><input name="radioname" type="radio" value="'+ data.list[i]['cpaf02'] +'" />'+a+'</td>' 
                 +'<td><span>'+ data.list[i]['cpaf02'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['cpaf03'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['cpaf05'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['cpaf07'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['cpaf09'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['cpaf10'] +'</span></td>'
                 + '<td><span>'+ data.list[i]['cpaf12'] +'</span></td>'
                 + '</tr>';
            $('#tbody2').append(listInfo);
        }
        $('.page').append(data.pageHtml);
    }
}

//点击查询按钮
$('body').on('click','#inquire',function(){
    var ydsjq = $('#ydsjq').val();//异动时间
    var ydsjz = $('#ydsjz').val();//异动时间
    var ydlx = $("option[name='ydlx']:checked").val();//异动类型
    $.get('index.php?r=cpgl/GetInventoryDetail',{batch:batch,styleNum:styleNum,ydsjq:ydsjq,ydsjz:ydsjz,ydlx:ydlx},function(data){
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