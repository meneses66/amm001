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

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Lista Salários</h4>
        </div>
        <div class="col-lg-6">
            <a href="<?php echo ROOT."/Salary/_new?id=new";?>" class="btn btn-success m-1 float-right"><i class="fas fa-plus-circle"></i>&nbsp;Novo Parâmetro</a>
        </div>
        <hr class="my-1">
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