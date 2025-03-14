<?php

namespace Controller;
if(session_status() === PHP_SESSION_NONE) session_start();

//defined('ROOTPATH') OR exit('Access denied!');
(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

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