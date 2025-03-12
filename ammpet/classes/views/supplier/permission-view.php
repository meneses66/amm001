<div id="permission" style="display:none">
    <div class="row">
        <input id="permission_id" type="hidden" name="Permission">
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p></p>
        </div>
        <div class="col-sm-2">
            <p>Visualizar</p>
        </div>
        <div class="col-sm-2">
            <p>Criar</p>
        </div>
        <div class="col-sm-2">
            <p>Editar</p>
        </div>
        <div class="col-sm-2">
            <p>Deletar</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Clientes</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="client_view" name="client_view" value="client_view" onclick="setPermission()">
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="client_add" name="client_add" value="client_add">
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="client_edit" name="client_edit" value="client_edit">
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="client_delete" name="client_delete" value="client_delete">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Fornecedores</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="supplier_view" name="supplier_view" value="supplier_view">
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="supplier_add" name="supplier_add" value="supplier_add">
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="supplier_edit" name="supplier_edit" value="supplier_edit">
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="supplier_delete" name="supplier_delete" value="supplier_delete">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Parâmetros</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="params_view" name="params_view" value="params_view">
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="params_add" name="params_add" value="params_add">
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="params_edit" name="params_edit" value="params_edit">
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="params_delete" name="params_delete" value="params_delete">
        </div>
    </div>
</div>    