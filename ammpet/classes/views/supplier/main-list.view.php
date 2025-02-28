<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.datatables.net/v/bs4/dt-2.2.2/datatables.min.css" rel="stylesheet" integrity="sha384-fTqd416qRc9kwY299KdgUPsjOvS5bwkeE6jlibx2m7eL3xKheqGyU48QCFgZAyN4" crossorigin="anonymous">

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h4>Lista Fornecedores</h4>
        </div>
        <div class="col-lg-6">
            <a href="<?php echo ROOT."/Supplier/new_supplier";?>" class="btn btn-success m-1 float-right"><i class="fas fa-upload"></i>&nbsp;Novo Fornecedor</a>
            <a href="#" class="btn btn-success m-1 float-right"><i class="fas fa-upload"></i>&nbsp;Export</a>
        </div>
        <hr class="my-1">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive" id="listSupplier">
                <table class="table Table-stripped table-sm table-bordered">
                    <thead>
                        <tr class="text-center text-secondary">
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Cargo</th>
                            <th>Tipo</th>
                            <th>Status</th>
                            <th>CNPJ</th>
                            <th>CPF</th>
                            <th>Sequência</th>
                            <th>Data Início</th>
                            <th>Comentários</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center text-secondary">
                            <td>1</td>
                            <td>Supplier 1</td>
                            <td>S01</td>
                            <td>Recepcao</td>
                            <td>Funcionario</td>
                            <td>Ativo</td>
                            <td></td>
                            <td></td>
                            <td>60</td>
                            <td>24/02/2025</td>
                            <td>Teste 00001</td>
                            <td>
                                <a href="<?php echo ROOT."/Supplier/update_supplier";?>" title="Edit" class="text-primary"><i class="fas fa-edit"></i>A</a>&nbsp;&nbsp;
                                <a href="<?php echo ROOT."/Supplier/delete_supplier";?>" title="Delete" class="text-danger"><i class="fas fa-eraser"></i>D</a>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
        
    </div>
</div>
<br>