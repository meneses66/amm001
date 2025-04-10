<?php

namespace Controller;
if(session_status() === PHP_SESSION_NONE) session_start();

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

            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";

            //DEFINIR VARIAVEIS PARA OS INPUTS:
            $created_by=$_SESSION['username'];
            $updated_by=$_SESSION['username'];
            $id="new";
            $date=date('Y-m-d');
            $inputs['ID']="new";
            $id_employee="";
            $temp_id_employee="";
            $salary_item_type=$data_form_type="Selecione uma opção";
            $salary_item_value="0";
            $status="Aberto";
            $salary_item_description=null;
            $original_value=0;
            $postponed_value=0;
        
            if (!($_GET['id']=='new')) {
            
                $inputs['ID']=$_GET['id'];
                $id=$_GET['id'];
                $model = new('\Model\\'.$this->UCF_object);
                
                $data = $model->getRow($inputs);

                if($data){

                    foreach ($data as $key => $value) {
                        $data_form[$key]=$value;
                        
                        //REDEFINE VARIABLES FOR INPUTS BASED ON DB VALUES
                        $status=$data_form['STATUS'];
                        $updated_by=$_SESSION['username'];
                        $created_by=$data_form['CREATED_BY'];
                        $id=$data_form['ID'];
                        $date=$data_form['DATE'];
                        $id_employee=$data_form['ID_EMPLOYEE'];
                        $temp_id_employee=$data_form['ID_EMPLOYEE'];
                        //$inputs_employee['ID']=$data_form['ID_EMPLOYEE'];
                        $salary_item_type=$data_form['SALARY_ITEM_TYPE'];
                        $data_form_type = $data_form['SALARY_ITEM_TYPE'];
                        $salary_item_value=$data_form['SALARY_ITEM_VALUE'];
                        $salary_item_description=$data_form['SALARY_ITEM_DESCRIPTION'];
                        $original_value=$data_form['ORIGINAL_VALUE'];
                        $postponed_value=$data_form['POSTPONED_VALUE'];
                    
                    }
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
                        </div>
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
                                <input id="salary_item_status" type="text" size="20" readonly name="Salary_Item_Status" value="'.$status.'">
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
                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Confirmar" formaction="../Salary/insert_call">
                                </div>
                            </div>';
            } else {
                $output .= '<div class="row">
                                <div class="col-sm-6">
                                    <a href="'.ROOT.'/Salary/_list" class="btn btn-secondary btn-lg m-1 btn-block">Voltar</a>
                                </div>
                                <div class="col-sm-6">
                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Confirmar" formaction="../Salary/update_call?id='.$id.'">
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
    public function load_rows(){
            
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
                                <th style="display: none;">Criado por</th>
                                <th style="display: none;">Atualizado por</th>
                                <th style="display: none;">Temp_Id_Employee</th>
                                <th style="display: none;">Id Funcionário</th>
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
                                <a href="'.ROOT."/$this->UCF_object/_update?id=$row->ID".'" title="Edit" class="text-primary updateBtn" id="'.$row->ID.'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                <a href="'.ROOT."/$this->UCF_object/_delete?id=$row->ID".'" title="Delete" class="text-danger deleteBtn" id="'.$row->ID.'"><i class="fas fa-eraser"></i></a>
                            </td>
                            <td style="display: none;">'.$row->CREATED_BY.'</td>
                            <td style="display: none;">'.$row->UPDATED_BY.'</td>
                            <td style="display: none;">'.$row->ID_EMPLOYEE.'</td>
                            <td style="display: none;">'.$row->ID_EMPLOYEE.'</td>
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