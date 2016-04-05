$(function(){
    /**
     * @desc 商品信息获取数据插入节点
     * @author WuJunhua
     * @date 2016-02-23
     */
    function listData(data){
        if(data != 'error'){
            $('.oneGoodLine').remove();
            var length = data.length;
            for(var i = 0; i < length; i++){
                var listInfo = '';
                listInfo = '<tr class="oneGoodLine">';
                listInfo += '<td class="goodNumber" goodid="'+ data[i].cpae02 +'" batchid="'+ data[i].cpae01 +'"><span style="cursor:pointer;">'+ data[i].cpae01 +'：'+ data[i].cpaa02 +'</span></td>'
                            +'</tr>';
                $('.table5').append(listInfo); 
            }
        }
    }

	//点击显示商品信息
    $('body').on('focus','.goodName',function(){  
        $.post('index.php?r=wlgl/GetInventoryCheckList',function(data){
            listData(data);
        },'json');
        $(this).next('.goodList').css('display','block');
    });

    //输入商品名称进行模糊搜索
    $('body').on('keyup','.goodName',function(){  
        var goodName = $(this).val();
        $.post('index.php?r=wlgl/GetInventoryCheckList',{goodName:goodName},function(data){
            listData(data);
        },'json');
        $(this).next('.goodList').css('display','block');  
    });

    //点击关闭商品信息
    $('body').on('click','.closeGoodList',function(){
        $('.goodList').css('display','none');
    });

    //点击选中商品并在页面上显示对应的信息
    $('body').on('click','.goodNumber',function(){
        var $this = $(this);
        var goodId = $this.attr('goodid');
        var batchId = $this.attr('batchid');
        $.post('index.php?r=wlgl/GetGoodById',{goodid: goodId,batchid: batchId},function(data){
            if(!data){
                return;
            }
            if(data){
                $this.parent().parent().parent().parent().parent().siblings().find('.batch').val(data.cpae01);
                $this.parent().parent().parent().parent().parent().siblings().find('.styleNum').val(data.cpae02);
                $this.parent().parent().parent().parent().siblings('.goodName').val(data.cpaa02);
                $('.goodList').css('display','none');
            }
        },'json');
    });

    /**
     * @desc 添加商品行的特效
     * @author WuJunhua
     * @date 2015-12-02
     */
     //添加商品行
    $('body').on('click','#addGoodsLine',function(){
        $('#tbody1').append('<tr style="height:30px;line-height:30px;" class="goodline"><td><input name="" type="text" class="dfinput batch" style="width:100px" value="" /></td><td><input name="" type="text" class="dfinput styleNum" style="width:70px" value="" /></td><td><input name="" type="text" class="dfinput goodName" style="width:200px" value="" /><div class="goodList" style="display:none;background-color:#D3D3D3;position:absolute;overflow:auto;width:240px;height:342px;"><table style="width:240px;" class="table5"><tr><td class="closeGoodList" style="cursor:pointer;">关闭</td></tr></table></div></td><td><input name="" type="text" class="dfinput inventoryNum" style="width:50px" value="" /></td><td></td></tr>');
    });

	//录入盘点数量
	$('body').on('click','#addGood',function(){
        $('#tips').empty();
        var goodName = $('.goodName').val();
        var inventoryNum = $('.inventoryNum').val();
        if(!goodName){
            $('#tips').append('<font style="color:#f00;">产品名不能为空</font>');
            return;
        }
        if(!inventoryNum){
            $('#tips').append('<font style="color:#f00;">库存量不能为空</font>');
            return;
        }
		var goodItems = [];
        //获取单个或多个产品信息  
        $('.goodline').find('input[type="text"]').each(function(index,item){
            goodItems.push($(item).val());   
        }); 
        $.post('index.php?r=wlgl/EntryCountQuantity',{goodItems:goodItems},function(data){
            if(data){
                if(data.res == 'tips'){
                    $('#tips').append('<font style="color:#f00;">'+data.msg+'</font>');
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
            }
        });
	});
    

})