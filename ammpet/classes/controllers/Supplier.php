<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Supplier {

    use _GlobalController;
    
    public function index()
    {
        echo "This is Supplier controller";

        $this->view('supplier/supplier');
    }

}