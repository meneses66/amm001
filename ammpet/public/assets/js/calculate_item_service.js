function calculate_item_service(input){
    //console.log("Entrei");
    let id_package = document.getElementById("id_package").value;
    let quantity = document.getElementById("quantity").value;
    let unit_value = document.getElementById("unit_value").value;
    let discount_value = document.getElementById("discount_value").value;
    let oi_price_cash = document.getElementById("oi_price_cash").value;
    let oi_price_pix = document.getElementById("oi_price_pix").value;

    if (id_package=="0") {
        var total_cash = round(quantity*oi_price_cash, 2);
        var total_pix = round(quantity*oi_price_pix, 2);
        var total_no_discount = round(quantity*unit_value, 2);
        var total_with_discount = round((round(quantity*unit_value, 2) - discount_value),2);        
    } else{
        var total_cash = "0.00";
        var total_pix = "0.00";
        var total_no_discount = "0.00";
        var total_with_discount = "0.00";
    }

    //document.getElementById("total_pix").readonly=false;
    document.getElementById("total_pix").value = total_pix;
    //document.getElementById("total_pix").readonly=true;
    //document.getElementById("total_pix").setAttribute('readonly', true);

    document.getElementById("total_cash").value = total_cash;
    document.getElementById("value_no_discount").value = total_no_discount;
    document.getElementById("value_with_discount").value = total_with_discount;

}

function round(num, decimalPlaces = 0) {
    return new Decimal(num).toDecimalPlaces(decimalPlaces).toNumber();
}