<?php
    
    namespace Controller;
    
    defined('ROOTPATH');
    //OR exit('Access denied!');

    $init = new Auth();

    class Auth{

        public function __Construct(){
            return "This is Auth Controller";
        }        

    }
    