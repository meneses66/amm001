<?php

class Home extends _GlobalController {
    
    public function index()
    {
        echo "This is home controller";

        $this->view('home');
    }
}