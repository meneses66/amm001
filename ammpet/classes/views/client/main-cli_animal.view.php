<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Cliente - Animais</h4>
        </div>
    </div>
    <hr class="my-1">
    <br>

    <div class="row">
        <!-- DETALHES DO CLIENTE (PARENT FORM) -->
        <?php 
            $controller = new ('\Controller\\'."Client");
            $controller->load_parent_form();
        ?>
    </div><br>
    <hr class="my-1">
    <div class = "row">
        <form method="post">
            <input type="hidden" name="operation" value="insert">

            <?php
                require_once removeFromEnd(ROOTPATH_CLASSES,"core").'controllers/Animal.php'; 
                $controller = new ('\Controller\\'."Animal");
                $controller->load_rows();
            ?>
            
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?php echo ROOT."/Client/_list";?>" class="btn btn-secondary btn-lg m-1 btn-block">Voltar</a>
                </div>
                <div class="col-sm-6">
                    <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Criar" formaction="../Animal/insert_call">
                </div>
            </div>
        </form>
    </div>    
    
</div>