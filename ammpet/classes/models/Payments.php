<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

class Payments {

    use _GlobalModel;
    protected $table = 'PAYMENTS';
    
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;

    public $Payment_Type;
    public $Payment_Date;
    public $Payment_Description;
    public $Payment_Value;
    public $Payment_Output;
    public $Payment_Supplier;
    public $Payment_Category;
    public $Payment_Flag_Provision;
    public $Payment_Method;


    function __construct($id=null, $created_by=null, $updated_by=null, $created=null, $updated=null, $payment_type=null, $payment_date=null, $payment_description=null, $payment_value=null, $payment_output=null, $payment_supplier=null, $payment_category=null, $payment_flag_provision=null, $payment_method=null)
    {
        $this -> Id = $id;
        $this -> Created_By = $created_by;
        $this -> Updated_By = $updated_by;
        $this -> Created = $created;
        $this -> Updated = $updated;

        $this -> Payment_Type = $payment_type;
        $this -> Payment_Date = $payment_date;
        $this -> Payment_Description = $payment_description;
        $this -> Payment_Value = $payment_value;
        $this -> Payment_Output = $payment_output;
        $this -> Payment_Supplier = $payment_supplier;
        $this -> Payment_Category = $payment_category;
        $this -> Payment_Flag_Provision = $payment_flag_provision;
        $this -> Payment_Method = $payment_method;

    }

}