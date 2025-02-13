<?php

namespace Controller;

defined('ROOTPATH'); 
//OR exit('Access denied!');

class CredentialCheck {

    use _GlobalController;
    
    public function index()
    {
        if(isset($_POST)){
            echo $_POST;
            switch($_POST['type'])
            {
                case 'login':
                    return $call->login();
                    break;
            }
        }
        $this->view('login/login');
    }

    public function login()
    {
        $this->view('login/login2');
    }

}