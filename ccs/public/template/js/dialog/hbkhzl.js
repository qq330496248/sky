
	var client = parent.document.getElementById("clientFont").value;
	$("#khzl1").html(client);


//查询客户资料
$('body').on('click','#searchClient',function(){
    var searchtype = $("input[name='search']:checked").val();
    var keyword = $('#keyword').val();
    // if (!keyword) {
    //     	alert('请输入查询条件');
    //     	return;
    //     }
    var strs= new Array(); //定义一数组
    strs=client.split(","); //字符分割 
    var clientno=strs[0];
	$.post('index.php?r=khgl/GetCustomer',{searchtype:searchtype,keyword:keyword,clientno:clientno},function(data){
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
     $('#getCommitMerger').on('click',function(){
        var searchtype = $("input[name='search']:checked").val();//客户id，手机，姓名
        var retaintype = $("input[name='retain']:checked").val();//保留客户1，保留客户1
        var keyword = $('#keyword').val();//查询条件
        var khzl1=$('#khzl1').text();//客户资料1
        var khzl2=$('#khzl2').text();//客户资料2
        var strs= new Array(); //定义一数组
        strs=client.split(","); //字符分割 
        var clientno=strs[0];
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
                    if (retaintype==1) {
                        parent.location.href="index.php?r=khgl/NewClientData&clientno="+clientno;
                    }
                    if (retaintype==2) {
                        alert(data.msg);
                        parent.location.href="index.php?r=khgl/GetWdkhzlHtml";
                    }
                }
            },'json')
        }
    });