$(document).ready(function(){
    
    document.getElementById("button").onclick= function(event) {
        event.preventDefault();

        var data_form = decodeURIComponent($(form_params).serialize());
        //console.log("data_form: "+data_form);
        data_form_array = splitUrlEncoded(data_form);
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                    operation: "submit", 
                    class:"Params", 
                    method:"validate_params", 
                    csrf_token: csrf,
                    Id:data_form_array.Id, 
                    Created_By:data_form_array.Created_By, 
                    Updated_By:data_form_array.Updated_By, 
                    Name:data_form_array.Name,
                    Value:data_form_array.Value, 
                    Type:data_form_array.Type, 
                    Status:data_form_array.Status, 
                    Comment:data_form_array.Comment 

                  },
            success: function(response){
                if ((typeof response === 'string' || response instanceof String)&&!(response==false)) {
                    document.getElementById('error_message').innerText = response;
                } else {
                    window.location.replace("/ammpet/public/Params/_list");
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
