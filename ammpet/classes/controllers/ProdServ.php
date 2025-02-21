<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class ProdServ {

    use _GlobalController;

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