$(document).ready(function(){
    let id_client = document.getElementById("id_client").value;
    let temp_package = document.getElementById("temp_package").value;
    let temp_executor = document.getElementById("temp_executor").value;
    let temp_salesperson = document.getElementById("temp_salesperson").value;
    let temp_id_animal_pkg = document.getElementById("temp_id_animal_pkg").value;
    let prod_serv_category = document.getElementById("prod_serv_category").value;
    let id_package = document.getElementById("id_package").value;

    if((prod_serv_category=="Pacote")){
        document.getElementById('id_package').setAttribute("disabled", "disabled");
    } else {
        document.getElementById('id_package').removeAttribute("disabled");
    }

    if((temp_package==1||temp_package=="1")){
        document.getElementById('quantity').removeAttribute('readonly');
        document.getElementById("package_service").value = "Banho";
        document.getElementById("package_service").setAttribute("disabled", "disabled");
    } else {
        document.getElementById("quantity").value = 1;
        document.getElementById('quantity').setAttribute('readonly', true);
        document.getElementById('package_service').removeAttribute("disabled");
    }

    document.getElementById("update_form").onsubmit = function() {
        document.getElementById('package_service').removeAttribute("disabled");
    };

    load_package(temp_package, id_client);
    load_executor(temp_executor);
    load_salesperson(temp_salesperson);
    load_animals(temp_id_animal_pkg, id_client);
});