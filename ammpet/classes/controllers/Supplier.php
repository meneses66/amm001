<?php

namespace Controller;

//if(session_status() === PHP_SESSION_NONE) session_start();

restart_session();

defined('ROOTPATH') OR exit('Access denied!');

class Supplier {

    use _GlobalController;
    private $object = 'supplier';
    private $UCF_object = 'Supplier';

    //This function is not needed for now
    public function index()
    {
        //echo "This is Supplier controller";
        $this->view('supplier/supplier');
       
    }


    //SESSION TO LOAD HTML FORMS:

    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_supplier_form(){

        if (isset($_GET['id'])){

            $output = "";

            $id = $_GET['id'];
            $created_by = $_SESSION['username'];
            $updated_by = $_SESSION['username'];
            $name = null;
            $login = null;
            $pass = null;
            $role = "X";
            $cnpj = null;
            $cpf = null;
            $type = "X";
            $hire_date = date('Y-m-d');
            $status = "Ativo";
            $comment = null;
            $permissions = null;

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
                    $login = $data_form['LOGIN'];
                    $role = $data_form['ROLE'];
                    $cnpj = $data_form['CNPJ'];
                    $cpf = $data_form['CPF'];
                    $type = $data_form['TYPE'];
                    $hire_date = $data_form['HIRE_DATE'];
                    $status = $data_form['STATUS'];
                    $comment = $data_form['COMMENT'];
                    $permissions = $data_form['PERMISSIONS'];

                }
                unset($data_form);
                unset($inputs);
            }

            
            //FOR EACH DROPDOWN GET $data_form and send to load_options_update to get the selected option
            //$data_form_type = $data_form['TYPE'];
            $type_option_list = load_options_update("SUPPLIER_TYPE", "Ativo", $type);

            //$data_form_role = $data_form['ROLE'];
            $role_option_list = load_options_update("SUPPLIER_ROLE", "Ativo", $role);

            //START TO LOAD THE UPDATE FORM:
            $output .= '<div class="row">
                            <div class="col-sm-1">
                                <label for="id" class="medium-label">Id: &nbsp;</label><br><br>
                            </div>
                            <div class="col-sm-5">
                                <input id="id" type="text" size="8" name="Id" readonly value="'.$id.'"><br><br>
                            </div>
                            <div class="col-sm-6">
                                <input id="created_by" type="hidden" name="Created_By" value="'.$created_by.'" readonly>
                                <input id="updated_by" type="hidden" name="Updated_By" value="'.$updated_by.'" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="name" class="medium-label">Nome: *</label><br><br>
                            </div>
                            <div class="col-sm-5">
                                <input id="name" type="text" size="50" name="Name" value="'.$name.'"><br<br>
                            </div>
                            <div class="col-sm-1">
                                <label for="hire_date" class="medium-label">Dt Inicio:</label><br><br>
                            </div>
                            <div class="col-sm-5">
                                <input id="hire_date" type="date" size="30" name="Hire_Date" value="'.$hire_date.'"><br><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="login" class="medium-label">Login:</label><br><br>
                            </div>
                            <div class="col-sm-5">
                                <input id="login" type="text" size="20" name="Login" value="'.$login.'" oninput="showHidePermission(this.value)"><br><br>
                            </div>
                            <div class="col-sm-1">
                                <label for="cnpj" class="medium-label">CNPJ:</label><br><br>
                            </div>
                            <div class="col-sm-5">
                                <input id="cnpj" type="text" size="10" name="CNPJ" value="'.$cnpj.'"><br><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="pass" class="medium-label">Senha:</label><br>
                            </div>
                            <div class="col-sm-5">
                                <input id="pass" type="password" name="Pass"><br>
                            </div>
                            <div class="col-sm-1">
                                <label for="cpf" class="medium-label">CPF:</label><br><br>
                            </div>
                            <div class="col-sm-5">
                                <input id="cpf" type="text" size="10" name="CPF" value="'.$cpf.'"><br><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="type" class="medium-label">Tipo: *</label><br><br>
                            </div>
                            <div class="col-sm-5">
                                <select class="medium-label" id="type" name="Type">
                                    <option class="medium-label" value="X">Selecione uma opção</option>
                                    '.$type_option_list.'
                                </select><br><br>
                            </div>
                            <div class="col-sm-1">
                                <label for="status" class="medium-label">Status:</label><br>
                            </div>
                            <div class="col-sm-5">
                                <select class="medium-label" id="status" name="Status">
                                    <option class="medium-label" value="">Selecione uma opção</option>
                                    <option class="medium-label" value="Ativo" '.(($status == 'Ativo')?"selected":"").'>Ativo</option>
                                    <option class="medium-label" value="Desativado" '.(($status == 'Desativado')?"selected":"").'>Desativado</option>
                                </select><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="role" class="medium-label">Cargo: *</label><br>
                            </div>
                            <div class="col-sm-5">
                                <select class="medium-label" id="role" name="Role">
                                    <option class="medium-label" value="X">Selecione uma opção</option>
                                    '.$role_option_list.'
                                </select><br>
                            </div>
                            <div class="col-sm-1">
                                <label for="comment" class="medium-label">Comentarios:</label><br>
                            </div>
                            <div class="col-sm-5">
                                <input id="comment" type="text" size="50" name="Comment" value="'.$comment.'"><br>
                            </div>
                        </div>
                        <div class="row">
                            <input id="permission_el" type="hidden" name="Permissions" value="'.$permissions.'">
                        </div>';

                            // ADD BUTTONS:
            /*
            $output .= '<div class="row">
                            <div class="col-sm-6">
                                <a href="'.ROOT.'/Supplier/_list?" class="btn btn-secondary btn-lg m-1 btn-block">Voltar</a>
                            </div>
                            <div class="col-sm-6">
                                <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Salvar" formaction="../Supplier/update_call">
                            </div>
                        </div>';
            */
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
        //if(isset($_POST['operation']) && $_POST['operation']==="view"){
        //restart_session();   
        $supplier_edit_check = check_permission($_SESSION['username'], "supplier_edit");
        $supplier_delete_check = check_permission($_SESSION['username'], "supplier_delete"); 
        $output = "";
        $model = new('\Model\\'.$this->UCF_object);
        $data = $model->listAll();
        if($model->countAll()>0){
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Nome</th>
                                <th>Login</th>
                                <th>Cargo</th>
                                <th>Tipo</th>
                                <th>Status</th>
                                <th>CNPJ</th>
                                <th>CPF</th>
                                <th>DataInício</th>
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
                            <td>'.$row->LOGIN.'</td>
                            <td>'.$row->ROLE.'</td>
                            <td>'.$row->TYPE.'</td>
                            <td>'.$row->STATUS.'</td>
                            <td>'.$row->CNPJ.'</td>
                            <td>'.$row->CPF.'</td>
                            <td>'.$row->HIRE_DATE.'</td>
                            <td>'.$row->COMMENT.'</td>
                            <td>
                                '.(($supplier_edit_check) ? '<a href="'.ROOT."/Supplier/_new?id=$row->ID".'" title="Edit" class="text-primary updateBtn" id="'.$row->ID.'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;' : '').'
                                '.(($supplier_delete_check) ? '<a href="'.ROOT."/Supplier/_delete?id=$row->ID".'" title="Delete" class="text-danger deleteBtn" id="'.$row->ID.'"><i class="fas fa-eraser"></i></a>' : '').'
                            </td></tr>';
            }
            $output .= '</tbody>
                        <tfoot>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Nome</th>
                                <th>Login</th>
                                <th>Cargo</th>
                                <th>Tipo</th>
                                <th>Status</th>
                                <th>CNPJ</th>
                                <th>CPF</th>
                                <th>DataInício</th>
                                <th>Comentários</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>';
            $sql_stm = null;
            $data = null;
            $model = null;

            echo $output;
        }
        else{
            $sql_stm = null;
            $data = null;
            $model = null;

            echo '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3>';
        }
    //}
    }

    public function load_executor_options ($array){
        
        //GET LIST OF executo FROM Supplier TABLE
        $model = new('\Model\\'.$this->UCF_object);
        
        $data_form_executor=$array['dfexecutor'];
        $inputs['TYPE']="Funcionario";
        $inputs['STATUS']="Ativo";
        $inputs['ROLE1']="Tosador";
        $inputs['ROLE2']="Veterinaria";

        //echo var_dump($inputs);

        if($data_form_executor=="XXXX" || $data_form_executor=="" || $data_form_executor==null){
            $option_list = '<option class="medium-label" value="XXXX" "selected">XXXX</option>';
        } else {
            $option_list = '<option class="medium-label" value="XXXX">XXXX</option>';
        }

        $sql_stm = "SELECT * FROM SUPPLIER WHERE TYPE=:TYPE AND STATUS=:STATUS AND (ROLE=:ROLE1 OR ROLE=:ROLE2)";
        
        $options = $model->exec_sqlstm($sql_stm, $inputs);
        if($options){
            foreach ($options as $option) { 
                $selected= ($data_form_executor == $option->NAME) ? "selected":"";
                $option_list .= '<option class="medium-label" value="'.$option->NAME.'" '.$selected.'>'.$option->NAME.'</option>';
            }
        }
        $sql_stm = null;
        unset_array($inputs);
        $data = null;
        $options = null;
        $model = null;
        return $option_list;
    
    }

    public function load_salesperson_options ($array){
        
        //GET LIST OF salesperson FROM Supplier TABLE
        $model = new('\Model\\'.$this->UCF_object);
        
        $data_form_salesperson=$array['dfsalesperson'];
        $inputs['TYPE']="Funcionario";
        $inputs['STATUS']="Ativo";
        $inputs['ROLE1']="Proprietario";
        $inputs['ROLE2']="Recepcao";

        $sql_stm = "SELECT * FROM SUPPLIER WHERE TYPE=:TYPE AND STATUS=:STATUS AND (ROLE=:ROLE1 OR ROLE=:ROLE2)";
        
        $options = $model->exec_sqlstm($sql_stm, $inputs);
        if($options){
            foreach ($options as $option) { 
                $selected= ($data_form_salesperson == $option->NAME) ? "selected":"";
                $option_list .= '<option class="medium-label" value="'.$option->NAME.'" '.$selected.'>'.$option->NAME.'</option>';
            }
        }
        $sql_stm = null;
        unset_array($inputs);
        $data = null;
        $options = null;
        $model = null;
        return $option_list;
    
    }

    public function load_employee_options ($array){
        
        //GET LIST OF executo FROM Supplier TABLE
        $model = new('\Model\\'.$this->UCF_object);
        
        $data_form_employee=$array['dfemployee'];
        $inputs['TYPE']="Funcionario";
        $inputs['STATUS']="Ativo";

        if($data_form_employee=="" || $data_form_employee==null){
            $option_list = '<option class="medium-label" value="XXXX" "selected">XXXX</option>';
        } else {
            $option_list = '<option class="medium-label" value="XXXX">XXXX</option>';
        }
        
        $options = $model->listWhere($inputs);
        if($options){
            foreach ($options as $option) { 
                $selected= ($data_form_employee == $option->ID) ? "selected":"";
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

    //FUNCTION USED TO PRE-VALIDATE SUPPLIER INFO BEFORE IT'S SUBMITTED
    public function validate_supplier($inputs){
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
            if ( $inputs['Role']=="X" || $inputs['Role']=="Selecione uma opção") {
                $error=1;
                $error_msg .= "Indique um valor para \"Cargo\".\n";
            }
            if ( $inputs['Id']=="new" && (!($inputs['Login']=="" || $inputs['Login']==null) && ($inputs['Pass']=="" || $inputs['Pass']==null))) {
                $error=1;
                $error_msg .= "Indique um valor para \"Password do Novo Fornecedor com Login\".\n";
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
                $_POST['class']="Supplier";

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