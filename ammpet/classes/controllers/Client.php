<?php 

namespace Controller;

if(session_status() === PHP_SESSION_NONE) session_start();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

/**
 * Client class
 */
class Client
{
	use _GlobalController;
	private $object = 'client';
    private $UCF_object = 'Client';

	public function index()
	{

	}

	//SESSION TO LOAD HTML FORMS:

    //LOAD HTML FORM FOR CREATING NEW RECORD
    public function load_new_form(){

        //START SESSION IF NOT STARTED TO GET $SESSION USERNAME
        if(session_status() === PHP_SESSION_NONE) session_start();

        //$category_option_list = load_options_new("SERV_CATEGORY", "Ativo");

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
                        <div class="col-sm-3">
                            <input id="name" type="text" size="30" name="Name">
                        </div>
                        <div class="col-sm-1">
                            <label for="mobile_1" class="medium-label">Celular 1:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="mobile_1" type="text" size="25" name="Mobile_1">
                        </div>
                        <div class="col-sm-1">
                            <label for="mobile_2" class="medium-label">Celular 2:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="mobile_2" type="tel" size="25" name="Mobile_2">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="origin" class="medium-label">Origem:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="origin" type="text" size="30" name="Origin">
                        </div>
                        <div class="col-sm-1">
                            <label for="client_since" class="medium-label">Clnte Dsd:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="client_since" type="date" size="30" name="Client_since" value="'.date('Y-m-d').'"><br><br>
                        </div>
                        <div class="col-sm-1">
                            <label for="birth_date" class="medium-label">Data Aniv.:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="birth_date" type="date" size="30" name="Birth_date" value="'.date('Y-m-d').'">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="email" class="medium-label">E-mail</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="email" type="text" size="30" name="Email">
                        </div>
                        <div class="col-sm-1">
                            <label for="cpf" class="medium-label">CPF:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="cpf" type="text" size="25" name="CPF">
                        </div>
                        <div class="col-sm-1">
                            <label for="preferred_dog_food" class="medium-label">Marca Pref:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="preferred_dog_food" type="text" size="25" name="Preferred_dog_food">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="address" class="medium-label">Endereço:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="address" type="text" size="30" name="Address">
                        </div>
                        <div class="col-sm-1">
                            <label for="comment" class="medium-label">Comentário:</label>
                        </div>
                        <div class="col-sm-3">
                            <input id="comment" type="text" size="30" name="Comment">
                        </div>
                        <div class="col-sm-1">
                            <label for="status" class="medium-label">Status:</label>
                        </div>
                        <div class="col-sm-3">
                            <select class="medium-label" id="status" name="Status">
                                <option class="medium-label" value="Ativo" selected>Ativo</option>
                                <option class="medium-label" value="Inativo">Inativo</option>
                            </select>
                        </div>
                    </div><br>';
                    echo $output;

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
                //$flag_comission = ($data_form['COMISSION_FLG']==1) ? "checked" : "";
                //$flag_comission_overwrite = ($data_form['COMISSION_OVERWRITE_FLG']==1) ? "checked" : "";
                //$flag_flag1 = ($data_form['FLAG1']==1) ? "checked" : "";


                //START TO LOAD THE UPDATE FORM:
                $output .= '<div class="row">
                                <div class="col-sm-1">
                                    <label for="id" class="medium-label">Id:</label>
                                </div>    
                            <div class="col-sm-6">
                                    <input id="id" type="text" name="Id" value="'.$data_form['ID'].'" readonly>
                                    <input id="updated_by" type="hidden" name="Updated_by" value="'.$_SESSION['username'].'">
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
                                    <label for="mobile_1" class="medium-label">Celular 1:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="mobile_1" type="tel" size="25" name="Mobile_1" value="'.$data_form['MOBILE_1'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="mobile_2" class="medium-label">Celular 2:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="mobile_2" type="tel" size="25" name="Mobile_2" value="'.$data_form['MOBILE_2'].'">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="origin" class="medium-label">Origem:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="origin" type="text" size="30" name="Origin" value="'.$data_form['ORIGIN'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="client_since" class="medium-label">Clnte Dsd:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="client_since" type="date" size="30" name="Client_since" value="'.$data_form['CLIENT_SINCE'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="birth_date" class="medium-label">Data Aniv.:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="birth_date" type="date" size="30" name="Birth_date" value="'.$data_form['BIRTH_DATE'].'">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="email" class="medium-label">E-mail</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="email" type="text" size="30" name="Email"  value="'.$data_form['EMAIL'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="cpf" class="medium-label">CPF:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="cpf" type="text" size="25" name="CPF"  value="'.$data_form['CPF'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="preferred_dog_food" class="medium-label">Marca Pref:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="preferred_dog_food" type="text" size="25" name="Preferred_dog_food"  value="'.$data_form['PREFERRED_DOG_FOOD'].'">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="address" class="medium-label">Endereço:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="address" type="text" size="30" name="Address"  value="'.$data_form['ADDRESS'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="comment" class="medium-label">Comentário:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="comment" type="text" size="30" name="Comment"  value="'.$data_form['COMMENT'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="status" class="medium-label">Status:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="medium-label" id="status" name="Status">
                                        <option class="medium-label" value="Ativo" '.(($data_form['STATUS'] == 'Ativo')?"selected":"").'>Ativo</option>
                                        <option class="medium-label" value="Inativo" '.(($data_form['STATUS'] == 'Inativo')?"selected":"").'>Inativo</option>
                                    </select>
                                </div>
                            </div><br>';
                            echo $output;
            } else{
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
                            echo $output;
            } else{
                show("No record to display!");
            }

        }

    }

    //LOAD HTML FOR LISTING RECORDS IN TABLE -- SERVICE AND PRODUCT SHARE SAME TABLE PRODSERV 
    // THEREFORE CHANGED FROM LISTALL AND COUNTALL to LISTWHARE AND COUNTWHERE
    public function load_rows($inputs){
            
        $inputs_buttons=$inputs['buttons'];
        $output = "";
        $model = new('\Model\\'.$this->UCF_object);
        
        $sqlstm = "SELECT C.ID AS ID, C.UPDATED AS UPDATED, C.NAME AS NAME, C.MOBILE_1 AS MOBILE_1, C.MOBILE_2 as MOBILE_2, C.ORIGIN as ORIGIN, C.OLD_ID as OLD_ID, C.STATUS as STATUS, GROUP_CONCAT(A.NAME) AS ANIMALS FROM `CLIENT` C LEFT JOIN `ANIMAL` A ON C.ID = A.ID_CLIENT GROUP BY C.ID";

        $data = $model->exec_sqlstm($sqlstm);
        if($model->countAll()>0){
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Nome</th>
                                <th>Celular 1</th>
                                <th>Celular 2</th>
                                <th>Origin</th>
                                <th>Old Id</th>
                                <th>Status</th>
                                <th>Animais</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($data as $row) {
                $output .='<tr class="text-center text-secondary">
                            <td>'.$row->ID.'</td>
                            <td>'.$row->UPDATED.'</td>
                            <td>'.$row->NAME.'</td>
                            <td>'.$row->MOBILE_1.'</td>
                            <td>'.$row->MOBILE_2.'</td>
                            <td>'.$row->ORIGIN.'</td>
                            <td>'.$row->OLD_ID.'</td>
                            <td>'.$row->STATUS.'</td>
                            <td>'.$row->ANIMALS.'</td>
                            <td>
                                '.(($inputs_buttons=='Orderx')? "<a href=\"" : "").''.(($inputs_buttons=='Orderx')? ROOT."/Orderx/insert_call?cli_id=$row->ID\"" : "").''.(($inputs_buttons=='Orderx')? " title=\"New_Order\" class=\"text-primary newOrderBtn\" cli_id=" : "").''.(($inputs_buttons=='Orderx')? $row->ID : "").''.(($inputs_buttons=='Orderx')? "\"><i class=\"fas fa-donate\"></i></a>" : "").'
                                '.(($inputs_buttons=="Client")? "<a href=\"" : "").''.(($inputs_buttons=="Client")? ROOT."/Client/_update?id=$row->ID\"" : "").''.(($inputs_buttons=="Client")? " title=\"Edit\" class=\"text-primary updateBtn\" id=" : "").''.(($inputs_buttons=="Client")? $row->ID : "").''.(($inputs_buttons=="Client")? "\"><i class=\"fas fa-donate\"></i></a>&nbsp;&nbsp" : "").'
                                '.(($inputs_buttons=='Client')? "<a href=\"" : "").''.(($inputs_buttons=='Client')? ROOT."/Client/_delete?id=$row->ID\"" : "").''.(($inputs_buttons=='Client')? " title=\"Delete\" class=\"text-danger deleteBtn\" id=" : "").''.(($inputs_buttons=='Client')? $row->ID : "").''.(($inputs_buttons=='Client')? "\"><i class=\"fas fa-eraser\"></i></a>" : "").'
                            </td></tr>';
            }
            $output .= '</tbody>';
            echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3>';
        }
    }

    public function order_pick_client_load_rows(){
            
        $output = "";
        $model = new('\Model\\'.$this->UCF_object);
        
        $sqlstm = "SELECT C.ID AS ID, C.UPDATED AS UPDATED, C.NAME AS NAME, C.MOBILE_1 AS MOBILE_1, C.MOBILE_2 as MOBILE_2, C.ORIGIN as ORIGIN, C.OLD_ID as OLD_ID, C.STATUS as STATUS, GROUP_CONCAT(A.NAME) AS ANIMALS FROM `CLIENT` C LEFT JOIN `ANIMAL` A ON C.ID = A.ID_CLIENT GROUP BY C.ID";

        $data = $model->exec_sqlstm($sqlstm);
        if($model->countAll()>0){
            $output .='<thead>
                            <tr class="text-center text-secondary">
                                <th>Id</th>
                                <th>Atualiz.</th>
                                <th>Nome</th>
                                <th>Celular 1</th>
                                <th>Celular 2</th>
                                <th>Origin</th>
                                <th>Old Id</th>
                                <th>Status</th>
                                <th>Animais</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($data as $row) {
                $output .='<tr class="text-center text-secondary">
                            <td>'.$row->ID.'</td>
                            <td>'.$row->UPDATED.'</td>
                            <td>'.$row->NAME.'</td>
                            <td>'.$row->MOBILE_1.'</td>
                            <td>'.$row->MOBILE_2.'</td>
                            <td>'.$row->ORIGIN.'</td>
                            <td>'.$row->OLD_ID.'</td>
                            <td>'.$row->STATUS.'</td>
                            <td>'.$row->ANIMALS.'</td>
                            <td>
                                <a href="'.ROOT."/Orderx/insert_call?cli_id=$row->ID".'" title="New_Order" class="text-primary newOrderBtn" cli_id="'.$row->ID.'"><i class="fas fa-donate"></i></a>&nbsp;&nbsp;
                            </td></tr>';
            }
            $output .= '</tbody>';
            echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3>';
        }
    }

    public function load_parent_form(){
        if (isset($_GET['cli_id'])){

            if(session_status() === PHP_SESSION_NONE) session_start();
            $output = "";
            $inputs["ID"]=$_GET['cli_id'];
            $id=$_GET['cli_id'];
            $model = new('\Model\\'.$this->UCF_object);
            $data = $model->getRow($inputs);

            if($data){

                foreach ($data as $key => $value) {
                    $data_form[$key]=$value;
                }

                $output .= '<div class="row">
                                <div class="col-sm-1">
                                    <label for="id" class="medium-label">Id:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="id" type="text" size="8" name="Id" readonly value="'.$data_form['ID'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="name" class="medium-label">Nome:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="name" type="text" size="30" name="Name" readonly value="'.$data_form['NAME'].'">
                                </div>
                                <div class="col-sm-1">
                                    <label for="mobile_1" class="medium-label">Celular 1:</label>
                                </div>
                                <div class="col-sm-3">
                                    <input id="mobile_1" type="text" size="25" name="Mobile_1" readonly value="'.$data_form['MOBILE_1'].'">
                                </div>
                            </div>';
                            echo $output;
            } else{
                show("No record to display!");
            }

        }
    }

}
