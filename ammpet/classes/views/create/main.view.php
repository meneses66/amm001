<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Cadastros</h4>
        </div>
    </div>
    <hr class="my-1">
    <br><br><br><br>
    <div class="row">
        <div class="row">
            <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"client_add"))? print_r("<a href=\"" . ROOT . "/Client/_new\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-user-plus\"></i>&nbsp;Novo Cliente</a>") : print_r(""))?></div>
            <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"supplier_add"))? print_r("<a href=\"" . ROOT . "/Supplier/_new\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"far fa-id-badge\"></i>&nbsp;Novo Fornecedor</a>") : print_r(""))?></div>
        </div>
        <div class="row">
            <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"product_add"))? print_r("<a href=\"" . ROOT . "/Product/_new\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-barcode\"></i>&nbsp;Novo Produto</a>") : print_r(""))?></div>
            <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"service_add"))? print_r("<a href=\"" . ROOT . "/Service/_new\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-cut\"></i>&nbsp;Novo Serviço</a>") : print_r(""))?></div>
        </div>
        <div class="row">
            <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"breed_add"))? print_r("<a href=\"" . ROOT . "/Breed/_new\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-paw\"></i>&nbsp;Nova Raça</a>") : print_r(""))?></div>
            <div class="col-sm-6"></div>
        </div>
    </div>
</div>