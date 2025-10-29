function calculate_item_service(input){
    // Defer calculation to ensure mask has updated field values
    setTimeout(() => {
        calculate_item_service_sync(input);
    }, 0);
}

// Synchronous version used on blur/submit to avoid stale values
function calculate_item_service_sync(input){
    let id_package = document.getElementById("id_package").value;
    // Read values and normalize masked monetary inputs reliably
    let quantity = Number(document.getElementById("quantity").value || 0);
    const activeId = document.activeElement ? document.activeElement.id : null;
    let unit_value = (activeId === 'unit_value' && typeof input !== 'undefined') ? parseMaskedMoney(input) : getReliableMoneyById("unit_value");
    let discount_value = (activeId === 'discount_value' && typeof input !== 'undefined') ? parseMaskedMoney(input) : getReliableMoneyById("discount_value");
    let oi_price_cash = getReliableMoneyById("oi_price_cash");
    let oi_price_pix = getReliableMoneyById("oi_price_pix");

    if (id_package==="1" || id_package==1) {
        document.getElementById('quantity').removeAttribute('readonly')
        document.getElementById("package_service").value = "Banho";
        document.getElementById("package_service").setAttribute("disabled", "disabled");
        var total_cash = round(quantity*oi_price_cash, 2).toFixed(2);
        var total_pix = round(quantity*oi_price_pix, 2).toFixed(2);
        var total_no_discount = round(quantity*unit_value, 2).toFixed(2);
        var total_with_discount = round((round(quantity*unit_value, 2) - discount_value),2).toFixed(2);
        document.getElementById("total_pix").value = total_pix;
        document.getElementById("total_cash").value = total_cash;
        document.getElementById("value_no_discount").value = total_no_discount;
        document.getElementById("value_with_discount").value = total_with_discount;
        document.getElementById("package_sequence").value = 0;
        document.getElementById("package_consume").value = 0;
    } else{
        var total_cash = "0.00";
        var total_pix = "0.00";
        var total_no_discount = "0.00";
        var total_with_discount = "0.00";
        document.getElementById("total_pix").value = total_pix;
        document.getElementById("total_cash").value = total_cash;
        document.getElementById("value_no_discount").value = total_no_discount;
        document.getElementById("value_with_discount").value = total_with_discount;
        document.getElementById("quantity").value = 1;
        document.getElementById('quantity').setAttribute('readonly', true);
        document.getElementById('package_service').removeAttribute("disabled");
        update_sequence(id_package);
    }
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

// Cross-checks jQuery Mask cleanVal with raw value parsing to avoid race conditions
// that produce factor-of-100 mismatches while typing (e.g., "200" -> 200 instead of 2.00).
function getReliableMoneyById(id){
    const el = document.getElementById(id);
    if (!el) return 0;
    const fromClean = (function(){
        try{
            if (typeof $ === 'function'){
                const $el = $('#'+id);
                if ($el.length && typeof $el.cleanVal === 'function'){
                    const clean = $el.cleanVal();
                    if (clean !== '' && clean != null) return Number(clean)/100;
                }
            }
        }catch(e){}
        return null;
    })();
    const fromRaw = parseMaskedMoney(el.value);
    if (fromClean == null) return fromRaw;
    // If values differ by ~100x, prefer the smaller plausible one (fromRaw)
    if (fromRaw > 0 && fromClean >= 100 && Math.abs((fromClean / fromRaw) - 100) < 1){
        return fromRaw;
    }
    return fromClean;
}

function update_sequence(id_package){
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    $.ajax({
        url: "/ammpet/public/Ajax_call",
        type: "POST",
        data: {class:"Package", method:"get_next_pkg_sequence", csrf_token: csrf, Id_Package:id_package},
        success: function(response){
            var result = response;
            var sequence_updated = Number(result)+1;
            document.getElementById("package_sequence").value = sequence_updated;
            document.getElementById("package_consume").value = sequence_updated;
        }
    });

}
