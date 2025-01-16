<?php
	session_start();
	require_once('../classes/core/config.php');

	#echo "This is Index.php";

	#$app = new App;
	#$app->loadController();

	function show($anything){
		echo "<pre>";
		print_r($anything);
		echo "</pre>";
	}

	function splitURL()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", $URL);
        return $URL;
    }

    function loadController()
    {
        $URL = this->splitURL();
        $fileName = "../classes/controllers/".ucfirst($URL[0]).".php";
        if(file_exists($fileName))
        {
            require $fileName;
            #print_r ($fileName);

        } else{
            $fileName = "../classes/controllers/_404.php";
            require $fileName;
            #print_r ($fileName);
        }
    }

	#show(splitURL());
	loadController();