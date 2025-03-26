<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

class Package {

    use _GlobalModel;
    protected $table = 'CLIENT_PACKAGE';
    
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;
    
    public $Id_Animal;
    public $Id_Client;
    public $Id_Order;
    public $Id_Order_Item;
    public $Id_Prod_Serv;
    public $Pack_Consumed;
    public $Pack_Date;
    public $Pack_Name;
    public $Pack_Quantity;
    public $Pack_Status;

    function __construct($id=null, $created_by=null, $updated_by=null, $created=null, $updated=null, $id_animal=null, $id_client=null, $id_order=null, $id_order_item=null, $id_prod_serv=null, $pack_consumed=null, $pack_date=null, $pack_name=null, $pack_quantity=null, $pack_status=null )
    {
        $this -> Id = $id;
        $this -> Created_By = $created_by;
        $this -> Updated_By = $updated_by;
        $this -> Created = $created;
        $this -> Updated = $updated;
        $this -> Id_Animal = $id_animal;
        $this -> Id_Client = $id_client;
        $this -> Id_Order = $id_order;
        $this -> Id_Order_Item = $id_order_item;
        $this -> Id_Prod_Serv = $id_prod_serv;
        $this -> Pack_Consumed = $pack_consumed;
        $this -> Pack_Date = $pack_date;
        $this -> Pack_Name = $pack_name;
        $this -> Pack_Quantity = $pack_quantity;
        $this -> Pack_Status = $pack_status;

        
    }

}