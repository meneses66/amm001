$(document).ready(function(){
    
    document.getElementById("button").onclick= function(event) {
        event.preventDefault();

        var data_form = decodeURIComponent($(form_client).serialize());
        //console.log("data_form: "+data_form);
        data_form_array = splitUrlEncoded(data_form);
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                    operation: "submit", 
                    class:"Client", 
                    method:"validate_client", 
                    Id:data_form_array.Id, 
                    Created_By:data_form_array.Created_By, 
                    Updated_By:data_form_array.Updated_By, 
                    Name:data_form_array.Name, 
                    Mobile_1:data_form_array.Mobile_1, 
                    Mobile_2:data_form_array.Mobile_2, 
                    Client_Since:data_form_array.Client_Since, 
                    Preferred_Dog_Food:data_form_array.Preferred_Dog_Food, 
                    Status:data_form_array.Status, 
                    Origin:data_form_array.Origin, 
                    Comment:data_form_array.Comment, 
                    Birth_Date:data_form_array.Birth_Date, 
                    Email:data_form_array.Email, 
                    CPF:data_form_array.CPF, 
                    Address:data_form_array.Address, 

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
