<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

class Orderx {

    use _GlobalModel;
    protected $table = 'ORDER_X';
    
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;

    public $Order_Date;
    public $Id_Client;
    public $Order_value_no_discount;
    public $Order_value_with_discount;
    public $Order_paid_amount;
    public $Order_debt;
    public $Order_value_cash;
    public $Order_value_pix;
    public $Order_old_id;

    function __construct($id=null, $created_by=null, $updated_by=null, $created=null, $updated=null, $order_date=null, $id_client=null, $order_value_no_discount=null, $order_value_with_discount=null, $order_paid_amount=null, $order_debt=null, $order_value_cash=null, $order_value_pix=null, $order_old_id=null)
    {
        $this -> Id = $id;
        $this -> Created_By = $created_by;
        $this -> Updated_By = $updated_by;
        $this -> Created = $created;
        $this -> Updated = $updated;
        $this -> Order_Date = $order_date;
        $this -> Id_Client = $id_client;
        $this -> Order_value_no_discount = $order_value_no_discount;
        $this -> Order_value_with_discount = $order_value_with_discount;
        $this -> Order_paid_amount = $order_paid_amount;
        $this -> Order_debt = $order_debt;
        $this -> Order_value_cash = $order_value_cash;
        $this -> Order_value_pix = $order_value_pix;
        $this -> Order_old_id = $order_old_id;

    }

}