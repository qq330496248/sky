/**
 * @desc 客户的省市区三级联动【客户管理板块共用方法】
 * @author WuJunhua
 * @date 2015-10-22
 */
$(function(){
    var province = $('#province');
    var city = $('#city');
    var area = $('#area');
    //输出省份下面的城市
    province.on('change',function(){
        //初始化城市选项名
        city.find("option").remove();
        area.find("option").remove();
        city.append('<option value="0">选择市</option>');
        area.append('<option value="0">选择区/县</option>');
        var province_id = province.val();
        $.post('index.php?r=khgl/City',{provinceId: province_id},function(data){
            if(!data){
                return;
            }
            if(data.result == 'success'){
                $.each( data.cities, function(i, n){
                    city.append('<option name="city" value="'+i+'">'+n+'</option>')
                });
            }
        },"json")
    
    })

    //输出城市下面的区县
    city.on('change',function(){
        //初始化区县选项名
        area.find("option").remove();
        area.append('<option value="0">选择区/县</option>');
        var city_id = city.val();
        $.post('index.php?r=khgl/Area',{cityId: city_id},function(data){
             if(!data){
                return;
            }
            if(data.result == 'success'){
                $.each( data.areas, function(i, n){
                    area.append('<option name="area" value="'+i+'">'+n+'</option>')
                });
            }
        },"json")
    
    })

})