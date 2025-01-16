<?php

class Home extends _GlobalController {
    
    public function index()
    {
        echo "This is home controller";
    }
}

$home = new Home;
call_user_func_array([$home,index],[]);