<?php

namespace App\Model;

class ProdutoDao {

    public function create(Produto $p){
        $sql = 'INSERT INTO vendas (img, nome, valor, forma_pagamento)
                VALUES (?,?,?,?)';
        
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $p->getImg());
        $stmt->bindValue(2, $p->getNome());
        $stmt->bindValue(3, $p->getValor());
        $stmt->bindValue(4, $p->getFormaPagamento());
        $stmt->execute();
    }

    public function read(){
        $sql = 'SELECT * FROM vendas';

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();
    
        if($stmt->rowCount() > 0){
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        }
    }

    public function update(Produto $p){

    }

    public function delete($id){

    }
}