$(document).ready(function(){
    
    document.getElementById("button").onclick= function(event) {
        event.preventDefault();

        var data_form = decodeURIComponent($(form_preclosing).serialize());
        //console.log("data_form: "+data_form);
        data_form_array = splitUrlEncoded(data_form);
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                    operation: "submit", 
                    class:"PreClosing", 
                    method:"validate_preclosing", 
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
