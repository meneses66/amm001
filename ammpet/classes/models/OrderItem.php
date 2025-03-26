<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

class OrderItem {

    use _GlobalModel;
    protected $table = 'ORDER_ITEM';
    
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;

    public $Id_Order ;
    public $Id_Prod_Serv ;
    public $Quantity;
    public $Unit_Value;
    public $Discount_Perc;
    public $Discount_Value;
    public $Value_No_Discount;
    public $Value_With_Discount;
    public $Id_Package ;
    public $Id_Package_Animal ;
    public $Prod_Serv_Type;
    public $Date;
    public $Item_Description;
    public $Serv_Executor;
    public $Package_Amount;
    public $Package_Consume;
    public $Package_Sequence;
    public $Package_Service;
    public $Prod_Serv_Category;
    public $Id_Client ;
    public $Blade;
    public $Prod_Serv_Group;
    public $Package_Name;
    public $Salesperson;
    public $Flag_Comission;
    public $Cost_Center;
    public $External_Cost;
    public $Comission_Percentage;
    public $Old_Id;
    public $Flag_Otite;
    public $Flag_Olhos_Verm;
    public $Flag_Pulga;
    public $Flag_Carrapato;
    public $Flag_Dermatite;
    public $Flag_Ferida;
    public $Flag_Outro;
    public $Checklist_Description;
    public $Adap_Pata;
    public $Flag_Contrario;
    public $Tosador;
    public $Price_Cash;
    public $Total_Cash;
    public $Price_Pix;
    public $Total_Pix;

    function __construct($id =null, $created=null, $created_by=null, $updated=null, $updated_by=null, $id_order =null, $id_prod_serv =null, $quantity=null, $unit_value=null, $discount_perc=null, $discount_value=null, $value_no_discount=null, $value_with_discount=null, $id_package =null, $id_package_animal =null, $prod_serv_type=null, $date=null, $item_description=null, $serv_executor=null, $package_amount=null, $package_consume=null, $package_sequence=null, $package_service=null, $prod_serv_category=null, $id_client =null, $blade=null, $prod_serv_group=null, $package_name=null, $salesperson=null, $flag_comission=null, $cost_center=null, $external_cost=null, $comission_percentage=null, $old_id=null, $flag_otite=null, $flag_olhos_verm=null, $flag_pulga=null, $flag_carrapato=null, $flag_dermatite=null, $flag_ferida=null, $flag_outro=null, $checklist_description=null, $adap_pata=null, $flag_contrario=null, $tosador=null, $price_cash=null, $total_cash=null, $price_pix=null, $total_pix=null )
    {
        $this -> Id = $id;
        $this -> Created_By = $created_by;
        $this -> Updated_By = $updated_by;
        $this -> Created = $created;
        $this -> Updated = $updated;

        $this -> Id_Order  = $id_order ;
        $this -> Id_Prod_Serv  = $id_prod_serv ;
        $this -> Quantity = $quantity;
        $this -> Unit_Value = $unit_value;
        $this -> Discount_Perc = $discount_perc;
        $this -> Discount_Value = $discount_value;
        $this -> Value_No_Discount = $value_no_discount;
        $this -> Value_With_Discount = $value_with_discount;
        $this -> Id_Package  = $id_package ;
        $this -> Id_Package_Animal  = $id_package_animal ;
        $this -> Prod_Serv_Type = $prod_serv_type;
        $this -> Date = $date;
        $this -> Item_Description = $item_description;
        $this -> Serv_Executor = $serv_executor;
        $this -> Package_Amount = $package_amount;
        $this -> Package_Consume = $package_consume;
        $this -> Package_Sequence = $package_sequence;
        $this -> Package_Service = $package_service;
        $this -> Prod_Serv_Category = $prod_serv_category;
        $this -> Id_Client  = $id_client ;
        $this -> Blade = $blade;
        $this -> Prod_Serv_Group = $prod_serv_group;
        $this -> Package_Name = $package_name;
        $this -> Salesperson = $salesperson;
        $this -> Flag_Comission = $flag_comission;
        $this -> Cost_Center = $cost_center;
        $this -> External_Cost = $external_cost;
        $this -> Comission_Percentage = $comission_percentage;
        $this -> Old_Id = $old_id;
        $this -> Flag_Otite = $flag_otite;
        $this -> Flag_Olhos_Verm = $flag_olhos_verm;
        $this -> Flag_Pulga = $flag_pulga;
        $this -> Flag_Carrapato = $flag_carrapato;
        $this -> Flag_Dermatite = $flag_dermatite;
        $this -> Flag_Ferida = $flag_ferida;
        $this -> Flag_Outro = $flag_outro;
        $this -> Checklist_Description = $checklist_description;
        $this -> Adap_Pata = $adap_pata;
        $this -> Flag_Contrario = $flag_contrario;
        $this -> Tosador = $tosador;
        $this -> Price_Cash = $price_cash;
        $this -> Total_Cash = $total_cash;
        $this -> Price_Pix = $price_pix;
        $this -> Total_Pix = $total_pix;


    }

}