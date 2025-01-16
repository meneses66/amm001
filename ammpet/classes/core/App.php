<?php

class App{
    
    private $controller = 'Home';
    private $method = 'index';
    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", $URL);
        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitURL();
        $fileName = "../classes/controllers/".ucfirst($URL[0]).".php";
        if(file_exists($fileName))
        {
            require $fileName;
            $this->controller = ucfirst($URL[0]);

        } else{
            $fileName = "../classes/controllers/_404.php";
            require $fileName;
            $this->controller ='_404';
        }

        $controller = new $this->controller;
        call_user_func_array([$controller,$this->method],[]);
    }
        
}
