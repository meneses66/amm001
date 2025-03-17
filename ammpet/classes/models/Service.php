<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

class Service {
    
    use _GlobalModel;
    protected $table = 'PROD_SERV';

    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;

    public $Code;
    public $Name;
    public $Group_x;
    public $Type;
    public $Category;
    //public $Sequence;
    public $Supplier;
    public $Status;
    public $Package_amount;
    public $Price;
    public $Flag1;
    public $Comission_flg;
    public $Center;
    public $External_cost;
    public $Comission_percentage;
    public $Package_price;
    public $Price_cash;
    public $Price_pix;
    public $Old_id;
    public $Comission_overwrite_flg;


    function __construct($id=null, $created_by=null, $updated_by=null, $created=null, $updated=null, $code=null, $name=null, $group_x=null, $type=null, $category=null, $supplier=null, $status=null, $package_amount=null, $price=null, $flag1=null, $comission_flg=null, $center=null, $external_cost=null, $comission_percentage=null, $package_price=null, $price_cash=null, $price_pix=null, $old_id=null, $comission_overwrite_flg=null){
        $this->Id = $id;
        $this->Created_By = $created_by;
        $this->Updated_By = $updated_by;
        $this->Created = $created;
        $this->Updated = $updated;

        $this->Code = $code;
        $this->Name = $name;
        $this->Group_x = $group_x;
        $this->Type = $type;
        $this->Category = $category;
        //$this->Sequence = $sequence;
        $this->Supplier = $supplier;
        $this->Status = $status;
        $this->Package_amount = $package_amount;
        $this->Price = $price;
        $this->Flag1 = $flag1;
        $this->Comission_flg = $comission_flg;
        $this->Center = $center;
        $this->External_cost = $external_cost;
        $this->Comission_percentage = $comission_percentage;
        $this->Package_price = $package_price;
        $this->Price_cash = $price_cash;
        $this->Price_pix = $price_pix;
        $this->Old_id = $old_id;
        $this->Comission_overwrite_flg = $comission_overwrite_flg;

    }

}