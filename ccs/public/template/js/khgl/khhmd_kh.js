$(function(){
	/**
	 * @desc 加载视图后，显示数据
	 * @author huyan
	 * @date 2015-12-07
	 */
	$.post('index.php?r=khgl/getCustomerBlacklist',function(data){
		listData(data);
	},'json')
})

/**
 * @desc 黑名单列表获取数据插入节点
 * @author huyan
 * @date 2015-12-07
 */
function listData(data){
	$('#dhhmdTable').empty();
	$('.page').empty();
	if(data.result == 'success'){
		var length = data.list.length;
		$('#pagehidden').attr({ page: data.page, psize: data.psize });
		for(var i = 0; i < length; i+=2){
			var listInfo = '';
			var a = i+1;
			listInfo = '<tr class="singular">';
			listInfo += '<td>'+a+'&nbsp;&nbsp;</td>'
			listInfo += '<td><span>'+ data.list[i]['khai03'] +'</span></td>'
			        + '<td><img id="EditBlackList" src="public/img/reservin.png" title="编辑" border="0" style="width:3%;cursor:pointer" orderedit="'+ data.list[i]['khai02'] +'"/><img id="Shipped" src="public/img/del.png" title="点击删除"  border="0" style="width:3%;cursor:pointer" orderno="'+ data.list[i]['khai02'] +'"/></td>'
                        + '</tr>';
            if(i != length - 1){
                listInfo += '<tr class="complex">'
                +'<td>'+(a+1)+'</td>'
                +'<td><span>'+ data.list[i+1]['khai03'] +'</span></td>'
                    + '<td><img id="EditBlackList" src="public/img/reservin.png" title="编辑" border="0" style="width:3%;cursor:pointer" orderedit="'+ data.list[i+1]['khai02'] +'"/><img id="Shipped" src="public/img/del.png" title="点击删除"  border="0" style="width:3%;cursor:pointer" orderno="'+ data.list[i+1]['khai02'] +'"/></td>'
                        + '</tr>';
            }
			$('#dhhmdTable').append(listInfo);
		}
		$('.page').append(data.pageHtml);
	}
}

 /**
     * @desc 修改黑名单
     * @author huyan
     * @date 2015-12-07
     */
 $('#editBlacklist').on('click',function(){
        
        var khphone=$('#phone').val();//电话
        var orderid = $(this).attr('orderedit');
        if (!khphone) {
            alert('请输入手机号');
            return;
        }
        if (khphone='请输入手机号') {
             alert('请输入手机号');
            return;
        }
        var reg=/^0?1[3|4|5|8][0-9]\d{8}$/;
        if (!reg.test(khphone)) {
            alert('号码有误,请重新输入');
            return;
        }
        $.post('index.php?r=khgl/ModifyEditBlackList',{khphone:khphone,},function(data){
            if(!data){
                alert('修改失败');
                return;
            }
            if(data.res == 'error'){
                alert(data.msg);
                return;
            }
            if(data.res == 'success'){
                alert(data.msg);
                window.location.href="index.php?r=khgl/GetkhhmdHtml&khhmd.html";
            }
        },"json");

    });

$('#phone').on('click',function(){
    //document.getElementById("phone").value="";
    var kong=$('#phone').val();//手机号
    if (kong='请输入手机号') {
        document.getElementById('phone').style.color="#9D9D9D"; 
    }
    if (kong){
        document.getElementById('phone').style.color="#000000"; 
    }
    
});

/**
* @desc 删除黑名单
* @author huyan
* @date 2015-12-07
*/
  $('#table4').on('click','#Shipped',function(){
    var orderid = $(this).attr('orderno');

    if(orderid){
        var ensure = confirm('确定要删除吗？');
            if(ensure){
                $.post('index.php?r=khgl/DeleteCustomerBlack',{orderno:orderid},function(data){
                    if(!data){
                         alert('删除失败，请重新操作！');
                    }
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=khgl/GetkhhmdHtml&khhmd.html";
                    }else{
                        alert(data.msg);
                        return;
                    }
                })
            }
        }
    });

/**
	 * @desc 点击编辑获取黑名单电话
	 * @author huyan
	 * @date 2015-12-07
	 */
    $('#table4').on('click','#EditBlackList',function(){
        var orderid = $(this).attr('orderedit');
        $.post('index.php?r=khgl/getEditBlackList',{orderedit:orderid},function(data){
            if(data){
                var phone =data.khai03;
    	        $('#phone').val(phone);
                $('edit').css('display','block');
                $('#AddBlacklist').css('display','none');
                $('#editBlacklist').css('display','block');
                $('#QueryBlackList').css('display','none');
            }
        });
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
     * @des 查询黑名单
     * @author huyan
     * @date 2016-02-19
     */
    $('#QueryBlackList').on('click',function(){
        var phone = $('#phone').val();
        if (!phone) {
            alert('请输入手机号');
        }
        $.post('index.php?r=khgl/getCustomerBlacklist',{phone:phone},function(data){
            if(!data){
                return;
            }
            listData(data);
        });
    });

