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
        <div class="col-sm-6"><a href="<?php echo ROOT."/Cash_Register/cash_register_list";?>" class="btn btn-primary btn-lg m-1 btn-block"><i class="fas fa-cash-register"></i>&nbsp;Caixa</a></div>
        <div class="col-sm-6"><a href="<?php echo ROOT."/Costs/costs_list";?>" class="btn btn-primary btn-lg m-1 btn-block"><i class="fas fa-file-invoice-dollar"></i>&nbsp;Custos</a></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><a href="<?php echo ROOT."/Salaries/salaries_list";?>" class="btn btn-primary btn-lg m-1 btn-block"><i class="fas fa-hand-holding-usd"></i>&nbsp;Salários</a></div>
        <div class="col-sm-6"><a href="<?php echo ROOT."/Params/_list";?>" class="btn btn-primary btn-lg m-1 btn-block"><i class="fas fa-indent"></i>&nbsp;Parâmetros Sistema</a></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><a href="<?php echo ROOT."/Pre_Closing/pre_closing";?>" class="btn btn-primary btn-lg m-1 btn-block"><i class="fas fa-percent"></i>&nbsp;Pré Fechamento</a></div>
        <div class="col-sm-6"><a href="<?php echo ROOT."/Month_Closing/month_closing";?>" class="btn btn-primary btn-lg m-1 btn-block"><i class="fas fa-chart-pie"></i>&nbsp;Fechamento Mês</a></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><a href="<?php echo ROOT."/Results/results";?>" class="btn btn-primary btn-lg m-1 btn-block"><i class="fas fa-chart-line"></i>&nbsp;Resultados</a></div>
        <div class="col-sm-6"></div>
    </div>
    <br>
</div>
