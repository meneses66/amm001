<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <?php include ROOTPATH_CLASSES . "../views/head.view.php";?>
    <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link href="https://cdn.datatables.net/v/bs4/dt-2.2.2/datatables.min.css" rel="stylesheet" integrity="sha384-fTqd416qRc9kwY299KdgUPsjOvS5bwkeE6jlibx2m7eL3xKheqGyU48QCFgZAyN4" crossorigin="anonymous">
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
                
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Lista Fornecedores</h4>
                            <?php echo removeFromEnd(ROOT, "public")."classes/core/ajax_call.php"; ?>
                            <?php echo ROOTPATH_CLASSES."ajax_call.php";?>
                        </div>
                        <div class="col-lg-6">
                            <a href="<?php echo ROOT."/Supplier/new_supplier";?>" class="btn btn-success m-1 float-right"><i class="fas fa-plus-circle"></i>&nbsp;Novo Fornecedor</a>
                            <a href="#" class="btn btn-primary m-1 float-right"><i class="fas fa-table"></i>&nbsp;Export</a>
                        </div>
                        <hr class="my-1">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive" id="listSupplier">
                                
                            </div>
                        </div>
                    </div>
                        
                    </div>
                </div>

            </div>
        </div>
        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Icons -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

        <!-- Core theme JS-->
        <script src="<?php echo ROOT;?>/assets/js/scripts.js"></script>

        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

        <!-- Datatable.net -->
        <script src="https://cdn.datatables.net/v/bs4/dt-2.2.2/datatables.min.js" integrity="sha384-uAn6fsp1rIJ6afAYV0S5it5ao101zH2fViB74y5tPG8LR2FTMg+HXIWRNxvZrniN" crossorigin="anonymous"></script>

        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Table Pagination -->
        <script type="text/javascript">
            $(document).ready(function(){
                
            list_Rows();

            function list_Rows(){
                $.ajax({
                    url: "ajax_call.php",
                    type: "POST",
                    data: {operation:"view", class:"Supplier", function:"list_rows"},
                    success: function(response){
                        //console.log(response);
                        $("#listSupplier").html(response);
                        $("table").DataTable();
                    }
                });
            }
            });
        </script>

    </body>
</html>