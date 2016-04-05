$(function(){
	/*
	 * @desc 加载视图后，显示数据
	 * @author WuJunhua
	 * @date 2015-12-03
	 */
	$.post('index.php?r=wlgl/GetInventoryFlowRecordList',function(data){
		listData(data);
	},'json');

});

/*
 * @desc 库存盘点流水记录列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-12-03
 */
 function listData(data){
    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data.result == 'success'){
        var length = data.list.length;
        var nowTime = '1950-01-01 10:00:00';
        $('#pagehidden').attr({ page: data.page, psize: data.psize });
        for(var i = 0; i < length; i+=2){
          if(data.list[i]['pdaa03'] < nowTime){
            data.list[i]['pdaa03'] = '';
          }
          var listInfo = '';
          listInfo = '<tr class="singular">';
          listInfo += '<td><span>'+ data.list[i]['pdaa01'] +'</span></td>'
                      + '<td><span>'+ data.list[i]['cpaa01'] +'</span></td>'
                      + '<td><span>'+ data.list[i]['cpaa16'] +'</span></td>'
                      + '<td><span>'+ data.list[i]['cpaa02'] +'</span></td>'
                      + '<td><span></span></td>'
                      + '<td><span>'+ data.list[i]['pdab08'] +'</span></td>'
                      + '<td><span></span></td>'
                      + '<td><span></span></td>'
                      + '<td><span>'+ data.list[i]['pdaa02'] +'</span></td>'
                      + '<td><span>'+ data.list[i]['pdaa03'] +'</span></td>'
                      + '</tr>';
        if(i != length - 1){
            if(data.list[i+1]['pdaa03'] < nowTime){
              data.list[i+1]['pdaa03'] = '';
            }
          listInfo += '<tr class="complex">'
                      + '<td><span>'+ data.list[i+1]['pdaa01'] +'</span></td>'
                      + '<td><span>'+ data.list[i+1]['cpaa01'] +'</span></td>'
                      + '<td><span>'+ data.list[i+1]['cpaa16'] +'</span></td>'
                      + '<td><span>'+ data.list[i+1]['cpaa02'] +'</span></td>'
                      + '<td><span></span></td>'
                      + '<td><span>'+ data.list[i+1]['pdab08'] +'</span></td>'
                      + '<td><span></span></td>'
                      + '<td><span></span></td>'
                      + '<td><span>'+ data.list[i+1]['pdaa02'] +'</span></td>'
                      + '<td><span>'+ data.list[i+1]['pdaa03'] +'</span></td>'
                      + '</tr>';
        }
          $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
    }else{
        var listInfo = '<tr><td colspan="10" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }  
}

/*
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-12-03
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
 * @desc 查询库存盘点记录条件请求
 * @author WuJunhua
 * @date 2016-02-03
 */
function InventoryRecordData(sign,page,psize){ 
    var cpmc = $('#cpmc').val();//产品名称
    var cpkh = $('#cpkh').val();//产品款号
    var pdczr = $('#pdczr').val();//操作人
    var pdtxm = $('#pdtxm').val();///条形码
    var pdsjq = $('#pdsjq').val();//盘点时间
    var pdsjz = $('#pdsjz').val();

   if(sign == 1){
      if ($('#inquireSign').val() == 0 ) {
        pdsjq = '';
        pdsjq = '';
      }
        $.get('index.php?r=wlgl/GetInventoryFlowRecordList',{cpmc:cpmc,cpkh:cpkh,pdczr:pdczr,pdtxm:pdtxm,sign:sign,page:page,psize:psize,pdsjq:pdsjq,pdsjz:pdsjz},function(data){
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
      $.ajax({
          type: "get",
          url: "index.php?r=wlgl/GetInventoryFlowRecordList",
          async: true,
          data: {cpmc:cpmc,cpkh:cpkh,pdczr:pdczr,pdtxm:pdtxm,sign:sign,pdsjq:pdsjq,pdsjz:pdsjz},
          success: function(data){
              if(!data){
                  return;
              }
              $('#inquireSign').val(1);
              listData(data);
          }
      });
   }
   
}

/*
 * @desc 库存盘点记录查询
 * @author huyan
 * @date 2015-12-10
 */
$('#RecordQuery').on('click',function(){
  var page = '';
  var psize = '';
  var sign = 0; //查询标识
  InventoryRecordData(sign,page,psize);
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
  InventoryRecordData(sign,page,psize);
});