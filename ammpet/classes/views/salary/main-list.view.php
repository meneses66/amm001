<?php 
    $GLOBALS['classnamejs']='Salary';
    $GLOBALS['buttonenablerjs']='';
    $GLOBALS['cli_id_js']='';
    $GLOBALS['order_id_js']='';
?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://cdn.datatables.net/v/bs4/dt-2.2.2/datatables.min.css" rel="stylesheet" integrity="sha384-fTqd416qRc9kwY299KdgUPsjOvS5bwkeE6jlibx2m7eL3xKheqGyU48QCFgZAyN4" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/buttons.datatable.css">
<link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.8.2/css/searchBuilder.dataTables.css">
<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/error_message.css">
<input id="classnamejs" type="hidden" readonly value="Salary">
<input id="buttonenablerjs" type="hidden" readonly value="">
<input id="cli_id_js" type="hidden" readonly value="">
<input id="order_id_js" type="hidden" readonly value="">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2">
            <h4>Lista Salários</h4>
        </div>
        <div class="col-lg-2">
            <?php
                $year=date('Y');
                $month=date('m');
                $year_option_list = load_options_update("YEAR", "Ativo", $year);
                $month_option_list = load_options_update("MONTH", "Ativo", $month);
                $output='<label for="year" class="medium-label">Ano: </label>
                         <select class="medium-label" id="year" name="Year">
                            '.$year_option_list.'
                        </select>&nbsp;&nbsp;
                        <label for="month" class="medium-label">Mês: </label>
                         <select class="medium-label" id="month" name="Month">
                            '.$month_option_list.'
                        </select>';
                echo $output;
            ?>
        </div>
        <div class="col-lg-2">
            <?php ((check_permission($_SESSION['username'],"admin_add"))? print_r("<input id=\"update_comission\" class=\"btn btn-primary btn-sm m-1 btn-block\" type=\"save_submit\" value=\"Atualizar Comissão\">") : print_r(""))?>
        </div>
        <div class="col-lg-2">
            <?php ((check_permission($_SESSION['username'],"admin_add"))? print_r("<input id=\"batch_confirm\" class=\"btn btn-primary btn-sm m-1 btn-block\" type=\"save_submit\" value=\"Confirmar Todos\">") : print_r(""))?>
        </div>
        <div class="col-lg-2">
            <?php ((check_permission($_SESSION['username'],"admin_add"))? print_r("<input id=\"close_period\" class=\"btn btn-primary btn-sm m-1 btn-block\" type=\"save_submit\" value=\"Fechar Período\">") : print_r(""))?>
        </div>
        <div class="col-lg-2">
            <?php ((check_permission($_SESSION['username'],"salary_add"))? print_r("<a href=\"". ROOT."/Salary/_new?id=new\" class=\"btn btn-success m-1 float-right\"><i class=\"fas fa-plus-circle\"></i>&nbsp;Novo Registro</a>") : print_r(""))?>
        </div>
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive" id="_list_id">
                <table id="_table" class="table Table-stripped table-sm table-bordered small">
                    
                </table>
            </div>
        </div>
    </div>
        
    </div>

</div>
<br>
<p class="error_message" id="error_message"></p>