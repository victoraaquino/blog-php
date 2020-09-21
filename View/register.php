<?php

require_once "./../Controller/AuthorController.php";

if (isset($_POST["btn_cadastro"])) {

    AuthorControler::register([
        "name" => $_POST["name"],
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    ]);
}

if (isset($_GET["redirect"])) {
    $redirect = $_GET["redirect"];
    header("Location: $redirect.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>
    <link rel='stylesheet' href='./assets/css/login.css' type='text/css'>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>Blog | Cadastro</title>
</head>

<body>
    <div class="menu">
        <a href="?redirect=index">Ir para a pagina principal</a>
    </div>
    <div class='card container_login'>

        <div class='card-body p-5'>
            <div class='card-title' style="text-align: center;margin-bottom:100px">
                <h1>Cadastro</h1>
            </div>
            <form method="post" action="register.php">
                <div class="row">
                    <div class="col-md-8 mr-auto ml-auto">
                        <input type="text" name="name" class="form-control mb-3 required" placeholder="Nome Completo" onkeypress="verifyField()">
                        <input type="email" name="email" class="form-control mb-3 required" placeholder="E-mail" onkeypress="verifyField()">
                        <input type="password" name="password" class="form-control mb-3 required" placeholder="Senha" onkeypress="verifyField()">
                        <button type="submit" class="btn btn-primary btn-block mb-3" name="btn_cadastro" id="btn_cadastro">Cadastrar</button>
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
    <script>
        $('#btn').attr('disabled', 'disabled');
        function verifyField() {
            let isEmpty = '';

            document.querySelectorAll('.required').forEach( e => {
                if(e.value == ''){
                    e.style.border = "1px solid red";
                    isEmpty = true
                }else{
                    e.style.border = "1px solid green";
                }
            });

            if(isEmpty){
                $('#btn_cadastro').attr('disabled','disabled');
            }else{
                $('#btn_cadastro').removeAttr('disabled');
            }
        }
    </script>
</body>

</html>