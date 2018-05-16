<?php

require_once 'cartaoInit.php';

$extrato = $cd->getExtrato($token);

if($extrato == null || count($extrato) == 0){
    $msg = "Erro interno ao pesquisar extrato. Contatar admin.";
}

$extrato["saldo"] = (double) $saldo;
$tipo = stripos(strtolower($msg),"erro")!==false?"ERROR":null;

$temp = [];

if(isset($tipo)){
    $temp = [
        $tipo => $msg
    ];
}else{
    $temp = $extrato;
}

echo html_entity_decode(json_encode($temp));