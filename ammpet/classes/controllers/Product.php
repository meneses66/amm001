<?php

namespace Controller;
if(session_status() === PHP_SESSION_NONE) session_start();

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

    //LOAD HTML FORM FOR CREATING NEW RECORD
    public function load_new_form(){

        //START SESSION IF NOT STARTED TO GET $SESSION USERNAME
        if(session_status() === PHP_SESSION_NONE) session_start();

        $category_option_list = load_options_new("PROD_CATEGORY", "Ativo");
        //$center_option_list = load_options_new("PROD_CENTER", "Ativo");
        //$groupx_option_list = load_options_new("PROD_GROUPX", "Ativo");

        $output = "";

        //CREATE VIEW HTML STRUCTURE
        $output .= '<div class="row">
                        <div class="col-sm-6">
                            <input id="id" type="hidden" name="Id" value="">
                            <input id="type" type="hidden" name="Type" value="Prod">
                            <input id="created_by" type="hidden" name="Created_by" value="'.$_SESSION['username'].'">
                            <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
                            <input id="created" type="hidden" name="Created" value="">
                            <input id="updated" type="hidden" name="Updated" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="name" class="medium-label">Nome:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="name" type="text" size="30" name="Name" required>
                        </div>
                        <div class="col-sm-1">
                            <label for="code" class="medium-label">Código:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="code" type="text" size="30" name="Code" required>
                        </div>
                        <div class="col-sm-1">
                            <label for="price" class="medium-label">Preço:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="price" type="text" size="20" name="Price" step="0.01" required>
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
                            <label for="category" class="medium-label">Categoria:</label>
                        </div>
                        <div class="col-sm-3">
                            <select class="medium-label" id="category" name="Category">
                                <option class="medium-label" value="" selected>Selecione uma opção</option>
                                '.$category_option_list.'
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label for="price_cash" class="medium-label">Preço Dinh.:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="price_cash" type="text" size="20" name="Price_Cash" step="0.01" required>
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
                            <input id="supplier" type="text" size="30" name="Supplier">
                        </div>
                        <div class="col-sm-1">
                            <label for="price_pix" class="medium-label">Preço Pix:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="price_pix" type="text" size="20" name="Price_pix" step="0.01" required>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="comission_flg" class="medium-label">Comissão?:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="comission_flg" type="checkbox" name="Comission_flg">
                        </div>
                        <div class="col-sm-1">
                            <label for="comission_overwrite_flg" class="medium-label">Sobrescrever comissão:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="comission_overwrite_flg" type="checkbox" size="30" name="Comission_overwrite_flg">
                        </div>
                        <div class="col-sm-1">
                            <label for="comission_percentage" class="medium-label">% Comissão:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="comission_percentage" type="text" size="20" name="Comission_percentage" value="0" step="0.01">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="status" class="medium-label">Status:</label>
                        </div>
                        <div class="col-sm-3">
                            <select class="medium-label" id="status" name="Status">
                                <option class="medium-label" value="Ativo" selected>Ativo</option>
                                <option class="medium-label" value="Inativo">Inativo</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label for="flag1" class="medium-label">Flag1</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="flag1" type="checkbox" name="Flag1">
                        </div>
                        <div class="col-sm-1">
                            <label for="external_cost" class="medium-label">Custo Externo:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="external_cost" type="text" size="20" name="External_cost" value="0" step="0.01">
                        </div>
                    </div><br>';
                    echo $output;

    }

    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_update_form(){

        if (isset($_GET['id'])){

            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";
            $inputs["ID"]=$_GET['id'];
            $id=$_GET['id'];
            $model = new('\Model\\'.$this->UCF_object);
            
            $data = $model->getRow($inputs);

            if($data){

                foreach ($data as $key => $value) {
                    $data_form[$key]=$value;
                }

                //FOR EACH DROPDOWN GET $data_form and send to load_options_update to get the selected option
                $data_form_category = $data_form['CATEGORY'];
                $category_option_list = load_options_update("PROD_CATEGORY", "Ativo", $data_form_category);

                //FOR EACH FLAG CONVERT TINNY TO CHECKED:
                $flag_comission = ($data_form['COMISSION_FLG']==1) ? "checked" : "";
                $flag_comission_overwrite = ($data_form['COMISSION_OVERWRITE_FLG']==1) ? "checked" : "";
                $flag_flag1 = ($data_form['FLAG1']==1) ? "checked" : "";


                //START TO LOAD THE UPDATE FORM:
                $output .= '<div class="row">
                                <div class="col-sm-1">
                                    <label for="id" class="medium-label">Id:</label>
                                </div>
                                <div class="col-sm-6">
                                    <input id="id" type="text" name="Id" value="'.$data_form['ID'].'" readonly>
                                    <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="name" class="medium-label">Nome:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="name" type="text" size="30" name="Name" value="'.$data_form['NAME'].'" required>
                                </div>
                                <div class="col-sm-1">
                                    <label for="code" class="medium-label">Código:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="code" type="text" size="30" name="Code" value="'.$data_form['CODE'].'" required>
                                </div>
                                <div class="col-sm-1">
                                    <label for="price" class="medium-label">Preço:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="price" type="number" size="20" name="Price" value="'.$data_form['PRICE'].'" step="0.01" required>
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
                                    <label for="category" class="medium-label">Categoria:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="category" name="Category">
                                        <option class="medium-label" value="" selected>Selecione uma opção</option>
                                        '.$category_option_list.'
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="price_cash" class="medium-label">Preço Dinh.:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="price_cash" type="number" size="20" name="Price_Cash" value="'.$data_form['PRICE_CASH'].'" step="0.01" required>
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
                                    <input id="supplier" type="text" size="30" name="Supplier" value="'.$data_form['SUPPLIER'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="price_pix" class="medium-label">Preço Pix:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="price_pix" type="number" size="20" name="Price_pix" value="'.$data_form['PRICE_PIX'].'" step="0.01" required>
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
                                <div class="col-sm-3">
                                    <input id="comission_percentage" type="number" size="20" name="Comission_percentage" value="'.$data_form['COMISSION_PERCENTAGE'].'" step="0.01">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="status" class="medium-label">Status:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="status" name="Status">
                                        <option class="medium-label" value="Ativo" '.(($data_form['STATUS'] == 'Ativo')?"selected":"").'>Ativo</option>
                                        <option class="medium-label" value="Inativo" '.(($data_form['STATUS'] == 'Inativo')?"selected":"").'>Inativo</option>
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
                                <div class="col-sm-3">
                                    <input id="external_cost" type="number" size="20" name="External_cost" value="'.$data_form['EXTERNAL_COST'].'" step="0.01">
                                </div>
                            </div><br>';
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

    //LOAD HTML FORM FOR DELETING RECORD
    public function load_delete_form(){

        if (isset($_GET['id'])){

            //if(!isset($_SESSION['username'])) {session_start();}
            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";
            $inputs["ID"]=$_GET['id'];
            $id=$_GET['id'];
            $model = new('\Model\\'.$this->UCF_object);
            $data = $model->getRow($inputs);

            if($data){

                foreach ($data as $key => $value) {
                    $data_form[$key]=$value;
                }

                $output .= '<div class="row">
                                <div class="col-sm-1">
                                    <label for="id" class="medium-label">Id: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="id" type="text" size="8" name="Id" readonly value="'.$data_form['ID'].'"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="name" class="medium-label">Nome: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="name" type="text" size="50" name="Name" readonly value="'.$data_form['NAME'].'"><br<br>
                                </div>
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-5">
                                    
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

    //LOAD HTML FOR LISTING RECORDS IN TABLE
    public function load_rows($inputs){
            
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
                                '.(($inputs_buttons==$this->OrderItem)? "<a href=\"" : "").''.(($inputs_buttons==$this->OrderItem)? ROOT."/OrderItem/_insert_product?cli_id=" : "").''.(($inputs_buttons==$this->OrderItem)? $inputs_cli_id : "").''.(($inputs_buttons==$this->OrderItem)? "&order_id=" : "").''.(($inputs_buttons==$this->OrderItem)? $inputs_order_id : "").''.(($inputs_buttons==$this->OrderItem)? "&product={" : "").''.(($inputs_buttons==$this->OrderItem)? $array : "").''.(($inputs_buttons==$this->OrderItem)? "}\" title=\"New_Product\" class=\"text-primary newOrderBtn\" cli_id=" : "").''.(($inputs_buttons==$this->OrderItem)? $inputs_cli_id : "").''.(($inputs_buttons==$this->OrderItem)? "\" order_id=" : "").''.(($inputs_buttons==$this->OrderItem)? $inputs_order_id : "").''.(($inputs_buttons==$this->OrderItem)? "\"><i class=\"fas fa-plus\"></i></a>" : "").'
                                '.(($inputs_buttons==$this->UCF_object)? "<a href=\"" : "").''.(($inputs_buttons==$this->UCF_object)? ROOT."/$this->UCF_object/_update?id=$row->ID\"" : "").''.(($inputs_buttons==$this->UCF_object)? " title=\"Edit\" class=\"text-primary updateBtn\" id=" : "").''.(($inputs_buttons==$this->UCF_object)? $row->ID : "").''.(($inputs_buttons==$this->UCF_object)? "><i class=\"fas fa-edit\"></i></a>&nbsp;&nbsp" : "").'
                                '.(($inputs_buttons==$this->UCF_object)? "<a href=\"" : "").''.(($inputs_buttons==$this->UCF_object)? ROOT."/$this->UCF_object/_delete?id=$row->ID\"" : "").''.(($inputs_buttons==$this->UCF_object)? " title=\"Delete\" class=\"text-danger deleteBtn\" id=" : "").''.(($inputs_buttons==$this->UCF_object)? $row->ID : "").''.(($inputs_buttons==$this->UCF_object)? "><i class=\"fas fa-eraser\"></i></a>" : "").'
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

}