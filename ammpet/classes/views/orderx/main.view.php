<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css">
<div class="container-fluid">
<div>Vendas</div>
<br><br><br><br>
    <table style="width:100%">
        <tr>
            <td>
                <form method="post" action="../public/Orderx">
                    <input type="hidden" name="op" value="list_orderx">
                    <input id="button_main" type="submit" value="Vendas">
                </form><br>
            </td>
            <td>
                <form method="post" action="../public/Supplier">
                    <input type="hidden" name="op" value="new_orderx">
                    <input id="button_main" type="submit" value="Nova Venda">
                </form><br>
            </td>
        </tr>
    </table>           
</div>