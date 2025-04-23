<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/error_message.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Atualizar Cliente</h4>
        </div>
    </div>
    <hr class="my-1">
    <br>
    <div class="row" style="border: thin solid lightgray; font-size:14px;">
        <form method="post" id="form_client" name="form_new">
            <input type="hidden" name="operation" value="update">
            <?php 
                $controller = new ('\Controller\\'."Client");
                $controller->load_client_form();
            ?>
        </form>
    </div>
    <br>
    <p class="error_message" id="error_message"></p>
</div>