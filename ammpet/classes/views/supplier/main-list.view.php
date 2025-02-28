<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/v/bs4/dt-2.2.2/datatables.min.css" rel="stylesheet" integrity="sha384-fTqd416qRc9kwY299KdgUPsjOvS5bwkeE6jlibx2m7eL3xKheqGyU48QCFgZAyN4" crossorigin="anonymous">

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h4>Lista Fornecedores</h4>
        </div>
        <div class="col-lg-6">
                <form method="post" action="../Supplier/new_supplier">
                    <input type="hidden" name="op" value="goto_new_supplier">
                    <input id="button_main" class="btn btn-primary m-1 float-right" type="submit" value="Novo Fornecedor">
                </form><br>
            <button type="button" class="btn btn-primary m-1 float-right"><i class="fasfas fa-upload"></i>&nbsp;Novo Registro</button>
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
                                <a href="#" title="Alterar" class="text-success"><i class="fas fa-edit"></i></a>
                                <a href="#" title="Deletar" class="text-danger"><i class="fas fa-eraser"></i></a>
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