<?php 
    $GLOBALS['classnamejs']='Service';
    $GLOBALS['buttonenablerjs']='OrderItem';
    $GLOBALS['cli_id_js']='';
    $GLOBALS['order_id_js']='';
?>
<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h4>Editar Serviço</h4>
        </div>
        <div class="col-sm-2">
        </div>
        <div class="col-sm-4">
                <a href="<?php echo ROOT."/OrderItem/_back_order?cli_id=".$_GET['cli_id']."&order_id=".$_GET['order_id'];?>" class="btn btn-secondary btn-lg m-1 btn-block">Voltar</a>
        </div>
    </div>
    <div class="row" style="border: thin solid lightgray; font-size:12px;">
        <?php 
            //$controller1 = new ('\Controller\\'."OrderItem");
            require_once removeFromEnd(ROOTPATH_CLASSES,"/core").'/controllers/Orderx.php';   
            $controller1 = new ('\Controller\\'."Orderx");
            $controller1->get_header();
        ?>
    </div>
    <div class="row">
        <div class="col-sm-6" style="border: thin solid lightgray; font-size:12px;">
            <p style="font-size:12px; font-weight:bold;" >Animais</p>
            <div class="table-responsive" id="_animals" style="font-size:12px;">
                <table id="_table_ani" class="table Table-stripped table-sm table-bordered small">
                    <?php
                        require_once removeFromEnd(ROOTPATH_CLASSES,"/core").'/controllers/Orderx.php';   
                        $controller2 = new ('\Controller\\'."Orderx");
                        $controller2->get_animals();
                    ?>        
                </table>
            </div>
        </div>
        <div class="col-sm-6" style="border: thin solid lightgray; font-size:12px;">
            <p style="font-size:10px; font-weight:bold;" >Pacotes</p>
            <div class="table-responsive" id="_packages" style="font-size:12px;">
                <table id="_table_pkg" class="table Table-stripped table-sm table-bordered small">
                    <?php
                        require_once removeFromEnd(ROOTPATH_CLASSES,"/core").'/controllers/Orderx.php';    
                        $controller3 = new ('\Controller\\'."Orderx");
                        $controller3->get_packages();
                    ?>        
                </table>
            </div>
        </div>
    </div>
    <div class="row" style="border: thin solid lightgray; font-size:12px;">
        <form method="post" onsubmit="return validate_service()">
            <input type="hidden" name="operation" value="update">
            <?php
                $controller4 = new ('\Controller\\'."OrderItem");
                $controller4->load_update_form();
            ?>
        </form>
    </div>
    
</div>