<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css">
    <div><h3>Novo Fornecedor</h3></div>
    <br>
    <form method="post" action="../Supplier/insert">
    <input type="hidden" name="op" value="insert">
        <div class="flex-container">
            <div>
                <input id="id" type="hidden" name="Id" value=""><br>
                <input id="created_by" type="hidden" name="Created_by" value="<?php if(!isset($_SESSION['username'])) {session_start();} echo $_SESSION['username'];?>">
                <input id="updated_by" type="hidden" name="Updated_by" value="<?php if(!isset($_SESSION['username'])) {session_start();} echo $_SESSION['username'];?>">
                <input id="created" type="hidden" name="Created" value=""><br>
                <input id="updated" type="hidden" name="Updated" value=""><br>
                <label for="name" class="medium-label">Nome: </label><input id="name" type="text" size="50" name="Name"><br>
                <label for="login" class="medium-label">Login: </label><input id="login" type="text" size="20" name="Login"><br>
                <label for="pass" class="medium-label">Senha: </label><input id="pass" type="password" name="Pass"><br>
                <label for="type" class="medium-label">Tipo: </label>
                <select class="medium-label" id="type" name="Type">
                    <option class="medium-label" value="" selected>Selecione uma opção</option>
                    <option class="medium-label" value="Funcionario">Funcionario</option>
                    <option class="medium-label" value="Fornecedor">Fornecedor</option>
                    <option class="medium-label" value="Freelancer">Freelancer</option>
                </select><br>
                <label for="Role" class="medium-label">Cargo: </label>
                <select class="medium-label" id="role" name="Role">
                    <option class="medium-label" value="" selected>Selecione uma opção</option>
                    <option class="medium-label" value="Banhista">Banhista</option>
                    <option class="medium-label" value="Tosador">Tosador</option>
                    <option class="medium-label" value="Recepcao">Recepcao</option>
                    <option class="medium-label" value="Proprietario">Proprietario</option>
                </select><br>
                <label for="Status" class="medium-label">Status: </label>
                <select class="medium-label" id="status" name="Status">
                    <option class="medium-label" value="" selected>Selecione uma opção</option>
                    <option class="medium-label" value="Ativo">Ativo</option>
                    <option class="medium-label" value="Inativo">Inativo</option>
                </select><br>
            </div>
            <div>
                <label for="CNPJ" class="medium-label">CNPJ: </label><input id="cnpj" type="text" size="20" name="CNPJ"><br>
                <label for="CPF" class="medium-label">CPF: </label><input id="cpf" type="text" size="20" name="CPF"><br>
                <label for="Sequence" class="medium-label">Sequencia: </label><input id="seq" type="text" size="10" name="Sequence"><br>
                <label for="Hire_Date" class="medium-label">Data Inicio: </label><input id="start_date" type="date" size="30" name="Hire_Date"><br>
                <label for="Comment" class="medium-label">Comentarios: </label><input id="comment" type="text" size="50" name="Comment"><br>
            </div>
            <div>

            </div>
        </div>
        <div align="right"><input id="button" type="submit" value="Criar"><br><br></div>
    </form>