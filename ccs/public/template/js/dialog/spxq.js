$(function(){
    var goodid = $("#id").val();
    $.post('index.php?r=cpgl/GetGoodList',{goodid: goodid},function(data){
        if(!data){
            return;
        }
        if(data){
            $('#spkh').text(data.cpaa01);
            $('#spgg').text(data.cpaa10);
            $('#spmc').text(data.cpaa02);
            $('#xsj').text(data.cpaa06);
            $('#sptp').attr("src",data.cpaa13);
            $('#xxms').text(data.cpaa12);
        }
    });
});

function closeDialog(){
    parentDialog.close();
}