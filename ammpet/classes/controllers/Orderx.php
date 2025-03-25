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
        
        $sqlstm = "SELECT O.ID AS ID, O.UPDATED AS UPDATED, O.ORDER_DATE AS ORDER_DATE, C.NAME AS NAME, C.MOBILE_1 AS MOBILE_1, 
        GROUP_CONCAT(A.NAME) AS ANIMALS, O.ORDER_VALUE_NO_DISCOUNT AS ORDER_VALUE_NO_DISCOUNT, O.ORDER_VALUE_WITH_DISCOUNT AS
         ORDER_VALUE_WITH_DISCOUNT, O.ORDER_VALUE_CASH AS ORDER_VALUE_CASH, O.ORDER_VALUE_PIX AS ORDER_VALUE_PIX,
          O.ORDER_PAID_AMOUNT AS ORDER_PAID_AMOUNT, O.ORDER_DEBT AS ORDER_DEBT, O.STATUS AS STATUS, O.ID_CLIENT AS
           ID_CLIENT FROM `ORDER_X` O LEFT JOIN `CLIENT` C ON O.ID_CLIENT = C.ID LEFT JOIN `ANIMAL` A ON C.ID = A.ID_CLIENT
            GROUP BY O.ID;";

        $data = $model->exec_sqlstm($sqlstm);
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
            echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3>';
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
                foreach ($data as $row) {
                
                    $output .= '<div class="row">
                                    <div class="col-sm-1">
                                        <label for="id" class="medium-label">No.Pedido:</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input id="id" type="text" size="5" name="Id" readonly value="'.$row->ID.'">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="total_no_disc" class="medium-label">Total s/ desc:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="total_no_disc" type="text" size="15" name="Total_no_disc" readonly value="'.$row->ORDER_VALUE_NO_DISCOUNT.'">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="total_disc" class="medium-label">Total c/ desc:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="total_disc" type="text" size="15" name="Total_disc" readonly value="'.$row->ORDER_VALUE_WITH_DISCOUNT.'">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <label for="client" class="medium-label">Cliente:</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input id="client" type="text" size="25" name="Client" readonly value="'.$row->NAME.'">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="total_cash" class="medium-label">Total Dinh:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="total_cash" type="text" size="15" name="Total_cash" readonly value="'.$row->ORDER_VALUE_CASH.'">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="total_pix" class="medium-label">Total Pix:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="total_pix" type="text" size="15" name="Total_pix" readonly value="'.$row->ORDER_VALUE_PIX.'">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <label for="mobile_1" class="medium-label">Celular 1:</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input id="mobile_1" type="text" size="25" name="Mobile_1" readonly value="'.$row->MOBILE_1.'">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="total_paid" class="medium-label">Total Pago:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="total_paid" type="text" size="15" name="Total_paid" readonly value="'.$row->ORDER_PAID_AMOUNT.'">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="total_debt" class="medium-label">Total Pend.:</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="total_debt" type="text" size="15" name="Total_debt" readonly value="'.$row->ORDER_DEBT.'">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <label for="order_date" class="medium-label">Data:</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input id="order_date" type="date" size="8" name="Order_date" readonly value="'.$row->ORDER_DATE.'">
                                    </div>
                                    <div class="col-sm-1">
                                        <label for="status" class="medium-label">Status:</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input id="status" type="text" size="8" name="Status" readonly value="'.$row->STATUS.'">
                                    </div>
                                    <div class="col-sm-1">
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        
                                    </div>
                                </div>';
                                echo $output;
                   }
            } else{
                show("No record to display!");
            }

        }
    }

}
