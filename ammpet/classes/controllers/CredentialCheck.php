<?php

namespace Controller;

defined('ROOTPATH'); 
//OR exit('Access denied!');

class CredentialCheck {

    use _GlobalController;
    
    public function index()
    {
        if(isset($_POST)){
            $login = $_POST['login'];
            $pass = $_POST['pass'];
            echo $login . " - " . $pass;
            return $call->login();
        }
        $this->view('login/login');
    }

    public function login()
    {
        $this->view('login/login2');
    }

}