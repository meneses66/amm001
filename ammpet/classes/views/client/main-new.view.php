<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Novo Cliente</h4>
            <?php echo URL(0);?>
            <?php echo URL(1);?>
        </div>
    </div>
    <hr class="my-1">
    <br>

    <form method="post">
        <input type="hidden" name="operation" value="insert">

        <?php 
            $controller = new ('\Controller\\'."Client");
            $controller->load_new_form();
        ?>
        
        <div class="row">
            <div class="col-sm-6">
                <a href="<?php echo ROOT."/Client/_list";?>" class="btn btn-secondary btn-lg m-1 btn-block">Voltar</a>
            </div>
            <div class="col-sm-6">
                <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Criar" formaction="../Client/insert_call">
            </div>
        </div>
    </form>
</div>