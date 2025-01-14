<?php

class Breed{
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;
    public $Type;
    public $Breed;

    function __construct($id=null, $created_by=null, $updated_by=null, $created=null, $updated=null, $type=null, $breed=null)
    {
        $this -> Id = $id;
        $this -> Created_By = $created_by;
        $this -> Updated_By = $updated_by;
        $this -> Created = $created;
        $this -> Updated = $updated;
        $this -> Type = $type;
        $this -> Breed = $breed;
    }

}
?>