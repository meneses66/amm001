<?php

class Clientes{
    public $Id;
    public $Nome;
    public $Celular;
    public $Celular2;
    public $Cliente_Desde;
    public $Racao_Preferida;
    public $Status;
    public $Origem;
    public $Old_Id;

    function __construct($id=null, $nome=null, $celular=null, $celular2=null, $cliente_desde=null, $racao_preferida=null, $status=null, $origem=null, $old_id=null)
    {
        $this -> Id = $id;
        $this -> Nome = $nome;
        $this -> Celular = $celular;
        $this -> Celular2 = $celular2;
        $this -> Cliente_Desde = $cliente_desde;
        $this -> Racao_Preferida = $racao_preferida;
        $this -> Status = $status;
        $this -> Origem = $origem;
        $this -> Old_Id = $old_id; 
    }

}

?>