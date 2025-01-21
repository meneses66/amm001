<?php

Trait _GlobalModel{

    use _DAO;

    protected $order_type = 'desc';
    protected $order_column = 'ID';
    
    #list all
    public function listAll()
    {
        $sql_stm = "select * from $this->table order by $this->order_column $this->order_type";
        #return $sql_stm;
        return $this->query($sql_stm);

    }

    #list where
    public function listWhere($inputs, $inputs_not=[])
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

        $sql_stm .= " order by $this->order_column $this->order_type";

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
    public function update($ID, $inputs)
    {
        $inputs['ID']=$ID;
        $keys = array_keys($inputs);
        $sql_stm = "update $this->table set ";

        foreach ($keys as $key){
            $sql_stm .= $key . " = :" . $key . ", ";
        }
        $sql_stm = trim($sql_stm,", ");
        $sql_stm .= " where ID = :ID";
        #return $sql_stm;
        $this->query($sql_stm, $inputs);
        return false;
    }

    #delete
    public function delete($ID)
    {
        $sql_stm = "delete from $this->table where ID = $ID";
        $this->query($sql_stm);
        return false;
    }

}