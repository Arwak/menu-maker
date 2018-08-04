

function change_space() {

}

function add_dish(id) {

    document.getElementById(id).removeAttribute("onclick");
    document.getElementById(id).onclick = function() { remove_dish(id) };
    document.getElementById(id).classList.remove("w3-hover-green");
    document.getElementById(id).classList.add("w3-hover-red");
    document.getElementById(id).childNodes.item(2).classList.remove("w3-display-right");
    document.getElementById(id).childNodes.item(2).classList.add("w3-display-left");
    document.getElementById(id).childNodes.item(2).childNodes.item(0).classList.remove("fa-arrow-right")
    document.getElementById(id).childNodes.item(2).childNodes.item(0).classList.add("fa-arrow-left")

    var list_yes = document.getElementById("list_yes");
    list_yes.appendChild(document.getElementById(id));


    //TODO
    // cridar php per afegir plat amb id a la llista de seleccionats

}

function remove_dish(id) {

    document.getElementById(id).removeAttribute("onclick");
    document.getElementById(id).onclick = function() { add_dish(id) };
    document.getElementById(id).classList.add("w3-hover-green");
    document.getElementById(id).classList.remove("w3-hover-red");
    document.getElementById(id).childNodes.item(2).classList.add("w3-display-right");
    document.getElementById(id).childNodes.item(2).classList.remove("w3-display-left");
    document.getElementById(id).childNodes.item(2).childNodes.item(0).classList.add("fa-arrow-right")
    document.getElementById(id).childNodes.item(2).childNodes.item(0).classList.remove("fa-arrow-left")

    var list_no = document.getElementById("list_no");
    list_no.appendChild(document.getElementById(id));


}

function remove_all() {

    var list_no = document.getElementById("list_yes").children;
    for (var i = list_no.length - 1; i >= 0; i--) {
            remove_dish(list_no[i].id);
    }

}


function search() {

    var input, filter, list_no, li, a, i;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    list_no = document.getElementById("list_no");
    li = list_no.getElementsByTagName('li');


    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}


































