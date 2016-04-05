$(function(){
    /**
     * @desc 加载视图后，显示数据
     * @author huyan
     * @date 2015-12-04
     */
    $.post('index.php?r=khgl/getComplaintTypeList',function(data){
        listData(data);
    },'json')
})

function listData(data){
    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data.result == 'success'){
        var length = data.list.length;
        $('#pagehidden').attr({ page: data.page, psize: data.psize });  
        for(var i = 0; i < length; i++){
            var listInfo = '';
            var a = i+1;
            listInfo = '<tr>';
            listInfo += '<td>'+a+'</td>';
            listInfo +=   '<td><span>'+ data.list[i]['khad05'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khad02'] +'</span></td>'
                        + '<td><input id="Shipped" name="" type="button" class="btn" style="width:50px;" orderno="'+ data.list[i]['khad05'] +'"  orderedit="'+ data.list[i]['khad01'] +'"value="删除"/></td>'
                        + '</tr>';
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
    }
}

//单个删除投诉类型
    $('#table4').on('click','#Shipped',function(){
        var orderid = $(this).attr('orderno');
        var oderlist= $(this).attr('orderedit');
        if(orderid){
            var ensure = confirm('确定要删除吗？');
            if(ensure){
                $.post('index.php?r=khgl/DeleteTypeComplaint',{orderno:orderid,orderedit:oderlist},function(data){
                    if(!data){
                        alert('删除失败，请重新操作！');
                    }
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=khgl/GettjKhtsHtml&tjtslx.html";
                    }else{
                        alert(data.msg);
                        return;
                    }
                })
            }
        }
    });


/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-10-31
 */
$('body').on('click','.page a',function(){
    var $this = $(this);
    var $href = $this.attr('href');
    if($href == undefined){
        return;
    }
    $this.attr('href',"javascript:;");
    $.post($href,function(data){
        listData(data);
    });
});

/**
     * @desc 添加投诉类型
     * @author huyan
     * @date 2015-12-04
     */
  $('#TypeComplaint').on('click',function(){
        var lxmc=$('#lxmc').val();//类型名称
        var tssjfl=$("option[name='tssjfl']:checked").val();//上级分类

        if (!lxmc) {
            alert('请填写投诉类型名称');
            return;
        }
       
       if (!tssjfl){
        $.post('index.php?r=khgl/AddTypeComplaint',{lxmc:lxmc,tssjfl:tssjfl},function(data){
            if(!data){
                alert('添加失败');
                return;
            }
            if(data.res == 'error'){
                alert(data.msg);
                return;
             }
            if(data.res == 'success'){
                alert(data.msg);
                window.location.href="index.php?r=khgl/GettjKhtsHtml&tjtslx.html";
            }
             
        },"json");
      }
      else{
        $.post('index.php?r=khgl/AddSmallTypeComplaint',{lxmc:lxmc,tssjfl:tssjfl},function(data){
            if(!data){
                alert('添加失败');
                return;
            }
            if(data.res == 'error'){
                alert(data.msg);
                return;
             }
            if(data.res == 'success'){
                alert(data.msg);
                window.location.href="index.php?r=khgl/GettjKhtsHtml&tjtslx.html";
            }
             
        },"json");
      }

    });



