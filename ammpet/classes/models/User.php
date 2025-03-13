<?php

namespace Model;

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class User extends Supplier {

    //use _GlobalModel;
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

}