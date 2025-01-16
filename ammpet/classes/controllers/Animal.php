<?php

class Animal extends _GlobalController {

    public function index()
    {
        echo "This is Animal controller";

        $this->view('animal');
    }

    public function List()
    {
        
    }

}
?>