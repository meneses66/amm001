<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

Trait _GlobalModel{

    use _DAO;

    protected $order_type = ' desc';
    protected $order_column = 'ID';
    
    #count all
    public function countAll()
    {
        $sql_stm = "select count(1) AS COUNTW from $this->table";
        return $this->query($sql_stm);

    }

    public function countWhere($inputs, $inputs_not=[])
    {
        $keys = array_keys($inputs);
        $keys_not = array_keys($inputs_not);
        $sql_stm = "select count(1) AS COUNTW from $this->table where ";
        
        foreach ($keys as $key){
            $sql_stm .= $key . "= :" . $key . " && ";
        }

        foreach ($keys_not as $key){
            $sql_stm .= $key . "!= :" . $key . " && ";
        }

        $sql_stm = trim($sql_stm," && ");

        $all_inputs =array_merge($inputs, $inputs_not);

        $res = $this->query($sql_stm, $all_inputs);
        if (defined('DEBUG') && DEBUG) {
            $count = is_array($res) ? count($res) : 0;
            amm_log(date('H:i:s') . " LIST_WHERE table={$this->table} keys=" . implode(',', array_keys($all_inputs)) . " count={$count}");
        }
        return $res;

    }

    public function count_exec_sqlstm($sql_stm, $inputs)
    {
        return $this->query($sql_stm, $inputs);
    }

    public function count_exec_sqlstm_with_bind($sql_stm, $inputs)
    {
        return $this->query_with_bind($sql_stm, $inputs);
    }

    #list all
    public function listAll()
    {
        
        $sql_stm = "select * from $this->table order by $this->order_column $this->order_type";
        #return $sql_stm;
        return $this->query($sql_stm);

    }

    #Run a SQL Statement passed through function input:
    public function exec_sqlstm($sql_stm, $inputs=[])
    {
        return $this->query($sql_stm, $inputs);
    } 
    
    #Run a SQL Statement passed through function input:
    public function exec_sqlstm_query_with_bind($sql_stm, $inputs=[])
    {
        return $this->query_with_bind($sql_stm, $inputs);
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

    #list where
    
	public function listWhereOr($inputs)
    {
        $keys = array_keys($inputs);
        $sql_stm = "select * from $this->table where ";
        
        foreach ($keys as $key){
            $sql_stm .= $key . "= :" . $key . " OR ";
        }

        $sql_stm = trim($sql_stm," OR ");

        $sql_stm .= " order by $this->order_column $this->order_type";

        // Only inputs provided are required for binding
        return $this->query($sql_stm, $inputs);

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

    #getRow by Id
    public function getRowbyId($id)
    {
        $sql_stm = "select * from $this->table where ID = :ID";

        $result = $this->query($sql_stm, ['ID' => $id]);

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
        $result = $this->query($sql_stm, $inputs);
        return $result;
        //return false;
    }

    #update
    public function update($ID, $inputs)
    {
        $inputs['ID']=$ID;
        $keys = array_keys($inputs);
        $sql_stm = "update $this->table set ";

        foreach ($keys as $key){
            $sql_stm .= $key."=:".$key.", ";
        }
        $sql_stm = trim($sql_stm,", ");
        $sql_stm .= " where ID=:ID";
        $this->query($sql_stm, $inputs);
        return false;
    }

    #delete
    public function delete($ID)
    {
        $inputs['ID']=$ID;
        $sql_stm = "delete from $this->table where ID = :ID";
        $this->query($sql_stm, $inputs);
        return false;
    }

    #new functions copied from source video 3
    public function getError($key)
	{
		if(!empty($this->errors[$key]))
			return $this->errors[$key];

		return "";
	}

	protected function getPrimaryKey(){

		return $this->primaryKey ?? 'Id';
	}

	public function validate($data)
	{

		$this->errors = [];

		if(!empty($this->primaryKey) && !empty($data[$this->primaryKey]))
		{
			$validationRules = $this->onUpdateValidationRules;
		}else{

			$validationRules = $this->onInsertValidationRules;
		}

		if(!empty($validationRules))
		{
			foreach ($validationRules as $column => $rules) {
				
				if(!isset($data[$column]))
					continue;

				foreach ($rules as $rule) {
				
					switch ($rule) {
						case 'required':

							if(empty($data[$column]))
								$this->errors[$column] = ucfirst($column) . " is required";
							break;
						case 'email':

							if(!filter_var(trim($data[$column]),FILTER_VALIDATE_EMAIL))
								$this->errors[$column] = "Invalid email address";
							break;
						case 'alpha':

							if(!preg_match("/^[a-zA-Z]+$/", trim($data[$column])))
								$this->errors[$column] = ucfirst($column) . " should only have aphabetical letters without spaces";
							break;
						case 'alpha_space':

							if(!preg_match("/^[a-zA-Z ]+$/", trim($data[$column])))
								$this->errors[$column] = ucfirst($column) . " should only have aphabetical letters & spaces";
							break;
						case 'alpha_numeric':

							if(!preg_match("/^[a-zA-Z0-9]+$/", trim($data[$column])))
								$this->errors[$column] = ucfirst($column) . " should only have aphabetical letters & spaces";
							break;
						case 'alpha_numeric_symbol':

							if(!preg_match("/^[a-zA-Z0-9\-\_\$\%\*\[\]\(\)\& ]+$/", trim($data[$column])))
								$this->errors[$column] = ucfirst($column) . " should only have aphabetical letters & spaces";
							break;
						case 'alpha_symbol':

							if(!preg_match("/^[a-zA-Z\-\_\$\%\*\[\]\(\)\& ]+$/", trim($data[$column])))
								$this->errors[$column] = ucfirst($column) . " should only have aphabetical letters & spaces";
							break;
						
						case 'not_less_than_8_chars':

							if(strlen(trim($data[$column])) < 8)
								$this->errors[$column] = ucfirst($column) . " should not be less than 8 characters";
							break;
						
						case 'unique':

							$key = $this->getPrimaryKey();
							if(!empty($data[$key]))
							{
								//edit mode
								if($this->first([$column=>$data[$column]],[$key=>$data[$key]])){
									$this->errors[$column] = ucfirst($column) . " should be unique";
								}
							}else{
								//insert mode
								if($this->first([$column=>$data[$column]])){
									$this->errors[$column] = ucfirst($column) . " should be unique";
								}
							}
							break;
						
						default:
							$this->errors['rules'] = "The rule ". $rule . " was not found!";
							break;
					}
				}
			}
		}

		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

    public function getRowProperty($input, $property, $table){
        $sql_stm = "select $property from $table where ID = :ID";
        
        $sql_stm = trim($sql_stm," && ");

        $result = $this->query($sql_stm, $input);

        if ($result)
            return $result[0];

        return false;       
    }

}
