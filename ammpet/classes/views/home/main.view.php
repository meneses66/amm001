<link rel="stylesheet" href="../public/assets/css/styles.css">
<div class="container-fluid">
    <br><br><br>
            <form method="post" action="../public/Client">
                <input type="hidden" name="op" value="list_customer">
                <input id="button" type="submit" value="Clientes">
            </form>
            <br><br><br>
            <form method="post" action="../public/OrderX">
                <input type="hidden" name="op" value="list_orders">
                <input id="button" type="submit" value="Vendas">
            </form>
            <br><br><br>
            <form method="post" action="../public/Agenda">
                <input type="hidden" name="op" value="agenda">
                <input id="button" type="submit" value="Agenda">
            </form>
            <form method="post" action="../public/OrderX">
                <input type="hidden" name="op" value="new_order">
                <input id="button" type="submit" value="Nova Venda">
            </form>
</div>