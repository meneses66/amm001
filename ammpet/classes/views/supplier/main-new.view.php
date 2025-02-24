<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css">
    <div>Novo Fornecedor</div>
    <br><br>
    <form method="post" action="../public/Supplier">
    <input type="hidden" name="op" value="insert">
        <div class="flex-container">
            <div>
                <h3>Nome:</h3>
                <input id="name" type="text" name="name"><br><br>
            </div>
            <div>
                <h3>Tipo:</h3>
                <input id="type" type="text" name="type"><br><br>
            </div>
        </div>
        <div><input id="button" type="submit" value="Criar"><br><br></div>
    </form>