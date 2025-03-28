<?php 
    $GLOBALS['classnamejs']='Orderx';
    $GLOBALS['buttonenablerjs']='';
    $GLOBALS['cli_id_js']='';
    $GLOBALS['order_id_js']='';
?>
<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h4>Venda - Detalhes</h4>
        </div>
        <div class="col-sm-2">
        </div>
        <div class="col-sm-4">
            <a href="<?php echo ROOT."/Orderx/_list";?>" class="btn btn-secondary btn-lg m-1 btn-block">Voltar</a>
        </div>
    </div>
    <div class="row" style="border: thin solid lightgray; font-size:12px;">
            <?php 
                $controller = new ('\Controller\\'."Orderx");
                $controller->get_header();
            ?>
    </div><br>
    <div class="row">
        <div class="col-sm-6" style="border: thin solid lightgray; font-size:12px;">
            <p style="font-size:12px;" >Animais</p>
            <div class="table-responsive" id="_animals" style="font-size:12px;">
                <table id="_table_ani" class="table Table-stripped table-sm table-bordered small">
                    <?php 
                        $controller = new ('\Controller\\'."Orderx");
                        $controller->get_animals();
                    ?>        
                </table>
            </div>
        </div>
        <div class="col-sm-6" style="border: thin solid lightgray; font-size:12px;">
            <p style="font-size:10px;" >Pacotes</p>
            <div class="table-responsive" id="_packages" style="font-size:12px;">
                <table id="_table_pkg" class="table Table-stripped table-sm table-bordered small">
                    <?php 
                        $controller = new ('\Controller\\'."Orderx");
                        $controller->get_packages();
                    ?>        
                </table>
            </div>
        </div>
    </div><br>
    <div class="row" style="border: thin solid lightgray; font-size:12px;">
        <div class="col-sm-6">
            <p style="font-size:12px;" >Serviços</p>
            <div class="table-responsive" id="_services" style="font-size:12px;">
                <table id="_table_services" class="table Table-stripped table-sm table-bordered small">
                    <?php 
                        $controller = new ('\Controller\\'."Orderx");
                        $controller->get_services();
                    ?>        
                </table>
            </div>
        </div>
        <div class="col-sm-6">
            <a href="<?php echo ROOT."/Orderx/_new_service?cli_id=".$_GET['cli_id']."&order_id=".$_GET['order_id'];?>" class="btn btn-primary btn-lg m-1 btn-block">Novo Serviço</a>
        </div>
    </div><br>
    <div class="row">
        <div class="col-sm-12" style="border: thin solid lightgray; font-size:12px;">
            Lista Produtos
        </div>
    </div><br>
    <div class="row">
        <div class="col-sm-12" style="border: thin solid lightgray; font-size:12px;">
            Lista Pagamentos
        </div>
    </div><br>
</div>