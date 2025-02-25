<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css">
    <div><h3>Novo Fornecedor</h3></div>
    <br>
    <form method="post" action="../public/Supplier">
    <input type="hidden" name="op" value="insert">
        <div class="flex-container">
            <div>
                <input id="created_by" type="hidden" name="created_by" value="<?php if(!isset($_SESSION['username'])) {session_start();} echo $_SESSION['username'];?>">
                <input id="updated_by" type="hidden" name="updated_by" value="<?php if(!isset($_SESSION['username'])) {session_start();} echo $_SESSION['username'];?>">
                <label for="name" class="medium-label">Nome: </label><input id="name" type="text" size="50" name="name"><br>
                <label for="login" class="medium-label">Login: </label><input id="login" type="text" size="20" name="login"><br>
                <label for="pwd" class="medium-label">Senha: </label><input id="pwd" type="password" name="pwd"><br>
                <label for="type" class="medium-label">Tipo: </label>
                <select class="medium-label" id="type" name="type">
                    <option class="medium-label" value="" selected>Selecione uma opção</option>
                    <option class="medium-label" value="fun">Funcionario</option>
                    <option class="medium-label" value="for">Fornecedor</option>
                    <option class="medium-label" value="fre">Freelancer</option>
                </select><br>
                <label for="role" class="medium-label">Cargo: </label>
                <select id="role" name="role">
                    <option value="" selected>Selecione uma opção</option>
                    <option value="ban">Banhista</option>
                    <option value="tos">Tosador</option>
                    <option value="rec">Recepcao</option>
                    <option value="pro">Proprietario</option>
                </select><br>
                <label for="status" class="medium-label">Status: </label>
                <select id="status" name="status">
                    <option value="" selected>Selecione uma opção</option>
                    <option value="act">Ativo</option>
                    <option value="ina">Inativo</option>
                </select><br>
            </div>
            <div>
                <label for="cnpj" class="medium-label">CNPJ: </label><input id="cnpj" type="text" size="20" name="cnpj"><br>
                <label for="cpf" class="medium-label">CPF: </label><input id="cpf" type="text" size="20" name="cpf"><br>
                <label for="seq" class="medium-label">Sequencia: </label><input id="seq" type="text" size="10" name="seq"><br>
                <label for="start_date" class="medium-label">Data Inicio: </label><input id="start_date" type="date" size="20" name="start_date"><br>
                <label for="comment" class="medium-label">Comentarios: </label><input id="comment" type="text" size="50" name="comment"><br>
            </div>
            <div>
            </div>
        </div>
        <div align="right"><input id="button" type="submit" value="Criar"><br><br></div>
    </form>