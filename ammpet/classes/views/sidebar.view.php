<div class="sidebar-heading border-bottom bg-light">ABC System</div>
  <div class="list-group list-group-flush">
      <a class="list-group-item list-group-item-action <?php if(URL_0=='Home') echo 'active';?> list-group-item-light p-3" href="?run=home">Home</a>
      <a class="list-group-item list-group-item-action <?php if(URL_0=='Create') echo 'active';?> list-group-item-light p-3" href="?run=create">Cadastros</a>
      <a class="list-group-item list-group-item-action <?php if(URL_0=='Search') echo 'active';?> list-group-item-light p-3" href="?run=search">Consultas</a>
      <a class="list-group-item list-group-item-action <?php if(URL_0=='Report') echo 'active';?> list-group-item-light p-3" href="?run=report">Relatórios</a>
      <a class="list-group-item list-group-item-action <?php if(URL_0=='OrderX') echo 'active';?> list-group-item-light p-3" href="?run=orderx">Vendas</a>
      <a class="list-group-item list-group-item-action <?php if(URL_0=='Agenda') echo 'active';?> list-group-item-light p-3" href="?run=agenda">Agenda</a>
      <a class="list-group-item list-group-item-action <?php if(URL_0=='Control') echo 'active';?> list-group-item-light p-3" href="?run=control">Caixa</a>
      <a class="list-group-item list-group-item-action <?php if(URL_0=='Admin') echo 'active';?> list-group-item-light p-3" href="?run=admin">Admin</a>
  </div>

<?php

if (isset($_GET['run'])) $linkchoice=$_GET['run'];
else $linkchoice='';

switch($linkchoice){

case 'home' :
  redirect('Home');
  break;
    
case 'create' :
    redirect('Home/create');
    break;

case 'search' :
    redirect('Search');
    break;

case 'report' :
    redirect('Report');
    break;

case 'orderx' :
    redirect('OrderX');
    break;

case 'agenda' :
    redirect('Agenda');
    break;

case 'control' :
    redirect('Control');
    break;

case 'admin' :
    redirect('Admin');
    break;

}
?>