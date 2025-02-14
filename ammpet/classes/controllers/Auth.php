<?php

namespace Controller;

defined('ROOTPATH'); 
//OR exit('Access denied!');

class Auth {

    use _GlobalController;

    public function index()
    {
        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $login = $_POST['login'];
                $pass = $_POST['pass'];
                $operation = $_POST['operation'];
                switch($operation)
                {
                    case login:
                    $init->login();
                    break;
        
                }
                
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        $this->view('login/login');
    }

    public function login()
    {
        $this->view('login/login2');
    }

}

$init = new Auth();

