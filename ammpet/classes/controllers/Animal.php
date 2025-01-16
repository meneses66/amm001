<?php

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