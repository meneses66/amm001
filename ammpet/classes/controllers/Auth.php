<?php
    
    namespace Controller;
    
    defined('ROOTPATH');
    //OR exit('Access denied!');

    $init = new Auth();
    $init->Index();

    class Auth{

        public function Index(){
            return "This is Auth Controller";
        }

    }
    