<?php
    //require_once 'siteController.php';
    //echo "Enter in ajax_call";
    var_dump($_POST);
    if(isset($_POST['class']))
    {
        $function = $_POST['function'];
        $className = $_POST['class'];
        echo $className."-->".$function;
        $class = new $className();
        $result = $class->$function();
        
        if(is_array($result))
        {
            print_r($result);
        }
            elseif(is_string($result ) && is_array(json_decode($result , true)))
            {
                print_r(json_decode($string, true));
            }
                else
                {
                    echo $result;
                }
    }