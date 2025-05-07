<?php

include_once('conexao.php');

session_start();

if(isset($_SESSION['usuario'])){
  $nome = $_SESSION['usuario']['nome'];
  $nivel = $_SESSION['usuario']['nivel'];
}

if($nivel != 1){
  session_destroy();
  header("Location: aviso_login.php");
}

if (!isset($_SESSION['usuario'])) {
  header("Location: aviso_login.php");
  exit;
}

if(isset($_POST['voltar'])){
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

<style>
  input {
      padding: 8px 5px;
      border: none;
      background-color: #333;
      color: white;
      border-radius: 5px;
  }
/* 
  .email{
    width: 200px;
  } */
</style>

  <div class="container-cadastrados">
    <h2>Usuarios Cadastrados</h2>

    
    <form method="post">
        <table>
            <thead>
              <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Nivel</th>
                <th></th>
              </tr>
            </thead>
                <?php
                  $sql_usuarios = "select u.id, u.nome, u.email, n.descricao as nivel from usuarios u left join niveis_usuarios n on n.id = u.nivel order by u.id";
                  $sql_usuarios = mysqli_query($mysqli, $sql_usuarios);
                  while($usuarios = $sql_usuarios->fetch_assoc()){
                ?>
            <tbody>
              <tr>
                <td><input type="text" value="<?php echo $usuarios['id'];?>"name="id" style="width: 20px; background-color: #1e1e1e;" readonly></td>
                <td><input type="text" value="<?php echo $usuarios['nome'];?>" name="nome" style="width: 200px;"> </td>
                <td><input type="text" value="<?php echo $usuarios['email'];?>" name="email" style="width: 200px;"></td>
                <td><input type="text" value="<?php echo $usuarios['nivel'];?>" name="nivel" style="width: 100px;"></td>
                <td></td>
              </tr>
            </tbody>
                <?php
                  };
                ?>
        </table>
        

        <div class="login-link">
          <button type="submit" class="botn" name="salvar">  Salvar </button> 
            <?php
              if(isset($_POST['salvar'])){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $id = $_POST['id'];
              
                $update="update usuarios set nome = '$nome', email = '$email' where id = $id";
                $sqlupdate = mysqli_query($mysqli,$update);
                header("location: cadastrados.php");
              }
            ?>
          <a href="index.php"> <button class="botn" name="voltar">  Voltar a tela inicial </button> </a>
        </div>
    </form>

  </div>

</body>
</html>
