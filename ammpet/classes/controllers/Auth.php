<?php
    
    namespace Controller;
    
    //defined('ROOTPATH') OR exit('Access denied!');

    @$op=$_REQUEST['op'];

    //echo "This is Auth Controller: ".$op;
    try {
        $init = new \Controller\Test;
    } catch (\Throwable $th) {
        //throw $th;
        echo "Error found=> ".$th;
    }
    
    //$init->Test();
    





