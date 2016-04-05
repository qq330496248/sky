$(function(){
	$.post("index.php?r=flbb/GetGhkhstjbb",function(data){
		getTable(data);
	},"json");
});


function getTable(data){
	if(data.result == 'success'){
		$("#ghkhstjbb").empty();
		$("#tfoot").empty();

		var length = data.list.length;
		for(var i = 0; i < length; i += 2){
			var listInfo = '<tr class="singular">'
							+'<td><span>'+ data.list[i]['username'] +'</span></td>'
							+'<td><span>'+ data.list[i]['personname'] +'</span></td>'
							+'<td><font style="color:#0000FF">'+ data.list[i]['num'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i]['ratio'] +'</font></td></tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex">'
							+'<td><span>'+ data.list[i+1]['username'] +'</span></td>'
							+'<td><span>'+ data.list[i+1]['personname'] +'</span></td>'
							+'<td><font style="color:#0000FF">'+ data.list[i+1]['num'] +'</font></td>'
							+'<td><font style="color:#FF0000">'+ data.list[i+1]['ratio'] +'</font></td></tr>';
			}
			$("#ghkhstjbb").append(listInfo);
		}
		var tfoot = '<tr>'
					+'<th colspan="2">总计</th>'
					+'<th><font style="color:#0000FF">'+ data.totalNum +'</font></th>'
					+'<th></th></tr>';
		$("#tfoot").append(tfoot);
	}
}


function getGhkhstjbb(sign){
	var dept = $("#dept").val();
	var level = $("#level").val();
	var khyx = $("#khyx").val();
	var media = $("#media").val();

	if(sign == 1){
   		$.get('index.php?r=flbb/GetGhkhstjbb',{dept:dept,level:level,khyx:khyx,media:media,sign:sign},function(data){
	        if(!data){
	            return;
	        }
        	if(data.result == 'error'){
				alert(data.msg);
				return;
			}
			if(data.result == 'exportExcel'){
				idownload(data.url);
				//导出excel成功后，要清除服务器上的xls文件
				$.post('index.php?r=xtsz/DeleteExcelFile',{url:data.url},function(data){

				});
			}	
	    });
   }else{
   		$.ajax({
            type: "post",
            url: "index.php?r=flbb/GetGhkhstjbb",
            async: true,
            dataType: "json",
            data: {dept:dept,level:level,khyx:khyx,media:media,sign:sign},
            success: function(data){
                if(!data){
                    return;
                }
                getTable(data);
            }
        });
   }
}

/**
 * @desc 导出excel
 * @author WuJunhua
 * @date 2016-03-29
 */
 $('body').on('click','#exportExcel',function(){
 	var sign = 1; //导出excel标识
 	getGhkhstjbb(sign);	
 });