<?php

class ProdServCon extends _GlobalController {

    public function index($a = '', $b = '', $c = '')
    {
        echo "This is ProdServ controller";
        show($a);
        show($b);
        show($c);
        $this->view('prodserv/prodserv');
    }

    public function edit(){
        echo "This is ProdServ controller";

        $this->view('prodserv/prodservedit');

    }

}