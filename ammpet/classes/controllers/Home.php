<?php

class Home {
    
    use _GlobalModel;
    
    public function index()
    {
        echo "This is home controller";
        $supplier = new Supplier;
        $result = $this-> $supplier->listAll();
        return $result;
        $this->view('home');
    }
}