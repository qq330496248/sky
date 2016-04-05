$(function(){
	/**
     * @desc 加载视图后，显示数据
     * @author WuJunhua
     * @date 2015-11-13
     */
    $.post('index.php?r=cpgl/GetProductStockDetails',function(data){
        listData(data);
    },'json')


})

/**
 * @desc 库存列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-11-13
 */
function listData(data){
    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data.result == 'success'){
        var length = data.list.length;
        $('#pagehidden').attr({ page: data.page, psize: data.psize });
        for(var i = 0; i < length; i+=2){
            if(!data.list[i]['cpae06']){
                data.list[i]['cpae06'] = '';
            }
            if(!data.list[i]['cpae03']){
                data.list[i]['cpae03'] = '0';
            }
            if(!data.list[i]['cpae04']){
                data.list[i]['cpae04'] = '0';
            }
            if(!data.list[i]['cpae09']){
                data.list[i]['cpae09'] = '0';
            }
            if(!data.list[i]['cpae07'] || data.list[i]['cpae07']==0.00){
                data.list[i]['cpae07'] = '';
            }
            if(!data.list[i]['cpae13'] || data.list[i]['cpae13']==0.00){
                data.list[i]['cpae13'] = '';
            }
            if(!data.list[i]['cpae21']){
                data.list[i]['cpae21'] = '';
            }
            var listInfo = '';
            listInfo = '<tr class="singular">';
            listInfo += '<td><span>'+ data.list[i]['cpae01'] +'</span></td>'
                        +'<td><span>'+ data.list[i]['cpaa01'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpaa02'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpaa10'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpae06'] +'</span></td>'
                        + '<td><span>'+ parseInt(data.list[i]['cpae03']) +'/'+ parseInt(data.list[i]['cpae04']) +'</span></td>'
                        + '<td><span><input name="" type="text" class="dfinput authentic" style="width:60px" />/<input name="" type="text" class="dfinput defective" style="width:60px" /></span></td>'
                        + '<td><span>'+ data.list[i]['cpae07'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpae13'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpae21'] +'</span></td>'
                        + '<td><input type="button" class="btn scrapped" style="width:60px;" value="报 废" batch="'+ data.list[i]['cpae01'] +'" styleNum="'+ data.list[i]['cpaa01'] +'" genuineStocks="'+ parseInt(data.list[i]['cpae03']) +'" /></td>'
                        + '</tr>';
            if(i != length - 1){
                listInfo += '<tr class="complex">'
                        + '<td><span>'+ data.list[i+1]['cpae01'] +'</span></td>'
                        +'<td><span>'+ data.list[i+1]['cpaa01'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpaa02'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpaa10'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpae06'] +'</span></td>'
                        + '<td><span>'+ parseInt(data.list[i+1]['cpae03']) +'/'+ parseInt(data.list[i+1]['cpae04']) +'</span></td>'
                        + '<td><span><input name="" type="text" class="dfinput authentic" style="width:60px" />/<input name="" type="text" class="dfinput defective" style="width:60px" /></span></td>'
                        + '<td><span>'+ data.list[i+1]['cpae07'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpae13'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['cpae21'] +'</span></td>'
                        + '<td><input type="button" class="btn scrapped" style="width:60px;" value="报 废" batch="'+ data.list[i+1]['cpae01'] +'" styleNum="'+ data.list[i+1]['cpaa01'] +'" genuineStocks="'+ parseInt(data.list[i+1]['cpae03']) +'" /></td>'
                        + '</tr>';
            }
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
    }else{
        var listInfo = '<tr><td colspan="11" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }  
}

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-11-13
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
 * @desc 查询库存明细条件请求
 * @author WuJunhua
 * @date 2016-02-03
 */
function InventoryDetailData(sign,page,psize){ 
    //var cpfl1 = $("option[name='cpfl1']:checked").val();//产品分类
    var cpmc = $('#cpmc').val();//产品名称
    var cpkh = $('#cpkh').val();//产品款号
    var cpjj = $("option[name='cpjj']:checked").val();//产品价格符号(不限 > = <)
    var price = $('#price').val(); //产品价格
    var cpsxj = $("option[name='cpsxj']:checked").val();//上下架
    var location = $('#location').val();//库位
    var stock = $('#stock:checked').length; //库存是否大于0
    if(stock == 0){
        stock = 2;
    }
   if(sign == 1){
        $.get('index.php?r=cpgl/GetProductStockDetails',{cpmc:cpmc,cpkh:cpkh,cpjj:cpjj,price:price,cpsxj:cpsxj,location:location,stock:stock,sign:sign,page:page,psize:psize},function(data){
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
        $.get('index.php?r=cpgl/GetProductStockDetails',{cpmc:cpmc,cpkh:cpkh,cpjj:cpjj,price:price,cpsxj:cpsxj,location:location,stock:stock,sign:sign},function(data){
            if(!data){
                return;
            }
            listData(data);
        });
   }
   
}

/**
 * @desc 库存明细查询
 * @author huyan
 * @date 2015-11-25
 */
$('#QueryStock').on('click',function(){
    var page = '';
    var psize = '';
    var sign = 0; //查询标识
    InventoryDetailData(sign,page,psize);
    
});

/**
 * @desc 仓库报废 ***********暂时只做正品库存的报废操作************
 * @author WuJunhua
 * @date 2016-03-17
 */
$('body').on('click','.scrapped',function(){
    var $this = $(this);
    //分别获取批次、款号、正品库存量和正品报废数
    var batch = $this.attr('batch');
    var styleNum = $this.attr('styleNum');
    var genuineStocks = $this.attr('genuineStocks'); 
    var authentic = $this.parent().siblings().find('.authentic').val();
    if(!$.trim(authentic)){
        alert('正品报废数不能为空');
        return;
    }
    if(!regNumber.test(authentic)){
        alert('正品报废数只能是整数');
        return;
    }
    if(parseInt(authentic) > genuineStocks){
        alert('正品报废数不能大于正品库存量');
        return;
    }

    var ensure = confirm('你确定要报废这'+ authentic +'件商品吗？');
    if(ensure){
        $.post('index.php?r=wlgl/WarehouseScrapped',{batch:batch,styleNum:styleNum,authentic:authentic},function(data){
            if(!data){
                return;
            }
            if(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=wlgl/GetCkbfHtml";
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
            }
        });
    }
    
});


/**
 * @desc 导出excel
 * @author WuJunhua
 * @date 2015-12-18
 */
/*$('body').on('click','#exportExcel',function(){
    var page = $('#pagehidden').attr('page');
    var psize = $('#pagehidden').attr('psize');
    var sign = 1; //导出excel标识
    InventoryDetailData(sign,page,psize);
});*/