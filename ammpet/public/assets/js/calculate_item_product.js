function calculate_item_product(input){
    // Defer calculation to ensure mask has updated field values
    setTimeout(() => {
        calculate_item_product_sync(input, false);
    }, 0);
}

// Synchronous version used on blur/submit to avoid stale values
function calculate_item_product_sync(input, format){
    // Read values and normalize masked monetary inputs reliably
    let quantity = Number(document.getElementById("quantity").value || 0);
    const activeId = document.activeElement ? document.activeElement.id : null;
        let unit_value = (activeId === 'unit_value' && typeof input !== 'undefined') ? parseMoneyFlexible(input) : getReliableMoneyById("unit_value");
        let discount_value = (activeId === 'discount_value' && typeof input !== 'undefined') ? parseMoneyFlexible(input) : getReliableMoneyById("discount_value");
    let oi_price_cash = getReliableMoneyById("oi_price_cash");
    let oi_price_pix = getReliableMoneyById("oi_price_pix");

    var total_cash = round(quantity*oi_price_cash, 2).toFixed(2);
    var total_pix = round(quantity*oi_price_pix, 2).toFixed(2);
    var base_total_num = round(quantity*unit_value, 2);
    var total_no_discount = base_total_num.toFixed(2);
    // Cap discount to base total
    var discount_capped = discount_value > base_total_num ? base_total_num : discount_value;
    var total_with_discount_num = base_total_num - discount_capped;
    if (total_with_discount_num < 0) total_with_discount_num = 0;
    var total_with_discount = round(total_with_discount_num, 2).toFixed(2);
    document.getElementById("total_pix").value = total_pix;
    document.getElementById("total_cash").value = total_cash;
    document.getElementById("value_no_discount").value = total_no_discount;
    document.getElementById("value_with_discount").value = total_with_discount;
    // Ensure discount field displays fixed 2 decimals when requested (on blur/submit)
    if (format) {
        // When formatting, also persist the capped discount back to the field
        try {
            let quantity = Number(document.getElementById("quantity").value || 0);
            let unit_value_now = getReliableMoneyById("unit_value");
            let base_total_num_now = round(quantity*unit_value_now, 2);
            let discount_now = getReliableMoneyById("discount_value");
            if (discount_now > base_total_num_now) discount_now = base_total_num_now;
            document.getElementById("discount_value").value = Number(discount_now).toFixed(2);
        } catch(e){}
    }
}

function round(num, decimalPlaces = 0) {
    return new Decimal(num).toDecimalPlaces(decimalPlaces).toNumber();
}

// Flexible money parser:
// - If numeric with optional dot/comma, parse as float
// - Else fallback to masked-style digits divided by 100
function parseMoneyFlexible(val){
    if (val == null) return 0;
    const s = String(val).trim().replace(',', '.');
    if (s === '') return 0;
    if (/^\d+(\.\d+)?$/.test(s)) return Number(s);
    const digits = s.replace(/\D+/g, "");
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
    return parseMoneyFlexible(el.value);
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
    const fromRaw = parseMoneyFlexible(el.value);
    if (fromClean == null) return fromRaw;
    // If values differ by ~100x, prefer the smaller plausible one (fromRaw)
    if (fromRaw > 0 && fromClean >= 100 && Math.abs((fromClean / fromRaw) - 100) < 1){
        return fromRaw;
    }
    return fromClean;
}
