$(function(){
    var orderno = $('#orderno').val(); //订单编号

    //获取退货订单的商品信息
    $.post('index.php?r=wlgl/GetReturnOrderDetails',{orderno:orderno},function(data){
       if(!data){
            return;
        }
        $('#getCheckeboxId').empty();
        $('.page').empty();
        if(data.res != 'error'){
            var length = data.length;
            for(var i = 0; i < length; i++){
                var listInfo = '';
                listInfo = '<tr>';
                listInfo += '<td><span>'+ data[i]['xsab03'] +'</span></td>'
                            + '<td><span>'+ data[i]['xsab02'] +'</span></td>'
                            + '<td><span>'+ data[i]['xsab18'] +'</span></td>'
                            + '<td><span>'+ data[i]['xsab14'] +'</span></td>'
                            + '<td><span>'+ data[i]['xsab06'] +'</span></td>'
                            + '<td><span>'+ data[i]['xsab16'] +'</span></td>'
                            + '<td><span>'+ data[i]['xsab17'] +'</span></td>'
                            + '</tr>';
                $('#getCheckeboxId').append(listInfo);
            }
        }
    });

});
