<?php

namespace Controller;

//if(session_status() === PHP_SESSION_NONE) session_start();

restart_session();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class Salary {

    use _GlobalController;
    private $object = 'salary';
    private $UCF_object = 'Salary';
    private $parent_object = 'Supplier';

    public function index()
    {
    }

    //SESSION TO LOAD HTML FORMS:

    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_salary_form(){

        if (isset($_GET['id'])){

            //if(session_status() === PHP_SESSION_NONE) session_start();
            //restart_session();

            $output = "";

            //DEFINIR VARIAVEIS PARA OS INPUTS:
            $created_by=$_SESSION['username'];
            $updated_by=$_SESSION['username'];
            $id="new";
            $date=date('Y-m-d');
            $inputs['ID']="new";
            $id_employee="XXXX";
            $temp_id_employee="XXXX";
            $salary_item_type=$data_form_type="Selecione uma opção";
            $salary_item_value=0.00;
            $status="Aberto";
            $salary_item_description=null;
            $original_value=0.00;
            $postponed_value=0.00;
        
            if (!($_GET['id']=='new')) {
            
                $inputs['ID']=$_GET['id'];
                $id=$_GET['id'];
                $model = new('\Model\\'.$this->UCF_object);
                
                $data = $model->getRow($inputs);

                if($data){

                    foreach ($data as $key => $value) {
                        $data_form[$key]=$value;
                    }

                    //REDEFINE VARIABLES FOR INPUTS BASED ON DB VALUES
                    $status=$data_form['SALARY_ITEM_STATUS'];
                    $updated_by=$_SESSION['username'];
                    $created_by=$data_form['CREATED_BY'];
                    $id=$data_form['ID'];
                    $date=$data_form['REF_DATE'];
                    $id_employee=$data_form['ID_EMPLOYEE'];
                    $temp_id_employee=$data_form['ID_EMPLOYEE'];
                    $salary_item_type=$data_form['SALARY_ITEM_TYPE'];
                    $data_form_type = $data_form['SALARY_ITEM_TYPE'];
                    $salary_item_value=$data_form['SALARY_ITEM_VALUE'];
                    $salary_item_description=$data_form['SALARY_ITEM_DESCRIPTION'];
                    $original_value=$data_form['ORIGINAL_VALUE'];
                    $postponed_value=$data_form['POSTPONED_VALUE'];
                
                }    
            }
            
            //FOR EACH DROPDOWN GET $data_form and send to load_options_update to get the selected option
            $type_option_list = load_options_update("SALARY_TYPE", "Ativo", $data_form_type);

            //START TO LOAD THE UPDATE FORM:
            $output .= '<div class="row">
                            <input id="created_by" type="hidden" name="Created_By" value="'.$created_by.'">
                            <input id="updated_by" type="hidden" name="Updated_by" value="'.$updated_by.'">
                            <input id="temp_id_employee" type="hidden" name="Temp_Id_Employee" value="'.$temp_id_employee.'">
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="id" class="medium-label">Id:</label>
                            </div>
                            <div class="col-sm-3">
                                <input id="id" type="text" size="8" name="Id" readonly value="'.$id.'">
                            </div>
                            <div class="col-sm-1">
                                <label for="id_employee" class="medium-label">Funcionário:</label>
                            </div>
                            <div class="col-sm-3">
                                <select class="medium-label" id="id_employee" name="Id_Employee">
                                    
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <label for="ref_date" class="medium-label">Data:</label>
                            </div>
                            <div class="col-sm-3">
                                <input id="ref_date" type="date" size="30" name="Ref_Date" value="'.$date.'"><br>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="salary_item_type" class="medium-label">Tipo de Movimento:</label>
                            </div>
                            <div class="col-sm-3">
                                <select class="medium-label" id="salary_item_type" name="Salary_Item_Type">
                                    '.$type_option_list.'
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <label for="salary_item_value" class="medium-label">Valor:</label>
                            </div>
                            <div class="col-sm-3">
                                <input id="salary_item_value" type="text" size="20" name="Salary_Item_Value" value="'.$salary_item_value.'">
                            </div>
                            <div class="col-sm-1">
                                <label for="salary_item_status" class="medium-label">Status:</label>
                            </div>
                            <div class="col-sm-3">
                                <select class="medium-label" id="salary_item_status" name="Salary_Item_Status">
                                        <option class="medium-label" value="Aberto" '.(($status == 'Aberto')?"selected":"").'>Aberto</option>
                                        <option class="medium-label" value="Confirmado" '.(($status == 'Confirmado')?"selected":"").'>Confirmado</option>
                                        <option class="medium-label" value="Fechado" '.(($status == 'Fechado')?"selected":"").'>Fechado</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="original_value" class="medium-label">Valor Original:</label>
                            </div>
                            <div class="col-sm-3">
                                <input id="original_value" type="text" size="20" readonly name="Original_Value" value="'.$original_value.'">
                            </div>
                            <div class="col-sm-1">
                                <label for="postponed_value" class="medium-label">Valor Postergado:</label>
                            </div>
                            <div class="col-sm-3">
                                <input id="postponed_value" type="text" size="20" name="Postponed_Value" value="'.$postponed_value.'">
                            </div>
                            <div class="col-sm-1">
                                <label for="salary_item_description" class="medium-label">Descrição:</label>
                            </div>
                            <div class="col-sm-3">
                                <input id="salary_item_description" type="text" size="35" name="Salary_Item_Description" value="'.$salary_item_description.'">
                            </div>
                        </div>
                        ';
            
            if ($id=="new") {
                $output .= '<div class="row">
                                <div class="col-sm-6">
                                    <a href="'.ROOT.'/Salary/_list" class="btn btn-secondary btn-lg m-1 btn-block">Voltar</a>
                                </div>
                                <div class="col-sm-6">
                                    <input id="save_submit" class="btn btn-primary btn-lg m-1 btn-block" type="save_submit" value="Salvar" formaction="../Salary/insert_call">
                                </div>
                            </div>';
            } else {
                $output .= '<div class="row">
                                <div class="col-sm-6">
                                    <a href="'.ROOT.'/Salary/_list" class="btn btn-secondary btn-lg m-1 btn-block">Voltar</a>
                                </div>
                                <div class="col-sm-6">
                                    <input id="save_submit" class="btn btn-primary btn-lg m-1 btn-block" type="save_submit" value="Salvar" formaction="../Salary/update_call?id='.$id.'">
                                </div>
                            </div>';
            }

            $output .= '<div class="row">
                            <div class="col-sm-6">
                                <input id="postpone_submit" class="btn btn-info btn-lg m-1 btn-block" type="postpone_submit" value="Adiar Valor" formaction="../Salary/postpone_value?id='.$id.'">
                            </div>
                            <div class="col-sm-6">
                            </div>
                        </div>';
            
            $sql_stm = null;
            unset_array($inputs);
            $data = null;
            $model = null;
            echo $output;

        }

    }

    //LOAD HTML FOR LISTING RECORDS IN TABLE
    public function load_rows(){
           
        //restart_session();
        $salary_edit_check = check_permission($_SESSION['username'], "salary_edit");
        $salary_delete_check = check_permission($_SESSION['username'], "salary_delete");
        $output = "";
        //$model = new \Model\Params;
        $model = new('\Model\\'.$this->UCF_object);
        
        $data = $model->listAll();
        if($data){

            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Funcionário</th>
                                <th>Tipo Movimentação</th>
                                <th>Data</th>
                                <th>Valor</th>
                                <th>Status</th>
                                <th>Valor Original</th>
                                <th>Valor Postergado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($data as $row) {

                $inputs_employee['ID']=$id_employee=$row->ID_EMPLOYEE;
                $data_form_employee['NAME']="";
                if (!($id_employee=="")) {
                    $employee_model = new('\Model\\'.$this->parent_object);
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
                            <td>'.$data_form_employee['NAME'].'</td>
                            <td>'.$row->SALARY_ITEM_TYPE.'</td>
                            <td>'.$row->REF_DATE.'</td>
                            <td>'.$row->SALARY_ITEM_VALUE.'</td>
                            <td>'.$row->SALARY_ITEM_STATUS.'</td>
                            <td>'.$row->ORIGINAL_VALUE.'</td>
                            <td>'.$row->POSTPONED_VALUE.'</td>
                            <td>
                                '.(($salary_edit_check) ? '<a href="'.ROOT."/$this->UCF_object/_new?id=$row->ID".'" title="Edit" class="text-primary updateBtn" id="'.$row->ID.'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;' : '').'
                                '.(($salary_delete_check) ? '<a href="'.ROOT."/$this->UCF_object/_delete?id=$row->ID".'" title="Delete" class="text-danger deleteBtn" id="'.$row->ID.'"><i class="fas fa-eraser"></i></a>' : '').'
                            </td>
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

    public function postpone_value(){
        if (isset($_GET['id'])){
            
            //PREPARE VALUES TO BE INSERTED LATER
            $_POST['Created_By2']=$_SESSION['username'];
            $_POST['Updated_By2']=$_SESSION['username'];
            $_POST['Salary_Item_Value2']=$_POST['Postponed_Value'];
            $_POST['Salary_Item_Type2']=$_POST['Salary_Item_Type'];
            $_POST['Id_Employee2']=$_POST['Id_Employee'];
            $_POST['Ref_Date2']=addTime($_POST['Ref_Date'],0,1,0);
            $_POST['Salary_Item_Status2']="Aberto";
            $_POST['Salary_Item_Description2']="Adiado do item: ".$_POST['Id']." -- Valor Original: R$ ".$_POST['Salary_Item_Value'];

            //DEFINE UPDATES IN CURRENT VALUE
            if ($_POST['Postponed_Value'] == $_POST['Salary_Item_Value']) {
                $_POST['Original_Value']=$_POST['Salary_Item_Value'];
                $_POST['Salary_Item_Value']=0.00;
                $_POST['Salary_Item_Status']="Fechado";
                $_POST['Salary_Item_Description']="Data: ".date('Y-m-d')." -- Valor adiado: ".$_POST['Postponed_Value'];
                
            } else {
                $_POST['Original_Value']=$_POST['Salary_Item_Value'];
                $_POST['Salary_Item_Value']=$_POST['Salary_Item_Value'] - $_POST['Postponed_Value'];
                $_POST['Salary_Item_Description']="Data: ".date('Y-m-d')." -- Valor adiado: ".$_POST['Postponed_Value'];
            }

            //CALLS UPDATE FOR CURRENT RECORD
            $_SERVER['REQUEST_METHOD']="POST";
           
            $_POST['class']="Salary";
            $_POST['method']="update_call";
            $_POST['type']="static";

            $ajax_call = new('\Controller\\'."Ajax_call");
            $ajax_call->index();
            
            //INSERT NEW RECORD WITH POSTPONED VALEU:

        }
    }

    public function postpone_value_ajax($inputs){
        if (isset($inputs['Id'])){
            
            //PREPARE VALUES TO BE INSERTED LATER - THEY ARE USED IN GLOBAL CONTROLLER - UPDATE CALL
            $_POST['Created_By2']=$_SESSION['username'];
            $_POST['Updated_By2']=$_SESSION['username'];
            $_POST['Salary_Item_Value2']=$inputs['Postponed_Value'];
            $_POST['Salary_Item_Type2']=$inputs['Salary_Item_Type'];
            $_POST['Id_Employee2']=$inputs['Id_Employee'];
            $_POST['Ref_Date2']=addTime($inputs['Ref_Date'],0,1,0);
            $_POST['Salary_Item_Status2']="Aberto";
            $_POST['Salary_Item_Description2']="Adiado do item: ".$inputs['Id']." -- Valor Original: R$ ".$inputs['Salary_Item_Value'];

            //DEFINE UPDATES IN CURRENT VALUE
            if ($_POST['Postponed_Value'] == $inputs['Salary_Item_Value']) {
                $_POST['Original_Value']=$inputs['Salary_Item_Value'];
                $_POST['Salary_Item_Value']=0.00;
                $_POST['Salary_Item_Status']="Fechado";
                $_POST['Salary_Item_Description']="Data: ".date('Y-m-d')." -- Valor adiado: ".$inputs['Postponed_Value'];
                
            } else {
                $_POST['Original_Value']=$inputs['Salary_Item_Value'];
                $_POST['Salary_Item_Value']=$inputs['Salary_Item_Value'] - $inputs['Postponed_Value'];
                $_POST['Salary_Item_Description']="Data: ".date('Y-m-d')." -- Valor adiado: ".$inputs['Postponed_Value'];
            }

            //CALLS UPDATE FOR CURRENT RECORD
            $_SERVER['REQUEST_METHOD']="POST";
            
            $_POST['Id'] = $inputs['Id'];
            $_POST['class']="Salary";
            $_POST['method']="update_call";
            $_POST['type']="static";

            $ajax_call = new('\Controller\\'."Ajax_call");
            $ajax_call->index();

        }
    }

    public function close_period($inputs){
        $year=$inputs['Year'];
        $month=$inputs['Month'];
        // Select all from year + month status Confirmado
        // Create new for the same day next month status Aberto
        // Update previous month to status Fechado
        // 
        return "Ano:".$year."/Mês".$month;
    }
    
    public function update_comission($inputs){
        $year=$inputs['Year'];
        $month=$inputs['Month'];
        return "Ano:".$year."/Mês".$month;
    }

    public function batch_confirm($inputs){
        $year=$inputs['Year'];
        $month=$inputs['Month'];
        //Select all from year + month status <> Confimado

        $inputs_salary['SALARY_ITEM_STATUS']='Aberto';
        $salary_model = new('\Model\\'."Salary");

        $salary_tobe_count = $salary_model->countWhere($inputs_salary);
        foreach ($salary_tobe_count as $row_item) {
            $total_items = $row_item->COUNTW;
        }
        $has_items = false;
        if (($total_items > 0)) {
            $has_items = true;
        }

        if ($has_items) {
            $salary_result = $salary_model->listWhere($inputs_salary);
            $inputs_update['ID']="";
            foreach ($salary_result as $row) {
                $inputs_update['ID'].=$row->ID.",";
            }
            $inputs_update['ID'] = trim($inputs_update['ID'],",");
            $inputs_update['SALARY_ITEM_STATUS']="Confirmado";
            $inputs_update['YEAR']=$year;
            $inputs_update['MONTH']=$month;
            $sql_stm="UPDATE SALARY SET SALARY_ITEM_STATUS=:SALARY_ITEM_STATUS WHERE YEAR(REF_DATE)=:YEAR AND MONTH(REF_DATE)=:MONTH AND ID IN (:ID)";
            $salary_update = $salary_model->exec_sqlstm_query_with_bind($sql_stm, $inputs_update);
            return "Sucesso:"+strval($salary_update);
        }
        else {
            return "Nenhum registro encontrado para Ano:".$year."/Mês".$month;
        }
        
    }

}