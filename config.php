<?php

    spl_autoload_register(function($className){

        $folderClasses = 'classes';

        $possibleFolderPaths = [
            $folderClasses,
            $folderClasses . 'models/',
            $folderClasses . 'views/',
            $folderClasses . 'controllers/',
            $folderClasses . 'packages/',
        ];

        foreach($possibleFolderPaths as $currentFolder){
            $fileName = $currentFolder . $className . 'php';
            if (file_exists($fileName)){
                require_once $fileName;
                break;
            }
        }
    });
?>