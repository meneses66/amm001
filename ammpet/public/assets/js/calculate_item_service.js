function calculate_item_service(input){
    console.log("Entrei");
    let id_package = document.getElementById("id_package").value;
    let quantity = document.getElementById("quantity").value;
    let unit_value = document.getElementById("unit_value").value;
    let discount_value = document.getElementById("discount_value").value;
    let price_cash = document.getElementById("price_cash").value;
    let price_pix = document.getElementById("price_pix").value;

    if (id_package=="0") {
        var total_cash = quantity*price_cash;
        var total_pix = quantity*price_pix;
        var total_no_discount = quantity*unit_value;
        var total_with_discount = quantity*unit_value - discount_value;        
    } else{
        var total_cash = "0.00";
        var total_pix = "0.00";
        var total_no_discount = "0.00";
        var total_with_discount = "0.00";
    }

    document.getElementById("total_pix").readonly=false;
    document.getElementById("total_pix").value = total_pix;
    document.getElementById("total_pix").readonly=true;
    //document.getElementById("total_pix").setAttribute('readonly', true);

    document.getElementById("total_cash").value = total_cash;
    document.getElementById("value_no_discount").value = total_no_discount;
    document.getElementById("value_with_discount").value = total_with_discount;

}