<?php
    
    namespace Controller;
    
    defined('ROOTPATH') OR exit('Access denied!');

    use _GlobalController;

    class Auth {
           
        function index(){
            //echo "This is Auth Controller: ".$op;
            //$op=$_REQUEST['op'];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                //Get information from $_POST
                $login = $_POST['login'];
                $pass = $_POST['pass'];
                $operation = $_POST['op'];

                //Create new Login instance:
                $init = new \Controller\Login;

                switch($operation)
                {
                    case 'signin':
                        $init->signin($login,$pass) ? $init->_login() : $init->_logout();
                        show($init);
                    break;
                }
                
            }
            
        }
    }

    





