<?php $GLOBALS['classnamejs']='Animal';?>
<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <h4>Cliente - Animais</h4>
        </div>
        <?php include "client-nav.view.php";?>
    </div>
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    <div class="row">
        <!-- DETALHES DO CLIENTE (PARENT FORM) -->
        <?php 
            require_once removeFromEnd(ROOTPATH_CLASSES,"/core").'/controllers/Animal.php'; 
            $controller1 = new ('\Controller\\'."Animal");
            $controller1->load_parent_form();
        ?>
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
    <div class="row">
        <form method="post">
            <input type="hidden" name="operation" value="insert">
            <?php
                require_once removeFromEnd(ROOTPATH_CLASSES,"/core").'/controllers/Animal.php'; 
                $controller2 = new ('\Controller\\'."Animal");
                $controller2->load_buttons_for_list_view();
            ?>
        </form>
    </div>   
</div>