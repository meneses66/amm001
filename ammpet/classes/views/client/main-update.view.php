<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <h4>Atualizar Cliente</h4>
        </div>
        <?php include "client-nav.view.php";?>
    </div>
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    <br>

    <form method="post">
        <input type="hidden" name="operation" value="update">
        <?php 
            $controller = new ('\Controller\\'."Client");
            $controller->load_update_form();
        ?>
        
        <div class="row">
            <div class="col-sm-6">
                <a href="<?php echo ROOT."/Client/_list";?>" class="btn btn-secondary btn-lg m-1 btn-block">Voltar</a>
            </div>
            <div class="col-sm-6">
                <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Atualizar" formaction="../Client/update_call">
            </div>
        </div>
    </form>
</div>