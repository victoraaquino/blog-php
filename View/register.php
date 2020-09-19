<?php

require "./../Controller/AuthorController.php";

if (isset($_POST["btn_cadastro"])) {

    AuthorControler::register([
        "name" => $_POST["name"],
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    ]);
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>
    <link rel='stylesheet' href='./assets/css/login.css' type='text/css'>
    <title>Blog | Cadastro</title>
</head>

<body>
    <div class='card container_login'>

        <div class='card-body p-5'>
            <div class='card-title' style="text-align: center;margin-bottom:100px">
                <h1>Cadastro</h1>
            </div>
            <form method="post" action="register.php">
                <div class="row">
                    <div class="col-md-8 mr-auto ml-auto">
                        <input type="text" name="name" class="form-control mb-3" placeholder="Nome Completo">
                        <input type="email" name="email" class="form-control mb-3" placeholder="E-mail">
                        <input type="password" name="password" class="form-control mb-3" placeholder="Senha">
                        <button type="submit" class="btn btn-primary btn-block mb-3" name="btn_cadastro">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <?php
    if (isset($_GET["error"])) {
        echo "
        <script>
          alert('Ocorreu um erro no cadastro');
        </script>
      ";
    }
    ?>
</body>

</html>