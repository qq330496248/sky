$(function(){
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;
	var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();

	var begin = year + "-" + month + "-01";
	var end  = year + "-" + month + "-" + day;

	$("#xdsjq").val(begin);
	$("#xdsjz").val(end);

	$.post("index.php?r=flbb/GetMrckbb",function(data){
		getTable(data);
	},"json");
});

function getTable(data){
	if(data.result == 'success'){
		$("#mrckbb").empty();
//		$("#tfoot").empty();
		var length = data.list.length;
		for(var i = 0; i < length; i += 2){
			if(data.list[i]['jhsNum'] == null){
				data.list[i]['jhsNum'] = 0;
			}
			if(data.list[i]['chsNum'] == null){
				data.list[i]['chsNum'] = 0;
			}
			var listInfo = '<tr class="singular">'
							+'<td>'+ data.list[i]['cpkh'] +'</td>'
							+'<td>'+ data.list[i]['cpmc'] +'</td>'
							+'<td>'+ data.list[i]['kw'] +'</td>'
							+'<td>'+ data.list[i]['jhsNum'] +'</td>'
							+'<td>'+ data.list[i]['chsNum'] +'</td>'
							+'<td>'+ data.list[i]['zpkc'] +'</td>'
							+'<td>'+ data.list[i]['cpkc'] +'</td></tr>';
			if(i < length - 1){
				listInfo += '<tr class="complex">'
							+'<td>'+ data.list[i+1]['cpkh'] +'</td>'
							+'<td>'+ data.list[i+1]['cpmc'] +'</td>'
							+'<td>'+ data.list[i+1]['kw'] +'</td>'
							+'<td>'+ data.list[i+1]['jhsNum'] +'</td>'
							+'<td>'+ data.list[i+1]['chsNum'] +'</td>'
							+'<td>'+ data.list[i+1]['zpkc'] +'</td>'
							+'<td>'+ data.list[i+1]['cpkc'] +'</td></tr>';
			}
			$("#mrckbb").append(listInfo);
		}
	}
}


function getMrckbb(sign){
	var cpmc = $("#cpmc").val();
	var cpkh = $("#cpkh").val();
	var beginDate = $("#xdsjq").val();
	var endDate = $("#xdsjz").val();

	if(sign == 1){
   		$.get('index.php?r=flbb/GetMrckbb',{cpmc:cpmc,cpkh:cpkh,beginDate:beginDate,endDate:endDate,sign:sign},function(data){
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
            url: "index.php?r=flbb/GetMrckbb",
            async: true,
            dataType: "json",
            data: {cpmc:cpmc,cpkh:cpkh,beginDate:beginDate,endDate:endDate,sign:sign},
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
 	getMrckbb(sign);
 });