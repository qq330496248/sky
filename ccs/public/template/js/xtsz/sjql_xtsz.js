$(function(){
     //删除客户订单
    $('body').on('click','#DelCustomerOrder',function(){
        var searchtype = $("input[name='search']:checked").val();
        var xdsjq = $('#xdsjq').val();
        var xdsjz = $('#xdsjz').val();
        if (!xdsjq&&!xdsjz) {
            alert('请选择下单时间');return;
        };
        var ensure=confirm('确定要删除客户订单吗？');
        if(ensure){
		    $.post('index.php?r=ddgl/DelCustomerOrder',{searchtype:searchtype,xdsjq:xdsjq,xdsjz:xdsjz},function(data){
                if(!data){
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=xtsz/GetSjqlHtml";
                }
                if (data.res=='error') {
                    alert(data.msg);
                    return;
                };
            });
        }

	});

    //删除客户跟进记录
      $('body').on('click','#DelFollowRecord',function(){
        var gjsjq = $('#gjsjq').val();
        var gjsjz = $('#gjsjz').val();
        if (!gjsjq&&!gjsjz) {
            alert('请选择跟进时间');return;
        }
        var ensure=confirm('确定要删除客户跟进记录吗？');
        if(ensure){
            $.post('index.php?r=khgl/DelFollowRecord',{gjsjq:gjsjq,gjsjz:gjsjz},function(data){
                if(!data){
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=xtsz/GetSjqlHtml";
                }
                if (data.res=='error') {
                    alert(data.msg);
                    return;
                };
            });
        }
    });
    //删除订单跟进记录
    $('body').on('click','#DelOrderFollowRecords',function(){
        var ddsjq = $('#ddsjq').val();
        var ddsjz = $('#ddsjz').val();
        if (!ddsjq&&!ddsjz) {
            alert('请选择跟进时间');return;
        }
         var ensure=confirm('确定要删除订单跟进记录吗？');
        if(ensure){
            $.post('index.php?r=ddgl/DelOrderFollowRecords',{ddsjq:ddsjq,ddsjz:ddsjz},function(data){
                if(!data){
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=xtsz/GetSjqlHtml";
                }
                if (data.res=='error') {
                    alert(data.msg);
                    return;
                };
            });
        }
    });

    //数据资料转移
    $('body').on('click','#DataTransfer',function(){
        var khgh1 = $('#khgh1').val();
        var khgh2 = $('#khgh2').val();
        if (!khgh1) {
            alert('请输入工号1');return;
        }
        if (!khgh2) {
            alert('请输入工号2');return;
        }
         var ensure=confirm('确定要把工号1的数据转移到工号2吗？');
        if(ensure){
            $.post('index.php?r=khgl/DataTransfer',{khgh1:khgh1,khgh2:khgh2},function(data){
                if(!data){
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=xtsz/GetSjqlHtml";
                }
                if (data.res=='error') {
                    alert(data.msg);
                    return;
                };
            });
        }
    });

      //删除客户资料
    $('body').on('click','#DelCustomerClient',function(){
        var zcsjq = $('#zcsjq').val();
        var zcsjz = $('#zcsjz').val();
        var gjsjq = $('#scgjsjq').val();
        var gjsjz = $('#scgjsjz').val();
        var khdj =$("option[name='khdj']:checked").val();
        var kehuyx =$("option[name='kehuyx']:checked").val();
        var khgh = $('#khgh').val()
        if (!zcsjq&&!zcsjz&&!gjsjq&&!gjsjz&&!khdj&&!kehuyx&&!khgh) {
            alert('请至少选择一个删除条件');return;
        }
        var ensure=confirm('确定要删除客户资料吗？');
        if(ensure){
            $.post('index.php?r=khgl/DelCustomerClient',{zcsjq:zcsjq,zcsjz:zcsjz,gjsjq:gjsjq,gjsjz:gjsjz,khdj:khdj,kehuyx:kehuyx,khgh:khgh},function(data){
                if(!data){
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=xtsz/GetSjqlHtml";
                }
                if (data.res=='error') {
                    alert(data.msg);
                    return;
                };
            });
        }
    });

 //删除出入库记录
    $('body').on('click','#DelStorageRecords',function(){
        var jlsjq = $('#jlsjq').val();
        var jlsjz = $('#jlsjz').val();
        var crklx =$("option[name='crklx']:checked").val();

        if (!jlsjq&&!jlsjz&&!crklx) {
            alert('请至少选择一个删除条件');return;
        }
        var ensure=confirm('确定要删除出库或入库记录吗');
        if(ensure){
            $.post('index.php?r=cpgl/DelStorageRecords',{jlsjq:jlsjq,jlsjz:jlsjz,crklx:crklx},function(data){
                if(!data){
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=xtsz/GetSjqlHtml";
                }
                if (data.res=='error') {
                    alert(data.msg);
                    return;
                };
            });
        }
    });

     //删除通话记录
    $('body').on('click','#DelCallRecord',function(){
        var thsjq = $('#thsjq').val();
        var thsjz = $('#thsjz').val();
        if (!thsjq&&!thsjz) {
            alert('请至少选择一个删除条件');return;
        }
        var ensure=confirm('确定要删除通话记录吗');
        if(ensure){
            $.post('index.php?r=thgl/DelCallRecord',{thsjq:thsjq,thsjz:thsjz},function(data){
                if(!data){
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=xtsz/GetSjqlHtml";
                }
                if (data.res=='error') {
                    alert(data.msg);
                    return;
                };
            });
        }
    });
  //删除盘点记录
    $('body').on('click','#DelStockInventory',function(){
        var pdsjq = $('#pdsjq').val();
        var pdsjz = $('#pdsjz').val();
        if (!pdsjq&&!pdsjz) {
            alert('请至少选择一个删除条件');return;
        }
        var ensure=confirm('确定要删除盘点记录吗');
        if(ensure){
            $.post('index.php?r=wlgl/DelStockInventory',{pdsjq:pdsjq,pdsjz:pdsjz},function(data){
                if(!data){
                    return;
                }
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=xtsz/GetSjqlHtml";
                }
                if (data.res=='error') {
                    alert(data.msg);
                    return;
                };
            });
        }
    });

})

	

	