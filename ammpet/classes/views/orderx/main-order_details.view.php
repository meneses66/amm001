<?php $GLOBALS['classnamejs']='Orderx';?>
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
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    <div class="row" style="border: thin solid black">
            <?php 
                $controller = new ('\Controller\\'."Orderx");
                $controller->get_header();
            ?>
    </div><br>
    <div class="row">
        <div class="col-sm-6" style="border: thin solid black">
            Animais
        </div>
        <div class="col-sm-6" style="border: thin solid black">
            Pacotes Ativos
        </div>
    </div><br>
    <div class="row" style="border: thin solid black">
        <div class="col-sm-6">
            Lista Serviços
        </div>
        <div class="col-sm-6">
            <a href="<?php echo ROOT."/Orderx/_new_service?cli_id=".$_GET['cli_id']."&order_id=".$_GET['order_id'];?>" class="btn btn-primary btn-lg m-1 btn-block">Novo Serviço</a>
        </div>
    </div><br>
    <div class="row">
        <div class="col-sm-12" style="border: thin solid black">
            Lista Produtos
        </div>
    </div><br>
    <div class="row">
        <div class="col-sm-12" style="border: thin solid black">
            Lista Pagamentos
        </div>
    </div><br>
</div>