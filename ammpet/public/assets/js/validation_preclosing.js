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
    
    // Remove legacy bottom save JS handler; top Save submits normally

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
                Type: (typeEl? typeEl.value : 'BAN_PRE_CLOSING'),
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

    // ===== Calculate commissions (single) =====
    $('#calc_btn').off('click').on('click', function(){
        const year = (document.getElementById('year')||{}).value;
        const month = (document.getElementById('month')||{}).value;
        const emp = (document.getElementById('id_employee')||{}).value;
        const numB = (document.getElementById('number_banhistas')||{}).value;
        if (!year || !month || !emp) {
            if (document.getElementById('error_message')) {
                document.getElementById('error_message').innerText = 'Informe Ano, Mês e Funcionário.';
            }
            return;
        }
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const data = {
            class: 'PreClosing',
            method: 'update_comission',
            csrf_token: csrf,
            Mode: 'calc',
            Year: year,
            Month: month,
            Id_Employee: emp,
            Number_Banhistas: numB || ''
        };
        // Include day factors D01..D31
        for (let d=1; d<=31; d++){
            const key = 'D'+('0'+d).slice(-2);
            const el = document.getElementById(key.toLowerCase());
            if (el) data[key] = el.value;
        }
        $.ajax({
            url: '/ammpet/public/Ajax_call',
            type: 'POST',
            data: data,
            success: function(resp){
                try{
                    let text = (typeof resp === 'string') ? resp : (''+resp);
                    // Normalize and try to extract OK|serv|prod|count even if there is extra output
                    text = (text || '').toString();
                    const m = text.match(/OK\|([^|]+)\|([^|]+)\|([^|]+)/);
                    if (m) {
                        const serv = (m[1]||'').trim();
                        const prod = (m[2]||'').trim();
                        const cnt  = (m[3]||'').trim();
                        const cs = document.getElementById('comission_serv');
                        const cp = document.getElementById('comission_prod');
                        const sc = document.getElementById('serv_count');
                        if (cs) cs.value = serv || '0.00';
                        if (cp) cp.value = prod || '0.00';
                        if (sc) sc.value = cnt || '0';
                        const em = document.getElementById('error_message');
                        if (em) em.innerText = '';
                    } else {
                        const em = document.getElementById('error_message');
                        if (em) em.innerText = text || 'Resposta inválida do servidor.';
                    }
                } catch(e){
                    const em = document.getElementById('error_message');
                    if (em) em.innerText = 'Erro ao calcular comissões.';
                }
            },
            error: function(){
                if (document.getElementById('error_message')) document.getElementById('error_message').innerText = 'Falha na chamada de cálculo de comissões.';
            }
        });
    });

    // ===== Batch create/update commissions for all employees =====
    $('#batch_btn').on('click', function(){
        const year = (document.getElementById('year')||{}).value;
        const month = (document.getElementById('month')||{}).value;
        if (!year || !month) {
            if (document.getElementById('error_message')) {
                document.getElementById('error_message').innerText = 'Informe Ano e Mês.';
            }
            return;
        }
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: '/ammpet/public/Ajax_call',
            type: 'POST',
            data: {
                class: 'PreClosing',
                method: 'update_comission',
                csrf_token: csrf,
                Mode: 'batch',
                Year: year,
                Month: month
            },
            success: function(resp){
                const text = (typeof resp === 'string') ? resp : (''+resp);
                if (document.getElementById('error_message')) document.getElementById('error_message').innerText = text;
            },
            error: function(){
                if (document.getElementById('error_message')) document.getElementById('error_message').innerText = 'Falha na criação/atualização em lote.';
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
