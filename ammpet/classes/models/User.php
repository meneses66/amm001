<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

class User extends Supplier {

    //use _GlobalModel;
    private $username;
    private $permissions;
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

    function get_permissions(){
        return $this->permmsions;
    }

    function set_permissions($permissions){
        $this->permissions = $permissions;
    }

}