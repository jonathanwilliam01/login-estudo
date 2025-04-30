<?php

include_once('conexao.php');

session_start();

if(isset($_SESSION['usuario'])){
  $nome = $_SESSION['usuario']['nome'];
}

// if (!isset($_SESSION['usuario'])) {
//   header("Location: aviso_login.php");
//   exit;
// }

if(isset($_POST['voltar'])){
  session_destroy();
  header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Usuarios cadastrados</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <div class="container-cadastrados">
    <h2>Usuarios Cadastrados</h2>

    <table>
        <thead>
          <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
            <?php
              $sql_usuarios = "select id, nome, email from usuarios order by id";
              $sql_usuarios = mysqli_query($mysqli, $sql_usuarios);
              while($usuarios = $sql_usuarios->fetch_assoc()){
            ?>
        <tbody>
          <tr>
            <td><?php echo $usuarios['id']; ?></td>
            <td><?php echo $usuarios['nome']; ?></td>
            <td><?php echo $usuarios['email']; ?></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
            <?php
              };
            ?>
    </table>

    <form method="post">
      <div class="login-link">
      <a href="index.php"> <button class="botn" name="voltar">  Voltar a tela inicial </button> </a>
      </div>
    </form>

  </div>

</body>
</html>
