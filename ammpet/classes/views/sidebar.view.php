<div class="sidebar-heading border-bottom bg-light">ABC System</div>
  <div class="list-group list-group-flush">
      <?php echo URL(1);?>
      <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?run=home">Home</a>
      <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?run=create">Cadastros</a>
      <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?run=search">Consultas</a>
      <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?run=report">Relatórios</a>
      <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?run=orderx">Vendas</a>
      <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?run=agenda">Agenda</a>
      <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?run=control">Caixa</a>
      <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?run=admin">Admin</a>
  </div>

<?php

if (isset($_GET['run'])) $linkchoice=$_GET['run'];
else $linkchoice='';

switch($linkchoice){

case 'home' :
  redirect('Home');
  break;
    
case 'create' :
    redirect('Create');
    break;

case 'search' :
    mySecond();
    break;

case 'report' :
  mySecond();
  break;

case 'orderx' :
  mySecond();
  break;

case 'agenda' :
  mySecond();
  break;

case 'control' :
  mySecond();
  break;

case 'admin' :
  mySecond();
  break;

}
?>