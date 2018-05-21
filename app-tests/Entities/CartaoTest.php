<?php

namespace Tests\Entities;

use App\Model\Cartao,
    InvalidArgumentException,
    PHPUnit_Framework_TestCase as TestCase;

class CartaoTest extends TestCase{

    protected $c;
            
    public function __construct($name = "CartaoTest", array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->c = new Cartao(1,"1234");
    }
    
    public function testCartaoType(){
        $this->assertInstanceOf(Cartao::class,$this->c);
    }
    
    public function testIdType(){
        
        if(!is_numeric($this->c->getId())){
            throw InvalidArgumentException;
        }
        
        $this->assertEquals(1, $this->c->getId());
        
    }
    
    public function testTokenType(){
        
        if(!is_string($this->c->getToken())){
            throw InvalidArgumentException;
        }
        
        $this->assertEquals("1234", $this->c->getToken());
        
    }
    


}