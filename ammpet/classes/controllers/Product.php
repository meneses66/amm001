<?php

namespace Controller;
if(session_status() === PHP_SESSION_NONE) session_start();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class Product {

    use _GlobalController;

    use _GlobalController;
    private $object = 'product';
    private $UCF_object = 'Product';

    public function index()
    {

    }


    //SESSION TO LOAD HTML FORMS:

    //LOAD HTML FORM FOR CREATING NEW RECORD
    public function load_new_form(){

        //START SESSION IF NOT STARTED TO GET $SESSION USERNAME
        if(session_status() === PHP_SESSION_NONE) session_start();

        $category_option_list = load_options_new("PROD_CATEGORY", "Ativo");
        $center_option_list = load_options_new("PROD_CENTER", "Ativo");
        $groupx_option_list = load_options_new("PROD_GROUPX", "Ativo");

        $output = "";

        //CREATE VIEW HTML STRUCTURE
        $output .= '<div class="row">
                        <div class="col-sm-6">
                            <input id="id" type="hidden" name="Id" value="">
                            <input id="created_by" type="hidden" name="Created_by" value="'.$_SESSION['username'].'">
                            <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
                            <input id="created" type="hidden" name="Created" value="">
                            <input id="updated" type="hidden" name="Updated" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="name" class="medium-label">Nome:</label><br><br>
                        </div>
                        <div class="col-sm-3">
                            <input id="name" type="text" size="100%" name="Name"><br><br>
                        </div>
                        <div class="col-sm-1">
                            <label for="code" class="medium-label">Código:</label><br><br>
                        </div>
                        <div class="col-sm-3">
                            <input id="code" type="text" size="100%" name="Code"><br><br>
                        </div>
                        <div class="col-sm-1">
                            <label for="price" class="medium-label">Preço:</label><br><br>
                        </div>
                        <div class="col-sm-3">
                            <input id="price" type="number" size="100%" name="Price"><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="type" class="medium-label">Tipo: &nbsp;</label><br><br>
                        </div>
                        <div class="col-sm-5">
                            <input id="type" type="text" size="40" name="Type"><br><br>
                        </div>
                        <div class="col-sm-1">
                            <label for="status" class="medium-label">Status: &nbsp;</label><br>
                        </div>
                        <div class="col-sm-5">
                            <select class="medium-label" id="status" name="Status">
                                <option class="medium-label" value="Ativo" selected>Ativo</option>
                                <option class="medium-label" value="Inativo">Inativo</option>
                            </select><br><br>
                        </div>
                    </div>';
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
                //$data_form_type = $data_form['TYPE'];
                //$type_option_list = load_options_update("SUPPLIER_TYPE", "Ativo", $data_form_type);


                //START TO LOAD THE UPDATE FORM:
                $output .= '<div class="row">
                                <div class="col-sm-1">
                                    <label for="id" class="medium-label">Id: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="id" type="text" size="8" name="Id" readonly value="'.$data_form['ID'].'"><br><br>
                                </div>
                                <div class="col-sm-6">
                                    <input id="created_by" type="hidden" name="Created_by" value="'.$_SESSION['username'].'">
                                    <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
                                    <input id="created" type="hidden" name="Created" value="'.$data_form['CREATED'].'">
                                    <input id="updated" type="hidden" name="Updated" value="'.$data_form['UPDATED'].'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="name" class="medium-label">Nome: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="name" type="text" size="40" name="Name" value="'.$data_form['NAME'].'"><br<br>
                                </div>
                                <div class="col-sm-1">
                                    <label for="value" class="medium-label">Valor: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="value" type="text" size="40" name="value" value="'.$data_form['VALUE'].'"><br<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="type" class="medium-label">Tipo: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="type" type="text" size="40" name="type" value="'.$data_form['TYPE'].'"><br<br>
                                </div>
                                <div class="col-sm-1">
                                    <label for="status" class="medium-label">Status: &nbsp;</label><br>
                                </div>
                                <div class="col-sm-5">
                                    <select class="medium-label" id="status" name="Status">
                                        <option class="medium-label" value="">Selecione uma opção</option>
                                        <option class="medium-label" value="Ativo" '.(($data_form['STATUS'] == 'Ativo')?"selected":"").'>Ativo</option>
                                        <option class="medium-label" value="Inativo" '.(($data_form['STATUS'] == 'Inativo')?"selected":"").'>Inativo</option>
                                    </select><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="comment" class="medium-label">Comentarios: &nbsp;</label><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="comment" type="text" size="50" name="Comment" value="'.$data_form['COMMENT'].'"><br>
                                </div>
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-5">
                                    
                                </div>
                            </div>';
                            echo $output;
            } else{
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
                            echo $output;
            } else{
                show("No record to display!");
            }

        }

    }

    //LOAD HTML FOR LISTING RECORDS IN TABLE
    public function load_rows(){
            
        $output = "";
        //$model = new \Model\Params;
        $model = new('\Model\\'.$this->UCF_object);
        
        $data = $model->listAll();
        if($model->countAll()>0){
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Nome</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($data as $row) {
                $output .='<tr class="text-center text-secondary">
                            <td>'.$row->ID.'</td>
                            <td>'.$row->UPDATED.'</td>
                            <td>'.$row->NAME.'</td>
                            <td>'.$row->STATUS.'</td>
                            <td>
                                <a href="'.ROOT."/$this->UCF_object/_update?id=$row->ID".'" title="Edit" class="text-primary updateBtn" id="'.$row->ID.'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                <a href="'.ROOT."/$this->UCF_object/_delete?id=$row->ID".'" title="Delete" class="text-danger deleteBtn" id="'.$row->ID.'"><i class="fas fa-eraser"></i></a>
                            </td></tr>';
            }
            $output .= '</tbody>';
            echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3>';
        }
    }

}

}