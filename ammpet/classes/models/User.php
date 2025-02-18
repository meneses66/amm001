<?php

namespace Model;

//defined('ROOTPATH') OR exit('Access denied!');

class User{

    use _GlobalModel;
    private $username;
    protected $table = 'SUPPLIER';
    
    function User($username){
        $this->username = $username;
    }

    function get_username(){
        return $this->username;
    }

    function set_username($username){
        $this->username = $username;
    }

    public function check_user_pass($inputs){
        $keys = array_keys($inputs);
        $sql_stm = "select * from $this->table where ";
        
        foreach ($keys as $key){
            $sql_stm .= $key . "= :" . $key . " && ";
        }

        $sql_stm = trim($sql_stm," && ");

        $result = $this->query($sql_stm, $inputs);

        if ($result)
            return $result[0];

        return false;
    }

}