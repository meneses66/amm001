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

        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- FORMAT FORM JS-->
        <script src="<?php echo ROOT;?>/assets/js/form_validation.js"></script>

        <!-- FORM PROCESS - VALIDATION, EDITION, AJAX CALL AND INSERT/UPDATE-->
        <?php include removeFromEnd(ROOTPATH_CLASSES,"classes/core/") . "public/assets/js/formjs_v2.php";?>

    </body>
</html>

<script>
$(document).ready(function(){
    // Form validation and submission
    $('#form_payments').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        formData += '&operation=update';
        
        $.ajax({
            url: '<?= ROOT ?>/<?= $this->UCF_object ?>/validate_payments',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.trim() === '') {
                    // Success - redirect to list
                    window.location.href = '<?= ROOT ?>/<?= $this->UCF_object ?>/_list';
                } else {
                    // Show error message
                    $('#error_message').text(response);
                }
            },
            error: function() {
                $('#error_message').text('Erro ao processar solicitação.');
            }
        });
    });
});
</script>