<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Login {

    use _GlobalController;
    
    public function index()
    {
        #echo "This is login controller";
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
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