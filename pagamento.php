<?php
session_start();

if(!isset($_SESSION['carrinho'])){
    header('location: index.php');    
} else {
    $valorTotal = $_SESSION['valorTotal'];
    if(isset($_POST['btn-confirmar'])){
        if($_SESSION['carrinho']){

            if(isset($_POST['forma-pagamento'])){
                $formaPagamento = $_POST['forma-pagamento'];

                if($formaPagamento == 'cartao'){
                    $nomeCard = $_POST['nome-cartao'];
                    $cpf = $_POST['doc-cartao'];
                    $countCpf = preg_match_all('/[0-9]/', strval($cpf), $matches);
                    
                    
                    $numberCard = $_POST['number-cartao'];
                    $countNumberCard = preg_match_all('/[0-9]/', strval($numberCard), $matches);
                    
                    $cvCard = $_POST['cv-cartao'];
                    $countCvCard = preg_match_all('/[0-9]/', strval($cvCard), $matches);
                    $prazoCard = $_POST['prazo-cartao'];
                    
                    if($nomeCard != ''){
                        if($countCpf == 11 OR $countCpf == 14){
                            if($countNumberCard == 16){
                                if($countCvCard == 3 or $countCvCard == 4){
                                    if($prazoCard != ''){
                                        $termoCard = $_POST['termo-cartao'];
                                        foreach($_SESSION['carrinho'] as $key => $value){
                                            $_SESSION['carrinho'][$key]['formaPagamento'] = $formaPagamento;
                                        }
                                        header('location:validar.php');
                                    } else {
                                        echo "
                                            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                <strong>O Prazo do cartão precisa ser expecificado
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>
                                        ";
                                    }
                                } else {
                                    echo "
                                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                            <strong>Codigo de verificação incorreto!
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                        </div>
                                    ";
                                }
                            } else {
                                echo "
                                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <strong>Numero do cartão incorreto!
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>
                                ";
                            }
                        } else {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>O campo CPF/CNPJ esta incorreto!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                            ";

                        }
                    } else {
                        echo "
                            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>O Nome do cartão precisa ser expecificado
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        ";
                    }
                } else if($formaPagamento == 'boleto'){
                    $termoCard = $_POST['termo-cartao'];
                    foreach($_SESSION['carrinho'] as $key => $value){
                        $_SESSION['carrinho'][$key]['formaPagamento'] = $formaPagamento;
                    }
                    header('location:validar.php');
                } else {
                    echo "Forma de pagamento invalida!";
                }
            } else {
                echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Selecione uma forma de pagamento!
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            } 
        } else {
        }
    } 

    include './include/head.php';
    ?>
    <div class="container my-5">
        <h1>Forma de pagamento</h1>
        <form method='post' class="row">
            <!-- COLUNA FORMAS DE PAGAMENTO -->
            <div class="col-7">
                <ul class="list-group mb-3">
                    <!-- FORMA DE PAGAMENTO CARTÃO -->
                    <li class="list-group-item ">
                        <div class="row g-2">
                            <div class="col-1 col-md-1 col-lg-1 col-xl-1 text-left align-self-center">
                                <input type="radio" name="forma-pagamento"  class="form-check-input" id="forma-pagamento" onclick="showDiv()" value="cartao"/>
                            </div>
                            <div class="col-3 offset-1 align-self-center col-sm-2 col-md-2 offset-md-0 col-lg-2 offset-lg-0 col-xl-1 align-sel-center mt-3">
                                <label for="credito">Cartão de crédito/débito</label>
                            </div>
                            
                        </div>
                        <!-- DADOS DO CARTÃO -->
                        <div id="cadastro-card" class="row g-3" style="display:none">
                            <div class="col-6">
                                <label for="input-nome" class="form-label">Nome do cartão</label>
                                <input type="text" name="nome-cartao" id="nome-cartao" class="form-control rounded-0" placeholder="Nome do cartão"/>
                            </div>
                            <div class="col-6">
                                <label for="inputPassword4" class="form-label">CPF/CNPJ</label>
                                <input type="number" name="doc-cartao" id="doc-cartao" class="form-control rounded-0" id="input-password" placeholder="CPF/CNPJ" />
                            </div>
                            <div class="col-12 "
                                <label for="input-num-card" class="form-label">Numero do cartão</lable>
                                <input type="number" name="number-cartao" id="number-cartao" class="form-control d-inline-block rounded-0"  placeholder="0000 0000 000 0000" />
                            </div> 
                            <div class="col-6">
                                <label for="input-nome" class="form-label">CVC/CVV</label>
                                <input type="number" name="cv-cartao" id="cv-cartao" class="form-control rounded-0" placeholder="CVC" />
                            </div>
                            <div class="col-6">
                                <label for="inputPassword4" class="form-label">Prazo</label>
                                <input type="text" name="prazo-cartao" id="prazo-cartao" class="form-control rounded-0" id="input-password" placeholder="MM/AA" >
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" name="termo-cartao" id="termo-cartao" value="aceito" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                    Salvar cartão para compras futuras
                                    </label>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- boleto -->
                    <li class="list-group-item ">
                        <div class="row g-2">
                            <div class="col-1 col-md-1 col-lg-1 col-xl-1 text-left align-self-center">
                                <input type="radio" name="forma-pagamento" class="form-check-input" id="forma-pagamento" onclick="hideDiv()" value="boleto"/>
                            </div>
                            <div class="col-3 offset-1 align-self-center col-sm-2 col-md-2 offset-md-0 col-lg-2 offset-lg-0 col-xl-1 align-sel-center mt-3">
                                <label for="boleto">boleto</label>
                            </div>
                        </div>
                    </li>
                </ul>
                <h4>Detalhes da compra</h4>
                <?php
                    foreach($_SESSION['carrinho'] as $key => $value){
                        ?>
                        <ul class="list-group mb-3">
                            <li class="list-group-item py-3">
                                <div class="row g-2">
                                    <div id="picture" class="col-4 col-md-3 col-lg-2 ">
                                        <a href="#">
                                            <img src="<?php echo $_SESSION['carrinho'][$key]['imagem'] ?>" class="img-thumbnail "/>
                                        </a>
                                    </div>
                                    <div class="col-3 col-md-4 col-lg-5 col-xl-6 text-left align-self-center">
                                        <h4>
                                            <a href="#" class="text-decoration-none text-dange  list-group-item-action"><?php echo $value['nome']?></a>
                                        </h4>
                                    </div>
                                    <div class="col-4 offset-8 align-self-center col-sm-2 offset-sm-8 col-md-2 offset-md-0 col-lg-2 offset-lg-0 col-xl-2 align-sel-center mt-3">
                                        <small>R$<?php echo $value['preco'] ?>,00</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <?php
                    }
                ?>
            </div> <!-- Final da primeira coluna-->
            <div class="col p-1">
                <div class="col p-1">
                    <div class='list-group'>
                        <div id="coluna-finalizar-compra" class="col-12 list-group-item d-flex justify-content-center flex-column">
                            <small id="text-total">Total:</small>
                            <h2 class="fw-bold ">R$<?php echo $valorTotal ?>,00</h2>
                            <button id="finalizar-compra" class="btn btn-success my-2 mx-auto" id="finalizar-compra" name="btn-confirmar" type="submit">Finalizar compra</button>
                        </div>
                    </div>
                </div>
            </div> <!-- Final da segunda coluna-->
        </form>
    </div> <!-- Final do container -->
    <script>

        function showDiv(){
            document.getElementById('cadastro-card').style.display = 'flex';
        }
        function hideDiv(){
            document.getElementById('cadastro-card').style.display = 'none';
        }


        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
            }, false)
        })
        })()



    </script>
    <?php
}
include './include/footer.php';