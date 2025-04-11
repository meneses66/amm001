<?php

namespace Controller;

//if(session_status() === PHP_SESSION_NONE) session_start();

if(session_status() === PHP_SESSION_NONE){
    my_session_start();
    my_session_regenerate_id();
}

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class Search {

    use _GlobalController;
    
    public function index()
    {
        //echo "This is Search controller.";
        
        $this->view('search/search');
    }
}