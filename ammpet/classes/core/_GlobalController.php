<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

Trait _GlobalController{

    public function view($name)
    {
        $fileName = "../classes/views/".$name.".view.php";
        if(file_exists($fileName))
        {
            require $fileName;

        } else{
            $fileName = "../classes/views/_404.view.php";
            require $fileName;
        }
    }

    public function view_id($name)
    {
        
        $fileName = "../classes/views/".$name.".view.php";
        if(file_exists($fileName))
        {
            require $fileName;

        } else{
            $fileName = "../classes/views/_404.view.php";
            require $fileName;
        }
    }


    // FUNCTIONS MOVED FROM PARAMS TO BE STANDARDIZED

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
            $model = new('\Model\\'.$this->UCF_object);

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
                $view = "$this->UCF_object/_list";
                redirect("$view");
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        
    }

    //Updates Supplier into DB
    public function update_call(){

            //Create new Model instance:
            $model = new('\Model\\'.$this->UCF_object);

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
                $model->update($id, $inputs);
                redirect("$this->UCF_object/_list");
            } catch (\Throwable $th) {
                throw $th;
            }
    }

    //Deletes Supplier from DB
    public function delete_call($inputs=null){

        //Create new Model instance:
        $model = new('\Model\\'.$this->UCF_object);

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

}


    