<?php

include_once('conexao.php');

session_start();

if(isset($_SESSION['usuario'])){
  $nome = $_SESSION['usuario']['nome'];
}

if (!isset($_SESSION['usuario'])) {
  header("Location: aviso_login.php");
  exit;
}

if(isset($_POST['logoff'])){
  session_destroy();
  header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>login</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <div class="form-container">
    <h2>Olá, <?php echo $nome ?></h2>
    <h2>Seja bem vindo!</h2>

    <form method="post">
      <div class="login-link">
      <a href="login.php"> <button class="btn" name="logoff">  Fazer logoff </button> </a>
      </div>
    </form>

  </div>

</body>
</html>
