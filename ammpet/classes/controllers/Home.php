<?php

namespace Controller;
session_start();

(defined('ROOTPATH') AND session_id!=="") OR exit('Access denied!');

class Home {

    use _GlobalController;
    
    public function index()
    {
        //echo "This is home controller.";
        
        $this->view('home/home');
        
    }
    public function create()
    {
        //echo "This is home controller.";
        
        $this->view('create/create');
        
    }
    public function search()
    {
        //echo "This is home controller.";
        
        $this->view('search/search');
        
    }
    public function report()
    {
        //echo "This is home controller.";
        
        $this->view('report/report');
        
    }

}