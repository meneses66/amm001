<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Home</h4>
        </div>
    </div>
    <hr class="my-1">
    <br><br><br><br>
    <div class="row">
        <div class="col-sm-6"><?php if(check_permission($_SESSION['username'],"client_view")) {echo '<a href="' . ROOT . '/Client/_list" class="btn btn-primary btn-lg m-1 btn-block"><i class="fas fa-user"></i>&nbsp;Clientes</a>';}?></div>
        <div class="col-sm-6"><?php if(check_permission($_SESSION['username'],"orderx_view")) {echo '<a href="'.  ROOT . '/OrderX/_list" class="btn btn-primary btn-lg m-1 btn-block"><i class="far fa-list-alt"></i>&nbsp;Vendas</a>';}?></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><?php if(check_permission($_SESSION['username'],"agenda_view")) {echo '<a href="'. ROOT . '/Agenda/week_view" class="btn btn-primary btn-lg m-1 btn-block"><i class="far fa-calendar-alt"></i>&nbsp;Agenda</a>';}?></div>
        <div class="col-sm-6"><?php if(check_permission($_SESSION['username'],"orderx_add")) {echo '<a href="'. ROOT . '/OrderX/_new" class="btn btn-primary btn-lg m-1 btn-block"><i class="far fa-money-bill-alt"></i>&nbsp;Nova Venda</a>';}?></div>
    </div>
    <br>
</div>
