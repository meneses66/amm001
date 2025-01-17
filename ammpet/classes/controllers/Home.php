<?php

class Home extends _GlobalController {
    
    public function index()
    {
        echo "This is home controller";

        #$array[ID]='1';
        #$array2[NAME]='Joao';
        #$all_arrays = array_merge($array, $array2);
        #show($all_arrays);
        #$model = new _GlobalModel;
        #$result = $model->list($array,$array2);
        #show($result);

        $this->view('home');
    }
}