<?php
    
    namespace Controller;
    
    defined('ROOTPATH');
    //OR exit('Access denied!');

    $init = new \Controller\Login();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $operation = $_POST['op'];
        switch($operation)
        {
            case signin:
            $init->signin($login,$pass) ? $init->login() : $init->logout();
            break;
        }
        
    }