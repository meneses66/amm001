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

            // Ensure controller file is loaded from controllers directory to avoid model namespace collisions
            $ctrlPath = removeFromEnd(ROOTPATH_CLASSES, 'core/') . 'controllers/' . $className . '.php';
            if (file_exists($ctrlPath)) {
                require_once $ctrlPath;
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

            // Log request metadata
            $sesUser = $_SESSION['username'] ?? 'none';
            $keys = implode(',', array_keys($_POST));
            amm_log(date('H:i:s') . " AJAX_IN class={$className} method={$method} session={$sesUser} keys=[{$keys}] csrf_present=" . (isset($_POST['csrf_token']) ? 'yes' : 'no'));

            $class = new ($fqcn);

            try {
                // Require CSRF token for mutating methods; validate if provided otherwise
                $mutatingMethods = [
                    'insert_call','update_call','delete_call',
                    'update_totals','update_payments','update_package',
                    'batch_confirm','update_comission','close_period',
                    'postpone_value_ajax'
                ];
                $token = $_POST['csrf_token'] ?? null;
                if (in_array($method, $mutatingMethods, true)) {
                    if ($token === null || !csrf_validate($token)) {
                        http_response_code(419);
                        echo 'Invalid CSRF token';
                        return;
                    }
                }

                if (!method_exists($class, $method)) {
                    http_response_code(404);
                    echo 'Method not found';
                    return;
                }

                $result = $class->$method($inputs);
            } catch (\Throwable $th) {
                amm_log(date('H:i:s') . " AJAX_ERR class={$className} method={$method} error=" . $th->getMessage());
                throw $th;
            }

            if (is_array($result)) {
                print_r($result);
                amm_log(date('H:i:s') . " AJAX_OUT class={$className} method={$method} type=array size=" . count($result));
            } elseif (is_string($result) && is_array(json_decode($result, true))) {
                print_r(json_decode($result, true));
                amm_log(date('H:i:s') . " AJAX_OUT class={$className} method={$method} type=json size=" . strlen($result));
            } else {
                echo $result;
                $len = is_string($result) ? strlen($result) : 0;
                amm_log(date('H:i:s') . " AJAX_OUT class={$className} method={$method} type=string size={$len}");
            }
        }
    }

}
