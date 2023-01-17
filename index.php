<?php
    session_start();
    require_once 'vendor/autoload.php';

    $items = array(['nome'=>'Headset Gamer','imagem'=>'./assents/item1.png','preco'=>'105'],
                   ['nome'=>'Mouse','imagem'=>'./assents/item2.png','preco'=>'100'],
                   ['nome'=>'Cadeira Gamer','imagem'=>'./assents/item3.png','preco'=>'600'],
                   ['nome'=>'Controle Xbox','imagem'=>'./assents/item4.png','preco'=>'400'],
                   ['nome'=>'Xbox one','imagem'=>'./assents/item5.png','preco'=>'150'],
                   ['nome'=>'pokebola','imagem'=>'./assents/item6.png','preco'=>'2000']
    );

    if(isset($_GET['adicionar'])){
        $idProduto = (int) $_GET['adicionar'];
        if(isset($items[$idProduto])){

            if(isset($_SESSION['carrinho'][$idProduto])){
                if($_SESSION['carrinho'][$idProduto]['quantidade'] == 1){
                    echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>Você já adicionou em seu carrinho!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    "; 
                }
            }else {
                $_SESSION['carrinho'][$idProduto] = array('quantidade'=>1,'imagem'=>$items[$idProduto]['imagem'],'nome'=>$items[$idProduto]['nome'],'preco'=>$items[$idProduto]['preco'],'formaPagamento'=>'');
                echo '
                    <div class="modal fade" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionado ao carrinho</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="p-1 row">
                                        <div class="col-3  p-1">
                                        <img class="img-fluid" width="250" src="'.$items[$idProduto]['imagem'].'"/>
                                        </div>
                                        <div class="col-5  p-1 ">
                                        <h5>'.$items[$idProduto]['nome'].'</h5>
                                        <p style="font-weight: normal">R$'.$items[$idProduto]['preco'].',00</p>
                                        </div>
                                        <div class="col-4  p-1 d-flex align-items-center">
                                        <a class="btn btn-success btn-ms btn-block" href="carrinho.php">Ir para o carrinho</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-warning btn-lg" data-dismiss="modal">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';

                echo '
                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

                    <script>
                        $("#exampleModal").modal("show")
                    </script>
                ';
            }
        } else {
            die('Você não pode adicionar um item que não existe!');
        }
    }

include './include/head.php';
?>
<div class="container  mt-3">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img class="d-block w-100" src="./assents/background1.png" alt="First slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" src="./assents/background2.png" alt="Second slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" src="./assents/background3.png" alt="Third slide">
            </div>
        </div>
    </div>
</div>
<div class='container'>
    <hr class='mt-3'>
    <div class="row my-4 position-relative">
        <h4 class=" ">Principais produtos</h4>
    </div>

    <div id='produtos' class="row">
        <?php
            foreach($items as $key => $value){
        ?>
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                <div class="card text-left bg-light mb-3">
                    <img class="img-fluid card-img-top" src="<?php echo $value['imagem'] ?>"/>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $value['nome'] ?></h5>
                        <h5 >R$<?php echo $value['preco'] ?>,00</h5>
                    </div>
                    <div class="card-footer">
                        <a  href='?adicionar= <?php echo $key ?>' class="btn d-block btn-warning">Adquirir</a>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
    </div>

</div>
<?php
include './include/footer.php';
?>
