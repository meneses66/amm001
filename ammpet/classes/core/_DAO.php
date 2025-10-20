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

    // Normalize host (remove any trailing slash) and add charset
    $host = rtrim($servername, '/');
    $string = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";

    try {
      $conn = new PDO($string, $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;

    } catch(PDOException $e) {
      // Avoid echoing sensitive connection details; log instead if needed
      echo "Database connection failed.";
    }
  
  }
  
  public function query($sql_stm, $inputs=[])
  {

    $connect = $this->connect();
    
    $stm = $connect->prepare($sql_stm);
    $result = false;
    //amm_log(date("H:i:m")." SQL -> ".$sql_stm);
    //amm_log(date("H:i:m")." INPUTS -> ".var_dump($inputs));
    $check = $stm->execute($inputs);
    if($check)
    {
      if(str_contains($sql_stm, "insert")){
        $result = $connect->lastInsertId();
        $stm=null;
        // Close PDO connection
        $connect = null;
        return $result;
      } else {
          $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result)){
              //amm_log(date("H:i:m")." -> IF: ".$sql_stm);        
              $stm=null;
              $connect=null;
              return $result;
            } else{
              //amm_log(date("H:i:m")." -> ELSE: ".$sql_stm);
              $stm=null;
              $connect=null;
              return false;
            }
        }
    }
  }

  public function query_with_bind($sql_stm, $inputs=[])
  {

    $connect = $this->connect();
    
    $stm = $connect->prepare($sql_stm);
    $result = false;
    //$keys = array_keys($inputs);
    foreach ($inputs as $key => $value) {
      if ($key == "ID") {
        //amm_log(date("H:i:m")." -> BIND ID: ".$value);
        $stm->bindValue(':ID',$value,PDO::PARAM_INT);
      } else{
        //amm_log(date("H:i:m")." -> BIND ".$key.": ".$value);
        $stm->bindValue(':'.$key,$value,PDO::PARAM_STR);
      }
    }
    //amm_log(date("H:i:m")." -> SQL: ".$sql_stm);
    $check = $stm->execute();
    if($check)
    {
      //amm_log(date("H:i:m")." -> IF CHECK: OK ".$sql_stm);
      if(str_contains($sql_stm, "insert")){
        //amm_log(date("H:i:m")." -> IF INSERT: OK ".$sql_stm);
        $result = $connect->lastInsertId();
        $stm=null;
        // Close PDO connection
        $connect = null;
        return $result;
      } else {
        //amm_log(date("H:i:m")." -> ELSE INSERT: OK ".$sql_stm);
          $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result)){
              //amm_log(date("H:i:m")." -> IF IS_ARRAY: OK ".$sql_stm);
              $stm=null;
              $connect=null;
              return $result;
            } else{
              //amm_log(date("H:i:m")." -> ELSE IS_ARRAY: OK ".$sql_stm);
              $stm=null;
              $connect=null;
              return false;
            }
        }
    }
  }

}
