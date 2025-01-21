<?php
	session_start();
	require '../classes/core/init.php';

	#echo "This is Index.php";

	DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

	$app = new App;
	$app->loadController();