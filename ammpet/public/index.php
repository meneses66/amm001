<?php
	session_start();
	require '../classes/core/init.php';

	#echo "This is Index.php";

	$app = new App;
	$app->loadController();