<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Novo Fornecedor</h4>
        </div>
    </div>
    <hr class="my-1">
    <br>

    <form method="post" action="../Supplier/insert">
        <input type="hidden" name="op" value="insert">

        <div class="row">
            <div class="col-sm-6">
                <input id="id" type="hidden" name="Id" value="">
                <input id="created_by" type="hidden" name="Created_by" value="<?php if(!isset($_SESSION['username'])) {session_start();} echo $_SESSION['username'];?>">
                <input id="updated_by" type="hidden" name="Updated_by" value="<?php if(!isset($_SESSION['username'])) {session_start();} echo $_SESSION['username'];?>">
                <input id="created" type="hidden" name="Created" value="">
                <input id="updated" type="hidden" name="Updated" value="">
                <label for="name" class="medium-label">Nome: &nbsp;</label><input id="name" type="text" size="50" name="Name"><br><br>
                <label for="login" class="medium-label">Login: &nbsp;</label><input id="login" type="text" size="20" name="Login"><br><br>
                <label for="pass" class="medium-label">Senha: &nbsp;</label><input id="pass" type="password" name="Pass"><br><br>
                <label for="type" class="medium-label">Tipo: &nbsp;</label>
                <select class="medium-label" id="type" name="Type">
                    <option class="medium-label" value="" selected>Selecione uma opção</option>
                    <option class="medium-label" value="Funcionario">Funcionario</option>
                    <option class="medium-label" value="Fornecedor">Fornecedor</option>
                    <option class="medium-label" value="Freelancer">Freelancer</option>
                </select><br><br>
                <label for="Role" class="medium-label">Cargo: &nbsp;</label>
                <select class="medium-label" id="role" name="Role">
                    <option class="medium-label" value="" selected>Selecione uma opção</option>
                    <option class="medium-label" value="Banhista">Banhista</option>
                    <option class="medium-label" value="Tosador">Tosador</option>
                    <option class="medium-label" value="Recepcao">Recepcao</option>
                    <option class="medium-label" value="Proprietario">Proprietario</option>
                </select><br><br>
                <label for="Status" class="medium-label">Status: &nbsp;</label>
                <select class="medium-label" id="status" name="Status">
                    <option class="medium-label" value="" selected>Selecione uma opção</option>
                    <option class="medium-label" value="Ativo">Ativo</option>
                    <option class="medium-label" value="Inativo">Inativo</option>
                </select><br><br>
            </div>
            <div class="col-sm-6">
                <label for="CNPJ" class="medium-label">CNPJ: &nbsp;</label><input id="cnpj" type="text" size="10" name="CNPJ"><br><br>
                <label for="CPF" class="medium-label">CPF: &nbsp;</label><input id="cpf" type="text" size="10" name="CPF"><br><br>
                <label for="Sequence" class="medium-label">Sequencia: &nbsp;</label><input id="seq" type="text" size="8" name="Sequence"><br><br>
                <label for="Hire_Date" class="medium-label">Data Inicio: &nbsp;</label><input id="start_date" type="date" size="30" name="Hire_Date"><br><br>
                <label for="Comment" class="medium-label">Comentarios: &nbsp;</label><input id="comment" type="text" size="50" name="Comment"><br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <input id="button" class="btn btn-primary btn-lg m-1 btn-block" type="submit" value="Criar">
            </div>
        </div>
    </form>
</div>