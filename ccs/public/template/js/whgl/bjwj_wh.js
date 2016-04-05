$(function(){
    var bookName = $('#bookName'); //问卷名称对象
    var bookIntroduce = $('#bookIntroduce'); //问卷介绍对象
    //编辑问卷
    $('body').on('click','#editBook',function(){
        var bookid = $('#bookId').val();
        var bookNameVal = bookName.val();
        var bookIntroduceVal = bookIntroduce.val();
        if(bookNameVal.length > 20){
            alert('问卷名称不能超过20个字');
            return;
        }
        if(bookIntroduceVal.length > 200){
            alert('问卷介绍不能超过200个字');
            return;
        }
        $.post('index.php?r=whgl/UpdateBookMsg',{bookId:bookid,bookName:bookNameVal,bookIntroduce:bookIntroduceVal},function(data){
            if(data){
                if(data.res == 'success'){
                    alert(data.msg);
                    window.location.href="index.php?r=whgl/GetWjlbHtml";
                    return;
                }
                if(data.res == 'error'){
                    alert(data.msg);
                    return;
                }
            }
        },'json');
    });

});