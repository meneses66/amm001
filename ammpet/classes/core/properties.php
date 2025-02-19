<?php

defined('ROOTPATH') OR exit('Access denied!');

if((empty($_SERVER['SERVER_NAME']) && php_sapi_name() == 'cli'))
{
    define('ROOT','https://amm01.sp1.br.saveincloud.net.br/ammpet/public');
    define('ROOT_CLASSES','https://amm01.sp1.br.saveincloud.net.br/ammpet/classes');
    //define('SERVERNAME','localhost');
    define('SERVERNAME','node213878-amm01.sp1.br.saveincloud.net.br:3306/');
    define('DBNAME','dbpetshop');
    define('DBUSER','ammphp');
    define('DBPWD','Carol@21102012');
} else if((!empty($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'localhost'))
{
    define('ROOT','http://localhost/ammpet/public');
    define('ROOT_CLASSES','http://localhost/ammpet/classes');
    define('SERVERNAME','localhost:3306/');
    define('DBNAME','dbpetshop');
    define('DBUSER','ammphp');
    define('DBPWD','Carol@21102012');
} else{
    define('ROOT','https://amm01.sp1.br.saveincloud.net.br/ammpet/public');
    define('ROOT_CLASSES','https://amm01.sp1.br.saveincloud.net.br/ammpet/classes');
    define('SERVERNAME','node213878-amm01.sp1.br.saveincloud.net.br:3306/');
    define('DBNAME','dbpetshop');
    define('DBUSER','ammphp');
    define('DBPWD','Carol@21102012');
}

define('DEBUG', true);
define('DS', DIRECTORY_SEPARATOR);
