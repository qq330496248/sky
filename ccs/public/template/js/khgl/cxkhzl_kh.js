$(function(){
    //查询客户资料
    $('body').on('click','#searchClient',function(){
        var searchtype = $("input[name='search']:checked").val();
        var keyword = $('#keyword').val();
        if(!$.trim(keyword)){
            alert('查询条件不能为空！');
            return;
        }
		$.get('index.php?r=khgl/SearchClientData',{searchtype :searchtype,keyword :keyword},function(data){
            if(!data){
                return;
            }
            listData(data);
        });

	});
});

/**
 * @desc 查询我的客户列表获取数据插入节点
 * @author WuJunhua
 * @date 2015-11-01
 */
function listData(data){
    $('#getCheckeboxId').empty();
    $('.page').empty();
    if(data.result == 'success'){
        var length = data.list.length;
        $('#pagehidden').attr({ page: data.page, psize: data.psize });
        var nowTime = '1940-01-01 10:00:00';
        for(var i = 0; i < length; i+=2){
            if(data.list[i]['khaa18'] < nowTime){
                data.list[i]['khaa18'] = '';
            }
            if(data.list[i]['khaa19'] < nowTime){
                data.list[i]['khaa19'] = '';
            }
            if(data.list[i]['khaa20'] < nowTime){
                data.list[i]['khaa20'] = '';
            }
            var listInfo = '';
            var a = i+1;
            listInfo = '<tr class="singular">';
            listInfo += '<td style="width:10;">'+a+'</td>'
            listInfo += '<td><a class="canJumpPage" href="index.php?r=ddgl/GetTjddHtml&clientno='+ data.list[i]['khaa02'] +'&ordernum='+data.list[i]['khaa01']+'&sign=1">订&nbsp;&nbsp;<a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i]['khaa02']+'&ordernum='+data.list[i]['khaa01']+'&sign=2">'+ data.list[i]['khaa02'] +'</a></td>'
                        + '<td><span>'+ data.list[i]['khaa03'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khaa04'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khaa23'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khaa38'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khaa30'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khaa18'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khaa19'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khaa20'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khaa28'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khaa25'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khaa22'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khaa12'] +'</span></td>'
                        + '<td><span>'+ data.list[i]['khaa32'] +':'+data.list[i]['khaa33']+'</span></td>'
                        + '</tr>';
            if(i != length - 1){
                if(data.list[i+1]['khaa18'] < nowTime){
                    data.list[i+1]['khaa18'] = '';
                }
                if(data.list[i+1]['khaa19'] < nowTime){
                    data.list[i+1]['khaa19'] = '';
                }
                if(data.list[i+1]['khaa20'] < nowTime){
                    data.list[i+1]['khaa20'] = '';
                }
                listInfo += '<tr class="complex">'
                        +'<td style="width:10;">'+(a+1)+'</td>'
                        + '<td><a class="canJumpPage" href="index.php?r=ddgl/GetTjddHtml&clientno='+ data.list[i+1]['khaa02'] +'&ordernum='+data.list[i+1]['khaa01']+'&sign=1">订&nbsp;&nbsp;<a class="canJumpPage" href="index.php?r=khgl/NewClientData&clientno='+data.list[i+1]['khaa02']+'&ordernum='+data.list[i+1]['khaa01']+'&sign=2">'+ data.list[i+1]['khaa02'] +'</a></td>'
                        + '<td><span>'+ data.list[i+1]['khaa03'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['khaa04'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['khaa23'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['khaa38'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['khaa30'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['khaa18'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['khaa19'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['khaa20'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['khaa28'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['khaa25'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['khaa22'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['khaa12'] +'</span></td>'
                        + '<td><span>'+ data.list[i+1]['khaa32'] +':'+data.list[i+1]['khaa33']+'</span></td>';
                        + '</tr>';
            }           
            $('#getCheckeboxId').append(listInfo);
        }
        $('.page').append(data.pageHtml);
    }else{
        var listInfo = '<tr><td colspan="15" style="color:#0000ff;">暂时没有记录！</td></tr>';
        $('#getCheckeboxId').append(listInfo);
    }
}


/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2015-11-01
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


function changeStr(str){}