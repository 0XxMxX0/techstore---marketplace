<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Techstore</title>
    <link rel="icon" type="imagem/png" href="./assents/favicon.png">
    <link rel="stylesheet" type="text/css" href="./CSS/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
  <nav id="barra_navegacao" class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <!-- LOGO -->
            <a class="navbar-brand" href="index.php">
              <img src="./assents/logo.png" class="mx-4 d-inline-block align-top">
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- MENUS -->
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul id="menus" class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" href="index.php" aria-current="page" href="#">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="minhasCompras.php">Minhas compras</a>
              </li>
              <li class="nav-item">
                <?php
                  if(!isset($_SESSION['carrinho'])){
                    echo "
                      <a class='bi bi-bag nav-link' href='./carrinho.php'><span class='text-warning'>0</span></a>
                    ";
                  } else {
                    ?>                    
                      <a class='bi bi-bag nav-link' href='./carrinho.php'><span class="text-warning"><?php echo count($_SESSION['carrinho']) ?></span></a>
                    <?php
                  }
                ?>
              </li> 
              <li class="nav-item">
                <a class="btn nav-link" href="google.com">Inscreva-se</a>
              </li>
              <li class="nav-item mx-1">
                <a class="btn nav-link btn-warning" href="google.com">Entrar</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    