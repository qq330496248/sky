$(function(){
	//数据库备份
	$('#dataBcakup').on('click',function(){
		window.location.href="index.php?r=DataBack/Backup";
	});

	//数据库清理
	$('#delDataBcak').on('click',function(){
		var ensure = confirm('你确定要进行数据库清理吗？');
		if(ensure){
			$.post('index.php?r=DataBack/DelBack',function(data){
				if(data){
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
		}
	});

});

//判断上传文件是否为空
function checkExist(str){
    var s = $("#"+str).val();
    if(s == ''){
      alert("上传文件不能为空");
      return false;
    }
    return true;
}
