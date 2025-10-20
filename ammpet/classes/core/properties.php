<?php

defined('ROOTPATH') OR exit('Access denied!');

if((empty($_SERVER['SERVER_NAME']) && php_sapi_name() == 'cli'))
{
    define('ROOT','https://amm01.sp1.br.saveincloud.net.br/ammpet/public');
    define('ROOTPATH_CLASSES', __DIR__ . DIRECTORY_SEPARATOR);
    // Database connection with environment overrides
    define('SERVERNAME', getenv('DB_HOST') ?: 'node213878-amm01.sp1.br.saveincloud.net.br:3306/');
    define('DBNAME', getenv('DB_NAME') ?: 'dbpetshop');
    define('DBUSER', getenv('DB_USER') ?: 'ammphp');
    define('DBPWD', getenv('DB_PASS') ?: 'Carol@21102012');
} else if((!empty($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'localhost'))
{
    define('ROOT','http://localhost/ammpet/public');
    define('ROOTPATH_CLASSES', __DIR__ . DIRECTORY_SEPARATOR);
    define('SERVERNAME', getenv('DB_HOST') ?: 'localhost:3306/');
    define('DBNAME', getenv('DB_NAME') ?: 'dbpetshop');
    define('DBUSER', getenv('DB_USER') ?: 'ammphp');
    define('DBPWD', getenv('DB_PASS') ?: 'Carol@21102012');
} else{
    define('ROOT','https://amm01.sp1.br.saveincloud.net.br/ammpet/public');
    define('ROOTPATH_CLASSES', __DIR__ . DIRECTORY_SEPARATOR);
    define('SERVERNAME', getenv('DB_HOST') ?: 'node213878-amm01.sp1.br.saveincloud.net.br:3306/');
    define('DBNAME', getenv('DB_NAME') ?: 'dbpetshop');
    define('DBUSER', getenv('DB_USER') ?: 'ammphp');
    define('DBPWD', getenv('DB_PASS') ?: 'Carol@21102012');
}

define('DEBUG', true);
define('DS', DIRECTORY_SEPARATOR);
