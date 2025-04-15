<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Consultas</h4>
        </div>
    </div>
    <hr class="my-1">
    <br><br><br><br>
    <div class="row">
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"client_view"))? print_r("<a href=\"" . ROOT. "/Client/_list\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-user\"></i>&nbsp;Clientes</a>") : print_r(""))?></div>
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"supplier_view"))? print_r("<a href=\"" . ROOT. "/Supplier/_list\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"far fa-id-badge\"></i>&nbsp;Fornecedores</a>") : print_r(""))?></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"product_view"))? print_r("<a href=\"" . ROOT."/Product/_list\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-barcode\"></i>&nbsp;Produtos</a>") : print_r(""))?></div>
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"service_view"))? print_r("<a href=\"" . ROOT."/Service/_list\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-cut\"></i>&nbsp;Serviços</a>") : print_r(""))?></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"breed_view"))? print_r("<a href=\"" . ROOT."/Breed/_list\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-paw\"></i>&nbsp;Raças</a>") : print_r(""))?></div>
    </div>
    <br>
</div>