<?php

class Home {
    
    use _GlobalModel;
    public function index()
    {
        echo "This is home controller";
        $this->view('home');
    }
}