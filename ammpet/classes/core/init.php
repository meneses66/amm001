<?php

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

require 'functions.php';
require 'properties.php';
//require 'ajax_call.php';
require '_DAO.php';
require '_GlobalModel.php';
require '_GlobalController.php';
require 'config.php';
require 'App.php';