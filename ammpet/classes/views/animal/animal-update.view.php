<?php 
if((time()-$_SESSION['LAST_ACTIVE'])>TIMEOUT){
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
                <?php include "main-update.view.php";?>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery library -->
        <script src="<?php echo ROOT;?>/assets/js/jquery-3.7.1.js"></script>
        <!-- jQuery Mask -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <!-- Mask JS-->
        <script src="<?php echo ROOT;?>/assets/js/masks.js"></script>
        <!-- Load Breed Update Form JS-->
        <script src="<?php echo ROOT;?>/assets/js/load_breed_update_form.js"></script>
        <!-- Breed JS-->
        <script src="<?php echo ROOT;?>/assets/js/select_breed.js"></script>
        <!-- Core theme JS-->
        <script src="<?php echo ROOT;?>/assets/js/scripts.js"></script>
    </body>
</html>