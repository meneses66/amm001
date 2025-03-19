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
            require_once removeFromEnd(ROOTPATH_CLASSES,"/core").'/controllers/Client.php'; 
            $controller1 = new ('\Controller\\'."Client");
            $controller1->load_parent_form();
        ?>
    </div><br>
    <hr class="my-1">
    <div class = "row">
        <!-- ANIMAIS DO CLIENTE -->
        <?php
            removeFromEnd(ROOTPATH_CLASSES,"/core").'/controllers/Animal.php'; 
            $controller2 = new ('\Controller\\'."Animal");
            $controller2->load_new_form();
        ?>
    </div>    
    
</div>