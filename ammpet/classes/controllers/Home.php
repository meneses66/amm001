<?php

defined('ROOTPATH') OR exit('Access denied!');

class Home extends \Controller\_GlobalController {
    
    public function index()
    {
        echo "This is home controller";

        /**
        try {
            $supplier = new Supplier;
        } catch (\Throwable $th) {
            //throw $th;
            echo "Error found=> ".$th;
        }
        $arr['ID']=1;
        $result = $supplier->getRow($arr);
        show($result);
         */
        
        $this->view('home');
    }
}