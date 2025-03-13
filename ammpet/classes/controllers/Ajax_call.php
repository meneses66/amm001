<?php

namespace Controller;

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class Ajax_call {

    use _GlobalController;
    
    public function index()
    {    
        if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['class']) && isset($_POST['method']) )
    {
        $className = $_POST['class'];
        $method = $_POST['method'];
        require_once $_POST['class'].'.php';
        
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