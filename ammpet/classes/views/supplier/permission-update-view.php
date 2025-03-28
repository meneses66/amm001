<?php
$inputs["ID"]=$_GET['id'];
            $id=$_GET['id'];
            $model = new('\Model\\'."Supplier");            
            $data = $model->getRowProperty($id, "PERMISSIONS", "SUPPLIER");
            if($data){
                foreach ($data as $key => $value) {
                    $data_form[$key]=$value;
                }
                $array_permissions = (!($data_form['PERMISSIONS']==null || $data_form['PERMISSIONS']=="")) ? explode(",", $data_form['PERMISSIONS']) : [] ;
                //$array_permissions=explode(",", $data_form['PERMISSIONS']);
            }
?>
<div id="permission_div" style="display:block">
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
            <input type="checkbox" id="client_view" name="client_view" value="client_view" <?php if (in_array("client_view",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="client_add" name="client_add" value="client_add" <?php if (in_array("client_add",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="client_edit" name="client_edit" value="client_edit" <?php if (in_array("client_edit",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="client_delete" name="client_delete" value="client_delete" <?php if (in_array("client_delete",$array_permissions)){ echo "checked";}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Fornecedores</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="supplier_view" name="supplier_view" value="supplier_view" <?php if (in_array("supplier_view",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="supplier_add" name="supplier_add" value="supplier_add" <?php if (in_array("supplier_add",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="supplier_edit" name="supplier_edit" value="supplier_edit" <?php if (in_array("supplier_edit",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="supplier_delete" name="supplier_delete" value="supplier_delete" <?php if (in_array("supplier_delete",$array_permissions)){ echo "checked";}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Parâmetros</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="params_view" name="params_view" value="params_view" <?php if (in_array("params_view",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="params_add" name="params_add" value="params_add" <?php if (in_array("params_add",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="params_edit" name="params_edit" value="params_edit" <?php if (in_array("params_edit",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="params_delete" name="params_delete" value="params_delete" <?php if (in_array("params_delete",$array_permissions)){ echo "checked";}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Produtos</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="product_view" name="product_view" value="product_view" <?php if (in_array("product_view",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="product_add" name="product_add" value="product_add" <?php if (in_array("product_add",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="product_edit" name="product_edit" value="product_edit" <?php if (in_array("product_edit",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="product_delete" name="product_delete" value="product_delete" <?php if (in_array("product_delete",$array_permissions)){ echo "checked";}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Serviços</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="service_view" name="service_view" value="service_view" <?php if (in_array("service_view",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="service_add" name="service_add" value="service_add" <?php if (in_array("service_add",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="service_edit" name="service_edit" value="service_edit" <?php if (in_array("service_edit",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="service_delete" name="service_delete" value="service_delete" <?php if (in_array("service_delete",$array_permissions)){ echo "checked";}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Vendas</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="orderx_view" name="orderx_view" value="orderx_view" <?php if (in_array("orderx_view",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="orderx_add" name="orderx_add" value="orderx_add" <?php if (in_array("orderx_add",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="orderx_edit" name="orderx_edit" value="orderx_edit" <?php if (in_array("orderx_edit",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="orderx_delete" name="orderx_delete" value="orderx_delete" <?php if (in_array("orderx_delete",$array_permissions)){ echo "checked";}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Caixa</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="cash_register_view" name="cash_register_view" value="cash_register_view" <?php if (in_array("cash_register_view",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="cash_register_add" name="cash_register_add" value="cash_register_add" <?php if (in_array("cash_register_add",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="cash_register_edit" name="cash_register_edit" value="cash_register_edit" <?php if (in_array("cash_register_edit",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="cash_register_delete" name="cash_register_delete" value="cash_register_delete" <?php if (in_array("cash_register_delete",$array_permissions)){ echo "checked";}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Admin</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="admin_view" name="admin_view" value="admin_view" <?php if (in_array("admin_view",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="admin_add" name="admin_add" value="admin_add" <?php if (in_array("admin_add",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="admin_edit" name="admin_edit" value="admin_edit" <?php if (in_array("admin_edit",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="admin_delete" name="admin_delete" value="admin_delete" <?php if (in_array("admin_delete",$array_permissions)){ echo "checked";}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Agenda</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="agenda_view" name="agenda_view" value="agenda_view" <?php if (in_array("agenda_view",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="agenda_add" name="agenda_add" value="agenda_add" <?php if (in_array("agenda_add",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="agenda_edit" name="agenda_edit" value="agenda_edit" <?php if (in_array("agenda_edit",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="agenda_delete" name="agenda_delete" value="agenda_delete" <?php if (in_array("agenda_delete",$array_permissions)){ echo "checked";}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Salários</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="salary_view" name="salary_view" value="salary_view" <?php if (in_array("salary_view",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="salary_add" name="salary_add" value="salary_add" <?php if (in_array("salary_add",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="salary_edit" name="salary_edit" value="salary_edit" <?php if (in_array("salary_edit",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="salary_delete" name="salary_delete" value="salary_delete" <?php if (in_array("salary_delete",$array_permissions)){ echo "checked";}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Custos</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="cost_view" name="cost_view" value="cost_view" <?php if (in_array("cost_view",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="cost_add" name="cost_add" value="cost_add" <?php if (in_array("cost_add",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="cost_edit" name="cost_edit" value="cost_edit" <?php if (in_array("cost_edit",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="cost_delete" name="cost_delete" value="cost_delete" <?php if (in_array("cost_delete",$array_permissions)){ echo "checked";}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Pre-Fechamento</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="pre_closing_view" name="pre_closing_view" value="pre_closing_view" <?php if (in_array("pre_closing_view",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="pre_closing_add" name="pre_closing_add" value="pre_closing_add" <?php if (in_array("pre_closing_add",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="pre_closing_edit" name="pre_closing_edit" value="pre_closing_edit" <?php if (in_array("pre_closing_edit",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="pre_closing_delete" name="pre_closing_delete" value="pre_closing_delete" <?php if (in_array("pre_closing_delete",$array_permissions)){ echo "checked";}?>>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <p>Fechamento Mês</p>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="month_closing_view" name="month_closing_view" value="month_closing_view" <?php if (in_array("month_closing_view",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="month_closing_add" name="month_closing_add" value="month_closing_add" <?php if (in_array("month_closing_add",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="month_closing_edit" name="month_closing_edit" value="month_closing_edit" <?php if (in_array("month_closing_edit",$array_permissions)){ echo "checked";}?>>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" id="month_closing_delete" name="month_closing_delete" value="month_closing_delete" <?php if (in_array("month_closing_delete",$array_permissions)){ echo "checked";}?>>
        </div>
    </div>
</div>
</div>