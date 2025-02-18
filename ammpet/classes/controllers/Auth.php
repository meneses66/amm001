<?php
    
    namespace Controller;
    
    //defined('ROOTPATH') OR exit('Access denied!');

    @$op=$_REQUEST['op'];

    use _GlobalController;

    class Auth {
           
        function index(){
            //echo "This is Auth Controller: ".$op;
            try {
                $init = new \Controller\Test;
            } catch (\Throwable $th) {
                //throw $th;
                echo "Error found=> ".$th;
            }
            
            //$init->Test();
        }
    }

    





