<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css">
    <div>Novo Fornecedor</div>
    <br><br>
    <form method="post" action="../public/Supplier">
    <div>   
        <input type="hidden" name="op" value="insert">	
        <div class="split left">
            <div class="left">
                <div style="font-size: 20px;font-family: sans-serif;margin: 10px;color: black;">Nome:</div>
                <input id="name" type="text" name="name"><br><br>
            </div>
        </div>

        <div class="split right">
            <div class="left">
                <div style="font-size: 20px;font-family: sans-serif;margin: 10px;color: black;">Data:</div>
                <input id="date" type="date" name="date"><br><br><br>

                <input id="button" type="submit" value="Criar"><br><br>
            </div>
        </div>
    </div>
</form>