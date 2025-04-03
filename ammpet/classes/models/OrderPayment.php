<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

class OrderPayment {

    use _GlobalModel;
    protected $table = 'ORDER_PAYMENT';
    
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;

    public $Date;
    public $Id_Order;
    public $Paid_Amount;
    public $Payment_Type;
    public $Flag1;

    function __construct($id=null, $created_by=null, $updated_by=null, $created=null, $updated=null, $date=null, $id_order=null, $paid_amount=null, $payment_type=null, $flag1=null)
    {
        $this -> Id = $id;
        $this -> Created_By = $created_by;
        $this -> Updated_By = $updated_by;
        $this -> Created = $created;
        $this -> Updated = $updated;
        $this -> Date = $date;
        $this -> Id_Order = $id_order;
        $this -> Paid_Amount = $Paid_Amount;
        $this -> Payment_Type = $payment_type;
        $this -> Flag1 = $flag1;
    }

}