$(document).ready(function(){
    
    // Load employee options into the dropdown if present
    try{
        let temp_id_employee_el = document.getElementById("temp_id_employee");
        if (temp_id_employee_el && typeof load_employee === 'function') {
            let temp_id_employee = temp_id_employee_el.value;
            load_employee(temp_id_employee);
        }
    }catch(e){
        // no-op if selector script not loaded
    }
    
    document.getElementById("button").onclick= function(event) {
        event.preventDefault();

        var data_form = decodeURIComponent($(form_preclosing).serialize());
        //console.log("data_form: "+data_form);
        data_form_array = splitUrlEncoded(data_form);
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                    operation: "submit", 
                    class:"PreClosing", 
                    method:"validate_preclosing", 
                    csrf_token: csrf,
                    Id:data_form_array.Id, 
                    Created_By:data_form_array.Created_By, 
                    Updated_By:data_form_array.Updated_By, 
                    Status:data_form_array.Status, 

                  },
            success: function(response){
                if ((typeof response === 'string' || response instanceof String)&&!(response==false)) {
                    document.getElementById('error_message').innerText = response;
                } else {
                    window.location.replace("/ammpet/public/PreClosing/_list");
                }
              }
        });

      };

    function splitUrlEncoded(str) {
        var result = {};
        str.split('&').forEach(pair => {
          const [key, value] = pair.split('=');
          result[key] = value;
        });
        return result;
      }

});
