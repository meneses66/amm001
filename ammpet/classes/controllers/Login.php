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
            my_session_start();
            my_session_regenerate_id();
            ini_set('session.use_strict_mode', 1);
            // create new instance of user
            $user = new \Model\User($username);
            // set username into global session
            $_SESSION['user']=$user;
            $_SESSION['username']=$username;

            $_SESSION['LAST_ACTIVE']=time();
            return true;
        } else {
            return false;
        }
    }

    public function authenticate($u, $p){
        $authentic=false;
        
        //Define Inputs for function:
        $array['LOGIN']=$u;
        //$array['PASS']=$p;
        
        //check against DB:
        $model = new \Model\User;

        $data = $model->getRow($array);
        if($data){
            
            foreach ($data as $key => $value) {
                $data_form[$key]=$value;
            }

            if(password_verify($p,$data_form['PASS']))
            {
                //$_SESSION['permissions']=json_decode($data_form['PERMISSIONS']);
                $authentic=true;
                
            }
            
        }
        $data = null;
        $model = null;
        return $authentic;
    }

    public function _login()
        {
            //move to Home Controller:
            header("Location:Home");
        }

    public function _logout(){
        my_session_regenerate_id();
        session_unset();
        session_destroy();
        ini_set('session.use_strict_mode', 1);
        redirect("Login");
        //$this->view('login/login');
    }

}