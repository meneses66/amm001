<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Home {

    use _GlobalController;
    
    public function index()
    {
        echo "This is home controller. PHP info is: " .php_info();

        
        try {
            $supplier = new \Model\Supplier;
        } catch (\Throwable $th) {
            //throw $th;
            echo "Error found=> ".$th;
        }
        $arr['ID']=1;
        $result = $supplier->getRow($arr);
        show($result);
        
        
        $this->view('home');
    }
}