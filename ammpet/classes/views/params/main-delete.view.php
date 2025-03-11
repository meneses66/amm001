<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Deletar Fornecedor</h4>
        </div>
    </div>
    <hr class="my-1">
    <br>

    <form method="post" action="../Params/delete_call">
        <input type="hidden" name="operation" value="delete">
        <?php 
            $controller = new ('\Controller\\'."Params");
            $controller->load_delete_form();
        ?>
        
        <div class="row">
            <div class="col-sm-6">
                <h3>Esta ação não pode ser desfeita!!!</h3>
            </div>
            <div class="col-sm-6">
                <input id="button" class="btn btn-danger btn-lg m-1 btn-block" type="submit" value="Deletar">
            </div>
        </div>
    </form>
</div>