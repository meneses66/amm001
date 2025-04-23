<?php

namespace Controller;

//if(session_status() === PHP_SESSION_NONE) session_start();

restart_session();

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
        //$operation = 'goto_new';
        //$this->goto_view($operation);
        $view="$this->object/$this->object-new";
        $this->view($view);
    }

    //Sends to LIST View
    public function _list(){
        //$operation = 'goto_list';
        //$this->goto_view($operation);
        $view="$this->object/$this->object-list";
        $this->view($view);
    }

    //Sends to UPDATE View
    public function _update(){
        //$operation = 'goto_update';
        //$this->goto_view($operation);
        $view="$this->object/$this->object-update";
        $this->view($view);
    }

    //Sends to UPDATE View
    public function _update_payment(){
        $view="$this->object/$this->object-addPayment";
        $this->view($view);
    }

    //Sends to DELETE View
    public function _delete(){
        //$operation = 'goto_delete';
        //$this->goto_view($operation);
        $view="$this->object/$this->object-delete";
        $this->view($view);
    }

    //THIS SESSION APPLIES ONLY TO CLIENT:

    public function _cli_animal(){
        //$operation = 'goto_cli_animal';
        //$this->goto_view($operation);
        $view="$this->object/$this->object-animal";
        $this->view($view);

    }

    public function _cli_package(){
        //$operation = 'goto_cli_package';
        //$this->goto_view($operation);
        $view="$this->object/$this->object-package";
        $this->view($view);
    }

    public function _cli_product(){
        //$operation = 'goto_cli_product';
        //$this->goto_view($operation);
        $view="$this->object/$this->object-product";
        $this->view($view);
    }

    public function _cli_service(){
        $view="$this->object/$this->object-service";
        $this->view($view);
        //$operation = 'goto_cli_service';
        //$this->goto_view($operation);
    }

    public function _new_animal(){
        $operation = 'goto_cli_new_animal';
        
        if (isset($_GET['cli_id'])&&isset($_GET['id'])){
            $cli_id = $_GET['cli_id'];
            $id = $_GET['id'];
            $path2 = "Animal/_new?cli_id=".$cli_id."&id=".$id;
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

    public function _back_order(){
        
        if (isset($_GET['cli_id']) AND isset($_GET['order_id'])){
            $cli_id = $_GET['cli_id'];
            $order_id = $_GET['order_id'];
            $path2 = "Orderx/_details?cli_id=".$cli_id."&order_id=".$order_id;
            double_redirect("OrderItem",$path2);
        } else{
            echo "Issue to return Cli_Id.";
        }
    }

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
        //$operation = 'goto_order_details';
        //$this->goto_view($operation);
        $view="$this->object/$this->object-order_details";
        $this->view($view);
    }

    //GOES TO SCREEN TO SELECT SERVICE SO IT CAN BE INSERTED:
    public function _new_service(){
        
        if (isset($_GET['cli_id']) AND isset($_GET['order_id'])){
            $cli_id = $_GET['cli_id'];
            $order_id = $_GET['order_id'];
            $path2 = "OrderItem/_addService?cli_id=".$cli_id."&order_id=".$order_id;
            double_redirect("Orderx", $path2);
        } else{
            echo "Issue to return Cli_Id.";
        }
    }

    //GOES TO SCREEN TO SELECT PRODUCT SO IT CAN BE INSERTED:
    public function _new_product(){
        
        if (isset($_GET['cli_id']) AND isset($_GET['order_id'])){
            $cli_id = $_GET['cli_id'];
            $order_id = $_GET['order_id'];
            $path2 = "OrderItem/_addProduct?cli_id=".$cli_id."&order_id=".$order_id;
            double_redirect("Orderx", $path2);
        } else{
            echo "Issue to return Cli_Id.";
        }
    }

        //GOES TO SCREEN TO AD NEW PAYMENT:
        public function _new_payment(){
        
            if (isset($_GET['cli_id']) AND isset($_GET['order_id'])){
                $cli_id = $_GET['cli_id'];
                $order_id = $_GET['order_id'];
                $path2 = "OrderPayment/_addPayment?cli_id=".$cli_id."&order_id=".$order_id."&paym_id=new";
                double_redirect("Orderx", $path2);
            } else{
                echo "Issue to return Cli_Id.";
            }
        }

    public function _addService(){
        $view="$this->object/$this->object-addService";
        $this->view($view);
    }

    public function _addProduct(){
        $view="$this->object/$this->object-addProduct";
        $this->view($view);
    }

    public function _addPayment(){
        $view="$this->object/$this->object-addPayment";
        $this->view($view);
    }

    public function _update_service(){
        
        if (isset($_GET['cli_id']) AND isset($_GET['order_id']) AND isset($_GET['item_id'])){
            $cli_id = $_GET['cli_id'];
            $order_id = $_GET['order_id'];
            $item_id = $_GET['item_id'];
            $path = "OrderItem/_updateService?cli_id=".$cli_id."&order_id=".$order_id."&item_id=".$item_id;
            redirect($path);
        } else{
            echo "Issue to return Cli_Id.";
        }
    }

    public function _update_product(){
        
        if (isset($_GET['cli_id']) AND isset($_GET['order_id']) AND isset($_GET['item_id'])){
            $cli_id = $_GET['cli_id'];
            $order_id = $_GET['order_id'];
            $item_id = $_GET['item_id'];
            $path = "OrderItem/_updateProduct?cli_id=".$cli_id."&order_id=".$order_id."&item_id=".$item_id;
            redirect($path);
        } else{
            echo "Issue to return Cli_Id.";
        }
    }

    public function _updateService(){
        $view="$this->object/$this->object-updateService";
        $this->view($view);
    }

    public function _updateProduct(){
        $view="$this->object/$this->object-updateProduct";
        $this->view($view);
    }

    //SESSION TO CALL DB ACTIONS: INSERT, UPDATE, DELETE

    //Inserts new Supplier into DB
    public function insert_call(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Create new Login instance:
            $model = new('\Model\\'.$this->UCF_object);

            //Define inputs for DB operations:
            //$log = "::INSERT CALL::";
            foreach ($_POST as $key => $value) {
                $inputs[$key]=$value;
                //$log .= date("H:i:s")."--> Input: ".$key." = ".$value."| ";
            }
            //wh_log($log);

            //Special condition when Object is Orderx:
            if($this->UCF_object=="Orderx" AND isset($_GET['cli_id'])){
                $inputs['Created_By']=$_SESSION['username'];
                $inputs['Updated_By']=$_SESSION['username'];
                $inputs['Order_Date']=date("Y-m-d");
                $inputs['Status']="Aberto";
            }

            //Special condition when Object is OrderItem:
            if($this->UCF_object=="OrderItem" AND isset($_GET['order_id'])){

                $prod_serv_type = $inputs['Prod_Serv_Type'];
                $prod_serv_category = $inputs['Prod_Serv_Category'];
                $inputs['Created_By']=$_SESSION['username'];
                $inputs['Updated_By']=$_SESSION['username'];
                $inputs['Date']=date("Y-m-d");
                $inputs['Quantity']="1";
                $inputs['Discount_Value']="0";
                $inputs['Salesperson']="Viviam Bragantine";

                $cli_id = $_GET['cli_id'];
                $order_id = $_GET['order_id'];
                unset($inputs["Order_Date"]);
                unset($inputs["Status"]);
                unset($inputs["temp_package"]);
                unset($inputs["temp_executor"]);
                unset($inputs["temp_salesperson"]);

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
                if($inputs["Id_Breed"]==""){
                    $inputs["Id_Breed"]=null;
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

                //IF LOGIN == "" UPDATE TO NULL:
                if($inputs["Login"]==""){
                    $inputs["Login"]=null;
                }

                //UNSET PERMISSION FLAGS:
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
                unset($inputs["breed_view"]);
                unset($inputs["breed_add"]);
                unset($inputs["breed_edit"]);
                unset($inputs["breed_delete"]);
                unset($inputs["cobrancas_view"]);
                unset($inputs["vencimento_pacotes_view"]);
                unset($inputs["vencimento_vacinas_view"]);
                unset($inputs["tosador_view"]);
                unset($inputs["vet_view"]);
                unset($inputs["comis_view"]);
                unset($inputs["result_view"]);
                unset($inputs["orderitem_view"]);
                unset($inputs["orderitem_add"]);
                unset($inputs["orderitem_edit"]);
                unset($inputs["orderitem_delete"]);
                unset($inputs["orderpayment_view"]);
                unset($inputs["orderpayment_add"]);
                unset($inputs["orderpayment_edit"]);
                unset($inputs["orderpayment_delete"]);
                unset($inputs["orderitemprod_view"]);
                unset($inputs["orderitemprod_add"]);
                unset($inputs["orderitemprod_edit"]);
                unset($inputs["orderitemprod_delete"]);

            }

            //Special condition when Object is Package:
            if($this->UCF_object=="Package"){
                $inputs['Created_By']=$_SESSION['username'];
                $inputs['Updated_By']=$_SESSION['username'];
                $inputs['Pack_Date']=date("Y-m-d");
                $inputs['Pack_Status']="Aberto";
                $inputs['Pack_Consumed']=0;
            }

            if($this->UCF_object=="OrderPayment"){
                $order_id=$_GET['order_id'];

                if(isset($inputs["Flag1"])){
                    $inputs["Flag1"]="1";
                }else{
                    $inputs["Flag1"]="0";
                }
            }

            if($this->UCF_object=="Salary"){
                unset($inputs["Temp_Id_Employee"]);
            }

            try {

                $new_id=$model->insert($inputs);

                switch ($this->UCF_object) {
                    case 'Animal':
                        $path2 = "Client/_cli_animal?cli_id=".$inputs['Id_Client'];
                        unset_array($inputs);
                        double_redirect("Animal", $path2);
                        break;
                    
                    case 'Orderx':
                        $view = "$this->UCF_object/_details?cli_id=".$inputs['Id_client']."&order_id=".$new_id;
                        unset_array($inputs);
                        redirect("$view");
                        break;

                    case 'OrderItem':
                        if($prod_serv_type=="Serv"){
                            $view = "$this->UCF_object/_updateService?cli_id=".$cli_id."&order_id=".$order_id."&item_id=".$new_id;
                        }
                        if($prod_serv_type=="Prod"){
                            $view = "$this->UCF_object/_updateProduct?cli_id=".$cli_id."&order_id=".$order_id."&item_id=".$new_id;
                        }
                        unset_array($inputs);
                        redirect("$view");
                        break;

                    case 'Package':
                        unset_array($inputs);
                        break;
                    
                    case 'OrderPayment':

                        //CALL UPDATE ORDER PAYMENTS:
                        unset($_POST);
                        $_SERVER['REQUEST_METHOD'] = 'POST';
                        $_POST['class']="Orderx";
                        $_POST['method']="update_totals";
                        $_POST['Id']=$order_id;
            
                        $ajax_call = new('\Controller\\'."Ajax_call");
                        $ajax_call->index();

                        //AFTER ORDER PAYMENTS HAS BEEN UPDATED, REDIRECTS TO ORDER DETAILS:
                        $path2 = "Orderx/_details?cli_id=".$_GET['cli_id']."&order_id=".$_GET['order_id'];
                        unset_array($inputs);
                        double_redirect("OrderPayment", $path2);
                        break;

                    case 'Salary':
                        unset_array($inputs);
                        break;

                    case 'Product':
                        unset($_POST);
                        unset($inputs);
                        break;

                    case 'Service':
                        unset($_POST);
                        unset($inputs);
                        break;

                    case 'Client':
                        unset($_POST);
                        unset($inputs);
                        break;

                    default:
                        $view = "$this->UCF_object/_list";
                        unset_array($inputs);
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
            //$log = "::UPDATE CALL::";
            foreach ($_POST as $key => $value) {
                $inputs[$key]=$value;
                //$log .= date("H:i:s")."--> Input: ".$key." = ".$value."| ";
            }
            //wh_log($log);

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
                if($inputs["Id_Breed"]==""){
                    $inputs["Id_Breed"]=null;
                }
                unset($inputs["temp_breed"]);
            }

            //Special condition when Object is OrderItem:
            if($this->UCF_object=="OrderItem"){
 
                $cli_id = $_GET['cli_id'];
                $order_id = $_GET['order_id'];
                $item_id = $_GET['item_id'];

                if (isset($inputs["Id_Package"])) {
                    $package_id = $inputs['Id_Package'];
                }
                if (isset($inputs["Id_Package_Animal"])) {
                    $animal_id = $inputs['Id_Package_Animal'];
                }
                if (isset($inputs["Id_Prod_Serv"])) {
                    $prod_serv_id = $inputs['Id_Prod_Serv'];
                }
                if (isset($inputs["Package_Amount"])) {
                    $pack_quantity = $inputs['Package_Amount'];
                }
                if (isset($inputs["Package_Service"])) {
                    $pack_name = $inputs['Package_Service'];
                }
                if (isset($inputs["Prod_Serv_Category"])) {
                    $prod_serv_category = $inputs['Prod_Serv_Category'];
                }
                if (isset($inputs["Prod_Serv_Type"])) {
                    $prod_serv_type = $inputs['Prod_Serv_Type'];
                }
                
                unset($inputs["Order_Date"]);
                unset($inputs["Status"]);
                unset($inputs["temp_package"]);
                unset($inputs["temp_executor"]);
                unset($inputs["temp_salesperson"]);
                unset($inputs["temp_id_animal_pkg"]);
                unset($inputs["operation"]);
                unset($inputs["class"]);
                unset($inputs["method"]);
                unset($inputs["Id"]);
                //Remove items from array inputs that are populated automatically in DB
                unset($inputs["Created"]);
                unset($inputs["Updated"]);

                //FLAGS SERVICE:
                if(isset($inputs['Flag_Contrario'])){
                    $inputs['Flag_Contrario']="1";
                }else{
                    $inputs['Flag_Contrario']="0";
                }

                if(isset($inputs['Flag_Comission'])){
                    $inputs['Flag_Comission']="1";
                }else{
                    $inputs['Flag_Comission']="0";
                }

                if(isset($inputs['Flag_Otite'])){
                    $inputs['Flag_Otite']="1";
                }else{
                    $inputs['Flag_Otite']="0";
                }

                if(isset($inputs['Flag_Olhos_Verm'])){
                    $inputs['Flag_Olhos_Verm']="1";
                }else{
                    $inputs['Flag_Olhos_Verm']="0";
                }

                if(isset($inputs['Flag_Pulga'])){
                    $inputs['Flag_Pulga']="1";
                }else{
                    $inputs['Flag_Pulga']="0";
                }

                if(isset($inputs['Flag_Carrapato'])){
                    $inputs['Flag_Carrapato']="1";
                }else{
                    $inputs['Flag_Carrapato']="0";
                }

                if(isset($inputs['Flag_Dermatite'])){
                    $inputs['Flag_Dermatite']="1";
                }else{
                    $inputs['Flag_Dermatite']="0";
                }

                if(isset($inputs['Flag_Ferida'])){
                    $inputs['Flag_Ferida']="1";
                }else{
                    $inputs['Flag_Ferida']="0";
                }

                if(isset($inputs['Flag_Outro'])){
                    $inputs['Flag_Outro']="1";
                }else{
                    $inputs['Flag_Outro']="0";
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

                //IF LOGIN == "" UPDATE TO NULL:
                if($inputs["Login"]==""){
                    $inputs["Login"]=null;
                }

                //Remove items from array inputs that are not columns in DB (op) or are auto-increment (Id)
                unset($inputs["operation"]);
                unset($inputs["class"]);
                unset($inputs["method"]);
                unset($inputs["Id"]);
                //Remove items from array inputs that are populated automatically in DB
                unset($inputs["Created"]);
                unset($inputs["Updated"]);
                
                //UNSET PERMISSION FLAGS:
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
                unset($inputs["breed_view"]);
                unset($inputs["breed_add"]);
                unset($inputs["breed_edit"]);
                unset($inputs["breed_delete"]);
                unset($inputs["cobrancas_view"]);
                unset($inputs["vencimento_pacotes_view"]);
                unset($inputs["vencimento_vacinas_view"]);
                unset($inputs["tosador_view"]);
                unset($inputs["vet_view"]);
                unset($inputs["comis_view"]);
                unset($inputs["result_view"]);
                unset($inputs["orderitem_view"]);
                unset($inputs["orderitem_add"]);
                unset($inputs["orderitem_edit"]);
                unset($inputs["orderitem_delete"]);
                unset($inputs["orderpayment_view"]);
                unset($inputs["orderpayment_add"]);
                unset($inputs["orderpayment_edit"]);
                unset($inputs["orderpayment_delete"]);
                unset($inputs["orderitemprod_view"]);
                unset($inputs["orderitemprod_add"]);
                unset($inputs["orderitemprod_edit"]);
                unset($inputs["orderitemprod_delete"]);

            }

            if($this->UCF_object=="Package"){
                $type_goto="dynamic";
                if (isset($inputs['type'])) {
                    $type_goto=$inputs['type'];
                    unset($inputs["type"]);
                }
                if (isset($inputs['class'])) {
                    unset($inputs["class"]);
                }
                if (isset($inputs['method'])) {
                    unset($inputs["method"]);
                }
                if (isset($inputs['Id_Package'])) {
                    unset($inputs["Id_Package"]);
                }

            }

            if ($this->UCF_object=="OrderPayment") {
                $order_id=$_GET['order_id'];

                if(isset($inputs["Flag1"])){
                    $inputs["Flag1"]="1";
                }else{
                    $inputs["Flag1"]="0";
                }
            }

            if($this->UCF_object=="Salary"){

                $type_goto="dynamic";
                if (isset($inputs['type'])) {
                    $type_goto=$inputs['type'];
                    unset($inputs["type"]);
                }
                if (isset($inputs['class'])) {
                    unset($inputs["class"]);
                }
                if (isset($inputs['method'])) {
                    unset($inputs["method"]);
                }
                if (isset($inputs['Temp_Id_Employee'])) {
                    unset($inputs["Temp_Id_Employee"]);
                }
                if (isset($inputs["Created_By2"])) {
                    $created_by2 = $inputs["Created_By2"];
                    unset($inputs["Created_By2"]);
                }
                if (isset($inputs["Updated_By2"])) {
                    $updated_by2 = $inputs["Updated_By2"];
                    unset($inputs["Updated_By2"]);
                }
                if (isset($inputs["Salary_Item_Value2"])) {
                    $salary_item_value2 = $inputs["Salary_Item_Value2"];
                    unset($inputs["Salary_Item_Value2"]);
                }
                if (isset($inputs["Salary_Item_Type2"])) {
                    $salary_item_type2 = $inputs["Salary_Item_Type2"];
                    unset($inputs["Salary_Item_Type2"]);
                }
                if (isset($inputs["Id_Employee2"])) {
                    $id_employee2 = $inputs["Id_Employee2"];
                    unset($inputs["Id_Employee2"]);
                }
                if (isset($inputs["Ref_Date2"])) {
                    $ref_date2 = $inputs["Ref_Date2"];
                    unset($inputs["Ref_Date2"]);
                }
                if (isset($inputs["Salary_Item_Status2"])) {
                    $salary_item_status2 = $inputs["Salary_Item_Status2"];
                    unset($inputs["Salary_Item_Status2"]);
                }
                if (isset($inputs["Salary_Item_Description2"])) {
                    $salary_item_description2 = $inputs["Salary_Item_Description2"];
                    unset($inputs["Salary_Item_Description2"]);
                }
            }

            //END UNSET CHECKBOXES IN SUPPLIET VIEW:

            try {

                $model->update($id, $inputs);

                switch ($this->UCF_object) {
                    case 'Animal':
                        $path2 = "Client/_cli_animal?cli_id=".$inputs['Id_Client'];
                        unset_array($inputs);
                        double_redirect("Animal", $path2);
                        break;
                    
                    case 'OrderItem':

                        //CALL UPDATE ORDER TOTALS:
                        unset($_POST);
                        $_SERVER['REQUEST_METHOD'] = 'POST';
                        $_POST['class']="Orderx";
                        $_POST['method']="update_totals";
                        $_POST['Id']=$order_id;
            
                        $ajax_call = new('\Controller\\'."Ajax_call");
                        $ajax_call->index();
            
                        /* FUNCTION update_payments merged into update_totals
                        //CALL UPDATE ORDER PAYMENTS:
                        unset($_POST);
                        $_SERVER['REQUEST_METHOD'] = 'POST';
                        $_POST['class']="Orderx";
                        $_POST['method']="update_payments";
                        $_POST['Id']=$order_id;
            
                        $ajax_call = new('\Controller\\'."Ajax_call");
                        $ajax_call->index();
                        */

                        //UPDATES WHEN SERVICE:
                        //if($prod_serv_type=="Serv"){

                        //CALL UPDATE PACKAGES:
                        if ( $prod_serv_type=="Serv" && !($package_id==1)) {
                            unset($_POST);
                            $_SERVER['REQUEST_METHOD'] = 'POST';
                            $_POST['class']="Package";
                            $_POST['method']="update_package";
                            $_POST['Id_Package']=$package_id;
                            $_POST['Id']=$id;

                            $ajax_call = new('\Controller\\'."Ajax_call");
                            $ajax_call->index();
                        }
                        
                        if ($prod_serv_type=="Serv" && $prod_serv_category=="Pacote") {

                            $package_input['Id_Order_Item'] = $id;
                            require_once removeFromEnd(ROOTPATH_CLASSES,"core/").'controllers/Package.php';
                            $package_model = new('\Model\\'."Package");
                            $package_row = $package_model->getRow($package_input);

                            if (!($package_row)) {
                                unset($_POST);
                                $_SERVER['REQUEST_METHOD'] = 'POST';

                                $_POST['Id_Client']=$cli_id;
                                $_POST['Id_Animal']=$animal_id;
                                $_POST['Id_Order']=$order_id;
                                $_POST['Id_Order_Item']=$id;
                                $_POST['Id_Prod_Serv']=$prod_serv_id;
                                $_POST['Pack_Quantity']=$pack_quantity;
                                $_POST['Pack_Name']=$pack_name;
                                
                                $_POST['class']="Package";
                                $_POST['method']="insert_call";
                    
                                $ajax_call = new('\Controller\\'."Ajax_call");
                                $ajax_call->index();
                            }

                            unset($package_input);
                            $package_model=null;
                            $package_row=null;
                        }
                            
                        //}

                        //UPDATES WHEN PRODUCT:
                        //if($prod_serv_type=="Prod"){
                        //}

                        
                        //REDIRECT TO ORDER DETAILS:
                        //$path2 = "Orderx/_details?cli_id=".$inputs['Id_client']."&order_id=".$inputs['Id_order'];
                        $path2 = "Orderx/_details?cli_id=".$cli_id."&order_id=".$order_id;
                        unset_array($inputs);
                        double_redirect("OrderItem", $path2);
                        break;
    
                    case 'Orderx':
                        unset_array($inputs);
                        break;

                    case 'Package':
                        if ($type_goto=='static') {
                            unset_array($inputs);
                            break;
                        } else {
                            $view = "$this->UCF_object/_list";
                            unset_array($inputs);
                            redirect("$view");
                            break;
                        }

                    case 'Salary':
                            if ($type_goto=='static') {
                                //unset_array($inputs);
                                unset($_POST);
                                $_SERVER['REQUEST_METHOD']="POST";
                               
                                $_POST['class']="Salary";
                                $_POST['method']="insert_call";
                                
                                $_POST['Created_By']=$created_by2;
                                $_POST['Updated_By']=$updated_by2;
                                $_POST['Salary_Item_Value']=$salary_item_value2;
                                $_POST['Salary_Item_Type']=$salary_item_type2;
                                $_POST['Id_Employee']=$id_employee2;
                                $_POST['Ref_Date']=$ref_date2;
                                $_POST['Salary_Item_Status']=$salary_item_status2;
                                $_POST['Salary_Item_Description']=$salary_item_description2;
                                $_POST['Original_Value']=0.00;
                                $_POST['Postponed_Value']=0.00;
                    
                                $ajax_call = new('\Controller\\'."Ajax_call");
                                $ajax_call->index();
                    
                                break;
                            } else {
                                //$view = "$this->UCF_object/_list";
                                //unset_array($inputs);
                                //redirect("$view");
                                break;
                            }
    
                    case 'OrderPayment':

                        //CALL UPDATE ORDER PAYMENTS:
                        unset($_POST);
                        $_SERVER['REQUEST_METHOD'] = 'POST';
                        $_POST['class']="Orderx";
                        $_POST['method']="update_totals";
                        $_POST['Id']=$order_id;
            
                        $ajax_call = new('\Controller\\'."Ajax_call");
                        $ajax_call->index();

                        $path2 = "Orderx/_details?cli_id=".$_GET['cli_id']."&order_id=".$_GET['order_id'];
                        unset_array($inputs);
                        double_redirect("OrderPayment", $path2);
                        break;
                    
                    case 'Product':
                        unset($_POST);
                        unset($inputs);
                        break;

                    case 'Service':
                        unset($_POST);
                        unset($inputs);
                        break;

                    case 'Client':
                        unset($_POST);
                        unset($inputs);
                        break;

                    default:
                        $view = "$this->UCF_object/_list";
                        unset_array($inputs);
                        redirect("$view");
                        break;
                }
                
            } catch (\Throwable $th) {
                echo var_dump($inputs);
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
            if (isset($inputs['order_id'])) {
                $order_id=$inputs['order_id'];
            }
            if (isset($inputs['package_id'])) {
                $package_id=$inputs['package_id'];
            }
            unset_array($inputs);
            try {
                $model->delete($id);
            } catch (\Throwable $th) {
                throw $th;
            }

            switch ($this->UCF_object) {
                case 'OrderItem':
                    //CALL UPDATE ORDER TOTALS:
                    unset($_POST);
                    $_SERVER['REQUEST_METHOD'] = 'POST';
                    $_POST['class']="Orderx";
                    $_POST['method']="update_totals";
                    $_POST['Id']=$order_id;
        
                    $ajax_call = new('\Controller\\'."Ajax_call");
                    $ajax_call->index();
        
                    /* FUNCTION update_payments merged into update_totals
                    //CALL UPDATE ORDER PAYMENTS:
                    unset($_POST);
                    $_SERVER['REQUEST_METHOD'] = 'POST';
                    $_POST['class']="Orderx";
                    $_POST['method']="update_payments";
                    $_POST['Id']=$order_id;
        
                    $ajax_call = new('\Controller\\'."Ajax_call");
                    $ajax_call->index();
                    */
        
                    //CALL UPDATE PACKAGES:
                    if (!($inputs['Id_Package']==1)) {
                        unset($_POST);
                        $_SERVER['REQUEST_METHOD'] = 'POST';
                        $_POST['class']="Package";
                        $_POST['method']="update_package";
                        $_POST['Id_Package']=$package_id;
                        $_POST['Id']=$id;
            
                        $ajax_call = new('\Controller\\'."Ajax_call");
                        $ajax_call->index();
                    }
                break;
            
                case 'OrderPayment':

                    //CALL UPDATE ORDER PAYMENTS:
                    unset($_POST);
                    $_SERVER['REQUEST_METHOD'] = 'POST';
                    $_POST['class']="Orderx";
                    $_POST['method']="update_totals";
                    $_POST['Id']=$order_id;
        
                    $ajax_call = new('\Controller\\'."Ajax_call");
                    $ajax_call->index();
                    
                    break;
                
                default:
                    # code...
                    break;
            }
            

        } else {
            die("Record Id not informed.");
        }
        
    }

    //GET POST DATA AND CALL INSERT CALL TO ADD SERVICE INTO DATABASE
    public function _insert_service(){
        
        if (isset($_GET['cli_id']) AND isset($_GET['order_id'])){
            $cli_id = $_GET['cli_id'];
            $order_id = $_GET['order_id'];
            $service = $_GET['service'];
            $service = stripslashes(trim($service));

            //$service_array = explode(';', $service);
            //echo var_dump($service_array);
            //$service = utf8_encode($service);

            $service = cleanString($service);
            //$service = preg_replace('/[[:cntrl:]]/', '', $service);
            //$service = preg_replace( "/\p{Cc}*$/u", '', $service);
            //$service = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $service);
            $service = str_replace("'", '"', $service);
            $service = iconv('UTF-8', 'UTF-8',$service);

            //echo var_dump($service);
            //$json_array = json_decode($json, true);
            //echo (var_dump($json_array));
            $service_array = json_decode2(html_entity_decode($service), true);
            //$service_array  = unserialize($service);
            //echo var_dump($service_array);
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $_POST['class']="OrderItem";
            $_POST['method']="insert_call";
            $_POST['Id_Client']=$cli_id;
            $_POST['Id_Order']=$order_id;
            $_POST['Id_Prod_Serv']=$service_array->ID;

            $_POST['Unit_Value']=$service_array->PRICE;
            $_POST['Value_No_Discount']=$service_array->PRICE;
            $_POST['Value_With_Discount']=$service_array->PRICE;
            $_POST['Prod_Serv_Type']=$service_array->TYPE;
            $_POST['Flag_Comission']=$service_array->COMISSION_FLG;
            $_POST['External_Cost']=$service_array->EXTERNAL_COST;
            $_POST['Comission_Percentage']=$service_array->COMISSION_PERCENTAGE;
            $_POST['Cost_Center']=$service_array->CENTER;
            $_POST['Prod_Serv_Category']=$service_array->CATEGORY;
            $_POST['Item_Description']=$service_array->NAME;
            $_POST['OI_Price_Cash']=$service_array->PRICE_CASH;
            $_POST['Total_Cash']=$service_array->PRICE_CASH;
            $_POST['OI_Price_Pix']=$service_array->PRICE_PIX;
            $_POST['Total_Pix']=$service_array->PRICE_PIX;
            $_POST['Prodserv_Code']=$service_array->CODE;
            $_POST['Package_Amount']=$service_array->PACKAGE_AMOUNT;
            $_POST['OI_Comission_Overwrite_Flg']=$product_array->COMISSION_OVERWRITE_FLG;

            $_POST['Id_Package']="1";
            $_POST['Id_Package_Animal']="1";
            $_POST['Serv_Executor']="XXXX";
            $_POST['Package_Service']="Banho";
            $_POST['Package_Sequence']=0;
            $_POST['Package_Consume']=0;
            $_POST['Flag_Otite']=0;
            $_POST['Flag_Olhos_Verm']=0;
            $_POST['Flag_Pulga']=0;
            $_POST['Flag_Carrapato']=0;
            $_POST['Flag_Dermatite']=0;
            $_POST['Flag_Ferida']=0;
            $_POST['Flag_Outro']=0;
            $_POST['Flag_Contrario']=0;

            $ajax_call = new('\Controller\\'."Ajax_call");
            $ajax_call->index();
            
        } else{
            echo "Issue to return Cli_Id and Order_id.";
        }
    }

    //GET POST DATA AND CALL INSERT CALL TO ADD Product INTO DATABASE
    public function _insert_product(){
        
        if (isset($_GET['cli_id']) AND isset($_GET['order_id'])){
            $cli_id = $_GET['cli_id'];
            $order_id = $_GET['order_id'];
            $product = $_GET['product'];
            $product = stripslashes(trim($product));

            $product = cleanString($product);
            $product = str_replace("'", '"', $product);
            $product = iconv('UTF-8', 'UTF-8',$product);

            $product_array = json_decode2(html_entity_decode($product), true);
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $_POST['class']="OrderItem";
            $_POST['method']="insert_call";
            $_POST['Id_Client']=$cli_id;
            $_POST['Id_Order']=$order_id;
            $_POST['Id_Prod_Serv']=$product_array->ID;

            $_POST['Unit_Value']=$product_array->PRICE;
            $_POST['Value_No_Discount']=$product_array->PRICE;
            $_POST['Value_With_Discount']=$product_array->PRICE;
            $_POST['Prod_Serv_Type']=$product_array->TYPE;
            $_POST['Flag_Comission']=$product_array->COMISSION_FLG;
            $_POST['External_Cost']=$product_array->EXTERNAL_COST;
            $_POST['Comission_Percentage']=$product_array->COMISSION_PERCENTAGE;
            $_POST['Cost_Center']=$product_array->CENTER;
            $_POST['Prod_Serv_Category']=$product_array->CATEGORY;
            $_POST['Item_Description']=$product_array->NAME;
            $_POST['OI_Price_Cash']=$product_array->PRICE_CASH;
            $_POST['Total_Cash']=$product_array->PRICE_CASH;
            $_POST['OI_Price_Pix']=$product_array->PRICE_PIX;
            $_POST['Total_Pix']=$product_array->PRICE_PIX;
            $_POST['Prodserv_Code']=$product_array->CODE;
            //$_POST['Package_Amount']=$product_array->PACKAGE_AMOUNT;
            $_POST['OI_Comission_Overwrite_Flg']=$product_array->COMISSION_OVERWRITE_FLG;
            $_POST['Prod_Serv_Group']=$product_array->GROUP_X;

            $ajax_call = new('\Controller\\'."Ajax_call");
            $ajax_call->index();
            
        } else{
            echo "Issue to return Cli_Id and Order_id.";
        }
    }

}


    