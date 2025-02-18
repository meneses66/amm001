<?php

namespace Controller;

//defined('ROOTPATH') OR exit('Access denied!');

class Login {

    use _GlobalController;
    
    public function index()
    {
        #echo "This is login controller";
        $this->view('login/login');
    }

    public function signin($username, $pwd)
    {
        //check if login is valid in DB
        if($this->authenticate($username, $pwd)){
            //start user session
            session_start();
            // create new instance of user
            $user = new \Model\User($username);
            // set username into global session
            $_SESSION['user']=$user;
            return true;
        } else {
            return false;
        }
    }

    static function authenticate($u, $p){
        $authentic=false;
        //check against DB:
        if($u=='qwe' && $p=='123'){
            $authentic=true;
        }
        return $authentic;
    }

    public function _login()
        {
            echo "This is login function from Login Controller";
            //$this->view('login/login2');
        }

    public function _logout(){
        session_start();
        session_destroy();
        $this->view('login/login');
    }

}