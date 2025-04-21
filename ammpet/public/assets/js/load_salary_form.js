$(document).ready(function(){
    
    let temp_id_employee = document.getElementById("temp_id_employee").value;
    
    load_employee(temp_id_employee);

    
    let status = document.getElementById("salary_item_status").value;

    if (status == "Fechado") {
        document.getElementById("salary_item_status").setAttribute("disabled", "disabled");
    } else {
        document.getElementById('salary_item_status').removeAttribute("disabled");
    }

    document.getElementById("form_salary").onsubmit= function(event) {
        console.log("form_salary submit hit");
        event.preventDefault();
        let supplier = document.getElementById("id_employee").value;
        let salary_item_value = document.getElementById("salary_item_value").value;
        let salary_item_type = document.getElementById("salary_item_type").value;
        var error_msg = "";
        var check_supplier = 1;
        var check_salary_item_type = 1;
        var check_salary_item_value = 1;

        console.log("supplier - "+supplier+" | salary_item_value - "+salary_item_value+" | salary_item_type - "+salary_item_type);
      
        if(supplier==""){
            error_msg = error_msg+"| Selecione um fucnionário.";
            check_supplier = 0;
        }
        if (salary_item_type == "Selecione uma opção") {
            error_msg=error_msg+"| Selecione um tipo de item.";
            check_salary_item_type = 0;
        }
        if (!(salary_item_value > 0)) {
            error_msg=error_msg+"| Indique um valor > 0."
            check_salary_item_value = 0;
        }

        if(check_supplier==1 && check_salary_item_type==1 && check_salary_item_value==1){
            console.log("validation OK");
            document.getElementById('error_msg').setAttribute('type',"hidden");
            document.getElementById("form_salary").
        } else{
            console.log("validation failed");
            document.getElementById('error_msg').value = error_msg;
            document.getElementById('error_msg').setAttribute('type', "text");
            return false;
        }
      };
});