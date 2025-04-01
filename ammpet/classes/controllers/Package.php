<?php

namespace Controller;
if(session_status() === PHP_SESSION_NONE) session_start();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class Package {

    use _GlobalController;
    private $object = 'package';
    private $UCF_object = 'Package';

    public function index()
    {

    }

    //SESSION TO LOAD HTML FORMS:

    //LOAD HTML FOR LISTING RECORDS IN TABLE
    public function load_rows(){
            
        $output = "";
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
            $sql_stm = null;
            unset_array($inputs);
            $data = null;
            $model = null;
            echo $output;
        }
        else{
            $sql_stm = null;
            unset_array($inputs);
            $data = null;
            $model = null;
            echo '<h3 class="text-center text-secondary mt-5">Sem dados para mostrar</h3>';
        }
    }

    public function load_package_options ($array){
        
        //GET LIST OF PACKAGES FROM PACKAGES TABLE
        $model = new('\Model\\'.$this->UCF_object);
        
        $data_form_package=$array['dfpackage'];

        $inputs['ID_CLIENT']=$array['id_client'];
        $inputs['PACK_STATUS']="Aberto";

        if($data_form_package==1 || $data_form_package=="1"){
            $option_list = '<option class="medium-label" value="1" "selected">Avulso</option>';
        } else {
            $option_list = '<option class="medium-label" value="1">Avulso</option>';
        }
        
        $options = $model->listWhere($inputs);
        if($options){
            foreach ($options as $option) {
                //WITH ID_ANIMAL GET ITS NAME:
                $animal_inputs['ID']=$option->ID_ANIMAL;
                $animal_model = new('\Model\\'."Animal");
                $animal_row = $animal_model->get_row($animal_inputs);
                //$animal_name = $animal_row->NAME;
               
                //$option_to_show = $option->ID."-".$animal_name;

                $option_to_show = $option->ID."-".$animal_inputs['ID'];

                //BUILD LIST:
                $selected= ($data_form_package == $option->ID) ? "selected":"";
                $option_list .= '<option class="medium-label" value="'.$option->ID.'" '.$selected.'>'.$option_to_show.'</option>';
            }
        }
        $sql_stm = null;
        unset_array($inputs);
        $data = null;
        $options = null;
        $model = null;
        return $option_list;
    
    }
    
    //GET NEXT SEQUENCE:
    public function get_next_pkg_sequence($inputs){
        $inputs_package['ID']=$inputs['Id_Package'];
        $sql_stm_get_package = "SELECT * FROM CLIENT_PACKAGE WHERE ID=:ID";
        $package_model = new('\Model\\'."Package");
        $result_package = $package_model->exec_sqlstm($sql_stm_get_package, $inputs_package);
        if ($result_package){
            return $result_package->PACK_CONSUME;
        } else{
            return false;
        }

    }

    //FUNCTION TO UPDATE PACKAGE DETAILS WHEN: ORDER ITEM SERVICE IS UPDATED OR DELETED   
    public function update_package($inputs){
	
        $inputs_package['ID']=$inputs['Id_Package'];
        $inputs_oi['ID']=$inputs['Id'];
        
        $sql_stm_get_package = "SELECT * FROM CLIENT_PACKAGE WHERE ID=:ID";
        $sql_stm_get_oi = "SELECT * FROM ORDER_ITEM WHERE ID=:ID";
        
        $package_model = new('\Model\\'."Package");
        $oi_model = new('\Model\\'."OrderItem");
        
        $result_package = $package_model->exec_sqlstm($sql_stm_get_package, $inputs_package);
        $result_oi = $oi_model->exec_sqlstm($sql_stm_get_oi, $inputs_oi);
    
        if ($result_package){

            $consumed_package = $result_package->PACK_CONSUMED;
            $quantity_package = $result_package->PACK_QUANTITY;
            $consumed_oi = $result_oi->QUANTIY;
            $updated_consumed_package = $consumed_package+$consumed_oi;

            $_SERVER['REQUEST_METHOD']="POST";

            $_POST['PACK_CONSUMED'] = $updated_consumed_package;

            if ($updated_consumed_package==$quantity_package) {
                $_POST['PACK_STATUS']="Fechado";
            } else{
                $_POST['PACK_STATUS']="Aberto";
            }
            $_POST['ID'] = $inputs['Id_Package'];
            $_POST['class']="Package";
            $_POST['method']="update_call";
            $_POST['type']="static";

            $ajax_call = new('\Controller\\'."Ajax_call");
            $ajax_call->index();
            
        }
        
        unset($inputs_package);
        unset($inputs_oi);
        $package_model=null;
        $oi_model=null;
    }

}