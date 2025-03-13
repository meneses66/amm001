<?php

namespace Model;

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class Params {

    use _GlobalModel;
    protected $table = 'PARAMS';
    
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;
    public $Name;
    public $Value;
    public $Type;
    public $Status;
    public $Comment;


    function __construct($id=null, $created_by=null, $updated_by=null, $created=null, $updated=null, $name=null, $value=null, $type=null, $status=null, $comment=null)
    {
        $this -> Id = $id;
        $this -> Created_By = $created_by;
        $this -> Updated_By = $updated_by;
        $this -> Created = $created;
        $this -> Updated = $updated;
        $this -> Name = $name;
        $this -> Value = $value;
        $this -> Type = $type;
        $this -> Status = $status;
        $this -> Comment = $comment;
    }

}