<?php

class ProdServCon extends _GlobalController {

    public function index()
    {
        echo "This is ProdServ controller";

        $this->view('prodserv/prodserv');
    }

}