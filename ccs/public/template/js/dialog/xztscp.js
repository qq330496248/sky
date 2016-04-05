$(function(){
	  $.post('index.php?r=cpgl/GettsAllGood',function(data){
            listData(data);
        },'json');
        $(this).next('.goodList').css('display','block');
});

function listData(data){
	$('.gonghao').remove();//工号
	$('#addJobNum').removeAttr("disabled");
	$('#ghTable').empty();
	$('.page').empty();
	if(data.result == 'success'){
        var length = data.list.length;
        for(var i = 0; i < length; i++){
            var a = i+1;
            var listInfo = '';
            listInfo = '<tr>';
            listInfo += '<td style="width:10;"><input name="radioname" type="radio" value="'+ data.list[i]['cpaa02']+'" />'+a+'</td>' 
                +'<td><span>'+ data.list[i]['cpaa01'] +'</span></td>'
                + '<td><span>'+ data.list[i]['cpaa02'] +'</span></td>'
                + '</tr>';
				$('#ghTable').append(listInfo);
			}
			$('.page').append(data.pageHtml);
		}
    }

function selectGH(){
	var cpkh = $("#cpkh").val();
    var cpmc = $("#cpmc").val();
	$.post('index.php?r=cpgl/GettsAllGood',{cpkh:cpkh,cpmc:cpmc},function(data){
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
         var orderno = $('input[name="radioname"]:checked').val();
        if (!orderno) {
            alert('请选择退货的采购单号');return;
        }
        parent.document.getElementById('tscp').value = orderno;
       	parentDialog.close();
    });