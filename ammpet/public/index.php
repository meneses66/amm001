<?php
	#session_start();

	/** Check for valid PHP version */
	$minPHPVersion = '8.0';
	if(phpversion() < $minPHPVersion)
	{
		die("Your PHP version must be {$minPHPVersion} or higher to run this app. Your current PHP vresion is ". phpversion());
	}

	/** Path to this file */
	define('ROOTPATH', __DIR__ . DIRECTORY_SEPARATOR);
	require '../classes/core/init.php';

	echo "This is Index.php";
	echo ROOTPATH;

	DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

	$app = new \Core\App;
	$app->loadController();