<?php 

namespace Controller;
if(session_status() === PHP_SESSION_NONE) session_start();

//defined('ROOTPATH') OR exit('Access denied!');
(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

/**
 * Client class
 */
class Client
{
	use _GlobalController;

	public function index()
	{

		$this->view('client');
	}

}
