<?php

namespace Controller;

//if(session_status() === PHP_SESSION_NONE) session_start();

restart_session();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class Product {

    use _GlobalController;
    private $object = 'product';
    private $UCF_object = 'Product';
    private $OrderItem = 'OrderItem';

    public function index()
    {

    }


    //SESSION TO LOAD HTML FORMS:
    //LOAD HTML FORM FOR INSERTING AND UPDATING RECORD
    public function load_product_form(){

        if (isset($_GET['id'])){

            $output = "";

            //DEFINIR VARIAVEIS PARA OS INPUTS:

            $id = $_GET['id'];
            $created_by = $_SESSION['username'];
            $updated_by = $_SESSION['username'];
            $code = null;
            $name = null;
            $category = "";
            $supplier = null;
            $status = "Ativo";
            $price = null;
            $flag1 = 0;
            $comission_flg = 0;
            $center = "Loja";
            $external_cost = 0; 
            $comission_percentage = 0;
            $price_cash = null;
            $price_pix = null;
            $comission_overwrite_flg = 0;

            if (!($id=='new')) {
                $inputs["ID"]=$_GET['id'];
                $model = new('\Model\\'.$this->UCF_object);
                
                $data = $model->getRow($inputs);
                if($data){
                    foreach ($data as $key => $value) {
                        $data_form[$key]=$value;
                    }

                    $updated_by = $_SESSION['username'];
                    $code = $data_form['CODE'];
                    $name = $data_form['NAME'];
                    $category = $data_form['CATEGORY'];
                    $supplier = $data_form['SUPPLIER'];
                    $status = $data_form['STATUS'];
                    $price = $data_form['PRICE'];
                    $flag1 = $data_form['FLAG1'];
                    $comission_flg = $data_form['COMISSION_FLG'];
                    $center = $data_form['CENTER'];
                    $external_cost = $data_form['EXTERNAL_COST']; 
                    $comission_percentage = $data_form['COMISSION_PERCENTAGE'];
                    $price_cash = $data_form['PRICE_CASH'];
                    $price_pix = $data_form['PRICE_PIX'];
                    $comission_overwrite_flg = $data_form['COMISSION_OVERWRITE_FLG'];

                }
                unset($data_form);
                unset($inputs);
            }
                //FOR EACH DROPDOWN GET $data_form and send to load_options_update to get the selected option
                //$data_form_category = $data_form['CATEGORY'];
                $category_option_list = load_options_update("PROD_CATEGORY", "Ativo", $category);

                //FOR EACH FLAG CONVERT TINNY TO CHECKED:
                $flag_comission = ($comission_flg==1) ? "checked" : "";
                $flag_comission_overwrite = ($comission_overwrite_flg==1) ? "checked" : "";
                $flag_flag1 = ($flag1==1) ? "checked" : "";


                //START TO LOAD THE UPDATE FORM:
                $output .= '<div class="row">
                                <div class="col-sm-1">
                                    <label for="id" class="medium-label">Id:</label>
                                </div>
                                <div class="col-sm-6">
                                    <input id="id" type="text" name="Id" value="'.$id.'" readonly>
                                    <input id="type" type="hidden" name="Type" value="Prod">
                                    <input id="created_by" type="hidden" name="Created_By" value="'.$created_by.'">
                                    <input id="updated_by" type="hidden" name="Updated_By" value="'.$updated_by.'">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="name" class="medium-label">Nome: *</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="name" type="text" size="30" name="Name" value="'.$name.'" required>
                                </div>
                                <div class="col-sm-1">
                                    <label for="code" class="medium-label">Código: *</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="code" type="text" size="30" name="Code" value="'.$code.'" required>
                                </div>
                                <div class="col-sm-1">
                                    <label for="price" class="medium-label">Preço: *</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="price" type="number" size="10" name="Price" value="'.$price.'" step="0.01" required>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="center" class="medium-label">Centro:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="center" type="text" size="30" name="Center" value="Loja" readonly>
                                </div>
                                <div class="col-sm-1">
                                    <label for="category" class="medium-label">Categoria: *</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="category" name="Category">
                                        <option class="medium-label" value="" selected>Selecione uma opção</option>
                                        '.$category_option_list.'
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="price_cash" class="medium-label">Preço Din.: *</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="price_cash" type="number" size="10" name="Price_cash" value="'.$price_cash.'" step="0.01" required>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="group_x" class="medium-label">Grupo:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="group_x" type="text" size="30" name="Group_x" value="Item" readonly>
                                </div>
                                <div class="col-sm-1">
                                    <label for="supplier" class="medium-label">Fornecedor:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="supplier" type="text" size="30" name="Supplier" value="'.$supplier.'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="price_pix" class="medium-label">Preço Pix: *</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="price_pix" type="number" size="10" name="Price_pix" value="'.$price_pix.'" step="0.01" required>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="comission_flg" class="medium-label">Comissão?:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="comission_flg" type="checkbox" name="Comission_flg" '.$flag_comission.'>
                                </div>
                                <div class="col-sm-1">
                                    <label for="comission_overwrite_flg" class="medium-label">Sobrescrever comissão:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="comission_overwrite_flg" type="checkbox" size="30" name="Comission_overwrite_flg" '.$flag_comission_overwrite.'>
                                </div>
                                <div class="col-sm-1">
                                    <label for="comission_percentage" class="medium-label">% Comissão:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="comission_percentage" type="number" size="10" name="Comission_percentage" value="'.$comission_percentage.'" step="0.01">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="status" class="medium-label">Status:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="status" name="Status">
                                        <option class="medium-label" value="Ativo" '.(($status == 'Ativo')?"selected":"").'>Ativo</option>
                                        <option class="medium-label" value="Desativado" '.(($status == 'Desativado')?"selected":"").'>Desativado</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="flag1" class="medium-label">Flag1</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="flag1" type="checkbox" name="Flag1" '.$flag_flag1.'>
                                </div>
                                <div class="col-sm-1">
                                    <label for="external_cost" class="medium-label">Custo Externo:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="external_cost" type="number" size="10" name="External_cost" value="'.$external_cost.'" step="0.01">
                                </div>
                            </div><br>';

                            //INCLUDE BUTTONS:
                            if ($id=="new") {
                                $output .= '<div class="row">
                                                <div class="col-sm-6">
                                                    <a href="'.ROOT.'/Product/_list" class="btn btn-secondary btn-lg m-1 btn-block">Voltar</a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="save_submit" value="Salvar" formaction="../Product/insert_call">
                                                </div>
                                            </div>';
                            } else {
                                $output .= '<div class="row">
                                                <div class="col-sm-6">
                                                    <a href="'.ROOT.'/Product/_list" class="btn btn-secondary btn-lg m-1 btn-block">Voltar</a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="save_submit" value="Salvar" formaction="../Product/update_call?id='.$id.'">
                                                </div>
                                            </div>';
                            }

                            $sql_stm = null;
                            $data = null;
                            $model = null;
            
                            echo $output;
        } else{
            $sql_stm = null;
            $data = null;
            $model = null;

            show("No record to display!");
        }

    }

    //LOAD HTML FOR LISTING RECORDS IN TABLE
    public function load_rows($inputs){
        
        //restart_session();
        $product_edit_check = check_permission($_SESSION['username'], "product_edit");
        $product_delete_check = check_permission($_SESSION['username'], "product_delete");
        $orderitemprod_add_check = check_permission($_SESSION['username'], "orderitemprod_add");

        $inputs_buttons=$inputs['buttons'];
        $inputs_cli_id=$inputs['cli_id'];
        $inputs_order_id=$inputs['order_id'];
        $output = "";
        //$model = new \Model\Params;
        $model = new('\Model\\'.$this->UCF_object);
        $inputs_stm['TYPE']="PROD";
        
        $data = $model->listWhere($inputs_stm);
        if($model->countWhere($inputs_stm)>0){
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Preço</th>
                                <th>Preço Dinh.</th>
                                <th>Preço Pix</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($data as $row) {

                $array=null;
                foreach ($row as $key => $value) {
                    //$array .= "\"".$key."\"=\"".$value."\"";
                    $array .= "'".$key."':'".$value."',";
                }
                $array = trim($array,",");

                $output .='<tr class="text-center text-secondary">
                            <td>'.$row->ID.'</td>
                            <td>'.$row->UPDATED.'</td>
                            <td>'.$row->NAME.'</td>
                            <td>'.$row->CATEGORY.'</td>
                            <td>'.$row->PRICE.'</td>
                            <td>'.$row->PRICE_CASH.'</td>
                            <td>'.$row->PRICE_PIX.'</td>
                            <td>'.$row->STATUS.'</td>
                            <td>
                                '.(($inputs_buttons == $this->OrderItem && $orderitemprod_add_check) ? '<a href="' . ROOT . '/OrderItem/_insert_product?cli_id=' . $inputs_cli_id . '&order_id=' . $inputs_order_id . '&product={' . $array . '}" title="New_Product" class="text-primary newOrderBtn" cli_id="' . $inputs_cli_id . '" order_id="' . $inputs_order_id . '"><i class="fas fa-plus"></i></a>' : '').'
                                '.(($inputs_buttons == $this->UCF_object && $product_edit_check) ? '<a href="' . ROOT . '/' . $this->UCF_object . '/_new?id=' . $row->ID . '" title="Edit" class="text-primary updateBtn" id="' . $row->ID . '"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;' : '').'
                                '.(($inputs_buttons == $this->UCF_object && $product_delete_check) ? '<a href="' . ROOT . '/' . $this->UCF_object . '/_delete?id=' . $row->ID . '" title="Delete" class="text-danger deleteBtn" id="' . $row->ID . '"><i class="fas fa-eraser"></i></a>' : '').'
                            </td></tr>';
            }
            $output .= '</tbody>';
            $sql_stm = null;
            unset_array($inputs);
            $data = null;
            $model = null;

            echo $output;
        }
        else{
            $sql_stm = null;
            unset_array($inputs);
            $data = null;
            $model = null;

            echo '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3>';
        }
    }

    public function validate_product($inputs){
        $error=0;
        $error_msg="";
        if (isset($inputs['operation'])) {
            if ( $inputs['Name']==null || $inputs['Name']=="") {
                $error=1;
                $error_msg .= "Indique um valor para \"Nome\".\n";
            }
            if ( $inputs['Code']==null || $inputs['Code']=="") {
                $error=1;
                $error_msg .= "Indique um valor para \"Código\".\n";
            }
            if ( $inputs['Price']==null || $inputs['Price']=="" || $inputs['Price']<=0 ) {
                $error=1;
                $error_msg .= "Indique um valor para \"Preço\" > 0.\n";
            }
            if ( $inputs['Price_cash']==null || $inputs['Price_cash']=="" || $inputs['Price_cash']<=0 ) {
                $error=1;
                $error_msg .= "Indique um valor para \"Preço Dinh.\" > 0.\n";
            }
            if ( $inputs['Price_pix']==null || $inputs['Price_pix']=="" || $inputs['Price_pix']<=0 ) {
                $error=1;
                $error_msg .= "Indique um valor para \"Preço Pix\" > 0.\n";
            }
            if ( $inputs['Category']==null || $inputs['Category']=="" || $inputs['Category']=="Selecione uma opção" ) {
                $error=1;
                $error_msg .= "Selecione uma opção para \"Categoria\".\n";
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

                if (isset($_POST['Flag1'])) {
                    $_POST['Flag1']=1;
                }
                if (isset($_POST['Comission_flg'])) {
                    $_POST['Comission_flg']=1;
                }
                if (isset($_POST['Comission_overwrite_flg'])) {
                    $_POST['Comission_overwrite_flg']=1;
                }

                unset($_POST['operation']);
                unset($_POST['class']);
                unset($_POST['method']);
                $_SERVER['REQUEST_METHOD']="POST";
                $_POST['class']="Product";

                if ($inputs['Id']=="new") {
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