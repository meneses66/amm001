<?php

class Home extends _GlobalModel {
    
    #use _GlobalModel;
    
    public function index()
    {
        echo "This is home controller";
        $supplier = new Supplier;
        $result = $supplier->listAll();
        show($result);
        $this->view('home');
    }
}