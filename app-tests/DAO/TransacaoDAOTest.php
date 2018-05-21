<?php

namespace Tests\Entities;

use App\Model\Transacao,
    App\Model\DAO\TransacaoDAO,
    PHPUnit_Framework_TestCase as TestCase;

class TransacaoDAOTest extends TestCase{

    
    protected $td;
    protected $t;
    protected $token;
    
    public function __construct($name = "TransacaoDAOTest", array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->td = new TransacaoDAO();
        $this->t = new Transacao(1, 5.5, "current_timestamp", 1, 1);
        $this->token = 'f7d2186e4bbbe8512b425407cce6d193e59795a0';
    }
    
    public function testTransacaoType(){
        $this->assertInstanceOf(TransacaoDAO::class, $this->td);
    }
    
    public function testInsert(){
        $this->assertEquals(true,$this->td->insert($this->t));
    }
    
    public function testValidaCreditoDiario(){
        $this->assertEquals(true,$this->td->validaCreditoDiario($this->token));
    }
    
}