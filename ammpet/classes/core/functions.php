<?php

function show($anything){
    echo "<pre>";
    print_r($anything);
    echo "</pre>";
}

function esc($str){
    return htmlspecialchars($str);
}