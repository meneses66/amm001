<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css">
    <div>Novo Fornecedor</div>
    <br><br>
    <form method="post" action="../public/Supplier">
    <input type="hidden" name="op" value="insert">
        <div class="flex-container">
            <div>
                <label for="name" font-size="12px">Nome: </label><input id="name" type="text" size="50" name="name"><br><br>
                <h5>XYZ:  </h5><input id="xyz" type="text" name="xyz"><br><br>
            </div>
            <div>
                <h5>Tipo:</h5>
                <input id="type" type="text" size="20" name="type"><br><br>
                <h5>KLM:</h5>
                <input id="klm" type="text" name="klm"><br><br>
            </div>
            <div>
            </div>
        </div>
        <div><input id="button" type="submit" value="Criar"><br><br></div>
    </form>