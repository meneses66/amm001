<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css">
<div class="container-fluid">
<div>Novo Fornecedor</div>
<br><br><br><br>
    <div>
        <form method="post" action="../public/Supplier">
            <input type="hidden" name="op" value="insert">	
            <div class="split left">
            <div class="centered">
                <h2>Jane Flex</h2>
                <p>Some text.</p>
            </div>
            </div>

            <div class="split right">
            <div class="centered">
                <h2>John Doe</h2>
                <p>Some text here too.</p>
            </div>
            </div>

                    

            <div style="font-size: 20px;font-family: sans-serif;margin: 10px;color: white;">Nome:</div>
            <input id="login" type="text" name="login"><br><br>

            <div style="font-size: 20px;font-family: sans-serif;margin: 10px;color: white;">Data:</div>
            <input id="pass" type="text" name="pass"><br><br><br>

            <input id="button" type="submit" value="Criar"><br><br>

        </form>
    </div>     
</div>