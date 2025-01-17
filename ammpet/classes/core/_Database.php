<?php

$servername = SERVERNAME;
$dbname = DBNAME;
$username = DBUSER;
$password = DBPWD;

$string = "mysql:host=$servername;dbname=$dbname";
try {
  $conn = new PDO($string, $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed with: String= ".$string." +Err= ". $e->getMessage();
}