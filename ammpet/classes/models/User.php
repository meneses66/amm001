<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

class User{

    private $username;
    
    function User($username){
        $this->username = $username;
    }

    function get_username(){
        return $this->username;
    }

    function set_username($username){
        $this->username = $username;
    }

}