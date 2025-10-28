function calculate_item_product(input){
    // Defer calculation to ensure mask has updated field values
    setTimeout(() => {
        // Read values and normalize masked monetary inputs reliably
        let quantity = Number(document.getElementById("quantity").value || 0);
        let unit_value = getMaskedMoneyById("unit_value");
        let discount_value = getMaskedMoneyById("discount_value");
        let oi_price_cash = getMaskedMoneyById("oi_price_cash");
        let oi_price_pix = getMaskedMoneyById("oi_price_pix");

        var total_cash = round(quantity*oi_price_cash, 2).toFixed(2);
        var total_pix = round(quantity*oi_price_pix, 2).toFixed(2);
        var total_no_discount = round(quantity*unit_value, 2).toFixed(2);
        var total_with_discount = round((round(quantity*unit_value, 2) - discount_value),2).toFixed(2);
        document.getElementById("total_pix").value = total_pix;
        document.getElementById("total_cash").value = total_cash;
        document.getElementById("value_no_discount").value = total_no_discount;
        document.getElementById("value_with_discount").value = total_with_discount;
    }, 0);
}

function round(num, decimalPlaces = 0) {
    return new Decimal(num).toDecimalPlaces(decimalPlaces).toNumber();
}

// Parses values from jQuery Mask (pattern "##0.00" with reverse:true) consistently.
// Handles intermediate typing states by stripping non-digits and dividing by 100.
function parseMaskedMoney(val){
    if (val == null) return 0;
    const digits = String(val).replace(/\D+/g, "");
    if (!digits) return 0;
    return Number(digits) / 100;
}

// Prefer reading via jQuery Mask's cleanVal when available
function getMaskedMoneyById(id){
    const el = document.getElementById(id);
    if (!el) return 0;
    try {
        if (typeof $ === 'function'){
            const $el = $('#'+id);
            if ($el.length && typeof $el.cleanVal === 'function'){
                const clean = $el.cleanVal();
                if (clean !== '' && clean != null) return Number(clean)/100;
            }
        }
    } catch(e){}
    return parseMaskedMoney(el.value);
}
