<?php
	session_start();
	require_once('../classes/core/config.php');
	require_once('../classes/core/App.php');

	#echo "This is Index.php";

	$app = new App;
	$app->loadController();