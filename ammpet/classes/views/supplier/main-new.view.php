<link rel="stylesheet" href="<?php echo ROOT."/";?>../public/assets/css/styles.css">
    <div><h3>Novo Fornecedor</h3></div>
    <br>
    <form method="post" action="../public/Supplier">
    <input type="hidden" name="op" value="insert">
        <div class="flex-container">
            <div>
                <input id="created_by" type="text" name="created_by" value="<?php if(!isset($_SESSION['username'])) {session_start();} echo $_SESSION['username'];?>">
                <input id="updated_by" type="text" name="updated_by" value="<?php if(!isset($_SESSION['username'])) {session_start();} echo $_SESSION['username'];?>">
                <label for="name" class="medium-label">Nome: </label><input id="name" type="text" size="50" name="name"><br>
                <label for="login" class="medium-label">Login: </label><input id="login" type="text" size="20" name="login"><br>
                <input id="pass" type="text" name="pass" value="<?php if(!isset($_SESSION['username'])) {session_start();} $user=$_SESSION['username']; echo $user[0]."1234";?>">
                <label for="qwe" class="medium-label">QWE: </label>
                <select id="qwe" name="qwe">
                    <option value="abc">ABC</option>
                    <option value="zxc">ZXC</option>
                    <option value="wer">WER</option>
                </select><br><br>
            </div>
            <div>
                <label for="type" class="medium-label">Tipo: </label><input id="type" type="text" size="20" name="type"><br><br>
                <label for="klm" class="medium-label">KLM: </label><input id="klm" type="text" size="20" name="klm"><br><br>
            </div>
            <div>
            </div>
        </div>
        <div><input id="button" type="submit" value="Criar"><br><br></div>
    </form>