<?php

defined('ROOTPATH') OR exit('Access denied!');

spl_autoload_register(function($fqcn){

    // Base path for classes directory using ROOTPATH_CLASSES (classes/core/) -> up to classes/
    $base = removeFromEnd(ROOTPATH_CLASSES, 'core/');

    // Normalize namespace and class
    $parts = explode('\\\\', $fqcn);
    $top = $parts[0] ?? '';
    $class = end($parts);

    $paths = [];
    switch ($top) {
        case 'Controller':
            $paths[] = $base . 'controllers/' . $class . '.php';
            break;
        case 'Model':
            $paths[] = $base . 'models/' . $class . '.php';
            break;
        case 'Core':
            $paths[] = $base . 'core/' . $class . '.php';
            break;
        default:
            // Fallback search order: controllers, models, views, base
            $paths[] = $base . 'controllers/' . $class . '.php';
            $paths[] = $base . 'models/' . $class . '.php';
            $paths[] = $base . 'views/' . $class . '.php';
            $paths[] = $base . $class . '.php';
            break;
    }

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
