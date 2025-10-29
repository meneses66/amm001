<?php

namespace Controller;

//if(session_status() === PHP_SESSION_NONE) session_start();

restart_session();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class OrderItem {

    use _GlobalController;
    private $object = 'orderitem';
    private $UCF_object = 'OrderItem';
    private $parent_object = 'Orderx';

    public function index()
    {

    }

    //SESSION TO LOAD HTML FORMS:

    //LOAD HTML FOR LISTING RECORDS IN TABLE
    public function load_rows(){
        
        //restart_session();
        $output = "";
        $model = new('\Model\\'.$this->UCF_object);
        
        $data = $model->listAll();
        if($data){
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Tipo</th>
                                <th>Status</th>
                                <th>Comentários</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($data as $row) {
                $output .='<tr class="text-center text-secondary">
                            <td>'.esc($row->ID).'</td>
                            <td>'.esc($row->UPDATED).'</td>
                            <td>'.esc($row->NAME).'</td>
                            <td>'.esc($row->VALUE).'</td>
                            <td>'.esc($row->TYPE).'</td>
                            <td>'.esc($row->STATUS).'</td>
                            <td>'.esc($row->COMMENT).'</td>
                            <td>
                                <a href="'.ROOT.'/'.$this->UCF_object.'/_update?id='.esc($row->ID).'" title="Edit" class="text-primary updateBtn" id="'.esc($row->ID).'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                <a href="'.ROOT.'/'.$this->UCF_object.'/_delete?id='.esc($row->ID).'" title="Delete" class="text-danger deleteOIBtn" id="'.esc($row->ID).'" order_id="'.esc($row->ID_ORDER).'" package_id="'.esc($row->ID_package).'"><i class="fas fa-eraser"></i></a>
                            </td></tr>';
            }
            $output .= '</tbody>';
            $model = null;
            $data = null;

            echo $output;
        }
        else{
            $model = null;
            $data = null;

            echo '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3>';
        }
    }

    //LOAD HTML FORM FOR UPDATING SERVICE RECORD
    public function load_update_form(){

        if (isset($_GET['item_id'])){

            //if(session_status() === PHP_SESSION_NONE) session_start();
            //restart_session();

            $output = "";
            $inputs["ID"]=$_GET['item_id'];
            $id=$_GET['item_id'];
            $order_id = $_GET['order_id'];
            $client_id = $_GET['cli_id'];
            $model = new('\Model\\'.$this->UCF_object);
            
            $data = $model->getRow($inputs);

            if($data){

                foreach ($data as $key => $value) {
                    $data_form[$key]=$value;
                }

                //FOR EACH DROPDOWN GET $data_form and send to load_options_update to get the selected option
                //$data_form_type = $data_form['TYPE'];
                //$type_option_list = load_options_update("SUPPLIER_TYPE", "Ativo", $data_form_type);

                //DEFINE FLAGS:
                $flag_contrario = ($data_form['FLAG_CONTRARIO']==1) ? "checked" : "";
                $flag_otite = ($data_form['FLAG_OTITE']==1) ? "checked" : "";
                $flag_olhos_verm = ($data_form['FLAG_OLHOS_VERM']==1) ? "checked" : "";
                $flag_pulga = ($data_form['FLAG_PULGA']==1) ? "checked" : "";
                $flag_carrapato = ($data_form['FLAG_CARRAPATO']==1) ? "checked" : "";
                $flag_dermatite = ($data_form['FLAG_DERMATITE']==1) ? "checked" : "";
                $flag_ferida = ($data_form['FLAG_FERIDA']==1) ? "checked" : "";
                $flag_outro = ($data_form['FLAG_OUTRO']==1) ? "checked" : "";

                //START TO LOAD THE UPDATE FORM:
                $output .= '<div class="row">
                                <input id="id" type="hidden" name="Id" readonly value="'.$data_form['ID'].'">
                                <input id="id_client" type="hidden" name="Id_Client" readonly value="'.$data_form['ID_CLIENT'].'">
                                <input id="id_order" type="hidden" name="Id_Order" readonly value="'.$data_form['ID_ORDER'].'">
                                <input id="updated_by" type="hidden" name="Updated_By" readonly value="'.$_SESSION['username'].'">
                                <input id="temp_package" type="hidden" name="temp_package" readonly value="'.$data_form['ID_PACKAGE'].'">
                                <input id="temp_executor" type="hidden" name="temp_executor" readonly value="'.$data_form['SERV_EXECUTOR'].'">
                                <input id="temp_salesperson" type="hidden" name="temp_salesperson" readonly value="'.$data_form['SALESPERSON'].'">
                                <input id="temp_id_animal_pkg" type="hidden" name="temp_id_animal_pkg" readonly value="'.$data_form['ID_PACKAGE_ANIMAL'].'">
                                <input id="oi_price_cash" type="hidden" name="OI_Price_Cash" readonly value="'.$data_form['OI_PRICE_CASH'].'">
                                <input id="oi_price_pix" type="hidden" name="OI_Price_Pix" readonly value="'.$data_form['OI_PRICE_PIX'].'">
                                <input id="package_sequence" type="hidden" name="Package_Sequence" readonly value="'.$data_form['PACKAGE_SEQUENCE'].'">
                                <input id="package_consume" type="hidden" name="Package_Consume" readonly value="'.$data_form['PACKAGE_CONSUME'].'">
                                <input id="package_amount" type="hidden" name="Package_Amount" readonly value="'.$data_form['PACKAGE_AMOUNT'].'">
                                <input id="prod_serv_category" type="hidden" name="Prod_Serv_Category" readonly value="'.$data_form['PROD_SERV_CATEGORY'].'">
                                <input id="prod_serv_type" type="hidden" name="Prod_Serv_Type" readonly value="'.$data_form['PROD_SERV_TYPE'].'">
                                <input id="id_prod_serv" type="hidden" name="Id_Prod_Serv" readonly value="'.$data_form['ID_PROD_SERV'].'">
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="prodserv_code" class="medium-label">Cód:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="prodserv_code" type="text" size="20" name="Prodserv_Code" readonly value="'.$data_form['PRODSERV_CODE'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="item_description" class="medium-label">Desc.:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="item_description" type="text" size="25" name="Item_Description" readonly value="'.$data_form['ITEM_DESCRIPTION'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="id_package_animal" class="medium-label">Ani.Pct.:</label>
                                </div>
                                <div class="col-sm-2">
                                    <select class="medium-label" id="id_package_animal" name="Id_Package_Animal">

                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="quantity" class="medium-label">Qtde:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="quantity" type="text" size="15" name="Quantity" onInput="calculate_item_service()" value="'.$data_form['QUANTITY'].'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="id_package" class="medium-label">Pacote:</label>
                                </div>
                                <div class="col-sm-2">
                                    <select class="medium-label" id="id_package" name="Id_Package" onChange="calculate_item_service()">

                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="package_service" class="medium-label">Serv.Pct.:</label>
                                </div>
                                <div class="col-sm-2">
                                    <select class="medium-label" id="package_service" name="Package_Service">
                                        <option class="medium-label" value="Banho" '.(($data_form['PACKAGE_SERVICE'] == 'Banho')?"selected":"").'>Banho</option>
                                        <option class="medium-label" value="Banho + Tosa Hig" '.(($data_form['PACKAGE_SERVICE'] == 'Banho + Tosa Hig')?"selected":"").'>Banho + Tosa Hig</option>
                                        <option class="medium-label" value="Banho + Hidrat" '.(($data_form['PACKAGE_SERVICE'] == 'Banho + Hidrat')?"selected":"").'>Banho + Hidrat</option>
                                        <option class="medium-label" value="Banho + Tosa Hig + Hidrat" '.(($data_form['PACKAGE_SERVICE'] == 'Banho + Tosa Hig + Hidrat')?"selected":"").'>Banho + Tosa Hig + Hidrat</option>
                                        <option class="medium-label" value="Banho + Tosa Tesoura" '.(($data_form['PACKAGE_SERVICE'] == 'Banho + Tosa Tesoura')?"selected":"").'>Banho + Tosa Tesoura</option>
                                        <option class="medium-label" value="Banho + Tosa Maq" '.(($data_form['PACKAGE_SERVICE'] == 'Banho + Tosa Maq')?"selected":"").'>Banho + Tosa Maq</option>
                                        <option class="medium-label" value="Pacote expirado" '.(($data_form['PACKAGE_SERVICE'] == 'Pacote expirado')?"selected":"").'>Pacote expirado</option>
                                        <option class="medium-label" value="Falta sem justificativa" '.(($data_form['PACKAGE_SERVICE'] == 'Falta sem justificativa')?"selected":"").'>Falta sem justificativa</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-1">
                                    <label for="unit_value" class="medium-label">Valor Unit.:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="unit_value" type="text" size="15" oninput="calculate_item_service(this.value)" onkeyup="calculate_item_service(this.value)" onblur="calculate_item_service_sync(this.value, true)" onchange="calculate_item_service_sync(this.value, true)" name="Unit_Value" value="'.$data_form['UNIT_VALUE'].'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="serv_executor" class="medium-label">Executor:</label>
                                </div>
                                <div class="col-sm-2">
                                    <select class="medium-label" id="serv_executor" name="Serv_Executor">

                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="date" class="medium-label">Data:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="date" type="date" size="20" name="Date" value="'.$data_form['DATE'].'">
                                </div>
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-2">
                                    
                                </div>
                                <div class="col-sm-1">
                                    <label for="discount_value" class="medium-label">Desc. Valor:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="discount_value" type="text" size="15" name="Discount_Value" oninput="calculate_item_service(this.value)" onkeyup="calculate_item_service(this.value)" onblur="calculate_item_service_sync(this.value, true)" onchange="calculate_item_service_sync(this.value, true)" value="'.$data_form['DISCOUNT_VALUE'].'">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="blade" class="medium-label">Lâm./Adap.Corpo:</label>
                                </div>
                                <div class="col-sm-2">
                                    <select class="medium-label" id="blade" name="Blade">
                                        <option class="medium-label" value="" '.(($data_form['BLADE'] == '')?"selected":"").'>Selecione uma opção</option>
                                        <option class="medium-label" value="Lam01" '.(($data_form['BLADE'] == 'Lam01')?"selected":"").'>Lam01</option>
                                        <option class="medium-label" value="Lam02" '.(($data_form['BLADE'] == 'Lam02')?"selected":"").'>Lam02</option>
                                        <option class="medium-label" value="Lam03" '.(($data_form['BLADE'] == 'Lam03')?"selected":"").'>Lam03</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="adap_pata" class="medium-label">Adap.Pata:</label>
                                </div>
                                <div class="col-sm-2">
                                    <select class="medium-label" id="adap_pata" name="Adap_Pata">
                                        <option class="medium-label" value="" '.(($data_form['ADAP_PATA'] == '')?"selected":"").'>Selecione uma opção</option>
                                        <option class="medium-label" value="Lam01" '.(($data_form['ADAP_PATA'] == 'Lam01')?"selected":"").'>Lam01</option>
                                        <option class="medium-label" value="Lam02" '.(($data_form['ADAP_PATA'] == 'Lam02')?"selected":"").'>Lam02</option>
                                        <option class="medium-label" value="Lam03" '.(($data_form['ADAP_PATA'] == 'Lam03')?"selected":"").'>Lam03</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <input id="flag_contrario" type="checkbox" name="Flag_Contrario" '.$flag_contrario.'>
                                </div>
                                <div class="col-sm-2">
                                    <label for="flag_contrario" class="medium-label">Ao contrário</label>
                                </div>
                                <div class="col-sm-1">
                                    <label for="total_cash" class="medium-label">Total Dinh:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="total_cash" type="text" size="15" name="Total_Cash" readonly value="'.$data_form['TOTAL_CASH'].'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <input id="flag_otite" type="checkbox" name="Flag_Otite" '.$flag_otite.'>
                                </div>
                                <div class="col-sm-2">
                                    <label for="flag_otite" class="medium-label">Otite</label>
                                </div>
                                <div class="col-sm-1">
                                    <input id="flag_pulga" type="checkbox" name="Flag_Pulga" '.$flag_pulga.'>
                                </div>
                                <div class="col-sm-2">
                                    <label for="flag_pulga" class="medium-label">Pulga</label>
                                </div>
                                <div class="col-sm-1">
                                    <input id="flag_carrapato" type="checkbox" name="Flag_Carrapato" '.$flag_carrapato.'>
                                </div>
                                <div class="col-sm-2">
                                    <label for="flag_carrapato" class="medium-label">Carrapato</label>
                                </div>
                                <div class="col-sm-1">
                                    <label for="total_pix" class="medium-label">Total Pix:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="total_pix" type="text" size="15" name="Total_Pix" readonly value="'.$data_form['TOTAL_PIX'].'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <input id="flag_ferida" type="checkbox" name="Flag_Ferida" '.$flag_ferida.'>
                                </div>
                                <div class="col-sm-2">
                                    <label for="flag_ferida" class="medium-label">Ferida</label>
                                </div>
                                <div class="col-sm-1">
                                    <input id="flag_dermatite" type="checkbox" name="Flag_Dermatite" '.$flag_dermatite.'>
                                </div>
                                <div class="col-sm-2">
                                    <label for="flag_dermatite" class="medium-label">Dermatite</label>
                                </div>
                                <div class="col-sm-1">
                                    <input id="flag_olhos_verm" type="checkbox" name="Flag_Olhos_Verm" '.$flag_olhos_verm.'>
                                </div>
                                <div class="col-sm-2">
                                    <label for="flag_contrario" class="medium-label">Olhos Verm.</label>
                                </div>
                                <div class="col-sm-1">
                                    <label for="value_no_discount" class="medium-label">Valor s/ Desc:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="value_no_discount" type="text" size="15" readonly name="Value_No_Discount" value="'.$data_form['VALUE_NO_DISCOUNT'].'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <input id="flag_outro" type="checkbox" name="Flag_Outro" '.$flag_outro.'>
                                </div>
                                <div class="col-sm-2">
                                    <label for="flag_outro" class="medium-label">Outro</label>
                                </div>
                                <div class="col-sm-1">
                                    <label for="checklist_description" class="medium-label">Descrição:</label>
                                </div>
                                <div class="col-sm-2">
                                    <textarea id="checklist_description" name="Checklist_Description" rows="2" cols="30">'.$data_form['CHECKLIST_DESCRIPTION'].'</textarea>
                                </div>
                                <div class="col-sm-1">
                                    <label for="salesperson" class="medium-label">Vendedor:</label>
                                </div>
                                <div class="col-sm-2">
                                    <select class="medium-label" id="salesperson" name="Salesperson">

                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="value_with_discount" class="medium-label">Valor Final:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="value_with_discount" type="text" size="15" readonly name="Value_With_Discount" value="'.$data_form['VALUE_WITH_DISCOUNT'].'">
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    
                                </div>
                                <div class="col-sm-6">
                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Confirmar" formaction="../OrderItem/update_call?cli_id='.$data_form['ID_CLIENT'].'&order_id='.$data_form['ID_ORDER'].'&item_id='.$data_form['ID'].'">
                                </div>
                            </div>';
                            $sql_stm = null;
                            unset_array($inputs);
                            $data = null;
                            $model = null;
                            echo $output;
            } else{
                $sql_stm = null;
                unset_array($inputs);
                $data = null;
                $model = null;
                show("No record to display!");
            }

        }

    }

    //LOAD HTML FORM FOR UPDATING PRODUCT RECORD
    public function load_update_prod_form(){

        if (isset($_GET['item_id'])){

            //if(session_status() === PHP_SESSION_NONE) session_start();
            //restart_session();
            
            $output = "";
            $inputs["ID"]=$_GET['item_id'];
            $id=$_GET['item_id'];
            $order_id = $_GET['order_id'];
            $client_id = $_GET['cli_id'];
            $model = new('\Model\\'.$this->UCF_object);
            
            $data = $model->getRow($inputs);

            if($data){

                foreach ($data as $key => $value) {
                    $data_form[$key]=$value;
                }

                //DEFINE FLAGS:

                //START TO LOAD THE UPDATE FORM:
                $output .= '<div class="row">
                                <input id="id" type="hidden" name="Id" readonly value="'.$data_form['ID'].'">
                                <input id="id_client" type="hidden" name="Id_Client" readonly value="'.$data_form['ID_CLIENT'].'">
                                <input id="id_order" type="hidden" name="Id_Order" readonly value="'.$data_form['ID_ORDER'].'">
                                <input id="updated_by" type="hidden" name="Updated_By" readonly value="'.$_SESSION['username'].'">
                                <input id="temp_salesperson" type="hidden" name="temp_salesperson" readonly value="'.$data_form['SALESPERSON'].'">
                                <input id="oi_price_cash" type="hidden" name="OI_Price_Cash" readonly value="'.$data_form['OI_PRICE_CASH'].'">
                                <input id="oi_price_pix" type="hidden" name="OI_Price_Pix" readonly value="'.$data_form['OI_PRICE_PIX'].'">
                                <input id="prod_serv_category" type="hidden" name="Prod_Serv_Category" readonly value="'.$data_form['PROD_SERV_CATEGORY'].'">
                                <input id="prod_serv_group" type="hidden" name="Prod_Serv_Group" readonly value="'.$data_form['PROD_SERV_GROUP'].'">
                                <input id="prod_serv_type" type="hidden" name="Prod_Serv_Type" readonly value="'.$data_form['PROD_SERV_TYPE'].'">
                                <input id="id_prod_serv" type="hidden" name="Id_Prod_Serv" readonly value="'.$data_form['ID_PROD_SERV'].'">
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="prodserv_code" class="medium-label">Cód:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="prodserv_code" type="text" size="20" name="Prodserv_Code" readonly value="'.$data_form['PRODSERV_CODE'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="item_description" class="medium-label">Desc.: *</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="item_description" type="text" size="25" name="Item_Description" value="'.$data_form['ITEM_DESCRIPTION'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="quantity" class="medium-label">Qtde: *</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="quantity" type="text" size="15" name="Quantity" onInput="calculate_item_product()" value="'.$data_form['QUANTITY'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="total_cash" class="medium-label">Total Dinh:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="total_cash" type="text" size="15" name="Total_Cash" readonly value="'.$data_form['TOTAL_CASH'].'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-2">
                                    
                                </div>
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-2">
                                    
                                </div>
                                <div class="col-sm-1">
                                    <label for="unit_value" class="medium-label">Valor Unit.: *</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="unit_value" type="text" size="15" onInput="calculate_item_product(this.value)" name="Unit_Value" value="'.$data_form['UNIT_VALUE'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="total_pix" class="medium-label">Total Pix:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="total_pix" type="text" size="15" name="Total_Pix" readonly value="'.$data_form['TOTAL_PIX'].'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="salesperson" class="medium-label">Vendedor:</label>
                                </div>
                                <div class="col-sm-2">
                                    <select class="medium-label" id="salesperson" name="Salesperson">

                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="date" class="medium-label">Data:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="date" type="date" size="20" name="Date" value="'.$data_form['DATE'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="discount_value" class="medium-label">Desc. Valor:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="discount_value" type="text" size="15" name="Discount_Value" oninput="calculate_item_product(this.value)" onkeyup="calculate_item_product(this.value)" onblur="calculate_item_product_sync(this.value, true)" onchange="calculate_item_product_sync(this.value, true)" value="'.$data_form['DISCOUNT_VALUE'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="value_no_discount" class="medium-label">Valor s/ Desc:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="value_no_discount" type="text" size="15" readonly name="Value_No_Discount" value="'.$data_form['VALUE_NO_DISCOUNT'].'">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-2">
                                    
                                </div>
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-2">
                                    
                                </div>
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-2">
                                    
                                </div>
                                <div class="col-sm-1">
                                    <label for="value_with_discount" class="medium-label">Valor Final:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="value_with_discount" type="text" size="15" readonly name="Value_With_Discount" value="'.$data_form['VALUE_WITH_DISCOUNT'].'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    
                                </div>
                                <div class="col-sm-6">
                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Confirmar" formaction="../OrderItem/update_call?cli_id='.$data_form['ID_CLIENT'].'&order_id='.$data_form['ID_ORDER'].'&item_id='.$data_form['ID'].'">
                                </div>
                            </div>';
                            $sql_stm = null;
                            unset_array($inputs);
                            $data = null;
                            $model = null;
                            echo $output;
            } else{
                $sql_stm = null;
                unset_array($inputs);
                $data = null;
                $model = null;
                show("No record to display!");
            }

        }

    }

    //FUNCTION USED TO PRE-VALIDATE ORDER ITEM SERVICE INFO BEFORE IT'S SUBMITTED
    public function validate_oi_service($inputs){
        $error=0;
        $error_msg="";
        if (isset($inputs['operation'])) {
            if ( $inputs['Quantity']==null || $inputs['Quantity']=="" || $inputs['Quantity']<=0) {
                $error=1;
                $error_msg .= "Indique um valor para \"Qtde\".\n";
            }
            if ( $inputs['Unit_Value']==null || $inputs['Unit_Value']=="" || $inputs['Unit_Value']<=0) {
                $error=1;
                $error_msg .= "Indique um valor para \"Valor Unit.\".\n";
            }
            if ( $inputs['Prod_Serv_Category']=="Pacote" && ($inputs['Id_Package_Animal'] == 1 || $inputs['Id_Package_Animal'] == "1")) {
                $error=1;
                $error_msg .= "Selecione um Animal para o Pacote.\n";
            }

            //IF ANY ERROR FOUND: RETURN ERROR
            if ($error == 1) {
                //amm_log(date("H:i:s").":: Error: ".$error." | Error_Msg: ".$error_msg);
                return $error_msg;
            } 

            //IF NO ERROR PROCESS WITH INSERT (id=new) OR UPDATE
            else {
                //amm_log(date("H:i:s").":: NO Errors");
                unset($_POST);

                foreach ($inputs as $key => $value) {
                    $_POST[$key]=$value;
                }

                unset($_POST['operation']);
                unset($_POST['class']);
                unset($_POST['method']);
                $_SERVER['REQUEST_METHOD']="POST";
                $_POST['class']="OrderItem";
                // Mark nested call as internal and provide CSRF token
                $_POST['csrf_token'] = csrf_token();
                $_POST['type'] = 'static';

                if ($inputs['Id']=="new") {
                    //amm_log(date("H:i:s").":: ID = NEW");
                    unset($_POST['Id']);                
                    $_POST['method']="insert_call";
                    $ajax_call = new('\Controller\\'."Ajax_call");
                    $_POST['csrf_token'] = csrf_token();
                    $_POST['type'] = 'static';
                    $ajax_call->index();
                } else{
                    $_POST['method']="update_call";
                    $ajax_call = new('\Controller\\'."Ajax_call");
                    $_POST['csrf_token'] = csrf_token();
                    $_POST['type'] = 'static';
                    $ajax_call->index();
                }
                // Clear any previous output from nested calls (e.g., CSRF warnings)
                if (function_exists('ob_get_level')) {
                    while (ob_get_level() > 0) { @ob_end_clean(); }
                }
                http_response_code(200);
                return "";
            }
        } else{
            return $error_msg="Operation failed";
        }
    }

    //FUNCTION USED TO PRE-VALIDATE ORDER ITEM PRODUCT INFO BEFORE IT'S SUBMITTED
    public function validate_oi_product($inputs){
        $error=0;
        $error_msg="";
        if (isset($inputs['operation'])) {
            if ( $inputs['Quantity']==null || $inputs['Quantity']=="" || $inputs['Quantity']<=0) {
                $error=1;
                $error_msg .= "Indique um valor para \"Qtde\".\n";
            }
            if ( $inputs['Unit_Value']==null || $inputs['Unit_Value']=="" || $inputs['Unit_Value']<=0) {
                $error=1;
                $error_msg .= "Indique um valor para \"Valor Unit.\".\n";
            }
            if ( $inputs['Item_Description']==null || $inputs['Item_Description']=="") {
                $error=1;
                $error_msg .= "Indique um valor para \"Descr.\".\n";
            }

            //IF ANY ERROR FOUND: RETURN ERROR
            if ($error == 1) {
                //amm_log(date("H:i:s").":: Error: ".$error." | Error_Msg: ".$error_msg);
                return $error_msg;
            } 

            //IF NO ERROR PROCESS WITH INSERT (id=new) OR UPDATE
            else {
                //amm_log(date("H:i:s").":: NO Errors");
                unset($_POST);

                foreach ($inputs as $key => $value) {
                    $_POST[$key]=$value;
                }

                unset($_POST['operation']);
                unset($_POST['class']);
                unset($_POST['method']);
                $_SERVER['REQUEST_METHOD']="POST";
                $_POST['class']="OrderItem";

                if ($inputs['Id']=="new") {
                    //amm_log(date("H:i:s").":: ID = NEW");
                    unset($_POST['Id']);                
                    $_POST['method']="insert_call";
                    $ajax_call = new('\Controller\\'."Ajax_call");
                    $ajax_call->index();
                } else{
                    $_POST['method']="update_call";
                    $ajax_call = new('\Controller\\'."Ajax_call");
                    $ajax_call->index();
                }
            }
        } else{
            return $error_msg="Operation failed";
        }
    }
    

}
