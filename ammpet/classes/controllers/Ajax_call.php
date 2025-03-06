<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Supplier {

    use _GlobalController;
    
    public function index()
    {
        //require_once 'siteController.php';
        //var_dump($_GET);
        //var_dump($_POST);
        //echo $_SERVER['REQUEST_METHOD'];
        
        if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['class']) && isset($_POST['method']) )
    {
        $className = $_POST['class'];
        $method = $_POST['method'];
        
        foreach ($_POST as $key => $value) {
            $inputs[$key]=$value;    
        }

        $class = new ('\Controller\\'.$className);
        $result = $class->$method($inputs);
        
        if(is_array($result))
        {
            print_r($result);
        }
            elseif(is_string($result) && is_array(json_decode($result , true)))
            {
                print_r(json_decode($string, true));
            }
                else
                {
                    echo $result;
                }
    }    
    }

}