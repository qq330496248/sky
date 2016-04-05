$(function(){
    //生成盘差报表
    $('body').on('click','#generateForm',function(){
        /*
         * @desc 加载视图后，显示数据
         * @author WuJunhua
         * @date 2015-12-02
         */
        $.post('index.php?r=wlgl/GenerateDifferenceForm',function(data){
            listData(data);
        },'json');
        $('#showGenerateForm').css('display','block');
    });
});

/*
 * @desc 生成盘差列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-12-02
 */
 function listData(data){
    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data){
        var length = data.length;
        for(var i = 0; i < length; i++){
            var listInfo = '';
            listInfo = '<tr class="singular">';
            listInfo += '<td><span><input type="hidden" value="'+ data[i]['pdab02'] +'" name="goodItems"/>'+ data[i]['pdab02'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['pdab03'] +'" name="goodItems"/>'+ data[i]['pdab03'] +'</span></td>'
                        + '<td><span>'+ data[i]['pdab11'] +'</span></td>'
                        + '<td><span>'+ parseInt(data[i]['pdab05']) +'</span></td>'
                        + '<td><span>'+ parseInt(data[i]['pdab06']) +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i]['pdab08'] +'" name="goodItems"/>'+ parseInt(data[i]['pdab08']) +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ parseInt(data[i]['pdab08']-data[i]['pdab05']) +'" name="goodItems"/>'+ parseInt(data[i]['pdab08']-data[i]['pdab05']) +'</span></td>'
                        + '<td><span></span></td>'
                        + '<td><span></span></td>'
                        + '<td><span>'+ data[i]['pdaa03'] +'</span></td>'
                        + '</tr>';
            if(i != length - 1){
                  listInfo += '<tr class="complex">'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['pdab02'] +'" name="goodItems"/>'+ data[i+1]['pdab02'] +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['pdab03'] +'" name="goodItems"/>'+ data[i+1]['pdab03'] +'</span></td>'
                        + '<td><span>'+ data[i+1]['pdab11'] +'</span></td>'
                        + '<td><span>'+ parseInt(data[i+1]['pdab05']) +'</span></td>'
                        + '<td><span>'+ parseInt(data[i+1]['pdab06']) +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ data[i+1]['pdab08'] +'" name="goodItems"/>'+ parseInt(data[i+
                            1]['pdab08']) +'</span></td>'
                        + '<td><span><input type="hidden" value="'+ parseInt(data[i+1]['pdab08']-data[i+1]['pdab05']) +'" name="goodItems"/>'+ parseInt(data[i+1]['pdab08']-data[i+1]['pdab05']) +'</span></td>'
                        + '<td><span></span></td>'
                        + '<td><span></span></td>'
                        + '<td><span>'+ data[i+1]['pdaa03'] +'</span></td>'
                        + '</tr>';
            }
            $('#getCheckeboxId').append(listInfo);
        }
        
    }  
   
}

//入账(盘盈、盘亏)
    $('body').on('click','#recorded',function(){
        var goodItems = [];
        //获取单个或多个产品信息  
        $('.goodline').find('input[name="goodItems"]').each(function(index,item){
            goodItems.push($(item).val());   
        }); 
        $.post('index.php?r=wlgl/GoodsRecorded',{goodItems:goodItems},function(data){
            if(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
            }
        });
    });




