<?php

namespace App\Model\DAO;

use App\Aux\Connection,
    App\Model\Transacao,
    PDO;

class TransacaoDAO{
    
    private $con;
    
    function __construct(){
        $this->con = Connection::getConnection();
    }
    
    public function insert(Transacao $t){
        
        $idCartao = $t->getIdCartao();
        $valor = $t->getValor();
        $tipo = $t->getTipo();
        
        $sql = "INSERT INTO transacao (c_id, t_valor, t_tipo) 
                VALUES (?,?,?)";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$idCartao);
        $ps->bindParam(2,$valor);
        $ps->bindParam(3,$tipo);
        
        return $ps->execute();

    }

    //valida se foi creditado o valor diário
    public function validaCreditoDiario($token){
        
        $sql = "SELECT(
                        SELECT count(t_id) 
                        FROM transacao
                        WHERE t_tipo = true
                        AND date_format(t_horario,'%d%m%y') = date_format(now(),'%d%m%y') 
                        AND c_id = (SELECT c_id 
                                    FROM cartao WHERE c_token = ?)
                ) = 0 v;";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$token);
        $ps->execute();

        return (boolean) ($ps->fetch(PDO::FETCH_OBJ)->v);

    }

}