<?php

namespace Controller;
if(session_status() === PHP_SESSION_NONE) session_start();

(defined('ROOTPATH') AND isset($_SESSION['username']) AND ($_SESSION['username']!="" || $_SESSION['username']!=null  )) OR exit('Access denied!');

class Params {

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
        
        //GET LIST OF BREEDS FROM BREED TABLE
        $model = new('\Model\\'.$this->UCF_object);
        
        $data_form_package=$array['dfpackage'];
        $inputs['ID_CLIENT']=$array['id_client'];
        $inputs['PACK_STATUS']="Aberto";

        if($data_form_package=="0" || $data_form_package=="" || $data_form_package==null){
            $option_list = '<option class="medium-label" value="0" "selected">Avulso</option>';
        } else {
            $option_list = '<option class="medium-label" value="0">Avulso</option>';
        }
        
        $options = $model->listWhere($inputs);
        if($options){
            foreach ($options as $option) { 
                $selected= ($data_form_breed == $option->ID) ? "selected":"";
                $option_list .= '<option class="medium-label" value="'.$option->ID.'" '.$selected.'>'.$option->NAME.'</option>';
            }
        }
        $sql_stm = null;
        unset_array($inputs);
        $data = null;
        $options = null;
        $model = null;
        return $option_list;
    
    }
    

}