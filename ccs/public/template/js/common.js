//公用方法封装
/**
 * @descr 多选框全选(全不选)方法
 * @param {Object} obj1 参数1为表格里全选的多选框 [单个]
 * @param {Object} obj2 参数2为表格内容里边的所有多选框 [多个]
 * @author WuJunhua
 * @date 2015-11-05
 * 如：checkAll($('#checkall'),$('.checkbox'));
 */
function checkAll(obj1,obj2){
	$(obj1).on('click',function(){
		if(obj1.prop('checked')){
			obj2.each(function(a,b){
      			$(b).prop('checked',true);
			});
		}else{
			obj2.each(function(a,b){
      			$(b).prop('checked',false);
			});
		}
	});
}

//jsonp 跨域：
function jsonp(url,func){
	var m_script = $('<script>');
	var temp = 'jsonp_' + Math.ceil(Math.random() * 1000000);
	var path = url + '&' + 'callback=' + temp;
	m_script.attr('src',path);
	window[temp] = func;
	$('body').append(m_script);
}

/* 正则表达式 */
//只能输入数字的验证
var regNumber = /^[0-9]*$/;
//身高体重验证
var regHeightWeight = /^[0-9]+(.[0-9]{1,2})?$/;
//手机号验证
var regMobliePhone = /^0?1[3|4|5|8][0-9]\d{8}$/;
//电话验证(支持手机号码，3-4位区号，7-8位直播号码，1-4位分机号)
var regPhone = /^1\d{10}$|^(0\d{2,3}-?|\(0\d{2,3}\))?[1-9]\d{4,7}(-\d{1,8})?$/;
//电子邮箱验证
var regEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//金额验证
var regMoney = /^[0-9]+(.[0-9]{1,2})?$/;
//商品款号验证
var regGoodNumber = /^\+?[1-9][0-9]*$/;

//导出excel方法
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