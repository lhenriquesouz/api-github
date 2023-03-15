<?php

require_once "recurso.php";
require_once "db.php";

if (isset($_GET['favorite'])) {
  $dados = explode(",",$_GET['favorite']);
  $user             = $dados[0];
  $nome             = $dados[1];
  $empresa          = $dados[2] ? $dados[2] : 'Não cadastrou';
  $imagem           = $dados[3];
  $sql              = "INSERT INTO favoritosGit SET user = :user, nome = :nome, empresa = :empresa, imagem = :imagem ,data_acao = NOW()";
  $stmt             = $conn->prepare($sql);
  $stmt->bindValue(':user', $user);
  $stmt->bindValue(':nome', $nome);
  $stmt->bindValue(':empresa', $empresa);
  $stmt->bindValue(':imagem', $imagem);
  $stmt->execute();

  echo "<script>alert('Inserido com sucesso aos favoritos!!!')</script>";

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>API GitHub</title>
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> 
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> 
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">API GitHub</a>
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
    // Printa os dados
    echo "<div class='container d-flex justify-content-center mt-5'>";
    // echo "Username: $username <br>";
    echo "<img style='width:200px;border-radius:50%' src='$avatar_url' alt=''>";
    echo "</div>";
  ?>

  <div class="container flex-column mt-3" style="width: 40rem;">
    <form class="input-group mb-3" method="post">
      <input class="form-control" type="text" name="user" placeholder="Busque o dev" value="<? echo $username; ?>">
      <input class="btn btn-primary" type="submit" value="Buscar">
      <br>
      <!-- <span><? echo $erroPreenchimento; ?></span> -->
    </form>
    <form class="mb-3" action="" method="GET">
      <a href="?favorite=<?php echo $username . ',' . $name . ',' . $company . ',' . $avatar_url ?>">❤️</a>
    </form>
    <div class="container bg-dark text-light rounded">
      <?php
          echo "Username             : $username <br>";
          echo "Nome                 : $name <br>";
          echo "Empresa              : $company <br>";
          echo "Localização          : $location <br>";
          echo "Repositórios Publicos: $public_repos <br>";
          echo "LinkedIn             : $blog <br>";
          echo "Data criação GitHub  : $created_at <br>";
        ?>
    </div>
  </div>

</body>
</html>
