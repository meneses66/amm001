<?php 

namespace Controller;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * {CLASSNAME} class
 */
class {CLASSNAME}
{
	use _GlobalController;

	public function index()
	{

		$this->view('{classname}' . DIRECTORY_SEPARATOR . '{classname}');
	}

}
