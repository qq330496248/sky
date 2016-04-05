$(function(){
	//点击显示商品信息
    $('body').on('focus','.goodName',function(){  
        //$('body').unbind("click"); 
        $.post('index.php?r=cpgl/GetAllGoodList',function(data){
            listData(data);
        },'json');
        $(this).next('.goodList').css('display','block');
        /*$('body').delay(10000).one('click',function(){
            alert(1111);
            $('.goodList').css('display','none');
        });*/
    });

    //输入商品名称进行模糊搜索
    $('body').on('keyup','.goodName',function(){  
        var goodName = $(this).val();
        $.post('index.php?r=cpgl/GetAllGoodList',{goodName:goodName},function(data){
            listData(data);
        },'json');
        $(this).next('.goodList').css('display','block');  
    });

    //点击关闭商品信息
    $('body').on('click','.closeGoodList',function(){
        $('.goodList').css('display','none');
    });

    /**
     * @desc 商品信息获取数据插入节点
     * @author WuJunhua
     * @date 2016-01-22
     */
     function listData(data){
        if(data != 'error'){
            $('.oneGoodLine').remove();
            var length = data.length;
            for(var i = 0; i < length; i++){
                var listInfo = '';
                listInfo = '<tr class="oneGoodLine">';
                listInfo += '<td style="cursor:pointer;" class="goodNumber" goodid="'+ data[i].cpaa01 +'"><span><font style="color:#0000ff;">'+data[i].cpaa01+'</font>:'+ data[i].cpaa02 +'</span></td>'
                            +'</tr>';
                $('.table5').append(listInfo); 
            }
        }
    }

    //点击选中商品并在页面上显示对应的信息
    $('body').on('click','.goodNumber',function(){
        var $this = $(this);
        var goodId = $this.attr('goodid');
        $.post('index.php?r=cpgl/GetGoodList',{goodid: goodId},function(data){
            if(!data){
                return;
            }
            if(data){
                if(data.cpae03 > 0){
                    var ensure = confirm('款号 '+ data.cpaa01 +' 的商品库存为'+ data.cpae03 +'，是否继续下单？');
                    if(!ensure){
                        return;
                    }
                }
                $this.parent().parent().parent().parent().parent().siblings().find('.styleNum').val(data.cpaa01);
                $this.parent().parent().parent().parent().siblings('.goodName').val(data.cpaa02);
                if(!data.cpae06 || data.cpae06 != undefined){
                    $this.parent().parent().parent().parent().parent().siblings().find('.location').val(data.cpae06);
                }
                if(!data.cpae18 || data.cpae18 != undefined ){
                    $this.parent().parent().parent().parent().parent().siblings().find('.attributes').text(data.cpae18);
                }
                $('.goodList').css('display','none');
            }
        },'json');
    });

    /**
     * @desc 添加和删除商品行的特效
     * @author WuJunhua
     * @date 2015-11-12
     */
     //添加商品行
    $('body').on('click','#addGoodsLine',function(){
        $('#tbody1').append('<tr style="height:30px;line-height:30px;" class="goodline"><td><img src="public/img/del.png" title="删除该行" border="0" style="width:17%;cursor:pointer" class="delgoodline"/></td><td><input name="goodNumber" type="text" class="dfinput styleNum" style="width:70px" value=""/></td><td><input name="goodNumber" type="text" class="dfinput goodName" style="width:200px" value=""/><div class="goodList" style="display:none;background-color:#D3D3D3;position:absolute;overflow:auto;width:260px;height:342px;"><table style="width:260px;" class="table5"><tr><td class="closeGoodList" style="cursor:pointer;">关闭</td></tr></table></div></td><td><input name="goodNumber" type="text" class="dfinput productionDate" style="width:140px" value="" onClick="WdatePicker()"/></td><td><input name="goodNumber" type="text" class="dfinput maturityDate" style="width:140px" value="" onClick="WdatePicker()"/></td><td><input name="goodNumber" type="text" class="dfinput productStorage" style="width:70px" value="" /></td><td><input name="goodNumber" type="text" class="dfinput defectiveStorage" style="width:70px" value="" /></td><td><input name="goodNumber" type="text" class="dfinput price" style="width:70px" value="" /></td><td><input name="goodNumber" type="text" class="dfinput location" style="width:100px" value="" /><div class="localList" style="display:none;background-color:#D3D3D3;position:absolute;overflow:auto;width:220px;height:342px;"><table style="width:220px;" class="table8"><tr><td class="closeLocalList" style="cursor:pointer;">关闭</td></tr></table></div></td><td><span class="attributes"></span></td></tr>');
    });
    //删除商品行
    $('#tbody1').on('click','.delgoodline',function(){
        $(this).parent().parent().remove();
    });

	//产品直接入库(添加产品)
	$('#addGood').on('click',function(){
        $('#tips').text('');
		var goodItems = [];
        //获取单个或多个产品信息
        $('.goodline').find('input[name="goodNumber"]').each(function(index,item){
            goodItems.push($(item).val());   
        }); 
        var styleNum = [];
        //获取单个或多个产品款号  
        $('.goodline').find('.styleNum').each(function(index,item){
            styleNum.push($(item).val());   
        }); 
        var supplier = $("option[name='gys']:checked").val();//供应商
        if(supplier == ''){
            $('#tips').text('供应商不能为空');
            return;
        }

        //对商品数量和商品价格进行正则验证
        var verification = false;
        $('.productStorage').each(function(index,item){
            if (!regNumber.test($(item).val())) {
                $('#tips').empty();
                verification = true;
                $('#tips').append('<font style="color:#f00;">正品入库数、次品入库数和进货单价只能是数字且最多是两位小数</font>');
                return;
            }
        });
        $('.defectiveStorage').each(function(index,item){
            if (!regMoney.test($(item).val())) {
                $('#tips').empty();
                verification = true;
                $('#tips').append('<font style="color:#f00;">正品入库数、次品入库数和进货单价只能是数字且最多是两位小数</font>');
                return;
            }
        });

        $('.price').each(function(index,item){
            if (!regMoney.test($(item).val())) {
                $('#tips').empty();
                verification = true;
                $('#tips').append('<font style="color:#f00;">正品入库数、次品入库数和进货单价只能是数字且最多是两位小数</font>');
                return;
            }
        });



        //正则验证不通过，则终止往下执行
        if(verification == true){
            return;
        }

        var fare = $('#fare').val();//运费
        var remark = $('#remark').val();//备注
        var ensure = confirm("确定要直接入库吗？");
        if(ensure){
            $.post('index.php?r=cpgl/ProductDirectStorage',{goodItems:goodItems,supplier:supplier,fare:fare,remark:remark,styleNum:styleNum},function(data){
            	if(!data){
                    alert('产品入库失败');
                    return;
                }
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=wlgl/GetCpzjrkHtml";
                        return;
                    }
                    if(data.res == 'error'){
                        alert(data.msg);
                        return;
                    }
                    if(data.res == 'tips'){
                        $('#tips').text(data.msg);
                        return;
                    }
                }
            },'json');
        }
	});

    //点击显示库位信息
    $('body').on('focus','.location',function(){  
        $.post('index.php?r=xtsz/GetTenWarehouseData',function(data){
            locationData(data);
        },'json');
        $(this).next('.localList').css('display','block');
    });

    //输入库位进行模糊搜索
    $('body').on('keyup','.location',function(){  
        var location = $(this).val();
        $.post('index.php?r=xtsz/GetTenWarehouseData',{location:location},function(data){
            locationData(data);
        },'json');
        $(this).next('.localList').css('display','block');
    });

    //点击关闭库位信息
    $('body').on('click','.closeLocalList',function(){
        $('.localList').css('display','none');
    });

    /**
     * @desc 库位信息获取数据插入节点
     * @author WuJunhua
     * @date 2016-01-22
     */
     function locationData(data){
        if(data){
            if(data != 'error'){
                $('.oneLocation').remove();
                if(data.list != undefined){
                    var length = data.list.length;
                    for(var i = 0; i < length; i++){
                        var listInfo = '';
                        listInfo = '<tr class="oneLocation">';
                        listInfo += '<td style="cursor:pointer;" class="local" localcationId="'+ data.list[i]['id'] +'"><span>'+ data.list[i]['place'] +'</span></td>'
                                    +'</tr>';
                        $('.table8').append(listInfo); 
                    }
                }
            }
        }
    }

    //点击选中库位并在页面上显示对应的信息
    $('body').on('click','.local',function(){
        var $this = $(this);
        var localcationId = $this.attr('localcationId');
        $.post('index.php?r=xtsz/GetSingleWarehouse',{id: localcationId},function(data){
            if(!data){
                return;
            }
            if(data){
                $this.parent().parent().parent().parent().parent().find('.location').val(data.place);
                $('.localList').css('display','none');
            }
        },'json');
    });
    

});