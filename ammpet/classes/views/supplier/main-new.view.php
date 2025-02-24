<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css">
    <div>Novo Fornecedor</div>
    <br><br>
    <form method="post" action="../public/Supplier">
    <input type="hidden" name="op" value="insert">
        <div class="flex-container">
            <div>
                <label for="name" class="medium-label">Nome: </label><input id="name" type="text" size="50" name="name"><br><br>
                <label for="xyz" class="medium-label">XYZ: </label><input id="xyz" type="text" size="30" name="xyz"><br><br>
                <label for="qwe" class="medium-label">QWE: </label>
                <select id="qwe" type="text" size="20" name="qwe">
                    <option value="abc">ABC</option>
                    <option value="zxc">ZXC</option>
                    <option value="wer">WER</option>
                </select><br><br>
            </div>
            <div>
                <label for="type" class="medium-label">Tipo: </label><input id="type" type="text" size="20" name="type"><br><br>
                <label for="klm" class="medium-label">KLM: </label><input id="klm" type="text" size="20" name="klm"><br><br>
            </div>
            <div>
            </div>
        </div>
        <div><input id="button" type="submit" value="Criar"><br><br></div>
    </form>