<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Relatórios</h4>
        </div>
    </div>
    <hr class="my-1">
    <br><br><br><br>
    <div class="row">
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"cobrancas_view"))? print_r("<a href=\"". ROOT."/Report/cobrancas\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"far fa-list-alt\"></i>&nbsp;Cobranças</a>") : print_r(""))?></div>
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"vencimento_pacotes_view"))? print_r("<a href=\"". ROOT."/Report/vencimento_pacotes\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"far fa-list-alt\"></i>&nbsp;Vencimento Pacotes</a>") : print_r(""))?></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"vencimento_vacinas_view"))? print_r("<a href=\"". ROOT."/Report/vencimento_vacinas\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"far fa-list-alt\"></i>&nbsp;Vencimento Vacinas</a>") : print_r(""))?></div>
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"tosador_view"))? print_r("<a href=\"". ROOT."/Report/tosador\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"far fa-list-alt\"></i>&nbsp;Tosador</a>") : print_r(""))?></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"vet_view"))? print_r("<a href=\"". ROOT."/Report/veterinaria\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"far fa-list-alt\"></i>&nbsp;Veterinária</a>") : print_r(""))?></div>
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"comis_view"))? print_r("<a href=\"" . ROOT . "/Report/comissoes\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"far fa-list-alt\"></i>&nbsp;Comissões</a>") : print_r(""))?></div>
    </div>
    <br>
</div>