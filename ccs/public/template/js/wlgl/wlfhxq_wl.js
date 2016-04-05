$(function(){
    var ordernum = $('#ordernum').val(); //订单序号
    var orderno = $('#orderno').text();  //订单编号
    var clientno = $('#clientno').val(); //客户编号
    var hpage = $('#historyPages').attr('page'); //历史页码
    var hpsize = $('#historyPages').attr('psize'); //历史显示条数
	//获取订单的商品信息
    $.post('index.php?r=ddgl/GetOrderDetailGoodsMsg',{orderno:orderno},function(data){
        if(!data){
            return;
        }
        if(data.res != 'error'){
            var goodsTotalNum = data[0]['xsaa42'];
            var goodsTotalPrice = data[0]['xsaa19'];
            var goodsTotalOriginalPrice = data[0]['xsaa17'];
            var length = data.length;
            for(var i = 0; i < length; i++){
                if(!data[i]['cpae03']){
                    data[i]['cpae03'] = 0;
                }
                if(!data[i]['cpae06']){
                    data[i]['cpae06'] = '';
                }
                var listInfo = '';
                listInfo = '<tr>';
                if(data[i]['xsaa49'] == ''){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'</span></td>' 
                }
                if(data[i]['xsaa49'] == '退' && data[i]['xsab20'] == '未'){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'<font style="color:#f00;">['+ data[i]['xsaa49'] +']</font><font style="color:#f00;">['+ data[i]['xsab20'] +']</font></span></td>' 
                }
                if(data[i]['xsaa49'] == '退' && data[i]['xsab20'] == '已'){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'<font style="color:#f00;">['+ data[i]['xsaa49'] +']</font><font style="color:#00C78C;">['+ data[i]['xsab20'] +']</font></span></td>'  
                }
                if(data[i]['xsaa49'] == '退' && data[i]['xsab20'] == '终'){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'<font style="color:#f00;">['+ data[i]['xsaa49'] +']</font><font style="color:#00f;">['+ data[i]['xsab20'] +']</font></span></td>' 
                }
                if(data[i]['xsaa49'] == '换' && data[i]['xsab20'] == '未'){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'<font style="color:#00f;">['+ data[i]['xsaa49'] +']</font><font style="color:#f00;">['+ data[i]['xsab20'] +']</font></span></td>' 
                }
                if(data[i]['xsaa49'] == '换' && data[i]['xsab20'] == '已'){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'<font style="color:#00f;">['+ data[i]['xsaa49'] +']</font><font style="color:#00C78C;">['+ data[i]['xsab20'] +']</font></span></td>'  
                }
                if(data[i]['xsaa49'] == '换' && data[i]['xsab20'] == '终'){
                    listInfo += '<td><span>'+ data[i]['xsab03'] +'<font style="color:#00f;">['+ data[i]['xsaa49'] +']</font><font style="color:#00f;">['+ data[i]['xsab20'] +']</font></span></td>' 
                }
                    listInfo += '<td><span style="color:blue;cursor:pointer;" class="goodDetails" goodid=" '+ data[i]['xsab03'] +' ">'+ data[i]['xsab02'] +'</span></td>'
                            + '<td><span>'+ data[i]['xsab06'] +'</span></td>'
                            + '<td><span>'+ data[i]['xsab05'] +'</span></td>'
                            + '<td><span>'+ parseInt(data[i]['xsab04']) +'</span></td>'
                            + '<td><span>'+ data[i]['cpae03'] +'</span></td>'
                            + '<td><span>'+ data[i]['cpae06'] +'</span></td>'
                            + '</tr>';
                $('#barcode').before(listInfo);
            }

        }
    });

    //单个订单发货
    $('#shipped').on('click',function(){
        var orderid = [orderno];
        if(orderid.length != 0){
            var ensure = confirm('真的确认发货吗？');
            if(ensure){
                $.post('index.php?r=wlgl/ConfirmShipped',{orderno :orderid},function(data){
                    if(!data){
                        return;
                    }
                    if(data){
                        if(data.res == 'success'){
                            alert(data.msg);
                            window.location.href="index.php?r=wlgl/GetWlfhHtml&page="+hpage+"&psize="+hpsize;
                            return;
                        }
                        if(data.res == 'error'){
                            alert(data.msg);
                            return;
                        }
                    }
                },'json');
            }
        }
    });

    //跟进记录下拉特效
    $("#gjjl").click(function(){
        $(".gjjlxx").slideToggle("slow");
    });

    $.get('index.php?r=ddgl/GetOrderFollowRecording',{orderno:orderno},function(data){
            listData(data);
        },'json');

    //获取订单的跟进记录信息
    function listData(data){
    /*$.post('index.php?r=ddgl/GetOrderFollowRecording',{orderno:orderno},function(data){
        if(!data){
            return;
        }*/
        $('#tbody2').empty();
        $('.page').empty();
        if(data.result == 'success'){
            var length = data.list.length;
            $('#pagehidden').attr({ page: data.page, psize: data.psize });
            for(var i = 0; i < length; i++){
                var a = i+1;
                var listInfo = '';
                listInfo = '<tr>';
                listInfo += '<td><span>'+ a +'</span></td>'
                            + '<td><span>'+ data.list[i]['xsad07'] +'</span></td>'
                            + '<td><span>'+ data.list[i]['xsad08'] +'</span></td>'
                            + '<td><span>'+ data.list[i]['xsad04'] +'</span></td>'
                            + '<td><span>'+ data.list[i]['xsad06'] +'</span></td>'
                            + '<td><img src="public/img/del.png"  border="0" style="width:15%;cursor:pointer" title="删除该条记录" id="deleteFollow" followid="'+ data.list[i]['xsad10'] +'"/></td>'
                            + '</tr>';
                $('#tbody2').append(listInfo);
            }
            $('.page').append(data.pageHtml);
        }
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
    });

    //删除订单跟进记录
    /*$('body').on('click','.deleteFollow',function(){*/
    $('#tableFollow').on('click','#deleteFollow',function(){
        var followid = $(this).attr('followid');
        var ensure = confirm('你确定要删除这条订单记录吗？');
        if(ensure){
            $.post('index.php?r=ddgl/DeleteOrderFollowRecording',{followid :followid},function(data){
                if(!data){
                    return;
                }
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=wlgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
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

   var addToDoSign = 0;  //添加待办事项标识
    //设置待办事项
    $('#szdbsx').on('click',function(){
        var tick = $('#szdbsx:checked').length;
        if(tick){
            addToDoSign = tick;
            $('.dbsx').css('display','block');
        }else{      
            addToDoSign = tick;
            $('.dbsx').css('display','none');
        }
    });

    //添加待办事项
    $('body').on('click','#addToDo',function(){
        var content = $('#content').val();
        var dbsj = $('#dbsj').val();
        var gjr = $("option[name='khgsgh']:checked").val();
        var fz = $("option[name='khszz']:checked").val();
        if(!content){
            alert('内容不能为空');
            return;
        }
        if(addToDoSign){
            if(!dbsj){
                alert('待办时间不能为空');
                return;
            }
            $.post('index.php?r=ddgl/AddToDoThings',{clientno:clientno,orderno:orderno,dbsj:dbsj,gjr:gjr,fz:fz,content:content},function(data){
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=wlgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
                        return;
                    }
                    if(data.res == 'error'){
                        alert(data.msg);
                        return;
                    }
                }
            },'json');
        }else{
            $.post('index.php?r=ddgl/AddToDoThings',{orderno:orderno,content:content},function(data){
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=wlgl/OrderDetails&orderno="+orderno+'&ordernum='+ordernum;
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

    //点击撤回修改显示
    $('#tbody5').on('click','#showBackToUnconfirmed',function(){
        $('#showBackReason').css('display','table-row');
    });

    //撤回修改提交
    $('#backToUnconfirmed').on('click',function(){
        var backReason = $("input[name='backReason']:checked").val();
        var ensure = confirm('真的确认撤回这个订单给销售吗？');
        if(ensure){
            $.post('index.php?r=ddgl/OrderBackToUnConfirm',{orderno :orderno,backReason :backReason},function(data){
                if(!data){
                    alert('撤回失败，请操作！');
                }
                if(data){
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=wlgl/GetWlfhHtml";
                    }
                    if(data.res == 'error'){
                        alert(data.msg);
                        return;
                    }
                }
            },'json');
        }
    });

     //点击商品名称显示商品详情
    $('body').on('click','.goodDetails',function(){
        var $this = $(this);
        var goodId = $this.attr('goodid');
        $.post('index.php?r=cpgl/GetGoodList',{goodid: goodId},function(data){
            if(!data){
                return;
            }
            if(data){
                $('#spkh').text(data.cpaa01);
                $('#spgg').text(data.cpaa10);
                $('#spmc').text(data.cpaa02);
                $('#xsj').text(data.cpaa06);
                $('#sptp').attr("src",data.cpaa13);
                $('#xxms').text(data.cpaa12);
            }
        })
        $('#goodDetilDiv').show();
    });

    //点击关闭商品信息
    $('body').on('click','#closeDetail',function(){
        $('#goodDetilDiv').hide();
    }); 
});
