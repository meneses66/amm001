<?php

namespace Controller;

if(session_status() === PHP_SESSION_NONE) session_start();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class Animal {

    use _GlobalController;
	private $object = 'animal';
    private $UCF_object = 'Animal';
    private $parent_object = 'Client';

	public function index()
	{

	}

	//SESSION TO LOAD HTML FORMS:

    //LOAD HTML FORM FOR CREATING NEW RECORD
    public function load_new_form(){

        //START SESSION IF NOT STARTED TO GET $SESSION USERNAME
        if(session_status() === PHP_SESSION_NONE) session_start();

        if (isset($_GET['cli_id'])){

            $cli_id=$_GET['cli_id'];
            //$inputs["ID"]=$_GET['cli_id'];
            //$entity = new('\Model\\'.$this->UCF_object);
            //$entity_data = $entity->getRow($inputs);
            $size_option_list = load_options_new("ANIMAL_SIZE", "Ativo");

            //$breed = new ('\Controller\\'."Breed");
            //$breed_option_list = $breed->load_breed_options_new();

            $output = "";

            //CREATE VIEW HTML STRUCTURE
            $output .= '<div class="row">
                            <div class="col-sm-6">
                                <input id="id" type="hidden" name="Id" value="">
                                <input id="created_by" type="hidden" name="Created_by" value="'.$_SESSION['username'].'">
                                <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
                                <input id="created" type="hidden" name="Created" value="">
                                <input id="updated" type="hidden" name="Updated" value="">
                                <input id="id_client" type="hidden" name="Id_client" value="'.$cli_id.'">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="name" class="medium-label">Nome:</label>
                            </div>
                            <div class="col-sm-3">
                                <input id="name" type="text" size="30" name="Name">
                            </div>
                            <div class="col-sm-1">
                                <label for="type" class="medium-label">Tipo:</label>
                            </div>
                            <div class="col-sm-3">
                                <select class="medium-label" id="type" name="Type" onClick="getBreeds(this.value,\'\',\'new\')">
                                    <option class="medium-label" value="" selected>Selecione uma opção</option>
                                    <option class="medium-label" value="Cão">Cão</option>
                                    <option class="medium-label" value="Gato">Gato</option>
                                    <option class="medium-label" value="Outro">Outro</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <label for="id_breed" class="medium-label">Raça:</label>
                            </div>
                            <div class="col-sm-3">
                                <select class="medium-label" id="id_breed" name="Id_breed">
                                    
                                </select>
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="gender" class="medium-label">Sexo:</label>
                            </div>
                            <div class="col-sm-3">
                                <select class="medium-label" id="gender" name="Gender">
                                    <option class="medium-label" value="" selected>Selecione uma opção</option>
                                    <option class="medium-label" value="Macho">Macho</option>
                                    <option class="medium-label" value="Femea">Fêmea</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <label for="size" class="medium-label">Porte:</label>
                            </div>
                            <div class="col-sm-3">
                                <select class="medium-label" id="size" name="Size">
                                    <option class="medium-label" value="" selected>Selecione uma opção</option>
                                    <option class="medium-label" value="Enorme">Enorme</option>
                                    <option class="medium-label" value="Grande">Grande</option>
                                    <option class="medium-label" value="Medio">Médio</option>
                                    <option class="medium-label" value="Pequeno">Pequeno</option>
                                    <option class="medium-label" value="Mini">Mini</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <label for="birth_date" class="medium-label">Dt. Nasc.:</label>
                            </div>
                            <div class="col-sm-3">
                                <input id="birth_date" type="date" size="30" name="Birth_date" value="'.date('Y-m-d').'">
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="is_danger" class="medium-label">Morde:</label>
                            </div>
                            <div class="col-sm-1">
                                <input id="is_danger" type="checkbox" name="Is_danger">
                            </div>
                            <div class="col-sm-2">
                                <label for="is_no_perfume" class="medium-label">Não passar perfume:</label>
                            </div>
                            <div class="col-sm-1">
                                <input id="is_no_perfume" type="checkbox" name="Is_no_perfume">
                            </div>
                            <div class="col-sm-2">
                                <label for="is_blade_alergic" class="medium-label">Alérgico Lâmina:</label>
                            </div>
                            <div class="col-sm-1">
                                <input id="is_blade_alergic" type="checkbox" name="Is_blade_alergic">
                            </div>
                            <div class="col-sm-2">
                                <label for="is_vaccinated" class="medium-label">Vacinado:</label>
                            </div>
                            <div class="col-sm-1">
                                <input id="is_vaccinated" type="checkbox" name="Is_vaccinated">
                            </div>
                        </div><br><br>
                        <div class="row">
                                <div class="col-sm-6">
                                    <a href="'.ROOT.'/Animal/_back_cli?cli_id='.$cli_id.'" class="btn btn-secondary btn-lg m-1 btn-block" cli_id="'.$cli_id.'">Voltar</a>
                                </div>
                                <div class="col-sm-6">
                                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Criar" formaction="../Animal/insert_call">
                                </div>
                            </div>';
                        echo $output;
        }
    }

    //LOAD HTML FORM FOR UPDATING RECORD
    public function load_update_form(){

        if (isset($_GET['id'])){

            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";
            $inputs["ID"]=$_GET['id'];
            $id=$_GET['id'];
            $model = new('\Model\\'.$this->UCF_object);
            
            $data = $model->getRow($inputs);

            if($data){

                foreach ($data as $key => $value) {
                    $data_form[$key]=$value;
                }

                //FOR EACH DROPDOWN GET $data_form and send to load_options_update to get the selected option
                //$data_form_category = $data_form['CATEGORY'];
                //$category_option_list = load_options_update("SERV_CATEGORY", "Ativo", $data_form_category);

                //$data_form_center = $data_form['CENTER'];
                //$center_option_list = load_options_update("SERV_CENTER", "Ativo", $data_form_center);

                //FOR EACH FLAG CONVERT TINNY TO CHECKED:
                $flag_is_danger = ($data_form['IS_DANGER']==1) ? "checked" : "";
                $flag_is_no_perfume = ($data_form['IS_NO_PERFUME']==1) ? "checked" : "";
                $flag_is_blade_alergic = ($data_form['IS_BLADE_ALERGIC']==1) ? "checked" : "";
                $flag_is_vaccinated = ($data_form['IS_VACCINATED']==1) ? "checked" : "";


                //START TO LOAD THE UPDATE FORM:
                $output .= '<div class="row">
                                <div class="col-sm-1">
                                    <label for="id" class="medium-label">Id:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="id" type="text" name="Id" readonly value="'.$data_form['ID'].'">
                                </div>
                                <div class="col-sm-3">
                                    <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
                                    <input id="id_client" type="hidden" name="Id_client" value="'.$data_form['ID_CLIENT'].'">
                                    <input id="temp_breed" type="hidden" name="temp_breed" value="'.$data_form['ID_BREED'].'">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="name" class="medium-label">Nome:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="name" type="text" size="30" name="Name" value="'.$data_form['NAME'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="type" class="medium-label">Tipo:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="type" name="Type" onChange="getBreeds(this.value,'.$data_form['ID_BREED'].',\'update\')">
                                        <option class="medium-label" value="" '.(($data_form['TYPE'] == '')?"selected":"").'>Selecione uma opção</option>
                                        <option class="medium-label" value="Cão" '.(($data_form['TYPE'] == 'Cão')?"selected":"").'>Cão</option>
                                        <option class="medium-label" value="Gato" '.(($data_form['TYPE'] == 'Gato')?"selected":"").'>Gato</option>
                                        <option class="medium-label" value="Outro" '.(($data_form['TYPE'] == 'Outro')?"selected":"").'>Outro</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="id_breed" class="medium-label">Raça:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="id_breed" name="Id_breed">
                                        
                                    </select>
                                </div>
                            </div><br><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="gender" class="medium-label">Sexo:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="gender" name="Gender">
                                        <option class="medium-label" value="">Selecione uma opção</option>
                                        <option class="medium-label" value="Macho" '.(($data_form['GENDER'] == 'Macho')?"selected":"").'>Macho</option>
                                        <option class="medium-label" value="Femea" '.(($data_form['GENDER'] == 'Femea')?"selected":"").'>Fêmea</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="size" class="medium-label">Porte:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="size" name="Size">
                                        <option class="medium-label" value="">Selecione uma opção</option>
                                        <option class="medium-label" value="Enorme" '.(($data_form['SIZE'] == 'Enorme')?"selected":"").'>Enorme</option>
                                        <option class="medium-label" value="Grande" '.(($data_form['SIZE'] == 'Grande')?"selected":"").'>Grande</option>
                                        <option class="medium-label" value="Medio" '.(($data_form['SIZE'] == 'Medio')?"selected":"").'>Médio</option>
                                        <option class="medium-label" value="Pequeno" '.(($data_form['SIZE'] == 'Pequeno')?"selected":"").'>Pequeno</option>
                                        <option class="medium-label" value="Mini" '.(($data_form['SIZE'] == 'Mini')?"selected":"").'>Mini</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="birth_date" class="medium-label">Dt.Nasc.:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="birth_date" type="date" size="30" name="Birth_date" value="'.$data_form['BIRTH_DATE'].'">
                                </div>
                            </div><br><br>
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="is_danger" class="medium-label">Morde:</label>
                                </div>
                                <div class="col-sm-1">
                                    <input id="is_danger" type="checkbox" name="Is_danger" '.$flag_is_danger.'>
                                </div>
                                <div class="col-sm-2">
                                    <label for="is_no_perfume" class="medium-label">Não passar perfume:</label>
                                </div>
                                <div class="col-sm-1">
                                    <input id="is_no_perfume" type="checkbox" name="Is_no_perfume" '.$flag_is_no_perfume.'>
                                </div>
                                <div class="col-sm-2">
                                    <label for="is_blade_alergic" class="medium-label">Alérgico Lâmina:</label>
                                </div>
                                <div class="col-sm-1">
                                    <input id="is_blade_alergic" type="checkbox" name="Is_blade_alergic" '.$flag_is_blade_alergic.'>
                                </div>
                                <div class="col-sm-2">
                                    <label for="is_vaccinated" class="medium-label">Vacinado:</label>
                                </div>
                                <div class="col-sm-1">
                                    <input id="is_vaccinated" type="checkbox" name="Is_vaccinated" '.$flag_is_vaccinated.'>
                                </div>
                            </div><br><br>
                            <div class="row">
                                    <div class="col-sm-6">
                                        <a href="'.ROOT.'/Animal/_back_cli?cli_id='.$data_form['ID_CLIENT'].'" class="btn btn-secondary btn-lg m-1 btn-block" cli_id="'.$data_form['ID_CLIENT'].'">Voltar</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Atualizar" formaction="../Animal/update_call">
                                    </div>
                                </div>';
                                $sql_stm = null;
                                unset_array($inputs);
                                $data = null;
                                $model = null;
                                echo $output;
            } else{
                $sql_stm = null;
                unset_array($inputs);
                $data = null;
                $model = null;
                show("No record to display!");
            }

        }

    }

    //LOAD HTML FORM FOR DELETING RECORD
    public function load_delete_form(){

        if (isset($_GET['id'])){

            //if(!isset($_SESSION['username'])) {session_start();}
            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";
            $inputs["ID"]=$_GET['id'];
            $id=$_GET['id'];
            $model = new('\Model\\'.$this->UCF_object);
            $data = $model->getRow($inputs);

            if($data){

                foreach ($data as $key => $value) {
                    $data_form[$key]=$value;
                }

                $output .= '<div class="row">
                                <div class="col-sm-1">
                                    <label for="id" class="medium-label">Id: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="id" type="text" size="8" name="Id" readonly value="'.$data_form['ID'].'"><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="name" class="medium-label">Nome: &nbsp;</label><br><br>
                                </div>
                                <div class="col-sm-5">
                                    <input id="name" type="text" size="50" name="Name" readonly value="'.$data_form['NAME'].'"><br<br>
                                </div>
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-5">
                                    
                                </div>
                            </div>';
                            $sql_stm = null;
                            unset_array($inputs);
                            $data = null;
                            $model = null;
                            echo $output;
            } else{
                $sql_stm = null;
                unset_array($inputs);
                $data = null;
                $model = null;
                show("No record to display!");
            }

        }

    }

    //LOAD HTML FOR LISTING RECORDS IN TABLE -- SERVICE AND PRODUCT SHARE SAME TABLE PRODSERV 
    // THEREFORE CHANGED FROM LISTALL AND COUNTALL to LISTWHARE AND COUNTWHERE
    public function load_rows($inputs){
        
        $inputs_cli['ID']=$inputs['cli_id'];
        $inputs_ani['ID_CLIENT']=$inputs['cli_id'];
        //$id=$inputs['cli_id'];
        //if (isset($_GET['cli_id'])){
            $output=2;
            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";
            
            $client = new('\Model\\'.$this->parent_object);
            $client_data = $client->getRow($inputs_cli);

            if($client_data){
                foreach ($client_data as $key => $value) {
                    $data_form[$key]=$value;
                }

                $model = new('\Model\\'.$this->UCF_object);
                
                $data = $model->listWhere($inputs_ani);
                if($data){

                    //ADD TABLE COLUMN NAMES
                    $output .='<thead>
                                    <tr class="text-center text-secondary">
                                        <th>Id</th>
                                        <th>Atualiz.</th>
                                        <th>Nome</th>
                                        <th>Raça</th>
                                        <th>Sexo</th>
                                        <th>Porte</th>
                                        <th>Morde</th>
                                        <th>Não perfume</th>
                                        <th>Alérg.Lâm.</th>
                                        <th>Vacinado</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>';

                    foreach ($data as $row) {

                        //GET BREED NAME
                        $breed_input['ID']= $row->ID_BREED;
                        $breed = new('\Model\\'."Breed");
                        $breed_name = $breed->getRow($breed_input)->NAME;
                        $breed = null;
                        
                        //ADD ROW IN TABLE
                        $output .='<tr class="text-center text-secondary">
                                    <td>'.$row->ID.'</td>
                                    <td>'.$row->UPDATED.'</td>
                                    <td>'.$row->NAME.'</td>
                                    <td>'.$breed_name.'</td>
                                    <td>'.$row->GENDER.'</td>
                                    <td>'.$row->SIZE.'</td>
                                    <td>'.($row->IS_DANGER==1?"■":"").'</td>
                                    <td>'.($row->IS_NO_PERFUME==1?"■":"").'</td>
                                    <td>'.($row->IS_BLADE_ALERGIC==1?"■":"").'</td>
                                    <td>'.($row->IS_VACCINATED==1?"■":"").'</td>
                                    <td>
                                        <a href="'.ROOT."/$this->parent_object/_update_animal?cli_id=$row->ID_CLIENT&id=$row->ID".'" title="Edit" class="text-primary updateBtn" cli_id="'.$row->ID_CLIENT.'" id="'.$row->ID.'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                        <a href="'.ROOT."/$this->UCF_object/_delete?id=$row->ID".'" title="Delete" class="text-danger deleteBtn" cli_id="'.$row->ID_CLIENT.'" id="'.$row->ID.'"><i class="fas fa-eraser"></i></a>
                                    </td></tr>';
                    }
                    $output .= '</tbody><br>';
                    $sql_stm = null;
                    unset_array($inputs);
                    $data = null;
                    $client_data = null;
                    $client = null;
                    $model = null;
                    echo $output;
                }
                else{
                    $output_no_lines = '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3><br><br>';
                    $sql_stm = null;
                    unset_array($inputs);
                    $data = null;
                    $client_data = null;
                    $client = null;
                    $model = null;
                    echo $output_no_lines;
                }
                //echo $output;
            }
            //echo $output;
        //}
        //echo $output;
    }

    public function load_parent_form(){
        if (isset($_GET['cli_id'])){

            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";
            $inputs["ID"]=$_GET['cli_id'];
            $id=$_GET['cli_id'];
            $model = new('\Model\\'.$this->parent_object);
            $data = $model->getRow($inputs);

            if($data){

                $GLOBALS['cli_id_js']=$_GET['cli_id'];

                foreach ($data as $key => $value) {
                    $data_form[$key]=$value;
                }

                $output .= '<div class="row">
                                <div class="col-sm-1">
                                    <label for="id_cli" class="medium-label">Id Cli:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="id_cli" type="text" size="8" name="Id_cli" readonly value="'.$data_form['ID'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="name_cli" class="medium-label">Nome:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="name_cli" type="text" size="30" name="Name_cli" readonly value="'.$data_form['NAME'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="mobile_1" class="medium-label">Celular 1:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="mobile_1" type="text" size="25" name="Mobile_1" readonly value="'.$data_form['MOBILE_1'].'">
                                </div>
                            </div>';
                            $sql_stm = null;
                            unset_array($inputs);
                            $data = null;
                            $model = null;
                            echo $output;
            } else{
                $sql_stm = null;
                unset_array($inputs);
                $data = null;
                $model = null;
                show("No record to display!");
            }

        }
    }

    public function load_buttons_for_list_view(){
        if (isset($_GET['cli_id'])){

            if(session_status() === PHP_SESSION_NONE) session_start();
            $id=$_GET['cli_id'];
            $output_buttons='<div class="row">
                                <div class="col-sm-6">
                                    <a href="'.ROOT.'/Client/_update?id='.$id.'" class="btn btn-secondary btn-lg m-1 btn-block" cli_id="'.$id.'">Voltar</a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="'.ROOT.'/Client/_new_animal?cli_id='.$id.'" class="btn btn-primary btn-lg m-1 btn-block" cli_id="'.$id.'">Novo Animal</a>
                                </div>
                            </div>';
            echo $output_buttons;
        }
    }

}