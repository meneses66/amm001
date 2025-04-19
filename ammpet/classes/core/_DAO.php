<?php

namespace Model;
use \PDO;
use \PDOException;
use \PDOStatement;

defined('ROOTPATH') OR exit('Access denied!');

Trait _DAO{

  private function connect()
  {
    $servername = SERVERNAME;
    $dbname = DBNAME;
    $username = DBUSER;
    $password = DBPWD;
  
    $string = "mysql:host=$servername;dbname=$dbname";

    try {
      $conn = new PDO($string, $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;

    } catch(PDOException $e) {
      echo "Connection failed with: String= ".$string." +Err= ". $e->getMessage();
    }
  
  }
  
  public function query($sql_stm, $inputs=[])
  {

    $connect = $this->connect();
    
    $stm = $connect->prepare($sql_stm);
    $result = false;
    $check = $stm->execute($inputs);
    
    if($check)
    {
      if(str_contains($sql_stm, "insert")){
        $result = $connect->lastInsertId();
        $stm=null;
        $connect=null;
        return $result;
      } else {
          $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result)){
              amm_log(date("H:i:m")." -> IF: ".$sql_stm);        
              $stm=null;
              $connect=null;
              return $result;
            } else{
              amm_log(date("H:i:m")." -> ELSE: ".$sql_stm);
              $stm=null;
              $connect=null;
              return false;
            }
        }
    }
  }
}