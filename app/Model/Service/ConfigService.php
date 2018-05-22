<?php

namespace App\Model\Service;

use App\Aux\Connection,
    PDO;

class ConfigService{

    private $con;

    function __construct(){
        $this->con = Connection::getConnection();
    }

    public function inserirCartoes(){
        return (boolean)($this->con->query("INSERT into cartao(c_token)
                                            VALUES
                                            (sha(current_timestamp)),
                                            (sha('2018-05-15 21:34:28')),
                                            (sha(timestampadd(MINUTE,5,'2018-05-15 21:34:28'))),
                                            (sha(timestampadd(MINUTE,15,'2018-05-15 21:34:28'))),
                                            (sha(timestampadd(MINUTE,20,'2018-05-15 21:34:28')));"));               

    }

    public function verificaRegistros(){
        $st = $this->con->query("SELECT (SELECT count(*) FROM cartao) = 0 v");
        $row = $st->fetch(PDO::FETCH_OBJ);
        return (boolean)$row->v;

    }


}
