<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Params {

    use _GlobalController;

    public function index()
    {
        echo "This is Params controller";

        $this->view('params/params');
    }

    public function getParamValue($type, $name){
        $param = new \Model\Params;
        $inputs['TYPE']=$type;
        $inputs['NAME']=$name;
        $result = $param->getRow($inputs);
        foreach ($result as $key => $value) {
            $result_value['value']=$value;
        }
        return $result_value;
    }

    public function getParamListByType($type){
        $param = new \Model\Params;
        $inputs['TYPE']=$type;
        $result = $param->listWhere($inputs);
        foreach ($result as $key => $value) {
            $result_value['value']=$value;
        }
        return $result_value;
    }

}