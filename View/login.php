<?php
session_start();


if (isset($_POST["btn_login"])) {

  require "./../Controller/AuthorController.php";

  $res = AuthorControler::login([
    "email" => $_POST["email"],
    "password" => $_POST["password"]
  ]);

  echo "
    <script>
      alert('Usuário inexistente');
    </script>
    ";
}

if(isset($_GET["redirect"])){
  $redirect = $_GET["redirect"];
  header("Location: $redirect.php");
}

?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>
  <link rel='stylesheet' href='./assets/css/login.css' type='text/css'>
  <title>Blog | Login</title>
</head>

<body>

  <div class='card container_login'>

    <div class='card-body p-5'>
      <div class='card-title' style="text-align: center;margin-bottom:100px">
        <h1>Bem-vindo ao Blog</h1>
      </div>
      <form method="post" action="login.php">
        <div class="row">
          <div class="col-md-8 mr-auto ml-auto">
            <input type="email" name="email" class="form-control mb-3" placeholder="E-mail">
            <input type="password" name="password" class="form-control mb-3" placeholder="Senha">
            <button type="submit" class="btn btn-primary btn-block mb-3" name="btn_login">Entrar</button>
            <a href="?redirect=register">Novo por aqui? Cadastre-se</a>
          </div>
        </div>
      </form>
    </div>

  </div>
  <?php
  if (isset($_GET["error"])) {
    echo "
        <script>
          alert('Email ou senha incorretos');
        </script>
      ";
  }
  ?>
</body>

</html>