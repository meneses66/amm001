<?php

class Home extends _GlobalController {
    
    public function index($a = '', $b = '', $c = '')
    {
        echo "This is home controller";
        show($a);
        show($b);
        show($c);
        try {
            $supplier = new Supplier;
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