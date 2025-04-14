<?php 
    if((time()-$_SESSION['LAST_ACTIVE'])>TIMEOUT){
        end_session();
        redirect("Login/_logout");
        die;
    }
    restart_session();
    $user_permission = get_user_permissions($_SESSION['username']);
    //$user_permission = $global_permissions;
    $_SESSION['LAST_ACTIVE']=time();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <?php include ROOTPATH_CLASSES . "../views/head.view.php";?>
    </head>
    <body>
        <input id="user_permissions" type="text" value="<?php echo $user_permission; ?>">
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
                <?php include "main.view.php";?>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery library -->
        <script src="<?php echo ROOT;?>/assets/js/jquery-3.7.1.js"></script>
        <!-- Core theme JS-->
        <script src="../public/assets/js/scripts.js"></script>
        <!-- Permission Check JS-->
        <script src="../public/assets/js/permission_check.js"></script>
    </body>
</html>