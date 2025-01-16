<?php

class App{
    
    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", $URL);
        return $URL;
    }

    public function loadController()
    {
        $URL = this->splitURL();
        $fileName = "../classes/controllers/".ucfirst($URL[0]).".php";
        if(file_exists($fileName))
        {
            #require $fileName;
            echo "File Name is: ".$fileName;

        } else{
            $fileName = "../classes/controllers/_404.php";
            #require $fileName;
            echo "File Name is: ".$fileName;
        }
    }
        
}
