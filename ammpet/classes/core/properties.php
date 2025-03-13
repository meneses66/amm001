<?php

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

if((empty($_SERVER['SERVER_NAME']) && php_sapi_name() == 'cli'))
{
    define('ROOT','https://amm01.sp1.br.saveincloud.net.br/ammpet/public');
    define('ROOTPATH_CLASSES', __DIR__ . DIRECTORY_SEPARATOR);
    //define('SERVERNAME','localhost');
    define('SERVERNAME','node213878-amm01.sp1.br.saveincloud.net.br:3306/');
    define('DBNAME','dbpetshop');
    define('DBUSER','ammphp');
    define('DBPWD','Carol@21102012');
} else if((!empty($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'localhost'))
{
    define('ROOT','http://localhost/ammpet/public');
    define('ROOTPATH_CLASSES', __DIR__ . DIRECTORY_SEPARATOR);
    define('SERVERNAME','localhost:3306/');
    define('DBNAME','dbpetshop');
    define('DBUSER','ammphp');
    define('DBPWD','Carol@21102012');
} else{
    define('ROOT','https://amm01.sp1.br.saveincloud.net.br/ammpet/public');
    define('ROOTPATH_CLASSES', __DIR__ . DIRECTORY_SEPARATOR);
    define('SERVERNAME','node213878-amm01.sp1.br.saveincloud.net.br:3306/');
    define('DBNAME','dbpetshop');
    define('DBUSER','ammphp');
    define('DBPWD','Carol@21102012');
}

define('DEBUG', true);
define('DS', DIRECTORY_SEPARATOR);
