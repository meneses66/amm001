<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

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
            $_SESSION['username']=$username;
            return true;
        } else {
            return false;
        }
    }

    public function authenticate($u, $p){
        $authentic=false;
        
        //Define Inputs for function:
        $array['LOGIN']=$u;
        $array['PASS']=$p;
        
        //check against DB:
        $model = new \Model\User;

        $verify = $model->getRow($array);
        if($verify){
            $authentic=true;
        }
        return $authentic;
    }

    public function _login()
        {
            //move to Home Controller:
            header("Location:Home");
        }

    public function _logout(){
        session_start();
        session_unset();
        session_destroy();
        $this->view('login/login');
    }

}