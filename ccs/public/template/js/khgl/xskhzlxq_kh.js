$(function(){
	 //跟进记录下拉特效
    $("#gjjl").click(function(){
        $(".gjjlxx").slideToggle("slow");
    });
	var clientno = $('#clientno').val();
	//编辑客户资料
	$('#save').on('click',function(){
		var khgsgh= $("option[name='khgsgh']:checked").val(); //归属工号  
		var khname = $('#khname').val();//客户姓名
	    var khphone=$('#mobilePhone').val();//客户手机
	    var khTelephone2=$('#khTelephone2').val();//客户电话2
	    var khTelephone3=$('#khTelephone3').val();//客户电话3
	    var csrq=$('#csrq').val();//出生日期
	    var sglm=$('#sglm').val();//身高
	    var tzqk=$('#tzqk').val();//体重
        if (!csrq) {
            csrq='1900-01-01';
        }
        var sglm=$('#sglm').val();//身高
        if (!sglm) {
            sglm='0.00';
        }
        var tzqk=$('#tzqk').val();//体重
        if (!tzqk) {
            tzqk='0.00';
        }
	    var dzyxhm=$('#dzyxhm').val();//电子邮箱
	    var radnan=$("input[name='sex']:checked").val();//获取男女
	    var khdj=$("option[name='khdj']:checked").val();//客户等级
        
	    var khqqhm=$('#khqqhm').val();//qq号码
	    var deaddress=$('#deaddress').val();//地址
	    var khszz=$("option[name='khszz']:checked").val();//所在组
	    var kehuyx=$("option[name='kehuyx']:checked").val();//客户意向
	    var jxfs=$("option[name='jxfs']:checked").val();//进线方式
	    var khly=$("option[name='khly']:checked").val();//客户来源
	    var phonetype=$("option[name='phonetype']:checked").val();//手机类型
	    var khnsr=$("option[name='khnsr']:checked").val();//年收入
	    var khzgxl=$("option[name='khzgxl']:checked").val();//学历
	    var cshy=$("option[name='cshy']:checked").val();//职业
	    var khbz=$('#khbz').val();//备注
	    var province = $("option[name='province']:checked").val(); //省份
	    var city = $("option[name='city']:checked").val(); //城市
        var area = $("option[name='area']:checked").val(); //区县
        var postcode = $('#postcode').val();//邮编

        var telphonetype=$("option[name='telphonetype']:checked").val();//学历
        var teltype=$("option[name='teltype']:checked").val();//职业

        if (sglm.length != 0){
            if (!regHeightWeight.test(sglm)) {
                alert('身高必须为数字');
                return;
            }
        }
        if (tzqk.length != 0){
            if (!regHeightWeight.test(tzqk)) {
                alert('体重必须为数字');
                return;
            }   
        }
        if (khqqhm.length != 0){
            if (!regNumber.test(khqqhm)) {
                alert('QQ需要输入数字');
                return;
            }
            if (khqqhm.length < 7) {
                alert('QQ号不能少于7位数字');
                return;
            }
        }

	    if(!khname){
            alert('姓名不能为空');
            return;
        }
        if (!khphone) {
            alert('手机号不能为空');
            return;
        }
        if (!regMobliePhone.test(khphone)) {
            alert('手机号有误,请重新输入');
            return;
        }
       
        if (khTelephone2.length != 0){
            if (!regPhone.test(khTelephone2)) {
                alert('电话2输入有误,请重新输入');
                return;
            }
        }
        if (khTelephone3.length != 0){
            if (!regPhone.test(khTelephone3)) {
                alert('电话3输入有误,请重新输入');
                return;
            }
        }
        if (dzyxhm.length != 0){
            if (!regEmail.test(dzyxhm)) {
                alert('电子邮箱格式有误,请重新输入');
                return;
            }
        }
      
		$.post('index.php?r=khgl/UpdateClientData',{clientno :clientno,clientName:khname,khphone:khphone,khTelephone2:khTelephone2,khTelephone3:khTelephone3,
            csrq:csrq,sglm:sglm,tzqk:tzqk,dzyxhm:dzyxhm,radnan:radnan,khdj:khdj,khqqhm:khqqhm,deaddress:deaddress,
            khszz:khszz,kehuyx:kehuyx,jxfs:jxfs,khly:khly,phonetype:phonetype,khnsr:khnsr,khzgxl:khzgxl,cshy:cshy,khbz:khbz,province:province,city:city,area:area,postcode:postcode,khgsgh:khgsgh,telphonetype:telphonetype,teltype:teltype},function(data){
            if(!data){
            	return;
            }
			if(data.res == 'success'){
				alert(data.msg);
                window.location.href="index.php?r=khgl/NewClientData&clientno="+clientno;
			}
            if (data.res=='error') {
                alert(data.msg);
                return;
            }
		},'json')
	})

	//删除客户资料
	$('#delete').on('click',function(){
		var ensure=confirm('你确定要删除这个客户吗？');
		if(ensure){
			$.post('index.php?r=khgl/DeleteClientData',{clientno:clientno},function(data){
				if(!data){
					return;
				}
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=khgl/GetWdkhzlHtml";
                }
                if (data.res=='error') {
                    alert(data.msg);
                    return;
                };



			},'json')
		}
	})

	//添加跟进记录
	$('body').on('click','#SaveFollow',function(){
        var gjnr=$('#gjnr').val();//内容
        var dbsj=$('#dbsj').val();//待办时间
        var gjfz = $("option[name='gjfz']:checked").val(); //分组
        var gjbq= $("option[name='gjbq']:checked").val(); //跟进标签
        var gjr= $("option[name='gjr']:checked").val();//跟进人
        if (!gjnr) {
         	alert("内容不能为空");return;
        }
         //alert(gjbq);return;
		$.post('index.php?r=khgl/AddFollowRecord',{clientno:clientno,gjnr:gjnr,dbsj:dbsj,gjfz:gjfz,gjbq:gjbq,gjr:gjr},function(data){
			/*console.log(data);
			return;*/
            if(!data){
                alert('添加失败');
                return;
            }
            if(data.res == 'success'){
                alert(data.msg);
                window.location.href="index.php?r=khgl/NewClientData&clientno="+data.clientno;
            }
            if (data.res=='error') {
            	alert(data.msg);
            	return;
            };
            /*else{
            	alert(data.msg);
            	return;
            }*/
        },"json");

	});


     $.post('index.php?r=khgl/GetFollowRecording',{clientno:clientno},function(data){
            if(!data){
                return;
            }
            if(data.res != 'error'){
                $('#tbody2').empty();
                var nowTime = '1980-01-01 10:00:00';
                var length = data.length;
                for(var i = 0; i < length; i++){
                    if(data[i]['khae08'] < nowTime){
                        data[i]['khae08'] = '';
                    }
                    if(data[i]['khae09'] < nowTime){
                        data[i]['khae09'] = '';
                    }
                    var a = i+1;
                    var listInfo = '';
                    listInfo = '<tr>';
                    listInfo +=   '<td><span>'+ data[i]['khae02'] +'</span></td>'
                                + '<td><span>'+ data[i]['khae03'] +'</span></td>'
                                + '<td><span>'+ data[i]['khae04'] +':'+data[i]['khae05']+'</span></td>'
                                + '<td><span>'+ data[i]['khae06'] +':'+data[i]['khae07']+'</span></td>'
                                + '<td><span>'+ data[i]['khae08'] +'</span></td>'
                                + '<td><span>'+ data[i]['khae09'] +'</span></td>'
                                + '<td><img id="ShippedFollow" src="public/img/del.png" title="删除该条记录"  border="0" style="width:20%;cursor:pointer" orderno="'+ data[i]['khae12'] +'"/></td>'
                                
                     + '</tr>';
                    $('#tbody2').append(listInfo);
                }
            }
            else{
                var listInfo = '<tr><td colspan="15" style="color:#0000ff;">暂时没有记录！</td></tr>';
                $('#tbody2').empty();
                $('#tbody2').append(listInfo);
            }
        });

    //获取客户跟进记录信息
     $('#getgjjl').on('click',function(){ 
        $("#table1").css('display','table');
        $("#table2").css('display','none');
        $("#table3").css('display','none');
        $("#Calltable").css('display','none');
        $("#ShortmesTable").css('display','none');
        $.post('index.php?r=khgl/GetFollowRecording',{clientno:clientno},function(data){
        	if(!data){
            	return;
            }
	    	  if(data.res != 'error'){
                $('#tbody2').empty();
                var nowTime = '1980-01-01 10:00:00';
                var length = data.length;
                for(var i = 0; i < length; i++){
                    if(data[i]['khae08'] < nowTime){
                        data[i]['khae08'] = '';
                    }
                    if(data[i]['khae09'] < nowTime){
                        data[i]['khae09'] = '';
                    }
	    			var a = i+1;
	    			var listInfo = '';
	    			listInfo = '<tr>';
	    			listInfo +=   '<td><span>'+ data[i]['khae02'] +'</span></td>'
	    						+ '<td><span>'+ data[i]['khae03'] +'</span></td>'
	    						+ '<td><span>'+ data[i]['khae04'] +':'+data[i]['khae05']+'</span></td>'
	    						+ '<td><span>'+ data[i]['khae06'] +':'+data[i]['khae07']+'</span></td>'
	    						+ '<td><span>'+ data[i]['khae08'] +'</span></td>'
                                + '<td><span>'+ data[i]['khae09'] +'</span></td>'
                                + '<td><img id="ShippedFollow" src="public/img/del.png"  border="0" title="删除该条记录" style="width:20%;cursor:pointer" orderno="'+ data[i]['khae12'] +'"/></td>'	
	    		                + '</tr>';
	    			$('#tbody2').append(listInfo);
	    		}
	    	}
            else{
                var listInfo = '<tr><td colspan="15" style="color:#0000ff;">暂时没有记录！</td></tr>';
                $('#tbody2').empty();
                $('#tbody2').append(listInfo);
            }
        });
    });

//单个删除跟进记录
    $('#table1').on('click','#ShippedFollow',function(){
        var orderid = $(this).attr('orderno');
        if(orderid){
            var ensure = confirm('确定要删除吗？');
            if(ensure){
                $.post('index.php?r=khgl/DeleteRecords',{orderno:orderid},function(data){
                    if(!data){
                        alert('删除失败，请重新操作！');
                    }
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=khgl/NewClientData&clientno="+clientno;
                    }else{
                        alert(data.msg);
                        return;
                    }
                })
            }
        }
    });


    //获取客户订单记录
     $('#getddjl').on('click',function(){ 
        $("#table1").css('display','none');
        $("#table3").css('display','none');
        $("#table2").css('display','table');
        $("#Calltable").css('display','none');
        $("#ShortmesTable").css('display','none');
        $.post('index.php?r=khgl/GetOrderRecord',{clientno:clientno},function(data){
            if(!data){
                return;
            }
            if(data.res != 'error'){
                $('#tbody3').empty();
                var length = data.length;
                var nowTime = '1980-01-01 10:00:00';
                for(var i = 0; i < length; i++){
                    if(data[i]['xsaa28'] < nowTime){
                        data[i]['xsaa28'] = '';
                    }
                    var a = i+1;
                    var listInfo = '';
                    listInfo = '<tr>';
                    listInfo +=   '<td><span>'+ data[i]['xsaa02'] +'</span></td>'
                                + '<td><span>'+ data[i]['xsaa29'] +'</span></td>'
                                + '<td><span>'+ data[i]['xsaa13'] +'</span></td>'
                                + '<td><span>'+ data[i]['xsaa17'] +'</span></td>'
                                + '<td><span>'+ data[i]['xsaa23'] +'</span></td>'
                                + '<td><span>'+ data[i]['xsaa28'] +'</span></td>'
                                + '<td><span>'+ data[i]['xsaa33'] +'</span></td>'
                               /* + '<td><span>'+ data[i]['xsab02'] +'</span></td>'*/
                            + '</tr>';
                    $('#tbody3').append(listInfo);
                }
            }
            else{
                var listInfo = '<tr><td colspan="15" style="color:#0000ff;">暂时没有记录！</td></tr>';
                $('#tbody3').empty();
                $('#tbody3').append(listInfo);
            }
        });
    });
//获取客户通话记录
     $('#CallRecords').on('click',function(){ 
        $("#table1").css('display','none');
        $("#table3").css('display','none');
        $("#table2").css('display','none');
        $("#ShortmesTable").css('display','none');
        $("#Calltable").css('display','table');
        var khphonecall=$('#mobilePhone').val();//客户手机
        $.post('index.php?r=thgl/GetCallRecords',{khphonecall:khphonecall},function(data){
            if(!data){
                return;
            }
            if(data.res != 'error'){
                $('#Calltbody').empty();
                var length = data.length;
                for(var i = 0; i < length; i++){
                    if(data[i]['thaa09'] == 'ANSWERED'){
                        data[i]['thaa09'] = '接听';
                    }
                    if(data[i]['thaa09'] == 'NO ANSWER'){
                        data[i]['thaa09'] = '未接听';
                    }
                    if(data[i]['thaa09'] == 'FAILED'){
                        data[i]['thaa09'] = '失败';
                    }
                    if(data[i]['thaa09'] == 'BUSY'){
                        data[i]['thaa09'] = '忙线';
                    }
                    var a = i+1;
                    var listInfo = '';
                    listInfo = '<tr>';
                    listInfo +=   '<td><span>'+ data[i]['thaa03'] +'</span></td>'
                                + '<td><span>'+ data[i]['thaa09'] +'</span></td>'
                                + '<td><span>'+ data[i]['thaa05'] +'</span></td>'
                                + '<td><span>'+ data[i]['thaa06'] +'</span></td>'
                                + '<td><img id="DelCallRecords" src="public/img/del.png" title="删除该条记录"  border="0" style="width:20%;cursor:pointer" orderno="'+ data[i]['thaa01'] +'" /></td>'
                            + '</tr>';
                    $('#Calltbody').append(listInfo);
                }
            }
            else{
                var listInfo = '<tr><td colspan="15" style="color:#0000ff;">暂时没有记录！</td></tr>';
                $('#Calltbody').empty();
                $('#Calltbody').append(listInfo);
            }
        });
    });

//获取客户短信记录
     $('#ShortmesRecords').on('click',function(){ 
        $("#table1").css('display','none');
        $("#table2").css('display','none');
        $("#table3").css('display','none');
        $("#Calltable").css('display','none');
        $("#ShortmesTable").css('display','table');
         var khphonecall=$('#mobilePhone').val();//客户手机
        $.post('index.php?r=dxgl/GetShortmesRecords',{khphonecall:khphonecall},function(data){
            if(!data){
                return;
            }
            if(data.res != 'error'){
                $('#Shortmestbody').empty();
                var length = data.length;
                var nowTime = '1980-01-01 10:00:00';
                for(var i = 0; i < length; i++){
                    var a = i+1;
                    var listInfo = '';
                    listInfo = '<tr>';
                    listInfo +=   '<td><span>'+ data[i]['khaf03'] +'</span></td>'
                                + '<td><span>'+ data[i]['khaf04'] +'</span></td>'
                                + '<td><span>'+ data[i]['khaf02'] +'</span></td>'
                                + '<td><span>'+ data[i]['khaf05'] +'</span></td>'
                                + '<td><span>'+ data[i]['khaf06'] +'</span></td>'
                                + '<td><img id="DelShortmes" src="public/img/del.png" title="删除该条记录" border="0" style="width:20%;cursor:pointer" orderno="'+ data[i]['khaf01'] +'"/></td>'
                            + '</tr>';
                    $('#Shortmestbody').append(listInfo);
                }
            }
            else{
                var listInfo = '<tr><td colspan="15" style="color:#0000ff;">暂时没有记录！</td></tr>';
                $('#Shortmestbody').empty();
                $('#Shortmestbody').append(listInfo);
            }
        });
    });
//单个删除短信记录
    $('#ShortmesTable').on('click','#DelShortmes',function(){
        var orderid = $(this).attr('orderno');
        if(orderid){
            var ensure = confirm('确定要删除吗？');
            if(ensure){
                $.post('index.php?r=dxgl/DelShortmesRecords',{orderno:orderid},function(data){
                    if(!data){
                        alert('删除失败，请重新操作！');
                    }
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=khgl/NewClientData&clientno="+clientno;
                    }else{
                        alert(data.msg);
                        return;
                    }
                })
            }
        }
    });
//单个删除通话记录
    $('#Calltable').on('click','#DelCallRecords',function(){
        var orderid = $(this).attr('orderno');
        if(orderid){
            var ensure = confirm('确定要删除吗？');
            if(ensure){
                $.post('index.php?r=thgl/DelCallRecords',{orderno:orderid},function(data){
                    if(!data){
                        alert('删除失败，请重新操作！');
                    }
                    if(data.res == 'success'){
                        alert(data.msg);
                        window.location.href="index.php?r=khgl/NewClientData&clientno="+clientno;
                    }else{
                        alert(data.msg);
                        return;
                    }
                })
            }
        }
    });

 //点击显示商品信息
    $('body').on('focus','.goodName',function(){  
        $.post('index.php?r=cpgl/GetAllGoodList',function(data){
            goodListData(data);
        },'json');
        $(this).next('.goodList').css('display','block');
    });

      /**
     * @desc 商品信息获取数据插入节点
     * @author WuJunhua
     * @date 2016-01-22
     */
     function goodListData(data){
        if(data != 'error'){
            $('.oneGoodLine').remove();
            var length = data.length;
            for(var i = 0; i < length; i++){
                if(!data[i].cpae03){
                    data[i].cpae03 = '0.00';
                }
                var listInfo = '';
                listInfo = '<tr class="oneGoodLine" style="cursor:pointer;" goodid="'+ data[i].cpaa01 +'">';
                listInfo += '<td class="goodNumber"><span><font style="color:blue;">'+ data[i].cpaa01 +'</font>:'+ data[i].cpaa02 +'</span></td>'
                            +'</tr>';
                $('.table5').append(listInfo); 
            }
        }
    }

     //输入商品名称进行模糊搜索
    $('body').on('keyup','.goodName',function(){  
        var goodName = $(this).val();
        $.post('index.php?r=cpgl/GetAllGoodList',{goodName:goodName},function(data){
            goodListData(data);
        },'json');
        $(this).next('.goodList').css('display','block');  
    });

    //点击选中商品并在页面上显示对应的信息
     $('body').on('click','.oneGoodLine',function(){
        var $this = $(this);
        var goodId = $this.attr('goodid');
        $.post('index.php?r=cpgl/GetGoodList',{goodid: goodId},function(data){
            if(!data){
                return;
            }
            if(data){
                $this.parent().parent().parent().siblings('.goodName').val(data.cpaa02);
            }
            $('.goodList').css('display','none');
        },'json');
    });


     //点击关闭商品信息
    $('body').on('click','.closeGoodList',function(){
        $('.goodList').css('display','none');
    });

    //点击关闭商品信息
    $('body').on('click','#closeDetail',function(){
        $('#goodDetilDiv').hide();
    });

    //提交投诉显示
     $('#tjtsbtn').on('click',function(){ 
        $("#table1").css('display','none');
        $("#table2").css('display','none');
        $("#Calltable").css('display','none');
        $("#table3").css('display','table');
    });

      /**
     * @desc 添加投诉
     * @author huyan
     * @date 2015-12-24
     */
  $('#Complaint').on('click',function(){
        var clientno = $('#clientno').val();//客户id
        var khname= $('#khname').val();//客户姓名
        var tsbz=$('#tsbz').val();//备注
        var tscp=$('#tscp').val();//投诉产品
        var khtsgh=$('#khtsgh').val();//投诉工号
        var ddbh=$("option[name='ddbh']:checked").val();//订单id
        
        var khwt=$("option[name='khwt']:checked").val();//客户问题
        /*if (!ddbh) {
             alert('没有订单号不能添加投诉');
             return;
        }*/
        if (!khwt) {
            alert('请选择投诉问题');
            return;
        };
       
        $.post('index.php?r=khgl/DetailsComplaints',{clientno:clientno,khname:khname,ddbh:ddbh,tsbz:tsbz,tscp:tscp,khtsgh:khtsgh,khwt:khwt},function(data){
            if(!data){
                alert('添加失败');
                return;
            }
            if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
            if(data.res == 'success'){
                alert(data.msg);
                /*window.location.href="index.php?r=khgl/NewClientData&clientno="+data.clientno;*/
                 window.location.href="index.php?r=khgl/NewClientData&clientno="+clientno;
            }
             
        },"json");

    });



    //点击合并资料弹框
    $('body').on('click','#MergedCustomer',function(){
        $('.gonghao').remove();//工号
        $('#addJobNum').removeAttr("disabled");
        $('#khzl2').empty();
        $('#keyword').empty();
        $('#orderSeparateAchievement').show();
    });

    //点击关闭合并资料弹框
    $('body').on('click','#CloseCommit',function(){
        document.getElementById("keyword").value="";
        $('#orderSeparateAchievement').hide();
    });

    //点击添加跟进记录弹框
    $('body').on('click','#AddFollow',function(){
        $('.gonghao').remove();//工号
        $('#addJobNum').removeAttr("disabled");
        $('#Achievement').show();
    });

    //点击取消跟进记录弹框
    $('body').on('click','#CancelFollow',function(){
        document.getElementById("gjnr").value="";
        document.getElementById("dbsj").value="";
        $('#Achievement').hide();
    });

     //查询客户资料
    $('body').on('click','#searchClient',function(){
        var searchtype = $("input[name='search']:checked").val();
        var keyword = $('#keyword').val();
        // if (!keyword) {
        //     	alert('请输入查询条件');
        //     	return;
        //     }
		$.post('index.php?r=khgl/GetCustomer',{searchtype:searchtype,keyword:keyword},function(data){
            if(!data){
            	$('#khzl2').text('没有查询到该客户');
                return;
            }
            var khzl = data.khaa02+','+data.khaa03;
            //(data.list[0]['khaa02']);
            $('#khzl2').text(khzl);
        });

	});

	//提交合并
	 /*$('#getCommitMerger').on('click',function(){
	    var searchtype = $("input[name='search']:checked").val();//客户id，手机，姓名
	    var retaintype = $("input[name='retain']:checked").val();//保留客户1，保留客户1
        var keyword = $('#keyword').val();//查询条件
        var khzl1=$('#khzl1').text();//客户资料1
        var khzl2=$('#khzl2').text();//客户资料2
        if (!khzl2) {
            alert('请先查找要合并的客户');
            return;
        }
        var ensure=confirm('确定要合并吗？');
        if(ensure){
		    $.post('index.php?r=khgl/CommitMerger',{clientno:clientno,searchtype:searchtype,keyword:keyword,retaintype:retaintype,khzl1:khzl1,khzl2:khzl2},function(data){
                if(!data){
                	return;
                }
                if(data.res == 'error'){
                        alert(data.msg);
                        return;
                }
		    	if(data.res == 'success'){
                    if (retaintype=1) {

                    }
                    if (retaintype=2) {
                        alert(data.msg);
                        window.location.href="index.php?r=khgl/GetWdkhzlHtml";
                    }
		    	}
		    },'json')
        }
	});*/

	 //单个转客户资料
	$('#TurnCustomer').on('click',function(){
        var khgsgh= $("option[name='khgsgh']:checked").val(); //归属工号  
        if(!khgsgh){
           alert("请选择转出工号");return; 
        }
        var a= khgsgh.split(":");
		var ensure=confirm('确定把客户转给工号:'+a[0]+'吗');
		if(ensure){
    		var khname = $('#khname').val();//客户姓名
    	    var khphone=$('#mobilePhone').val();//客户手机
    	    var khTelephone2=$('#khTelephone2').val();//客户电话2
    	    var khTelephone3=$('#khTelephone3').val();//客户电话3
    	    var csrq=$('#csrq').val();//出生日期
    	    var sglm=$('#sglm').val();//身高
    	    var tzqk=$('#tzqk').val();//体重
    	    var dzyxhm=$('#dzyxhm').val();//电子邮箱
    	    var radnan=$("input[name='sex']:checked").val();//获取男女
    	    var khdj=$("option[name='khdj']:checked").val();//客户等级
    	    
    	    var khqqhm=$('#khqqhm').val();//qq号码
    	    var deaddress=$('#deaddress').val();//地址
    	    var khszz=$("option[name='khszz']:checked").val();//所在组
    	    var kehuyx=$("option[name='kehuyx']:checked").val();//客户意向
    	    var jxfs=$("option[name='jxfs']:checked").val();//进线方式
    	    var khly=$("option[name='khly']:checked").val();//客户来源
    	    var phonetype=$("option[name='phonetype']:checked").val();//手机类型
    	    var khnsr=$("option[name='khnsr']:checked").val();//年收入
    	    var khzgxl=$("option[name='khzgxl']:checked").val();//学历
    	    var cshy=$("option[name='cshy']:checked").val();//职业
    	    var khbz=$('#khbz').val();//备注
    	    var province = $("option[name='province']:checked").val(); //省份
    	    var city = $("option[name='city']:checked").val(); //城市
            var area = $("option[name='area']:checked").val(); //区县
            var postcode = $('#postcode').val();//邮编
            
            if (!clientno) {
                alert("客户已被转出");return;
            }
    		$.post('index.php?r=khgl/TurnCustomer',{clientno:clientno,clientName:khname,khphone:khphone,khTelephone2:khTelephone2,khTelephone3:khTelephone3,
            csrq:csrq,sglm:sglm,tzqk:tzqk,dzyxhm:dzyxhm,radnan:radnan,khdj:khdj,khqqhm:khqqhm,deaddress:deaddress,
            khszz:khszz,kehuyx:kehuyx,jxfs:jxfs,khly:khly,phonetype:phonetype,khnsr:khnsr,khzgxl:khzgxl,cshy:cshy,khbz:khbz,province:province,city:city,area:area,postcode:postcode,khgsgh:khgsgh},function(data){
    			if(!data){
    				return;
    			}
    			if(data.res == 'success'){
    				alert(data.msg);
                    window.location.href="index.php?r=khgl/GetWdkhzlHtml";
                    
    			}
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
    		},'json')
		}
	});

	//是否设置待办特效
	 $('#szdbsx').on('click',function(){
    	var tick = $('#szdbsx:checked').length;
    	if(tick){
    		$('.dbsx').css('display','block');
    	}else{
    		$('.dbsx').css('display','none');
    	}
    });
	//显示更多资料
    $("#sxss").click(function(){
        $(".xsgdzl").slideToggle("slow");
        $('yinc').css('display','block');
        yinc.style.display = "block";
        sxss.style.display = "none";
    });

    //隐藏更多资料
     $("#yinc").click(function(){
        $(".xsgdzl").slideToggle("hide");
        yinc.style.display = "none";
        sxss.style.display = "block";
    });

    //直接拨打
    $('.dial').on('click',function(){
        var sign = $(this).attr('sign');
        //根据标识来区分要拨打的号码
        switch (sign) {
            case '1':
                var secondPhone = $('#khphone').val();//客户手机
                break;
            case '2':
                var secondPhone = $('#khTelephone2').val();//客户电话2
                break;
            case '3':
                var secondPhone = $('#khTelephone3').val();//客户电话3
                break;
            default:
                alert('操作有误');
                return;
                break;
        }
        if(!$.trim(secondPhone)){
            alert('拨打的号码不能为空');
            return;
        }
        if(!regNumber.test(secondPhone)){
            alert('拨打的号码只能是数字,请重新输入');
            return;
        }
        jsonp('index.php?r=ShjApi/ExtensionNumberToMbPhoneApi&secondPhone=' + secondPhone,function(data){
            if(data.result == 1){
                alert('拨打成功');
            }else{
                alert('拨打失败');
            }     
        });
    });

    //外地拨打
    $('#overseasCall').on('click',function(){
        var secondPhone = $('#khphone').val(); //客户手机
        var fieldDialVal = $('#fieldDial').val(); //电话加拨号码
        if(fieldDialVal){
            secondPhone = fieldDialVal + secondPhone;
        }
        if(!$.trim(secondPhone)){
            alert('拨打的号码不能为空');
            return;
        }
        if(!regNumber.test(secondPhone)){
            alert('拨打的号码只能是数字,请重新输入');
            return;
        }
        jsonp('index.php?r=ShjApi/ExtensionNumberToMbPhoneApi&secondPhone=' + secondPhone,function(data){
            if(data.result == 1){
                alert('拨打成功');
            }else{
                alert('拨打失败');
            }     
        });
    });
   
})

var httpHost = $('#httpHost').val();  //服务器地址
//打开弹出框——添加跟进记录
function showTjgjjl(){
    var dialog = new Dialog();
    dialog.Width=600;
    dialog.Height=400;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetTjgjjlHtml";
    dialog.show();
}

//打开弹出框——合并客户资料
function showHbkhzl(){
    var dialog = new Dialog();
    dialog.Width=600;
    dialog.Height=400;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetHbkhzlHtml";
    dialog.show();
}


//var httpHost = $('#httpHost').val();  //服务器地址
$('#xztsgh').on('click',function(){
    var dialog = new Dialog();
    dialog.Modal = false;
    dialog.Width=710;
    dialog.Height=450;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GetXztsghHtml";
    dialog.show();
});

$('#xztscp').on('click',function(){
    var dialog = new Dialog();
    dialog.Modal = false;
    dialog.Width=710;
    dialog.Height=450;
    dialog.URL="http://"+httpHost+"/index.php?r=dialog/GettscpHtml";
    dialog.show();
});

function closeXzyh(){
    Dialog.close();
}