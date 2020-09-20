<?php

require_once "./../Controller/PostController.php";

$post = PostController::getAll();

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
        <h1><?php echo $post['title'] ?></h1>
        <p><?php echo$post['text'] ?></p>
    <?php
        }
    ?>
</body>

</html>