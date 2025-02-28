<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
                <a href="<?php echo ROOT."/Supplier/new_supplier";?>" class="btn btn-success m-1 float-right"><i class="fas fa-upload"></i>&nbsp;Novo Fornecedor</a>
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