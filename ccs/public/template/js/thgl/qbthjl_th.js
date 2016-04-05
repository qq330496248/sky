$(function(){
	/**
	 * @desc 加载视图后，显示数据
	 * @author WuJunhua
	 * @date 2016-01-28
	 */
    /*$.post('index.php?r=thgl/GetClientInfoByNumber',function(data){
    	listData(data);
    });*/
})

/**
 * @desc 全部通话记录列表获取数据插入节点
 * @author WuJunhua
 * @date 2016-01-28
 */
function listData(data){
	$('#getCheckeboxId').empty();
	$('.page').empty();
	if(data.result == 'success'){
		var length = data.list.length;
		$('#pagehidden').attr({ page: data.page, psize: data.psize });
		var nowTime = '1980-01-01 10:00:00';
		for(var i = 0; i < length; i+=2){
			var username = (data.list[i]['username'] == null) ? '' : data.list[i]['username'];
			var personname = (data.list[i]['personname'] == null) ? '' : data.list[i]['personname'];
			var khaa02 = (data.list[i]['khaa02'] == null) ? '' : data.list[i]['khaa02'];
			var khaa03 = (data.list[i]['khaa03'] == null) ? '' : data.list[i]['khaa03'];
			var khaa32 = (data.list[i]['khaa32'] == null) ? '' : data.list[i]['khaa32'];
			var khaa12 = (data.list[i]['khaa12'] == null) ? '' : data.list[i]['khaa12'];
			var khaa22 = (data.list[i]['khaa22'] == null) ? '' : data.list[i]['khaa22'];
			if(data.list[i]['thaa09'] == 'ANSWERED'){
				data.list[i]['thaa09'] = '接听';
			}
			if(data.list[i]['thaa09'] == 'NO ANSWER'){
				data.list[i]['thaa09'] = '未接听';
			}
			if(data.list[i]['thaa09'] == 'FAILED'){
				data.list[i]['thaa09'] = '失败';
			}
			if(data.list[i]['thaa09'] == 'BUSY'){
				data.list[i]['thaa09'] = '忙线';
			}

			var listInfo = '';
			var a = i+1;
			listInfo = '<tr class="singular">';
			listInfo += '<td><span>'+ a +'</span></td>'
						+ '<td><span>'+ data.list[i]['thaa02'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['thaa03'] +'</span></td>'
						+ '<td><span>'+ username +'</span></td>'
						+ '<td><span>'+ personname +'</span></td>'
			            + '<td><a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+khaa02 +'">'+ khaa02 +'</a></td>'
						+ '<td><span>'+ khaa03 +'</span></td>'
						+ '<td><span>'+ khaa32 +'</span></td>'
						+ '<td><span>'+ khaa12 +'</span></td>'
						+ '<td><span>'+ khaa22 +'</span></td>'
						+ '<td><span>'+ data.list[i]['thaa09'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['thaa06'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['thaa05'] +'</span></td>';
			if(i != length - 1){
				if(data.list[i+1]['thaa09'] == 'ANSWERED'){
					data.list[i+1]['thaa09'] = '接听';
				}
				if(data.list[i+1]['thaa09'] == 'NO ANSWER'){
					data.list[i+1]['thaa09'] = '未接听';
				}
				if(data.list[i+1]['thaa09'] == 'FAILED'){
					data.list[i+1]['thaa09'] = '失败';
				}
				if(data.list[i+1]['thaa09'] == 'BUSY'){
					data.list[i+1]['thaa09'] = '忙线';
				}
					listInfo += '<tr class="complex">'
						+ '<td><span>'+(a+1)+'</span></td>'
						+ '<td><span>'+ data.list[i+1]['thaa02'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['thaa03'] +'</span></td>'
						+ '<td><span>'+ username +'</span></td>'
						+ '<td><span>'+ personname +'</span></td>'
			            + '<td><a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+khaa02 +'">'+ khaa02 +'</a></td>'
						+ '<td><span>'+ khaa03 +'</span></td>'
						+ '<td><span>'+ khaa32 +'</span></td>'
						+ '<td><span>'+ khaa12 +'</span></td>'
						+ '<td><span>'+ khaa22 +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['thaa09'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['thaa06'] +'</span></td>'
						+ '<td><span>'+ data.list[i+1]['thaa05'] +'</span></td>';
			}
			$('#getCheckeboxId').append(listInfo);

		}
		$('.page').append(data.pageHtml);
	}else{
        var listInfo = '<tr><td colspan="13" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }
}

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2016-01-28
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

//通话记录查询
$('#AllCallRecords').on('click',function(){
   var khzcsjq = $('#khzcsjq').val();//时间前
   var khzcsjz = $('#khzcsjz').val();//时间至
   var thgh = $('#thgh').val();//工号
   var thfj = $('#thfj').val();///分机

   var khid = $('#khid').val();///客户id
   var zjhm = $('#zjhm').val();//主叫号码
   var bjhm = $('#bjhm').val();///被叫号码
   var khly = $("option[name='khly']:checked").val();//客户来源

   $.ajax({
        type: "get",
        url: "index.php?r=thgl/GetClientInfoByNumber",
        async: true,
        data: {khzcsjq:khzcsjq,khzcsjz:khzcsjz,thgh:thgh,thfj:thfj,khid:khid,zjhm:zjhm,bjhm:bjhm,khly:khly},
        success: function(data){
            if(!data){
                return;
            }
            listData(data);
        }
    });
});

//获取10.230服务器上的通话记录
$('#getCallRecords').on('click',function(){
   $.post('index.php?r=thgl/GetCallingRecords',function(data){
        if(data){
        	if(data.res == 'success'){
        		alert(data.msg);
        		window.location.href="index.php?r=thgl/GetQbthjlHtml";
        		return;
        	}
        	if(data.res == 'error'){
        		alert(data.msg);
        	}
        }
    });
});