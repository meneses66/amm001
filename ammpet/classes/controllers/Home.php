<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Home {

    use _GlobalController;
    
    public function index()
    {
        //echo "This is home controller.";
        
        $this->view('home/home');
        
    }
    public function create()
    {
        //echo "This is home controller.";
        
        $this->view('create/create');
        
    }

}