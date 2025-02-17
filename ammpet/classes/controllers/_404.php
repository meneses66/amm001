<?php

namespace Controller;

//defined('ROOTPATH') OR exit('Access denied!');

class _404 {

    use _GlobalController;
    
    public function index()
    {
        echo "404 error - controller not found";
    }
}