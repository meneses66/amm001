<?php

class Home extends _GlobalController {
    
    public function index()
    {
        #echo "This is home controller";
        $supplier = new Supplier;
        $arr['ID']=1;
        $result = $supplier->getRow($arr);
        show($result);
        $this->view('home');
    }
}