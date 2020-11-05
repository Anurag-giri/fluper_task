 const getState = (e) => {
    var items = "";
    $("#state").html('');
        $.get("sql.php",{id:e.value,fn:'getStateCityOrVill',selection:'state',wheres:'country_id'}, function(data, status){
            if(JSON.parse(data).length > 0) {
                $.each(JSON.parse(data), function(i,item) {
                    items += "<option value="+item.id+">" + item.state_name + "</option>";
                });
                $("#state").html(items);
                $('.state').show();
            } else {
                $('#city').html(' ');
                $('#village').html(' ');
                $('#city').append(`<option value=""> Select City </option>`);
                $('#state').append(`<option value=""> Select City </option>`);
            }
            
    });
}

const getCity = (e) => {
    var items="";
    $("#city").html('');
    $.get("sql.php",{id:e.value,fn:'getStateCityOrVill',selection:'city',wheres:'state_id'}, function(data, status){
        if(JSON.parse(data).length > 0) {
            $.each(JSON.parse(data), function(i,item) {
                items += "<option value="+item.id+">" + item.city_name + "</option>";
            });
            $("#city").html(items);
            $('#state').selectpicker('refresh');
        } else {
            $('#city').append(`<option value=""> Select City </option>`);
        } 
    });
}

const getVillage = (e) => {
    var items="";
    $("#village").html(' ');
    $.get("sql.php",{id:e.value,fn:'getStateCityOrVill',selection:'village',wheres:'city_id'}, function(data, status){
        if(JSON.parse(data).length > 0) {
            console.log(data)
            $.each(JSON.parse(data), function(i,item) {
                items += "<option value="+item.id+">" + item.village_name + "</option>";
            });
            $("#village").html(items);
        } 
    });
}