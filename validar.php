<?php
session_start();
require_once 'vendor/autoload.php';

if(!isset($_SESSION['carrinho'])){
    header('location: minhasCompras.php');
} else {

    var_dump($_SESSION['carrinho']);

    $produto = new \App\Model\Produto();

    foreach($_SESSION['carrinho'] as $key => $value){
        $produto->setImg($_SESSION['carrinho'][$key]['imagem']);
        $produto->setNome($_SESSION['carrinho'][$key]['nome']);
        $produto->setValor($_SESSION['carrinho'][$key]['preco']);
        $produto->setFormaPagamento($_SESSION['carrinho'][$key]['formaPagamento']);

        $produtoDao = new \App\Model\ProdutoDao();
        $produtoDao->create($produto);
    }
    session_destroy();
    include './include/head.php';


    if($_SESSION['carrinho'][$key]['formaPagamento'] == "cartao"){

        ?>
        <div class="container my-5 text-center d-flex justify-content-center">
            <div class="text-center mx-auto ">
                <i  class="bi icon-validar bi-check-circle"></i>
                <h1 class="mb-3">Compra confirmada!!</h1>
                <a href="?btn=minhasCompras" class="btn btn-success my-3 btn-validar">Minhas compras</a>
            </div>
        </div>
        <?php

    } else if($_SESSION['carrinho'][$key]['formaPagamento'] == "boleto"){

        ?>
        <div class="container my-5 text-center d-flex justify-content-center">
            <div class="text-center mx-auto ">
                <i  class="bi icon-validar bi-file-earmark-check"></i>
                <h1 class="mb-3">Boleto gerado com sucesso!!</h1>
                <a href="?btn=boleto" class="btn btn-success my-3 btn-validar">Gerar boleto</a>
            </div>
        </div>
        <?php
    }

    if(isset($_GET['btn'])){
        $btn = $_GET['btn'];

        // var_dump($produtoDao);

        // var_dump($produto);
        
        // if($btn == 'minhasCompras'){
        //     // session_destroy();

        //     // header('location: index.php');
        // } else if($btn == 'boleto'){

        // }
    }
}
include './include/footer.php';