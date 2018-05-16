<pre>
<?php

require_once 'transacaoInit.php';

use App\Model\Transacao,
    App\Util\JSONUtils;

$valor = 0;

if($_GET["valor"]){

    $valor = (double) $_GET["valor"];

    $idCartao = $cd->findIdByToken($token);
    $t = new Transacao(null,$valor,null,0,$idCartao);

    if($valor == 2 || $valor == 5.5){
        if($cd->validaDebitos($token)){
            if($cd->validaSaldo($token,$valor)){
                $msg = $td->insert($t)?"Compra realizada com sucesso!":
                                       "Ocorreu um erro interno na inserção da compra. Contatar admin.";
            }else{
                $msg = "Saldo insuficiente.";
            }
        }else{
            $msg = $td->insert($t)?"Compra realizada com sucesso!":
            "Ocorreu um erro interno na inserção da compra. Contatar admin.";
        }
    }else{
        $msg = "Valor não permitido. Valores permitidos: 2 ou 5.5";
    }
    
}

$tipo = (stripos(strtolower($msg),"erro")!==false?"erro":"msg");

echo html_entity_decode(json_encode([
    $tipo => $msg
]));