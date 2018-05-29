<?php

require_once '../config/init.php';

use App\Model\Transacao,
    App\Model\DAO\CartaoDAO,
    App\Model\DAO\TransacaoDAO,
    PDO;

header("Content-Type:application/json; charset=UTF-8",true);

$td = new TransacaoDAO();
$cd = new CartaoDAO();

$msg = null;

//vars para armazenar dados das requisições
$token = null;

//vars genéricas
$idCartao = null;

if(isset($_GET["token"])){
    
    $token = $_GET["token"]; 
    $idCartao = $cd->findIdByToken($token);
    
    
    if(isset($idCartao)){
        if($td->validaCreditoDiario($token)){
                $t = new Transacao(null,5.5,null,1,$idCartao);
                if(!$td->insert($t)){
                    $msg = !isset($msg)?"Erro ao inserir crédito diário de R$ 5,50.":$msg;
                }
        }
    }else{$msg = !isset($msg)?"Token inexistente!.":$msg;}
    

}else{$msg = !isset($msg)?
    "Requisição inválida! Verifique os parâmetros necessários para sua requisição em README.md":
    $msg;
}