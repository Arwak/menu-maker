
function new_dish() {
    $.ajax(
        {
            type: 'post',
            url: "/save_dish",
            data: $("#dish_info").serialize(),
            dataType:'JSON',
            success: function(result){
            alert(result.id);
            //<li onclick="load_dish({{ dish.get_id_Dish }})" class="w3-bar-item w3-button w3-red w3-hover-white"><a>{{ dish.get_alias }}</a></li>

              /*  var a = document.createElement("a");
                a.innerHTML = result.id;
                $("#dish_list").appendChild()*/
            }
        });
    //document.getElementById("dish_info").submit();

}

function load_dish(identifier) {
    $.ajax(
        {
            type: 'post',
            url: "/load_dish",

            data: 'id='+ identifier,
            dataType:'JSON',
            success: function(result){

                document.getElementById("alias").value = result.alias;
                document.getElementById("cat_name").value = result.languages[0].dish_name;
                document.getElementById("esp_name").value = result.languages[1].dish_name;
                document.getElementById("eng_name").value = result.languages[2].dish_name;

                document.getElementById("ordre_plat_1").checked = false;
                document.getElementById("ordre_plat_2").checked = false;
                document.getElementById("ordre_plat_3").checked = false;
                document.getElementById("ordre_plat_4").checked = false;

                switch (result.course_pos) {
                    case "1":
                        document.getElementById("ordre_plat_1").checked = true;
                        break;
                    case "2":
                        document.getElementById("ordre_plat_2").checked = true;
                        break;
                    case "3":
                        document.getElementById("ordre_plat_3").checked = true;
                        break;
                    case "4":
                        document.getElementById("ordre_plat_4").checked = true;
                        break;
                }
                $("#al_1").prop("checked", false);
                $("#al_2").prop("checked", false);
                $("#al_3").prop("checked", false);
                $("#al_4").prop("checked", false);
                $("#al_5").prop("checked", false);
                $("#al_6").prop("checked", false);
                $("#al_7").prop("checked", false);
                $("#al_8").prop("checked", false);
                $("#al_9").prop("checked", false);
                $("#al_10").prop("checked", false);
                $("#al_11").prop("checked", false);
                $("#al_12").prop("checked", false);
                $("#al_13").prop("checked", false);
                $("#al_14").prop("checked", false);

               result.allergens.forEach(function(element) {
                   switch (element.id_allergen) {
                       case "1":
                           $("#al_1").prop("checked", true);
                           break;
                       case "2":
                           $("#al_2").prop("checked", true);
                           break;
                       case "3":
                           $("#al_3").prop("checked", true);
                           break;
                       case "4":
                           $("#al_4").prop("checked", true);
                           break;
                       case "5":
                           $("#al_5").prop("checked", true);
                           break;

                       case "6":
                           $("#al_6").prop("checked", true);
                           break;

                       case "7":
                           $("#al_7").prop("checked", true);
                           break;

                       case "8":
                           $("#al_8").prop("checked", true);
                           break;

                       case "9":
                           $("#al_9").prop("checked", true);
                           break;

                       case "10":
                           $("#al_10").prop("checked", true);
                           break;

                       case "11":
                           $("#al_11").prop("checked", true);
                           break;

                       case "12":
                           $("#al_12").prop("checked", true);
                           break

                       case "13":
                           $("#al_13").prop("checked", true);
                           break

                       case "14":
                           $("#al_14").prop("checked", true);
                           break
                   }
               });


                $("#id").prop("value", result.id_dish);
                document.getElementById("tag").value = result.tag;
                document.getElementById("cost_price").value = result.cost_price;
                document.getElementById("net_price").value = result.net_price;


            }
        });

}


function create_new() {
    $("#alias").prop("value", "");
    $("#cat_name").prop("value", "");
    $("#esp_name").prop("value", "");
    $("#eng_name").prop("value", "");
    $("#ordre_plat_1").prop("checked", false);
    $("#ordre_plat_2").prop("checked", false);
    $("#ordre_plat_3").prop("checked", false);
    $("#ordre_plat_4").prop("checked", false);
    $("#al_1").prop("checked", false);
    $("#al_2").prop("checked", false);
    $("#al_3").prop("checked", false);
    $("#al_4").prop("checked", false);
    $("#al_5").prop("checked", false);
    $("#al_6").prop("checked", false);
    $("#al_7").prop("checked", false);
    $("#al_8").prop("checked", false);
    $("#al_9").prop("checked", false);
    $("#al_10").prop("checked", false);
    $("#al_11").prop("checked", false);
    $("#al_12").prop("checked", false);
    $("#al_13").prop("checked", false);
    $("#al_14").prop("checked", false);
    $("#id").prop("value", 0);
    $("#tag").prop("value", "Altres");
    $("#cost_price").prop("value", null);
    $("#net_price").prop("value", null);

}

function load_same_dish() {
    load_dish($("#id").val());
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
