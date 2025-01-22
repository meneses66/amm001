<?php

defined('ROOTPATH') OR exit('Access denied!');

class SupplierCon extends _GlobalController {

    public function index()
    {
        echo "This is Supplier controller";

        $this->view('supplier/supplier');
    }

}