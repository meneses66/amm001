<?php

class Clients{
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;
    public $Name;
    public $Mobile1;
    public $Mobile2;
    public $Client_Since;
    public $Preferred_Dog_Food;
    public $Status;
    public $Origin;
    public $Old_Id;
    public $Comment;
    public $Birth_Date;
    public $Email;
    public $CPF;

    function __construct($id=null, $created_by=null, $updated_by=null, $created, $updated, $name=null, $mobile1=null, $mobile2=null, $client_since=null, $preferred_dog_food=null, $status=null, $origin=null, $old_id=null, $comment=null, $birth_date=null, $email=null, $cpf=null)
    {
        $this -> Id = $id;
        $this -> Created_By = $created_by;
        $this -> Updated_By = $updated_by;
        $this -> Created = $created;
        $this -> Updated = $updated;
        $this -> Name = $name;
        $this -> Mobile1 = $mobile1;
        $this -> Mobile2 = $mobile2;
        $this -> Client_Since = $client_since;
        $this -> Preferred_Dog_Food = $preferred_dog_food;
        $this -> Status = $status;
        $this -> Origin = $origin;
        $this -> Old_Id = $old_id;
        $this -> Comment = $comment;
        $this -> Birth_Data = $birth_date;
        $this -> Email = $email;
        $this -> CPF = $cpf;
    }

}

?>