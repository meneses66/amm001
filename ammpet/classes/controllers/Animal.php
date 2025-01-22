<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Animal extends _GlobalController {

    public function index()
    {
        echo "This is Animal controller";

        $this->view('animal/animal');
    }

    public function List()
    {
        
    }

}
?>