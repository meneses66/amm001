<?php

namespace Controller;

restart_session();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class PreClosing {

    use _GlobalController;
    private $object = 'preclosing';
    private $UCF_object = 'PreClosing';

    public function index()
    {}

        //SESSION TO LOAD HTML FORMS:
    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_preclosing_form($inputs){

        if (isset($_GET['id'])){

            $output = "";

            $id = $_GET['id'];
            $created_by = $_SESSION['username'];
            $updated_by = $_SESSION['username'];

            $year = "";
            $month = "";
            $id_employee = "";
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
                    $name = $data_form['NAME'];
                    $id = $data_form['ID'];
                    $type = $data_form['TYPE'];
                    $value = $data_form['VALUE'];
                    $status = $data_form['STATUS'];
                    $comment = $data_form['COMMENT'];

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
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="name" class="medium-label">Nome: *</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="name" type="text" size="40" name="Name" value="'.$name.'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="value" class="medium-label">Valor: *</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="value" type="text" size="40" name="Value" value="'.$value.'">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="type" class="medium-label">Tipo: *</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="type" type="text" size="40" name="Type" value="'.$type.'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="status" class="medium-label">Status:</label>
                                </div>
                                <div class="col-sm-5">
                                    <select class="medium-label" id="status" name="Status">
                                        <option class="medium-label" value="Ativo" '.(($status == 'Ativo')?"selected":"").'>Ativo</option>
                                        <option class="medium-label" value="Desativado" '.(($status == 'Desativado')?"selected":"").'>Desativado</option>
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="comment" class="medium-label">Comentarios:</label>
                                </div>
                                <div class="col-sm-5">
                                    <input id="comment" type="text" size="50" name="Comment" value="'.$comment.'">
                                </div>
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-5">
                                    
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