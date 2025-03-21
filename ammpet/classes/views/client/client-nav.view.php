        <div class="col-sm-2">
            <a href="<?php echo ROOT."/Client/_cli_animal?cli_id=".$_GET['id'];?>" title="Animals" class="list-group-item list-group-item-action <?php echo $class=(URL_0=='Client' && URL_1=='_cli_animal') ? 'active' : ''; ?> list-group-item-secondary p-3" cli_id="<?php echo $_GET['id'];?>"><i class="fas fa-cat"></i>&nbsp;&nbsp;Animais</a>
        </div>
        <div class="col-sm-2">
            <a href="<?php echo ROOT."/Client/_cli_package?cli_id=".$_GET['id'];?>" title="Packages" class="list-group-item list-group-item-action <?php echo $class=(URL_0=='Client' && URL_1=='_cli_package') ? 'active' : ''; ?> list-group-item-secondary p-3" cli_id="<?php echo $_GET['id'];?>"><i class="fas fa-archive"></i>&nbsp;&nbsp;Pacotes</a>
        </div>
        <div class="col-sm-2">
            <a href="<?php echo ROOT."/Client/_cli_product?cli_id=".$_GET['id'];?>" title="Products" class="list-group-item list-group-item-action <?php echo $class=(URL_0=='Client' && URL_1=='_cli_product') ? 'active' : ''; ?> list-group-item-secondary p-3" cli_id="<?php echo $_GET['id'];?>"><i class="fas fa-barcode"></i>&nbsp;&nbsp;Produtos</a>
        </div>
        <div class="col-sm-2">
            <a href="<?php echo ROOT."/Client/_cli_service?cli_id=".$_GET['id'];?>" title="Services" class="list-group-item list-group-item-action <?php echo $class=(URL_0=='Client' && URL_1=='_cli_service') ? 'active' : ''; ?> list-group-item-secondary p-3" cli_id="<?php echo $_GET['id'];?>"><i class="fas fa-cut"></i>&nbsp;&nbsp;Serviços</a>
        </div>