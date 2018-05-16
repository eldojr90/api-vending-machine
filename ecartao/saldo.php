<?php

require_once 'cartaoInit.php';

$tipo = stripos(strtolower($msg),"erro")!==false?"ERROR":"saldo";
$obj = $tipo==="ERROR"?$msg:(double)$saldo;

echo html_entity_decode(json_encode([
    $tipo=>$obj
]));






