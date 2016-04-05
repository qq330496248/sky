$(function(){
	var allSx = $("#allSx").val();
	$("#unityTable").empty();
	var tableInfo = "";
	if(allSx.indexOf('cpfl') > -1){
		tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">产品分类</th>'
						+'<td style="text-align:left"><select style="width:200px" class="dfinput"name="cpfl" id="cpfl"></select></td></tr>';
		//getCpfl(data.list[i][0]['cpab01'],data.list[i][0]['cpaa01']);
	}
	if(allSx.indexOf('gg') > -1){
		tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">规格</th><td style="text-align:left">'
					+'<input type="text" style="width:195px" class="dfinput" name="gg" value=""></td></tr>';
	}
	if(allSx.indexOf('cppp') > -1){
		tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">产品品牌</th><td style="text-align:left">'
					+'<select style="width:200px" class="dfinput" name="cppp" id="cppp"></select></td></tr>';
		//getCppp(data.list[i][0]['cpad01'],data.list[i][0]['cpaa01']);
	}
	if(allSx.indexOf('xsj') > -1){
		tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">销售价</th><td style="text-align:left">'
					+'<input type="text" style="width:195px" class="dfinput" name="xsj" value=""></td></tr>';
	}
	if(allSx.indexOf('ms') > -1){
		tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">描述</th><td style="text-align:left">'
					+'<textarea name="ms" class="textinput"></textarea></td></tr>';
	}
	if(allSx.indexOf('ifon') > -1){
		tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">是否上架</th><td style="text-align:left">'
					+'<input type="radio" name="ifon" value="上架"  />是<input type="radio" name="ifon" value="下架" />否'
					+'</td></tr>';
	}
	if(allSx.indexOf('cjhh') > -1){
		tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">厂家货号</th><td style="text-align:left">'
					+'<input type="text" style="width:195px" class="dfinput" name="cjhh" value=""></td></tr>';
	}
	if(allSx.indexOf('gys') > -1){
		tableInfo += '<tr><th width="10%" style="text-align:right;font-size:13px">供应商</th><td style="text-align:left">'
					+'<select style="width:200px" class="dfinput" name="gys" id="gys"></select></td></tr>';
		//getGys(data.list[i][0]['cgab01'],data.list[i][0]['cpaa01']);			
	}
	$("#unityTable").append(tableInfo);
});