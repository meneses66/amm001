$(document).ready(function(){

    let permissions = document.getElementById("user_permissions").value;
    //console.log("Permissions: "+permissions);

    if (!(permissions.includes("client_view"))){
        console.log("client view not in permissions: "+permissions);
        $('#client_list').attr('disabled', 'disabled');    
    } else{
        console.log("client view found in permissions: "+permissions);
        //$('#client_list').removeAttr('disabled');
        //$('#client_list').attr('disabled',false);
        $('#client_list').removeAttr('disabled');
    }

    $(document).on('click', 'a', function(e) {
        if ($(this).attr('disabled') == 'disabled') {
            e.preventDefault();
        }
    });

});


/**  ALL PERMISSIONS
client_view
client_add
client_edit
client_delete
supplier_view
supplier_add
supplier_edit
supplier_delete
params_view
params_add
params_edit
params_delete
product_view
product_add
product_edit
product_delete
service_view
service_add
service_edit
service_delete
orderx_view
orderx_add
orderx_edit
orderx_delete
cash_register_view
cash_register_add
cash_register_edit
cash_register_delete
admin_view
admin_add
admin_edit
admin_delete
agenda_view
agenda_add
agenda_edit
agenda_delete
salary_view
salary_add
salary_edit
salary_delete
cost_view
cost_add
cost_edit
cost_delete
pre_closing_view
pre_closing_add
pre_closing_edit
pre_closing_delete
month_closing_view
month_closing_add
month_closing_edit
month_closing_delete
*/