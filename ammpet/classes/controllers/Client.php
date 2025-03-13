<?php 

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

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
