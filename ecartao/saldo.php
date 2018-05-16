<?php

require_once 'cartaoInit.php';

if($idCartao === null){$msg = "Cartão inválido! Token inexistente.";}

$tipo = stripos(strtolower($msg),"erro")!==false?"ERROR":"saldo";
$tipo = !isset($msg)?$tipo:"msg";
$obj = $tipo==="ERROR"||isset($msg)?$msg:(double)$saldo;

echo html_entity_decode(json_encode([
    $tipo=>$obj
]));








