function calculate_item_product(input){
    let quantity = document.getElementById("quantity").value;
    let unit_value = document.getElementById("unit_value").value;
    let discount_value = document.getElementById("discount_value").value;
    let oi_price_cash = document.getElementById("oi_price_cash").value;
    let oi_price_pix = document.getElementById("oi_price_pix").value;

    var total_cash = round(quantity*oi_price_cash, 2).toFixed(2);
    var total_pix = round(quantity*oi_price_pix, 2).toFixed(2);
    var total_no_discount = round(quantity*unit_value, 2).toFixed(2);
    var total_with_discount = round((round(quantity*unit_value, 2) - discount_value),2).toFixed(2);
    document.getElementById("total_pix").value = total_pix;
    document.getElementById("total_cash").value = total_cash;
    document.getElementById("value_no_discount").value = total_no_discount;
    document.getElementById("value_with_discount").value = total_with_discount;
    
}

function round(num, decimalPlaces = 0) {
    return new Decimal(num).toDecimalPlaces(decimalPlaces).toNumber();
}