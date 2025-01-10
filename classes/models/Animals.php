<?php

class Animals{
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;
    public $Name;
    public $Client;
    public $Type;
    public $Breed;
    public $Sex;
    public $Birth_Date;
    public $Old_Id;
    public $No_Perfume;
    public $Angry;
    public $Lamina_Allergy;
    public $Vaccinated;

    function __construct($id=null, $created_by=null, $updated_by=null, $created, $updated, $name=null, Clients $client=null, $type=null, Breeds $breed=null, $sex=null, $birth_date=null, $old_id=null, $flg_no_perfume=null, $flg_angry=null, $flg_lamina_allergy=null, $flg_vaccinated=null)
    {
        $this -> Id = $id;
        $this -> Created_By = $created_by;
        $this -> Updated_By = $updated_by;
        $this -> Created = $created;
        $this -> Updated = $updated;
        $this -> Name = $name;
        
        if ($client != null)
            $this -> Client = $client;
        else
            $this -> Client = new Clients();
        
        $this -> Type = $type;

        $this -> Breed = $breed;
        if ($breed != null)
            $this -> Breed = $breed;
        else
            $this -> Breed = new Breeds();

        $this -> Sex = $sex;
        $this -> Birth_Date = $birth_date;
        $this -> Old_Id = $old_id;
        $this -> No_Perfume = $flg_no_perfume;
        $this -> Angry = $flg_angry;
        $this -> Laina_Allergy = $flg_lamina_allergy;
        $this -> Vaccinated = $flg_vaccinated;

    }
}

?>