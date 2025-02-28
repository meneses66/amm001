<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h4>Consultas</h4>
        </div>
    </div>
    <hr class="my-1">
    <br><br><br><br>
    <div class="row">
        <div class="col-sm-6"><a href="<?php echo ROOT."/Client/list_client";?>" class="btn btn-primary btn-lg m-1 btn-block"><i class="fas fa-search"></i>&nbsp;Clientes</a></div>
        <div class="col-sm-6"><a href="<?php echo ROOT."/Suppliet/list_supplier";?>" class="btn btn-primary btn-lg m-1 btn-block"><i class="fas fa-search"></i>&nbsp;Fornecedores</a></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><a href="<?php echo ROOT."/ProdServ/list_product";?>" class="btn btn-primary btn-lg m-1 btn-block"><i class="fas fa-search"></i>&nbsp;Produtos</a></div>
        <div class="col-sm-6"><a href="<?php echo ROOT."/ProdServ/list_service";?>" class="btn btn-primary btn-lg m-1 btn-block"><i class="fas fa-search"></i>&nbsp;Serviços</a></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><a href="<?php echo ROOT."/Breed/list_breed";?>" class="btn btn-primary btn-lg m-1 btn-block"><i class="fas fa-search"></i>&nbsp;Raças</a></div>
    </div>
    <br>
</div>


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