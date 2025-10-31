<?php

namespace Controller;

//if(session_status() === PHP_SESSION_NONE) session_start();

restart_session();

//defined('ROOTPATH') OR exit('Access denied!');
(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class Payments {

    use _GlobalController;
    private $object = 'payments';
    private $UCF_object = 'Payments';

    public function index()
    {
        //echo "This is Payments controller";

        //$this->view('payments/payments');
    }

    //SESSION TO LOAD HTML FORMS:
    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_payments_form(){

        if (isset($_GET['id'])){

            $output = "";

            $id = $_GET['id'];
            $created_by = $_SESSION['username'];
            $updated_by = $_SESSION['username'];
            $payment_type = null;
            $payment_date = date('Y-m-d');
            $payment_description = null;
            $payment_value = null;
            $payment_output = null;
            $payment_supplier = null;
            $payment_category = null;
            $payment_flag_provision = false;
            $payment_method = null;
 
            if (!($id=='new')) {
                $inputs["ID"]=$_GET['id'];
                $model = instantiate('\\Model\\'.$this->UCF_object);
                
                $data = $model->getRow($inputs);
                if($data){
                    foreach ($data as $key => $value) {
                        $data_form[$key]=$value;
                    }

                    $created_by = $data_form['CREATED_BY'];
                    $updated_by = $data_form['UPDATED_BY'];
                    $id = $data_form['ID'];
                    $payment_type = $data_form['PAYMENT_TYPE'];
                    $payment_date = $data_form['PAYMENT_DATE'];
                    $payment_description = $data_form['PAYMENT_DESCRIPTION'];
                    $payment_value = $data_form['PAYMENT_VALUE'];
                    $payment_output = $data_form['PAYMENT_OUTPUT'];
                    $payment_supplier = $data_form['PAYMENT_SUPPLIER'];
                    $payment_category = $data_form['PAYMENT_CATEGORY'];
                    $payment_flag_provision = $data_form['PAYMENT_FLAG_PROVISION'];
                    $payment_method = $data_form['PAYMENT_METHOD'];

                }
                unset($data_form);
                unset($inputs);
            }

            // Definir valores checked para checkbox
            $provision_checked = ($payment_flag_provision == 1) ? 'checked' : '';

            //START TO LOAD THE UPDATE FORM:
            $output .= '<div class="row">
                            <div class="col-sm-1">
                                <label for="id" class="medium-label">Id:</label>
                            </div>
                            <div class="col-sm-5">
                                <input id="id" type="text" size="8" name="Id" readonly value="'.$id.'">
                            </div>
                            <div class="col-sm-6">
                                <input id="created_by" type="hidden" name="Created_By" value="'.$created_by.'" readonly>
                                <input id="updated_by" type="hidden" name="Updated_By" value="'.$updated_by.'" readonly>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="payment_type" class="medium-label">Tipo: *</label>
                            </div>
                            <div class="col-sm-5">
                                <select class="medium-label" id="payment_type" name="Payment_Type">
                                    <option class="medium-label" value="" '.(($payment_type == '')?"selected":"").'>Selecione...</option>
                                    <option class="medium-label" value="Despesa" '.(($payment_type == 'Despesa')?"selected":"").'>Despesa</option>
                                    <option class="medium-label" value="Receita" '.(($payment_type == 'Receita')?"selected":"").'>Receita</option>
                                    <option class="medium-label" value="Investimento" '.(($payment_type == 'Investimento')?"selected":"").'>Investimento</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <label for="payment_date" class="medium-label">Data: *</label>
                            </div>
                            <div class="col-sm-5">
                                <input id="payment_date" type="date" name="Payment_Date" value="'.$payment_date.'">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="payment_description" class="medium-label">Descrição: *</label>
                            </div>
                            <div class="col-sm-5">
                                <input id="payment_description" type="text" size="50" name="Payment_Description" value="'.$payment_description.'">
                            </div>
                            <div class="col-sm-1">
                                <label for="payment_value" class="medium-label">Valor: *</label>
                            </div>
                            <div class="col-sm-5">
                                <input id="payment_value" type="number" step="0.01" name="Payment_Value" value="'.$payment_value.'">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="payment_output" class="medium-label">Saída:</label>
                            </div>
                            <div class="col-sm-5">
                                <input id="payment_output" type="number" step="0.01" name="Payment_Output" value="'.$payment_output.'">
                            </div>
                            <div class="col-sm-1">
                                <label for="payment_supplier" class="medium-label">Fornecedor:</label>
                            </div>
                            <div class="col-sm-5">
                                <input id="payment_supplier" type="text" size="50" name="Payment_Supplier" value="'.$payment_supplier.'">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="payment_category" class="medium-label">Categoria:</label>
                            </div>
                            <div class="col-sm-5">
                                <select class="medium-label" id="payment_category" name="Payment_Category">
                                    <option class="medium-label" value="" '.(($payment_category == '')?"selected":"").'>Selecione...</option>
                                    <option class="medium-label" value="Alimentação" '.(($payment_category == 'Alimentação')?"selected":"").'>Alimentação</option>
                                    <option class="medium-label" value="Transporte" '.(($payment_category == 'Transporte')?"selected":"").'>Transporte</option>
                                    <option class="medium-label" value="Material" '.(($payment_category == 'Material')?"selected":"").'>Material</option>
                                    <option class="medium-label" value="Equipamento" '.(($payment_category == 'Equipamento')?"selected":"").'>Equipamento</option>
                                    <option class="medium-label" value="Serviço" '.(($payment_category == 'Serviço')?"selected":"").'>Serviço</option>
                                    <option class="medium-label" value="Outros" '.(($payment_category == 'Outros')?"selected":"").'>Outros</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <label for="payment_method" class="medium-label">Método:</label>
                            </div>
                            <div class="col-sm-5">
                                <select class="medium-label" id="payment_method" name="Payment_Method">
                                    <option class="medium-label" value="" '.(($payment_method == '')?"selected":"").'>Selecione...</option>
                                    <option class="medium-label" value="Dinheiro" '.(($payment_method == 'Dinheiro')?"selected":"").'>Dinheiro</option>
                                    <option class="medium-label" value="Cartão Débito" '.(($payment_method == 'Cartão Débito')?"selected":"").'>Cartão Débito</option>
                                    <option class="medium-label" value="Cartão Crédito" '.(($payment_method == 'Cartão Crédito')?"selected":"").'>Cartão Crédito</option>
                                    <option class="medium-label" value="PIX" '.(($payment_method == 'PIX')?"selected":"").'>PIX</option>
                                    <option class="medium-label" value="Transferência" '.(($payment_method == 'Transferência')?"selected":"").'>Transferência</option>
                                    <option class="medium-label" value="Boleto" '.(($payment_method == 'Boleto')?"selected":"").'>Boleto</option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-1">
                                <input id="payment_flag_provision" type="checkbox" name="Payment_Flag_Provision" '.$provision_checked.'>
                            </div>
                            <div class="col-sm-5">
                                <label for="payment_flag_provision" class="medium-label">Provisão</label>
                            </div>
                            <div class="col-sm-6">
                                
                            </div>
                        </div><br>';
                        $sql_stm = null;
                        $data = null;
                        $model = null;
                        echo $output;
     
        } else{
            $sql_stm = null;
            $data = null;
            $model = null;
            show("No record to display!");
        }

    }

    //LOAD HTML FOR LISTING RECORDS IN TABLE
    public function load_rows(){
        
        //restart_session();
        $payments_edit_check = check_permission($_SESSION['username'], "payments_edit");
        $payments_delete_check = check_permission($_SESSION['username'], "payments_delete");
        $output = "";
        $model = instantiate('\\Model\\'.$this->UCF_object);
        
        $data = $model->listAll();
        if($data){
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Tipo</th>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Saída</th>
                                <th>Fornecedor</th>
                                <th>Categoria</th>
                                <th>Método</th>
                                <th>Provisão</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($data as $row) {
                $output .='<tr class="text-center text-secondary">
                            <td>'.esc($row->ID).'</td>
                            <td>'.esc($row->UPDATED).'</td>
                            <td>'.esc($row->PAYMENT_TYPE).'</td>
                            <td>'.esc($row->PAYMENT_DATE).'</td>
                            <td>'.esc($row->PAYMENT_DESCRIPTION).'</td>
                            <td>'.esc($row->PAYMENT_VALUE).'</td>
                            <td>'.esc($row->PAYMENT_OUTPUT).'</td>
                            <td>'.esc($row->PAYMENT_SUPPLIER).'</td>
                            <td>'.esc($row->PAYMENT_CATEGORY).'</td>
                            <td>'.esc($row->PAYMENT_METHOD).'</td>
                            <td>'.($row->PAYMENT_FLAG_PROVISION==1?"■":"").'</td>
                            <td>
                                '.(($payments_edit_check) ? '<a href="'.ROOT.'/'.$this->UCF_object.'/_new?id='.esc($row->ID).'" title="Edit" class="text-primary updateBtn" id="'.esc($row->ID).'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;' : '').'
                                '.(($payments_delete_check) ? '<a href="'.ROOT.'/'.$this->UCF_object.'/_delete?id='.esc($row->ID).'" title="Delete" class="text-danger deleteBtn" id="'.esc($row->ID).'"><i class="fas fa-eraser"></i></a>' : '').'
                            </td></tr>';
            }
            $output .= '</tbody>
                        <tfoot>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Tipo</th>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Saída</th>
                                <th>Fornecedor</th>
                                <th>Categoria</th>
                                <th>Método</th>
                                <th>Provisão</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>';
            $data = null;
            $model = null;

            echo $output;
        }
        else{
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Tipo</th>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Saída</th>
                                <th>Fornecedor</th>
                                <th>Categoria</th>
                                <th>Método</th>
                                <th>Provisão</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="12" class="text-center text-secondary">Sem dados para mostrar</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Tipo</th>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Saída</th>
                                <th>Fornecedor</th>
                                <th>Categoria</th>
                                <th>Método</th>
                                <th>Provisão</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>';
            $data = null;
            $model = null;
            echo $output;
        }
    }

    //FUNCTION USED TO PRE-VALIDATE PAYMENTS INFO BEFORE IT'S SUBMITTED
    public function validate_payments($inputs){
        $error=0;
        $error_msg="";
        if (isset($inputs['operation'])) {
            if ( $inputs['Payment_Type']==null || $inputs['Payment_Type']=="") {
                $error=1;
                $error_msg .= "Indique um valor para \"Tipo\".\n";
            }
            if ( $inputs['Payment_Date']==null || $inputs['Payment_Date']=="") {
                $error=1;
                $error_msg .= "Indique um valor para \"Data\".\n";
            }
            if ( $inputs['Payment_Description']==null || $inputs['Payment_Description']=="") {
                $error=1;
                $error_msg .= "Indique um valor para \"Descrição\".\n";
            }
            if ( $inputs['Payment_Value']==null || $inputs['Payment_Value']=="") {
                $error=1;
                $error_msg .= "Indique um valor para \"Valor\".\n";
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
                $_POST['class']="Payments";

                if ($inputs['Id']=="new") {
                    unset($_POST['Id']);                
                    $_POST['method']="insert_call";
                        $ajax_call = instantiate('\\Controller\\' . 'Ajax_call');
                    $_POST['csrf_token'] = csrf_token();
                    $_POST['csrf_token'] = csrf_token();
                    $ajax_call->index();
                } else{
                    $_POST['method']="update_call";
                    $ajax_call = instantiate('\\Controller\\' . 'Ajax_call');
                    $_POST['csrf_token'] = csrf_token();
                    $_POST['csrf_token'] = csrf_token();
                    $ajax_call->index();
                }
            }
        } else{
            return $error_msg="Operation failed";
        }
    }

}