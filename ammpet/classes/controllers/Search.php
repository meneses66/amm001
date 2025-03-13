<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Search {

    use _GlobalController;
    
    public function index()
    {
        //echo "This is Search controller.";
        
        $this->view('search/search');
    }
}