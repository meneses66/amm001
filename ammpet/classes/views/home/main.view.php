<link rel="stylesheet" href="../public/assets/css/styles.css">
<div class="container-fluid">
<div>Home</div>
<br><br><br><br>
    <table style="width:100%">
        <tr>
            <td>
                <form method="post" action="../public/Client">
                    <input type="hidden" name="op" value="list_customer">
                    <input id="button_main" type="submit" value="Clientes">
                </form><br>
            </td>
            <td>
                <form method="post" action="../public/OrderX">
                    <input type="hidden" name="op" value="list_orders">
                    <input id="button_main" type="submit" value="Vendas">
                </form><br>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="../public/Agenda">
                    <input type="hidden" name="op" value="agenda">
                    <input id="button_main" type="submit" value="Agenda">
                </form>
            </td>
            <td>
                <form method="post" action="../public/OrderX">
                    <input type="hidden" name="op" value="new_order">
                    <input id="button_main" type="submit" value="Nova Venda">
                </form>
            </td>
        </tr>
    </table>           
</div>