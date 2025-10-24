$(document).ready(function(){
    
    // Load employee options into the dropdown if present
    try{
        let temp_id_employee_el = document.getElementById("temp_id_employee");
        if (temp_id_employee_el && typeof load_employee === 'function') {
            let temp_id_employee = temp_id_employee_el.value;
            load_employee(temp_id_employee);
        }
    }catch(e){
        // no-op if selector script not loaded
    }
    
    document.getElementById("button").onclick= function(event) {
        event.preventDefault();

        var data_form = decodeURIComponent($(form_preclosing).serialize());
        //console.log("data_form: "+data_form);
        data_form_array = splitUrlEncoded(data_form);
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                    operation: "submit", 
                    class:"PreClosing", 
                    method:"validate_preclosing", 
                    csrf_token: csrf,
                    Id:data_form_array.Id, 
                    Created_By:data_form_array.Created_By, 
                    Updated_By:data_form_array.Updated_By, 
                    Status:data_form_array.Status, 

                  },
            success: function(response){
                if ((typeof response === 'string' || response instanceof String)&&!(response==false)) {
                    document.getElementById('error_message').innerText = response;
                } else {
                    window.location.replace("/ammpet/public/PreClosing/_list");
                }
              }
        });

      };

    // ===== BANHISTAS (Pre-Closing) =====
    function ymKey() {
        const y = (document.getElementById('year')||{}).value || '';
        const mRaw = (document.getElementById('month')||{}).value || '';
        const m = (mRaw? ('0'+parseInt(mRaw,10)).slice(-2):'');
        return {year: y, month: m, name: (y && m) ? (''+y+m) : ''};
    }

    function setBanhistasVisual(state) {
        // state: 'ok' -> green, 'warn' -> red, 'neutral' -> default
        const el = document.getElementById('number_banhistas');
        const btn = document.getElementById('banhistas_update_btn');
        if (!el || !btn) return;
        if (state === 'ok') {
            el.style.backgroundColor = '#e8f5e9'; // greenish
            el.style.borderColor = '#2e7d32';
            btn.disabled = true;
        } else if (state === 'warn') {
            el.style.backgroundColor = '#ffebee'; // reddish
            el.style.borderColor = '#c62828';
            btn.disabled = false;
        } else {
            el.style.backgroundColor = '';
            el.style.borderColor = '';
            btn.disabled = false;
        }
    }

    function fetchBanhistas() {
        const ym = ymKey();
        const outEl = document.getElementById('number_banhistas');
        const idEl = document.getElementById('banhistas_param_id');
        if (!ym.name || !outEl || !idEl) return;
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                class: "PreClosing",
                method: "load_banhistas_info",
                csrf_token: csrf,
                Year: ym.year,
                Month: ym.month
            },
            success: function(response){
                // Expecting string like "<ID>|<VALUE>" or "new|"
                try{
                    const text = (typeof response === 'string') ? response : (''+response);
                    const parts = text.split('|');
                    const pid = (parts[0] || 'new').trim();
                    const val = (parts[1] || '').trim();
                    idEl.value = pid || 'new';
                    outEl.value = val;
                    $(outEl).data('original', val);
                    if (val) {
                        setBanhistasVisual('ok');
                    } else {
                        setBanhistasVisual('warn');
                    }
                }catch(e){
                    setBanhistasVisual('warn');
                }
            },
            error: function(){ setBanhistasVisual('warn'); }
        });
    }

    // Trigger fetch on load (if year/month are present) and on change
    if (document.getElementById('year') && document.getElementById('month')) {
        // Initial
        fetchBanhistas();
        // Changes
        $('#year, #month').on('change', function(){
            fetchBanhistas();
        });
    }

    // Mark red when user edits value different from original or when blank
    $('#number_banhistas').on('input', function(){
        const current = (this.value||'').trim();
        const original = ($(this).data('original')||'').trim();
        if (!current || current !== original) {
            setBanhistasVisual('warn');
        } else {
            setBanhistasVisual('ok');
        }
    });

    // Update/create parameter on click
    $('#banhistas_update_btn').on('click', function(){
        const outEl = document.getElementById('number_banhistas');
        const idEl = document.getElementById('banhistas_param_id');
        const typeEl = document.getElementById('banhistas_param_type');
        const createdByEl = document.getElementById('created_by');
        const updatedByEl = document.getElementById('updated_by');
        const ym = ymKey();
        const val = (outEl && outEl.value) ? (''+outEl.value).trim() : '';
        if (!ym.name) { setBanhistasVisual('warn'); return; }
        if (!val) { setBanhistasVisual('warn'); return; }
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: "/ammpet/public/Ajax_call",
            type: "POST",
            data: {
                operation: "submit",
                class: "Params",
                method: "validate_params",
                csrf_token: csrf,
                Id: (idEl? idEl.value : 'new'),
                Created_By: (createdByEl? createdByEl.value : ''),
                Updated_By: (updatedByEl? updatedByEl.value : ''),
                Name: ym.name,
                Value: val,
                Type: (typeEl? typeEl.value : 'BANHISTAS_PRE_CLOSING'),
                Status: 'Ativo'
            },
            success: function(){
                // Refresh from server and finalize visuals
                fetchBanhistas();
                if (outEl) { outEl.blur(); }
            },
            error: function(){
                setBanhistasVisual('warn');
                if (document.getElementById('error_message')) {
                    document.getElementById('error_message').innerText = 'Falha ao atualizar parâmetro de banhistas.';
                }
            }
        });
    });

    function splitUrlEncoded(str) {
        var result = {};
        str.split('&').forEach(pair => {
          const [key, value] = pair.split('=');
          result[key] = value;
        });
        return result;
      }

});
