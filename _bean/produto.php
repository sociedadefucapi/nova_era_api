<?php

class produto {

    private $nome;
    private $cod_barra;
    private $setor;
    private $preco;
    static $disponibilidade = "DISPONIVEL";

    public function __construct($nome, $cod_barra, $setor, $preco) {
        $this->nome = $nome;
        $this->cod_barra = $cod_barra;
        $this->setor = $setor;
        $this->preco = $preco;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCod_Barra() {
        return $this->cod_barra;
    }

    public function setCod_Barra($cod_barra) {
        $this->cod_barra = $cod_barra;
    }

    public function getSetor() {
        return $this->setor;
    }
    
    public function setSetor($setor) {
        $this->setor = $setor;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }
   
    public static function getDisponibilidade() {
        return self::$disponibilidade;
    }

    public static function setDisponibilidade($disponibilidade) {
        self::$disponibilidade = $disponibilidade;
    }

}
