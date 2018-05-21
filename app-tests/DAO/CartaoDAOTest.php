<?php

namespace Tests\Entities;

use App\Model\DAO\CartaoDAO,
    PHPUnit_Framework_TestCase as TestCase;

class CartaoDAOTest extends TestCase{

    
    protected $cd;
    protected $token;
    protected $vdeb;
    
            
    public function __construct($name = "CartaoDAOTest", array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->cd = new CartaoDAO();
        $this->token = 'f7d2186e4bbbe8512b425407cce6d193e59795a0';
        $this->vdeb = 2;
    }
    
    public function testCartaoType(){
        $this->assertInstanceOf(CartaoDAO::class, $this->td);
    }
    
    public function testTotalEntradas(){
        $this->assertEquals(null,$this->cd->getTotalEntradas($this->token));
    }
    
    public function testSaldo(){
        $this->assertEquals(null,$this->cd->getSaldo($this->token));
    }
    
    public function testValidaSaldo(){
        $this->assertEquals(false,$this->cd->validaSaldo($this->token, $this->vdeb));
    }
    
    public function testValidaDebitos(){
        $this->assertEquals(true,$this->cd->validaDebitos($this->token));
    }
    
}