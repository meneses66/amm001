<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css">
    <div>Novo Fornecedor</div>
    <br><br>
    <form method="post" action="../public/Supplier">
    <input type="hidden" name="op" value="insert">
        <div class="flex-container">
            <div>
                <h5>Nome:</h5>
                <input id="name" type="text" name="name"><br><br>
                <h5>XYZ:</h5>
                <input id="name" type="text" name="name"><br><br>
            </div>
            <div>
                <h5>Tipo:</h5>
                <input id="type" type="text" name="type"><br><br>
                <h5>KLM:</h5>
                <input id="type" type="text" name="type"><br><br>
            </div>
            <div>
            </div>
        </div>
        <div><input id="button" type="submit" value="Criar"><br><br></div>
    </form>