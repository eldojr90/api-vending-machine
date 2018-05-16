<?php

require_once '../vendor/autoload.php';

use App\Model\Service\ConfigService;

$cs = new ConfigService();

if($cs->verificaRegistros()){
    if(!$cs->inserirCartoes()){
        echo "ERRO AO INSERIR CARTÕES";
    }
}