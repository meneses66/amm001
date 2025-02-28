<!-- <link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="container-fluid">
<div>Cadastros</div>
<br><br><br><br>
    <table style="width:100%">
        <tr>
            <td>
                <a href="<?php echo ROOT."/Client/new_client";?>" class="btn btn-success m-1 float-center"><i class="fas fa-upload"></i>&nbsp;Novo Cliente</a>
            </td>
            <td>
                <a href="<?php echo ROOT."/Supplier/new_supplier";?>" class="btn btn-success m-1 float-left"><i class="fas fa-upload"></i>&nbsp;Novo Fornecedor</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="<?php echo ROOT."/ProdServ/new_product";?>" class="btn btn-success m-1 float-center"><i class="fas fa-upload"></i>&nbsp;Novo Produto</a>
            </td>
            <td>
                <a href="<?php echo ROOT."/ProdServ/new_service";?>" class="btn btn-success m-1 float-left"><i class="fas fa-upload"></i>&nbsp;Novo Serviço</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="<?php echo ROOT."/Breed/new_breed";?>" class="btn btn-success m-1 float-center"><i class="fas fa-upload"></i>&nbsp;Nova Raça</a>
            </td>
        </tr>
    </table>           
</div>