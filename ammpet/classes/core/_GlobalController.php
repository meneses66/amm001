<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

Trait _GlobalController{

    public function view($name)
    {
        $fileName = "../classes/views/".$name.".view.php";
        if(file_exists($fileName))
        {
            require $fileName;

        } else{
            $fileName = "../classes/views/_404.view.php";
            require $fileName;
        }
    }

    public function view_id($name)
    {
        
        $fileName = "../classes/views/".$name.".view.php";
        if(file_exists($fileName))
        {
            require $fileName;

        } else{
            $fileName = "../classes/views/_404.view.php";
            require $fileName;
        }
    }


    // FUNCTIONS MOVED FROM PARAMS TO BE STANDARDIZED

    //SESSION TO DEFINE TO WHICH PAGE USER WILL BE SENT: NEW, UPDATE, DELETE, LIST

    //Sends to page to create NEW Params
    public function _new(){

        $operation = 'goto_new';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $operation = $_POST['operation'];
        }
        $this->goto_view($operation);
    }

    //Sends to LIST View
    public function _list(){
        $operation = 'goto_list';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $operation = $_POST['operation'];
        }
        $this->goto_view($operation);
    }

    //Sends to UPDATE View
    public function _update(){

        $operation = 'goto_update';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $operation = $_POST['operation'];
        }
        $this->goto_view($operation);
    }

    //Sends to DELETE View
    public function _delete(){

        $operation = 'goto_delete';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $operation = $_POST['operation'];
        }
        $this->goto_view($operation);
    }

    //Defines view to go to
    private function goto_view($operation){
    
        switch($operation)
        {
            case 'goto_new':
                $view="$this->object/$this->object-new";
                $this->view($view);
            break;

            case 'goto_list':
                $view="$this->object/$this->object-list";
                $this->view($view);
            break;

            case 'goto_update':
                $view="$this->object/$this->object-update";
                $this->view($view);
            break;

            case 'goto_delete':
                $view="$this->object/$this->object-delete";
                $this->view($view);
            break;
        }
    }

}


    