<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

class Salary {

    use _GlobalModel;
    protected $table = 'SALARY';
    
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;

    public $Id_Employee;
    public $Ref_Date;
    public $Salary_Item_Type;
    public $Salary_Item_Value;
    public $Original_Value;
    public $Postponed_Value;
    public $Salary_Item_Status;
    public $Salary_Item_Description;
    

    function __construct($id=null, $created_by=null, $updated_by=null, $created=null, $updated=null, $id_employee=null, $ref_date=null, $salary_item_type=null, $salary_item_value=null, $original_value=null, $postponed_value=null, $salary_item_status=null, $salary_item_description=null)
    {
        $this -> Id = $id;
        $this -> Created_By = $created_by;
        $this -> Updated_By = $updated_by;
        $this -> Created = $created;
        $this -> Updated = $updated;
        
        $this -> Id_Employee = $id_employee;
        $this -> Ref_Date = $ref_date;
        $this -> Salary_Item_Type = $salary_item_type;
        $this -> Salary_Item_Value = $salary_item_value;
        $this -> Original_Value = $original_value;
        $this -> Postponed_Value = $postponed_value;
        $this -> Salary_Item_Status = $salary_item_status;
        $this -> Salary_Item_Description = $salary_item_description;

    }

}