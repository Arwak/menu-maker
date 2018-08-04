
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




function search() {

    var input, filter, dish_list, li, a, i;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    dish_list = document.getElementById("dish_list");
    li = dish_list.getElementsByTagName('li');


    for (i = 1; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
