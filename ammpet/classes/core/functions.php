<?php

defined('ROOTPATH') OR exit('Access denied!');

/** Return URL variables */
function URL($key):mixed
{
	$URL = $_GET['url'] ?? 'home';
	$URL = explode("/", trim($URL,"/"));
	
	switch ($key) {
		case 'page':
		case 0:
			return $URL[0] ?? null;
			break;
		case 'section':
		case 'slug':
		case 1:
			return $URL[1] ?? null;
			break;
		case 'action':
		case 2:
			return $URL[2] ?? null;
			break;
		case 'id':
		case 3:
			return $URL[3] ?? null;
			break;
		default:
			return null;
			break;
	}

}

/** Show anthing you want */
function show($anything){
    echo "<pre>";
    print_r($anything);
    echo "</pre>";
}

function esc($str){
    return htmlspecialchars($str);
}

function redirect($path){
    header("Location: " . ROOT."/".$path);
    die;
}

/** Displays message to the user */
function message(string $msg=null, bool $clear=false){
    $ses = new Core\Session();
    if(!empty($msg))
    {
        $ses->set('message', $msg);
    } else if(!empty($ses->get('message')))
            {
            
                $msg = $ses->get('message');
            
                if($clear)
                {
                
                    $ses->pop('message');
                }
                return $msg;
            }
            return false;
    
}

function fsplitURL()
{
	$URL = $_GET['url'] ?? 'login';
	$URL = explode("/", trim($URL,"/"));
	return $URL;
}

function floadController()
{
	$URL = $this->fsplitURL();

	/** select controller according to URL */
	$fileName = "../classes/controllers/".ucfirst($URL[0]).".php";
	if(file_exists($fileName))
	{
		require $fileName;
		$this->controller = ucfirst($URL[0]);
		unset($URL[0]);

	} else{
		$fileName = "../classes/controllers/_404.php";
		require $fileName;
		$this->controller ='_404';
	}

	$controller = new ('\Controller\\'.$this->controller);

	/**select method according to URL */
	if(!empty($URL[1]))
	{
		if(method_exists($controller, $URL[1]))
		{
			$this->method = $URL[1];
			unset($URL[1]);
		}
	}

	call_user_func_array([$controller,$this->method],$URL);
}