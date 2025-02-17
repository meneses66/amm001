<?php
    
    namespace Controller;
    
    defined('ROOTPATH');
    //OR exit('Access denied!');

    $init = new Auth();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $operation = $_POST['op'];
        switch($operation)
        {
            case signin:
            return $init->login();
            break;

        }
        
    }

    class Auth{

        public function Index(){
            return "This is Auth Controller";
        }

        public function login()
        {
            $this->view('login/login2');
        }

    }
    