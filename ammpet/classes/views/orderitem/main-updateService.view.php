<?php 
$GLOBALS['classnamejs']='Service';
$GLOBALS['buttonenablerjs']='OrderItem';
?>
<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h4>Selecionar Serviço</h4>
        </div>
        <div class="col-sm-6">
                <a href="<?php echo ROOT."/OrderItem/_back_order?cli_id=".$_GET['cli_id']."&order_id=".$_GET['order_id'];?>" class="btn btn-secondary btn-lg m-1 btn-block">Voltar</a>
        </div>
    </div>
    <div class="row" style="border: thin solid lightgray; font-size:12px;">
        <?php 
            $controller1 = new ('\Controller\\'."OrderItem");
            $controller1->load_parent_form();
        ?>
    </div>
    <div class="row">
        $controller2 = new ('\Controller\\'."OrderItem");
        $controller2->load_update_form();
    </div>
    
</div>