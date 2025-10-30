<?php 
    $GLOBALS['classnamejs']='Payments';
    $GLOBALS['buttonenablerjs']='';
?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/v/bs4/dt-2.2.2/datatables.min.js" integrity="sha384-bUfKMBnB9VY4f8LGYJuJz1dJl6bvuDEpHLt8XCQsEKYvBg/dT8LDJpCTY4l8XqO6" crossorigin="anonymous"></script>

<?php 
require_once(ROOTPATH."/classes/views/".$this->object."/main-list.view.php");
?>

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