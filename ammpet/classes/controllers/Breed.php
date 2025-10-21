<?php

namespace Controller;

//if(session_status() === PHP_SESSION_NONE) session_start();

restart_session();

//defined('ROOTPATH') OR exit('Access denied!');
(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class Breed {

    use _GlobalController;
    private $object = 'breed';
    private $UCF_object = 'Breed';

    public function index()
    {

    }

    //SESSION TO LOAD HTML FORMS:

    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_breed_form(){

        if (isset($_GET['id'])){

            $output = "";

            $id = $_GET['id'];
            $created_by = $_SESSION['username'];
            $updated_by = $_SESSION['username'];
            $name = null;
            $type = null;
 
            if (!($id=='new')) {
                $inputs["ID"]=$_GET['id'];
                $model = new('\Model\\'.$this->UCF_object);
                
                $data = $model->getRow($inputs);
                if($data){
                    foreach ($data as $key => $value) {
                        $data_form[$key]=$value;
                    }

                    $created_by = $data_form['CREATED_BY'];
                    $updated_by = $data_form['UPDATED_BY'];
                    $name = $data_form['NAME'];
                    $id = $data_form['ID'];
                    $type = $data_form['TYPE'];

                }
                unset($data_form);
                unset($inputs);
            }

                //FOR EACH DROPDOWN GET $data_form and send to load_options_update to get the selected option
                //$data_form_type = $data_form['TYPE'];
                $type_option_list = load_options_update("BREED_TYPE", "Ativo", $type);

                //START TO LOAD THE UPDATE FORM:
                $output .= '<div class="row">
                                <div class="col-sm-1">
                                    <label for="id" class="medium-label">Id: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="id" type="text" size="8" name="Id" readonly value="'.$id.'"><br><br>
                                </div>
                                <div class="col-sm-6">
                                    <input id="created_by" type="hidden" name="Created_By" value="'.$created_by.'">
                                    <input id="updated_by" type="hidden" name="Updated_By" value="'.$updated_by.'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="name" class="medium-label">Nome: *</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="name" type="text" size="40" name="Name" value="'.$name.'"><br<br>
                                </div>
                                <div class="col-sm-1">
                                    <label for="type" class="medium-label">Tipo: *</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <select class="medium-label" id="type" name="Type">
                                        <option class="medium-label" value="X">Selecione uma opção</option>
                                        '.$type_option_list.'
                                    </select><br><br>
                                </div>
                            </div>';
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
    public function load_rows(){
        
        //restart_session();
        $breed_edit_check = check_permission($_SESSION['username'],"breed_edit");
        $breed_delete_check = check_permission($_SESSION['username'],"breed_delete");
        $output = "";
        $model = new('\Model\\'.$this->UCF_object);
        
        $data = $model->listAll();
        if($data){
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Raça</th>
                                <th>Tipo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($data as $row) {
                $output .='<tr class="text-center text-secondary">
                            <td>'.$row->ID.'</td>
                            <td>'.$row->UPDATED.'</td>
                            <td>'.$row->NAME.'</td>
                            <td>'.$row->TYPE.'</td>
                            <td>
                                '.(($breed_edit_check) ? "<a href=\"" . ROOT . "/$this->UCF_object/_new?id=$row->ID\" title=\"Edit\" class=\"text-primary updateBtn\" id=" . $row->ID . "><i class=\"fas fa-edit\"></i></a>&nbsp;&nbsp" : "").'
                                '.(($breed_delete_check) ? "<a href=\"" . ROOT . "/$this->UCF_object/_delete?id=$row->ID\" title=\"Edit\" class=\"text-danger deleteBtn\" id=" . $row->ID . "><i class=\"fas fa-eraser\"></i></a>" : "").'
                            </td></tr>';
            }
            $output .= '</tbody>
                        <tfoot>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Raça</th>
                                <th>Tipo</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>';
            $sql_stm = null;
            //unset_array($inputs);
            $data = null;
            $model = null;
            echo $output;
        }
        else{
            $sql_stm = null;
            //unset_array($inputs);
            $data = null;
            $model = null;
            echo '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3>';
        }
    }

    public function load_breed_options ($array){
        
        //GET LIST OF BREEDS FROM BREED TABLE
        $model = new('\Model\\'.$this->UCF_object);
        $inputs['TYPE']=$array['type'];
        $op=$array['operation'];
        if($op=="new"){
            $option_list = '<option class="medium-label" value="X" selected>Selecione uma opção</option>';
            $options = $model->listWhere($inputs);
            if($options){
                foreach ($options as $option) { 
                    $option_list .= '<option class="medium-label" value="'.$option->ID.'">'.$option->NAME.'</option>';
                }
            }
            return $option_list;
        } elseif($op=="update"){
            $data_form_breed=$array['dfbreed'];
            $selectedX= ($data_form_breed == "X") ? "selected":"";
            $option_list = '<option class="medium-label" value="X" '.$selectedX.'>Selecione uma opção</option>';
            $options = $model->listWhere($inputs);
            if($options){
                foreach ($options as $option) { 
                    $selected= ($data_form_breed == $option->ID) ? "selected":"";
                    $option_list .= '<option class="medium-label" value="'.$option->ID.'" '.$selected.'>'.$option->NAME.'</option>';
                }
            }
            $sql_stm = null;
            unset_array($inputs);
            $data = null;
            $options = null;
            $model = null;
            return $option_list;
            }
    }

    //FUNCTION USED TO PRE-VALIDATE BREED INFO BEFORE IT'S SUBMITTED
    public function validate_breed($inputs){
        $error=0;
        $error_msg="";
        if (isset($inputs['operation'])) {
            if ( $inputs['Name']==null || $inputs['Name']=="") {
                $error=1;
                $error_msg .= "Indique um valor para \"Nome\".\n";
            }
            if ( $inputs['Type']=="X" || $inputs['Type']=="Selecione uma opção") {
                $error=1;
                $error_msg .= "Indique um valor para \"Tipo\".\n";
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
                $_POST['class']="Breed";

                if ($inputs['Id']=="new") {
                    unset($_POST['Id']);                
                    $_POST['method']="insert_call";
                    $ajax_call = new('\Controller\\'."Ajax_call");
                    $_POST['csrf_token'] = csrf_token();
                    $ajax_call->index();
                } else{
                    $_POST['method']="update_call";
                    $ajax_call = new('\Controller\\'."Ajax_call");
                    $_POST['csrf_token'] = csrf_token();
                    $ajax_call->index();
                }
            }
        } else{
            return $error_msg="Operation failed";
        }
    }    
}
