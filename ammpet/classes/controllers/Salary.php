<?php

namespace Controller;
if(session_status() === PHP_SESSION_NONE) session_start();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class Salary {

    use _GlobalController;
    private $object = 'salary';
    private $UCF_object = 'Salary';

    public function index()
    {
    }

    //SESSION TO LOAD HTML FORMS:

    //LOAD HTML FORM FOR CREATING NEW RECORD
    public function load_new_form(){

        //START SESSION IF NOT STARTED TO GET $SESSION USERNAME
        if(session_status() === PHP_SESSION_NONE) session_start();

        //DEFINE OPTION LISTS:
        //$type_option_list = load_options_new("SUPPLIER_TYPE", "Ativo");
        //$role_option_list = load_options_new("SUPPLIER_ROLE", "Ativo");

        $output = "";

        //CREATE VIEW HTML STRUCTURE
        $output .= '<div class="row">
                        <div class="col-sm-6">
                            <input id="id" type="hidden" name="Id" value="">
                            <input id="created_by" type="hidden" name="Created_by" value="'.$_SESSION['username'].'">
                            <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
                            <input id="created" type="hidden" name="Created" value="">
                            <input id="updated" type="hidden" name="Updated" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="name" class="medium-label">Nome:</label>
                        </div>
                        <div class="col-sm-5">
                            <input id="name" type="text" size="40" name="Name">
                        </div>
                        <div class="col-sm-1">
                            <label for="value" class="medium-label">Valor:</label>
                        </div>
                        <div class="col-sm-5">
                            <input id="value" type="text" size="40" name="Value">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="type" class="medium-label">Tipo:</label>
                        </div>
                        <div class="col-sm-5">
                            <input id="type" type="text" size="40" name="Type">
                        </div>
                        <div class="col-sm-1">
                            <label for="status" class="medium-label">Status:</label>
                        </div>
                        <div class="col-sm-5">
                            <select class="medium-label" id="status" name="Status">
                                <option class="medium-label" value="Ativo" selected>Ativo</option>
                                <option class="medium-label" value="Inativo">Inativo</option>
                            </select>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="comment" class="medium-label">Comentário:</label>
                        </div>
                        <div class="col-sm-5">
                            <input id="comment" type="text" size="40" name="Comment">
                        </div>
                        <div class="col-sm-1">
                            
                        </div>
                        <div class="col-sm-5">
                            
                        </div>
                    </div><br>';
                    echo $output;

    }

    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_update_form(){

        if (isset($_GET['id'])){

            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";

            //DEFINIR VARIAVEIS PARA OS INPUTS:
            $created_by=$_SESSION['username'];
            $updated_by=$_SESSION['username'];
            $id="new";
            $date=date('Y-m-d');
            $inputs['ID']="new";
        
            if (!($_GET['id']=='new')) {
            
                $inputs['ID']=$_GET['id'];
                $id=$_GET['id'];
                $model = new('\Model\\'.$this->UCF_object);
                
                $data = $model->getRow($inputs);

                if($data){

                    foreach ($data as $key => $value) {
                        $data_form[$key]=$value;
                        
                        //REDEFINE VARIABLES FOR INPUTS BASED ON DB VALUES
                        $xxxxx=$data_form['xxxxx'];
                        $xxxxx = ($data_form['xxxx']==1) ? "checked" : "";
                        $updated_by=$_SESSION['username'];
                        $created_by=$data_form['CREATED_BY'];
                        $id=$data_form['ID'];
                        $date=$data_form['DATE'];
                    
                    }
                }    
            }
            

            //FOR EACH DROPDOWN GET $data_form and send to load_options_update to get the selected option
            //$data_form_type = $data_form['TYPE'];
            //$type_option_list = load_options_update("SUPPLIER_TYPE", "Ativo", $data_form_type);
            


            //START TO LOAD THE UPDATE FORM:
            $output .= '<div class="row">
                            <div class="col-sm-1">
                                <label for="id" class="medium-label">Id:</label>
                            </div>
                            <div class="col-sm-5">
                                <input id="id" type="text" size="8" name="Id" readonly value="'.$id.'">
                            </div>
                            <div class="col-sm-6">
                                <input id="updated_by" type="hidden" name="Updated_by" value="'.$updated_by.'">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-1">
                                
                            </div>
                            <div class="col-sm-5">
                                
                            </div>
                            <div class="col-sm-1">
                                <label for="value" class="medium-label">Valor:</label>
                            </div>
                            <div class="col-sm-5">
                                <input id="value" type="text" size="40" name="value" value="'.$data_form['VALUE'].'">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="type" class="medium-label">Tipo:</label>
                            </div>
                            <div class="col-sm-5">
                                <input id="type" type="text" size="40" name="type" value="'.$data_form['TYPE'].'">
                            </div>
                            <div class="col-sm-1">
                                <label for="status" class="medium-label">Status:</label>
                            </div>
                            <div class="col-sm-5">
                                <select class="medium-label" id="status" name="Status">
                                    <option class="medium-label" value="">Selecione uma opção</option>
                                    <option class="medium-label" value="Ativo" '.(($data_form['STATUS'] == 'Ativo')?"selected":"").'>Ativo</option>
                                    <option class="medium-label" value="Inativo" '.(($data_form['STATUS'] == 'Inativo')?"selected":"").'>Inativo</option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="comment" class="medium-label">Comentarios:</label>
                            </div>
                            <div class="col-sm-5">
                                <input id="comment" type="text" size="50" name="Comment" value="'.$data_form['COMMENT'].'">
                            </div>
                            <div class="col-sm-1">
                                
                            </div>
                            <div class="col-sm-5">
                                
                            </div>
                        </div>';
            
            if ($id=="new") {
                $output .= '<div class="row">
                                <div class="col-sm-6">
                                    
                                </div>
                                <div class="col-sm-6">
                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Confirmar" formaction="../Salary/insert_call">
                                </div>
                            </div>';
            } else {
                $output .= '<div class="row">
                                <div class="col-sm-6">
                                    
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
        if($model->countAll()>0){
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Tipo</th>
                                <th>Status</th>
                                <th>Comentários</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($data as $row) {
                $output .='<tr class="text-center text-secondary">
                            <td>'.$row->ID.'</td>
                            <td>'.$row->UPDATED.'</td>
                            <td>'.$row->NAME.'</td>
                            <td>'.$row->VALUE.'</td>
                            <td>'.$row->TYPE.'</td>
                            <td>'.$row->STATUS.'</td>
                            <td>'.$row->COMMENT.'</td>
                            <td>
                                <a href="'.ROOT."/$this->UCF_object/_update?id=$row->ID".'" title="Edit" class="text-primary updateBtn" id="'.$row->ID.'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                <a href="'.ROOT."/$this->UCF_object/_delete?id=$row->ID".'" title="Delete" class="text-danger deleteBtn" id="'.$row->ID.'"><i class="fas fa-eraser"></i></a>
                            </td></tr>';
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