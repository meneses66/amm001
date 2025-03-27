<?php

namespace Controller;

if(session_status() === PHP_SESSION_NONE) session_start();

defined('ROOTPATH') OR exit('Access denied!');

Trait _GlobalController{

    public function view($name)
    {
        $fileName = "../classes/views/".$name.".view.php";
        if(file_exists($fileName))
        {
            require $fileName;

        } else{
            $fileName = "../classes/views/_404.view.php";
            require $fileName;
        }
    }

    public function view_id($name)
    {
        
        $fileName = "../classes/views/".$name.".view.php";
        if(file_exists($fileName))
        {
            require $fileName;

        } else{
            $fileName = "../classes/views/_404.view.php";
            require $fileName;
        }
    }


    // FUNCTIONS MOVED FROM PARAMS TO BE STANDARDIZED

    //SESSION TO DEFINE TO WHICH PAGE USER WILL BE SENT: NEW, UPDATE, DELETE, LIST

    //Sends to page to create NEW Params
    public function _new(){
        $operation = 'goto_new';
        $this->goto_view($operation);
    }

    //Sends to LIST View
    public function _list(){
        $operation = 'goto_list';
        $this->goto_view($operation);
    }

    //Sends to UPDATE View
    public function _update(){
        $operation = 'goto_update';
        $this->goto_view($operation);
    }

    //Sends to DELETE View
    public function _delete(){
        $operation = 'goto_delete';
        $this->goto_view($operation);
    }

    //THIS SESSION APPLIES ONLY TO CLIENT:

    public function _cli_animal(){
        $operation = 'goto_cli_animal';
        $this->goto_view($operation);
    }

    public function _cli_package(){
        $operation = 'goto_cli_package';
        $this->goto_view($operation);
    }

    public function _cli_product(){
        $operation = 'goto_cli_product';
        $this->goto_view($operation);
    }

    public function _cli_service(){
        $operation = 'goto_cli_service';
        $this->goto_view($operation);
    }

    public function _new_animal(){
        $operation = 'goto_cli_new_animal';
        
        if (isset($_GET['cli_id'])){
            $cli_id = $_GET['cli_id'];
            $path2 = "Animal/_new?cli_id=".$cli_id;
            double_redirect("Client",$path2);
        } else{
            echo "Issue to return Cli_Id.";
        }
    }

    public function _update_animal(){

        $operation = 'goto_cli_update_animal';
        
        if (isset($_GET['cli_id']) AND isset($_GET['id'])){
            $cli_id = $_GET['cli_id'];
            $id = $_GET['id'];
            $path2 = "Animal/_update?cli_id=".$cli_id."&id=".$id;
            double_redirect("Client",$path2);
        } else{
            echo "Issue to return Cli_Id and Id.";
        }
    }

    public function _back_cli(){
        $operation = 'goto_client';
        
        if (isset($_GET['cli_id'])){
            $cli_id = $_GET['cli_id'];
            $path2 = "Client/_cli_animal?cli_id=".$cli_id;
            double_redirect("Animal",$path2);
        } else{
            echo "Issue to return Cli_Id.";
        }
    }

    //SESSION FOR ORDERX:

    public function _new_order(){
        
        if (isset($_GET['cli_id'])){
            $cli_id = $_GET['cli_id'];
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $_POST['class']="Orderx";
            $_POST['method']="insert_call";
            $_POST['Id_client']=$cli_id;

            $ajax_call = new('\Controller\\'."Ajax_call");
            $ajax_call->index();
            
        } else{
            echo "Issue to return Cli_Id.";
        }
    }

    public function _details(){
        
        if (isset($_GET['cli_id']) AND isset($_GET['order_id'])){
            $cli_id = $_GET['cli_id'];
            $order_id = $_GET['order_id'];
            $path = "Orderx/_order_details?cli_id=".$cli_id."&order_id=".$order_id;
            redirect($path);

        } else{
            echo "Issue to return Cli_Id and Order_Id.";
        }
    }

    public function _order_details(){
        $operation = 'goto_order_details';
        $this->goto_view($operation);
    }

    public function _new_service(){
        
        if (isset($_GET['cli_id']) AND isset($_GET['order_id'])){
            $cli_id = $_GET['cli_id'];
            $order_id = $_GET['order_id'];
            $path2 = "OrderItem/_new?cli_id=".$cli_id."&order_id=".$order_id;
            double_redirect("Orderx",$path2);
        } else{
            echo "Issue to return Cli_Id.";
        }
    }

    public function _insert_service(){
        
        if (isset($_GET['cli_id']) AND isset($_GET['order_id'])){
            $cli_id = $_GET['cli_id'];
            $order_id = $_GET['order_id'];
            $service = $_GET['service'];
            //$service_array = explode(';', $service);
            //echo var_dump($service_array);
            //$service = utf8_encode($service);
            //$service = preg_replace('/[[:cntrl:]]/', '', $service);
            //$service = preg_replace( "/\p{Cc}*$/u", '', $service);
            //$service = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $service);
            echo var_dump($service);
            //$json_array = json_decode($json, true);
            //echo (var_dump($json_array));
            $service_array = json_decode2(trim($service), true);
            //$service_array  = unserialize($service);
            echo var_dump($service_array);
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $_POST['class']="OrderItem";
            $_POST['method']="insert_call";
            $_POST['Id_Client']=$cli_id;
            $_POST['Id_Order']=$order_id;
            $_POST['Id_Prod_Serv']=$service_array->ID;

            $ajax_call = new('\Controller\\'."Ajax_call");
            $ajax_call->index();
            
        } else{
            echo "Issue to return Cli_Id and Order_id.";
        }
    }

    //Defines view to go to
    private function goto_view($operation){
    
        switch($operation)
        {
            case 'goto_new':
                $view="$this->object/$this->object-new";
                $this->view($view);
            break;

            case 'goto_list':
                $view="$this->object/$this->object-list";
                $this->view($view);
            break;

            case 'goto_update':
                $view="$this->object/$this->object-update";
                $this->view($view);
            break;

            case 'goto_delete':
                $view="$this->object/$this->object-delete";
                $this->view($view);
            break;

            case 'goto_cli_animal':
                $view="$this->object/$this->object-animal";
                $this->view($view);
            break;

            case 'goto_cli_package':
                $view="$this->object/$this->object-package";
                $this->view($view);
            break;

            case 'goto_cli_product':
                $view="$this->object/$this->object-product";
                $this->view($view);
            break;

            case 'goto_cli_service':
                $view="$this->object/$this->object-service";
                $this->view($view);
            break;

            case 'goto_order_details':
                $view="$this->object/$this->object-order_details";
                $this->view($view);
            break;

        }
    }

        //SESSION TO CALL DB ACTIONS: INSERT, UPDATE, DELETE

    //Inserts new Supplier into DB
    public function insert_call(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Create new Login instance:
            $model = new('\Model\\'.$this->UCF_object);

            //Define inputs for DB operations:
                
            foreach ($_POST as $key => $value) {
                //echo $key.": ".$value."<br>";
                $inputs[$key]=$value;    
            }

            //Special condition when Object is Orderx:
            if($inputs['class']="Orderx" AND isset($_GET['cli_id'])){
                $inputs['Created_by']=$_SESSION['username'];
                $inputs['Updated_by']=$_SESSION['username'];
                $inputs['Order_Date']=date("Y-m-d");
                $inputs['Status']="Aberto";
            }

            //Remove items from array inputs that are not columns in DB (op) or are auto-increment (Id)
            unset($inputs["operation"]);
            unset($inputs["class"]);
            unset($inputs["method"]);
            unset($inputs["Id"]);
            //Remove items from array inputs that are populated automatically in DB
            unset($inputs["Created"]);
            unset($inputs["Updated"]);

            //ADJUST FLAGS TO 0 or 1 in PRODUCT and SERVICE:

            if($this->UCF_object=="Product" || $this->UCF_object=="Service"){
                if(isset($inputs["Comission_flg"])){
                    $inputs["Comission_flg"]="1";
                }else{
                    $inputs["Comission_flg"]="0";
                }
                if(isset($inputs["Comission_overwrite_flg"])){
                    $inputs["Comission_overwrite_flg"]="1";
                }else{
                    $inputs["Comission_overwrite_flg"]="0";
                }
                if(isset($inputs["Flag1"])){
                    $inputs["Flag1"]="1";
                }else{
                    $inputs["Flag1"]="0";
                }
            }

            //ADJUST FLAGS TO 0 or 1 in ANIMAL:

            if($this->UCF_object=="Animal"){
                if(isset($inputs["Is_danger"])){
                    $inputs["Is_danger"]="1";
                }else{
                    $inputs["Is_danger"]="0";
                }
                if(isset($inputs["Is_no_perfume"])){
                    $inputs["Is_no_perfume"]="1";
                }else{
                    $inputs["Is_no_perfume"]="0";
                }
                if(isset($inputs["Is_blade_alergic"])){
                    $inputs["Is_blade_alergic"]="1";
                }else{
                    $inputs["Is_blade_alergic"]="0";
                }
                if(isset($inputs["Is_vaccinated"])){
                    $inputs["Is_vaccinated"]="1";
                }else{
                    $inputs["Is_vaccinated"]="0";
                }
            }

            //START UNSET CHECKBOXES IN SUPPLIET VIEW:

            if($this->UCF_object=="Supplier"){

                //Convert password_hash:
                if(!($inputs["Pass"]=="" || $inputs["Pass"]==null))
                {  
                    $inputs["Pass"] = password_hash($inputs["Pass"], PASSWORD_DEFAULT);
                } else {
                    unset($inputs["Pass"]);    
                }

                unset($inputs["client_view"]);
                unset($inputs["client_add"]);
                unset($inputs["client_edit"]);
                unset($inputs["client_delete"]);
                unset($inputs["supplier_view"]);
                unset($inputs["supplier_add"]);
                unset($inputs["supplier_edit"]);
                unset($inputs["supplier_delete"]);
                unset($inputs["params_view"]);
                unset($inputs["params_add"]);
                unset($inputs["params_edit"]);
                unset($inputs["params_delete"]);
                unset($inputs["product_view"]);
                unset($inputs["product_add"]);
                unset($inputs["product_edit"]);
                unset($inputs["product_delete"]);
                unset($inputs["service_view"]);
                unset($inputs["service_add"]);
                unset($inputs["service_edit"]);
                unset($inputs["service_delete"]);
                unset($inputs["orderx_view"]);
                unset($inputs["orderx_add"]);
                unset($inputs["orderx_edit"]);
                unset($inputs["orderx_delete"]);
                unset($inputs["cash_register_view"]);
                unset($inputs["cash_register_add"]);
                unset($inputs["cash_register_edit"]);
                unset($inputs["cash_register_delete"]);
                unset($inputs["admin_view"]);
                unset($inputs["admin_add"]);
                unset($inputs["admin_edit"]);
                unset($inputs["admin_delete"]);
                unset($inputs["agenda_view"]);
                unset($inputs["agenda_add"]);
                unset($inputs["agenda_edit"]);
                unset($inputs["agenda_delete"]);
                unset($inputs["salary_view"]);
                unset($inputs["salary_add"]);
                unset($inputs["salary_edit"]);
                unset($inputs["salary_delete"]);
                unset($inputs["cost_view"]);
                unset($inputs["cost_add"]);
                unset($inputs["cost_edit"]);
                unset($inputs["cost_delete"]);
                unset($inputs["pre_closing_view"]);
                unset($inputs["pre_closing_add"]);
                unset($inputs["pre_closing_edit"]);
                unset($inputs["pre_closing_delete"]);
                unset($inputs["month_closing_view"]);
                unset($inputs["month_closing_add"]);
                unset($inputs["month_closing_edit"]);
                unset($inputs["month_closing_delete"]);
            }

            //END UNSET CHECKBOXES IN SUPPLIET VIEW:

            try {
                //$model->insert($inputs);
                $new_id=$model->insert($inputs);
                
                /**
                foreach ($model as $key => $value) {
                    $new_record['$key']=$value;
                    //debug_to_console($new_record['$key']);
                }
                */

                switch ($this->UCF_object) {
                    case 'Animal':
                        $path2 = "Client/_cli_animal?cli_id=".$inputs['Id_client'];
                        double_redirect("Animal", $path2);
                        break;
                    
                    case 'Orderx':
                        $view = "$this->UCF_object/_details?cli_id=".$inputs['Id_client']."&order_id=".$new_id;
                        redirect("$view");
                        break;
                    
                    default:
                        $view = "$this->UCF_object/_list";
                        redirect("$view");
                        break;
                }
                
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        
    }

    //Updates Supplier into DB
    public function update_call(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Create new Model instance:
            $model = new('\Model\\'.$this->UCF_object);

            //Get Id from $_POST:
            if(isset($_POST["Id"])){
                $id = $_POST["Id"];
            } else {
                die("Record Id not informed.");
            }

            //Define inputs for DB operations:
                
            foreach ($_POST as $key => $value) {
                $inputs[$key]=$value;    
            }

            //Remove items from array inputs that are not columns in DB (op) or are auto-increment (Id)
            unset($inputs["operation"]);
            unset($inputs['class']);
            unset($inputs['method']);
            unset($inputs["Id"]);
            //Remove items from array inputs that are populated automatically in DB
            unset($inputs["Created"]);
            unset($inputs["Updated"]);

            //ADJUST FLAGS TO 0 or 1 in PRODUCT and SERVICE:

            if($this->UCF_object=="Product" || $this->UCF_object=="Service"){
                if(isset($inputs['Comission_flg'])){
                    $inputs['Comission_flg']="1";
                }else{
                    $inputs['Comission_flg']="0";
                }
                if(isset($inputs['Comission_overwrite_flg'])){
                    $inputs["Comission_overwrite_flg"]="1";
                }else{
                    $inputs['Comission_overwrite_flg']="0";
                }
                if(isset($inputs['Flag1'])){
                    $inputs['Flag1']="1";
                }else{
                    $inputs['Flag1']="0";
                }
            }

            //ADJUST FLAGS TO 0 or 1 in ANIMAL:

            if($this->UCF_object=="Animal"){
                if(isset($inputs["Is_danger"])){
                    $inputs["Is_danger"]="1";
                }else{
                    $inputs["Is_danger"]="0";
                }
                if(isset($inputs["Is_no_perfume"])){
                    $inputs["Is_no_perfume"]="1";
                }else{
                    $inputs["Is_no_perfume"]="0";
                }
                if(isset($inputs["Is_blade_alergic"])){
                    $inputs["Is_blade_alergic"]="1";
                }else{
                    $inputs["Is_blade_alergic"]="0";
                }
                if(isset($inputs["Is_vaccinated"])){
                    $inputs["Is_vaccinated"]="1";
                }else{
                    $inputs["Is_vaccinated"]="0";
                }
                unset($inputs["temp_breed"]);
            }
            
            //START UNSET CHECKBOXES IN SUPPLIET VIEW:

            if($this->UCF_object=="Supplier"){
    
                //Convert password_hash:
                if(!($inputs["Pass"]=="" || $inputs["Pass"]==null))
                {  
                    $inputs["Pass"] = password_hash($inputs["Pass"], PASSWORD_DEFAULT);
                } else {
                    unset($inputs["Pass"]);    
                }

                unset($inputs["client_view"]);
                unset($inputs["client_add"]);
                unset($inputs["client_edit"]);
                unset($inputs["client_delete"]);
                unset($inputs["supplier_view"]);
                unset($inputs["supplier_add"]);
                unset($inputs["supplier_edit"]);
                unset($inputs["supplier_delete"]);
                unset($inputs["params_view"]);
                unset($inputs["params_add"]);
                unset($inputs["params_edit"]);
                unset($inputs["params_delete"]);
                unset($inputs["product_view"]);
                unset($inputs["product_add"]);
                unset($inputs["product_edit"]);
                unset($inputs["product_delete"]);
                unset($inputs["service_view"]);
                unset($inputs["service_add"]);
                unset($inputs["service_edit"]);
                unset($inputs["service_delete"]);
                unset($inputs["orderx_view"]);
                unset($inputs["orderx_add"]);
                unset($inputs["orderx_edit"]);
                unset($inputs["orderx_delete"]);
                unset($inputs["cash_register_view"]);
                unset($inputs["cash_register_add"]);
                unset($inputs["cash_register_edit"]);
                unset($inputs["cash_register_delete"]);
                unset($inputs["admin_view"]);
                unset($inputs["admin_add"]);
                unset($inputs["admin_edit"]);
                unset($inputs["admin_delete"]);
                unset($inputs["agenda_view"]);
                unset($inputs["agenda_add"]);
                unset($inputs["agenda_edit"]);
                unset($inputs["agenda_delete"]);
                unset($inputs["salary_view"]);
                unset($inputs["salary_add"]);
                unset($inputs["salary_edit"]);
                unset($inputs["salary_delete"]);
                unset($inputs["cost_view"]);
                unset($inputs["cost_add"]);
                unset($inputs["cost_edit"]);
                unset($inputs["cost_delete"]);
                unset($inputs["pre_closing_view"]);
                unset($inputs["pre_closing_add"]);
                unset($inputs["pre_closing_edit"]);
                unset($inputs["pre_closing_delete"]);
                unset($inputs["month_closing_view"]);
                unset($inputs["month_closing_add"]);
                unset($inputs["month_closing_edit"]);
                unset($inputs["month_closing_delete"]);
            }

            //END UNSET CHECKBOXES IN SUPPLIET VIEW:

            try {
                $model->update($id, $inputs);

                switch ($this->UCF_object) {
                    case 'Animal':
                        $path2 = "Client/_cli_animal?cli_id=".$inputs['Id_client'];
                        double_redirect("Animal", $path2);
                        break;
                    
                    default:
                        $view = "$this->UCF_object/_list";
                        redirect("$view");
                        break;
                }
                
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        
    }

    //Deletes Supplier from DB
    public function delete_call($inputs){

        //Create new Model instance:
        $model = new('\Model\\'.$this->UCF_object);

        //Get Id from $_POST:
        if(isset($inputs["del_id"])){

            $id = $inputs["del_id"];
            try {
                $model->delete($id);
            } catch (\Throwable $th) {
                throw $th;
            }
            

        } else {
            die("Record Id not informed.");
        }
        
    }

}


    