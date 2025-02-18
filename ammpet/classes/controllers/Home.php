<?php

namespace Controller;

//defined('ROOTPATH') OR exit('Access denied!');

class Home {

    use _GlobalController;
    
    public function index()
    {
        echo "This is home controller. PHP info is: ";
        
        $this->view('home/home');
    }
}