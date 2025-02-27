<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css">
<div class="container-fluid">
<div>Consultas</div>
<br><br><br><br>
    <table style="width:100%">
        <tr>
            <td>
                <form method="post" action="../Client">
                    <input type="hidden" name="op" value="goto_list_customer">
                    <input id="button_main" type="submit" value="Clientes">
                </form><br>
            </td>
            <td>
                <form method="post" action="../Supplier/listSupplier">
                    <input type="hidden" name="op" value="goto_list_supplier">
                    <input id="button_main" type="submit" value="Fornecedores">
                </form><br>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="../ProdServ">
                    <input type="hidden" name="op" value="goto_list_prod">
                    <input id="button_main" type="submit" value="Produtos">
                </form><br>
            </td>
            <td>
                <form method="post" action="../ProdServ">
                    <input type="hidden" name="op" value="goto_list_serv">
                    <input id="button_main" type="submit" value="Serviços">
                </form><br>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="../Breed">
                    <input type="hidden" name="op" value="goto_list_breed">
                    <input id="button_main" type="submit" value="Raças">
                </form><br>
            </td>
            
        </tr>
    </table>           
</div>