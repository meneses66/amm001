<?php 

namespace Controller;

if(session_status() === PHP_SESSION_NONE) session_start();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

/**
 * Order_X class
 */
class Order_X
{
	use _GlobalController;
	private $object = 'order_x';
    private $UCF_object = 'Order_X';

	public function index()
	{

	}

    //ORDERS DO NOT HAVE FORMS - THEY ARE CREATED BY SELECTING THE CLIENT

    public function pick_client(){

    }

    //LOAD HTML FOR LISTING RECORDS IN TABLE -- SERVICE AND PRODUCT SHARE SAME TABLE PRODSERV 
    // THEREFORE CHANGED FROM LISTALL AND COUNTALL to LISTWHARE AND COUNTWHERE
    public function load_rows(){
            
        $output = "";
        $model = new('\Model\\'.$this->UCF_object);
        
        $sqlstm = "SELECT C.ID AS ID, C.UPDATED AS UPDATED, C.NAME AS NAME, C.MOBILE_1 AS MOBILE_1, C.MOBILE_2 as MOBILE_2, C.ORIGIN as ORIGIN, C.OLD_ID as OLD_ID, C.STATUS as STATUS, GROUP_CONCAT(A.NAME) AS ANIMALS FROM `CLIENT` C LEFT JOIN `ANIMAL` A ON C.ID = A.ID_CLIENT GROUP BY C.ID";

        $data = $model->exec_sqlstm($sqlstm);
        if($model->countAll()>0){
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Nome</th>
                                <th>Celular 1</th>
                                <th>Celular 2</th>
                                <th>Origin</th>
                                <th>Old Id</th>
                                <th>Status</th>
                                <th>Animais</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($data as $row) {
                $output .='<tr class="text-center text-secondary">
                            <td>'.$row->ID.'</td>
                            <td>'.$row->UPDATED.'</td>
                            <td>'.$row->NAME.'</td>
                            <td>'.$row->MOBILE_1.'</td>
                            <td>'.$row->MOBILE_2.'</td>
                            <td>'.$row->ORIGIN.'</td>
                            <td>'.$row->OLD_ID.'</td>
                            <td>'.$row->STATUS.'</td>
                            <td>'.$row->ANIMALS.'</td>
                            <td>
                                <a href="'.ROOT."/$this->UCF_object/_update?id=$row->ID".'" title="Edit" class="text-primary updateBtn" id="'.$row->ID.'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
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

    public function load_parent_form(){
        if (isset($_GET['cli_id'])){

            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";
            $inputs["ID"]=$_GET['cli_id'];
            $id=$_GET['cli_id'];
            $model = new('\Model\\'.$this->UCF_object);
            $data = $model->getRow($inputs);

            if($data){

                foreach ($data as $key => $value) {
                    $data_form[$key]=$value;
                }

                $output .= '<div class="row">
                                <div class="col-sm-1">
                                    <label for="id" class="medium-label">Id:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="id" type="text" size="8" name="Id" readonly value="'.$data_form['ID'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="name" class="medium-label">Nome:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="name" type="text" size="30" name="Name" readonly value="'.$data_form['NAME'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="mobile_1" class="medium-label">Celular 1:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="mobile_1" type="text" size="25" name="Mobile_1" readonly value="'.$data_form['MOBILE_1'].'">
                                </div>
                            </div>';
                            echo $output;
            } else{
                show("No record to display!");
            }

        }
    }

}
