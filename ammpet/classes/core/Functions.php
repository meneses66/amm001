<?php

class Functions{
    
    function show($anything){
        echo "<pre>";
        print_r($anything);
        echo "</pre>";
    }
        
}

show($_GET);