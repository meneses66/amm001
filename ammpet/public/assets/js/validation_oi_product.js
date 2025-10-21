$(document).ready(function(){
    
    document.getElementById("button").onclick= function(event) {
        event.preventDefault();

        var data_form = decodeURIComponent($(update_form).serialize());
        //console.log("data_form: "+data_form);
        data_form_array = splitUrlEncoded(data_form);
        const cli_id = data_form_array.Id_Client;
        const  order_id = data_form_array.Id_Order;
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                    operation: "submit", 
                    class:"OrderItem", 
                    method:"validate_oi_product", 
                    csrf_token: csrf,
                    Id:data_form_array.Id, 
                    Updated_By:data_form_array.Updated_By, 
                    Id_Order:data_form_array.Id_Order, 
                    Id_Prod_Serv:data_form_array.Id_Prod_Serv, 
                    Quantity:data_form_array.Quantity, 
                    Unit_Value:data_form_array.Unit_Value, 
                    Discount_Value:data_form_array.Discount_Value, 
                    Value_No_Discount:data_form_array.Value_No_Discount, 
                    Value_With_Discount:data_form_array.Value_With_Discount, 
                    Prod_Serv_Type:data_form_array.Prod_Serv_Type, 
                    Date:data_form_array.Date, 
                    Item_Description:data_form_array.Item_Description, 
                    Prod_Serv_Category:data_form_array.Prod_Serv_Category, 
                    Id_Client:data_form_array.Id_Client, 
                    Prod_Serv_Group:data_form_array.Prod_Serv_Group, 
                    Salesperson:data_form_array.Salesperson, 
                    OI_Price_Cash:data_form_array.OI_Price_Cash, 
                    Total_Cash:data_form_array.Total_Cash, 
                    OI_Price_Pix:data_form_array.OI_Price_Pix, 
                    Total_Pix:data_form_array.Total_Pix, 
                    Prodserv_Code:data_form_array.Prodserv_Code, 

                  },
            success: function(response){
                if ((typeof response === 'string' || response instanceof String)&&!(response==false)) {
                    document.getElementById('error_message').innerText = response;
                } else {
                    window.location.replace("/ammpet/public/Orderx/_details?cli_id="+cli_id+"&order_id="+order_id);
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
