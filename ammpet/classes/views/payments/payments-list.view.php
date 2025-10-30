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
                <?php include "main-list.view.php";?>
            </div>
        </div>
        
        <!-- Core theme JS-->
        <script src="<?php echo ROOT;?>/assets/js/scripts.js"></script>

        <!-- jQuery library -->
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Icons -->
        <script src="https://kit.fontawesome.com/09bcd15628.js" crossorigin="anonymous"></script>
        
        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

        <!-- Datatable.net -->
        <script src="https://cdn.datatables.net/v/bs4/dt-2.2.2/datatables.min.js" integrity="sha384-uAn6fsp1rIJ6afAYV0S5it5ao101zH2fViB74y5tPG8LR2FTMg+HXIWRNxvZrniN" crossorigin="anonymous"></script>

        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- FORMAT TABLE JS-->
        <script src="<?php echo ROOT;?>/assets/js/format_table_search.js"></script>

        <!-- Table Pagination, Search, Refresh and Ajax Call-->
        <?php include removeFromEnd(ROOTPATH_CLASSES,"classes/core/") . "public/assets/js/tablejs_v2.php";?>

        <!-- Table Column Date Formatting-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

        <!-- Export to Excel -->
        <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.print.min.js"></script>

    </body>
</html>

<script>
$(document).ready(function(){
    $('#_table').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        },
        "ajax": {
            "url": "<?= ROOT ?>/<?= $this->UCF_object ?>/load_rows",
            "type": "GET"
        },
        "order": [[0, "desc"]],
        "pageLength": 25,
        "responsive": true
    });
});
</script>