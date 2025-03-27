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

/** Remove string from end of other string*/
function removeFromEnd($string, $stringToRemove) {
    $stringToRemoveLen = strlen($stringToRemove);
    $stringLen = strlen($string);
    
    $pos = $stringLen - $stringToRemoveLen;

    $out = substr($string, 0, $pos);

    return $out;
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

function double_redirect($path1, $path2){
    header("Location: " . ROOT."/".$path1);
    header("Location: " . ROOT."/".$path2);
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

// My session start function support timestamp management
function my_session_start() {
    session_start();
    // Do not allow to use too old session ID
    if (!empty($_SESSION['deleted_time']) && $_SESSION['deleted_time'] < time() - 180) {
        session_unset();
		session_destroy();
        session_start();
    }
}

// My session regenerate id function
function my_session_regenerate_id() {
    // Call session_create_id() while session is active to 
    // make sure collision free.
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    // WARNING: Never use confidential strings for prefix!
    $newid = session_create_id('amm_fpet-');
    // Set deleted timestamp. Session data must not be deleted immediately for reasons.
    $_SESSION['deleted_time'] = time();
    // Finish session
    session_commit();
    // Make sure to accept user defined session ID
    // NOTE: You must enable use_strict_mode for normal operations.
    ini_set('session.use_strict_mode', 0);
    // Set new custom session ID
    session_id($newid);
    // Start with custom session ID
    session_start();
}

function debug_to_console( $data ) {
	$output = '<script>';

	// new and smaller version, easier to maintain
	$output .= 'console.info( \'Debug in Console via Debug Objects Plugin:\' );';
	$output .= 'console.log(' . json_encode( $data ) . ');';

    $output .= '</script>';

	echo $output;
}

function load_options_new ($type, $status){
        
    require_once removeFromEnd(ROOTPATH_CLASSES,"core/").'controllers/Params.php';

    //GET LIST OF TYPES FROM PARAMS TABLE
    $params = new ('\Controller\\'."Params");
    $option_list = "";
    $options = $params->getParamListByType($type, $status);
    if($options){
        foreach ($options as $option) { 
            $option_list .= '<option class="medium-label" value="'.$option->VALUE.'">'.$option->VALUE.'</option>';
        }
    }
    return $option_list;
}

function load_options_update ($type, $status, $data_form_type){
        
    require_once removeFromEnd(ROOTPATH_CLASSES,"core/").'controllers/Params.php';

    //GET LIST OF TYPES FROM PARAMS TABLE
    $params = new ('\Controller\\'."Params");
    $option_list = "";
    $data_form_type_local=$data_form_type;
    $options = $params->getParamListByType($type, $status);
    if($options){
        foreach ($options as $option) { 
            $selected= $data_form_type == $option->VALUE ? "selected":"";
            $option_list .= '<option class="medium-label" value="'.$option->VALUE.'" '.$selected.'>'.$option->VALUE.'</option>';
        }
    }
    return $option_list;
}

function return_param_value ($type, $name, $status){
        
    require_once removeFromEnd(ROOTPATH_CLASSES,"core/").'controllers/Params.php';

    //GET LIST OF TYPES FROM PARAMS TABLE
    $params = new ('\Controller\\'."Params");
    $param_value = "";
    $result = $params->getParamValue($type, $name, $status);
    if($result){
        $param_value .=$result->VALUE;
    }
    return $param_value;
}

function json_decode2($valor){
    $json = json_decode($valor);
    
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            return $json;
        case JSON_ERROR_DEPTH:
            return 'A profundidade máxima da pilha foi excedida';
        case JSON_ERROR_STATE_MISMATCH:
            return 'JSON inválido ou mal formado';
        case JSON_ERROR_CTRL_CHAR:
            return 'Erro de caractere de controle, possivelmente codificado incorretamente';
        case JSON_ERROR_SYNTAX:
            return 'Erro de sintaxe';
        case JSON_ERROR_UTF8:  // O seu caso!
            $json = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($valor));
            return json_encode($json);
        default:
            return 'Erro desconhecido';
        }   
    }

    function cleanString($val)
    {
        $non_displayables = array(
        '/%0[0-8bcef]/',            # url encoded 00-08, 11, 12, 14, 15
        '/%1[0-9a-f]/',             # url encoded 16-31
        '/[\x00-\x08]/',            # 00-08
        '/\x0b/',                   # 11
        '/\x0c/',                   # 12
        '/[\x0e-\x1f]/',            # 14-31
        '/x7F/'                     # 127
        );
        foreach ($non_displayables as $regex)
        {
            $val = preg_replace($regex,'',$val);
        }
        $search  = array("\0","\r","\x1a","\t");
        return trim(str_replace($search,'',$val));
    }
