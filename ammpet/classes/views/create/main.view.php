<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css">
<div class="container-fluid">
<div>Cadastros</div>
<br><br><br><br>
    <table style="width:100%">
        <tr>
            <td>
                <form method="post" action="../Client">
                    <input type="hidden" name="op" value="goto_new_customer">
                    <input id="button_main" type="submit" value="Novo Cliente">
                </form><br>
            </td>
            <td>
                <form method="post" action="../Supplier">
                    <input type="hidden" name="op" value="goto_new_supplier">
                    <input id="button_main" type="submit" value="Novo Fornecedor">
                </form><br>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="../ProdServ">
                    <input type="hidden" name="op" value="goto_new_prod">
                    <input id="button_main" type="submit" value="Novo Produto">
                </form><br>
            </td>
            <td>
                <form method="post" action="../ProdServ">
                    <input type="hidden" name="op" value="goto_new_serv">
                    <input id="button_main" type="submit" value="Novo Serviço">
                </form><br>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="../Breed">
                    <input type="hidden" name="op" value="goto_new_breed">
                    <input id="button_main" type="submit" value="Nova Raça">
                </form><br>
            </td>
            
        </tr>
    </table>           
</div>