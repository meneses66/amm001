<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css">
<div class="container-fluid">
<div>Novo Fornecedor</div>
<br><br><br><br>
    <form method="post" action="../public/Supplier">
    <input type="hidden" name="op" value="insert">	
    <div class="row">
        <div class="column left" style="background-color:#aaa;">
            <h2>Column 1</h2>
            <p>Some text..</p>
        </div>
        <div class="column right" style="background-color:#bbb;">
            <h2>Column 2</h2>
            <p>Some text..</p>
        </div>
    </div>

        		

        <div style="font-size: 20px;font-family: sans-serif;margin: 10px;color: white;">Nome:</div>
        <input id="login" type="text" name="login"><br><br>

        <div style="font-size: 20px;font-family: sans-serif;margin: 10px;color: white;">Data:</div>
        <input id="pass" type="text" name="pass"><br><br><br>

        <input id="button" type="submit" value="Criar"><br><br>

    </form>
         
</div>