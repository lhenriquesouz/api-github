<?php

require_once "recurso.php";
require_once "db.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Favoritos</title>
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="api.php">API GitHub</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="favoritos.php">Favoritos</a>
        </li>
      </ul>
    </div>
  </nav>

  <?php 	
      
      $sql = $conn->query("SELECT * FROM favoritosGit");

      if ($sql->rowCount() > 0) {
        $favoritos = $sql->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="d-flex row row-cols-1 row-cols-md-3 mt-2">
        <?php foreach ($favoritos as $favorito) { ?>
            <div class="col mb-3">
              <div class="card">
                <img src="<?php echo $favorito['imagem']; ?>" class="card-img-top" style="width: 10rem; border-radius: 50%;" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $favorito['user'] ?></h5>
                  <p class="card-text">Nome: <?php echo $favorito['nome'] ?></p>
                  <p class="card-text">Empresa: <?php echo $favorito['empresa'] ?></p>
                </div>
                <div class="d-flex card-footer justify-content-between">
                  <small class="text-muted">Adicionado em: <?php echo date_format(new DateTime($favorito['data_acao']), "d/m/Y"); ?></small>
                <form class="mb-3" action="" method="GET">
                  <a href="?favorite=<?php echo $favorito['id']; ?>">❤️</a>
                </form>
                </div>
              </div>
            </div>
        <?php } ?>
        </div>
     <?php }else{
        echo "<div class='alert alert-primary' role='alert'>
                Não existem usuários favoritos!!
              </div>Não possui usuarios favoritados";
      }  

  ?>