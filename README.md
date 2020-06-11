# API RESTful - Snack Machine Server

Temos neste projeto uma API RESTful escrito em php utilizando o microframework Lumen (Laravel) que visa
a comunicação com uma máquina de snack.
    
Cada usuário se autentica através de um cartão que através do token é reconhecido pela API. (Bearer)

>### Esta API possui duas entidades CARTAO e TRANSACAO.
>
> CARTAO : os atributos centrais são api_token para autenticação e saldo que é atualizado a cada nova transação (Entradas -> recarga ou Saídas -> compras) 
>    
> TRANSACAO : além da FK cartao_id possui também os atributos valor e tipo (0 para Entrada e 1 para Saída)
>
>*Ambas entidades possuem o atributo created_at que armazena um timestamp no momento que um novo registro é criado.

## ENDPOINTS

Esta API possui apenas dois endpoints que requerem autenticação do tipo Bearer Token.

>### ENDPOINT - CONSULTAR SALDO
>
> Esse endpoint retorna o saldo do cartão.
>
> Método: GET
>
> URI : /api/cartao/saldo?api_token=<token>

>### ENDPOINT - COMPRAR
>
> Esse endpoint permite comprar com o cartão
>
> Método: POST
>
> URI : /api/transacao/compra