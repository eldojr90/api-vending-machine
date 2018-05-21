<?php

namespace Tests\Entities;

use App\Model\Transacao,
    InvalidArgumentException,
    PHPUnit_Framework_TestCase as TestCase;

class TransacaoTest extends TestCase{

    protected $t;
            
    public function __construct($name = "TransacaoTest", array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->t = new Transacao(1,5.5,"current_timestamp",1,2);
    }
    
    public function testTransacaoType(){
        $this->assertInstanceOf(Transacao::class,$this->t);
    }
    
    public function testIdType(){
        
        if(!is_numeric($this->t->getId())){
            throw InvalidArgumentException;
        }
        
        $this->assertEquals(1, $this->t->getId());
        
    }
    
    public function testValorType(){
        
        if(!is_numeric($this->t->getValor())){
            throw InvalidArgumentException;
        }
        
        $this->assertEquals(5.5, $this->t->getValor());
        
    }
    
    public function testDataType(){
        
        if(!is_string($this->t->getHorario())){
            throw InvalidArgumentException;
        }
        
        $this->assertEquals("current_timestamp",$this->t->getHorario());
        
    }
    
    public function testTipoType(){
        
        if(!is_numeric($this->t->getTipo())){
            throw InvalidArgumentException;
        }
        
        $this->assertEquals(1,$this->t->getTipo());
        
    }
    
    public function testeIdCartaoType(){
        
        if(!is_numeric($this->t->getIdCartao())){
            throw InvalidArgumentException;
        }
        
        $this->assertEquals(2, $this->t->getCartao());
    }

}