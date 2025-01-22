<?php

namespace Core;

defined('ROOTPATH') OR exit('Access denied!');

class _GlobalController{

    public function view($name)
    {
        $fileName = "../classes/views/".$name.".view.php";
        if(file_exists($fileName))
        {
            require $fileName;

        } else{
            $fileName = "../classes/views/_404.view.php";
            require $fileName;
        }
    }
}