<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Atualizar Salário</h4>
        </div>
    </div>
    <hr class="my-1">
    <br>
    <form method="post">
        <input type="hidden" name="operation" value="update">
        <?php 
            $controller = new ('\Controller\\'."Salary");
            $controller->load_salary_form();
        ?>
    </form>
</div>