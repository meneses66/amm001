$(document).ready(function(){
    
    let temp_id_employee = document.getElementById("temp_id_employee").value;
    
    load_employee(temp_id_employee);

    
    let status = document.getElementById("salary_item_status").value;

    if (status == "Fechado") {
        document.getElementById("salary_item_status").setAttribute("disabled", "disabled");
    } else {
        document.getElementById('salary_item_status').removeAttribute("disabled");
    }

    document.form[0].onsubmit((event) => {
        event.preventDefault();
        let supplier = document.form[0].elements.id_employee.value;
        let salary_item_value = document.form[0].elements.salary_item_value.value;
        let salary_item_type = document.form[0].elements.salary_item_type.value;
        var error_msg = "";
      
        var check_supplier = (supplier == "XXXX") ? error_msg=error_msg+"| Selecione um fucnionário." : 1;
        var check_salary_item_type = (salary_item_type == "Selecione uma opção") ? error_msg=error_msg+"| Selecione um tipo de item." : 1;
        var check_salary_item_value = (salary_item_value > 0) ? 1 : error_msg=error_msg+"| Indique um valor > 0.";

        if(check_supplier==1 && check_salary_item_type==1 && check_salary_item_value==1){
            document.getElementById('error_msg').setAttribute('hidden','hidden');
            document.form[0].submit();
        } else{
            document.getElementById('error_msg').value=error_msg;
            document.getElementById('error_msg').removeAttribute('hidden');
            return false;
        }
      });
});