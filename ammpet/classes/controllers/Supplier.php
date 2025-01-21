<?php

class Supplier extends _GlobalController {

    public function index()
    {
        echo "This is Supplier controller";

        $this->view('supplier');
    }

}