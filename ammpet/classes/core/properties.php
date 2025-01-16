<?php

define('SERVERNAME','node213878-amm01.sp1.br.saveincloud.net.br:11334/');
define('DBNAME','dbpetshop');
define('DBUSER','ammphp');
define('DBPWD','Carol@21102012');

if($_SERVER['SERVER_NAME'] == 'localhost'){
    define('ROOT','http://localhost/ammpet/public');
} else{
    define('ROOT','https://amm01.sp1.br.saveincloud.net.br/ammpet/public');
}