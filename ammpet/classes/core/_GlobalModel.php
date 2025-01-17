<?php

class _GlobalModel{

    use _DAO;
    protected $table = 'SUPPLIER';
    
    #list
    public function list($inputs, $inputs_not=[]){
        $keys = array_keys($inputs);
        $keys_not = array_keys($inputs_not);
        $sql_stm = "select * from $this->table where ";
        
        foreach ($keys as $key){
            $sql_stm .= $key . "= :" . $key . " && ";
        }

        foreach ($keys_not as $key){
            $sql_stm .= $key . "!= :" . $key . " && ";
        }

        $sql_stm = trim($sql_stm," && ");

        $all_inputs =array_merge($inputs, $inputs_not);

        #return $this->query($sql_stm, $all_inputs);
        
        echo $sql_stm;

    }
    #getRow
    #insert
    #update
    #delete

}