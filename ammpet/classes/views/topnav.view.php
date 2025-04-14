<?php 
    $user_permission = get_user_permissions($_SESSION['username']);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <input id="user_permissions" type="hidden" value="<?php echo $user_permission; ?>">
    <div class="container-fluid">
        <button class="btn btn-primary" id="sidebarToggle">Menu</button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item"><a class="nav-link"><?php if(!isset($_SESSION['username'])) {session_start();} echo "Usuário: ".$_SESSION['username'];?></a></li></li>
                <li class="nav-item active"><a class="nav-link" href="<?php echo ROOT."/Login/_logout";?>">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>