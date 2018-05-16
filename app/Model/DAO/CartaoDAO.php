<?php

namespace App\Model\DAO;

use App\Aux\Connection, 
    App\Model\Transacao,
    PDO;

class CartaoDAO{
    
    private $con;
    
    function __construct(){
        $this->con = Connection::getConnection();
    }
    
    public function getTotalEntradas($token){
        
        $sql = "SELECT sum(t_valor) total
                FROM transacao
                WHERE c_id = (SELECT c_id
                            FROM cartao
                            WHERE c_token = ?)
                AND t_tipo = 1
                AND date_format(t_horario,'%d%m%y') = date_format(now(),'%d%m%y');";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$token);
        $ps->execute();

        return ($ps->fetch(PDO::FETCH_OBJ)->total);

    }

    public function getSaldo($token){
        
        $sql = "SELECT((SELECT sum(t_valor)
                        FROM transacao
                        WHERE c_id = (SELECT c_id
                                    FROM cartao
                                    WHERE c_token = ?)
                        AND t_tipo = 1
                        AND date_format(t_horario,'%d%m%y') = date_format(now(),'%d%m%y'))
                        -
                        (SELECT sum(t_valor)
                        FROM transacao
                        WHERE c_id = (SELECT c_id
                                    FROM cartao
                                    WHERE c_token = ?)
                        AND t_tipo = 0
                        AND date_format(t_horario,'%d%m%y') = date_format(now(),'%d%m%y')))
                saldo ;";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$token);
        $ps->bindParam(2,$token);
        $ps->execute();

        return ($ps->fetch(PDO::FETCH_OBJ)->saldo);

    }

    public function getExtrato($token){
        
        $sql = "SELECT t_valor, t_tipo, date_format(t_horario, '%T %d/%m/%Y') t_horario
                FROM transacao
                WHERE c_id = (SELECT c_id 
                            FROM cartao
                            WHERE c_token = ?)
                AND date_format(t_horario,'%d%m%y') = date_format(now(),'%d%m%y')
                ORDER BY t_horario;";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$token);
        $ps->execute();

        $extrato = [];

        while($row = $ps->fetch(PDO::FETCH_OBJ)){

            $temp = [
                "valor"=>(double) $row->t_valor,
                "horario"=>$row->t_horario,
                "tipo"=>$row->t_tipo==1?"Crédito":"Débito",
            ];
            
            array_push($extrato,$temp);
        }

        return $extrato;

    }

    //valida se há saldo suficiente no cartao
    public function validaSaldo($token,$vdeb){
        
        $sql = "SELECT((SELECT sum(t_valor)
                        FROM transacao
                        WHERE c_id = (SELECT c_id
                                    FROM cartao
                                    WHERE c_token = ?)
                        AND t_tipo = 1
                        AND date_format(t_horario,'%d%m%y') = date_format(now(),'%d%m%y'))
                        -
                        (SELECT sum(t_valor)
                        FROM transacao
                        WHERE c_id = (SELECT c_id
                                    FROM cartao
                                    WHERE c_token = ?)
                        AND t_tipo = 0
                        AND date_format(t_horario,'%d%m%y') = date_format(now(),'%d%m%y')))
                > ? v;";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$token);
        $ps->bindParam(2,$token);
        $ps->bindParam(3,$vdeb);
        $ps->execute();

        return (boolean) ($ps->fetch(PDO::FETCH_OBJ)->v);

    }

    //verifica se existem débitos
    public function validaDebitos($token){
        
        $sql = "SELECT((SELECT count(t_valor)
                        FROM transacao
                        WHERE c_id = (SELECT c_id
                                    FROM cartao
                                    WHERE c_token = ?)
                        AND t_tipo = 0
                        AND date_format(t_horario,'%d%m%y') = date_format(now(),'%d%m%y')))
                > 0 v;";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$token);
        $ps->execute();

        return (boolean) ($ps->fetch(PDO::FETCH_OBJ)->v);
    }

    public function findIdByToken($token){
        
        $sql = "SELECT c_id 
                FROM cartao 
                WHERE c_token = ?";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$token);
        $ps->execute();

        return ($ps->fetch(PDO::FETCH_OBJ))->c_id;

    }

}