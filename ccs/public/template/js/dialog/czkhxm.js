
$(function(){
    $.post('index.php?r=khgl/getNameAndId',function(data){
        listData(data);
    },'json');
});

 //加载客户列表
 function listData(data){
    /*$('.gonghao').remove();//工号
    $('#addJobNum').removeAttr("disabled");*/
    $('#WorkNumber').show();
    $('#tbody2').empty();
    $('.page').empty();
    if(data.result == 'success'){
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
    parent.document.getElementById("khxm").value = ordernogdrg;
    parentDialog.close();
});

//根据条件查找客户
$('body').on('click','#LookUpUser',function(){
   var searchtype = $("input[name='search']:checked").val();
       var keyword = $('#keyword').val();
        $.post('index.php?r=khgl/QueryNameOrdId',{searchtype:searchtype,keyword:keyword},function(data){
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