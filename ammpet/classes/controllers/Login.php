<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Login {

    use _GlobalController;
    
    public function index()
    {
        #echo "This is login controller";
        $this->view('login/login');
    }

    public function login()
    {
        $this->view('login/login2');
    }

}