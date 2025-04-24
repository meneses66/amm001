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
                <?php include "main-new.view.php";?>
            </div>
        </div>
        <!-- jQuery library -->
        <script src="<?php echo ROOT;?>/assets/js/jquery-3.7.1.js"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="<?php echo ROOT;?>/assets/js/scripts.js"></script>
         <!-- Form Validation JS-->
         <script src="<?php echo ROOT;?>/assets/js/validation_params.js"></script>

    </body>
</html>