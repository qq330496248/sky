function addTable(){
	var number = $("#number").val();
	if($("#cgmc_"+number).val() == ""){
		alert("请先添加前一项商品！");
	}else{
		number ++;
		$("#number").val(number);
		$("#xcgdTable").append('<tr><td><img src="public/img/del.png" title="删除该行" border="0" style="width:7%;cursor:pointer" class="delgoodline"/></td><td><input id="cgkh_'+number+'" name="cgkh" type="text" class="dfinput" style="width:90px" onblur="checkAndGetCp('+number+')" /></td><td><input id="cgmc_'+number+'" name="cgmc" onfocus="getAllCpList('+number+')"  onkeyup="getCpList('+number+')" type="text" class="dfinput" style="width:200px" /><div class="goodList_'+number+'" style="display:none;background-color:#D3D3D3;position:absolute;overflow:auto;width:260px;height:342px;"><table style="width:260px;" class="table5_'+number+'"><tr><td class="closeGoodList" style="cursor:pointer;">关闭</td></tr></table> </div></td><td><input id="cghh_'+number+'" readonly="" name="cghh" type="text" class="dfinput" style="width:100px" /></td><td><input id="cgjhj_'+number+'" name="cgjhj" type="text" class="dfinput" style="width:100px" /></td><td><input id="cgsl_'+number+'" name="cgsl" type="text" class="dfinput" style="width:100px" /></td></tr>');
	}
}

//点击显示商品信息
$('body').on('focus','.goodName',function(){ 
	//获取当前行数，根据input框的id获取 
    var number = $(this).attr("id").split("_")[1];
	$.post('index.php?r=cpgl/GetAllGoodList',function(data){
        getTable(data);
    },'json');
    $('.goodList_'+number).css('display','block');
});

//输入商品名称进行模糊搜索
$('body').on('keyup','.goodName',function(){  
    var goodName = $(this).val();
    alert(goodName);
    $.post('index.php?r=cpgl/GetAllGoodList',{goodName:goodName},function(data){
        getTable(data);
    },'json');
    $(this).next('.goodList').css('display','block');  
});

//删除商品行
$('#xcgdTable').on('click','.delgoodline',function(){
	var number = $("#number").val();
    $(this).parent().parent().remove();
    number --;
    $("#number").val(number);
});

//获取所有商品的信息
function getAllCpList(number){
	$.post('index.php?r=cpgl/GetAllGoodList',function(data){
        if(data != 'error'){
            $('.oneGoodLine').remove();
            var length = data.length;
            for(var i = 0; i < length; i++){
                var listInfo = '';
                listInfo = '<tr class="oneGoodLine">';
                listInfo += '<td class="goodNumber" num="'+number+'" goodid="'+ data[i].cpaa01 +'"><span style="cursor:pointer;"><font style="color:#0000ff;">'+data[i].cpaa01+'</font> : '+ data[i].cpaa02 +'</span></td>'
                            +'</tr>';
                $('.table5_'+number).append(listInfo); 
            }
        }
    },'json');
    $('.goodList_'+number).css('display','block');
}

//在框中输入内容，查找并获取商品信息
function getCpList(number){
	var goodName = $("#cgmc_"+number).val();
	$.post('index.php?r=cpgl/GetAllGoodList',{goodName:goodName},function(data){
        if(data != 'error'){
            $('.oneGoodLine').remove();
            var length = data.length;
            for(var i = 0; i < length; i++){
                var listInfo = '';
                listInfo = '<tr class="oneGoodLine">';
                listInfo += '<td class="goodNumber" num="'+number+'" goodid="'+ data[i].cpaa01 +'"><span style="cursor:pointer;">'+data[i].cpaa01+' : '+ data[i].cpaa02 +'</span></td>'
                            +'</tr>';
                $('.table5_'+number).append(listInfo); 
            }
        }
    },'json');
    $('.goodList_'+number).css('display','block');
}


    //点击关闭商品信息
    $('body').on('click','.closeGoodList',function(){
        $(this).parent().parent().parent().parent().css('display','none');
    });

    //点击选中商品并在页面上显示对应的信息
    $('body').on('click','.goodNumber',function(){
        var $this = $(this);
        var list = $("#goodids").val();//已经选中的商品ID列表
        var ids = list.split(",");
        var count = 0;//相同个数
        var number = $(this).attr("num");
        var goodId = $this.attr('goodid');
        for (var i = 0; i < ids.length; i++){
        	if(goodId == ids[i]){
        		count ++;
        	}
      	}
      	if(count == 0){
      		$.post('index.php?r=cpgl/GetGoodList',{goodid: goodId},function(data){
	            if(data){
	            	if(data.cpae03 > 0){
	                    var ensure = confirm('款号 '+ data.cpaa01 +' 的商品库存为'+ data.cpae03 +'，是否继续下单？');
	                    if(!ensure){
	                        return;
	                    }
	                }
	                $this.parent().parent().parent().parent().parent().siblings().find('#cgkh_'+number).val(data.cpaa01);
	                $this.parent().parent().parent().parent().parent().siblings().find('#cghh_'+number).val(data.cpaa16);
	                $this.parent().parent().parent().parent().siblings('#cgmc_'+number).val(data.cpaa02);
	         //       $("#goodids").val(list + goodId + ",");
	            	if(data.cpae18 != undefined){
	                    $this.parent().parent().parent().parent().parent().siblings().find('#sx_'+number).text(data.cpae18);
	                }
	                $('.goodList_'+number).css('display','none');
	                getCpsx(goodId,number);
	            }
	        },'json');
      	}else{
      		alert("已选择相应商品");
      	}
    });

function getCpsx(goodId,number){
	$.post('index.php?r=cpgl/GetCpsxxqFromCp',{cpid:goodId},function(data){
		if(data.result == 'success'){
			$("#sx_"+number).empty();
			var length = data.list.length;
			for(var i = 0; i < length; i++){
				//alert(data.list[i]['cpag02']);
				var listInfo = data.list[i]['cpag02'] + '<input type="hidden" name="type_'+number+'" id="num" value="'+data.list[i]['cpag01']+'_'+data.list[i]['cpag02']+'" />: ';
				var s = data.list[i]['cpsxxq'].split("_");
				var cpsxxq = s[1].split("|");
				//双for循环判断是否有选中的值
				for(var a = 0; a < cpsxxq.length; a ++){
					//alert(cpsxxq[a]);
					listInfo += '<input type="checkbox" name="str_'+number+'_'+data.list[i]['cpag01']+'[]" value="'+ cpsxxq[a] +'" />' + cpsxxq[a];
				}
				listInfo += '<br/>';
				$("#sx_"+number).append(listInfo);				
			}
		}
	},'json');
}

//输入款号后，判断是否存在当前款号的商品，存在则自动填写信息
function checkAndGetCp(number){
	var cpkh = $("#cgkh_"+number).val();
	if(cpkh){
		$.post("index.php?r=cggl/CheckAndGetCp",{cpkh:cpkh},function(data){
			if(data.result == 'false'){
				$("#alertFont").html("输入的款号不存在对应商品！");
			}else{
				$("#alertFont").html("");
				$("#cgmc_"+number).val(data.cp.cpaa02);
				$("#cghh_"+number).val(data.cp.cpaa16);
				getCpsx(cpkh,number);
			}
		},"json");
	}
}

//新增采购单
function addCgd(){
	var allCheck = checkCgmc() && checkDate() && checkMoneyAndSum();
	if(allCheck){
		var a = "";
		var cgkh = "";//产品款号的字符串，逗号隔开
		var cgmc = "";//产品名称的字符串，逗号隔开
		var cghh = "";//厂家货号的字符串，逗号隔开
		var cgjhj = "";//进货价的字符串，逗号隔开
		var cgsl = "";//数量的字符串，逗号隔开
		var cpsx = "";//拼接的属性字符串,逗号隔开
		var number = $("#number").val();
		var gysStr = $("#gys").val().split(":");
		var gys = gysStr[1];//供应商名称
		var gysID = gysStr[0];//供应商ID
		var cgyf = $("#cgyf").val();//运费
		var cgbz = $("#cgbz").val();//备注
		var dhsj = $("#dhsj").val();//到货时间
		if(!gys){
			$("#alertFont").html('供应商不能为空');
			return;
		}
		var con = confirm("真的确认提交吗？");
		if(con){
			//获取所有的产品款号，拼串
			for(var i = 1;i <= number;i ++){
				if(i == number){
					cgkh += $("input[id='cgkh_"+i+"']").val();
				}else{
					cgkh += $("input[id='cgkh_"+i+"']").val()+",";
				}
			}
			//获取所有的产品名称，拼串
			for(var i = 1;i <= number;i ++){
				if(i == number){
					cgmc += $("input[id='cgmc_"+i+"']").val();
				}else{
					cgmc += $("input[id='cgmc_"+i+"']").val()+",";
				}
			}
			//获取所有的厂家货号，拼串
			for(var i = 1;i <= number;i ++){
				if(i == number){
					cghh += $("input[id='cghh_"+i+"']").val();
				}else{
					cghh += $("input[id='cghh_"+i+"']").val()+",";
				}
			}
			//获取所有的进货价，拼串
			for(var i = 1;i <= number;i ++){
				if(i == number){
					cgjhj += $("input[id='cgjhj_"+i+"']").val();
				}else{
					cgjhj += $("input[id='cgjhj_"+i+"']").val()+",";
				}
			}
			//获取所有的数量，拼串
			for(var i = 1;i <= number;i ++){
				if(i == number){
					cgsl += $("input[id='cgsl_"+i+"']").val();
				}else{
					cgsl += $("input[id='cgsl_"+i+"']").val()+",";
				}
			}
			//获取所有的属性
			for(var i = 1;i <= number; i ++){
				$("input[name='type_"+i+"']").each(function(){
					var type = $(this).val().split("_")[1];
					var id = $(this).val().split("_")[0];
					$("input:checkbox[name='str_"+i+"_"+id+"[]']:checked").each(function(){
						cpsx += type + ":" + $(this).val()+"|";
					});
					cpsx += ";";
					a += $(this).val() + "_";
				});
				cpsx += ",";
			}
			$.post("index.php?r=cggl/AddCgd",{cgkh:cgkh,cgmc:cgmc,cghh:cghh,cgjhj:cgjhj,cgsl:cgsl,cgsx:cpsx,number:number,gys:gys,gysID:gysID,cgyf:cgyf,cgbz:cgbz,dhsj:dhsj},function(data){
					if(data.res == 'message'){
						$("#alertFont").html(data.msg);
						return ;
					}
					alert(data.msg);
					$("#alertFont").html("");
					if(data.res == 'success'){
						window.location.href="index.php?r=cggl/GetCgdlbHtml";
					}
			},"json");
		}
	}else{

	}
		
}

//检查，是否至少有一个商品
function checkCgmc(){
	var cgmc = $("#cgmc_1").val();
	//采购商品列数，用于检查是否重复
	var number = $("#number").val();
	if(cgmc == "" || cgmc == null){
		alert("至少添加一项产品！");
		return false;
	}
	return true;
}

//日期检查
function checkDate(){
	var dhsj = $("#dhsj").val();
	if(dhsj == "" || dhsj == null){
		alert("请选择预计到货时间！");
		return false;
	}else{
		return true;
	}
}
//验证价格以及总数
function checkMoneyAndSum(){
	var number = $("#number").val();
	var result = true;
	for(var i = 1; i <= number; i ++){
		if( ($("input[id='cgjhj_"+i+"']").val()!='' && $("input[id='cgsl_"+i+"']").val() != '') && !(isPoint($("input[id='cgjhj_"+i+"']").val()) && isNum($("input[id='cgsl_"+i+"']").val())) ){		
			result = false;
		}
	}
	if(!result){
		$("#alertFont").html("进货价以及采购量只能是数字且最多两位小数");
	}
	return result;
}