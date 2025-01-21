<?php

spl_autoload_register(function($className){

    $folderClasses = 'ammpet/classes/';

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

require 'functions.php';
require 'properties.php';
require '_DAO.php';
require '_GlobalModel.php';
require '_GlobalController.php';
require 'config.php';
require 'App.php';