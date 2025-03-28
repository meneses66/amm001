<?php

namespace Controller;
if(session_status() === PHP_SESSION_NONE) session_start();

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

    //LOAD HTML FORM FOR CREATING NEW RECORD
    public function load_new_form(){

        //START SESSION IF NOT STARTED TO GET $SESSION USERNAME
        //if(!isset($_SESSION['username'])) {session_start();}

        //DEFINE OPTION LISTS:
        $type_option_list = load_options_new("SUPPLIER_TYPE", "Ativo");
        $role_option_list = load_options_new("SUPPLIER_ROLE", "Ativo");
        //$param_value_test = return_param_value ("SUPPLIER_TYPE", "Funcionario", "Ativo");

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
                            <label for="name" class="medium-label">Nome: &nbsp;</label><br><br>
                        </div>
                        <div class="col-sm-5">
                            <input id="name" type="text" size="50" name="Name"><br><br>
                        </div>
                        <div class="col-sm-1">
                            <label for="hire_date" class="medium-label">Dt Inicio: &nbsp;</label><br><br>
                        </div>
                        <div class="col-sm-5">
                            <input id="hire_date" type="date" size="30" name="Hire_date" value="'.date('Y-m-d').'"><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="login" class="medium-label">Login: &nbsp;</label><br><br>
                        </div>
                        <div class="col-sm-5">
                            <input id="login" type="text" size="20" name="Login" oninput="showHidePermission()"><br><br>
                        </div>
                        <div class="col-sm-1">
                            <label for="cnpj" class="medium-label">CNPJ: &nbsp;</label><br><br>
                        </div>
                        <div class="col-sm-5">
                            <input id="cnpj" type="text" size="10" name="CNPJ"><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="pass" class="medium-label">Senha: &nbsp;</label><br>
                        </div>
                        <div class="col-sm-5">
                            <input id="pass" type="password" name="Pass"><br>
                        </div>
                        <div class="col-sm-1">
                            <label for="cpf" class="medium-label">CPF: &nbsp;</label><br><br>
                        </div>
                        <div class="col-sm-5">
                            <input id="cpf" type="text" size="10" name="CPF"><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="type" class="medium-label">Tipo: &nbsp;</label><br><br>
                        </div>
                        <div class="col-sm-5">
                            <select class="medium-label" id="type" name="Type">
                                <option class="medium-label" value="" selected>Selecione uma opção</option>
                                '.$type_option_list.'
                            </select><br><br>
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
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="role" class="medium-label">Cargo: &nbsp;</label><br>
                        </div>
                        <div class="col-sm-5">
                            <select class="medium-label" id="role" name="Role">
                                <option class="medium-label" value="" selected>Selecione uma opção</option>
                                '.$role_option_list.'
                            </select><br>
                        </div>
                        <div class="col-sm-1">
                            <label for="comment" class="medium-label">Comentarios: &nbsp;</label><br>
                        </div>
                        <div class="col-sm-5">
                            <input id="comment" type="text" size="50" name="Comment"><br>
                        </div>
                    </div>';
                    echo $output;

    }

    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_update_form(){

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

                //FOR EACH DROPDOWN GET $data_form and send to load_options_update to get the selected option
                $data_form_type = $data_form['TYPE'];
                $type_option_list = load_options_update("SUPPLIER_TYPE", "Ativo", $data_form_type);

                $data_form_role = $data_form['ROLE'];
                $role_option_list = load_options_update("SUPPLIER_ROLE", "Ativo", $data_form_role);

                //START TO LOAD THE UPDATE FORM:
                $output .= '<div class="row">
                                <div class="col-sm-1">
                                    <label for="id" class="medium-label">Id: &nbsp;</label><br><br>
                                    <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
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
                                    <input id="name" type="text" size="50" name="Name" value="'.$data_form['NAME'].'"><br<br>
                                </div>
                                <div class="col-sm-1">
                                    <label for="hire_date" class="medium-label">Dt Inicio: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="hire_date" type="date" size="30" name="Hire_Date" value="'.$data_form['HIRE_DATE'].'"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="login" class="medium-label">Login: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="login" type="text" size="20" name="Login" value="'.$data_form['LOGIN'].'"><br><br>
                                </div>
                                <div class="col-sm-1">
                                    <label for="cnpj" class="medium-label">CNPJ: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="cnpj" type="text" size="10" name="CNPJ" value="'.$data_form['CNPJ'].'"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="pass" class="medium-label">Senha: &nbsp;</label><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="pass" type="password" name="Pass"><br>
                                </div>
                                <div class="col-sm-1">
                                    <label for="cpf" class="medium-label">CPF: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="cpf" type="text" size="10" name="CPF" value="'.$data_form['CPF'].'"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="type" class="medium-label">Tipo: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <select class="medium-label" id="type" name="Type">
                                        <option class="medium-label" value="">Selecione uma opção</option>
                                        '.$type_option_list.'
                                    </select><br><br>
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
                                    <label for="role" class="medium-label">Cargo: &nbsp;</label><br>
                                </div>
                                <div class="col-sm-5">
                                    <select class="medium-label" id="role" name="Role">
                                        <option class="medium-label" value="">Selecione uma opção</option>
                                        '.$role_option_list.'
                                    </select><br>
                                </div>
                                <div class="col-sm-1">
                                    <label for="comment" class="medium-label">Comentarios: &nbsp;</label><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="comment" type="text" size="50" name="Comment" value="'.$data_form['COMMENT'].'"><br>
                                </div>
                            </div>
                            <div class="row">
                                <input id="permission_el" type="hidden" name="Permissions" value="'.$data_form['PERMISSIONS'].'">
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
                                    <label for="hire_date" class="medium-label">Dt Inicio: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="hire_date" type="date" size="30" name="Hire_Date" readonly value="'.$data_form['HIRE_DATE'].'"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="login" class="medium-label">Login: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="login" type="text" size="20" name="Login" readonly value="'.$data_form['LOGIN'].'"><br><br>
                                </div>
                                <div class="col-sm-1">
                                    <label for="cnpj" class="medium-label">CNPJ: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="cnpj" type="text" size="10" name="CNPJ" readonly value="'.$data_form['CNPJ'].'"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="pass" class="medium-label">Senha: &nbsp;</label><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="pass" type="password" name="Pass" readonly value="'.$data_form['PASS'].'"><br>
                                </div>
                                <div class="col-sm-1">
                                    <label for="cpf" class="medium-label">CPF: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="cpf" type="text" size="10" name="CPF" readonly value="'.$data_form['CPF'].'"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="type" class="medium-label">Tipo: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="type" type="text" size="20" name="Type" readonly value="'.$data_form['TYPE'].'"><br><br>
                                </div>
                                <div class="col-sm-1">
                                    <label for="status" class="medium-label">Status: &nbsp;</label><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="status" type="text" size="20" name="Status" readonly value="'.$data_form['STATUS'].'"><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="role" class="medium-label">Cargo: &nbsp;</label><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="role" type="text" size="20" name="Rolee" readonly value="'.$data_form['ROLE'].'"><br>
                                </div>
                                <div class="col-sm-1">
                                    <label for="comment" class="medium-label">Comentarios: &nbsp;</label><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="comment" type="text" size="50" name="Comment" readonly value="'.$data_form['COMMENT'].'"><br>
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
        //if(isset($_POST['operation']) && $_POST['operation']==="view"){
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
                                    <a href="'.ROOT."/Supplier/_update?id=$row->ID".'" title="Edit" class="text-primary updateBtn" id="'.$row->ID.'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                    <a href="'.ROOT."/Supplier/_delete?id=$row->ID".'" title="Delete" class="text-danger deleteBtn" id="'.$row->ID.'"><i class="fas fa-eraser"></i></a>
                                </td></tr>';
                }
                $output .= '</tbody>';
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

        if($data_form_executor="----" || $data_form_executor="" || $data_form_executor=null){
            $option_list = '<option class="medium-label" value="----" "selected">----</option>';
        } else {
            $option_list = '<option class="medium-label" value="----">----</option>';
        }

        $sql_stm = "SELECT * FROM SUPPLIER WHERE TYPE = :TYPE AND STATUS = :STATUS AND (ROLE = : ROLE1 OR ROLE = :ROLE2)";
        
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

        $sql_stm = "SELECT * FROM SUPPLIER WHERE TYPE = :TYPE AND STATUS = :STATUS AND (ROLE = : ROLE1 OR ROLE = :ROLE2)";
        
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


}