$(document).ready(function(){
    
    document.getElementById("button").onclick= function(event) {
        event.preventDefault();
        try {
            var pkgSvc = document.getElementById('package_service');
            if (pkgSvc) { pkgSvc.removeAttribute('disabled'); }
            var idPkg = document.getElementById('id_package');
            if (idPkg) { idPkg.removeAttribute('disabled'); }
        } catch(e) { /* ignore, keep going */ }

        try { if (typeof calculate_item_service_sync === 'function') { calculate_item_service_sync(undefined, true); } } catch(e) {}
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
                    method:"validate_oi_service", 
                    csrf_token: csrf,
                    Id:data_form_array.Id, 
                    Updated_By:data_form_array.Updated_By,
                    Id_Order:data_form_array.Id_Order, 
                    Id_Prod_Serv:data_form_array.Id_Prod_Serv, 
                    Quantity:data_form_array.Quantity, 
                    Unit_Value:data_form_array.Unit_Value, 
                    Discount_Perc:data_form_array.Discount_Perc, 
                    Discount_Value:data_form_array.Discount_Value, 
                    Value_No_Discount:data_form_array.Value_No_Discount, 
                    Value_With_Discount:data_form_array.Value_With_Discount, 
                    Id_Package:data_form_array.Id_Package, 
                    Id_Package_Animal:data_form_array.Id_Package_Animal, 
                    Prod_Serv_Type:data_form_array.Prod_Serv_Type, 
                    Date:data_form_array.Date, 
                    Item_Description:data_form_array.Item_Description, 
                    Serv_Executor:data_form_array.Serv_Executor, 
                    Package_Amount:data_form_array.Package_Amount, 
                    Package_Consume:data_form_array.Package_Consume, 
                    Package_Sequence:data_form_array.Package_Sequence, 
                    Package_Service:data_form_array.Package_Service, 
                    Prod_Serv_Category:data_form_array.Prod_Serv_Category, 
                    Id_Client:data_form_array.Id_Client, 
                    Blade:data_form_array.Blade, 
                    Prod_Serv_Group:data_form_array.Prod_Serv_Group, 
                    Package_Name:data_form_array.Package_Name, 
                    Salesperson:data_form_array.Salesperson,  
                    Cost_Center:data_form_array.Cost_Center,  
                    Flag_Otite:data_form_array.Flag_Otite, 
                    Flag_Olhos_Verm:data_form_array.Flag_Olhos_Verm, 
                    Flag_Pulga:data_form_array.Flag_Pulga, 
                    Flag_Carrapato:data_form_array.Flag_Carrapato, 
                    Flag_Dermatite:data_form_array.Flag_Dermatite, 
                    Flag_Ferida:data_form_array.Flag_Ferida, 
                    Flag_Outro:data_form_array.Flag_Outro, 
                    Checklist_Description:data_form_array.Checklist_Description, 
                    Adap_Pata:data_form_array.Adap_Pata, 
                    Flag_Contrario:data_form_array.Flag_Contrario, 
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
              },
            error: function(xhr){
                var msg = 'Erro ao confirmar serviço.';
                try {
                    if (xhr && xhr.responseText) { msg += ' ' + xhr.responseText; }
                } catch(e) {}
                var em = document.getElementById('error_message');
                if (em) em.innerText = msg;
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
