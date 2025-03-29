<?php

namespace Controller;
if(session_status() === PHP_SESSION_NONE) session_start();

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
            
        $output = "";
        $model = new('\Model\\'.$this->UCF_object);
        
        $data = $model->listAll();
        if($model->countAll()>0){
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
                            <td>'.$row->ID.'</td>
                            <td>'.$row->UPDATED.'</td>
                            <td>'.$row->NAME.'</td>
                            <td>'.$row->VALUE.'</td>
                            <td>'.$row->TYPE.'</td>
                            <td>'.$row->STATUS.'</td>
                            <td>'.$row->COMMENT.'</td>
                            <td>
                                <a href="'.ROOT."/$this->UCF_object/_update?id=$row->ID".'" title="Edit" class="text-primary updateBtn" id="'.$row->ID.'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                <a href="'.ROOT."/$this->UCF_object/_delete?id=$row->ID".'" title="Delete" class="text-danger deleteBtn" id="'.$row->ID.'"><i class="fas fa-eraser"></i></a>
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

    

    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_update_form(){

        if (isset($_GET['item_id'])){

            if(session_status() === PHP_SESSION_NONE) session_start();
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
                                <input id="id_client" type="hidden" name="Id_client" readonly value="'.$data_form['ID_CLIENT'].'">
                                <input id="id_order" type="hidden" name="Id_order" readonly value="'.$data_form['ID_ORDER'].'">
                                <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
                                <input id="temp_package" type="hidden" name="temp_package" value="'.$data_form['ID_PACKAGE'].'">
                                <input id="temp_executor" type="hidden" name="temp_executor" value="'.$data_form['SERV_EXECUTOR'].'">
                                <input id="temp_salesperson" type="hidden" name="temp_salesperson" value="'.$data_form['SALESPERSON'].'">
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="prodserv_code" class="medium-label">Cód:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="prodserv_code" type="text" size="20" name="Prodserv_Code" readonly value="'.$data_form['PRODSERV_CODE'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="item_description" class="medium-label">Desc.:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="item_description" type="text" size="25" name="Item_Description" readonly value="'.$data_form['ITEM_DESCRIPTION'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="date" class="medium-label">Data:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="date" type="date" size="20" name="Date" value="'.$data_form['DATE'].'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="id_package" class="medium-label">Pacote:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="id_package" name="Id_Package">

                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="package_service" class="medium-label">Serv.Pct.:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="package_service" type="text" size="20" name="Package_Service" readonly value="'.$data_form['PACKAGE_SERVICE'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="serv_executor" class="medium-label">Executor:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="serv_executor" name="Serv_Executor">

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="quantity" class="medium-label">Qtde:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="quantity" type="text" size="15" name="Quantity" value="'.$data_form['QUANTITY'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="unit_value" class="medium-label">Valor Unit.:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="unit_value" type="text" size="15" name="Unit_Value" value="'.$data_form['UNIT_VALUE'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="discount_value" class="medium-label">Desc. Valor:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="discount_value" type="text" size="15" name="Discount_Value" value="'.$data_form['DISCOUNT_VALUE'].'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="blade" class="medium-label">Lâm./Adap.Corpo:</label>
                                </div>
                                <div class="col-sm-3">
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
                                <div class="col-sm-3">
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
                                <div class="col-sm-3">
                                    <label for="flag_contrario" class="medium-label">Ao contrário</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="total_cash" class="medium-label">Total Dinh:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="total_cash" type="text" size="15" name="Total_Cash" readonly value="'.$data_form['TOTAL_CASH'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="total_pix" class="medium-label">Total Pix:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="total_pix" type="text" size="15" name="Total_Pix" readonly value="'.$data_form['TOTAL_PIX'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="value_no_discount" class="medium-label">Valor s/ Desc:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="value_no_discount" type="text" size="15" readonly name="Value_No_Discount" value="'.$data_form['VALUE_NO_DISCOUNT'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="value_with_discount" class="medium-label">Valor Final:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="value_with_discount" type="text" size="15" readonly name="Value_With_Discount" value="'.$data_form['VALUE_WITH_DISCOUNT'].'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-1">
                                    <label for="salesperson" class="medium-label">Vendedor:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="salesperson" name="Salesperson">

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <input id="flag_otite" type="checkbox" name="Flag_Otite" '.$flag_otite.'>
                                </div>
                                <div class="col-sm-3">
                                    <label for="flag_otite" class="medium-label">Otite</label>
                                </div>
                                <div class="col-sm-1">
                                    <input id="flag_pulga" type="checkbox" name="Flag_Pulga" '.$flag_pulga.'>
                                </div>
                                <div class="col-sm-3">
                                    <label for="flag_pulga" class="medium-label">Pulga</label>
                                </div>
                                <div class="col-sm-1">
                                    <input id="flag_carrapato" type="checkbox" name="Flag_Carrapato" '.$flag_carrapato.'>
                                </div>
                                <div class="col-sm-3">
                                    <label for="flag_carrapato" class="medium-label">Carrapato</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <input id="flag_ferida" type="checkbox" name="Flag_Ferida" '.$flag_ferida.'>
                                </div>
                                <div class="col-sm-3">
                                    <label for="flag_ferida" class="medium-label">Ferida</label>
                                </div>
                                <div class="col-sm-1">
                                    <input id="flag_dermatite" type="checkbox" name="Flag_Dermatite" '.$flag_dermatite.'>
                                </div>
                                <div class="col-sm-3">
                                    <label for="flag_dermatite" class="medium-label">Dermatite</label>
                                </div>
                                <div class="col-sm-1">
                                    <input id="flag_olhos_verm" type="checkbox" name="Flag_Olhos_Verm" '.$flag_olhos_verm.'>
                                </div>
                                <div class="col-sm-3">
                                    <label for="flag_contrario" class="medium-label">Olhos Verm.</label>
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
                                <div class="col-sm-8">
                                    <textarea id="checklist_description" name="Checklist_Description" rows="4" cols="50">
                                    '.$data_form['CHECKLIST_DESCRIPTION'].'
                                    </textarea>
                                </div>
                            </div>
                            <div class="row">
                            </div><br>
                            <div class="row">
                                <div class="col-sm-6">
                                    
                                </div>
                                <div class="col-sm-6">
                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Atualizar" formaction="../OrderItem/update_call?cli_id='.$data_form['ID_CLIENT'].'&order_id='.$data_form['ID_ORDER'].'&item_id='.$data_form['ID'].'">
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

}