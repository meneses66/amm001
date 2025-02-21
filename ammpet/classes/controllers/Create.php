<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Create {

    use _GlobalController;
    
    public function index()
    {
        //echo "This is Create controller.";
        
        $this->view('create/create');
    }
}