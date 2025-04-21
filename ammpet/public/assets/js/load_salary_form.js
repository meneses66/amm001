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
        let salary_item_value    = document.form[0].elements.salary_item_value.value;
        let salary_item_type    = document.form[0].elements.salary_item_type.value;
      
        var check_supplier = (supplier == "XXXX") ? 0 : 1;
        var check_salary_item_type = (salary_item_type == "Selecione uma opção") ? 0 : 1;
        var check_salary_item_value = (salary_item_value > 0) ? 1 : 0;

        if(check_supplier && check_salary_item_type && check_salary_item_value){
            document.form[0].submit();
        } else{
            return false;
        }
        
        // If values are invalid
        // Show errors alert() or show a form element

      });


});