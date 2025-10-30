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
                $model = instantiate('\\Model\\'.$this->UCF_object);
                
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
                                <input id="created_by" type="hidden" name="Created_By" value="'.$created_by.'" readonly>
                                <input id="updated_by" type="hidden" name="Updated_By" value="'.$updated_by.'" readonly>
                                <input id="id_order" type="hidden" name="Id_Order" value="'.$order_id.'" readonly>
                                <input id="id_client" type="hidden" name="Id_Client" value="'.$cli_id.'" readonly>
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
                                <label for="payment_type" class="medium-label">Tipo Pagamento: *</label>
                            </div>
                            <div class="col-sm-3">
                                <select class="medium-label" id="payment_type" name="Payment_Type">
                                    <option class="medium-label" value="X" '.(($payment_type == 'X')?"selected":"").'>Selecione uma opção</option>
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
                                <label for="paid_amount" class="medium-label">Valor Pago: *</label>
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
                                <div class="col-sm-7">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p style="font-size:12px; font-weight:bold; margin-bottom: 5px;">Pagamento Rápido:</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2 pr-1">
                                            <button type="button" class="btn btn-sm btn-block" style="background-color: #ff8c42; color: white; font-size: 10px; padding: 4px;" onclick="quickPayment(\'Dinheiro\')">Dinheiro</button>
                                        </div>
                                        <div class="col-sm-2 pr-1">
                                            <button type="button" class="btn btn-sm btn-block" style="background-color: #ff8c42; color: white; font-size: 10px; padding: 4px;" onclick="quickPayment(\'Debito\')">Débito</button>
                                        </div>
                                        <div class="col-sm-2 pr-1">
                                            <button type="button" class="btn btn-sm btn-block" style="background-color: #ff8c42; color: white; font-size: 10px; padding: 4px;" onclick="quickPayment(\'Credito\')">Crédito</button>
                                        </div>
                                        <div class="col-sm-2 pr-1">
                                            <button type="button" class="btn btn-sm btn-block" style="background-color: #ff8c42; color: white; font-size: 10px; padding: 4px;" onclick="quickPayment(\'Pix\')">Pix</button>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-sm btn-block" style="background-color: #ff8c42; color: white; font-size: 10px; padding: 4px;" onclick="quickPayment(\'Pacote\')">Pacote</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Confirmar" formaction="../OrderPayment/insert_call?cli_id='.$cli_id.'&order_id='.$order_id.'">
                                </div>
                            </div>';
            } else {
                $output .= '<div class="row">
                                <div class="col-sm-7">
                                    <!-- Botões de pagamento rápido não disponíveis para edição -->
                                </div>
                                <div class="col-sm-5">
                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Confirmar" formaction="../OrderPayment/update_call?cli_id='.$cli_id.'&order_id='.$order_id.'&paym_id='.$id.'">
                                </div>
                            </div>';

            }
                        
            $sql_stm = null;
            unset_array($inputs);
            $data = null;
            $model = null;
            echo $output;
            
            // Adicionar JavaScript para os botões de pagamento rápido (apenas para novos pagamentos)
            if ($id=="new") {
                echo '<script>
                function quickPayment(paymentType) {
                    // Obter o valor do débito pendente
                    const orderDebtInput = document.getElementById("order_debt");
                    if (!orderDebtInput) {
                        alert("Erro: Não foi possível obter o valor do débito pendente.");
                        return;
                    }
                    
                    const debtAmount = orderDebtInput.value;
                    
                    // Validar se há débito pendente
                    if (!debtAmount || parseFloat(debtAmount) <= 0) {
                        alert("Não há débito pendente para este pedido.");
                        return;
                    }
                    
                    // Preencher os campos do formulário
                    document.getElementById("paid_amount").value = debtAmount;
                    document.getElementById("payment_type").value = paymentType;
                    
                    // Definir data atual
                    const today = new Date();
                    const dateString = today.getFullYear() + "-" + 
                                     String(today.getMonth() + 1).padStart(2, "0") + "-" + 
                                     String(today.getDate()).padStart(2, "0");
                    document.getElementById("date").value = dateString;
                    
                    // Submeter o formulário automaticamente
                    document.getElementById("button").click();
                }
                </script>';
            }

        }

    }

    //LOAD HTML FOR LISTING RECORDS IN TABLE
    public function load_rows($inputs){
        
        //restart_session();
        $output = "";
        //$model = new \Model\Params;
    $model = instantiate('\\Model\\'.$this->UCF_object);
        
        $data = $model->listWhere();
        if($data){
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
                            <td>'.esc($row->ID).'</td>
                            <td>'.esc($row->UPDATED).'</td>
                            <td>'.esc($row->ID_ORDER).'</td>
                            <td>'.esc($row->PAID_AMOUNT).'</td>
                            <td>'.esc($row->PAYMENT_TYPE).'</td>
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

    //FUNCTION USED TO PRE-VALIDATE ORDER_PAYM INFO BEFORE IT'S SUBMITTED
    public function validate_order_payment($inputs){
        $error=0;
        $error_msg="";
        if (isset($inputs['operation'])) {
            if ( $inputs['Payment_Type']=="X") {
                $error=1;
                $error_msg .= "Indique um valor para \"Tipo de Pagamento\".\n";
            }
            if ( $inputs['Paid_Amount']==null || $inputs['Paid_Amount']=="" || $inputs['Paid_Amount']<=0 ) {
                $error=1;
                $error_msg .= "Indique um valor para \"Valor Pago\" > 0.\n";
            }

            //IF ANY ERROR FOUND: RETURN ERROR
            if ($error == 1) {
                //amm_log(date("H:i:s").":: Error: ".$error." | Error_Msg: ".$error_msg);
                return $error_msg;
            } 

            //IF NO ERROR PROCESS WITH INSERT (id=new) OR UPDATE
            else {
                //amm_log(date("H:i:s").":: NO Errors");
                unset($_POST);

                foreach ($inputs as $key => $value) {
                    $_POST[$key]=$value;
                }

                unset($_POST['operation']);
                unset($_POST['class']);
                unset($_POST['method']);
                $_SERVER['REQUEST_METHOD']="POST";
                $_POST['class']="OrderPayment";
                // Mark nested Ajax as internal to avoid CSRF issues leaking to client
                $_POST['csrf_token'] = csrf_token();
                $_POST['type'] = 'static';

                if ($inputs['Id']=="new") {
                    unset($_POST['Id']);                
                    $_POST['method']="insert_call";
                    $ajax_call = instantiate('\\Controller\\'."Ajax_call");
                    // ensure internal call and CSRF present
                    $_POST['csrf_token'] = csrf_token();
                    $_POST['type'] = 'static';
                    $ajax_call->index();
                } else{
                    $_POST['method']="update_call";
                    $ajax_call = instantiate('\\Controller\\'."Ajax_call");
                    $_POST['csrf_token'] = csrf_token();
                    $_POST['type'] = 'static';
                    $ajax_call->index();
                }
                // Normalize response for outer AJAX success and redirect
                if (function_exists('ob_get_level')) {
                    while (ob_get_level() > 0) { @ob_end_clean(); }
                }
                http_response_code(200);
                return "";
            }
        } else{
            return $error_msg="Operation failed";
        }
    }

}
