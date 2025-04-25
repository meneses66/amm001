<?php 
if((time()-$_SESSION['LAST_ACTIVE'])>TIMEOUT){
    end_session();
    redirect("Login/_logout");
    die;
}
$_SESSION['LAST_ACTIVE']=time();?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <?php include ROOTPATH_CLASSES . "../views/head.view.php";?> 
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
              <?php include ROOTPATH_CLASSES . "../views/sidebar.view.php";?>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <?php include ROOTPATH_CLASSES . "../views/topnav.view.php";?>
                <!-- Page content-->
                <?php include "main-updateProduct.view.php";?>
            </div>
        </div>

        <!-- jQuery library -->
        <script src="<?php echo ROOT;?>/assets/js/jquery-3.7.1.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script> -->

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Icons -->
        <script src="https://kit.fontawesome.com/09bcd15628.js" crossorigin="anonymous"></script>

        <!-- Table Column Date Formatting-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
       
        <!-- jQuery Mask -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        
        <!-- Load Update Form JS-->
        <script src="<?php echo ROOT;?>/assets/js/load_orderitem_form_prod.js"></script>

        <!-- Order Item Selectors JS-->
        <script src="<?php echo ROOT;?>/assets/js/selectors_order_item.js"></script>

        <!-- Calculate Order Item JS-->
        <script src="<?php echo ROOT;?>/assets/js/calculate_item_product.js"></script>

        <!-- Calculate Decimal Round JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/decimal.js/10.2.1/decimal.js" integrity="sha512-GKse2KVGCCMVBn4riigHjXE8j5hCxYLPXDw8AvcjUtrt+a9TbZFtIKGdArXwYOlZvdmkhQLWQ46ZE3Q1RIa7uQ==" crossorigin="anonymous"></script>
                
        <!-- Mask JS-->
        <script src="<?php echo ROOT;?>/assets/js/masks.js"></script>

        <!-- Core theme JS-->
        <script src="<?php echo ROOT;?>/assets/js/scripts.js"></script>

        <!-- Form Validation JS-->
        <script src="<?php echo ROOT;?>/assets/js/validation_oi_service.js"></script>
        
    </body>
</html>