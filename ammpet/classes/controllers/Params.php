<?php

namespace Controller;

//if(session_status() === PHP_SESSION_NONE) session_start();

restart_session();

//defined('ROOTPATH') OR exit('Access denied!');
(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class Params {

    use _GlobalController;
    private $object = 'params';
    private $UCF_object = 'Params';

    public function index()
    {
        //echo "This is Params controller";

        //$this->view('params/params');
    }


    //SESSION WITH FUNCTIONS TO ALLOWS OTHER CLASSES TO GET PARAM VALUES
    public function getParamValue($type, $name, $status){
        $model = new('\Model\\'.$this->UCF_object);
        $inputs['TYPE']=$type;
        $inputs['NAME']=$name;
        $inputs['STATUS']=$status;
        $result = $model->getRow($inputs);
        if($result){
            return $result;
        }
        else{
            return false;
        }
        
    }

    public function getParamListByType($type, $status){
        $model = new('\Model\\'.$this->UCF_object);
        $inputs['TYPE']=$type;
        $inputs['STATUS']=$status;
        $result = $model->listWhere($inputs);
        if($result){
            return $result;
        }
        else{
            return false;
        }
        
    }
    

    //SESSION TO LOAD HTML FORMS:

    //LOAD HTML FORM FOR CREATING NEW RECORD
    public function load_new_form(){

        //START SESSION IF NOT STARTED TO GET $SESSION USERNAME
        //if(session_status() === PHP_SESSION_NONE) session_start();
        restart_session();

        //DEFINE OPTION LISTS:
        //$type_option_list = load_options_new("SUPPLIER_TYPE", "Ativo");
        //$role_option_list = load_options_new("SUPPLIER_ROLE", "Ativo");

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
                            <label for="name" class="medium-label">Nome: &nbsp;</label>
                        </div>
                        <div class="col-sm-5">
                            <input id="name" type="text" size="40" name="Name">
                        </div>
                        <div class="col-sm-1">
                            <label for="value" class="medium-label">Valor: &nbsp;</label>
                        </div>
                        <div class="col-sm-5">
                            <input id="value" type="text" size="40" name="Value">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="type" class="medium-label">Tipo: &nbsp;</label>
                        </div>
                        <div class="col-sm-5">
                            <input id="type" type="text" size="40" name="Type">
                        </div>
                        <div class="col-sm-1">
                            <label for="status" class="medium-label">Status: &nbsp;</label>
                        </div>
                        <div class="col-sm-5">
                            <select class="medium-label" id="status" name="Status">
                                <option class="medium-label" value="Ativo" selected>Ativo</option>
                                <option class="medium-label" value="Desativado">Desativado</option>
                            </select>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="comment" class="medium-label">Comentário: &nbsp;</label>
                        </div>
                        <div class="col-sm-5">
                            <input id="comment" type="text" size="40" name="Comment">
                        </div>
                        <div class="col-sm-1">
                            
                        </div>
                        <div class="col-sm-5">
                            
                        </div>
                    </div><br>';
                    echo $output;

    }

    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_update_form(){

        if (isset($_GET['id'])){

            //if(!isset($_SESSION['username'])) {session_start();}
            //if(session_status() === PHP_SESSION_NONE) session_start();
            restart_session();

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
                                    <label for="id" class="medium-label">Id: &nbsp;</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="id" type="text" size="8" name="Id" readonly value="'.$data_form['ID'].'">
                                </div>
                                <div class="col-sm-6">
                                    <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="name" class="medium-label">Nome: &nbsp;</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="name" type="text" size="40" name="Name" value="'.$data_form['NAME'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="value" class="medium-label">Valor: &nbsp;</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="value" type="text" size="40" name="value" value="'.$data_form['VALUE'].'">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="type" class="medium-label">Tipo: &nbsp;</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="type" type="text" size="40" name="type" value="'.$data_form['TYPE'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="status" class="medium-label">Status: &nbsp;</label>
                                </div>
                                <div class="col-sm-5">
                                    <select class="medium-label" id="status" name="Status">
                                        <option class="medium-label" value="">Selecione uma opção</option>
                                        <option class="medium-label" value="Ativo" '.(($data_form['STATUS'] == 'Ativo')?"selected":"").'>Ativo</option>
                                        <option class="medium-label" value="Desativado" '.(($data_form['STATUS'] == 'Desativado')?"selected":"").'>Desativado</option>
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="comment" class="medium-label">Comentarios: &nbsp;</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="comment" type="text" size="50" name="Comment" value="'.$data_form['COMMENT'].'">
                                </div>
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-5">
                                    
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
            //if(session_status() === PHP_SESSION_NONE) session_start();
            restart_session();

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
                                    <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
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
    public function load_rows(){
        
        restart_session();
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
            $data = null;
            $model = null;

            echo $output;
        }
        else{
            $data = null;
            $model = null;
            echo '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3>';
        }
    }

}