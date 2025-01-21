<?php

class _GlobalModel{

    use _DAO;
    protected $table = 'SUPPLIER';
    
    #list
    public function list($inputs, $inputs_not=[])
    {
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

        return $this->query($sql_stm, $all_inputs);

    }

    #getRow
    public function getRow($inputs)
    {
        $keys = array_keys($inputs);
        $sql_stm = "select * from $this->table where ";
        
        foreach ($keys as $key){
            $sql_stm .= $key . "= :" . $key . " && ";
        }

        $sql_stm = trim($sql_stm," && ");

        $result = $this->query($sql_stm, $inputs);

        if ($result)
            return $result[0];

        return false;

    }

    #insert
    public function insert($inputs)
    {
        $keys = array_keys($inputs);
        $columns = implode(',',$keys);
        $values = implode(',:',$keys);
        $sql_stm = "insert into $this->table (".$columns.") values (:".$values.")";
        $this->query($sql_stm, $inputs);
        return false;
    }


    #update
    #delete

}