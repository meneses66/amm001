<?php 
    $GLOBALS['classnamejs']='Payments';
    $GLOBALS['buttonenablerjs']='Payments';
?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<?php 
require_once(ROOTPATH."/classes/views/".$this->object."/main-new.view.php");
?>

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