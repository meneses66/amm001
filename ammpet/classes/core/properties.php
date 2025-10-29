<?php

defined('ROOTPATH') OR exit('Access denied!');

if ((empty($_SERVER['SERVER_NAME']) && php_sapi_name() == 'cli'))
{
    define('ROOT','https://amm01.sp1.br.saveincloud.net.br/ammpet/public');
    define('ROOTPATH_CLASSES', __DIR__ . DIRECTORY_SEPARATOR);
    // Database connection with environment overrides
    $envHost = getenv('DB_HOST') ?: 'node213878-amm01.sp1.br.saveincloud.net.br';
    $envPort = getenv('DB_PORT') ?: null;
} else if((!empty($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'localhost'))
{
    define('ROOT','http://localhost/ammpet/public');
    define('ROOTPATH_CLASSES', __DIR__ . DIRECTORY_SEPARATOR);
    $envHost = getenv('DB_HOST') ?: 'localhost';
    $envPort = getenv('DB_PORT') ?: null;
} else{
    define('ROOT','https://amm01.sp1.br.saveincloud.net.br/ammpet/public');
    define('ROOTPATH_CLASSES', __DIR__ . DIRECTORY_SEPARATOR);
    $envHost = getenv('DB_HOST') ?: 'node213878-amm01.sp1.br.saveincloud.net.br';
    $envPort = getenv('DB_PORT') ?: null;
}

// Normalize DB host/port: allow DB_HOST to be "host:port" or "host/"; prefer explicit DB_PORT when provided
$envHost = rtrim($envHost, '/');
// If DB_HOST contains a port like host:3306, extract it (IPv6 addresses are not expected here)
if (preg_match('/^(.+):(\d+)$/', $envHost, $m)) {
    $dbHost = $m[1];
    $dbPort = $m[2];
} else {
    $dbHost = $envHost;
    $dbPort = $envPort ?: '3306';
}

define('SERVERNAME', $dbHost); // legacy constant used in some parts
define('DB_PORT', $dbPort);
define('DBNAME', getenv('DB_NAME') ?: 'dbpetshop');
define('DBUSER', getenv('DB_USER') ?: 'ammphp');
define('DBPWD', getenv('DB_PASS') ?: 'Carol@21102012');

define('DEBUG', true);
define('DS', DIRECTORY_SEPARATOR);
