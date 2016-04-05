$(function(){
	/**
	 * @desc 加载视图后，显示数据
	 * @author WuJunhua
	 * @date 2016-01-08
	 */
	$.post('index.php?r=whgl/GetQuestionnaireList',function(data){
		listData(data);
	},'json');

	
	
});	


/**
 * @desc 问卷列表获取数据插入节点
 * @author WuJunhua
 * @date 2016-01-08
 */
function listData(data){
	if(data.result == 'success'){
		$('#getCheckeboxId').empty();
		$('.page').empty();
		var length = data.list.length;
		for(var i = 0; i < length; i++){
			var a = i + 1;
			var listInfo = '';
			listInfo = '<tr>';
			listInfo += '<td><span>'+ a +'</span></td>'
						+ '<td><a class="canJumpPage" href="javascript:;">'+ data.list[i]['whaa02'] +'</a></td>'
						+ '<td><span>'+ data.list[i]['whaa04'] +'</span></td>'
						+ '<td><span>'+ data.list[i]['whaa06'] +'('+ data.list[i]['whaa07'] +')</span></td>'
						+ '<td><span>'+ data.list[i]['whaa05'] +'</span></td>'
						+ '<td><span><input style="width:50px;" name="" type="button" class="btn" value="管理" bookId="'+ data.list[i]['whaa01'] +'"/><input style="width:50px;" name="" type="button" class="btn" value="预览" bookId="'+ data.list[i]['whaa01'] +'"/><a href="index.php?r=whgl/GetBookDetails&bookId='+ data.list[i]['whaa01'] +'"><img src="public/img/reservin.png" title="编辑" border="0" style="width:2%;cursor:pointer" bookId="'+ data.list[i]['whaa01'] +'"/></a><img src="public/img/del.png" title="点击删除" border="0" style="width:2%;cursor:pointer" class="deleteBook" bookId="'+ data.list[i]['whaa01'] +'"/></span></td>'
						+ '</tr>';
			$('#getCheckeboxId').append(listInfo);
		}
		$('.page').append(data.pageHtml);
	}
}

/**
 * @desc 点击分页后加载数据
 * @author WuJunhua
 * @date 2016-01-06
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

//删除问卷
$('body').on('click','.deleteBook',function(){
	var bookId = $(this).attr('bookId');
	var ensure = confirm('你确定要删除这个问卷吗？');
	if(ensure){
		$.post('index.php?r=whgl/DeleteBookData',{bookId :bookId},function(data){
			if(!data){
				return;
			}
            if(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=whgl/GetWjlbHtml";
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
            }
		},'json');
	}
});
