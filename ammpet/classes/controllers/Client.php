<?php 

namespace Controller;

//defined('ROOTPATH') OR exit('Access Denied!');

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
