<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Vendas</h4>
        </div>
    </div>
    <hr class="my-1">
    <br><br><br><br>
    <div class="row">
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"orderx_view"))? print_r("<a href=\"". ROOT."/Orderx/_list\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"far fa-money-bill-alt\"></i>&nbsp;Histórico de Vendas</a>") : print_r(""))?></div>
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"orderx_add"))? print_r("<a href=\"". ROOT."/Orderx/_new\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-donate\"></i>&nbsp;Nova Venda</a>") : print_r(""))?></div>
    </div>
    <br>
</div>