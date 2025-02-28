<div class="sidebar-heading border-bottom bg-light">ABC System</div>
  <div class="list-group list-group-flush">
      <a class="list-group-item list-group-item-action <?php if(null !== URL_0) {if(URL_0=='Home' && URL_1=="") echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Home";?>">Home</a>
      <a class="list-group-item list-group-item-action <?php if(null!== URL_0 && null !== URL_1) {if(URL_0=='Home' && URL_1=='create') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Home/create";?>">Cadastros</a>
      <a class="list-group-item list-group-item-action <?php if(null!== URL_0 && null !== URL_1) {if(URL_0=='Home' && URL_1=='search') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Home/search";?>">Consultas</a>
      <a class="list-group-item list-group-item-action <?php if(null!== URL_0 && null !== URL_1) {if(URL_0=='Home' && URL_1=='report') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Home/report";?>">Relatórios</a>
      <a class="list-group-item list-group-item-action <?php if(null !== URL_0) {if(URL_0=='OrderX') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/OrderX";?>">Vendas</a>
      <a class="list-group-item list-group-item-action <?php if(null !== URL_0) {if(URL_0=='Agenda') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Agenda";?>">Agenda</a>
      <a class="list-group-item list-group-item-action <?php if(null !== URL_0) {if(URL_0=='Control') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Control";?>">Caixa</a>
      <a class="list-group-item list-group-item-action <?php if(null !== URL_0) {if(URL_0=='Admin') echo 'active';}?> list-group-item-primary p-3" href="<?php echo ROOT."/Admin";?>">Admin</a>
  </div>