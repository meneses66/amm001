<?php
	session_start();
	require_once('../classes/core/config.php');

	echo "This is Index.php";

	function show($anything){
		echo "<pre>";
		print_r($anything);
		echo "</pre>";
	}
	
	show($_GET);

	$app = new App;
	$app->loadController();