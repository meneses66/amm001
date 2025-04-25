$(document).ready(function(){
    
    document.getElementById("button").onclick= function(event) {
        event.preventDefault();

        var data_form = decodeURIComponent($(form_order_payment).serialize());
        //console.log("data_form: "+data_form);
        data_form_array = splitUrlEncoded(data_form);
        const cli_id = data_form_array.Id_Client;
        const order_id = data_form_array.Id_Order;
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                    operation: "submit", 
                    class:"OrderPayment", 
                    method:"validate_order_payment", 
                    Id:data_form_array.Id, 
                    Created_By:data_form_array.Created_By, 
                    Updated_By:data_form_array.Updated_By,
                    Date:data_form_array.Date, 
                    Id_Order:data_form_array.Id_Order, 
                    Paid_Amount:data_form_array.Paid_Amount,
                    Payment_Type:data_form_array.Payment_Type, 
                    Flag1:data_form_array.Flag1 

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
