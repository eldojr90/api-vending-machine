# api-vending-machine-php
API RESTful que simula uma comunicação com uma máquina de snacks

>Script para criação da base de dados: sm.sql

>Para testar a API é necessário inicialmente utilizar um dos tokens dos cartões disponíveis*
    
    - f7d2186e4bbbe8512b425407cce6d193e59795a0
    - af8c4538bf831133a86293fc91658e094bcd8ab4
    - 943d40f0a5dd68b9e833398cb13fd54298a114d6
    - 7ac71ff635ee312b0cfaa555ca8deeabb62f8584
    - 1512d2a4035a3457d4805a81e47360f256bda7e1

	* O sistema irá inserir esses tokens automaticamente.

>Endpoints

    - CONSULTAR SALDO
        parametro(s): token string (40)
        método: GET
        url: dns/ecartao/saldo.php?token=<token>
        retorno: JSON com array de objetos. Indice "saldo" com um valor decimal em caso de sucesso, ou 
        "msg" com uma string caso não haja sucesso ou "ERROR" também string com a mensagem correspondente 
        ao erro.

    - CONSULTAR EXTRATO
        parametro(s): token string (40)
        método: GET
        url: dns/ecartao/extrato.php?token=<token>
        retorno: JSON com array de objetos. Indíces numéricos e o índice "saldo" em caso de sucesso, ou, 
        somente "msg" com uma string caso não haja sucesso ou somente o índice "ERROR" com a mensagem 
        correspondente ao erro.

    - REALIZAR COMPRA
        parametro(s): token string (40), valor decimal(4,2)
        método: GET
        url: dns/etransacao/compra.php?token=<token>&valor=<valor>
        retorno: JSON com array de objetos. Indice "msg" com uma string ou "ERROR" com a mensagem 
        correspondente ao erro.
