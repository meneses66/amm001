<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Params {

    use _GlobalController;
    public $object = 'params';
    public $UCF_object = 'Params';
    public $type = 'PARAMS_TYPE';

    public function index()
    {
        //echo "This is Params controller";

        //$this->view('params/params');
    }


    //SESSION WITH FUNCTIONS TO ALLOWS OTHER CLASSES TO GET PARAM VALUES
    public function getParamValue($type, $name, $status){
        $model = new \Model\Params;
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
        $model = new \Model\Params;
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


    //SESSION TO DEFINE TO WHICH PAGE USER WILL BE SENT: NEW, UPDATE, DELETE, LIST

    //Sends to page to create NEW Params
    public function _new(){

        $operation = 'goto_new';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $operation = $_POST['operation'];
        }
        $this->goto_view($operation);
    }

    //Sends to LIST View
    public function _list(){
        $operation = 'goto_list';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $operation = $_POST['operation'];
        }
        $this->goto_view($operation);
    }

    //Sends to UPDATE View
    public function _update(){

        $operation = 'goto_update';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $operation = $_POST['operation'];
        }
        $this->goto_view($operation);
    }

    //Sends to DELETE View
    public function _delete(){

        $operation = 'goto_delete';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $operation = $_POST['operation'];
        }
        $this->goto_view($operation);
    }

    //Defines view to go to
    private function goto_view($operation){
    
        switch($operation)
        {
            case 'goto_new':
                $view="$this->object/$this->object-new";
                $this->view($view);
            break;

            case 'goto_list':
                $view="$this->object/$this->object-list";
                $this->view($view);
            break;

            case 'goto_update':
                $view="$this->object/$this->object-update";
                $this->view($view);
            break;

            case 'goto_delete':
                $view="$this->object/$this->object-delete";
                $this->view($view);
            break;
        }
    }
    

    //SESSION TO CALL DB ACTIONS: INSERT, UPDATE, DELETE

    //Inserts new Supplier into DB
    public function insert_call(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Create new Login instance:
            $model = new \Model\Params;

            //Define inputs for DB operations:
                
            foreach ($_POST as $key => $value) {
                //echo $key.": ".$value."<br>";
                $inputs[$key]=$value;    
            }

            //Remove items from array inputs that are not columns in DB (op) or are auto-increment (Id)
            unset($inputs["operation"]);
            unset($inputs["Id"]);
            //Remove items from array inputs that are populated automatically in DB
            unset($inputs["Created"]);
            unset($inputs["Updated"]);

            try {
                $model->insert($inputs);
                $view = "$this->object/list_$this->object";
                redirect("$view");
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        
    }

    //Updates Supplier into DB
    public function update_call(){

            //Create new Model instance:
            $model = new \Model\Params;

            //Get Id from $_POST:
            if(isset($_POST["Id"])){
                $id = $_POST["Id"];
            } else {
                die("Record Id not informed.");
            }

            //Define inputs for DB operations:
                
            foreach ($_POST as $key => $value) {
                
                $inputs[$key]=$value;    
            }

            //Remove items from array inputs that are not columns in DB (op) or are auto-increment (Id)
            unset($inputs["operation"]);
            unset($inputs["Id"]);
            //Remove items from array inputs that are populated automatically in DB
            unset($inputs["Created"]);
            unset($inputs["Updated"]);

            try {
                $$this->object->update($id, $inputs);
                redirect("$this->object/list_$this->object");
            } catch (\Throwable $th) {
                throw $th;
            }
    }

    //Deletes Supplier from DB
    public function delete_call($inputs=null){

        //Create new Model instance:
        $model = new \Model\Params;

        //Get Id from $_POST:
        if(isset($inputs["del_id"])){

            $id = $inputs["del_id"];

            try {
                $model->delete($id);
            } catch (\Throwable $th) {
                throw $th;
            }

        } else {
            die("Record Id not informed.");
        }
        
}

    //SESSION TO LOAD HTML FORMS:

    //LOAD HTML FORM FOR CREATING NEW RECORD
    public function load_new_form(){

        //START SESSION IF NOT STARTED TO GET $SESSION USERNAME
        if(!isset($_SESSION['username'])) {session_start();}

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
                            <label for="name" class="medium-label">Nome: &nbsp;</label><br><br>
                        </div>
                        <div class="col-sm-5">
                            <input id="name" type="text" size="40" name="Name"><br><br>
                        </div>
                        <div class="col-sm-1">
                            <label for="value" class="medium-label">Valor: &nbsp;</label><br><br>
                        </div>
                        <div class="col-sm-5">
                            <input id="value" type="text" size="40" name="Value"><br><br>
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
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="comment" class="medium-label">Comentário: &nbsp;</label><br><br>
                        </div>
                        <div class="col-sm-5">
                            <input id="comment" type="text" size="40" name="Comment"><br><br>
                        </div>
                        <div class="col-sm-1">
                            
                        </div>
                        <div class="col-sm-5">
                            
                        </div>
                    </div>';
                    echo $output;

    }

    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_update_form(){

        if (isset($_GET['id'])){

            if(!isset($_SESSION['username'])) {session_start();}
            $output = "";
            $inputs["ID"]=$_GET['id'];
            $id=$_GET['id'];
            $model = new \Model\Params;
            
            $data = $model->getRow($inputs);

            if($data){

                foreach ($data as $key => $value) {
                    $data_form[$key]=$value;
                }

                //FOR EACH DROPDOWN GET $data_form and send to load_options_update to get the selected option
                //$data_form_type = $data_form['TYPE'];
                //$type_option_list = load_options_update("SUPPLIER_TYPE", "Ativo", $data_form_type);

                //$data_form_role = $data_form['ROLE'];
                //$role_option_list = load_options_update("SUPPLIER_ROLE", "Ativo", $data_form_role);

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
                                    <input id="pass" type="password" name="Pass" value="'.$data_form['PASS'].'"><br>
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

            if(!isset($_SESSION['username'])) {session_start();}
            $output = "";
            $inputs["ID"]=$_GET['id'];
            $id=$_GET['id'];
            $model = new \Model\Params;
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
                            echo $output;
            } else{
                show("No record to display!");
            }

        }

    }

    //LOAD HTML FOR LISTING RECORDS IN TABLE
    public function load_rows(){
            
        $output = "";
        $model = new \Model\Params;
        
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
            echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3>';
        }
    }

}