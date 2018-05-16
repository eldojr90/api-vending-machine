<?php

namespace App\Model;

class Transacao{

    private $id;
    private $valor;
    private $horario;
    private $tipo;
    private $idCartao;

    function __construct($id,$valor,$horario,$tipo,$idCartao){
        $this->id = $id;
        $this->valor = $valor;
        $this->horario = $horario;
        $this->tipo = $tipo;
        $this->idCartao = $idCartao;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }


    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of horario
     */ 
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set the value of horario
     *
     * @return  self
     */ 
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get the value of idCartao
     */ 
    public function getIdCartao()
    {
        return $this->idCartao;
    }

    /**
     * Set the value of idCartao
     *
     * @return  self
     */ 
    public function setIdCartao($idCartao)
    {
        $this->idCartao = $idCartao;

        return $this;
    }
}