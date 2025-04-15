<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Admin</h4>
        </div>
    </div>
    <hr class="my-1">
    <br><br><br><br>
    <div class="row">
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"cash_register_view"))? print_r("<a href=\"" . ROOT ."/Daily_Accounting/_list\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-cash-register\"></i>&nbsp;Caixa</a>") : print_r(""))?></div>
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"cost_view"))? print_r("<a href=\"" . ROOT ."/Payments/_list\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-file-invoice-dollar\"></i>&nbsp;Custos</a>") : print_r(""))?></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"salary_view"))? print_r("<a href=\"" . ROOT ."/Salary/_list\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-hand-holding-usd\"></i>&nbsp;Salários</a>") : print_r(""))?></div>
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"params_view"))? print_r("<a href=\"" . ROOT ."/Params/_list\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-indent\"></i>&nbsp;Parâmetros Sistema</a>") : print_r(""))?></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"pre_closing_view"))? print_r("<a href=\"" . ROOT ."/Pre_Closing/pre_closing\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-percent\"></i>&nbsp;Pré Fechamento</a>") : print_r(""))?></div>
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"month_closing_view"))? print_r("<a href=\"" . ROOT ."/Month_Closing/month_closing\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-chart-pie\"></i>&nbsp;Fechamento Mês</a>") : print_r(""))?></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><?php ((check_permission($_SESSION['username'],"client_add"))? print_r("<a href=\"" . ROOT ."/Results/_list\" class=\"btn btn-primary btn-lg m-1 btn-block\"><i class=\"fas fa-chart-line\"></i>&nbsp;Resultados</a>") : print_r(""))?></div>
        <div class="col-sm-6"></div>
    </div>
    <br>
</div>
