$(function(){
	$.post('index.php?r=khgl/getNamNumber',function(data){
	    listData(data);
	},'json');
});

function listData(data){
	$('.gonghao').remove();//工号
	$('#addJobNum').removeAttr("disabled");
	var yonghu = parent.document.getElementById('sxyh').value;
	var aaa= []; //定义一数组
	aaa=yonghu.split(","); //字符分割 
	var len = aaa.length;

	$('#FollowRecord').empty();
	$('.page').empty();
	if(data.result == 'success'){
		if(!data){
			return;
		}
		if(data.res != 'error'){
			$('#ghTable').empty();
			var length = data.list.length;
			$('#pagehidden').attr({ page: data.page, psize: data.psize });
			for(var i = 0; i < length; i++){
				var a = i+1;
				var listInfo = '';
				listInfo = '<tr>';
				if (yonghu.indexOf(data.list[i]['username'])!=-1){
					listInfo += '<td style="width:10;"><input type="checkbox" checked ordernomx="'+data.list[i]['username']+'" value="'+ data.list[i]['username'] +'" class="checkbox"/>'+a+'</td>'
				}else{
					listInfo += '<td style="width:10;"><input type="checkbox" ordernomx="'+data.list[i]['username']+'"value="'+ data.list[i]['username'] +'" class="checkbox"/>'+a+'</td>'  
				}
				listInfo +='<td><span>'+ data.list[i]['username'] +'</span></td>'
							+ '<td><span>'+ data.list[i]['personname'] +'</span></td>'
							+ '</tr>';

				$('#ghTable').append(listInfo);
			}
			$('.page').append(data.pageHtml);
		}
	}
}

function selectGH(){
	var dept = $("#dept").val();
	var gh = $("#gh").val();
	$.post('index.php?r=khgl/getNamNumber',{dept:dept,gh:gh},function(data){
	    listData(data);
	},'json');
}

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
})

    //点击确定获取选中数据
    $('body').on('click','#SelectUser',function(){
        var orderno = [];
        $('.checkbox:checked').each(function(index,item){
            orderno.push($(item).attr('ordernomx'));  
        });
        for(var i=0;i<orderno.length;i++){
            orderno[i] = orderno[i]
        }
        parent.document.getElementById('sxyh').value = orderno;
       	parentDialog.close();
    });