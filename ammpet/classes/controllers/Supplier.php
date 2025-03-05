<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Supplier {

    use _GlobalController;
    
    public function index()
    {
        //echo "This is Supplier controller";
        $this->view('supplier/supplier');
       
    }

    //Sends to page to create new Supplier
    public function new_supplier(){

        $operation = 'goto_new_supplier';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $operation = $_POST['op'];

        }

        $this->goto_view($operation);
    }

    //Sends to List View
    public function list_supplier(){
        $operation = 'goto_list_supplier';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $operation = $_POST['op'];

        }

        $this->goto_view($operation);

    }

    //Sends to Update View
    public function update_supplier(){

        $operation = 'goto_update_supplier';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $operation = $_POST['op'];

        }

        $this->goto_view($operation);

    }

    //Inserts new Supplier into DB
    public function insert_call(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Create new Login instance:
            $supplier = new \Model\Supplier;

            //Define inputs for DB operations:
                
            foreach ($_POST as $key => $value) {
                //echo $key.": ".$value."<br>";
                $inputs[$key]=$value;    
            }

            //Remove items from array inputs that are not columns in DB (op) or are auto-increment (Id)
            unset($inputs["op"]);
            unset($inputs["Id"]);
            //Remove items from array inputs that are populated automatically in DB
            unset($inputs["Created"]);
            unset($inputs["Updated"]);

            try {
                $supplier->insert($inputs);
                $this->view('supplier/supplier-list');
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        
    }

    public function update_call(){

            //Create new Model instance:
            $supplier = new \Model\Supplier;

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
            unset($inputs["op"]);
            unset($inputs["Id"]);
            //Remove items from array inputs that are populated automatically in DB
            unset($inputs["Created"]);
            unset($inputs["Updated"]);

            try {
                $supplier->update($id, $inputs);
                $this->view('supplier/supplier-list');
            } catch (\Throwable $th) {
                throw $th;
            }
    }

    public function load_new_form(){

        if(!isset($_SESSION['username'])) {session_start();}
            $output = "";
            //$supplier = new \Model\Supplier;
            
            $output .= '<div class="row">
                            <div class="col-sm-6">
                                <input id="id" type="hidden" name="Id" value="">
                                <input id="created_by" type="hidden" name="Created_by" value="'.$_SESSION['username'].'">
                                <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
                                <input id="created" type="hidden" name="Created" value="">
                                <input id="updated" type="hidden" name="Updated" value="">
                                <input id="sequence" type="hidden" name="Sequence" value="">
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
                                <input id="hire_date" type="date" size="30" name="Hire_date"><br><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="login" class="medium-label">Login: &nbsp;</label><br><br>
                            </div>
                            <div class="col-sm-5">
                                <input id="login" type="text" size="20" name="Login"><br><br>
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
                                    <option class="medium-label" value="Funcionario">Funcionario</option>
                                    <option class="medium-label" value="Fornecedor">Fornecedor</option>
                                    <option class="medium-label" value="Freelancer">Freelancer</option>
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
                                    <option class="medium-label" value="Banhista">Banhista</option>
                                    <option class="medium-label" value="Tosador">Tosador</option>
                                    <option class="medium-label" value="Recepcao">Recepcao</option>
                                    <option class="medium-label" value="Proprietario">Proprietario</option>
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

    public function load_update_form(){

        if (isset($_GET['id'])){

            if(!isset($_SESSION['username'])) {session_start();}
            $output = "";
            $inputs["ID"]=$_GET['id'];
            $id=$_GET['id'];
            $supplier = new \Model\Supplier;
            //$data = $supplier->getRowbyId($id);
            $data = $supplier->getRow($inputs);

            if($data){

                foreach ($data as $key => $value) {
                    $data_form[$key]=$value;
                }

                //var_dump($data_form);

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
                                    <label for="cnpj" class="medium-label">CNPJ: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="cnpj" type="text" size="10" name="CNPJ" value="'.$data_form['CNPJ'].'"><br><br>
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
                                    <label for="cpf" class="medium-label">CPF: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="cpf" type="text" size="10" name="CPF" value="'.$data_form['CPF'].'"><br><br>
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
                                    <label for="sequence" class="medium-label">Sequencia: &nbsp;</label><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="sequence" type="text" size="8" name="Sequence" value="'.$data_form['SEQUENCE'].'"><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="type" class="medium-label">Tipo: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <select class="medium-label" id="type" name="Type">
                                        <option class="medium-label" value="">Selecione uma opção</option>
                                        <option class="medium-label" value="Funcionario" '.(($data_form['TYPE'] == 'Funcionario')?"selected":"").'>Funcionario</option>
                                        <option class="medium-label" value="Fornecedor" '.(($data_form['TYPE'] == 'Fornecedor')?"selected":"").'>Fornecedor</option>
                                        <option class="medium-label" value="Freelancer" '.(($data_form['TYPE'] == 'Freelancer')?"selected":"").'>Freelancer</option>
                                    </select><br><br>
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
                                    <label for="role" class="medium-label">Cargo: &nbsp;</label><br>
                                </div>
                                <div class="col-sm-5">
                                    <select class="medium-label" id="role" name="Role">
                                        <option class="medium-label" value="">Selecione uma opção</option>
                                        <option class="medium-label" value="Banhista" '.(($data_form['ROLE'] == 'Banhista')?"selected":"").'>Banhista</option>
                                        <option class="medium-label" value="Tosador" '.(($data_form['ROLE'] == 'Tosador')?"selected":"").'>Tosador</option>
                                        <option class="medium-label" value="Recepcao" '.(($data_form['ROLE'] == 'Recepcao')?"selected":"").'>Recepcao</option>
                                        <option class="medium-label" value="Proprietario" '.(($data_form['ROLE'] == 'Proprietario')?"selected":"").'>Proprietario</option>
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
    public function load_rows(){
        //if(isset($_POST['operation']) && $_POST['operation']==="view"){
            $output = "";
            $supplier = new \Model\Supplier;
            $data = $supplier->listAll();
            if($supplier->countAll()>0){
                $output .='<table class="table Table-stripped table-sm table-bordered">
                    <thead>
                        <tr class="text-center text-secondary">
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Cargo</th>
                            <th>Tipo</th>
                            <th>Status</th>
                            <th>CNPJ</th>
                            <th>CPF</th>
                            <th>Sequência</th>
                            <th>DataInício</th>
                            <th>Comentários</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>';
                foreach ($data as $row) {
                    $output .='<tr class="text-center text-secondary">
                                <td>'.$row->ID.'</td>
                                <td>'.$row->NAME.'</td>
                                <td>'.$row->LOGIN.'</td>
                                <td>'.$row->ROLE.'</td>
                                <td>'.$row->TYPE.'</td>
                                <td>'.$row->STATUS.'</td>
                                <td>'.$row->CNPJ.'</td>
                                <td>'.$row->CPF.'</td>
                                <td>'.$row->SEQUENCE.'</td>
                                <td>'.$row->HIRE_DATE.'</td>
                                <td>'.$row->COMMENT.'</td>
                                <td>
                                    <a href="'.ROOT."/Supplier/update_supplier?id=$row->ID".'" title="Edit" class="text-primary updateBtn" id="'.$row->ID.'"><i class="fas fa-edit"></i>A</a>&nbsp;&nbsp;
                                    <a href="'.ROOT."/Supplier/delete_supplier?id=$row->ID".'" title="Delete" class="text-danger deleteBtn" id="'.$row->ID.'"><i class="fas fa-eraser"></i>D</a>
                                </td></tr>';
                }
                $output .= '</tbody></table>';
                echo $output;
            }
            else{
                echo '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3>';
            }
        //}
    }

    //Defines view to go to
    private function goto_view($op){
        
        switch($op)
        {
            case 'goto_new_supplier':
                $this->view('supplier/supplier-new');
            break;

            case 'goto_list_supplier':
                $this->view('supplier/supplier-list');
            break;

            case 'goto_update_supplier':
                $this->view('supplier/supplier-update');
            break;
        }
    }

}