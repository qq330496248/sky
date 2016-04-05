//获取常用的操作对象
var $editGoodId = $('#editGoodId');					//产品id对象
var $productName = $('#productName');				//产品名称文本框对象
var $EnName = $('#EnName');							//产品英文名称文本框对象
var $goodRetil = $('#goodRetil');					//产品介绍文本框对象
var $marketPrice = $('#marketPrice');				//市场价文本框对象
var $smallPurchasePrice = $('#smallPurchasePrice');	//可能采购价文本框对象【小的价格】
var $bigPurchasePrice = $('#bigPurchasePrice');		//可能采购价文本框对象【大的价格】
var $retailPrice = $('#retailPrice');				//建议售价文本框对象
var $cost = $('#cost');								//运费估算文本框对象
var $saleLink = $('#saleLink');						//销售链接文本框对象
var $purchaseLink = $('#purchaseLink');				//采购链接文本框对象
var $remark = $('#remark');							//产品备注文本框对象
var $logistics = $('#logistics');					//物流建议多选框div对象
var $fileQueue = $('#fileQueue');					//产品图片ul对象

imgBiggerFun('#fileQueue','img','yes'); //执行图片放大方法
imgBiggerFun('#pictures','img','yes'); //执行图片放大方法
imgBiggerFun('#goodsList','img','no'); //执行图片放大方法

/**
 * @desc 获取商品开发列表的信息数据
 * @author Guanghua Chen
 * @date 2015-7-2
 */
$(document).ready(function(){
	$.post('?r=Pdsgoods/GetGoodsList',function(data){
		listData(data);
	})
});

/**
 * @desc 绑定列表数据
 * @author Guanghua Chen
 * @date 2015-7-2
 */
function listData(data){
	if(data.result === 'error'){
		$('#goodsList').empty();
		$('#pageInfo').empty();
		$('#goodsList').append('<tr><td colspan="11">暂时没有商品数据</td></tr>');
	}
	if(data.result === 'succeed'){
		$('#goodsList').empty();
		var list = data.list;
		var length = list.length;
		for(var i = 0; i < length; i++){
			var listInfo = '';
			listInfo = '<tr><td><input type="checkbox" value="'+ list[i]['good_id'] +'" /></td>'
					   + '<td class="imgTd"><img src="'+ list[i]['picture'][0] +'" id="imgName'+ list[i]['good_id'] +'"></td>'
					   + '<td><span id="productName'+ list[i]['good_id'] +'">'+ list[i]['product_name'] +'</span></td>'
					   + '<td><span id="enname'+ list[i]['good_id'] +'">'+ list[i]['english_name'] +'</span></td>'
					   + '<td><span id="marketPrice'+ list[i]['good_id'] +'">'+ list[i]['market_price'] +'</span></td>'
					   + '<td><span id="purchasePrice'+ list[i]['good_id'] +'">'+ list[i]['purchase_price'] +'</span></td>'
					   + '<td><span id="retailPrice'+ list[i]['good_id'] +'">'+ list[i]['retail_price'] +'</span></td>'
					   + '<td><span id="logistics'+ list[i]['good_id'] +'">'+ list[i]['logistics'] +'</span></td>'
					   + '<td><span>'+ list[i]['createtime'] +'</span></td>'
					   + '<td><i class="coll coll1">'+ list[i]['collect'] +'</i><i class="coll coll2">'+ list[i]['submit'] +'</i></td>'
					   + '<td>';
			if(list[i]['reject_status'] == 1 ){
				listInfo += '商品驳回';
				if(list[i]['reason']){
					listInfo += '| <a href="javascript:;" data-good-id="'+ list[i]['good_id'] +'" class="linkFont reason" >原因</a>';
				}
			}
			if(list[i]['reject_status'] == 0 ){
				if(data.permission == 2){
					listInfo += '<a href="javascript:;" class="linkFont editGood" data-good-id="'+ list[i]['good_id'] +'">编辑</a>&nbsp;'
						        + '<a href="javascript:;" class="linkFont delGood" data-good-id="'+ list[i]['good_id'] +'">删除</a> ';
				}
				if(data.permission == 4){
					listInfo += '<a href="javascript:;" class="linkFont goodsDetil" data-good-id="'+ list[i]['good_id'] +'">详情</a>&nbsp;'
						        + '<a href="javascript:;" class="linkFont collectGood" data-good-id="'+ list[i]['good_id'] +'">收藏</a>&nbsp;'
						        + '<a href="javascript:;" class="linkFont deliverGood" data-good-id="'+ list[i]['good_id'] +'">提审</a> ';
				}
				if(data.permission == 5){
					listInfo += '<a href="javascript:;" class="linkFont goodsDetil" data-good-id="'+ list[i]['good_id'] +'">详情</a>&nbsp;'
						        + '<a href="javascript:;" class="linkFont assignGood" data-good-id="'+ list[i]['good_id'] +'">指派</a>';
				}
			}
			listInfo += '</td></tr>';
			$('#goodsList').append(listInfo);
			checkedFalse($('#goodsList :checkbox'),$('.allchecked :checkbox'));
		}
	}
	if(data.html){
		$('#pageInfo').empty();
		$('#pageInfo').append('<tr><td colspan="11">'+ data.html +'</td></tr>');
	}
}

/**
 * @desc 点击分页按钮，刷新页面
 * @author Guanghua Chen
 * @date 2015-7-2
 */
$('#pageInfo').on('click','a',function(){
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
 * @descr dsnFun指派弹窗动态定位
 * @param  {Object} obj-当前操作对象  如：$(this);
 * @auto LinPeiYan
 * @date 2015-6-4
 */
function dsnFun(obj){
		var nTop=obj.offset().top+25;
		var nLeft=obj.offset().left-260;
		$('.dsnBox').show(0).animate({top:nTop,left:nLeft},300);
}

/**
 * @desc 绑定日期插件
 * @author Guanghua Chen
 * @date 2015-6-12
 */
dateSelFun($('#startTime'));
dateSelFun($('#endTime'));
dateSelFun($('input[name="starttime"]'));
dateSelFun($('input[name="endtime"]'));

/**
 * @desc 点击新增按钮,显示录入商品弹窗
 * @author Guanghua Chen
 * @date 2015-6-12
 */
$('#addGood').on('click', function() {
	//每次点击新增按钮，对新增商品内容做初始化
	$editGoodId.val('');
	imgInfo = [];
	$('.addGoodList input[type="text"]').val('');
	$('.addGoodList textarea').val('');
	$('.addGoodList input[type="checkbox"]').prop('checked',false);
	$fileQueue.html('');
	$('#operateGood').text('录入新产品');
	$('#addGoodDiv').show();
});
//关闭录入商品弹窗
$('#closeAddGood').on('click', function() {
	$('#addGoodDiv').hide();
});
//点击导出，显示导出弹窗
$('#exportBtn').on('click', function() {
	//做初始化
	$('#startTime').val('');
	$('#endTime').val('');
	$('#searchCheck input[type="checkbox"]').prop('checked',false);
	$('#exporDiv').show();
});
//点击取消导出按钮，关闭导出弹窗
$('#cancelExpor').on('click', function() {
	$('#exporDiv').hide();
});
//关闭导出弹窗
$('#closeExport').on('click', function() {
	$('#exporDiv').hide();
});
//关闭商品详情弹窗
$('#closeDetil').on('click', function() {
	$('#goodDetilDiv').hide();
});

//点击详情按钮
$('#goodsList').on('click', '.goodsDetil',function() {
	var goodId = $(this).attr('data-good-id');
	if(!goodId){
		hintShow('hint_e','操作失败！');
		return;
	}
	$.post('?r=Pdsgoods/GetGoodDetil',{goodId: goodId},function(data){
		if(data){
			//绑定数据显示
			$('#detGoodName').text(data.product_name);
			$('#detEnName').text(data.english_name);
			$('#goodsDet').text(data.product_description);
			$('#detMarketPrice').text(data.market_price);
			$('#detPurPrice').text(data.purchase_price);
			$('#detRetPrice').text(data.retail_price);
			$('#detLogistics').text(data.logistics);
			$('#detCost').text(data.cost);
			$('#detSaleLink').html(data.sales_link);
			$('#detPurLink').html(data.purchase_link);
			$('#detAddInfo').html(data.username +"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+ data.createtime);
			$('#arraign').attr('data-good-id',goodId);
			$('#collect').attr('data-good-id',goodId);
			//每次查看详情，都要初始化图片
			$('#pictures').find('li').remove();
			//如果图片存在则以节点方式插入并显示
			if(data.picture){
				//图片的模板
				var pictureTem='';
				//图片的数量
				var pictureNumber=data.picture.length;
				for(var i=0;i<pictureNumber;i++){
					pictureTem += '<li><img src="'+data.picture[i]+'" alt="" /></li>';
				}
				$('#pictures').append(pictureTem);
			}
			$('#goodDetilDiv').show();
		}else{
			hintShow('hint_e','操作失败！');
			return;
		}
	});
});

//点击收藏
$('body').on('click','.collectGood', function() {
	var $this = $(this);
	var goodId = $this.attr('data-good-id');
	if (!goodId) {
		hintShow('hint_e','收藏失败！');
		return;
	}
	$.post('?r=Pdsgoods/CollectGood', {goodId: goodId}, function(data){
		if(data.result === 'error'){
			hintShow('hint_e','收藏失败！');
			return;
		}
		if(data.result === 'power'){
			hintShow('hint_w','没有权限操作');
			return;
		}
		if(data.result === 'collected'){
			hintShow('hint_w','你已经收藏了该商品');
			return;
		}
		if(data.result === 'succeed'){
			hintShow('hint_s','收藏成功！');
			//当前的收藏量
			var collectNum = $('#enname'+goodId).parents('tr').find('.coll1').text();
			//收藏后的收藏量
			collectNum = parseInt(collectNum)+1;
			$('#enname'+goodId).parents('tr').find('.coll1').text(collectNum);
			$('#goodDetilDiv').hide();
		}
	});
});

//点击提审按钮
$('body').on('click','.deliverGood',function(){
	var $this = $(this);
	var goodId = [$this.attr('data-good-id')];	
	if(!goodId){
		hintShow('hint_e','提审失败！');
		return;
	}
	$.post('?r=Pdsgoods/DeliverGood',{goodid: goodId},function(data){
		if(data.result === 'power'){
			hintShow('hint_w','没有权限操作');
			return;
		}
		if(data.result === 'arraigned'){
			hintShow('hint_w','你已提审过该商品');
			return;
		}
		if(data.result === 'error'){
			hintShow('hint_e','提审失败！');
			return;
		}
		if(data.result === 'overweeks'){
			hintShow('hint_w','已超过一周可以提审的商品数');
			return;
		}
		if(data.result === 'overdays'){
			hintShow('hint_w','已超过该商品的提审次数');
			return;
		}
		if(data.result === 'succeed'){
			hintShow('hint_s','提审成功！');
			//当前的提审量
			var arraignNum = $('#enname'+goodId).parents('tr').find('.coll2').text();
			//提审后的提审量
			arraignNum = parseInt(arraignNum)+1;
			$('#enname'+goodId).parents('tr').find('.coll2').text(arraignNum);
			$('#goodDetilDiv').hide();
		}
	});
});

//保存删除图片的路径信息的数组
var delImgArr = [];
//图片上传
var img_id_upload =[]; //初始化数组，存储已经上传的图片名
var imgI = 0; //初始化数组下标
var aaa;
$(function() {
	$('#file_upload').uploadify({
		'auto': true, //打开自动上传
		'removeTimeout': 0, //文件队列上传完成1秒后删除
		'width':80,
		'height':25,
		'swf': 'public/template/img/uploadify.swf',
		//'cancelImg': 'public/template/img/uploadify-cancel.png', 
		'uploader': '?r=Pdsgoods/Upload', //
		'method': 'post', //方法，服务端可以用$_POST数组获取数据
		'buttonText': '选择图片', //设置按钮文本
		'multi': true, //允许同时上传多张图片
		'uploadLimit':  5, //一次最多只允许上传5张图片
		'fileTypeDesc': 'Image Files', //只允许上传图像
		'fileTypeExts': '*.gif;*.jpg;*.png', //限制允许上传的图片后缀
		'fileSizeLimit': '4MB', //限制上传的图片不得超过4M 
		'onUploadSuccess': function(file, data, response) { //每次成功上传后执行的回调函数，从服务端返回数据到前端
			img_id_upload[imgI] = data;
			imgI++;
			$('<li><i title="点击移除"></i><img src="' + data + '"></li>').appendTo('#fileQueue');
				aaa+=file.id;
		},
		'onQueueComplete': function(queueData) { //上传队列全部完成后执行的回调函数
		}
	});
	$fileQueue.on('click','i',function(){
		var $this=$(this);
		var thisIndex=$('#fileQueue i').index($this);
		delImgArr.push($this.parent('li').find('img').attr('src'));
		$this.parent('li').remove();
		img_id_upload.splice(thisIndex,1);
		$('#file_upload').uploadify('cancel','SWFUpload_0_0');
	})
});

//点击提交按钮，新增商品或编辑商品
var purchasePriceStr = '';
$('#addGoodInfo').on('click',function(){
	//验证金钱格式的正则表达式
	var regPrice = /^(([1-9]\d*)|\d)(\.\d{1,2})?$/;
	//验证英文名字的正则表达式
	var regEnglish = /^[A-Za-z\d]+$/;
	//验证URL的正则表达式
	var regUrl = /(\S+)$/;
	var logistics='';
	var imgInfo=[];
		$fileQueue.find('img').each(function(index,item){
			imgInfo.push($(item).attr('src'));
		});
	var goodId = $editGoodId.val();
	var operateGood = $('#operateGood').text();
	var productName = $productName.val();
	var EnName = $EnName.val();
	var checkEnName = regEnglish.test(EnName);
	var remark = $remark.val();
	var goodRetil = $goodRetil.val();
	var marketPrice = $marketPrice.val();
	var checkMarketPrice = regPrice.test(marketPrice);
	var smallPurchasePrice = $smallPurchasePrice.val();
	var bigPurchasePrice = $bigPurchasePrice.val();
	var checkSmallPurchasePrice = regPrice.test(smallPurchasePrice);
	var retailPrice = $retailPrice.val();
	var checkRetailPrice = regPrice.test(retailPrice);
	var cost = $cost.val();
	var checkCost = regPrice.test(cost);
	var wuliuObj = $('#logistics input[type="checkbox"]:checked');
	var wuliuObjlen=wuliuObj.length;
	for(var i = 0;i < wuliuObjlen;i++){
		logistics += wuliuObj.eq(i).val()+',';
	}
	var logLen=logistics.length-1;
	logistics = logistics.substring(0,logLen);
	var logisticsNew=logistics.substring(0,logLen); //截取掉字符串最后一位逗号
	//对新增或编辑产品信息进行过滤
	productName =  productName.replace(/[ ]/g,"");
	remark =  remark.replace(/[ ]/g,"");
	goodRetil =  goodRetil.replace(/[ ]/g,"");
	//验证产品名称不能为空
	if(productName==''){
		hintShow('hint_e','产品名称不能为空');
		return;
	}
	//验证英文名称不能为空
	if(EnName==''){
		hintShow('hint_e','英文名称不能为空');
		return;
	}
	//英文名称不符合格式会提示且不能提交
	if(!checkEnName){
		hintShow('hint_e','英文名称只能是字母');
		return;
	}
	//验证产品介绍不能为空
	if(goodRetil==''){
		hintShow('hint_e','产品介绍不能为空');
		return;
	}
	//验证新增时产品图片最多不能超过5张
	if(imgInfo.length > 5){
		hintShow('hint_e','产品图片不能多于5张');
		return;
	}
	//验证新增时产品图片不能为空
	if(imgInfo.length==0){
		hintShow('hint_e','请选择产品图片');
		return;
	}
	//验证市场价不能为空
	if(marketPrice==''){
		hintShow('hint_e','市场价不能为空');
		return;
	}
	//采购价不能为空
	if(smallPurchasePrice==''){
		hintShow('hint_e','采购价不能为空');
		return;
	}
	//验证建议售价不能为空
	if(retailPrice==''){
		hintShow('hint_e','建议售价不能为空');
		return;
	} 
	//验证物流建议不能为空 
	if(logisticsNew==''){
		hintShow('hint_e','物流建议至少选一个');
		return;
	}
	//验证运费估算不能为空
	if(cost==''){
		hintShow('hint_e','运费估算不能为空');
		return;
	}
	//市场价不符合格式会提示且不能提交
	if(!checkMarketPrice){
		hintShow('hint_e','市场价格只能是数字且最多只能带两位小数');
		return;
	}
	//采购价不符合格式会提示且不能提交
	if(!checkSmallPurchasePrice){
		hintShow('hint_e','采购价只能是数字且最多只能带两位小数');
		return;
	}
	if(bigPurchasePrice != ''){
		smallPurchasePrice = parseFloat(smallPurchasePrice);
		bigPurchasePrice = parseFloat(bigPurchasePrice);
		//规定采购价的范围
		if(smallPurchasePrice >= bigPurchasePrice){
			hintShow('hint_e','采购价的范围有误，请重新输入！');
			return;
		}
		purchasePriceStr = smallPurchasePrice +'~'+ bigPurchasePrice;
		var checkBigPurchasePrice = regPrice.test(bigPurchasePrice);
		if(!checkBigPurchasePrice){
			hintShow('hint_e','采购价只能是数字且最多只能带两位小数');
			return;
		}
	}else{
		purchasePriceStr = smallPurchasePrice;
	}
	//建议售价不符合格式会提示且不能提交
	if(!checkRetailPrice){
		hintShow('hint_e','建议售价只能是数字且最多只能带两位小数');
		return;
	}
	//运费估算不符合格式会提示且不能提交
	if(!checkCost){
		hintShow('hint_e','运费估算只能是数字且最多只能带两位小数');
		return;
	}
	var saleLink = [];
	$('.sellLink :input').each(function(index,item){
		if($.trim($(item).val())!=''){
			saleLink.push($(item).val());
		}
	});
	for(var a=0;a<saleLink.length;a++){
		if(!regUrl.test(saleLink[a])){
			hintShow('hint_e','销售链接格式不正确，请重新输入！');
			return;
		}
	}
	var purchaseLink = [];
	$('.buyLink :input').each(function(index,item){
		if($.trim($(item).val())!=''){
			purchaseLink.push($(item).val());
		}
	});
	for(var b=0;b<purchaseLink.length;b++){
		if(!regUrl.test(purchaseLink[b])){
			hintShow('hint_e','采购链接格式不正确，请重新输入！');
			return;
		}
	}
	var urlValue = {productname: productName,enname: EnName,remark: remark,goodretil: goodRetil,marketprice: marketPrice,
			imgurl: imgInfo,purchaseprice: purchasePriceStr,retailprice: retailPrice,cost: cost,salelink: saleLink,
			purchaselink: purchaseLink,logistics: logisticsNew};
	if(!goodId){
		$.post('?r=Pdsgoods/AddGoods',urlValue,function(data){
			if(data.result === 'power'){
				hintShow('hint_w','没有权限操作');
				return;
			}
			if(data.result === 'error'){
				hintShow('hint_e','添加失败！');
				return;
			}
			if(data.result === 'exited'){
				hintShow('hint_e','该产品已存在，请重新输入！');
				return;
			}
			if(data.result === 'succeed'){
				$('#addGoodDiv').hide();
				img_id_upload=[];
				hintShow('hint_s','添加成功！');
				$.post('?r=Pdsgoods/GetGoodsList',function(data){
					listData(data);
				})
			}
		});
	}else{
		imgInfo=[];
		$fileQueue.find('img').each(function(index,item){
			imgInfo.push($(item).attr('src'));
		});
		var oldEditGoodId = $editGoodId.data('editGoodId');
		var oldProductName = $productName.data('productName');
		var oldEnName = $EnName.data('EnName');
		var oldGoodRetil = $goodRetil.data('goodRetil');
		var oldMarketPrice = $marketPrice.data('marketPrice');
		var oldSmallPurchasePrice = $smallPurchasePrice.data('smallPurchasePrice');
		var oldBigPurchasePrice = $bigPurchasePrice.data('bigPurchasePrice');
		var oldRetailPrice = $retailPrice.data('retailPrice');
		var oldCost = $cost.data('cost');
		var oldSaleLink = $saleLink.data('saleLink');
		var oldPurchaseLink = $purchaseLink.data('purchaseLink');
		var oldRemark = $remark.data('remark');
		var oldLogistics=$logistics.data('logistics');
		var oldPicture=$fileQueue.data('fileQueue');
		urlValue = {goodid: goodId,productname: productName,enname: EnName,goodretil: goodRetil,marketprice: marketPrice,
				imgurl: imgInfo,purchaseprice: purchasePriceStr,retailprice: retailPrice,cost: cost,salelink: saleLink,
				purchaselink: purchaseLink,remark: remark,logistics: logisticsNew,delImg: delImgArr} ;
		//验证编辑时产品图片最多不能超过5张
		if(imgInfo.length > 5){
			hintShow('hint_e','产品图片不能多于5张');
			return;
		}
		//验证编辑时产品图片不能为空
		if(imgInfo.length==0){
			hintShow('hint_e','产品图片不能为空');
			return;
		}
		//记录编辑前的图片和编辑后的图片相同的数量
		var pictureEqualNum = 0;
		//按提交按钮，若编辑内容没有任何修改，则弹框
		if(oldEditGoodId == goodId && oldProductName == productName && oldEnName == EnName && oldGoodRetil == goodRetil && oldMarketPrice == marketPrice && oldSmallPurchasePrice == smallPurchasePrice && oldBigPurchasePrice == bigPurchasePrice && oldRetailPrice == retailPrice && oldCost == cost && oldSaleLink == saleLink && oldPurchaseLink == purchaseLink && oldRemark == remark && oldLogistics == logisticsNew){
			//编辑前的图片的数量
			var oldPictureLength = oldPicture.length;
			//编辑后的图片的数量
			var imgInfoLength = imgInfo.length;
			if(oldPictureLength == imgInfoLength){
				for(var a=0;a<oldPicture.length;a++){
					for(var b=0;b<imgInfo.length;b++){
						if(oldPicture[a] == imgInfo[b]){
							pictureEqualNum++;
						}
					}
				}
				if(pictureEqualNum == oldPictureLength){
					hintShow('hint_w','没有任何操作');
					return;
				}
			}
		}
		$.post('?r=Pdsgoods/EditGoods',urlValue,function(data){
			if(data.result === 'power'){
				hintShow('hint_w','没有权限操作');
				return;
			}
			if(data.result === 'error'){
				hintShow('hint_e','修改失败！');
				return;
			}
			if(data.result === 'exited'){
				hintShow('hint_e','该产品已存在，请重新输入！');
				return;
			}
			if(data.result === 'succeed'){
				$('#productName' + goodId).text(productName);
				$('#enname' + goodId).text(EnName);
				$('#marketPrice' + goodId).text(marketPrice);
				$('#purchasePrice' + goodId).text(purchasePriceStr);
				$('#retailPrice' + goodId).text(retailPrice);
				$('#logistics' + goodId).text(logistics);
				$('#logistics' + goodId).parents('tr').find('.imgTd').find('img').remove();
				var pictureStr = '<img src="'+ imgInfo[0] +'" id="imgName'+ goodId +'">';
				$('#logistics' + goodId).parents('tr').find('.imgTd').append(pictureStr);
				hintShow('hint_s','修改成功！');
				$('.TCBody').removeData(data);
				$('#addGoodDiv').hide();
			}
		});
	}
});

//点击编辑按钮，显示需要编辑的商品信息
var pictureArr = [];
$('#goodsList').on('click','.editGood',function(){
	pictureArr = [];
	$('small').remove();
	$('.sellLink p[on!="true"]').remove();
	$('.buyLink p[on!="true"]').remove();
	var goodId = $(this).attr('data-good-id');
	if(!goodId){
		hintShow('hint_e','操作失败！');
		return;
	}
	$.post('?r=Pdsgoods/GetGoodDetil',{goodId: goodId},function(data){
		if(data){
			//绑定数据显示
			$editGoodId.val(goodId);
			$editGoodId.data('editGoodId',$editGoodId.val());
			$productName.val(data.product_name);
			$productName.data('productName',$productName.val());
			$EnName.val(data.english_name);
			$EnName.data('EnName',$EnName.val());
			$goodRetil.val(data.product_description);
			$goodRetil.data('goodRetil',$goodRetil.val());
			$marketPrice.val(data.market_price);
			$marketPrice.data('marketPrice',$marketPrice.val());
			$smallPurchasePrice.val(data.purchasePriceArr[0]);
			$smallPurchasePrice.data('smallPurchasePrice',$smallPurchasePrice.val());
			$bigPurchasePrice.val(data.purchasePriceArr[1]);
			$bigPurchasePrice.data('bigPurchasePrice',$bigPurchasePrice.val());
			$retailPrice.val(data.retail_price);
			$retailPrice.data('retailPrice',$retailPrice.val());
			$logistics.val(data.logistics);
			$logistics.data('logistics',$logistics.val());
			var logisticsArr = data.logistics.split(',');
			//每次点击编辑都要初始化物流建议
			$('#logistics input[type="checkbox"]').prop('checked', false);
 			$('#logistics input[type="checkbox"]').each(function(index,item){
 				$(logisticsArr).each(function(j,obj){
 					if(obj==$(item).val()){
 						$(item).prop('checked',true);
 					}
 				});	
 			});
			$cost.val(data.cost);
			$cost.data('cost',$cost.val());
			var sl = data.sales_linkArr.length;
			var pl = data.purchase_linkArr.length;
			for(var i = 0;i < sl;i++){
				if(i == 0){
					$saleLink.val(data.sales_linkArr[0]);
				}else{
					$('.sellLink').append('<p class="sell"><input type="text" class="inp350" value="'+data.sales_linkArr[i]+'"/><span class="linkFont">删除</span></p>');
				}
			}
			$saleLink.data('saleLink',data.sales_links);
			for(var i = 0;i < pl;i++){
				if(i == 0){
					$purchaseLink.val(data.purchase_linkArr[0]);
				}else{
					$('.buyLink').append('<p class="buy"><input type="text" class="inp350" value="'+data.purchase_linkArr[i]+'"/><span class="linkFont">删除</span></p>');
				}
			}
			$purchaseLink.data('purchaseLink',data.purchase_links);
			$remark.val(data.remark);
			$remark.data('remark',$remark.val());
			$('#operateGood').text('编辑商品');
			//每次点击编辑都要初始化图片
			$fileQueue.find('li').remove();
			if(data.picture){
				var $pictureLength = data.picture.length;
				var pictureStr = '';
				for(var i = 0; i < $pictureLength; i++){
					pictureStr += '<li><i title="点击移除"></i><img class="oldPicture" src="' + data.picture[i] + '"></li>';
					var oldPicture = data.picture[i];
					pictureArr.push(oldPicture);
				}
				$fileQueue.data('fileQueue',pictureArr);
				$(pictureStr).appendTo('#fileQueue');
			}
			$('#addGoodDiv').show();
		}else{
			hintShow('hint_e','操作失败！');
		}
	});
});

/**
 * @desc 点击搜索产品名称和英文名给隐藏的文本框赋值
 * @author Guanghua Chen
 * @date 2015-7-2
 */
$('.searchValue').on('click',function(){
	var value = $(this).val();
	$('#searchtypeval').val(value);
});

/**
 * @desc 点击搜索按钮，进行搜索
 * @author Guanghua Chen
 * @date 2015-7-2
 */
$('#search_btn').on('click',function(){
	var keyword = $('#keyword').val();
	var searchType = $('#searchtypeval').val();
	var startTime = $('#searchStime').val();
	var endTime = $('#searchEtime').val();
	$.post('?r=Pdsgoods/GetGoodsList',{type: searchType,k: keyword,stime: startTime,etime: endTime},function(data){
		listData(data);
	});
});

/**
 * @desc 删除单个商品
 * @author Renzhi Liao
 * @param false | 添加代码
 * @date 2015-06-05
 */
$('#goodsList').on('click','.delGood',function(){
	var $this = $(this);
	var arr = [];
	var makeSure = confirm('您确定要删除这个商品?');
	if(makeSure){
		var goodId = $this.attr('data-good-id');
		arr.push(goodId);
		$.post('?r=Pdsgoods/DelGoods',{data : arr},function(data){
			if(data.result === 'power'){
				hintShow('hint_w','没有权限操作');
				return;
			}
			if(data.result === 'false'){
				hintShow('hint_e','删除失败！');
				return;
			}
			if(data.result === 'succeed'){	
				hintShow('hint_s','删除成功！');
				//删除成功刷新列表
				$.post('?r=Pdsgoods/GetGoodsList',function(data){
					listData(data);
				})
			}
		})
	}
});

/**
 * @desc 批量删除全中商品
 * @author Renzhi Liao
 * @param false | 添加代码
 * @date 2015-06-05
 */
//批量全中商品
allCheckBoxFun($('.allchecked :checkbox'),$('#goodsList'));
$('.icon-del').parent().on('click',function(){
	var $this = $('#goodsList :checkbox:checked');
	if($this.length == 0){
		hintShow('hint_w','请勾选要删除的物品');
		return;
	}
	var makeSure = confirm('您确定要删除这些商品?');
	if(makeSure){
		var IDAttr = [];
		var $objHeight = $this.length;
		for (var i = 0; i < $objHeight; i++) {
			IDAttr.push($this.eq(i).attr('value'));
		}
		$.post('?r=Pdsgoods/DelGoods',{data : IDAttr},function(data){
			if(data.result === 'power'){
				hintShow('hint_w','没有权限操作');
				return;
			}
			if(data.result === 'false'){
				hintShow('hint_e','删除失败！');
				return;
			}
			if(data.result === 'succeed'){	
				hintShow('hint_s','删除成功！');
				//删除成功刷新列表
				$.post('?r=Pdsgoods/GetGoodsList',function(data){
					listData(data);
				})
			}
		})
	}
});

/**
 * @desc 商品指派人弹窗
 * @author Renzhi Liao
 * @date 2015-06-08
 */
var arrGoodId = '';
var sources = [];  //存储初始source
var oldUsername = [];  //存储初始username
$('.table').on('click','.assignGood',function(){
	arrGoodId = $(this).attr('data-good-id');
	$.post('?r=Pdsgoods/FindMember',{id : arrGoodId},function(data){
		if(data){
			for(var i=0;i<data.length;i++){
				sources.push(data[i].source);
				oldUsername.push(data[i].username);
				$('.nameShow').append('<span class="nameCard" on="true"><b sourced="'+data[i].source+'" uesrid="'+data[i].user_id+'">'+data[i].username+'</b><i>删除</i></span>');
			}
		}
	})
	//清空所添加的内容
	$('.nameCard').remove();
	$('#search').attr('value','');
	$('#show').hide();
	$('#show').children('li').remove();
	oldUsername = [];
	dsnFun($(this));
})

/**
 * @desc 点击取消后，关闭指派弹窗
 * @author Renzhi Liao
 * @date 2015-06-08
 */
$('#btnf').on('click',function(){
	$('.nameShow').empty();
	$('.dsnBox').css({display:"none"});
});

/**
 * @desc 输入名字后，模糊搜索销售指派人
 * @author Renzhi Liao
 * @date 2015-06-08
 */
$('#search').on('keyup',function(){
	var arr = [];
	//获取已提审人的名单数组
	var num = $('.nameCard b').each(function(index,item){
		arr.push($(item).text());
	});
	var con = $('.inpSel input').val();
	con = $.trim(con);
	if(con === ''){
		$('#show').empty();
		return false;
	}
	$.post('?r=Pdsuser/SearchMember',{name : con},function(data){
		if(data){
			$('#show').empty();
			for(var i=0;i<data.length;i++){
				//循环输出时与已提审人名单对比，若已提审的人存在则在相应li添加属性on="false"
				if($.inArray(data[i].username,arr)>=0){    
					$('#show').append('<li on="false" uesrid="'+data[i].user_id+'">'+data[i].username+'</li>');	
				}else{
					$('#show').append('<li uesrid="'+data[i].user_id+'">'+data[i].username+'</li>');
				}
			$('#show').show();
			}
		}
	})
});

/**
 * @desc 点击添加搜索到的指派人
 * @author Renzhi Liao
 * @date 2015-06-08
 */
$('#show').on('click','li',function(){
	var $this = $(this); 
	var id = $this.attr('uesrid');
	var thisOn=$this.attr('on');
	if(thisOn=='true'||thisOn==undefined){
		var text = $(this).text();
		$('.nameShow').append('<span class="nameCard" on="true"><b uesrid="'+id+'">'+text+'</b><i>删除</i></span>');
	}else{
		hintShow('hint_w','此人员已选！');
	}
	//选中后的人，不能再操作
	$this.attr('on','false');
	$('#show').hide();
});

/**
 * @desc 删除指派人
 * @author Renzhi Liao
 * @date 2015-06-08
 */
$('.nameShow').on('click','.nameCard',function(){
	var thisText = $(this).children('b').text();
	$('#show li').each(function(index,item){
		if($(item).text()==thisText){
			//删除后的人，恢复可添加功能
			$(item).attr('on','true');
		}
	});
	$(this).remove();
});

/**
 * @desc 点击确认后，添加已显示的指派人
 * @author Renzhi Liao
 * @date 2015-06-09
 */
var haveUser = '';
$('#btns').on('click',function(){
	var arrUsername = [];
	var arrUserId = [];
	$('.nameCard').children('b').each(function(index,item){
		arrUsername.push($(item).text());
	});
	$('.nameCard').children('b').each(function(index,item){
		arrUserId.push($(item).attr('uesrid'));
	});
	$.post('?r=Pdsgoods/AddUser',{username : arrUsername,uesrid : arrUserId,goodid : arrGoodId,source : sources,oldusername : oldUsername},function(data){
		if(data.result === 'power'){
			hintShow('hint_w','没有权限操作');
			return;
		}
		if(data.result === 'false'){
			hintShow('hint_e','指派失败！');
			$('.dsnBox').hide();
			return;
		}
		if(data.result === 'arraigned'){
			hintShow('hint_w','您无任何操作！');
			$('.dsnBox').hide();
			return;
		}
		if(data.result === 'succeed'){	
			$('.nameShow').empty();
			$('.dsnBox').css({display:"none"});
			hintShow('hint_s','指派成功！');
		}
	});
});

/**
 * @desc 点击导出按钮，导出商品列表信息
 * @author Guanghua Chen
 * @date 2015-6-11
 */
$('#exporGoodList').on('click',function(){
	var startTime = $('#startTime').val();  //开始时间
	var endTiem = $('#endTime').val();	  //结束时间
	var type = [];  //搜索项数组
	$('#searchCheck :checkbox:checked').each(function(index,item){
		type.push($(item).val());
	});
	if(type.length === 0){
		hintShow('hint_w','请选择需要导出项');
			return;
	}
	$.post('?r=Pdsgoods/ExporExcel',{stime: startTime,etime: endTiem,type: type},function(data){
		if(data.result === 'power'){
			hintShow('hint_w','没有权限操作');
			return;
		}
		if(data.result === 'nulldate'){
			hintShow('hint_w','暂时没有可以导出的数据');
			return;
		}
		if(data.result === 'error'){
			hintShow('hint_e','导出失败！');
			return;
		}
		if(data.result === 'succeed'){
			idownload(data.url);
		}		
	});	
});

function idownload(url){
	var i = document.createElement('iframe');
	i.style.display = 'none';
	i.name = 'idownload_iframe';
	i.src = url;
	document.body.appendChild(i);
	setTimeout(function(){
		$("iframe[name='idownload_iframe']").remove();
	},5000);
};

/**
 * @desc 增加了 添加和删除销售、采购链接框的效果
 * @author Renzhi Liao
 * @date 2015-06-18
 */
//添加销售链接
$('#saleLink + span').on('click',function(){
	var texts = $('#saleLink').val();
	if($.trim(texts)==''){
		hintShow('hint_w','请填写完第一条后再继续添加');
		return;
	}
	$('#saleLink').parents('.rightVal').append('<p class="sell"><input type="text" class="inp350" /><span class="linkFont">删除</span></p>');
})

//删除销售链接
$('.rightVal').on('click','.sell span',function(){
	$(this).parent('.sell').remove();
})

//添加采购链接
$('#purchaseLink + span').on('click',function(){
	var textd = $('#purchaseLink').val();
	if($.trim(textd)==''){
		hintShow('hint_w','请填写完第一条后再继续添加');
		return;
	}
	$('#purchaseLink').parents('.rightVal').append('<p class="buy"><input type="text" class="inp350" /><span class="linkFont">删除</span></p>');
})

//删除采购链接
$('.rightVal').on('click','.buy span',function(){
	$(this).parent('.buy').remove();
})