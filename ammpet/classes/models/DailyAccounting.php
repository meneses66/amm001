<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

class DailyAccounting {

    use _GlobalModel;
    protected $table = 'DAILY_ACCOUNTING';
    
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;

    public $Date;
    public $Initial_Value;
    public $Received_Cash;
    public $Withdraw;
    public $Final_Value_Calc;
    public $Final_Value_Confirm;
    public $Addition;
    public $Difference;
    public $Baths;
    public $Total_Invoiced;
    public $Comment;



    function __construct($id=null, $created_by=null, $updated_by=null, $created=null, $updated=null, $date=null, $initial_value=null, $received_cash=null, $withdraw=null, $final_value_calc=null, $final_value_confirm=null, $addition=null, $difference=null, $baths=null, $total_invoiced=null, $comment=null)
    {
        $this -> Id = $id;
        $this -> Created_By = $created_by;
        $this -> Updated_By = $updated_by;
        $this -> Created = $created;
        $this -> Updated = $updated;

        $this -> Date = $date;
        $this -> Initial_Value = $initial_value;
        $this -> Received_Cash = $received_cash;
        $this -> Withdraw = $withdraw;
        $this -> Final_Value_Calc = $final_value_calc;
        $this -> Final_Value_Confirm = $final_value_confirm;
        $this -> Addition = $addition;
        $this -> Difference = $difference;
        $this -> Baths = $baths;
        $this -> Total_Invoiced = $total_invoiced;
        $this -> Comment = $comment;

    }

}