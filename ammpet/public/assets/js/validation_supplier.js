$(document).ready(function(){
    
    document.getElementById("button").onclick= function(event) {
        event.preventDefault();

        var data_form = decodeURIComponent($(form_supplier).serialize());
        //console.log("data_form: "+data_form);
        data_form_array = splitUrlEncoded(data_form);
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                    operation: "submit", 
                    class:"Supplier", 
                    method:"validate_supplier", 
                    Id:data_form_array.Id, 
                    Created_By:data_form_array.Created_By, 
                    Updated_By:data_form_array.Updated_By, 
                    Name:data_form_array.Name,
                    Login:data_form_array.Login, 
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
                    window.location.replace("/ammpet/public/Client/_list");
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
