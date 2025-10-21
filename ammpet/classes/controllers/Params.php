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
    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_params_form(){

        if (isset($_GET['id'])){

            $output = "";

            $id = $_GET['id'];
            $created_by = $_SESSION['username'];
            $updated_by = $_SESSION['username'];
            $name = null;
            $value = null;
            $type = null;
            $status = "Ativo";
            $comment = null;
 
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
                    $value = $data_form['VALUE'];
                    $status = $data_form['STATUS'];
                    $comment = $data_form['COMMENT'];

                }
                unset($data_form);
                unset($inputs);
            }

                //START TO LOAD THE UPDATE FORM:
                $output .= '<div class="row">
                                <div class="col-sm-1">
                                    <label for="id" class="medium-label">Id:</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="id" type="text" size="8" name="Id" readonly value="'.$id.'">
                                </div>
                                <div class="col-sm-6">
                                    <input id="created_by" type="hidden" name="Created_By" value="'.$created_by.'" readonly>
                                    <input id="updated_by" type="hidden" name="Updated_By" value="'.$updated_by.'" readonly>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="name" class="medium-label">Nome: *</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="name" type="text" size="40" name="Name" value="'.$name.'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="value" class="medium-label">Valor: *</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="value" type="text" size="40" name="Value" value="'.$value.'">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="type" class="medium-label">Tipo: *</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="type" type="text" size="40" name="Type" value="'.$type.'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="status" class="medium-label">Status:</label>
                                </div>
                                <div class="col-sm-5">
                                    <select class="medium-label" id="status" name="Status">
                                        <option class="medium-label" value="Ativo" '.(($status == 'Ativo')?"selected":"").'>Ativo</option>
                                        <option class="medium-label" value="Desativado" '.(($status == 'Desativado')?"selected":"").'>Desativado</option>
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="comment" class="medium-label">Comentarios:</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="comment" type="text" size="50" name="Comment" value="'.$comment.'">
                                </div>
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-5">
                                    
                                </div>
                            </div><br>';
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
        $params_edit_check = check_permission($_SESSION['username'], "params_edit");
        $params_delete_check = check_permission($_SESSION['username'], "params_delete");
        $output = "";
        //$model = new \Model\Params;
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
                                '.(($params_edit_check) ? '<a href="'.ROOT."/$this->UCF_object/_new?id=$row->ID".'" title="Edit" class="text-primary updateBtn" id="'.$row->ID.'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;' : '').'
                                '.(($params_delete_check) ? '<a href="'.ROOT."/$this->UCF_object/_delete?id=$row->ID".'" title="Delete" class="text-danger deleteBtn" id="'.$row->ID.'"><i class="fas fa-eraser"></i></a>' : '').'
                            </td></tr>';
            }
            $output .= '</tbody>
                        <tfoot>
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
                        </tfoot>';
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

    //FUNCTION USED TO PRE-VALIDATE PARAMS INFO BEFORE IT'S SUBMITTED
    public function validate_params($inputs){
        $error=0;
        $error_msg="";
        if (isset($inputs['operation'])) {
            if ( $inputs['Name']==null || $inputs['Name']=="") {
                $error=1;
                $error_msg .= "Indique um valor para \"Nome\".\n";
            }
            if ( $inputs['Value']==null || $inputs['Value']=="") {
                $error=1;
                $error_msg .= "Indique um valor para \"Valor\".\n";
            }
            if ( $inputs['Type']==null || $inputs['Type']=="") {
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
                $_POST['class']="Params";

                if ($inputs['Id']=="new") {
                    unset($_POST['Id']);                
                    $_POST['method']="insert_call";
                    $ajax_call = new('\Controller\\'."Ajax_call");
                    $_POST['csrf_token'] = csrf_token();
                    $_POST['csrf_token'] = csrf_token();
                    $ajax_call->index();
                } else{
                    $_POST['method']="update_call";
                    $ajax_call = new('\Controller\\'."Ajax_call");
                    $_POST['csrf_token'] = csrf_token();
                    $_POST['csrf_token'] = csrf_token();
                    $ajax_call->index();
                }
            }
        } else{
            return $error_msg="Operation failed";
        }
    }

}
