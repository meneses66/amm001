<?php 

namespace Controller;

if(session_status() === PHP_SESSION_NONE) session_start();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

/**
 * Order_X class
 */
class Orderx
{
	use _GlobalController;
	private $object = 'orderx';
    private $UCF_object = 'Orderx';

	public function index()
	{
        $this->view('orderx/orderx');
	}

    //ORDERS DO NOT HAVE FORMS - THEY ARE CREATED BY SELECTING THE CLIENT

    public function pick_client(){

    }

    //LOAD HTML FOR LISTING RECORDS IN TABLE -- SERVICE AND PRODUCT SHARE SAME TABLE PRODSERV 
    // THEREFORE CHANGED FROM LISTALL AND COUNTALL to LISTWHARE AND COUNTWHERE
    public function load_rows(){
            
        $output = "";
        $model = new('\Model\\'.$this->UCF_object);
        
        $sql_stm = "SELECT O.ID AS ID, O.UPDATED AS UPDATED, O.ORDER_DATE AS ORDER_DATE, C.NAME AS NAME, C.MOBILE_1 AS MOBILE_1, 
        GROUP_CONCAT(A.NAME) AS ANIMALS, O.ORDER_VALUE_NO_DISCOUNT AS ORDER_VALUE_NO_DISCOUNT, O.ORDER_VALUE_WITH_DISCOUNT AS
         ORDER_VALUE_WITH_DISCOUNT, O.ORDER_VALUE_CASH AS ORDER_VALUE_CASH, O.ORDER_VALUE_PIX AS ORDER_VALUE_PIX,
          O.ORDER_PAID_AMOUNT AS ORDER_PAID_AMOUNT, O.ORDER_DEBT AS ORDER_DEBT, O.STATUS AS STATUS, O.ID_CLIENT AS
           ID_CLIENT FROM `ORDER_X` O LEFT JOIN `CLIENT` C ON O.ID_CLIENT = C.ID LEFT JOIN `ANIMAL` A ON C.ID = A.ID_CLIENT
            GROUP BY O.ID;";

        $data = $model->exec_sqlstm($sql_stm);
        if($model->countAll()>0){
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Data</th>
                                <th>Cliente</th>
                                <th>Celular 1</th>
                                <th>Animais</th>
                                <th>Total sem Desc.</th>
                                <th>Total com Desc.</th>
                                <th>Total Dinh.</th>
                                <th>Total Pix</th>
                                <th>Total Pago</th>
                                <th>Total Devedor</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($data as $row) {
                $output .='<tr class="text-center text-secondary">
                            <td>'.$row->ID.'</td>
                            <td>'.$row->UPDATED.'</td>
                            <td>'.$row->ORDER_DATE.'</td>
                            <td>'.$row->NAME.'</td>
                            <td>'.$row->MOBILE_1.'</td>
                            <td>'.$row->ANIMALS.'</td>
                            <td>'.$row->ORDER_VALUE_NO_DISCOUNT.'</td>
                            <td>'.$row->ORDER_VALUE_WITH_DISCOUNT.'</td>
                            <td>'.$row->ORDER_VALUE_CASH.'</td>
                            <td>'.$row->ORDER_VALUE_PIX.'</td>
                            <td>'.$row->ORDER_PAID_AMOUNT.'</td>
                            <td>'.$row->ORDER_DEBT.'</td>
                            <td>'.$row->STATUS.'</td>
                            <td>
                                <a href="'.ROOT."/$this->UCF_object/_order_details?cli_id=$row->ID_CLIENT&order_id=$row->ID".'" title="Edit" class="text-primary updateBtn" id="'.$row->ID.'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                <a href="'.ROOT."/$this->UCF_object/_delete?id=$row->ID".'" title="Delete" class="text-danger deleteBtn" id="'.$row->ID.'"><i class="fas fa-eraser"></i></a>
                            </td></tr>';
            }
            $output .= '</tbody>';
            $sql_stm = null;
            $data = null;
            $model = null;
            echo $output;
        }
        else{
            $sql_stm = null;
            $data = null;
            $model = null;
            echo '<h4 class="text-center text-secondary mt-5">Sem dados para mostrar</h4>';
        }
    }

    public function get_header(){
        if (isset($_GET['order_id'])){

            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";
            $inputs["ID"]=$_GET['order_id'];
            $cli_id=$_GET['cli_id'];
            $sql_stm = "SELECT O.ID AS ID, O.UPDATED AS UPDATED, O.ORDER_DATE AS ORDER_DATE, C.NAME AS NAME, C.MOBILE_1 AS MOBILE_1, O.ORDER_VALUE_NO_DISCOUNT AS ORDER_VALUE_NO_DISCOUNT, O.ORDER_VALUE_WITH_DISCOUNT AS ORDER_VALUE_WITH_DISCOUNT, O.ORDER_VALUE_CASH AS ORDER_VALUE_CASH, O.ORDER_VALUE_PIX AS ORDER_VALUE_PIX, O.ORDER_PAID_AMOUNT AS ORDER_PAID_AMOUNT, O.ORDER_DEBT AS ORDER_DEBT, O.STATUS AS STATUS, O.ID_CLIENT AS ID_CLIENT FROM `ORDER_X` O LEFT JOIN `CLIENT` C ON O.ID_CLIENT = C.ID WHERE O.ID=:ID";
            $model = new('\Model\\'.$this->UCF_object);
            $data = $model->exec_sqlstm($sql_stm, $inputs);

            if($data){

                $GLOBALS['cli_id_js']=$_GET['cli_id'];
                $GLOBALS['order_id_js']=$_GET['order_id'];
                
                foreach ($data as $row) {
                
                    $output .= '<div class="row">
                                    <div class="col-sm-1">
                                        <label for="id" class="medium-label float-right">No.Pedido:</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input id="id" type="text" size="5" name="Id" readonly value="'.$row->ID.'">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="total_no_disc" class="medium-label float-right">Total s/ desc:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="total_no_disc" type="text" size="15" name="Total_no_disc" readonly value="'.$row->ORDER_VALUE_NO_DISCOUNT.'">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="total_disc" class="medium-label float-right">Total c/ desc:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="total_disc" type="text" size="15" name="Total_disc" readonly value="'.$row->ORDER_VALUE_WITH_DISCOUNT.'">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <label for="client" class="medium-label float-right">Cliente:</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input id="client" type="text" size="25" name="Client" readonly value="'.$row->NAME.'">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="total_cash" class="medium-label float-right">Total Dinh:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="total_cash" type="text" size="15" name="Total_cash" readonly value="'.$row->ORDER_VALUE_CASH.'">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="total_pix" class="medium-label float-right">Total Pix:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="total_pix" type="text" size="15" name="Total_pix" readonly value="'.$row->ORDER_VALUE_PIX.'">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <label for="mobile_1" class="medium-label float-right">Celular 1:</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input id="mobile_1" type="text" size="25" name="Mobile_1" readonly value="'.$row->MOBILE_1.'">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="total_paid" class="medium-label float-right">Total Pago:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="total_paid" type="text" size="15" name="Total_paid" readonly value="'.$row->ORDER_PAID_AMOUNT.'">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="total_debt" class="medium-label float-right">Total Pend.:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="total_debt" type="text" size="15" name="Total_debt" readonly value="'.$row->ORDER_DEBT.'">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <label for="order_date" class="medium-label float-right">Data:</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input id="order_date" type="date" size="8" name="Order_date" readonly value="'.$row->ORDER_DATE.'">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="status" class="medium-label float-right">Status:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="status" type="text" size="8" name="Status" readonly value="'.$row->STATUS.'">
                                    </div>
                                    <div class="col-sm-2">
                                        
                                    </div>
                                    <div class="col-sm-2">
                                        
                                    </div>
                                </div>';
                                $sql_stm = null;
                                unset_array($inputs);
                                $data = null;
                                $model = null;
                                echo $output;
                   }
            } else{
                $sql_stm = null;
                unset_array($inputs);
                $data = null;
                $model = null;
                show("No record to display!");
            }

        }
    }

    public function get_animals(){
        if (isset($_GET['cli_id'])){

            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";
            $inputs["ID_CLIENT"]=$_GET['cli_id'];
            //$cli_id=$_GET['cli_id'];
            $model = new('\Model\\'."Animal");
            $data = $model->listWhere($inputs);
            
            if($data){
                $output .='<thead>
                                <tr class="text-center text-secondary">
                                    <th>Nome</th>
                                    <th>Raça</th>
                                    <th>Sexo</th>
                                    <th>Morde</th>
                                    <th>Não perf</th>
                                    <th>Alérg.Lâm.</th>
                                    <th>Vacin.</th>
                                </tr>
                            </thead>
                            <tbody>';
                foreach ($data as $row) {

                    //GET BREED NAME
                    $breed_input['ID']= $row->ID_BREED;
                    $breed = new('\Model\\'."Breed");
                    $breed_name = $breed->getRow($breed_input)->NAME;
                    $breed = null;

                    $output .='<tr class="text-center text-secondary">
                                <td>'.$row->NAME.'</td>
                                <td>'.$breed_name.'</td>
                                <td>'.$row->GENDER.'</td>
                                <td>'.($row->IS_DANGER==1?"■":"").'</td>
                                <td>'.($row->IS_NO_PERFUME==1?"■":"").'</td>
                                <td>'.($row->IS_BLADE_ALERGIC==1?"■":"").'</td>
                                <td>'.($row->IS_VACCINATED==1?"■":"").'</td>
                               </tr>';
                }
                $output .= '</tbody>';
                unset_array($inputs);
                $data = null;
                $model = null;
                echo $output;
            }
            else{
                $sql_stm = null;
                unset_array($inputs);
                $data = null;
                $model = null;
                echo '<h4 class="text-center text-secondary mt-5">Sem dados para mostrar</h4>';
            }
        }
    }

    public function get_packages(){
        if (isset($_GET['cli_id'])){

            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";
            $inputs["ID_CLIENT"]=$_GET['cli_id'];
            $inputs["PACK_STATUS"]="Aberto";

            $sql_stm = "SELECT CP.ID_ORDER AS ID_ORDER, A.NAME AS ANIMAL, OI.PACKAGE_SERVICE AS SERVICE, OI.DATE AS DT, OI.PACKAGE_SEQUENCE AS SEQ, OI.ID FROM `CLIENT_PACKAGE` CP, `ANIMAL` A, `ORDER_ITEM` OI WHERE CP.ID_ANIMAL=A.ID AND CP.ID=OI.ID_PACKAGE AND CP.PACK_STATUS=:PACK_STATUS AND CP.ID_CLIENT=:ID_CLIENT ORDER BY A.NAME, OI.PACKAGE_SEQUENCE";
            $model = new('\Model\\'."Package");
            $data = $model->exec_sqlstm($sql_stm, $inputs);
            if($data){
                $output .='<thead>
                                <tr class="text-center text-secondary">
                                    <th>Ord</th>
                                    <th>Animal</th>
                                    <th>Serviço</th>
                                    <th>Data</th>
                                    <th>Seq</th>
                                    <th>Id</th>
                                </tr>
                            </thead>
                            <tbody>';
                foreach ($data as $row) {

                    $output .='<tr class="text-center text-secondary">
                                <td>'.$row->ID_ORDER.'</td>
                                <td>'.$row->ANIMAL.'</td>
                                <td>'.$row->SERVICE.'</td>
                                <td>'.$row->DT.'</td>
                                <td>'.$row->SEQ.'</td>
                                <td>'.$row->ID.'</td>
                               </tr>';
                }
                $output .= '</tbody>';
                $sql_stm = null;
                unset_array($inputs);
                $data = null;
                $model = null;
                echo $output;
            }
            else{
                $sql_stm = null;
                unset_array($inputs);
                $data = null;
                $model = null;
                echo '<h4 class="text-center text-secondary mt-5">Sem dados para mostrar</h4>';
            }
        }
    }

    public function get_services(){
        if (isset($_GET['order_id'])){

            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";
            $inputs["ID_ORDER"]=$_GET['order_id'];
            $inputs["PROD_SERV_TYPE"]="SERV";
            
            $model = new('\Model\\'."OrderItem");
            $data = $model->listWhere($inputs);
            if($data){
                $output .='<thead>
                                <tr class="text-center text-secondary">
                                    <th>Cód.</th>
                                    <th>Serviço</th>
                                    <th>Quant.</th>
                                    <th>Valor c/ Desc.</th>
                                    <th>Pct</th>
                                    <th>Ani</th>
                                    <th>Pct Seq</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>';
                foreach ($data as $row) {

                    //GET SERVICE DETAILS
                    $service_input['ID']= $row->ID_PROD_SERV;
                    $service = new('\Model\\'."Service");
                    $service_name = $service->getRow($service_input)->NAME;
                    $service_code = $service->getRow($service_input)->CODE;
                    $service = null;

                    //GET PACKAGE ANIMAL DETAILS
                    if(is_null($row->ID_PACKAGE_ANIMAL) || $row->ID_PACKAGE_ANIMAL==""){
                        $animal_name="";    
                    } else{
                        $animal_input['ID']= $row->ID_PACKAGE_ANIMAL;
                        $animal = new('\Model\\'."Animal");
                        $animal_name = $animal->getRow($animal_input)->NAME;
                        $animal = null;
                    }

                    $output .='<tr class="text-center text-secondary">
                                <td>'.$service_code.'</td>
                                <td>'.$service_name.'</td>
                                <td>'.$row->QUANTITY.'</td>
                                <td>'.$row->VALUE_WITH_DISCOUNT.'</td>
                                <td>'.$row->ID_PACKAGE.'</td>
                                <td>'.$animal_name.'</td>
                                <td>'.$row->PACKAGE_SEQUENCE.'</td>
                                <td>
                                    <a href="'.ROOT."/OrderItem/_update_service?order_id=$row->ID_ORDER&id=$row->ID".'" title="Edit" class="text-primary updateBtn" order_id="'.$row->ID_ORDER.'" id="'.$row->ID.'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                    <a href="'.ROOT."/OrderItem/_delete?id=$row->ID".'" title="Delete" class="text-danger deleteXBtn" id="'.$row->ID.'" classforjs="OrderItem"><i class="fas fa-eraser"></i></a>
                                </td>
                               </tr>';
                }
                $output .= '</tbody>';
                $sql_stm = null;
                unset_array($inputs);
                $data = null;
                $animal = null;
                $animal_name=null;
                $service=null;
                $service_name=null;
                $model = null;
                echo $output;
            }
            else{
                $sql_stm = null;
                unset_array($inputs);
                $data = null;
                $animal = null;
                $animal_name=null;
                $service=null;
                $service_name=null;
                $model = null;
                echo '<h4 class="text-center text-secondary mt-5">Sem dados para mostrar</h4>';
            }
        }
    }

}
