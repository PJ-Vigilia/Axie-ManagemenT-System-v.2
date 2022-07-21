$(document).ready(function(){
    fetchHome();

    function fetchHome(){
        $.ajax({
            type: "get",
            url: "/fetchHome",
            success: function(response){
                //console.log(response.home)
                $.each(response.home, function(key, item){
                    $('#tbl_home_tbody').append('\
                        <tr>\
                            <th scope="row">'+ item.acc_name +'</th>\
                            <td>'+ item.totalAxie +'</td>\
                            <td>'+ item.totalSLP +'</td>\
                            <td>'+ item.soldSLP +'</td>\
                        </tr>\
                    ');
                })
            }
        })
    }
})