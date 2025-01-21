<?php

class Home extends _GlobalController {
    
    public function index()
    {
        echo "This is home controller";

        #$array['ID']=1;
        $array['NAME']='Fernando Silva';
        $array['CREATED_BY']='AMM';
        $array['UPDATED_BY']='AMM';
        $array['LOGIN']='FSILVA';
        $array['PASS']='G123456';
        $array['STATUS']='Ativo';
        $array['TYPE']='Funcionario';
        $array['ROLE']='Atendente';
        $array['SEQUENCE']=3;
        $array['HIRE_DATE']='2025-01-17';
        $model = new _GlobalModel;
        $result = $model->delete(3);
        show($result);

        $this->view('home');
    }
}