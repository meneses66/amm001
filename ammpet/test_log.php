<?php
// Teste simples da função amm_log

// Definir constantes necessárias
define('ROOTPATH', __DIR__);
define('ROOTPATH_CLASSES', __DIR__ . '/classes/core/');

// Incluir o arquivo functions.php
require_once __DIR__ . '/classes/core/functions.php';

// Testar a função de log
amm_log("TESTE: Verificando se a função amm_log está funcionando corretamente");
amm_log("TESTE: Data/hora atual: " . date('Y-m-d H:i:s'));

echo "Teste de log executado. Verifique a pasta " . ROOTPATH_CLASSES . "log_amm\n";
echo "Caminho completo: " . ROOTPATH_CLASSES . "\n";
?>