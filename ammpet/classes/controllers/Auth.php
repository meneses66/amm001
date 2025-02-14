<?php

namespace Controller;

defined('ROOTPATH'); 
//OR exit('Access denied!');

class Auth {

    use _GlobalController;

    public function index()
    {
        $this->view('login/login');
    }

    public function login()
    {
        $this->view('login/login2');
    }

}

$init = new Auth();

try {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $operation = $_POST['operation'];
        switch($operation)
        {
            case login:
            echo $login . " - " . $pass;
            return $call->login();
            break;

        }
        
    }
} catch (\Throwable $th) {
    echo $th;
}