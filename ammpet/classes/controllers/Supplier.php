<?php

class Supplier {

    use _GlobalModel;
    protected $table = 'SUPPLIER';
    
    public function index()
    {
        echo "This is supplier controller";
    }

    
}