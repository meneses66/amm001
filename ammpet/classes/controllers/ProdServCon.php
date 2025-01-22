<?php

defined('ROOTPATH') OR exit('Access denied!');

class ProdServCon extends _GlobalController {

    public function index()
    {
        echo "This is ProdServ controller";

        $this->view('prodserv/prodserv');
    }

    public function edit(){
        echo "This is ProdServ controller";

        $this->view('prodserv/prodservedit');

    }

}