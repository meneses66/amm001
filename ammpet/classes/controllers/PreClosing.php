<?php

namespace Controller;

restart_session();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class PreClosing {

    use _GlobalController;
    private $object = 'preclosing';
    private $UCF_object = 'PreClosing';
    private $parent_object = 'Supplier';

    public function __construct(){
        amm_log("PRE_CLOSING: === CONSTRUTOR CHAMADO ===");
        amm_log("PRE_CLOSING: Controller PreClosing instanciado por usuário: " . ($_SESSION['username'] ?? 'desconhecido'));
    }

    public function index()
    {}

        //SESSION TO LOAD HTML FORMS:
    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_preclosing_form($inputs = []){

        if (isset($_GET['id'])){

            $output = "";

            $id = $_GET['id'];
            $created_by = $_SESSION['username'];
            $updated_by = $_SESSION['username'];

            $year = "";
            $month = "";
            $id_employee = "";
            $temp_id_employee = "XXXX";
            $comission_prod = "";
            $comission_serv = "";
            $status = "";
            $d01 = "";
            $d02 = "";
            $d03 = "";
            $d04 = "";
            $d05 = "";
            $d06 = "";
            $d07 = "";
            $d08 = "";
            $d09 = "";
            $d10 = "";
            $d11 = "";
            $d12 = "";
            $d13 = "";
            $d14 = "";
            $d15 = "";
            $d16 = "";
            $d17 = "";
            $d18 = "";
            $d19 = "";
            $d20 = "";
            $d21 = "";
            $d22 = "";
            $d23 = "";
            $d24 = "";
            $d25 = "";
            $d26 = "";
            $d27 = "";
            $d28 = "";
            $d29 = "";
            $d30 = "";
            $d31 = "";
            $serv_count = "";

            // Initialize generic fields used in form when creating new record
            $name = "";
            $type = "";
            $value = "";
            $status = "";
            $comment = "";

 
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
                    //ADD FIELDS HERE >> START
                    $year = $data_form['YEAR'];
                    $month = $data_form['MONTH'];
                    $id_employee = $data_form['ID_EMPLOYEE'];
                    $temp_id_employee = $data_form['ID_EMPLOYEE'];
                    $comission_prod = $data_form['COMISSION_PROD'];
                    $comission_serv = $data_form['COMISSION_SERV'];
                    $status = $data_form['STATUS'];
                    // Map legacy values to new read-only domain (Aberto/Fechado)
                    if ($status === 'Ativo') { $status = 'Aberto'; }
                    if ($status === 'Desativado') { $status = 'Fechado'; }
                    $d01 = $data_form['D01'];
                    $d02 = $data_form['D02'];
                    $d03 = $data_form['D03'];
                    $d04 = $data_form['D04'];
                    $d05 = $data_form['D05'];
                    $d06 = $data_form['D06'];
                    $d07 = $data_form['D07'];
                    $d08 = $data_form['D08'];
                    $d09 = $data_form['D09'];
                    $d10 = $data_form['D10'];
                    $d11 = $data_form['D11'];
                    $d12 = $data_form['D12'];
                    $d13 = $data_form['D13'];
                    $d14 = $data_form['D14'];
                    $d15 = $data_form['D15'];
                    $d16 = $data_form['D16'];
                    $d17 = $data_form['D17'];
                    $d18 = $data_form['D18'];
                    $d19 = $data_form['D19'];
                    $d20 = $data_form['D20'];
                    $d21 = $data_form['D21'];
                    $d22 = $data_form['D22'];
                    $d23 = $data_form['D23'];
                    $d24 = $data_form['D24'];
                    $d25 = $data_form['D25'];
                    $d26 = $data_form['D26'];
                    $d27 = $data_form['D27'];
                    $d28 = $data_form['D28'];
                    $d29 = $data_form['D29'];
                    $d30 = $data_form['D30'];
                    $d31 = $data_form['D31'];
                    $serv_count = $data_form['SERV_COUNT'];


                    //ADD FIELDS HERE >> END


                }
                unset($data_form);
                unset($inputs);
            } else {
                // Defaults for new record
                $status = 'Aberto';
                $year = date('Y');
                $month = date('n');
                $d01 = $d02 = $d03 = $d04 = $d05 = $d06 = $d07 = $d08 = $d09 = $d10 =
                $d11 = $d12 = $d13 = $d14 = $d15 = $d16 = $d17 = $d18 = $d19 = $d20 =
                $d21 = $d22 = $d23 = $d24 = $d25 = $d26 = $d27 = $d28 = $d29 = $d30 = $d31 = '100';
            }

                //START TO LOAD THE UPDATE FORM:
                $output .= '<div class="row align-items-center">
                                <div class="col-sm-1">
                                    <label for="id" class="medium-label">Id:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="id" type="text" size="8" name="Id" readonly value="'.$id.'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="year" class="medium-label">Ano:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="year" type="number" min="2000" max="2100" name="Year" value="'.$year.'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="month" class="medium-label">Mês:</label>
                                </div>
                                <div class="col-sm-1">
                                    <input id="month" type="number" min="1" max="12" name="Month" value="'.$month.'">
                                </div>
                                <div class="col-sm-4 text-right">
                                    <button id="calc_btn" type="button" class="btn btn-info btn-sm m-1">Calcular</button>
                                    <input id="save_top" class="btn btn-primary btn-sm m-1" type="submit" value="Salvar" formaction="../PreClosing/update_call">
                                    <button id="batch_btn" type="button" class="btn btn-warning btn-sm m-1">Criar/Atualizar Comissões</button>
                                    <input id="created_by" type="hidden" name="Created_By" value="'.$created_by.'" readonly>
                                    <input id="updated_by" type="hidden" name="Updated_By" value="'.$updated_by.'" readonly>
                                    <input id="temp_id_employee" type="hidden" value="'.$temp_id_employee.'" readonly>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="serv_count" class="medium-label">Banhos:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="serv_count" type="text" name="Serv_Count" value="'.$serv_count.'" readonly>
                                </div>
                                <div class="col-sm-4">
                                    
                                </div>
                                <div class="col-sm-2 text-right">
                                    <label for="number_banhistas" class="medium-label">Nº Banhistas:</label>
                                </div>
                                <div class="col-sm-2">
                                    <input id="number_banhistas" type="number" min="0" step="1" name="Number_Banhistas" value="" style="width:100%;">
                                    <input id="banhistas_param_id" type="hidden" value="new">
                                    <input id="banhistas_param_type" type="hidden" value="BAN_PRE_CLOSING">
                                </div>
                                <div class="col-sm-1">
                                    <button id="banhistas_update_btn" type="button" class="btn btn-sm btn-primary" style="width:100%;">Update</button>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="id_employee" class="medium-label">Funcionário:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="id_employee" name="Id_Employee"></select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="status" class="medium-label">Status:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="status_display" disabled>
                                        <option class="medium-label" value="Aberto" '.(($status == 'Aberto')?"selected":"").'>Aberto</option>
                                        <option class="medium-label" value="Fechado" '.(($status == 'Fechado')?"selected":"").'>Fechado</option>
                                    </select>
                                    <input type="hidden" id="status" name="Status" value="'.$status.'">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="comission_prod" class="medium-label">Comis Prod:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="comission_prod" type="text" size="15" name="Comission_Prod" value="'.$comission_prod.'" readonly>
                                </div>
                                <div class="col-sm-1">
                                    <label for="comission_serv" class="medium-label">Comis Serv:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="comission_serv" type="text" size="15" name="Comission_Serv" value="'.$comission_serv.'" readonly>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1"><label for="d01" class="medium-label" style="font-size:12px;">D01:</label></div>
                                <div class="col-sm-1"><input id="d01" type="text" name="D01" value="'.$d01.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d02" class="medium-label" style="font-size:12px;">D02:</label></div>
                                <div class="col-sm-1"><input id="d02" type="text" name="D02" value="'.$d02.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d03" class="medium-label" style="font-size:12px;">D03:</label></div>
                                <div class="col-sm-1"><input id="d03" type="text" name="D03" value="'.$d03.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d04" class="medium-label" style="font-size:12px;">D04:</label></div>
                                <div class="col-sm-1"><input id="d04" type="text" name="D04" value="'.$d04.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d05" class="medium-label" style="font-size:12px;">D05:</label></div>
                                <div class="col-sm-1"><input id="d05" type="text" name="D05" value="'.$d05.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d06" class="medium-label" style="font-size:12px;">D06:</label></div>
                                <div class="col-sm-1"><input id="d06" type="text" name="D06" value="'.$d06.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1"><label for="d07" class="medium-label" style="font-size:12px;">D07:</label></div>
                                <div class="col-sm-1"><input id="d07" type="text" name="D07" value="'.$d07.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d08" class="medium-label" style="font-size:12px;">D08:</label></div>
                                <div class="col-sm-1"><input id="d08" type="text" name="D08" value="'.$d08.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d09" class="medium-label" style="font-size:12px;">D09:</label></div>
                                <div class="col-sm-1"><input id="d09" type="text" name="D09" value="'.$d09.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d10" class="medium-label" style="font-size:12px;">D10:</label></div>
                                <div class="col-sm-1"><input id="d10" type="text" name="D10" value="'.$d10.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d11" class="medium-label" style="font-size:12px;">D11:</label></div>
                                <div class="col-sm-1"><input id="d11" type="text" name="D11" value="'.$d11.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d12" class="medium-label" style="font-size:12px;">D12:</label></div>
                                <div class="col-sm-1"><input id="d12" type="text" name="D12" value="'.$d12.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1"><label for="d13" class="medium-label" style="font-size:12px;">D13:</label></div>
                                <div class="col-sm-1"><input id="d13" type="text" name="D13" value="'.$d13.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d14" class="medium-label" style="font-size:12px;">D14:</label></div>
                                <div class="col-sm-1"><input id="d14" type="text" name="D14" value="'.$d14.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d15" class="medium-label" style="font-size:12px;">D15:</label></div>
                                <div class="col-sm-1"><input id="d15" type="text" name="D15" value="'.$d15.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d16" class="medium-label" style="font-size:12px;">D16:</label></div>
                                <div class="col-sm-1"><input id="d16" type="text" name="D16" value="'.$d16.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d17" class="medium-label" style="font-size:12px;">D17:</label></div>
                                <div class="col-sm-1"><input id="d17" type="text" name="D17" value="'.$d17.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d18" class="medium-label" style="font-size:12px;">D18:</label></div>
                                <div class="col-sm-1"><input id="d18" type="text" name="D18" value="'.$d18.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1"><label for="d19" class="medium-label" style="font-size:12px;">D19:</label></div>
                                <div class="col-sm-1"><input id="d19" type="text" name="D19" value="'.$d19.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d20" class="medium-label" style="font-size:12px;">D20:</label></div>
                                <div class="col-sm-1"><input id="d20" type="text" name="D20" value="'.$d20.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d21" class="medium-label" style="font-size:12px;">D21:</label></div>
                                <div class="col-sm-1"><input id="d21" type="text" name="D21" value="'.$d21.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d22" class="medium-label" style="font-size:12px;">D22:</label></div>
                                <div class="col-sm-1"><input id="d22" type="text" name="D22" value="'.$d22.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d23" class="medium-label" style="font-size:12px;">D23:</label></div>
                                <div class="col-sm-1"><input id="d23" type="text" name="D23" value="'.$d23.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d24" class="medium-label" style="font-size:12px;">D24:</label></div>
                                <div class="col-sm-1"><input id="d24" type="text" name="D24" value="'.$d24.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1"><label for="d25" class="medium-label" style="font-size:12px;">D25:</label></div>
                                <div class="col-sm-1"><input id="d25" type="text" name="D25" value="'.$d25.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d26" class="medium-label" style="font-size:12px;">D26:</label></div>
                                <div class="col-sm-1"><input id="d26" type="text" name="D26" value="'.$d26.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d27" class="medium-label" style="font-size:12px;">D27:</label></div>
                                <div class="col-sm-1"><input id="d27" type="text" name="D27" value="'.$d27.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d28" class="medium-label" style="font-size:12px;">D28:</label></div>
                                <div class="col-sm-1"><input id="d28" type="text" name="D28" value="'.$d28.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d29" class="medium-label" style="font-size:12px;">D29:</label></div>
                                <div class="col-sm-1"><input id="d29" type="text" name="D29" value="'.$d29.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                                <div class="col-sm-1"><label for="d30" class="medium-label" style="font-size:12px;">D30:</label></div>
                                <div class="col-sm-1"><input id="d30" type="text" name="D30" value="'.$d30.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1"><label for="d31" class="medium-label" style="font-size:12px;">D31:</label></div>
                                <div class="col-sm-1"><input id="d31" type="text" name="D31" value="'.$d31.'" style="width:100%; font-size:12px; padding:0 2px;"></div>
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

    // Auxiliary AJAX: fetch BAN_PRE_CLOSING param by Year+Month
    // Returns string: "<ID>|<VALUE>" or "new|" if not found
    public function load_banhistas_info($inputs){
        $year = isset($inputs['Year']) ? trim($inputs['Year']) : '';
        $month = isset($inputs['Month']) ? trim($inputs['Month']) : '';
        if ($year === '' || $month === '') {
            return 'new|';
        }
        // Ensure month is 2 digits
        $month = str_pad((string)intval($month), 2, '0', STR_PAD_LEFT);
        $name = $year.$month; // e.g., 202510

    // Reuse Params controller to fetch
    $paramsCtrl = instantiate('\\Controller\\' . 'Params');
        $res = $paramsCtrl->getParamValue('BAN_PRE_CLOSING', $name, 'Ativo');
        if ($res === false) {
            return 'new|';
        }
        // $res is likely an object with ID and VALUE
        $id = $res->ID ?? 'new';
        $val = $res->VALUE ?? '';
        return $id.'|'.$val;
    }

    //LOAD HTML FOR LISTING RECORDS IN TABLE
    public function load_rows(){
        
        //restart_session();
        $preclosing_edit_check = check_permission($_SESSION['username'], "pre_closing_edit");
        $preclosing_delete_check = check_permission($_SESSION['username'], "pre_closing_delete");
        $output = "";
    $model = instantiate('\\Model\\' . $this->UCF_object);
        
        $data = $model->listAll();
        if(f_countAll("PreClosing")>0){
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Ano</th>
                                <th>Mês</th>
                                <th>Funcionário</th>
                                <th>Comis_Prod</th>
                                <th>Comis_Serv</th>
                                <th>Status</th>
                                <th>Banhos</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($data as $row) {

                $inputs_employee['ID']=$id_employee=$row->ID_EMPLOYEE;
                $data_form_employee['NAME']="";
                if (!($id_employee=="")) {
                    $employee_model = instantiate('\\Model\\'.$this->parent_object);
                    $employee_data = $employee_model->getRow($inputs_employee);
        
                    if($employee_data){
                        foreach ($employee_data as $key => $value) {
                            $data_form_employee[$key]=$value;
                        }
                    }    
                }

                $output .='<tr class="text-center text-secondary">
                            <td>'.$row->ID.'</td>
                            <td>'.$row->UPDATED.'</td>
                            <td>'.$row->YEAR.'</td>
                            <td>'.$row->MONTH.'</td>
                            <td>'.$data_form_employee['NAME'].'</td>
                            <td>'.$row->COMISSION_PROD.'</td>
                            <td>'.$row->COMISSION_SERV.'</td>
                            <td>'.$row->STATUS.'</td>
                            <td>'.$row->SERV_COUNT.'</td>
                            <td>
                                '.(($preclosing_edit_check) ? '<a href="'.ROOT."/$this->UCF_object/_new?id=$row->ID".'" title="Edit" class="text-primary updateBtn" id="'.$row->ID.'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;' : '').'
                                '.(($preclosing_delete_check) ? '<a href="'.ROOT."/$this->UCF_object/_delete?id=$row->ID".'" title="Delete" class="text-danger deleteBtn" id="'.$row->ID.'"><i class="fas fa-eraser"></i></a>' : '').'
                            </td></tr>';
            }
            $output .= '</tbody>
                        <tfoot>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Ano</th>
                                <th>Mês</th>
                                <th>Funcionário</th>
                                <th>Comis_Prod</th>
                                <th>Comis_Serv</th>
                                <th>Status</th>
                                <th>Banhos</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>';
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

    // Compute commissions (single calc or batch save)
    // Allowed via Ajax_call allowed methods list as update_comission
        public function update_comission($inputs){
        // Log entrada do método - PRIMEIRO LOG
        amm_log("PRE_CLOSING: === INICIO update_comission ===");
        
        try {
            amm_log("PRE_CLOSING: update_comission chamado com inputs: " . json_encode($inputs));
            
            // Sanitize inputs
            $year = isset($inputs['Year']) ? intval($inputs['Year']) : 0;
            $month = isset($inputs['Month']) ? intval($inputs['Month']) : 0;
            amm_log("PRE_CLOSING: Ano processado: $year, Mês processado: $month");
            
            if ($year <= 0 || $month <= 0) {
                amm_log("PRE_CLOSING: Erro - Ano ou mês inválidos");
                if (function_exists('ob_get_level')) { while (ob_get_level() > 0) { @ob_end_clean(); } }
                header('Content-Type: text/plain; charset=utf-8');
                echo 'Informe Ano e Mês.';
                exit;
            }
        } catch (\Exception $e) {
            amm_log("PRE_CLOSING: Erro no início do método: " . $e->getMessage());
            throw $e;
        }

        $mode = isset($inputs['Mode']) ? strtolower(trim($inputs['Mode'])) : 'calc';
        amm_log("PRE_CLOSING: Modo de operação: $mode");

        // Batch mode: create/update for all active employees
        if ($mode === 'batch') {
            amm_log("PRE_CLOSING: Executando modo batch para todos os funcionários ativos");
            $supModel = instantiate('\\Model\\' . 'Supplier');
            $preModel = instantiate('\\Model\\' . 'PreClosing');
            $suppliers = $supModel->listWhere(['STATUS' => 'Ativo']);
            if (!$suppliers) {
                if (function_exists('ob_get_level')) { while (ob_get_level() > 0) { @ob_end_clean(); } }
                header('Content-Type: text/plain; charset=utf-8');
                echo 'Processados: 0 funcionário(s).';
                exit;
            }

            $count = 0;
            foreach ((array)$suppliers as $emp) {
                $empType = $emp->TYPE ?? '';
                $empName = $emp->NAME ?? '';
                $empId   = $emp->ID ?? 0;
                amm_log("PRE_CLOSING: Processando funcionário (batch) - ID: $empId, Nome: '$empName', Tipo: '$empType'");
                list($serv, $prod, $banhos) = $this->compute_commissions($year, $month, $empType, $empName, []);
                amm_log("PRE_CLOSING: Resultado cálculo (batch) - Serv: $serv, Prod: $prod, Banhos: $banhos");

                // Upsert into PRE_CLOSING by YEAR, MONTH, ID_EMPLOYEE
                $existing = $preModel->getRow(['YEAR'=>$year,'MONTH'=>$month,'ID_EMPLOYEE'=>$empId]);
                if ($existing) {
                    $preModel->update($existing->ID, [
                        'COMISSION_PROD' => number_format($prod, 2, '.', ''),
                        'COMISSION_SERV' => number_format($serv, 2, '.', ''),
                        'SERV_COUNT'     => intval($banhos),
                        'UPDATED_BY'     => $_SESSION['username'] ?? 'system',
                    ]);
                } else {
                    $insert = [
                        'CREATED_BY'     => $_SESSION['username'] ?? 'system',
                        'UPDATED_BY'     => $_SESSION['username'] ?? 'system',
                        'YEAR'           => $year,
                        'MONTH'          => $month,
                        'ID_EMPLOYEE'    => $empId,
                        'COMISSION_PROD' => number_format($prod, 2, '.', ''),
                        'COMISSION_SERV' => number_format($serv, 2, '.', ''),
                        'STATUS'         => 'Aberto',
                        'SERV_COUNT'     => intval($banhos),
                    ];
                    // default day factors 100
                    for ($d=1; $d<=31; $d++) {
                        $insert['D'.str_pad((string)$d,2,'0',STR_PAD_LEFT)] = '100';
                    }
                    $preModel->insert($insert);
                }
                $count++;
            }

            if (function_exists('ob_get_level')) { while (ob_get_level() > 0) { @ob_end_clean(); } }
            header('Content-Type: text/plain; charset=utf-8');
            echo 'Processados: ' . $count . ' funcionário(s).';
            exit;
        }

        // Single calculation (no persistence)
        amm_log("PRE_CLOSING: Executando cálculo individual");
        $empId = isset($inputs['Id_Employee']) ? intval($inputs['Id_Employee']) : 0;
        amm_log("PRE_CLOSING: ID do funcionário: $empId");
        if ($empId <= 0) {
            amm_log("PRE_CLOSING: Erro - ID do funcionário inválido");
            if (function_exists('ob_get_level')) { while (ob_get_level() > 0) { @ob_end_clean(); } }
            header('Content-Type: text/plain; charset=utf-8');
            echo 'Informe o Funcionário.';
            exit;
        }

        $supModel = instantiate('\\Model\\' . 'Supplier');
        $empRow = $supModel->getRow(['ID'=>$empId]);
        amm_log("PRE_CLOSING: Dados do funcionário encontrados: " . json_encode($empRow));
        if (!$empRow) {
            amm_log("PRE_CLOSING: Erro - Funcionário não encontrado no banco");
            if (function_exists('ob_get_level')) { while (ob_get_level() > 0) { @ob_end_clean(); } }
            header('Content-Type: text/plain; charset=utf-8');
            echo 'Funcionário inválido.';
            exit;
        }
        $empType = $empRow->TYPE ?? '';
        $empName = $empRow->NAME ?? '';
        $empRole = $empRow->ROLE ?? '';
        amm_log("PRE_CLOSING: Tipo do funcionário: '$empType', Nome: '$empName', Role: '$empRole'");

        // Collect day factors and optional banhistas from inputs
        $opts = [];
        $dayFactors = [];
        for ($d=1; $d<=31; $d++) {
            $k = 'D'.str_pad((string)$d,2,'0',STR_PAD_LEFT);
            if (isset($inputs[$k]) && $inputs[$k] !== '') {
                $dayFactors[$k] = floatval($inputs[$k]);
            }
        }
        if (!empty($dayFactors)) { $opts['dayFactors'] = $dayFactors; }
        if (isset($inputs['Number_Banhistas']) && $inputs['Number_Banhistas'] !== '') {
            $opts['numBanhistas'] = floatval($inputs['Number_Banhistas']);
        }
        // Pass employee data to avoid duplicate queries
        $opts['empData'] = $empRow;

        list($serv, $prod, $banhos) = $this->compute_commissions($year, $month, $empType, $empName, $opts);

        // Saída limpa no formato esperado pelo JS: OK|serv|prod|count
        $out = 'OK|' . number_format($serv, 2, '.', '') . '|' . number_format($prod, 2, '.', '') . '|' . intval($banhos);
        if (function_exists('ob_get_level')) { while (ob_get_level() > 0) { @ob_end_clean(); } }
        header('Content-Type: text/plain; charset=utf-8');
        echo $out;
        exit;
    }

    private function compute_commissions($year, $month, $employeeType, $employeeName, $opts){
    $orderModel = instantiate('\\Model\\' . 'OrderItem');
    $paramsCtrl = instantiate('\\Controller\\' . 'Params');

        // Log entrada da função
        amm_log("PRE_CLOSING: compute_commissions iniciado - Ano: $year, Mês: $month, Tipo: $employeeType, Nome: $employeeName");
        amm_log("PRE_CLOSING: Opções recebidas: " . json_encode($opts));

        // Month boundaries
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        amm_log("PRE_CLOSING: Dias no mês: $daysInMonth");

        // Fetch total baths per day (sum QUANTITY, not count rows)
        $sqlBath = "SELECT DAY(DATE) AS D, SUM(QUANTITY) AS CNT FROM ORDER_ITEM WHERE YEAR(DATE)=:YEAR AND MONTH(DATE)=:MONTH AND PROD_SERV_CATEGORY=:CAT GROUP BY DAY(DATE)";
        amm_log("PRE_CLOSING: Query banhos - SQL: $sqlBath");
        $rows = $orderModel->exec_sqlstm_query_with_bind($sqlBath, ['YEAR'=>$year,'MONTH'=>$month,'CAT'=>'Banho']);
        amm_log("PRE_CLOSING: Resultado query banhos: " . json_encode($rows));
        $bathCounts = [];
        $totalBaths = 0;
        if (is_array($rows)) {
            foreach ($rows as $r) {
                if (!is_object($r)) { continue; }
                $d = intval($r->D ?? 0);
                $c = intval($r->CNT ?? 0);
                if ($d > 0) {
                    $bathCounts[$d] = $c;
                    $totalBaths += $c;
                }
            }
        }
        amm_log("PRE_CLOSING: Total de banhos encontrados: $totalBaths");
        amm_log("PRE_CLOSING: Contagem por dia: " . json_encode($bathCounts));

        // Number of banhistas (from options or params)
        $numBanhistas = isset($opts['numBanhistas']) ? floatval($opts['numBanhistas']) : 0.0;
        amm_log("PRE_CLOSING: Número de banhistas das opções: $numBanhistas");
        if ($numBanhistas <= 0) {
            $name = $year . str_pad((string)$month, 2, '0', STR_PAD_LEFT);
            amm_log("PRE_CLOSING: Buscando parâmetro BAN_PRE_CLOSING com nome: $name");
            $p = $paramsCtrl->getParamValue('BAN_PRE_CLOSING', $name, 'Ativo');
            amm_log("PRE_CLOSING: Resultado do parâmetro: " . json_encode($p));
            if ($p && isset($p->VALUE) && $p->VALUE !== '') {
                $numBanhistas = floatval($p->VALUE);
                amm_log("PRE_CLOSING: Número de banhistas do parâmetro: $numBanhistas");
            }
        }
        if ($numBanhistas <= 0) { $numBanhistas = 1.0; } // avoid division by zero
        amm_log("PRE_CLOSING: Número final de banhistas usado: $numBanhistas");

        // Commission per bath parameter was previously used, but per new rule
        // the service commission is based solely on quantity, banhistas and day factors.

        // Day factors
        $dayFactors = [];
        for ($d=1; $d<=31; $d++) {
            $key = 'D'.str_pad((string)$d,2,'0',STR_PAD_LEFT);
            $dayFactors[$key] = 100.0;
        }
        if (isset($opts['dayFactors']) && is_array($opts['dayFactors'])) {
            foreach ($opts['dayFactors'] as $k=>$v) {
                $dayFactors[$k] = floatval($v);
            }
        }

        // Calculate service commission
        $serv = 0.0;
        amm_log("PRE_CLOSING: Iniciando cálculo de comissão de serviço para tipo: $employeeType");
        
        // Check if employee is a banhista (bath worker)
        $isBanhista = (strcasecmp($employeeType, 'Banhista') === 0);
        
        // If TYPE is "Funcionario", check ROLE field from employee data
        if (!$isBanhista && strcasecmp($employeeType, 'Funcionario') === 0) {
            // Use employee data if provided, otherwise query database
            $empData = isset($opts['empData']) ? $opts['empData'] : null;
            if (!$empData) {
                $supModel = instantiate('\\Model\\' . 'Supplier');
                $empData = $supModel->getRow(['NAME' => $employeeName]);
            }
            if ($empData && isset($empData->ROLE)) {
                $role = $empData->ROLE;
                amm_log("PRE_CLOSING: Funcionário tem ROLE: '$role'");
                $isBanhista = (strcasecmp($role, 'Banhista') === 0);
            }
        }
        
        if ($isBanhista) {
            amm_log("PRE_CLOSING: Calculando comissão para Banhista");
            for ($d=1; $d <= $daysInMonth; $d++) {
                $cnt = isset($bathCounts[$d]) ? floatval($bathCounts[$d]) : 0.0; // sum of QUANTITY for the day
                $factor = isset($dayFactors['D'.str_pad((string)$d,2,'0',STR_PAD_LEFT)]) ? floatval($dayFactors['D'.str_pad((string)$d,2,'0',STR_PAD_LEFT)]) : 100.0;
                $dailyComission = ($cnt / max(1.0, $numBanhistas)) * ($factor / 100.0);
                amm_log("PRE_CLOSING: Dia $d - Banhos: $cnt, Fator: $factor, Comissão dia: $dailyComission");
                // Per rule: (sumQty / No. Banhistas) * (DayFactor / 100)
                $serv += $dailyComission;
            }
            amm_log("PRE_CLOSING: Comissão total serviço (Banhista): $serv");
        } else {
            // Check if employee is veterinarian
            $isVeterinarian = (strcasecmp($employeeType, 'Veterinaria') === 0 || strcasecmp($employeeType, 'Veterinária') === 0);
            
            // If TYPE is "Funcionario", check ROLE field for veterinarian
            if (!$isVeterinarian && strcasecmp($employeeType, 'Funcionario') === 0) {
                // Use employee data if provided, otherwise query database
                $empData = isset($opts['empData']) ? $opts['empData'] : null;
                if (!$empData) {
                    $supModel = instantiate('\\Model\\' . 'Supplier');
                    $empData = $supModel->getRow(['NAME' => $employeeName]);
                }
                if ($empData && isset($empData->ROLE)) {
                    $role = $empData->ROLE;
                    amm_log("PRE_CLOSING: Funcionário tem ROLE: '$role' (verificando se é veterinário)");
                    $isVeterinarian = (strcasecmp($role, 'Veterinaria') === 0 || strcasecmp($role, 'Veterinária') === 0);
                }
            }
            
            if ($isVeterinarian) {
                amm_log("PRE_CLOSING: Calculando comissão para Veterinário");
            $sqlVet = "SELECT VALUE_WITH_DISCOUNT AS VWD, QUANTITY AS QTY, EXTERNAL_COST AS EXT_COST, COMISSION_PERCENTAGE AS PERC FROM ORDER_ITEM WHERE YEAR(DATE)=:YEAR AND MONTH(DATE)=:MONTH AND COST_CENTER=:CC";
            amm_log("PRE_CLOSING: Query veterinário - SQL: $sqlVet");
            $rowsVet = $orderModel->exec_sqlstm_query_with_bind($sqlVet, ['YEAR'=>$year,'MONTH'=>$month,'CC'=>'Veterinaria']);
            amm_log("PRE_CLOSING: Resultado query veterinário: " . json_encode($rowsVet));
            if (is_array($rowsVet)) {
                foreach ($rowsVet as $v) {
                    if (!is_object($v)) { continue; }
                    $vwd = floatval($v->VWD ?? 0);
                    $qty = floatval($v->QTY ?? 0);
                    $ext = floatval($v->EXT_COST ?? 0);
                    $perc= floatval($v->PERC ?? 0);
                    amm_log("PRE_CLOSING: Item veterinário - VWD: $vwd, QTY: $qty, EXT: $ext, PERC: $perc");
                    if ($qty > 0) {
                        $itemComission = ((($vwd / $qty) - $ext) * $qty) * $perc;
                        amm_log("PRE_CLOSING: Comissão item (qty > 0): $itemComission");
                        $serv += $itemComission;
                    } else {
                        $itemComission = ($vwd) * $perc;
                        amm_log("PRE_CLOSING: Comissão item (qty = 0): $itemComission");
                        $serv += $itemComission;
                    }
                }
            }
                amm_log("PRE_CLOSING: Comissão total serviço (Veterinário): $serv");
            } else {
                amm_log("PRE_CLOSING: Tipo de funcionário não reconhecido para comissão de serviço: $employeeType");
                $serv = 0.0;
            }
        }

        // Calculate product commission for salesperson
        $prod = 0.0;
        amm_log("PRE_CLOSING: Iniciando cálculo de comissão de produto para funcionário: '$employeeName'");
        if (!empty($employeeName)) {
            $sqlProd = "SELECT SUM(VALUE_WITH_DISCOUNT * COMISSION_PERCENTAGE) AS TOTAL FROM ORDER_ITEM WHERE YEAR(DATE)=:YEAR AND MONTH(DATE)=:MONTH AND SALESPERSON=:SP";
            amm_log("PRE_CLOSING: Query produto - SQL: $sqlProd");
            amm_log("PRE_CLOSING: Parâmetros query produto - YEAR: $year, MONTH: $month, SP: '$employeeName'");
            $sumRow = $orderModel->exec_sqlstm_query_with_bind($sqlProd, ['YEAR'=>$year,'MONTH'=>$month,'SP'=>$employeeName]);
            amm_log("PRE_CLOSING: Resultado query produto: " . json_encode($sumRow));
            if (is_array($sumRow)) {
                foreach ($sumRow as $sr) {
                    if (!is_object($sr)) { continue; }
                    $prod = floatval($sr->TOTAL ?? 0);
                    amm_log("PRE_CLOSING: Comissão produto encontrada: $prod");
                }
            }
        } else {
            amm_log("PRE_CLOSING: Nome do funcionário está vazio, comissão de produto será 0");
        }

        amm_log("PRE_CLOSING: Resultado final - Serviço: $serv, Produto: $prod, Total Banhos: $totalBaths");
        return [ $serv, $prod, $totalBaths ];
    }

}
