<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Atualizar Fornecedor</h4>
        </div>
    </div>
    <hr class="my-1">
    <br>

    <form method="post" action="../Supplier/update_call">
        <input type="hidden" name="op" value="insert">
        <?php 
            $supplier = new ('\Controller\\'."Supplier");
            $supplier->load_update_form();
        ?>
        
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Atualizar">
            </div>
        </div>
    </form>
</div>