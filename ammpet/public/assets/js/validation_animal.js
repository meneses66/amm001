$(document).ready(function(){
    
    document.getElementById("button").onclick= function(event) {
        event.preventDefault();

        var data_form = decodeURIComponent($(form_animal).serialize());
        //console.log("data_form: "+data_form);
        data_form_array = splitUrlEncoded(data_form);
        const cli_id_back = data_form_array.Id_Client;
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                    operation: "submit", 
                    class:"Animal", 
                    method:"validate_animal", 
                    Id:data_form_array.Id, 
                    Created_By:data_form_array.Created_By, 
                    Updated_By:data_form_array.Updated_By, 
                    Created:data_form_array.Created, 
                    Updated:data_form_array.Updated, 
                    Name:data_form_array.Name, 
                    Size:data_form_array.Size, 
                    Id_Client:data_form_array.Id_Client, 
                    Type:data_form_array.Type, 
                    Id_Breed:data_form_array.Id_Breed, 
                    Gender:data_form_array.Gender, 
                    Birth_Date:data_form_array.Birth_Date, 
                    No_Perfume:data_form_array.No_Perfume, 
                    Is_Danger:data_form_array.Is_Danger, 
                    Blade_Alergic:data_form_array.Blade_Alergic, 
                    Vaccinated:data_form_array.Vaccinated

            },
            success: function(response){
                if ((typeof response === 'string' || response instanceof String)&&!(response==false)) {
                    document.getElementById('error_message').innerText = response;
                } else {
                    window.location.replace("/ammpet/public/Client/_cli_animal?cli_id="+cli_id_back);
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
