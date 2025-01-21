<?php

class Home extends _GlobalController {
    
    public function index()
    {
        #echo "This is home controller";
        $prodserv = new ProdServ;

        #$arr['ID']=1;
        
        $result = $prodserv->listAll();
        
        show($result);
        
        $this->view('home');
    }
}