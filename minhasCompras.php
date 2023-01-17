<?php
session_start();
require_once 'vendor/autoload.php';
include './include/head.php';

$produtoDao = new \App\Model\ProdutoDao();
$produtoDao->read();
?>
<div class="container">
    <h1>Minhas compras</h1>
<?php
foreach($produtoDao->read() as $key => $value){
?>

    <ul class="list-group mb-3 m-3">
        <li class="list-group-item py-3">
            <div class="row">
                <div id="picture" class="col-4 col-md-3 col-lg-2 ">
                    <a href="#">
                        <img src="<?php echo $value['img']?>" class="img-thumbnail "/>
                    </a>
                </div>
                <div class="col-5 col-md-5 col-lg-7 col-xl-6 text-left align-self-center">
                    <h4>
                        <a href="#" class="text-decoration-none text-dange  list-group-item-action"><?php echo $value['nome']?></a>
                    </h4>
                    <small>R$<?php echo $value['valor']?>,00</small>
                    <small>Forma de pagamento: <?php echo $value['forma_pagamento']?></small>
                </div>
                <div class="col-4 offset-8 align-self-center col-sm-2 offset-sm-8 col-md-2 offset-md-0 col-lg-2 offset-lg-1 col-xl-3 align-sel-center mt-3">
                    <a  class="btn text-light bg-info">Meu Comprovante</a>
                </div>
            </div>
        </li>
    </ul>
<?php    
}
?>
</div>