$(function(){
    /**
     * @desc 加载视图后，显示数据
     * @author huyan
     * @date 2015-12-03
     */
    $.post('index.php?r=khgl/GetComplaint',function(data){
        listData(data);
        //全选(全不选)特效
        checkAll($('#checkall'),$('.checkbox'));
    },'json')
})

var khid = $('#khid').val();
function listData(data){
    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data.result == 'success'){
        var length = data.list.length;
        $('#pagehidden').attr({ page: data.page, psize: data.psize });
        var nowTime = '1920-01-01 10:00:00';
        for(var i = 0; i < length; i+=2){
          if(data.list[i]['khac11'] < nowTime){
                data.list[i]['khac11'] = '';
            }
            var listInfo = '';
            var a = i+1;
            listInfo = '<tr class="singular">';
            listInfo += '<td style="width:10;"><input type="checkbox" orderno="'+data.list[i]['khac09']+'" value="'+ data.list[i]['khac01'] +'" class="checkbox"/>'+a+'</td>'
            listInfo +=  '<td><span>'+ data.list[i]['khac13'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khac02'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khac05'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khac06'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khac03'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khac09'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khac04'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khac10'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khac11'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khac08'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khac07'] +'</span></td>'
                        + '<td><a class="canJumpPage" style="font-size:14px;width:50px;" href="index.php?r=khgl/GettjtsHtml&khid='+ data.list[i]['khac14'] +'"><img src="public/img/reservin.png" title="编辑" border="0" style="width:12%;cursor:pointer" /></a><img id="DeleteComp" src="public/img/del.png" title="点击删除" border="0" style="width:12%;cursor:pointer" orderno="'+ data.list[i]['khac14'] +'"/></td>'
                        + '</tr>';
                        if(i != length - 1){
                            if(data.list[i+1]['khac11'] < nowTime){
                                data.list[i+1]['khac11'] = '';
                            }
                            listInfo += '<tr class="complex">'
                            + '<td style="width:10;"><input type="checkbox" orderno="'+data.list[i+1]['khac09']+'" value="'+ data.list[i+1]['khac01'] +'" class="checkbox"/>'+(a+1)+'</td>'
                             +'<td><span>'+ data.list[i+1]['khac13'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['khac02'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['khac05'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['khac06'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['khac03'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['khac09'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['khac04'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['khac10'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['khac11'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['khac08'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['khac07'] +'</span></td>'
                            + '<td><a class="canJumpPage" style="font-size:14px;width:50px;" href="index.php?r=khgl/GettjtsHtml&khid='+ data.list[i+1]['khac14'] +'"><img src="public/img/reservin.png" title="编辑" border="0" style="width:12%;cursor:pointer" /></a><img id="DeleteComp" src="public/img/del.png" title="点击删除" border="0" style="width:12%;cursor:pointer" orderno="'+ data.list[i+1]['khac14'] +'"/></td>'
                            + '</tr>';
                        }
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
    }else{
        var listInfo = '<tr><td colspan="13" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }
}


//批量转客户投诉
$('body').on('click','#batchArragin',function(){
    var orderno = [];
    $('.checkbox:checked').each(function(index,item){
        orderno.push($(item).attr('orderno'));  
    });

    if(orderno.length == 0){
        alert('请选择要转的投诉记录');
        return;
    }
    var zgtsgh=$("option[name='zgtsgh']:checked").val();//转给跟进工号
    var a= zgtsgh.split(":");
    var ensure = confirm('确定要转给工号:'+a[0]+'吗？');
    if(ensure){
        $.post('index.php?r=khgl/TurnOutComplaints',{orderno :orderno,zgtsgh:zgtsgh},function(data){
            if(!data){
                alert('转出失败，请重新操作！');
            }
            if(data.res == 'success'){
                alert(data.msg);
              window.location.href="index.php?r=khgl/GetKhtsHtml&khts.html";
            }
            if(data.res == 'error'){
                alert(data.msg);
                return;
            }
        },'json');
        
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
    $('#url').val($href);
    if($href == undefined){
        return;
    }
    $this.attr('href',"javascript:;");
    $.post($href,function(data){
        listData(data);
        //全选(全不选)特效
        checkAll($('#checkall'),$('.checkbox'));
    });
});

//单个删除跟进记录
$('#getCheckeboxId').on('click','#DeleteComp',function(){
    var orderid = $(this).attr('orderno');
    if(orderid){
        var ensure = confirm('确定要删除吗？');
        if(ensure){
            $.post('index.php?r=khgl/DeleteComplaint',{orderno:orderid},function(data){
                if(!data){
                    alert('删除失败，请重新操作！');
                }
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=khgl/GetKhtsHtml&khts.html";
                }else{
                    alert(data.msg);
                    return;
                }
            })
        }
    }
});

/**
 * @desc 查询我的客户资料条件请求
 * @author WuJunhua
 * @date 2016-01-26
 */
function ClientComplaintsData(sign,page,psize){ 
    var gjgh=$("option[name='khgjgh']:checked").val();//跟进工号
    var tssjq= $('#tssjq').val();//投诉时间
    var tssjz= $('#tssjz').val();//投诉时间（至）
    var tsxm = $('#tsxm').val();//姓名
    var khtsgh=$("option[name='khtsgh']:checked").val();//投诉工号
    var sfcl=$("option[name='sfcl']:checked").val();//是否处理
    var khtslx=$("option[name='khtslx']:checked").val();//投诉类型

   if(sign == 1){
        if ($('#inquireSign').val() == 0 ) {
            tssjq = '';
            tssjz = '';
        }
        $.get('index.php?r=khgl/GetComplaint',{gjgh:gjgh,tssjq:tssjq,tssjz:tssjz,tsxm:tsxm,khtsgh:khtsgh,sfcl:sfcl,khtslx:khtslx,sign:sign,page:page,psize:psize},function(data){
            if(!data){
                return;
            }
            if(data.result == 'error'){
                alert(data.msg);
                return;
            }
            if(data.result == 'exportExcel'){
                idownload(data.url);
                //导出excel成功后，要清除服务器上的xls文件
                $.post('index.php?r=xtsz/DeleteExcelFile',{url:data.url},function(data){

                });
            }   
        });
   }else{
        $.get('index.php?r=khgl/GetComplaint',{gjgh:gjgh,tssjq:tssjq,tssjz:tssjz,tsxm:tsxm,khtsgh:khtsgh,sfcl:sfcl,khtslx:khtslx,sign:sign},function(data){
            if(!data){
                return;
            }
             $('#inquireSign').val(1);
            listData(data);
            //全选(全不选)特效
            checkAll($('#checkall'),$('.checkbox'));
        });
   }
   
}

/**
 * @desc 客户投诉查询
 * @author huyan
 * @date 2015-12-03
 */
$('#Complaint').on('click',function(){
    var page = '';
    var psize = '';
    var sign = 0; //查询标识
    ClientComplaintsData(sign,page,psize);
    
});


/**
 * @desc 导出excel
 * @author WuJunhua
 * @date 2015-12-28
 */
 $('body').on('click','#exportExcel',function(){
    var page = $('#pagehidden').attr('page');
    var psize = $('#pagehidden').attr('psize');
    var sign = 1; //导出excel标识
    ClientComplaintsData(sign,page,psize);
 });


