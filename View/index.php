<?php

require_once "./../Controller/PostController.php";

$posts = PostController::getAll();

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
    <title>Blog</title>
</head>

<body>
    <a href="?redirect=login">Fazer Login</a>
    <!-- Listagem dos Posts -->
    <?php
    foreach ($posts as $i => $post) {
    ?>
        <div>
            <h1><?php echo $post->getTitle() ?></h1>
            <h2>Autor: <?php echo $post->getAuthor()->getName() ?></h2>
            <h3>Última modificação: <?php echo date('d/m/Y H:i', strtotime($post->getTime())) ?> </h3>
            <p><?php echo $post->getText() ?></p>
        </div>
    <?php
    }
    ?>
</body>

</html>