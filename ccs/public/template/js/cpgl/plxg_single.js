$(function(){
	var allCp = $("#allCp").val();
	var allSx = $("#allSx").val();
	$.post("index.php?r=cpgl/GetCpById",{allCp:allCp},function(data){
		if(data.res == "success"){
			$("#singleTable").empty();
			var length = data.list.length;
			for(var i = 0; i < length; i ++){
				var tableInfo = '<thead><tr>';
				tableInfo += '<th style="text-align:center" colspan="2">'+ data.list[i][0]['cpaa02'] +'</tr></thead><tbody>';
				if(allSx.indexOf('cpfl') > -1){
					tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">产品分类</th>'
									+'<td style="text-align:left"><select style="width:200px" class="dfinput"name="cpfl_'+data.list[i][0]['cpaa01']+'" id="cpfl_'+data.list[i][0]['cpaa01']+'"></select></td></tr>';
					getCpfl(data.list[i][0]['cpab01'],data.list[i][0]['cpaa01']);
				}
				if(allSx.indexOf('gg') > -1){
					tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">规格</th><td style="text-align:left">'
								+'<input type="text" style="width:195px" class="dfinput" name="gg_'+data.list[i][0]['cpaa01']+'" value="'+data.list[i][0]['cpaa10']+'">'
								+'</td></tr>';
				}
				if(allSx.indexOf('cppp') > -1){
					tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">产品品牌</th><td style="text-align:left">'
								+'<select style="width:200px" class="dfinput" name="cppp_'+data.list[i][0]['cpaa01']+'" id="cppp_'+data.list[i][0]['cpaa01']+'"></select></td></tr>';
					getCppp(data.list[i][0]['cpad01'],data.list[i][0]['cpaa01']);
				}
				if(allSx.indexOf('xsj') > -1){
					tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">销售价</th><td style="text-align:left">'
								+'<input type="text" style="width:195px" class="dfinput" name="xsj_'+data.list[i][0]['cpaa01']+'" value="'+data.list[i][0]['cpaa06']+'">'
								+'</td></tr>';
				}
				if(allSx.indexOf('ms') > -1){
					tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">描述</th><td style="text-align:left">'
								+'<textarea name="ms_'+data.list[i][0]['cpaa01']+'" class="textinput">'+data.list[i][0]['cpaa12']+'</textarea>'
								+'</td></tr>';
				}
				if(allSx.indexOf('ifon') > -1){
					tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">是否上架</th><td style="text-align:left">';
					if(data.list[i][0]['cpaa08'] == "上架"){
						tableInfo += '<input type="radio" name="ifon_'+data.list[i][0]['cpaa01']+'" value="上架" checked />是<input type="radio" name="ifon_'+data.list[i][0]['cpaa01']+'" value="下架" />否';
					}else{
						tableInfo += '<input type="radio" name="ifon_'+data.list[i][0]['cpaa01']+'" value="上架" />是<input type="radio" name="ifon_'+data.list[i][0]['cpaa01']+'" value="下架" checked />否';
					}
					tableInfo += '</td></tr>';
				}
				if(allSx.indexOf('cjhh') > -1){
					tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">厂家货号</th><td style="text-align:left">'
								+'<input type="text" style="width:195px" class="dfinput" name="cjhh_'+data.list[i][0]['cpaa01']+'" value="'+data.list[i][0]['cpaa16']+'">'
								+'</td></tr>';
				}
				if(allSx.indexOf('gys') > -1){
					tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">供应商</th><td style="text-align:left">'
								+'<select style="width:200px" class="dfinput" name="gys_'+data.list[i][0]['cpaa01']+'" id="gys_'+data.list[i][0]['cpaa01']+'"></select></td></tr>';
					getGys(data.list[i][0]['cgab01'],data.list[i][0]['cpaa01']);			
				}
				tableInfo += '<tr><td></td></tr></tbody>';
				$("#singleTable").append(tableInfo);
			}
		}else{
			alert('error?');
		}
	},'json');

});


//<input type="text" class="dfinput" name="cpfl_'+data.list[i][0]['cpaa01']+'" value="'+data.list[i][0]['cpab02']+'">
//获取分类   sel为已选 cpid是产品的ID
function getCpfl(sel,cpid){
	$.post('index.php?r=cpgl/GetCpflByCond',function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			$('#cpfl_'+cpid).append('<option selected value="0">请选择分类</option>');
			for(var i = 0; i < length; i++){
				if(data.list[i]['cpab01'] == sel){
					$('#cpfl_'+cpid).append('<option selected value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');
				}else{
					$('#cpfl_'+cpid).append('<option value="'+ data.list[i]['cpab01'] +'">'+ data.list[i]['cpab02'] +'</option>');
				}
					
			}
		}
	},'json');
}

//获取品牌  sel为已选 cpid是产品的ID
function getCppp(sel,cpid){
	$.post('index.php?r=cpgl/GetCpppByCond',function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			$('#cppp_'+cpid).append('<option selected value="0">请选择品牌</option>');
			for(var i = 0; i < length; i++){
				if(data.list[i]['cpad01'] == sel){
					$('#cppp_'+cpid).append('<option selected value="'+ data.list[i]['cpad01'] +'">'+ data.list[i]['cpad03'] +'</option>');	
				}else{
					$('#cppp_'+cpid).append('<option value="'+ data.list[i]['cpad01'] +'">'+ data.list[i]['cpad03'] +'</option>');	
				}
			}
		}
	},'json');
}

//获取供应商  sel为已选 cpid是产品的ID
function getGys(sel,cpid){
	var cpfl = $("#cpfl").val();
	$.post('index.php?r=cggl/GetGysByFl',{cpfl:cpfl},function(data){
		if(data.result == 'success'){
			var length = data.list.length;
			$('#gys_'+cpid).append('<option selected value="0">请选择供应商</option>');
			for(var i = 0; i < length; i++){
				if(data.list[i]['cgab01'] == sel){
					$('#gys_'+cpid).append('<option selected value="'+ data.list[i]['cgab01'] +'">'+ data.list[i]['cgab02'] +'</option>');	
				}else{
					$('#gys_'+cpid).append('<option value="'+ data.list[i]['cgab01'] +'">'+ data.list[i]['cgab02'] +'</option>');	
				}
				
			}
		}
	},'json');
}