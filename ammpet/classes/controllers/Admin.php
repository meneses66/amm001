<?php

namespace Controller;

//defined('ROOTPATH') OR exit('Access denied!');

(defined('ROOTPATH') AND defined('USERLOGGED')) OR exit('Access denied!');

class Admin {

    use _GlobalController;
    
    public function index()
    {
        //echo "This is home controller.";
        
        $this->view('admin/admin');
        
    }

    public function cash_register()
    {
        //echo "This is home controller.";
        
        $this->view('cash_register/cash_register');
        
    }

    public function costs()
    {
        //echo "This is home controller.";
        
        $this->view('costs/costs');
        
    }

    public function salary()
    {
        //echo "This is home controller.";
        
        $this->view('salary/salary-list');
        
    }

    public function params()
    {
        //echo "This is home controller.";
        
        $this->view('params/params-list');
        
    }

    public function pre_closing()
    {
        //echo "This is home controller.";
        
        $this->view('pre_closing/pre_closing');
        
    }

    public function month_closing()
    {
        //echo "This is home controller.";
        
        $this->view('month_closing/month_closing');
        
    }

    public function results()
    {
        //echo "This is home controller.";
        
        $this->view('results/results');
        
    }

}