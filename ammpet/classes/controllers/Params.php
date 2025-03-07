<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access denied!');

class Params {

    use _GlobalController;

    public function index()
    {
        //echo "This is Params controller";

        //$this->view('params/params');
    }

    public function getParamValue($type, $name, $status){
        $param = new \Model\Params;
        $inputs['TYPE']=$type;
        $inputs['NAME']=$name;
        $inputs['STATUS']=$status;
        $result = $param->getRow($inputs);
        if($result){
            foreach ($result as $key => $value) {
                $result_value[$value]=$value;
            }
            return $result_value;
        }
        else{
            return false;
        }
        
    }

    public function getParamListByType($type, $status){
        $param = new \Model\Params;
        $inputs['TYPE']=$type;
        $inputs['STATUS']=$status;
        $result = $param->listWhere($inputs);
        if($result){
            foreach ($result as $key => $value) {
                $result_value["$value"]=$value;
            }
            return $result_value;
        }
        else{
            return false;
        }
        
    }

}