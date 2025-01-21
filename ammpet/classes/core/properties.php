<?php

if($_SERVER['SERVER_NAME'] == 'localhost'){
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