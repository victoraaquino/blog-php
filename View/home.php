<?php
session_start();

require_once "./../Controller/PostController.php";

$posts = PostController::getAllByAuthor($_SESSION['user']['id']);

if (isset($_GET["redirect"])) {
    $redirect = $_GET["redirect"];
    header("Location: $redirect.php");
}

if(isset($_GET["logout"])){
    unset($_SESSION["user"]);
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | Dashboard</title>
</head>

<body>
    <a href="?redirect=post">Cadastrar posts</a>
    <a href="?logout=true">Sair</a>
    <!-- Listagem dos posts cadastrados pelo usuario -->
    <?php
        foreach ($posts as $i => $post) {
    ?>
        <h1><?php echo $post['title'] ?></h1>
        <p><?php echo$post['text'] ?></p>
    <?php
        }
    ?>
</body>

</html>