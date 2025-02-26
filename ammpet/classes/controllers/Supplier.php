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
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $operation = $_POST['op'];
            
            $this->goto_view($operation);

        }
    }

    //Inserts new Supplier into DB
    public function insert(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Create new Login instance:
            $init = new \Model\Supplier;

            //Define inputs for DB operations:
                
                foreach ($_POST as $key => $value) {
                    echo $key.": ".$value."<br>";
                    $inputs[$key]=$value;
                    $init->__construct($inputs);
                    
                }

                echo var_dump($init)."<br>";

        }
        
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