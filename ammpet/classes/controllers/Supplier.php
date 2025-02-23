<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Supplier {

    use _GlobalController;
    
    public function index()
    {
        //echo "This is Supplier controller";
        //$this->view('supplier/supplier');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //Get information from $_POST
            $operation = $_POST['op'];

            //Define inputs for DB operations:
            $inputs[]="";

            //Create new Login instance:
            $init = new \Model\Supplier;

            switch($operation)
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

}