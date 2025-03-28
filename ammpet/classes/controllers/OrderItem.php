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
                                    <label for="code" class="medium-label">Cód:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="code" type="text" size="25" name="Code" readonly value="'.$data_form['PRODSERV_CODE'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="desc" class="medium-label">Desc.:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="desc" type="text" size="30" name="Desc" readonly value="'.$data_form['ITEM_DESCRIPTION'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="date" class="medium-label">Data:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="date" type="date" size="25" name="Date" value="'.$data_form['DATE'].'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="package" class="medium-label">Pacote:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="package" name="Package">

                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="serv_pkg" class="medium-label">Serv.Pct.:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="serv_pkg" type="text" size="30" name="Serv_pkg" readonly value="'.$data_form['PACKAGE_SERVICE'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="executor" class="medium-label">Resp.:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="executor" name="Executor">

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="salesperson" class="medium-label">Vendedor:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="salesperson" name="Salesperson">

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <div class="row">
                            </div>
                        
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="code" class="medium-label">Cód:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="code" type="text" size="25" name="Code" readonly value="'.$data_form['PRODSERV_CODE'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="desc" class="medium-label">Desc.:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="desc" type="text" size="30" name="Desc" readonly value="'.$data_form['ITEM_DESCRIPTION'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="date" class="medium-label">Data:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="date" type="date" size="25" name="Date" value="'.$data_form['DATE'].'">
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <div class="row">
                            </div>
                            <div class="row">
                            </div>
                            <div class="row">
                            </div>
                            <div class="row">
                            </div><br>
                            <div class="row">
                                <div class="col-sm-6">
                                    
                                </div>
                                <div class="col-sm-6">
                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Atualizar" formaction="../OrderItem/update_call">
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