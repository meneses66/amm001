<?php

namespace Core;

defined('ROOTPATH') OR exit('Access denied!');

class App{
    
    private $controller = 'Login';
    private $method = 'index';

    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'login';
        $URL = explode("/", trim($URL,"/"));
        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitURL();

        /** select controller according to URL */
        $ctrlRaw = $URL[0] ?? 'login';
        $ctrlSafe = preg_replace('/[^A-Za-z0-9_]/', '', $ctrlRaw);
        $fileName = "../classes/controllers/".ucfirst($ctrlSafe).".php";
        if(file_exists($fileName))
        {
            require $fileName;
            $this->controller = ucfirst($ctrlSafe);
            define('URL_0',$ctrlSafe);
            unset($URL[0]);

        } else{
            $fileName = "../classes/controllers/_404.php";
            require $fileName;
            $this->controller ='_404';
        }

        $controller = new ('\Controller\\'.$this->controller);

		/**select method according to URL */
        if(!empty($URL[1]))
        {
            $methodCandidate = preg_replace('/[^A-Za-z0-9_]/', '', $URL[1]);
            if(method_exists($controller, $methodCandidate))
            {
                $this->method = $methodCandidate;
                define('URL_1',$methodCandidate);
                unset($URL[1]);
            }
        } else {
            define('URL_1',"");
        }

		// Reindex URL arguments to avoid sparse numeric keys
		$args = array_values($URL);
		call_user_func_array([$controller,$this->method], $args);
	}
        
}
