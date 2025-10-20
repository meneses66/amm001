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
        $fileName = "../classes/controllers/".ucfirst($URL[0]).".php";
        if(file_exists($fileName))
        {
            require $fileName;
            $this->controller = ucfirst($URL[0]);
            define('URL_0',$URL[0]);
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
			if(method_exists($controller, $URL[1]))
			{
				$this->method = $URL[1];
				define('URL_1',$URL[1]);
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
