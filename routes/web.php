<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Http\Request;

$router->group(['prefix' => 'api'], function() use ($router){
    
    //cartão
    $router->group(['prefix' => 'cartao'], function() use ($router){
        $router->get('saldo', 'CartaoController@saldo');
    });

    //transacao
    $router->group(['prefix' => 'transacao'], function() use ($router){
        $router->post('compra', 'TransacaoController@compra');
    });
    
});