<?php

class Supplier {

    use _GlobalModel;

    protected $table = 'SUPPLIER';
    
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;
    public $Name;
    public $Login;
    public $Pass;
    public $Role;
    public $CNPJ;
    public $CPF;
    public $Type;
    public $Sequence;
    public $Hire_Date;
    public $Status;
    public $Comment;

    function __construct($id=null, $created_by=null, $updated_by=null, $created=null, $updated=null, $name=null, $login=null, $pass=null, $role=null, $cnpj=null, $cpf=null, $type=null, $sequence=null, $hire_date=null, $status=null, $comment=null){
        $this->Id = $id;
        $this->Created_By = $created_by;
        $this->Updated_By = $updated_by;
        $this->Created = $created;
        $this->Updated = $updated;
        $this->Name = $name;
        $this->Login = $login;
        $this->Pass = $pass;
        $this->Role = $role;
        $this->CNPJ = $cnpj;
        $this->CPF = $cpf;
        $this->Type = $type;
        $this->Sequence = $sequence;
        $this->Hire_Date = $hire_date;
        $this->Status = $status;
        $this->Comment = $comment;
    }

}