<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

class Animal {

    use _GlobalModel;
    protected $table = 'ANIMAL';
    
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;
    public $Name;
    //public $Client;
    public $Id_Client;
    public $Type;
    //public $Breed;
    public $Id_Breed;
    public $Gender;
    public $Birth_Date;
    public $Old_Id;
    public $No_Perfume;
    public $Is_Danger;
    public $Blade_Alergic;
    public $Vaccinated;
    public $Size;

    function __construct($id=null, $created_by=null, $updated_by=null, $created=null, $updated=null, $name=null, $id_client=null, $type=null, $id_breed=null, $gender=null, $birth_date=null, $old_id=null, $flg_no_perfume=null, $flg_is_danger=null, $flg_blade_alergic=null, $flg_vaccinated=null, $size)
    {
        $this -> Id = $id;
        $this -> Created_By = $created_by;
        $this -> Updated_By = $updated_by;
        $this -> Created = $created;
        $this -> Updated = $updated;
        $this -> Name = $name;
        
        $this -> Id_Client = $id_client;
        
        $this -> Type = $type;

        $this -> Id_Breed = $id_breed;

        $this -> Gender = $gender;
        $this -> Birth_Date = $birth_date;
        $this -> Old_Id = $old_id;
        $this -> No_Perfume = $flg_no_perfume;
        $this -> Is_Danger = $flg_is_danger;
        $this -> Blade_Alergic = $flg_blade_alergic;
        $this -> Vaccinated = $flg_vaccinated;
        $this -> Size = $size;

    }
}