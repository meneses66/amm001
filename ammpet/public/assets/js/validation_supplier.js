$(document).ready(function(){
    
    document.getElementById("button").onclick= function(event) {
        event.preventDefault();

        var data_form = decodeURIComponent($(form_supplier).serialize());
        //console.log("data_form: "+data_form);
        data_form_array = splitUrlEncoded(data_form);
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                    operation: "submit", 
                    class:"Supplier", 
                    method:"validate_supplier", 
                    csrf_token: csrf,
                    Id:data_form_array.Id, 
                    Created_By:data_form_array.Created_By, 
                    Updated_By:data_form_array.Updated_By, 
                    Name:data_form_array.Name,
                    Login:data_form_array.Login,
                    Pass:data_form_array.Pass, 
                    Role:data_form_array.Role, 
                    CNPJ:data_form_array.CNPJ, 
                    CPF:data_form_array.CPF, 
                    Type:data_form_array.Type, 
                    Sequence:data_form_array.Sequence, 
                    Hire_Date:data_form_array.Hire_Date, 
                    Status:data_form_array.Status, 
                    Comment:data_form_array.Comment, 
                    Permissions:data_form_array.Permissions
            },
            success: function(response){
                if ((typeof response === 'string' || response instanceof String)&&!(response==false)) {
                    document.getElementById('error_message').innerText = response;
                } else {
                    window.location.replace("/ammpet/public/Supplier/_list");
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
