<?php
session_start();

if(isset($_GET['item'])){
    $item = $_GET['item'];

    if(isset($_SESSION['carrinho'][$item])){
        unset($_SESSION['carrinho'][$item]);
        echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Produto removido com sucesso!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        "; 
        // header('location:carrinho.php');
    } else {
        echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>O produto que você quer remover não existe mais no seu carrinho!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        "; 
    }
}
include './include/head.php';
?>
<div class="container my-5" >
    <h1>Carrinho de compras</h1>
    <div class="row">
        <div id="coluna-carrinho-decompras" class="col-8 p-1">
    <?php
        if(isset($_SESSION['carrinho'])){
            if(sizeof($_SESSION['carrinho']) != 0){
                $valorTotal = 0;
                foreach($_SESSION['carrinho'] as $key => $value){
                    $valorTotal += $value['preco'];

        ?>  
                <ul class="list-group mb-3">
                    <li class="list-group-item py-3">
                        <div class="row g-3">
                            <div id="picture" class="col-4 col-md-3 col-lg-2 ">
                                <a href="#">
                                    <img src="<?php echo $_SESSION['carrinho'][$key]['imagem'] ?>" class="img-thumbnail "/>
                                </a>
                            </div>
                            <div class="col-5 col-md-5 col-lg-7 col-xl-7 text-left align-self-center">
                                <h4>
                                    <a href="#" class="text-decoration-none text-dange  list-group-item-action"><?php echo $value['nome']?></a>
                                </h4>
                                <small>R$<?php echo $value['preco'] ?>,00</small>
                            </div>
                            <div class="col-4 offset-8 align-self-center col-sm-2 offset-sm-8 col-md-2 offset-md-0 col-lg-2 offset-lg-0 col-xl-2 align-sel-center mt-3">
                                <a href="?item=<?php echo $key ?>" class="btn text-light bg-danger">Remover</a>
                            </div>
                        </div>
                    </li>
                </ul>

                <?php
                    } //FINAL DO FOREACH
                ?>
                
            </div> <!-- Final primeira coluna -->

            <div class="col p-1">
                <div class='list-group'>
                    <div id="coluna-finalizar-compra" class="col-12 list-group-item d-flex justify-content-center flex-column">
                        <small id="text-total">Total:</small>
                        <h2 class="fw-bold ">R$<?php echo $valorTotal ?>,00</h2>
                        <a id="finalizar-compra" class="btn btn-success my-2 mx-auto" href='pagamento.php'>Finalizar compra</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $_SESSION['valorTotal'] = $valorTotal;
            } else {
                ?>
                </div>
                <div class='list-group d-flex justify-content-center align-items-center'>
                    <div class="col-12 carrinho-vazio list-group-item d-flex align-items-center flex-column">
                        <h6>Seu carrinho está vazio. Continue comprando para encontrar um curso!</h6>
                        <a class="btn my-3 btn-warning" href='index.php'>Continuar comprando</a>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            </div>
            <div class='list-group d-flex justify-content-center align-items-center'>
                <div class="col-12 carrinho-vazio list-group-item d-flex align-items-center flex-column">
                    <h3>Carrinho vazio</h3>
                    <a class="btn btn-success" href='index.php'>Continuar comprando</a>
                </div>
            </div>
            <?php
        }
        ?>


</div> <!-- Div container -->
<?php
include './include/footer.php';
?>