$(document).ready(function(){
    
    document.getElementById("button").onclick= function(event) {
        event.preventDefault();

        var data_form = decodeURIComponent($(form_prod).serialize());
        //console.log("data_form: "+data_form);
        data_form_array = splitUrlEncoded(data_form);
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                    operation: "submit", 
                    class:"Product", 
                    method:"validate_product", 
                    csrf_token: csrf,
                    Id:data_form_array.Id, 
                    Created_By:data_form_array.Created_By, 
                    Updated_By:data_form_array.Updated_By,  
                    Code:data_form_array.Code, 
                    Name:data_form_array.Name, 
                    Group_x:data_form_array.Group_x, 
                    Type:data_form_array.Type, 
                    Category:data_form_array.Category, 
                    Sequence:data_form_array.Sequence, 
                    Supplier:data_form_array.Supplier, 
                    Status:data_form_array.Status, 
                    Price:data_form_array.Price, 
                    Flag1:data_form_array.Flag1, 
                    Comission_flg:data_form_array.Comission_flg, 
                    Center:data_form_array.Center, 
                    External_cost:data_form_array.External_cost, 
                    Comission_percentage:data_form_array.Comission_percentage, 
                    Price_cash:data_form_array.Price_cash, 
                    Price_pix:data_form_array.Price_pix, 
                    Comission_overwrite_flg:data_form_array.Comission_overwrite_flg
            },
            success: function(response){
                if ((typeof response === 'string' || response instanceof String)&&!(response==false)) {
                    document.getElementById('error_message').innerText = response;
                } else {
                    window.location.replace("/ammpet/public/Product/_list");
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
