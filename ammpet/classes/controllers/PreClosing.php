<?php

namespace Controller;

restart_session();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class PreClosing {

    use _GlobalController;
    private $object = 'preclosing';
    private $UCF_object = 'PreClosing';
    private $parent_object = 'Supplier';

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
                $model = new('\Model\\'.$this->UCF_object);
                
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
            }

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
                                    <input id="temp_id_employee" type="hidden" name="Temp_Id_Employee" value="'.$temp_id_employee.'" readonly>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="year" class="medium-label">Ano:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="year" type="number" min="2000" max="2100" name="Year" value="'.$year.'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="month" class="medium-label">Mês:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="month" type="number" min="1" max="12" name="Month" value="'.$month.'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="id_employee" class="medium-label">Funcionário:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="id_employee" name="Id_Employee"></select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="comission_prod" class="medium-label">Comis Prod:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="comission_prod" type="text" size="15" name="Comission_Prod" value="'.$comission_prod.'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="comission_serv" class="medium-label">Comis Serv:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="comission_serv" type="text" size="15" name="Comission_Serv" value="'.$comission_serv.'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="status" class="medium-label">Status:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="status" name="Status">
                                        <option class="medium-label" value="Ativo" '.(($status == 'Ativo')?"selected":"").'>Ativo</option>
                                        <option class="medium-label" value="Desativado" '.(($status == 'Desativado')?"selected":"").'>Desativado</option>
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1"><label for="d01" class="medium-label">D01:</label></div>
                                <div class="col-sm-1"><input id="d01" type="text" name="D01" value="'.$d01.'"></div>
                                <div class="col-sm-1"><label for="d02" class="medium-label">D02:</label></div>
                                <div class="col-sm-1"><input id="d02" type="text" name="D02" value="'.$d02.'"></div>
                                <div class="col-sm-1"><label for="d03" class="medium-label">D03:</label></div>
                                <div class="col-sm-1"><input id="d03" type="text" name="D03" value="'.$d03.'"></div>
                                <div class="col-sm-1"><label for="d04" class="medium-label">D04:</label></div>
                                <div class="col-sm-1"><input id="d04" type="text" name="D04" value="'.$d04.'"></div>
                                <div class="col-sm-1"><label for="d05" class="medium-label">D05:</label></div>
                                <div class="col-sm-1"><input id="d05" type="text" name="D05" value="'.$d05.'"></div>
                                <div class="col-sm-1"><label for="d06" class="medium-label">D06:</label></div>
                                <div class="col-sm-1"><input id="d06" type="text" name="D06" value="'.$d06.'"></div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1"><label for="d07" class="medium-label">D07:</label></div>
                                <div class="col-sm-1"><input id="d07" type="text" name="D07" value="'.$d07.'"></div>
                                <div class="col-sm-1"><label for="d08" class="medium-label">D08:</label></div>
                                <div class="col-sm-1"><input id="d08" type="text" name="D08" value="'.$d08.'"></div>
                                <div class="col-sm-1"><label for="d09" class="medium-label">D09:</label></div>
                                <div class="col-sm-1"><input id="d09" type="text" name="D09" value="'.$d09.'"></div>
                                <div class="col-sm-1"><label for="d10" class="medium-label">D10:</label></div>
                                <div class="col-sm-1"><input id="d10" type="text" name="D10" value="'.$d10.'"></div>
                                <div class="col-sm-1"><label for="d11" class="medium-label">D11:</label></div>
                                <div class="col-sm-1"><input id="d11" type="text" name="D11" value="'.$d11.'"></div>
                                <div class="col-sm-1"><label for="d12" class="medium-label">D12:</label></div>
                                <div class="col-sm-1"><input id="d12" type="text" name="D12" value="'.$d12.'"></div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1"><label for="d13" class="medium-label">D13:</label></div>
                                <div class="col-sm-1"><input id="d13" type="text" name="D13" value="'.$d13.'"></div>
                                <div class="col-sm-1"><label for="d14" class="medium-label">D14:</label></div>
                                <div class="col-sm-1"><input id="d14" type="text" name="D14" value="'.$d14.'"></div>
                                <div class="col-sm-1"><label for="d15" class="medium-label">D15:</label></div>
                                <div class="col-sm-1"><input id="d15" type="text" name="D15" value="'.$d15.'"></div>
                                <div class="col-sm-1"><label for="d16" class="medium-label">D16:</label></div>
                                <div class="col-sm-1"><input id="d16" type="text" name="D16" value="'.$d16.'"></div>
                                <div class="col-sm-1"><label for="d17" class="medium-label">D17:</label></div>
                                <div class="col-sm-1"><input id="d17" type="text" name="D17" value="'.$d17.'"></div>
                                <div class="col-sm-1"><label for="d18" class="medium-label">D18:</label></div>
                                <div class="col-sm-1"><input id="d18" type="text" name="D18" value="'.$d18.'"></div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1"><label for="d19" class="medium-label">D19:</label></div>
                                <div class="col-sm-1"><input id="d19" type="text" name="D19" value="'.$d19.'"></div>
                                <div class="col-sm-1"><label for="d20" class="medium-label">D20:</label></div>
                                <div class="col-sm-1"><input id="d20" type="text" name="D20" value="'.$d20.'"></div>
                                <div class="col-sm-1"><label for="d21" class="medium-label">D21:</label></div>
                                <div class="col-sm-1"><input id="d21" type="text" name="D21" value="'.$d21.'"></div>
                                <div class="col-sm-1"><label for="d22" class="medium-label">D22:</label></div>
                                <div class="col-sm-1"><input id="d22" type="text" name="D22" value="'.$d22.'"></div>
                                <div class="col-sm-1"><label for="d23" class="medium-label">D23:</label></div>
                                <div class="col-sm-1"><input id="d23" type="text" name="D23" value="'.$d23.'"></div>
                                <div class="col-sm-1"><label for="d24" class="medium-label">D24:</label></div>
                                <div class="col-sm-1"><input id="d24" type="text" name="D24" value="'.$d24.'"></div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1"><label for="d25" class="medium-label">D25:</label></div>
                                <div class="col-sm-1"><input id="d25" type="text" name="D25" value="'.$d25.'"></div>
                                <div class="col-sm-1"><label for="d26" class="medium-label">D26:</label></div>
                                <div class="col-sm-1"><input id="d26" type="text" name="D26" value="'.$d26.'"></div>
                                <div class="col-sm-1"><label for="d27" class="medium-label">D27:</label></div>
                                <div class="col-sm-1"><input id="d27" type="text" name="D27" value="'.$d27.'"></div>
                                <div class="col-sm-1"><label for="d28" class="medium-label">D28:</label></div>
                                <div class="col-sm-1"><input id="d28" type="text" name="D28" value="'.$d28.'"></div>
                                <div class="col-sm-1"><label for="d29" class="medium-label">D29:</label></div>
                                <div class="col-sm-1"><input id="d29" type="text" name="D29" value="'.$d29.'"></div>
                                <div class="col-sm-1"><label for="d30" class="medium-label">D30:</label></div>
                                <div class="col-sm-1"><input id="d30" type="text" name="D30" value="'.$d30.'"></div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1"><label for="d31" class="medium-label">D31:</label></div>
                                <div class="col-sm-1"><input id="d31" type="text" name="D31" value="'.$d31.'"></div>
                                <div class="col-sm-1"><label for="serv_count" class="medium-label">Banhos:</label></div>
                                <div class="col-sm-1"><input id="serv_count" type="text" name="Serv_Count" value="'.$serv_count.'"></div>
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
        $preclosing_edit_check = check_permission($_SESSION['username'], "pre_closing_edit");
        $preclosing_delete_check = check_permission($_SESSION['username'], "pre_closing_delete");
        $output = "";
        $model = new('\Model\\'.$this->UCF_object);
        
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

}
