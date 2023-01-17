<?php

namespace App\Model;

class Produto {
    private $id, $nome, $valor, $formaPagamento, $img;

    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getNome(){
        return $this->nome;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getid(){
        return $this->id;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }
    public function getValor(){
        return $this->valor;
    }

    public function setFormaPagamento($formaPagamento){
        $this->formaPagamento = $formaPagamento;
    }

    public function getFormaPagamento(){
        return $this->formaPagamento;
    }
    
    public function setImg($img){
        $this->img = $img;
    }
    public function getImg(){
        return $this->img;
    }
}