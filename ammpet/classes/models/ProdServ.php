<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

class ProdServ {
    
    use _GlobalModel;
    protected $table = 'PROD_SERV';

    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;

    function __construct($id=null, $created_by=null, $updated_by=null, $created=null, $updated=null){
        $this->Id = $id;
        $this->Created_By = $created_by;
        $this->Updated_By = $updated_by;
        $this->Created = $created;
        $this->Updated = $updated;
    }

}