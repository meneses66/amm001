$(document).ready(function(){
    
    let temp_id_employee = document.getElementById("temp_id_employee").value;
    
    load_employee(temp_id_employee);

    
    let status = document.getElementById("salary_item_status").value;

    if (status == "Fechado") {
        document.getElementById("salary_item_status").setAttribute("disabled", "disabled");
    } else {
        document.getElementById('salary_item_status').removeAttribute("disabled");
    }

    document.getElementById("save_submit").onclick= function(event) {
        //console.log("form_salary submit hit");
        event.preventDefault();
        let supplier = document.getElementById("id_employee").value;
        let salary_item_value = document.getElementById("salary_item_value").value;
        let salary_item_type = document.getElementById("salary_item_type").value;
        let id = document.getElementById("id").value;
        let form_salary = document.getElementById("form_salary");

        var data_form = decodeURIComponent($(form_salary).serialize());
        var error_msg = "";
        var check_supplier = 1;
        var check_salary_item_type = 1;
        var check_salary_item_value = 1;

        //console.log("supplier - "+supplier+" | salary_item_value - "+salary_item_value+" | salary_item_type - "+salary_item_type);
      
        if(supplier=="XXXX"){
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
            //console.log("validation OK");
            document.getElementById('error_msg').setAttribute('type',"hidden");
            if (id=="new") {
                //console.log("ID = NEW");
                insert_salary(data_form);
            } else{
                update_salary(data_form, id);
            }
        } else{
            //console.log("validation failed");
            document.getElementById('error_msg').value = error_msg;
            document.getElementById('error_msg').setAttribute('type', "text");
            return false;
        }
      };

      document.getElementById("postpone_submit").onclick= function(event) {
        //console.log("form_salary submit hit");
        event.preventDefault();
        let postponed_value = document.getElementById("postponed_value").value;
        let salary_item_value = document.getElementById("salary_item_value").value;
        let id = document.getElementById("id").value;
        let form_salary = document.getElementById("form_salary");

        var data_form = decodeURIComponent($(form_salary).serialize());
        var error_msg = "";
        var check_postponed_value = 1;
      
        if(postponed_value==0){
            error_msg = error_msg+"| Indique um valor > 0 para adiar.";
            check_postponed_value = 0;
        }
        if(postponed_value > salary_item_value){
            error_msg = error_msg+"| Indique um valor para adiar que seja menor que o valor do item. Valor indicado: "+postponed_value+" |Valor do Item: "+salary_item_value;
            check_postponed_value = 0;
        }

        if(check_postponed_value==1){
            //console.log("validation OK");
            document.getElementById('error_msg').setAttribute('type',"hidden");
                postpone_value(data_form, id);
        } else{
            //console.log("validation failed");
            document.getElementById('error_msg').value = error_msg;
            document.getElementById('error_msg').setAttribute('type', "text");
            return false;
        }
      };

      function insert_salary(data_form){
        //var data_form2 = splitSerializedEncoded(data_form);
        data_form3 = splitUrlEncoded(data_form);
        //console.log("INSERT ACCESSED:"+data_form2);
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {class:"Salary", method:"insert_call", Created_By:data_form3.Created_By, Updated_by:data_form3.Updated_by, Id_Employee:data_form3.Id_Employee, Ref_Date:data_form3.Ref_Date, Salary_Item_Type:data_form3.Salary_Item_Type, Salary_Item_Value:data_form3.Salary_Item_Value, Salary_Item_Status:data_form3.Salary_Item_Status, Original_Value:data_form3.Original_Value, Postponed_Value:data_form3.Postponed_Value, Salary_Item_Description:data_form3.Salary_Item_Description},
            success: function(response){
                window.location.replace("/ammpet/public/Salary/_list");
              }
        });
    }
    
    function update_salary(data_form, id){
        //var data_form2 = splitSerializedEncoded(data_form);
        data_form3 = splitUrlEncoded(data_form);
        //console.log("INSERT ACCESSED:"+data_form2);
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {class:"Salary", method:"update_call", Id:id, Created_By:data_form3.Created_By, Updated_by:data_form3.Updated_by, Id_Employee:data_form3.Id_Employee, Ref_Date:data_form3.Ref_Date, Salary_Item_Type:data_form3.Salary_Item_Type, Salary_Item_Value:data_form3.Salary_Item_Value, Salary_Item_Status:data_form3.Salary_Item_Status, Original_Value:data_form3.Original_Value, Postponed_Value:data_form3.Postponed_Value, Salary_Item_Description:data_form3.Salary_Item_Description},
            success: function(response){
                window.location.replace("/ammpet/public/Salary/_list");
            }
        });
    }

    function postpone_value(data_form, id){
        data_form3 = splitUrlEncoded(data_form);
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {class:"Salary", method:"postpone_value_ajax", Id:id, Created_By:data_form3.Created_By, Updated_by:data_form3.Updated_by, Id_Employee:data_form3.Id_Employee, Ref_Date:data_form3.Ref_Date, Salary_Item_Type:data_form3.Salary_Item_Type, Salary_Item_Value:data_form3.Salary_Item_Value, Salary_Item_Status:data_form3.Salary_Item_Status, Original_Value:data_form3.Original_Value, Postponed_Value:data_form3.Postponed_Value, Salary_Item_Description:data_form3.Salary_Item_Description},
            success: function(response){
                window.location.replace("/ammpet/public/Salary/_list");
            }
        });
    }

    function splitUrlEncoded(str) {
        var result = {};
        str.split('&').forEach(pair => {
          const [key, value] = pair.split('=');
          result[key] = value;
        });
        return result;
      }

});

