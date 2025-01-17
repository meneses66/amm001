<?php

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

    return $stm;
    
    #$check = $stm->execute($inputs);

    #if($check)
    #{
    #  $result = $stm->fetchAll(PDO::FETCH_OBJ);
    #  if(isarray($result) && count($result)>0){
    #    return $result;
    #  }
    #}

    #return false;

  }
}