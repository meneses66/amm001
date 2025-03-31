$(document).ready(function(){
    let id_client = document.getElementById("id_client").value;
    let temp_package = document.getElementById("temp_package").value;
    let temp_executor = document.getElementById("temp_executor").value;
    let temp_salesperson = document.getElementById("temp_salesperson").value;
    let temp_id_animal_pkg = document.getElementById("temp_id_animal_pkg").value;
    load_package(temp_package, id_client);
    load_executor(temp_executor);
    load_salesperson(temp_salesperson);
    load_animals(temp_id_animal_pkg, id_client);
});