<?php

namespace Model;

defined('ROOTPATH') OR exit('Access denied!');

class PreClosing {

    use _GlobalModel;
    protected $table = 'PRE_CLOSING';
    
    public $Id;
    public $Created_By;
    public $Updated_By;
    public $Created;
    public $Updated;

    public $Year;
    public $Month;
    public $Id_Employee;
    public $Comission_Prod;
    public $Comission_Serv;
    public $Status;
    public $D01;
    public $D02;
    public $D03;
    public $D04;
    public $D05;
    public $D06;
    public $D07;
    public $D08;
    public $D09;
    public $D10;
    public $D11;
    public $D12;
    public $D13;
    public $D14;
    public $D15;
    public $D16;
    public $D17;
    public $D18;
    public $D19;
    public $D20;
    public $D21;
    public $D22;
    public $D23;
    public $D24;
    public $D25;
    public $D26;
    public $D27;
    public $D28;
    public $D29;
    public $D30;
    public $D31;
    public $Serv_Count;


    function __construct($id=null, $created_by=null, $updated_by=null, $created=null, $updated=null, $year=null, $month=null, $id_employee=null, $comission_prod=null, $comission_serv=null, $status=null, $d01=null, $d02=null, $d03=null, $d04=null, $d05=null, $d06=null, $d07=null, $d08=null, $d09=null, $d10=null, $d11=null, $d12=null, $d13=null, $d14=null, $d15=null, $d16=null, $d17=null, $d18=null, $d19=null, $d20=null, $d21=null, $d22=null, $d23=null, $d24=null, $d25=null, $d26=null, $d27=null, $d28=null, $d29=null, $d30=null, $d31=null, $serv_count=null)
    {
        $this -> Id = $id;
        $this -> Created_By = $created_by;
        $this -> Updated_By = $updated_by;
        $this -> Created = $created;
        $this -> Updated = $updated;

        $this -> Year = $year;
        $this -> Month = $month;
        $this -> Id_Employee = $id_employee;
        $this -> Comission_Prod = $comission_prod;
        $this -> Comission_Serv = $comission_serv;
        $this -> Status = $status;
        $this -> D01 = $d01;
        $this -> D02 = $d02;
        $this -> D03 = $d03;
        $this -> D04 = $d04;
        $this -> D05 = $d05;
        $this -> D06 = $d06;
        $this -> D07 = $d07;
        $this -> D08 = $d08;
        $this -> D09 = $d09;
        $this -> D10 = $d10;
        $this -> D11 = $d11;
        $this -> D12 = $d12;
        $this -> D13 = $d13;
        $this -> D14 = $d14;
        $this -> D15 = $d15;
        $this -> D16 = $d16;
        $this -> D17 = $d17;
        $this -> D18 = $d18;
        $this -> D19 = $d19;
        $this -> D20 = $d20;
        $this -> D21 = $d21;
        $this -> D22 = $d22;
        $this -> D23 = $d23;
        $this -> D24 = $d24;
        $this -> D25 = $d25;
        $this -> D26 = $d26;
        $this -> D27 = $d27;
        $this -> D28 = $d28;
        $this -> D29 = $d29;
        $this -> D30 = $d30;
        $this -> D31 = $d31;
        $this -> Serv_Count = $serv_count;

    }

}