<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/error_message.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Cliente - Novo Animal</h4>
        </div>
    </div>
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    <div class="row">
        <!-- DETALHES DO CLIENTE (PARENT FORM) -->
        <?php
            //require_once removeFromEnd(ROOTPATH_CLASSES,"/core").'/controllers/Client.php'; 
            $controller1 = new ('\Controller\\'."Animal");
            $controller1->load_parent_form();
        ?>
    </div>
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    <div class="row" style="border: thin solid lightgray; font-size:14px;">
        <!-- NOVO ANIMAL DO CLIENTE -->
        <form method="post" id="form_animal" name="form_new">
            <input type="hidden" name="operation" value="update">
            <?php
                //removeFromEnd(ROOTPATH_CLASSES,"/core").'/controllers/Animal.php'; 
                $controller2 = new ('\Controller\\'."Animal");
                $controller2->load_animal_form();
            ?>
        </form>
    </div>
    <br>
    <p class="error_message" id="error_message"></p>
</div>