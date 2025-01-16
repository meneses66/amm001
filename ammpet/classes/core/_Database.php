<?php

$string = "mysql:hostname=".HOSTNAME.";dbname=".DBNAME;
$con = new PDO($string, DBUSER, DBPWD);

show($con); 