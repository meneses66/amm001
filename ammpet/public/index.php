<?php
	session_start();
	require_once('../classes/core/config.php');

	$app = new App;
	$app->laodController();