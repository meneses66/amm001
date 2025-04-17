<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="sidebar-heading border-bottom bg-light">ABC System</div>
<div><? echo ROOT ?></div>
<div><? echo ROOTPATH ?></div>
<div><? echo ROOTPATH_CLASSES ?></div>
  <div class="list-group list-group-flush">
      <a class="list-group-item list-group-item-action <?php if(null !== URL_0) {if(URL_0=='Home' && URL_1=="") echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Home";?>"><i class="fa fa-home"></i>&nbsp;Home</a>
      <a class="list-group-item list-group-item-action <?php if(null!== URL_0 && null !== URL_1) {if(URL_0=='Home' && URL_1=='create') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Home/create";?>"><i class="fas fa-folder-plus"></i>&nbsp;Cadastros</a>
      <a class="list-group-item list-group-item-action <?php if(null!== URL_0 && null !== URL_1) {if(URL_0=='Home' && URL_1=='search') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Home/search";?>"><i class="fas fa-search"></i>&nbsp;Consultas</a>
      <a class="list-group-item list-group-item-action <?php if(null!== URL_0 && null !== URL_1) {if(URL_0=='Home' && URL_1=='report') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Home/report";?>"><i class="fas fa-th-list"></i>&nbsp;Relatórios</a>
      <a class="list-group-item list-group-item-action <?php if(null !== URL_0) {if(URL_0=='Orderx') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Orderx";?>"><i class="far fa-money-bill-alt"></i>&nbsp;Vendas</a>
      <a class="list-group-item list-group-item-action <?php if(null !== URL_0) {if(URL_0=='Agenda') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Agenda";?>"><i class="far fa-calendar-alt"></i>&nbsp;Agenda</a>
      <a class="list-group-item list-group-item-action <?php if(null !== URL_0) {if(URL_0=='Control') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Control";?>"><i class="fas fa-cash-register"></i>&nbsp;Caixa</a>
      <a class="list-group-item list-group-item-action <?php if(null !== URL_0) {if(URL_0=='Admin') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Admin";?>"><i class="fas fa-database"></i>&nbsp;Admin</a>
  </div>