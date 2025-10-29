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

        // Build fully-qualified class name and rely on the autoloader to load it.
        $candidateFQCN = '\\Controller\\' . ucfirst($ctrlSafe);
        if (class_exists($candidateFQCN)) {
            $this->controller = ucfirst($ctrlSafe);
            define('URL_0', $ctrlSafe);
            unset($URL[0]);
            $controllerFQCN = $candidateFQCN;
        } else {
            // fallback to 404 controller
            $this->controller = '_404';
            $controllerFQCN = '\\Controller\\_404';
        }

        // Instantiate controller via helper (helper calls new $fqcn())
        $controller = instantiate($controllerFQCN);

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
