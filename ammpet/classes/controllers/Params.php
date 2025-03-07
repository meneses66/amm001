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
        $i=0;
        if($result){
            foreach ($result as $value) {
                $result_value[$i]=$value->VALUE;
                $i+=$i;
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
        $i=0;
        if($result){
            var_dump($result);
            foreach ($result as $value) {
                $result_value[$i]=$value->VALUE;
                $i+=$i;
            }
            var_dump($result_value);
            return $result_value;
        }
        else{
            return false;
        }
        
    }

}