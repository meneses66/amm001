<?php

namespace Controller;

//if(session_status() === PHP_SESSION_NONE) session_start();

restart_session();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class OrderPayment {

    use _GlobalController;
    private $object = 'orderpayment';
    private $UCF_object = 'OrderPayment';

    public function index()
    {

    }

    //SESSION TO LOAD HTML FORMS:

    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_payment_form(){

        if (isset($_GET['paym_id'])){

            //if(session_status() === PHP_SESSION_NONE) session_start();
            //restart_session();

            //IF NOT NEW RECORD GET DATA FROM DATABASE TO SET FIELDS:
            $payment_type="N/A";
            $paid_amount=null;
            $flag1="";
            $created_by=$_SESSION['username'];
            $updated_by=$_SESSION['username'];
            $id="new";
            $order_id=$_GET['order_id'];
            $cli_id=$_GET['cli_id'];
            $date=date('Y-m-d');
            $inputs['ID']="new";

            if(!($_GET['paym_id']=='new')){

                $inputs['ID']=$_GET['paym_id'];
                $id=$_GET['paym_id'];
                $model = new('\Model\\'.$this->UCF_object);
                
                $data = $model->getRow($inputs);

                if($data){

                    foreach ($data as $key => $value) {
                        $data_form[$key]=$value;
                    }
                
                    $payment_type=$data_form['PAYMENT_TYPE'];
                    $paid_amount=$data_form['PAID_AMOUNT'];
                    $flag1 = ($data_form['FLAG1']==1) ? "checked" : "";
                    $updated_by=$_SESSION['username'];
                    $created_by=$data_form['CREATED_BY'];
                    $id=$data_form['ID'];
                    $date=$data_form['DATE'];

                }

            }
   
            $output = "";

            //START TO LOAD THE UPDATE FORM:
            $output .= '<div class="row">
                            <div class="col-sm-1">
                                <input id="created_by" type="hidden" name="Created_By" value="'.$created_by.'">
                                <input id="updated_by" type="hidden" name="Updated_By" value="'.$updated_by.'">
                                <input id="id_order" type="hidden" name="Id_Order" value="'.$order_id.'">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="id" class="medium-label">Id:</label>
                            </div>
                            <div class="col-sm-3">
                                <input id="id" type="text" size="10" name="Id" readonly value="'.$id.'">
                            </div>
                            <div class="col-sm-1">
                                <label for="payment_type" class="medium-label">Tipo Pagamento:</label>
                            </div>
                            <div class="col-sm-3">
                                <select class="medium-label" id="payment_type" name="Payment_Type">
                                    <option class="medium-label" value="N/A" '.(($payment_type == 'Dinheiro')?"selected":"").'>Selecione uma opção</option>
                                    <option class="medium-label" value="Dinheiro" '.(($payment_type == 'Dinheiro')?"selected":"").'>Dinheiro</option>
                                    <option class="medium-label" value="Pix" '.(($payment_type == 'Pix')?"selected":"").'>Pix</option>
                                    <option class="medium-label" value="Credito" '.(($payment_type == 'Credito')?"selected":"").'>Crédito</option>
                                    <option class="medium-label" value="Debito" '.(($payment_type == 'Debito')?"selected":"").'>Débito</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <label for="flag1" class="medium-label">Flag:</label>
                            </div>
                            <div class="col-sm-3">
                                <input id="flag1" type="checkbox" name="Flag1" '.$flag1.'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="date" class="medium-label">Data:</label>
                            </div>
                            <div class="col-sm-3">
                                <input id="date" type="date" size="10" name="Date" value="'.$date.'">
                            </div>
                            <div class="col-sm-1">
                                <label for="paid_amount" class="medium-label">Valor Pago:</label>
                            </div>
                            <div class="col-sm-3">
                                <input id="paid_amount" type="text" size="15" name="Paid_Amount" value="'.$paid_amount.'">
                            </div>
                            <div class="col-sm-1">
                                
                            </div>
                            <div class="col-sm-3">
                                
                            </div>
                        </div>';
            
            if ($id=="new") {
                $output .= '<div class="row">
                                <div class="col-sm-6">
                                    
                                </div>
                                <div class="col-sm-6">
                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Confirmar" formaction="../OrderPayment/insert_call?cli_id='.$cli_id.'&order_id='.$order_id.'">
                                </div>
                            </div>';
            } else {
                $output .= '<div class="row">
                                <div class="col-sm-6">
                                    
                                </div>
                                <div class="col-sm-6">
                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Confirmar" formaction="../OrderPayment/update_call?cli_id='.$cli_id.'&order_id='.$order_id.'&paym_id='.$id.'">
                                </div>
                            </div>';

            }
                        
            $sql_stm = null;
            unset_array($inputs);
            $data = null;
            $model = null;
            echo $output;

        }

    }

    //LOAD HTML FOR LISTING RECORDS IN TABLE
    public function load_rows($inputs){
        
        //restart_session();
        $output = "";
        //$model = new \Model\Params;
        $model = new('\Model\\'.$this->UCF_object);
        
        $data = $model->listWhere();
        if($model->countAll()>0){
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Pedido</th>
                                <th>Valor Pago</th>
                                <th>Tipo Pagamento</th>
                                <th>Flag</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($data as $row) {
                $output .='<tr class="text-center text-secondary">
                            <td>'.$row->ID.'</td>
                            <td>'.$row->UPDATED.'</td>
                            <td>'.$row->ID_ORDER.'</td>
                            <td>'.$row->PAID_AMOUNT.'</td>
                            <td>'.$row->PAYMENT_TYPE.'</td>
                            <td>'.($row->FLAG1==1?"■":"").'</td>
                            </tr>';
            }
            $output .= '</tbody>';
            $data = null;
            $model = null;

            echo $output;
        }
        else{
            $data = null;
            $model = null;
            echo '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3>';
        }
    }

}