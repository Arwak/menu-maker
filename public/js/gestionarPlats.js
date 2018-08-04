
function new_dish() {
    $.ajax(
        {
            url: "/save_dish",
            data: $("#dish_info").serialize(),
            success: function(result){
                alert(result);
            }
        });
    document.getElementById("dish_info").submit();

}