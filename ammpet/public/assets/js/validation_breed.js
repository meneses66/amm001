$(document).ready(function(){
    
    document.getElementById("button").onclick= function(event) {
        event.preventDefault();

        var data_form = decodeURIComponent($(form_breed).serialize());
        //console.log("data_form: "+data_form);
        data_form_array = splitUrlEncoded(data_form);
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                    operation: "submit", 
                    class:"Breed", 
                    method:"validate_breed", 
                    csrf_token: csrf,
                    Id:data_form_array.Id, 
                    Created_By:data_form_array.Created_By, 
                    Updated_By:data_form_array.Updated_By, 
                    Name:data_form_array.Name,
                    Type:data_form_array.Type

                  },
            success: function(response){
                if ((typeof response === 'string' || response instanceof String)&&!(response==false)) {
                    document.getElementById('error_message').innerText = response;
                } else {
                    window.location.replace("/ammpet/public/Breed/_list");
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
