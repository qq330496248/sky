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
 * @desc 客户订单列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-11-13
 */
function listData(data){
    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data.result == 'success'){
        var length = data.list.length;
        $('#pagehidden').attr({ page: data.page, psize: data.psize });
        var zpkcl = data.total['zpkcl'];
        var cpkcl = data.total['cpkcl'];
        var zje = data.total['zje'];
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
            /*if(!data.list[i]['cpae07'] || data.list[i]['cpae07']==0.00){
                data.list[i]['cpae07'] = '';
            }
            if(!data.list[i]['cpae13'] || data.list[i]['cpae13']==0.00){
                data.list[i]['cpae13'] = '';
            }*/
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
                        + '<td><span class="totalAuthentic">'+ parseInt(data.list[i]['cpae03']) +'</span>/<span class="totalDefective">'+ parseInt(data.list[i]['cpae04']) +'</span></td>'
                        + '<td><span>'+ parseInt(data.list[i]['cpae09']) +'/0</span></td>'
                        + '<td><span>'+ data.list[i]['cpae07'] +'</span></td>'
                        + '<td><span class="totalPrice">'+ data.list[i]['cpae13'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpaa15'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpaa08'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['cpae21'] +'</span></td>'
                        + '<td><input batch="'+ data.list[i]['cpae01'] +'" styleNum="'+ data.list[i]['cpaa01'] +'" type="button" class="btn-info details" value="明 细"/><a target="_blank" href="public/template/grfUtils/data/xmlKuCunMingXi.php?id='+ data.list[i]['cpaa01'] +'"><input type="button" class="btn" value="打 印"/></a></td>'
                        + '</tr>';
                        if(i != length - 1){
                            listInfo += '<tr class="complex">'
                            +'<td><span>'+ data.list[i+1]['cpae01'] +'</span></td>'
                            +'<td><span>'+ data.list[i+1]['cpaa01'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['cpaa02'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['cpaa10'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['cpae06'] +'</span></td>'
                            + '<td><span class="totalAuthentic">'+ parseInt(data.list[i+1]['cpae03']) +'</span>/<span class="totalDefective">'+ parseInt(data.list[i+1]['cpae04']) +'</span></td>'
                            + '<td><span>'+ parseInt(data.list[i+1]['cpae09']) +'/0</span></td>'
                            + '<td><span>'+ data.list[i+1]['cpae07'] +'</span></td>'
                            + '<td><span class="totalPrice">'+ data.list[i+1]['cpae13'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['cpaa15'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['cpaa08'] +'</span></td>'
                            + '<td><span>'+ data.list[i+1]['cpae21'] +'</span></td>'
                            + '<td><input batch="'+ data.list[i+1]['cpae01'] +'" styleNum="'+ data.list[i+1]['cpaa01'] +'" type="button" class="btn-info details" value="明 细"/><a target="_blank" href="public/template/grfUtils/data/xmlKuCunMingXi.php?id='+ data.list[i+1]['cpaa01'] +'"><input type="button" class="btn" value="打 印"/></a></td>'
                            + '</tr>';
                        }
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
        $('.Pager').append('<span style="padding-left:1%;">正品总库存量：<span style="color:#ff0000;">'+ zpkcl +'</span>&nbsp;&nbsp;&nbsp;&nbsp;总金额：<span style="color:#ff0000;">'+ zje +'</span>&nbsp;&nbsp;&nbsp;&nbsp;次品总库存量：<span style="color:#ff0000;">'+ cpkcl +'</span></span>');
        var totalPrice = 0; //列总额
        var totalAuthentic = 0; //列正品总库存量
        var totalDefective = 0; //列次品总库存量
        $('.totalPrice').each(function(index,item) { 
            totalPrice += parseFloat($(item).text()); 
        });
        $('.totalAuthentic').each(function(index,item) { 
            totalAuthentic += parseFloat($(item).text()); 
        });
        $('.totalDefective').each(function(index,item) { 
            totalDefective += parseFloat($(item).text()); 
        });
        $('.page').append('本页正品总库存量：<span style="color:#ff0000;">'+ totalAuthentic +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页总金额：<span style="color:#ff0000;">'+ totalPrice +'</span>&nbsp;&nbsp;&nbsp;&nbsp;本页次品总库存量：<span style="color:#ff0000;">'+ totalDefective +'</span>');
    }else{
        var listInfo = '<tr><td colspan="13" style="color:#0000ff;">暂时没有记录！</td></tr>';
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
 * @desc 导出excel
 * @author WuJunhua
 * @date 2015-12-18
 */
 $('body').on('click','#exportExcel',function(){
    var page = $('#pagehidden').attr('page');
    var psize = $('#pagehidden').attr('psize');
    var sign = 1; //导出excel标识
    InventoryDetailData(sign,page,psize);
 });



/**
 * @desc 库存明细弹窗
 * @author huyan
 * @date 2015-03-17
 */
 //onclick="showkcydmx()"
var httpHost = $('#httpHost').val();  //服务器地址
$('body').on('click','.details',function(){
    var $this = $(this);
    var dialog = new Dialog();
    dialog.Width=1100;
    dialog.Height=500;
    var batch = $this.attr('batch');
    var styleNum = $this.attr('styleNum');
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GettckcydmxHtml&batch="+batch+"&styleNum="+styleNum;
    dialog.show();
});
/*function showkcydmx(){
    
}*/