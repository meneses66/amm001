<?php
// Teste para verificar se amm_log funciona no contexto Ajax

// Simular ambiente do Ajax_call
define('ROOTPATH', __DIR__);
define('ROOTPATH_CLASSES', __DIR__ . '/classes/core/');

// Carregar funções
require_once __DIR__ . '/classes/core/functions.php';

// Testar log
amm_log("TESTE_AJAX: Testando amm_log no contexto Ajax");
amm_log("TESTE_AJAX: ROOTPATH_CLASSES = " . ROOTPATH_CLASSES);

echo "Teste Ajax executado\n";
?>