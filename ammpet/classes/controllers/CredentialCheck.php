<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class CredentialCheck {

    use _GlobalController;
    
    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            #echo $_POST;
            switch($_POST['type'])
            {
                case 'login':
                    $call->login();
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