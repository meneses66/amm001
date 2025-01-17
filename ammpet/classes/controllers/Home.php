<?php

class Home extends _GlobalController {
    
    public function index()
    {
        echo "This is home controller";

        $array['ID']=1;
        #$array['NAME']='Joao Alves';
        #$array2['NAME']='Joao Cinto';
        #$all_arrays = array_merge($array, $array2);
        $model = new _GlobalModel;
        $result = $model->getRow($array);
        show($result);

        $this->view('home');
    }
}