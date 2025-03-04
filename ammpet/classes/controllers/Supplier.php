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
                //$supplier->__construct($inputs);    
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

    public function update_call($inputs){

            //Create new Model instance:
            $supplier = new \Model\Supplier;

            //Get Id from Inputs:

            if(isset($inputs["Id"])){
                $id = $inputs["Id"];
            } else {
                die("Record Id not informed.");
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

    public function load_update_form(){

        if (isset($_GET['id'])){

            if(!isset($_SESSION['username'])) {session_start();}
            $output = "";
            $inputs["ID"]=$_GET['id'];
            $supplier = new \Model\Supplier;
            $supplier->getRow($inputs);

            if($supplier){
                $output .= '<div class="row">
                                <div class="col-sm-6">
                                    <label for="id" class="medium-label">Id: &nbsp;</label><input id="id" type="text" size="8" name="Id" readonly value="'.$supplier['Id'].'"><br>
                                    <input id="created_by" type="hidden" name="Created_by" value="'.$_SESSION['username'].'">
                                    <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
                                    <input id="created" type="hidden" name="Created" value="'.$supplier['Created'].'">
                                    <input id="updated" type="hidden" name="Updated" value="'.$supplier['Updated'].'">
                                    <label for="name" class="medium-label">Nome: &nbsp;</label><input id="name" type="text" size="50" name="Name"><br><br>
                                    <label for="login" class="medium-label">Login: &nbsp;</label><input id="login" type="text" size="20" name="Login"><br><br>
                                    <label for="pass" class="medium-label">Senha: &nbsp;</label><input id="pass" type="password" name="Pass"><br><br>
                                    <label for="type" class="medium-label">Tipo: &nbsp;</label>
                                    <select class="medium-label" id="type" name="Type">
                                        <option class="medium-label" value="" selected>Selecione uma opção</option>
                                        <option class="medium-label" value="Funcionario">Funcionario</option>
                                        <option class="medium-label" value="Fornecedor">Fornecedor</option>
                                        <option class="medium-label" value="Freelancer">Freelancer</option>
                                    </select><br><br>
                                    <label for="Role" class="medium-label">Cargo: &nbsp;</label>
                                    <select class="medium-label" id="role" name="Role">
                                        <option class="medium-label" value="" selected>Selecione uma opção</option>
                                        <option class="medium-label" value="Banhista">Banhista</option>
                                        <option class="medium-label" value="Tosador">Tosador</option>
                                        <option class="medium-label" value="Recepcao">Recepcao</option>
                                        <option class="medium-label" value="Proprietario">Proprietario</option>
                                    </select><br><br>
                                    <label for="Status" class="medium-label">Status: &nbsp;</label>
                                    <select class="medium-label" id="status" name="Status">
                                        <option class="medium-label" value="" selected>Selecione uma opção</option>
                                        <option class="medium-label" value="Ativo">Ativo</option>
                                        <option class="medium-label" value="Inativo">Inativo</option>
                                    </select><br><br>
                                </div>
                                <div class="col-sm-6">
                                    <label for="CNPJ" class="medium-label">CNPJ: &nbsp;</label><input id="cnpj" type="text" size="10" name="CNPJ"><br><br>
                                    <label for="CPF" class="medium-label">CPF: &nbsp;</label><input id="cpf" type="text" size="10" name="CPF"><br><br>
                                    <label for="Sequence" class="medium-label">Sequencia: &nbsp;</label><input id="seq" type="text" size="8" name="Sequence"><br><br>
                                    <label for="Hire_Date" class="medium-label">Data Inicio: &nbsp;</label><input id="start_date" type="date" size="30" name="Hire_Date"><br><br>
                                    <label for="Comment" class="medium-label">Comentarios: &nbsp;</label><input id="comment" type="text" size="50" name="Comment"><br><br>
                                </div>
                            </div>';
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
                            <th>Data Início</th>
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