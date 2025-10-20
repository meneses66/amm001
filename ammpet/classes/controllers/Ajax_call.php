<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Ajax_call {

    use _GlobalController;
    
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['class']) && isset($_POST['method'])) {
            // Sanitize class and method names
            $className = preg_replace('/[^A-Za-z0-9_]/', '', $_POST['class']);
            $method    = preg_replace('/[^A-Za-z0-9_]/', '', $_POST['method']);

            $inputs = [];
            foreach ($_POST as $key => $value) {
                $inputs[$key] = $value;
            }

            $fqcn = '\\Controller\\' . $className;
            if (!class_exists($fqcn)) {
                http_response_code(404);
                echo 'Not found';
                return;
            }
            // Disallow calling methods that begin with underscore
            if (strpos($method, '_') === 0) {
                http_response_code(400);
                echo 'Invalid method';
                return;
            }

            $class = new ($fqcn);

            try {
                // If a CSRF token is provided, validate it (gradual adoption)
                $token = $_POST['csrf_token'] ?? null;
                if ($token !== null && !\csrf_validate($token)) {
                    http_response_code(419);
                    echo 'Invalid CSRF token';
                    return;
                }

                if (!method_exists($class, $method)) {
                    http_response_code(404);
                    echo 'Method not found';
                    return;
                }

                $result = $class->$method($inputs);
            } catch (\Throwable $th) {
                throw $th;
            }
            
            if (is_array($result)) {
                print_r($result);
            } elseif (is_string($result) && is_array(json_decode($result, true))) {
                print_r(json_decode($result, true));
            } else {
                echo $result;
            }
        }
    }

}
