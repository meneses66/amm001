$(document).ready(function(){
    
    document.getElementById("button").onclick= function(event) {
        //console.log("form_salary submit hit");
        event.preventDefault();

        let form = document.getElementById("form").getAttribute("name");

        let id = document.getElementById("id").value;

        if (id == "new") {
            let created_by = document.getElementById("created_by").value;
        } 

        var data_form = decodeURIComponent($(form).serialize());
        data_form_array = splitUrlEncoded(data_form);
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {class:"Product", method:"validate_product", 
                Id:data_form_array.id, 
                Created_By:data_form_array.created_by, 
                Updated_By:data_form_array.updated_by, 
                Created:data_form_array.created, 
                Updated:data_form_array.updated, 
                Code:data_form_array.code, 
                Name:data_form_array.name, 
                Group_x:data_form_array.group_x, 
                Type:data_form_array.type, 
                Category:data_form_array.category, 
                Sequence:data_form_array.sequence, 
                Supplier:data_form_array.supplier, 
                Status:data_form_array.status, 
                Package_amount:data_form_array.package_amount, 
                Price:data_form_array.price, 
                Flag1:data_form_array.flag1, 
                Comission_flg:data_form_array.comission_flg, 
                Center:data_form_array.center, 
                External_cost:data_form_array.external_cost, 
                Comission_percentage:data_form_array.comission_percentage, 
                Package_price:data_form_array.package_price, 
                Price_cash:data_form_array.price_cash, 
                Price_pix:data_form_array.price_pix, 
                Comission_overwrite_flg:data_form_array.comission_overwrite_flg
            },
            success: function(response){
                console.log("AJAX SUCCESS");
                if (typeof response === 'string' || response instanceof String) {
                    console.log("AJAX SUCCESS == STRING");
                    document.getElementById('error_message').innerText = response;
                } else {
                    console.log("AJAX SUCCESS == NOT STRING");
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
