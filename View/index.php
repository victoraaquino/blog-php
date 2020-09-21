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
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>
  <link rel="stylesheet" href="./assets/css/index.css" type="text/css">
  <title>Blog</title>
</head>

<body>
  <header>
    <h1 class="title">Blog Geek</h1>
  </header>
  <div class="menu">
    <a href="?redirect=login">Fazer Login</a>
  </div>

  <!-- Listagem dos Posts -->
  <div style="padding: 10px">
    <?php
    foreach ($posts as $i => $post) {
    ?>
      <div class="card mb-3">
        <div class="card-body">
          <h1><?php echo $post->getTitle() ?></h1>
          <p>Autor(a): <?php echo $post->getAuthor()->getName() ?> | Última modificação: <?php echo date('d/m/Y H:i', strtotime($post->getTime())) ?> </p>
          <div><?php echo $post->getText() ?></div>
          <p>Tags:
            <?php
            foreach ($post->getTags() as $i => $tag) {
              echo "<span class='tag' >" . $tag->getName() . "</span>";
            }
            ?>
          </p>
        </div>
      </div>
    <?php
    }
    ?>
    <?php
    if (count($posts) == 0) {
      echo "<h1 style='width:100%;text-align:center;font-family:Arial'>Não Possuí Posts</h1>";
    }
    ?>
  </div>

</body>

</html>