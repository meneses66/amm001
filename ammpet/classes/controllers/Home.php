<?php

class Home extends _GlobalController {
    
    public function index()
    {
        echo "This is home controller";

        try {
            $prodserv = new ProdServ;
        } catch (\Throwable $th) {
            //throw $th;
            echo "Error found=> ".$th;
        }
        

        #$arr['ID']=1;
        
        $result = $prodserv->listAll();
        
        show($result);
        
        $this->view('home');
    }
}