<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/error_message.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Atualizar Parâmetro</h4>
        </div>
    </div>
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    <br>
    <div class="row" style="border: thin solid lightgray; font-size:14px;">
        <form method="post" id="form_params" name="form_new">
            <input type="hidden" name="operation" value="update">
            <?php 
                $controller = new ('\Controller\\'."Params");
                $controller->load_params_form();
            ?>
        </form>
        <div class="row">
            <div class="col-sm-6">
                <a href="<?php echo ROOT."/Params/_list";?>" class="btn btn-secondary btn-lg m-1 btn-block">Voltar</a>
            </div>
            <div class="col-sm-6">
                <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Salvar" formaction="../Params/update_call">
            </div>
        </div>
    </div>
    <br>
    <p class="error_message" id="error_message"></p>
</div>