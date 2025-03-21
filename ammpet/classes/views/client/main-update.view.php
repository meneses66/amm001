<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <h4>Atualizar Cliente</h4>
        </div>
        <div class="col-sm-2">
            <a href="<?php echo ROOT."/Client/_cli_animal?cli_id=".$_GET['id'];?>" title="Animals" class="<?php (URL_0=='Client' && URL_1=='_cli_animal') ? 'btn btn-secondary btn-lg m-1 btn-block' : 'btn btn-outline-secondary btn-lg m-1 btn-block'; ?>" cli_id="<?php echo $_GET['id'];?>"><i class="fas fa-edit"></i>&nbsp;&nbsp;Animais</a>
        </div>
        <div class="col-sm-2">
            <a href="<?php echo ROOT."/Client/_cli_package?cli_id=".$_GET['id'];?>" title="Packages" class="btn btn-info btn-lg m-1 btn-block" cli_id="<?php echo $_GET['id'];?>"><i class="fas fa-edit"></i>&nbsp;&nbsp;Pacotes</a>
        </div>
        <div class="col-sm-2">
            <a href="<?php echo ROOT."/Client/_cli_product?cli_id=".$_GET['id'];?>" title="Products" class="btn btn-info btn-lg m-1 btn-block" cli_id="<?php echo $_GET['id'];?>"><i class="fas fa-edit"></i>&nbsp;&nbsp;Produtos</a>
        </div>
        <div class="col-sm-2">
            <a href="<?php echo ROOT."/Client/_cli_service?cli_id=".$_GET['id'];?>" title="Services" class="btn btn-info btn-lg m-1 btn-block" cli_id="<?php echo $_GET['id'];?>"><i class="fas fa-edit"></i>&nbsp;&nbsp;Serviços</a>
        </div>
    </div>
    <hr class="my-1">
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