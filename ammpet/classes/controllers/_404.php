<?php

namespace Controller;

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class _404 {

    use _GlobalController;
    
    public function index()
    {
        echo "404 error - controller not found";
    }
}