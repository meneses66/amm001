<?php

defined('ROOTPATH') OR exit('Access denied!');

/** if((empty($_SERVER['SERVER_NAME']) && php_sapi_name() == 'cli') || (!empty($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'localhost')) */
if((!empty($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'localhost'))
{
    define('ROOT','http://localhost/ammpet/public');
    define('SERVERNAME','localhost:3306/');
    define('DBNAME','dbpetshop');
    define('DBUSER','ammphp');
    define('DBPWD','Carol@21102012');
} else{
    define('ROOT','https://amm01.sp1.br.saveincloud.net.br/ammpet/public');
    define('SERVERNAME','node213878-amm01.sp1.br.saveincloud.net.br:3306/');
    define('DBNAME','dbpetshop');
    define('DBUSER','ammphp');
    define('DBPWD','Carol@21102012');
}

define('DEBUG', true);
define('DS', DIRECTORY_SEPARATOR);
