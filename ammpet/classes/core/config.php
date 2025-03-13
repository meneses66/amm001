<?php

defined('ROOTPATH') OR exit('Access denied!');

spl_autoload_register(function($className){

    $className = explode("\\", $className);
    $className = end($className);
    $folderClasses = '../classes/';

    $possibleFolderPaths = [
        $folderClasses,
        $folderClasses . 'models/',
        $folderClasses . 'views/',
        $folderClasses . 'controllers/'
        #$folderClasses . 'core/'
    ];

    foreach($possibleFolderPaths as $currentFolder){
        $fileName = $currentFolder . $className . '.php';
        if (file_exists($fileName)){
            require_once $fileName;
            break;
        }
    }
});