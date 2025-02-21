<link rel="stylesheet" href="../public/assets/css/styles.css">
<div class="container-fluid">
<br><br><br><br>
    <table style="width:100%">
        <tr>
            <td>
                <form method="post" action="../public/Client">
                    <input type="hidden" name="op" value="new_customer">
                    <input id="button" type="submit" value="Novo Cliente">
                </form><br>
            </td>
            <td>
                <form method="post" action="../public/Supplier">
                    <input type="hidden" name="op" value="new_supplier">
                    <input id="button_main" type="submit" value="Novo Fornecedor">
                </form><br>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="../public/ProdServ">
                    <input type="hidden" name="op" value="new_prod">
                    <input id="button" type="submit" value="Novo Produto">
                </form><br>
            </td>
            <td>
                <form method="post" action="../public/ProdServ">
                    <input type="hidden" name="op" value="new_serv">
                    <input id="button" type="submit" value="Novo Serviço">
                </form><br>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="../public/Breed">
                    <input type="hidden" name="op" value="new_breed">
                    <input id="button" type="submit" value="Nova Raça">
                </form><br>
            </td>
            
        </tr>
    </table>           
</div>